<?php

$wp_include = "../wp-load.php";
$i = 0;
while (!file_exists($wp_include) && $i++ < 10) {
  $wp_include = "../$wp_include";
}

// let's load WordPress
require($wp_include);

if ( !is_user_logged_in() || !current_user_can('edit_posts') ) 
	wp_die(__("You are not allowed to be here"));
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SLIDESHOW</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/lib/admin/tinymceSlideshow/tinymce.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_bloginfo('template_url') ?>/lib/admin/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_bloginfo('template_url') ?>/lib/admin/js/script.js"></script>
<style type="text/css">
fieldset { margin:16px 0; padding:10px; }
legend, label, select, input[type=text] { font-size:11px; }
select, input[type=text] { line-height:24px; height:24px; float:left; width:300px }

#tabnav {list-style:none; margin:0; padding:0;  float:left; }
#tabnav li{float:left; clear:none; margin: 0 -1px 0 0px;}
#tabnav li a{display:inline; padding:6px 8px;  float:left; clear:none; text-decoration:none; 
color:#333;  border:1px solid #ddd;
}
#tabnav li.active a{display:inline; padding:6px 8px; background:#f9f9f9; float:left; clear:none; 
color:#333; border:1px solid #ddd; font-weight:bold;}
.form-wrap{padding:10px; border:1px solid #ddd; float:left; background:#f9f9f9; margin-top:-1px;}

</style>
</head>
<body id="link" onLoad="tinyMCEPopup.executeOnLoad('init();');">
<ul id="tabnav">
	<li><a href="#tab1">Cycle slider</a></li>
	<li><a href="#tab1">Accordion slider</a></li>
	<li><a href="#tab1">Nivo slider</a></li>
</ul>
<div class="form-wrap">
<form name="phi_slideshow" action="#">
			<div class="tabcontent" id="tab1">
			<fieldset>
						<legend>Slideshow type</legend>
						<select id="slideshow_type" name="slideshow_type">
									<option value="0">None</option>
									<option value="accordion">Accordion</option>
									<option value="cycle">Cycle</option>
									
						</select>
			</fieldset>
						<fieldset>
						<legend>Slideshow category</legend>
						<select id="slideshow_category" name="slideshow_category">
									<?php
						
						$myterms = get_terms('slidecategory');
$phi_getTerms = array();
foreach ($myterms as $term_list) {
	$phi_getTerms [$term_list->term_id] = $term_list->name;
	echo ' <option value="'.$term_list->term_id.'">'.$term_list->name.'</option>';
	}
	?>
						</select>
			</fieldset>
			</div>
			
			<div class="tabcontent" id="tab2">
			<fieldset>
						<legend>Accordion type</legend>
						<select id="slideshow_type" name="slideshow_type">
									<option value="0">None</option>
									<option value="accordion">Accordion</option>
									<option value="cycle">Cycle</option>
									
						</select>
			</fieldset>
						<fieldset>
						<legend>Slideshow category</legend>
						<select id="slideshow_category" name="slideshow_category">
									<?php
						
						$myterms = get_terms('slidecategory');
$phi_getTerms = array();
foreach ($myterms as $term_list) {
	$phi_getTerms [$term_list->term_id] = $term_list->name;
	echo ' <option value="'.$term_list->term_id.'">'.$term_list->name.'</option>';
	}
	?>
						</select>
			</fieldset>
			</div>
			
			<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px; width:auto; height:auto;"/>
			<input type="submit" id="insert" name="insert" value="Insert shortcode" onClick="insertSlideshowShortcode();" style="float:right; padding:10px; width:auto; height:auto;"/>
</form>
</div>
</body>
</html>
