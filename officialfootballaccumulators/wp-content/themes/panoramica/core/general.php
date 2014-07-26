<?php

//Displays the blog title and descripion in home or frontpage
function cpotheme_title(){
	global $post, $page, $paged;
	$title = '';
	if(cpotheme_get_option('cpo_seo_global') == '1'){
		if(is_home() || is_front_page())
			$title = cpotheme_get_option('cpo_general_title');
		else
			$title = get_post_meta($post->ID, 'seo_title', true);
		if($title != '') echo $title;
	}
	
	//Default to normal titles if SEO titles are blank or turned off
	if($title == ''){
		$separator = '';
		if(cpotheme_get_option('cpo_seo_global') == '1')
			$separator = cpotheme_get_option('cpo_title_separator');
		if($separator == '') $separator = '|';
		wp_title($separator, true, 'right');
		bloginfo('name');
		$site_description = get_bloginfo('description', 'display');
		if($site_description && (is_home() || is_front_page()))
			echo ' '.$separator.' '.$site_description;
	
		// Page numbers
		if($paged >= 2 || $page >= 2) echo ' | '.sprintf( __('Page %s', 'cpotheme'), max($paged, $page));
	}
}

//Display the meta description
function cpotheme_description(){
	global $post;
	$description = '';
	//Check if SEO is enabled
	if(cpotheme_get_option('cpo_seo_global') == '1'){
		if(is_home() || is_front_page()){
			//Check for the homepage value
			$description = cpotheme_get_option('cpo_general_description');
			
			//If not, resort to default values
			if($description == '') 
				$description = cpotheme_get_option('cpo_default_description');
		}else{
			//Check whether custom SEO for individual pages is enabled
			$description = get_post_meta($post->ID, 'seo_description', true);
			
			//If not, resort to default values
			if($description == '')
				$description = cpotheme_get_option('cpo_default_description');
		}
		if($description != '') echo '<meta name="description" content="'.$description.'" />';
	}
}

//Display custom favicon
function cpotheme_favicon(){
	$favicon_url = cpotheme_get_option('cpo_general_favicon');
	if($favicon_url != '')
    	echo '<link type="image/x-icon" href="'.esc_url($favicon_url).'" rel="icon" />';
}

//Display meta keywords
function cpotheme_keywords(){
	global $post;
	$keywords = '';
	//Check if SEO is enabled
	if(cpotheme_get_option('cpo_seo_global') == '1'){
		if(is_home() || is_front_page()){
			//Check for the homepage value
			$keywords = cpotheme_get_option('cpo_general_keywords');
			
			//If not, resort to default values
			if($keywords == '') 
				$keywords = cpotheme_get_option('cpo_default_keywords');
		}else{
			//Check whether custom SEO for individual pages is enabled
			$keywords = get_post_meta($post->ID, 'seo_keywords', true);
			
			//If not, resort to default values
			if($keywords == '')
				$keywords = cpotheme_get_option('cpo_default_keywords');
		}
		if($keywords != '') echo '<meta name="keywords" content="'.$keywords.'" />';
	}
}

//Display custom fonts
function cpotheme_fonts($font_name){	
	$font_list = array(
	'alegreya' => 'Alegreya',
	'asap' => 'Asap',
	'bree_serif' => 'Bree Serif',
	'cinzel' => 'Cinzel',
	'dancing_script' => 'Dancing Script',
	'droid_sans' => 'Droid Sans',
	'imprima' => 'Imprima',
	'great_vibes' => 'Great Vibes',
	'gudea' => 'Gudea',
	'lobster' => 'Lobster',
	'oleo_script' => 'Oleo Script',
	'oxygen' => 'Oxygen',
	'quattrocento' => 'Quattrocento',
	'raleway' => 'Raleway',
	'sorts_mill_goudy' => 'Sorts Mill Goudy',
	'yanone_kaffeesatz' => 'Yanone Kaffeesatz',
	'coming_soon' => 'Coming+Soon',
	'condiment' => 'Condiment',
	'petit_formal_script' => 'Petit+Formal+Script',
	'marko_one' => 'Marko+One',
	'radley' => 'Radley',
	'anaheim' => 'Anaheim',
	'strait' => 'Strait',
	'julius_sans_one' => 'Julius+Sans+One',
	'orienta' => 'Orienta',
	'abeezee' => 'ABeeZee',
	'arbutus_slab' => 'Arbutus+Slab',
	'sofadi_one' => 'Sofadi+One',
	'paprika' => 'Paprika');
	
	if(isset($font_list[$font_name]))
		echo '<link href="http://fonts.googleapis.com/css?family='.$font_list[$font_name].'" rel="stylesheet" type="text/css">';
}

//Outputs font names as used in the CSS
function cpotheme_fonts_css($font_name){	
	$font_list = array(
	'alegreya' => "'Alegreya'",
	'arial' => "Arial",
	'asap' => "'Asap'",
	'bree_serif' => "'Bree Serif'",
	'cinzel' => "'Cinzel'",
	'dancing_script' => "'Dancing Script'",
	'droid_sans' => "'Droid Sans'",
	'imprima' => "'Imprima'",
	'georgia' => "Georgia",
	'great_vibes' => "'Great Vibes'",
	'gudea' => "'Gudea'",
	'lobster' => "'Lobster'",
	'oleo_script' => "'Oleo Script'",
	'oxygen' => "'Oxygen'",
	'quattrocento' => "'Quattrocento'",
	'raleway' => "'Raleway'",
	'sorts_mill_goudy' => "'Sorts Mill Goudy'",
	'times_new_roman' => "Times New Roman",
	'verdana' => "Verdana",
	'yanone_kaffeesatz' => "'Yanone Kaffeesatz'",
	'coming_soon' => "'Coming Soon'",
	'condiment' => "'Condiment'",
	'petit_formal_script' => "'Petit Formal Script'",
	'marko_one' => "'Marko One'",
	'radley' => "'Radley'",
	'anaheim' => "'Anaheim'",
	'strait' => "'Strait'",
	'julius_sans_one' => "'Julius Sans One'",
	'orienta' => "'Orienta'",
	'abeezee' => "'ABeeZee'",
	'arbutus_slab' => "'Arbutus Slab'",
	'sofadi_one' => "'Sofadi One'",
	'paprika' => "'Paprika'");
	
	if(isset($font_list[$font_name]))
		return $font_list[$font_name];
	else
		return false;
}


//Adds custom analytics code in the footer
add_action('wp_footer','cpotheme_layout_analytics');
function cpotheme_layout_analytics(){
	$output = cpotheme_get_option('cpo_general_analytics');
	$output = stripslashes($output);
	echo $output;
}

//Adds custom javascript code in the footer
add_action('wp_footer','cpotheme_layout_js');
function cpotheme_layout_js(){
	$output = cpotheme_get_option('cpo_general_js');
	if($output != ''){
		$output = '<script type="text/javascript">'.stripslashes($output).'</script>';
		echo $output;
	}
}

//Adds custom javascript code in the footer
add_action('wp_head','cpotheme_layout_css');
function cpotheme_layout_css(){
	$output = cpotheme_get_option('cpo_general_css');
	if($output != ''){
		$output = '<style type="text/css">'.stripslashes($output).'</style>';
		echo $output;
	}
}

//Abstracted function for retrieving specific options inside option arrays
function cpotheme_get_option($option_name = '') {
	$option_list = get_option('cpotheme_settings', false);
	if($option_list && isset($option_list[$option_name]))
		$option_value = $option_list[$option_name];
	else
		$option_value = false;
	return $option_value;
}

//Abstracted function for updating specific options inside arrays
function cpotheme_update_option($option_name, $option_value){
	$option_list = get_option('cpotheme_settings', false);
	if(!$option_list)
		$option_list = array();
	$option_list[$option_name] = $option_value;
	if(update_option('cpotheme_settings', $option_list))
		return true;
	else
		return false;
}

//Removes automatic paragraphs
function cpotheme_remove_autop($content){ 
	$content = do_shortcode(shortcode_unautop($content)); 
	$content = preg_replace('#^<\/p>|^<br\s?\/?>|<p>$|<p>\s*(&nbsp;)?\s*<\/p>#', '', $content);
	return $content;
}
