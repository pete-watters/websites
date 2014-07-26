<?php
/*
Plugin Name: OddsPress Plugin for WordPress
Version: 1.0
Plugin URI: http://www.oddspress.com
Description: A fast and easy way to add Football Odds to your WordPress blog. Go to <a href="options-general.php?page=oddspress.php">Settings&rarr;OddsPress for WP</a> to adjust default settings.
Author: Bryan Kelly, Bryan Paddock
Author URI: http://www.oddspress.com
*/
/*Define version for the plugin.*/
define('ODDSPRESS_PLUGIN', '1.0');
/*Expected minimum SimplePie build number.*/
define('EXPECTED_SIMPLEPIE_VERSION', '1.1.1');
/*Expected minimum SimplePie build number.*/
define('EXPECTED_SIMPLEPIE_BUILD', 20080315205903);
/*WordPress version.*/
define('WP_VERSION', get_bloginfo('version'));
/*Web-accessible wp-content directory.*/
define('WP_CONTENT_WEB', get_bloginfo('wpurl') . '/wp-content');
/*Web-accessible control panel page.*/
define('WP_CPANEL', get_bloginfo('wpurl') . '/wp-admin/options-general.php?page=oddspress');
/*Set absolute OddsPress plugin directory.*/
define('ODDSPRESS_PLUGINDIR', dirname(__FILE__));
/*Get only the name of the plugin directory.*/
define('ODDSPRESS_PLUGINDIR_NAME', pathinfo(dirname(__FILE__), PATHINFO_BASENAME));
/*Web-accessible URL for the plugin directory.*/
define('ODDSPRESS_PLUGINDIR_WEB', WP_CONTENT_WEB . '/plugins/' . ODDSPRESS_PLUGINDIR_NAME);
/*Default cache directory.*/
define('ODDSPRESS_CACHEDIR', dirname(dirname(ODDSPRESS_PLUGINDIR)) . '/cache');

/*Wrapper class for static functions*/
class OddsPress_WordPress
{
/*Shortens path names based on the location of /wp-content/.*/
function clean_wp_path($path)
{
	if ($wp_path = stristr($path, 'wp-content'))
	{
		return '[WP Install]/' . $wp_path;
	}
	else
	{
		return $path;
	}
}

/*Re-implement str_split() in PHP 4.x. Written by dacmeaux at gmail dot com, posted to http://us3.php.net/str_split. Modified by Ryan Parman, http://simplepie.org*/
function str_split($text)
{
	// If str_split() exists in PHP, use it.
	if (function_exists('str_split'))
	{
		return str_split($text);
	}

	// Otherwise, emulate it.
	else
	{
		$array = array();
		$text_len = strlen($text);
		for ($i = 0; $i < $text_len; $i++)
		{
			$key = NULL;
			for ($j = 0; $j < 1; $j++)
			{
				$key .= $text[$i];  
			}
			array_push($array, $key);
		}
		return $array;
	}
}

/*version_compare() is being stupid, so let's work around it.*/
function convert_to_version($s)
{
	$s = strval($s);
	$s = OddsPress_WordPress::str_split($s);
	$s = implode('.', $s);
	return $s;
}

/*Get a list of files from a given directory.*/
function get_files($dir, $extension)
{
	$temp = array();

	if (is_dir($dir))
	{
		if ($dh = opendir($dir))
		{
			while (($file = readdir($dh)) !== false)
			{
				if (!is_dir($file))
				{
					// Determine location of the file
					$location = $dir . $file;

					// Determine label for the template file
					$label = explode($extension, $file);
					$label = str_replace('_', ' ', $label[0]);
					$label = str_replace('-', ' ', $label);
					$label = str_replace('.', ' ', $label);
					$label = ucwords($label);

					// Add them to the array.
					$temp[] = array('location' => $location, 'label' => $label);
				}
			}
			closedir($dh);
		}
	}

	return $temp;
}

/*Handles the post-processing of data.*/
function post_process($swap, $s)
{
	if (class_exists('SimplePie_PostProcess'))
	{
		$swap = strtolower($swap);
		$post = new SimplePie_PostProcess;

		if (method_exists($post, $swap))
		{
			$s = SimplePie_PostProcess::$swap($s);
		}
	}

	return $s;
}
}
//End Wrapper OddsPress_WordPress Class//

//setup defaults if not present
if (!get_option('oddspress_enable_cache'))
{
	update_option('oddspress_enable_cache', 1, 'Whether the feeds should be cached or not.');
}
if (!get_option('oddspress_set_cache_location'))
{
	update_option('oddspress_set_cache_location', ODDSPRESS_CACHEDIR, 'The file system location for the cache.');
}
if (!get_option('oddspress_set_cache_duration'))
{
	update_option('oddspress_set_cache_duration', 3600, 'The number of seconds that feed data should be cached for before asking the feed if it\'s been changed.');
}
if (!get_option('oddspress_template'))
{
	update_option('oddspress_template', ODDSPRESS_PLUGINDIR . '/templates/default.tmpl', 'The template to use for displaying feeds.');
}
if (!get_option('oddspress_set_timeout'))
{
	update_option('oddspress_set_timeout', 10, 'Number of seconds to wait for a remote feed to respond before giving up.');
}
if (!get_option('oddspress_partner'))
{
	update_option('oddspress_partner', 'moddspress');
}
if (!get_option('oddspress_leaguename'))
{
	update_option('oddspress_leaguename', 'OddsPress League Name.');
}

//Setup Flash Confirmation Messages in SubPanel
$ol_flash = '';

function oddspress_is_authorized() {
	global $user_level;
	if (function_exists("current_user_can")) {
		return current_user_can('activate_plugins');
	} else {
		return $user_level > 5;
	}
}
								
add_option('oddspress_settings',$data,'OddsPress Options');

$oddspress_settings = get_option('oddspress_settings');

function oddspress_is_hash_valid($form_hash) {
	$ret = false;
	$saved_hash = oddspress_retrieve_hash();
	if ($form_hash === $saved_hash) {
		$ret = true;
	}
	return $ret;
}
function oddspress_generate_hash() {
	return md5(uniqid(rand(), TRUE));
}
function oddspress_store_hash($generated_hash) {
	return update_option('oddspress_token',$generated_hash,'OddsPress Security Hash');
}
function oddspress_retrieve_hash() {
	$ret = get_option('oddspress_token');
	return $ret;
}
function add_oddspress_options_page() {
	if (function_exists('add_options_page')) {
		add_options_page('OddsPress', 'OddsPress', 8, basename(__FILE__), 'oddspress_options_subpanel');
	}
}

//OddsPress Back Office Panel//
function oddspress_options_subpanel() {
	global $ol_flash, $oddspress_settings, $_POST, $wp_rewrite;
	//Setup League Array
	$array = array("123"=>"Scottish Division Three","121"=>"Scottish Division One","122"=>"Scottish Division Two","101"=>"English Championship","102"=>"English League One","500"=>"UEFA Champions League","320"=>"Scottish FA Cup","103"=>"English League Two","510"=>"UEFA Cup","100"=>"English Premier","120"=>"Scottish Premier League","142"=>"Irish Premier League","143"=>"Irish Division One","104"=>"English Blue Square Premier","300"=>"English F A Cup","635"=>"Italian Serie A","637"=>"Italian Serie B","620"=>"French Ligue 1","621"=>"French Ligue 2","650"=>"Spanish Primera","652"=>"Spanish Segunda","625"=>"German Bundesliga One","626"=>"German Bundesliga Two","645"=>"Portuguese Superliga","875"=>"Greek Super League","656"=>"Slovakian Super Liga","606"=>"Bulgarian APFG","885"=>"Serbian Super Liga","641"=>"Polish Ekstraklasa","630"=>"Dutch Eredivisie","665"=>"Turkish Super Ligi","640"=>"Norwegian Tippeligaen","642"=>"Norwegian Adeccoligaen","600"=>"Austrian Bundesliga","605"=>"Belgian Jupiler","655"=>"Swedish Allsvenskan","610"=>"Danish S A S Ligaen","627"=>"Czech Gambrinus Liga","682"=>"Romanian Liga I","657"=>"Slovenian Prva Liga","666"=>"Ukrainian Premier League","647"=>"Russian Premier League","762"=>"U S A Major League","786"=>"Mexican Clausura","761"=>"Argentinian Clasura");

	if (oddspress_is_authorized()) {
		// Easiest test to see if we have been submitted to
		if(isset($_POST['oddspress_url']) || isset($_POST['oddspress_comments_url'])) {
			// Now we check the hash, to make sure we are not getting CSRF
			if(oddspress_is_hash_valid($_POST['token'])) {
			if (isset($_POST['oddspress_url'])) { 
				$oddspress_settings['oddspress_url'] = $_POST['oddspress_url'];
				update_option('oddspress_settings',$oddspress_settings);
				$ol_flash = "Your settings have been saved.";
			}
			if(isset($_POST['league']))
			{
				$league = $_POST['league'];
				$oddspress_settings['oddspress_league'] = $league;
				update_option('oddspress_settings',$oddspress_settings);
				$ol_flash = "Your settings have been saved.<br/><b>League elected :</b> ".$array[$league].".<br/><b>Tag to use :</b> [oddspress=".$league."]<br/><b>*Remember :</b> Only one tag allowed per page or post.";
			}
			if (isset($_POST['oddspress_comments_url'])) { 
				$oddspress_settings['oddspress_comments_url'] = $_POST['oddspress_comments_url'];
				update_option('oddspress_settings',$oddspress_settings);
				$ol_flash = "Your settings have been saved.";
			} 
/*Get Form Values*/
//General settings
$oddspress_template = (string) $_POST['oddspress_template'];
$oddspress_set_cache_location = (string) $_POST['oddspress_set_cache_location'];
$oddspress_set_cache_duration = (integer) $_POST['oddspress_set_cache_duration'];
$oddspress_enable_cache = (bool) $_POST['oddspress_enable_cache'];
$oddspress_set_timeout = (integer) $_POST['oddspress_set_timeout'];
$oddspress_partner = (string) $_POST['oddspress_url'];
if (isset($_POST['league'])) { 
	$league = $_POST['league'];
	$oddspress_leaguename = (string) $league;
}
/*Update plugin options*/
//General settings
update_option("oddspress_template", $oddspress_template);
update_option("oddspress_set_cache_location", $oddspress_set_cache_location);
update_option("oddspress_set_cache_duration", $oddspress_set_cache_duration);
update_option("oddspress_enable_cache", $oddspress_enable_cache);
update_option("oddspress_set_timeout", $oddspress_set_timeout);
update_option("oddspress_partner", $oddspress_partner);
update_option("oddspress_leaguename", $oddspress_leaguename);
			} else {
				// Invalid form hash, possible CSRF attempt
				$ol_flash = "Security hash missing.";
			} // endif fb_is_hash_valid
		} // endif isset(oddspress_url)
	} else {
		$ol_flash = "You don't have enough access rights.";
	}
	
if ($ol_flash != '') echo '<div id="message" class="updated fade"><p>' . $ol_flash . '</p></div>';
	
if (oddspress_is_authorized()) {
	$temp_hash = oddspress_generate_hash();
	oddspress_store_hash($temp_hash);
	echo '<div class="wrap">';
	echo '<h2>Set Up Your OddsPress Feed</h2>';
	echo '<p>This plugin makes it easy to add Football Betting Odds to WordPress site and profit from the traffic it may generate. OddsPress can add Football Betting Odds to your site and allow you to select which Football Leagues you want displayed.</p>
	<form action="" method="post" name="oddspress">
	<input type="hidden" name="redirect" value="true" />
	<input type="hidden" name="sleaguename" value="' . htmlentities($oddspress_settings['oddspress_league']) . '" />
	<input type="hidden" name="token" value="' . oddspress_retrieve_hash() . '" />
	<ol>
	<li>To get started, select the Football League you want to display. This will display the selected Football League Odds in your site - if they are available.<br/><br/>';
?>
<div id="message" class="updated fade">
<select name="league">
	<option value="500">&nbsp;UEFA Champions League</option>
	<option value="510">&nbsp;UEFA Cup</option>
	<option value="100">&nbsp;English Premier</option>
	<option value="104">&nbsp;English Blue Square Premier</option>
	<option value="102">&nbsp;English League One</option>
	<option value="103">&nbsp;English League Two</option>
	<option value="101">&nbsp;English Championship</option>
	<option value="300">&nbsp;English F A Cup</option>
	<option value="120">&nbsp;Scottish Premier League</option>
	<option value="121">&nbsp;Scottish Division One</option>
	<option value="122">&nbsp;Scottish Division Two</option>
	<option value="123">&nbsp;Scottish Division Three</option>
	<option value="320">&nbsp;Scottish FA Cup</option>
	<option value="142">&nbsp;Irish Premier League</option>
	<option value="143">&nbsp;Irish Division One</option>
	<option value="635">&nbsp;Italian Serie A</option>
	<option value="637">&nbsp;Italian Serie B</option>
	<option value="620">&nbsp;French Ligue 1</option>
	<option value="621">&nbsp;French Ligue 2</option>
	<option value="650">&nbsp;Spanish Primera</option>
	<option value="652">&nbsp;Spanish Segunda</option>
	<option value="625">&nbsp;German Bundesliga One</option>
	<option value="626">&nbsp;German Bundesliga Two</option>
	<option value="645">&nbsp;Portuguese Superliga</option>
	<option value="875">&nbsp;Greek Super League</option>
	<option value="656">&nbsp;Slovakian Super Liga</option>
	<option value="606">&nbsp;Bulgarian APFG</option>
	<option value="885">&nbsp;Serbian Super Liga</option>
	<option value="641">&nbsp;Polish Ekstraklasa</option>
	<option value="630">&nbsp;Dutch Eredivisie</option>
	<option value="665">&nbsp;Turkish Super Ligi</option>
	<option value="640">&nbsp;Norwegian Tippeligaen</option>
	<option value="642">&nbsp;Norwegian Adeccoligaen</option>
	<option value="600">&nbsp;Austrian Bundesliga</option>
	<option value="605">&nbsp;Belgian Jupiler</option>
	<option value="655">&nbsp;Swedish Allsvenskan</option>
	<option value="610">&nbsp;Danish S A S Ligaen</option>
	<option value="627">&nbsp;Czech Gambrinus Liga</option>
	<option value="682">&nbsp;Romanian Liga I</option>
	<option value="657">&nbsp;Slovenian Prva Liga</option>
	<option value="666">&nbsp;Ukrainian Premier League</option>
	<option value="647">&nbsp;Russian Premier League</option>
	<option value="762">&nbsp;U S A Major League</option>
	<option value="786">&nbsp;Mexican Clausura</option>
	<option value="761">&nbsp;Argentinian Clasura</option>
</select>
</div>
		<li>Once you have selected your Football League, you can enter your William Hill Affiliate Account Number into the field below. This will be used to track referring traffic to William Hill. :<br/><input type="text" name="oddspress_url" value="<?=htmlentities($oddspress_settings['oddspress_url']) ?>" size="15" /></li>
		<li>You have selected to display the following football league:&nbsp;<input type="text" name="leaguename" disabled value="<?=$array[htmlentities($oddspress_settings['oddspress_league'])] ?>" size="35" />
		</ol>
		<h2>OddsPress Plugin for WordPress</h2>
		<h3>General Settings</h3>
		<p>Most people should feel comfortable tweaking and modifying these settings. These settings are the defaults for OddsPress, but you can override any individual feed instance on the fly by passing additional parameters to it.  See the <a href="http://www.oddspress.com/docs">documentation</a> to learn how to do this.</p>
		<fieldset class="options">
			<table width="100%" cellspacing="2" cellpadding="5" class="optiontable editform">
				<tr>
					<th width="33%" scope="row" valign="top"><h4>Layout template:</h4></th>
					<td class="break"><select name="oddspress_template">
						<?php
						$templates = OddsPress_WordPress::get_files(ODDSPRESS_PLUGINDIR . '/templates/', '.tmpl');
						sort($templates);
						foreach($templates as $template)
						{
							echo '<option value="' . $template['location'] . '">' . $template['label'] . '</option>' . "\n";
						}
						?>
					</select>
						<p class="footnote">Add or edit templates in the following directory:<br /><code><?php echo OddsPress_WordPress::clean_wp_path(ODDSPRESS_PLUGINDIR); ?>/templates/</code></p></td>
				</tr>
				<tr>
					<th width="33%" scope="row" valign="top"><h4>Should we use caching:</h4></th>
					<td class="break"><select name="oddspress_enable_cache" onchange="oddspress_color_temp=document.body.style.color;if(document.forms['oddspress'].oddspress_enable_cache.value=='false'){document.forms['oddspress'].oddspress_set_cache_duration.disabled=true;document.forms['oddspress'].oddspress_cache_duration_units.disabled=true;document.getElementById('set_cache_duration_title').style.color='#cccccc';}else{document.forms['oddspress'].oddspress_set_cache_duration.disabled=false;document.forms['oddspress'].oddspress_cache_duration_units.disabled=false;document.getElementById('set_cache_duration_title').style.color=oddspress_color_temp;}">
							<option value="1">Yes (Recommended)</option>
							<option value="0">No</option>
						</select>
						<p class="footnote">Disabling cache will negatively impact performance (and anger feed creators), but will ensure that the very freshest version of the feed is displayed at all times.</p></td>
				</tr>
				<tr>
					<th width="33%" scope="row" valign="top"><h4>Cache storage location:</h4></th>
					<td class="break"><input type="text" class="text" name="oddspress_set_cache_location" id="oddspress_set_cache_location" value="<?php echo get_option('oddspress_set_cache_location'); ?>" size="50"/>
						<p class="footnote">This should be a complete, writable file system location. Default value is auto-detected, but is not always correct for all WordPress installations. Adjust only if cache isn't working.</p></td>
				</tr>
				<tr>
					<th width="33%" scope="row" id="set_cache_duration_title" valign="top"><h4>How long should we cache for?:</h4></th>
					<td class="break"><input type="text" class="text" name="oddspress_set_cache_duration" value="<?php echo get_option('oddspress_set_cache_duration'); ?>" size="10" />
						<select name="oddspress_cache_duration_units">
							<option value="60">Minutes</option>
							<option value="3600">Hours</option>
							<option value="87840">Days</option>
						</select>
							<p class="footnote">How long before we ask the feed if it's been updated? Recommend 1 hour (3600 seconds).</p></td>
				</tr>
				<tr>
					<th width="33%" scope="row" valign="top"><h4>Seconds to wait while fetching data:</h4></th>
					<td class="break-noborder"><input type="text" class="text" name="oddspress_set_timeout" value="<?php echo get_option('oddspress_set_timeout'); ?>" size="3" maxlength="3" /> seconds
						<p class="footnote">Some feeds are on slow servers, so increasing this time allows more time to fetch the feed.</p></td>
				</tr>
			</table>
		</fieldset>

		<h3>Installation Status</h3>
		<p>This information will help with debugging in case something goes wrong.</p>

		<fieldset class="options">
			<table width="100%" cellspacing="2" cellpadding="5" class="optiontable editform">
				<tr>
					<th width="33%" scope="row" valign="top">Version of WordPress:</th>
					<td valign="top"><img src="<?php echo ODDSPRESS_PLUGINDIR_WEB; ?>/images/ok.png" /> <?php echo WP_VERSION; ?></td>
				</tr>
				<tr>
					<th width="33%" scope="row" valign="top">Version of <a href="http://www.oddspress.com/development">OddsPress Plugin for WordPress</a>:</th>
					<td valign="top"><img src="<?php echo ODDSPRESS_PLUGINDIR_WEB; ?>/images/ok.png" /> <?php echo ODDSPRESS_PLUGIN; ?></td>
				</tr>

				<tr>
					<th width="33%" scope="row" valign="top">Version of <a href="http://wordpress.org/extend/plugins/simplepie-core/">SimplePie Core</a>:</th>
					<?php if ($e = version_compare(OddsPress_WordPress::convert_to_version(SIMPLEPIE_BUILD), OddsPress_WordPress::convert_to_version(EXPECTED_SIMPLEPIE_BUILD)) > -1): ?>
					<td valign="top"><img src="<?php echo ODDSPRESS_PLUGINDIR_WEB; ?>/images/ok.png" /> <?php echo SIMPLEPIE_VERSION; ?> (<a href="options-general.php?page=simplepie_core">Details</a>)</td>
					<?php elseif (!defined('ODDSPRESS_BUILD')): ?>
					<td valign="top"><img src="<?php echo ODDSPRESS_PLUGINDIR_WEB; ?>/images/error.png" /> <span class="warning">None</span> &mdash; Please download and install <a href="http://wordpress.org/extend/plugins/simplepie-core/">SimplePie Core</a>.<p class="footnote">This plugin requires <a href="http://wordpress.org/extend/plugins/simplepie-core/">SimplePie Core</a> (version <?php echo EXPECTED_SIMPLEPIE_VERSION; ?>) to be installed. Check out the <a href="http://codex.wordpress.org/Managing_Plugins#Installing_Plugins">"Installing Plugins"</a> documentation at the WordPress site for help.</p></td>
					<?php else: ?>
					<td valign="top"><img src="<?php echo ODDSPRESS_PLUGINDIR_WEB; ?>/images/error.png" /> <span class="warning"><?php echo SIMPLEPIE_VERSION; ?></span> &mdash; This version is out-of-date. Please update <a href="http://wordpress.org/extend/plugins/simplepie-core/">SimplePie Core</a> to the latest version.<p class="footnote"><a href="http://wordpress.org/extend/plugins/simplepie-core/">SimplePie Core</a> (version <?php echo EXPECTED_SIMPLEPIE_VERSION; ?> or newer) is required. If you already have the latest version, you might have a situation where another plugin has bundled SimplePie and that plugin has loaded before SimplePie Core, causing strange things to happen. If so, try either disabling the other plugin or checking for an updated version that has been updated to utilize SimplePie Core for best compatibility.</p></td>
					<?php endif; ?>
				</tr>

				<tr>
					<th width="33%" scope="row" valign="top">Plugin install location:</th>
					<td valign="top"><img src="<?php echo ODDSPRESS_PLUGINDIR_WEB; ?>/images/ok.png" /> <code><?php echo OddsPress_WordPress::clean_wp_path(ODDSPRESS_PLUGINDIR); ?>/</code>.</td>
				</tr>

				<tr>
					<th width="33%" scope="row" valign="top">Cache directory writable?:</th>
					<?php if (!get_option('oddspress_enable_cache')): ?>
					<td valign="top"><img src="<?php echo ODDSPRESS_PLUGINDIR_WEB; ?>/images/error.png" /> <span class="warning">Cache disabled!</span>
						<p class="footnote">You have chosen to disable caching. Be aware that this will negatively impact performance.</p></td>
					<?php elseif (!is_dir(get_option('oddspress_set_cache_location'))): ?>
					<td valign="top"><img src="<?php echo ODDSPRESS_PLUGINDIR_WEB; ?>/images/error.png" /> <span class="warning">Cache directory does not exist!</span>
						<p class="footnote">Please either create a <a href="http://www.oddspress.com/docs">writable</a> cache directory at <code><?php echo get_option('oddspress_set_cache_location'); ?></code>, or change the preferred location below.</p></td>
					<?php elseif (!is_writable(get_option('oddspress_set_cache_location'))): ?>
					<td valign="top"><img src="<?php echo ODDSPRESS_PLUGINDIR_WEB; ?>/images/error.png" /> <span class="warning">Cache directory not writable!</span>
						<p class="footnote">Please make sure that the cache directory at <code><?php echo get_option('oddspress_set_cache_location'); ?></code> is <a href="http://www.oddspress.com/docs">writable by the server</a>, or change the preferred location below.</p></td>
					<?php else: ?>
					<td valign="top"><img src="<?php echo ODDSPRESS_PLUGINDIR_WEB; ?>/images/ok.png" /> <code><?php echo OddsPress_WordPress::clean_wp_path(get_option('oddspress_set_cache_location')); ?></code> exists and is writable.</td>
					<?php endif; ?>
				</tr>
			</table>
		</fieldset>
		<p class="submit"><input type="submit" name="submitted" value="<?php _e('Update Options �') ?>" /></p>
</form>

	<script type="text/javascript" charset="utf-8">
	// Set the correct value for oddspress_template
	for (var x = 0; x < document.forms['oddspress'].oddspress_template.length; x++) {
		if (document.forms['oddspress'].oddspress_template[x].value == "<?php echo get_option('oddspress_template'); ?>") {
			document.forms['oddspress'].oddspress_template.selectedIndex = x;
			break;
		}
	}

	// Set the correct value for oddspress_league
	for (var x = 0; x < document.forms['oddspress'].league.length; x++) {
		if (document.forms['oddspress'].league[x].value == "<?php echo get_option('oddspress_leaguename'); ?>") {
			document.forms['oddspress'].league.selectedIndex = x;
			break;
		}
	}

	// Set the correct value for oddspress_enable_cache
	for (var x = 0; x < document.forms['oddspress'].oddspress_enable_cache.length; x++) {
		if (document.forms['oddspress'].oddspress_enable_cache[x].value == "<?php echo get_option('oddspress_enable_cache'); ?>") {
			document.forms['oddspress'].oddspress_enable_cache.selectedIndex = x;
			break;
		}
	}

	</script>
	</div>
<?php
	}else{
		echo '<div class="wrap"><p>Sorry, you are not allowed to access this page.</p></div>';
	}

}
//END ODDSPRESS BACKOFFICE PANEL
add_action('admin_menu', 'add_oddspress_options_page');
/*********************************************************************************/
//Code to inject Odds Into Post/Page Function
function OddsPressWP($text) {

//Add Support for multi-tags
$search = "/\[oddspress\s*=\s*(\w+)\]/i";
preg_match_all( $search, $text , $matches );
if ( is_array($matches[1]) ) {
	for ( $m = 0; $m < count($matches[0]); $m++ ) {
		$search = $matches[0][$m];
		if ( strlen($matches[1][$m]) ) {
			$league_id = $matches[1][$m];
		} else {
			continue;
		}
	}
}
//End Support for multi-tags

// Quit if the OddsPress class isn't loaded.
if (!class_exists('SimplePie')) {
	die('<p style="font-size:16px; line-height:1.5em; background-color:#c00; color:#fff; padding:10px; border:3px solid #f00; text-align:left;"><img src="' . ODDSPRESS_PLUGINDIR_WEB . '/images/error.png" /> There is a problem with the OddsPress Plugin for WordPress. Check your <a href="' . WP_CPANEL . '" style="color:#ff0; text-decoration:underline;">Installation Status</a> for more information.</p>');
}

// Default general settings
$template = get_option('oddspress_template');
$enable_cache = get_option('oddspress_enable_cache');
$set_cache_location = get_option('oddspress_set_cache_location');
$set_cache_duration = get_option('oddspress_set_cache_duration');
$set_timeout = get_option('oddspress_set_timeout');
$partner = get_option('oddspress_partner');
if ($partner == "") {
	$partner = "moddspress";
}

if ($league_id == "") {
	$oddspress_leaguename = get_option('oddspress_leaguename');
}else{
	$oddspress_leaguename = $league_id;
}

$sitefeed_url = get_bloginfo('wpurl');
$feed_url = $sitefeed_url ."/wp-content/plugins/oddspress/oddspress-feed.php?pacompid=". $oddspress_leaguename;

//Store League Names in Array
$array = array("123"=>"Scottish Division Three","121"=>"Scottish Division One","122"=>"Scottish Division Two","101"=>"English Championship","102"=>"English League One","500"=>"UEFA Champions League","320"=>"Scottish FA Cup","103"=>"English League Two","510"=>"UEFA Cup","100"=>"English Premier","120"=>"Scottish Premier League","142"=>"Irish Premier League","143"=>"Irish Division One","104"=>"English Blue Square Premier","300"=>"English F A Cup","635"=>"Italian Serie A","637"=>"Italian Serie B","620"=>"French Ligue 1","621"=>"French Ligue 2","650"=>"Spanish Primera","652"=>"Spanish Segunda","625"=>"German Bundesliga One","626"=>"German Bundesliga Two","645"=>"Portuguese Superliga","875"=>"Greek Super League","656"=>"Slovakian Super Liga","606"=>"Bulgarian APFG","885"=>"Serbian Super Liga","641"=>"Polish Ekstraklasa","630"=>"Dutch Eredivisie","665"=>"Turkish Super Ligi","640"=>"Norwegian Tippeligaen","642"=>"Norwegian Adeccoligaen","600"=>"Austrian Bundesliga","605"=>"Belgian Jupiler","655"=>"Swedish Allsvenskan","610"=>"Danish S A S Ligaen","627"=>"Czech Gambrinus Liga","682"=>"Romanian Liga I","657"=>"Slovenian Prva Liga","666"=>"Ukrainian Premier League","647"=>"Russian Premier League","762"=>"U S A Major League","786"=>"Mexican Clausura","761"=>"Argentinian Clasura");
$lnameshow = $array[$oddspress_leaguename];

// Overridden settings
if ($options) {
	// Fix the template location if one was passed in.
	if (isset($options['template']) && !empty($options['template'])) {
		$options['template'] = ODDSPRESS_PLUGINDIR . '/templates/' . strtolower(str_replace(' ', '_', $options['template'])) . '.tmpl';
	}
	extract($options);
}

// If template doesn't exist, die.
if (!file_exists($template) || !is_readable($template)) {
	die('<p style="font-size:16px; line-height:1.5em; background-color:#c00; color:#fff; padding:10px; border:3px solid #f00; text-align:left;"><img src="' . ODDSPRESS_PLUGINDIR_WEB . '/images/error.png" /> The OddsPress template file is not readable by WordPress. Check the <a href="' . WP_CPANEL . '" style="color:#ff0; text-decoration:underline;">WordPress Control Panel</a> for more information.</p>');
}

// Initialize OddsPress
$feed = new SimplePie();
$feed->set_feed_url($feed_url);
$feed->enable_cache($enable_cache);
$feed->set_cache_location($set_cache_location);
$feed->set_cache_duration($set_cache_duration);
$feed->set_timeout($set_timeout);
$feed->init();
$feed->handle_content_type();
// Load up the selected template file
$handle = fopen($template, 'r');
$tmpl = fread($handle, filesize($template));
fclose($handle);

//If Items Found in Feed Process It
if ($feed->get_item_quantity() != 0) {

	/**************************************************************************************************************/
	// ERRORS
	// I'm absolutely sure that there is a better way to do this.

	// Define what we're looking for
	$error_start_tag = '{IF_ERROR_BEGIN}';
	$error_end_tag = '{IF_ERROR_END}';
	$error_start_length = strlen($error_start_tag);
	$error_end_length = strlen($error_end_tag);

	// Find what we're looking for
	$error_start_pos = strpos($tmpl, $error_start_tag);
	$error_end_pos = strpos($tmpl, $error_end_tag);
	$error_length_pos = $error_end_pos - $error_start_pos;

	// Grab what we're looking for
	$error_string = substr($tmpl, $error_start_pos + $error_start_length, $error_length_pos - $error_start_length);
	$replacable_string = $error_start_tag . $error_string . $error_end_tag;

	if ($error_message = $feed->error()) {
		$tmpl = str_replace($replacable_string, $error_string, $tmpl);
		$tmpl = str_replace('{ERROR_MESSAGE}', OddsPress_WordPress::post_process('ERROR_MESSAGE', $error_message), $tmpl);
	}elseif ($feed->get_item_quantity() == 0) {
		$tmpl = str_replace($replacable_string, $error_string, $tmpl);
		$tmpl = str_replace('{ERROR_MESSAGE}', OddsPress_WordPress::post_process('ERROR_MESSAGE', 'There are no items in this feed.'), $tmpl);
	}else{
		$tmpl = str_replace($replacable_string, '', $tmpl);
//START TO PROCESS THE FEED + TEMPLATE
//Feed Template Processing
	// FEED_PERMALINK
	if ($permalink = $feed->get_permalink()) {
		$tmpl = str_replace('{FEED_PERMALINK}', OddsPress_WordPress::post_process('FEED_PERMALINK', $permalink), $tmpl);
	}else{
		$tmpl = str_replace('{FEED_PERMALINK}', '', $tmpl);
	}

//XXXXXXXXXXXXXX
	/**************************************************************************************************************/
	// ITEMS

	// Separate out the pre-item template
	$tmpl = explode('{ITEM_LOOP_BEGIN}', $tmpl);
	$pre_tmpl = $tmpl[0];

	// Separate out the item template
	$tmpl = explode('{ITEM_LOOP_END}', $tmpl[1]);
	$item_tmpl = $tmpl[0];

	// Separate out the post-item template
	$post_tmpl = $tmpl[1];

	// Clear out the variable
	unset($tmpl);

	// Start putting the output string together.
	$tmpl = $pre_tmpl;

	// FEED_TITLE
	if ($title = $feed->get_title()) {
		//$tmpl = str_replace('{FEED_TITLE}', OddsPress_WordPress::post_process('FEED_TITLE', $title), $tmpl);
		$tmpl = str_replace('{ODDSPRESS_LEAGUE_NAME}', $lnameshow,  $tmpl);
	}else{
		$tmpl = str_replace('{FEED_TITLE}', '', $tmpl);
	}

//check dups
$checkit = "";
	// Loop through all of the items that we're supposed to.
	foreach ($feed->get_items(0, $items) as $item) {

		// Get a reference to the parent $feed object.
		$parent = $item->get_feed();

		// Get a working copy of the item template.  We don't want to edit the original.
		$working_item = $item_tmpl;

//Start to Check for Duplicates
$title = $item->get_title();
if ($checkit != md5($title)) {


		// ITEM_DATE
		if ($date = $item->get_date($date_format)) {
			$kickoff = explode("#",$date);
			$working_item = str_replace('{KICKOFF}', OddsPress_WordPress::post_process('KICKOFF', $kickoff[0]), $working_item);
		}else{
			$working_item = str_replace('{ITEM_DATE}', '', $working_item);
		}

		// ITEM_DESCRIPTION
		if ($description = $item->get_description()) {
			$odds = explode("#",$description);
			$working_item = str_replace('{ODDS_HOME}', OddsPress_WordPress::post_process('ODDS_HOME', $odds[0]), $working_item);
			$working_item = str_replace('{ODDS_DRAW}', OddsPress_WordPress::post_process('ODDS_DRAW', $odds[1]), $working_item);
			$working_item = str_replace('{ODDS_AWAY}', OddsPress_WordPress::post_process('ODDS_AWAY', $odds[2]), $working_item);
		}else{
			$working_item = str_replace('{ITEM_DESCRIPTION}', '', $working_item);
		}

		// ITEM_PERMALINK
		if ($permalink = $item->get_permalink()) {
			$working_item = str_replace('{ITEM_PERMALINK}', OddsPress_WordPress::post_process('ITEM_PERMALINK', $permalink), $working_item);
			$working_item = str_replace('{ITEM_PARTNERLINK}','&amp;aff='. $partner, $working_item);
		}else{
			$working_item = str_replace('{ITEM_PERMALINK}', '', $working_item);
		}

		// ITEM_TITLE
		if ($title = $item->get_title()) {
			$working_item = str_replace('{ITEM_TITLE}', OddsPress_WordPress::post_process('ITEM_TITLE', $title), $working_item);
		}else{
			$working_item = str_replace('{ITEM_TITLE}', '', $working_item);
		}
		$tmpl .= $working_item;
		//check for duplicates
		$checkit = md5($title);

//END DUP CHECK
}
	}
//End Foreach Loop Through Items

	//Last bit of processing before we finish
	// Start by removing all line breaks and tabs.
	$tmpl = preg_replace('/(\n|\r|\t)/i', "", $tmpl);
	$tmpl = str_replace(' - Winning Match With Tie','', $tmpl);


	// PLUGIN_DIR
	$tmpl = str_replace('{PLUGIN_DIR}', ODDSPRESS_PLUGINDIR_WEB, $tmpl);
	$tmpl .= $post_tmpl;

	// Kill the object to prevent memory leaks.
	$feed->__destruct();
	unset($feed);

	// Return the data back to the page.

	$text = str_replace($search, ''. $tmpl .'' ,$text);
//	$text = str_replace('[oddspress]', ''. $tmpl .'' ,$text);
	return $text;
//	return $tmpl;
//END PROCESS THE FEED + TEMPLATE
		}
	}else{

	$text = str_replace($search, ''. $lnameshow .' match betting is currently not available. Why not visit our <a href="http://www.willhill.com/?aff='. $partner .'">'.$lnameshow.' football betting</a> partner - William Hill?' ,$text);
	return $text;
	}
}

add_filter('the_content','OddsPressWP');
add_filter('the_excerpt', 'OddsPressWP');
?>