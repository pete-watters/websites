<?php 

/* Accordion Shortcode */
if(!function_exists('cpotheme_shortcode_accordion')){
	function cpotheme_shortcode_accordion($atts, $content = null){
		$attributes = extract(shortcode_atts(array(
			'title' => '(No Title)', 
			'state' => ''),
			$atts));
		
		$content = trim($content);
		$title = trim(htmlentities(strip_tags($title)));
		
		$output = '<div class="accordion">';
		$output .= '<h4 class="accordion_title">'.$title.'</h4>';
		$output .= '<div class="accordion_content"';
		if($state != 'open')
			$output .= ' style="display:none;"';
		$output .= '>'.wpautop(cpotheme_remove_autop($content)).'</div>';
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode('accordion', 'cpotheme_shortcode_accordion');
}

/* Tabs Wrapper Shortcode */
if(!function_exists('cpotheme_shortcode_tab_wrapper')){
	function cpotheme_shortcode_tab_wrapper($atts, $content = null){
		$content = trim($content);
		$output = '<div class="tabs">';
		$output .= do_shortcode($content);
		$output .= '</div>';
		return $output;
	}
	add_shortcode('tabs', 'cpotheme_shortcode_tab_wrapper');
}

/* Tabs Shortcode */
if(!function_exists('cpotheme_shortcode_tab')){
	function cpotheme_shortcode_tab($atts, $content = null){
		$attributes = extract(shortcode_atts(array('title' => '(No Title)'), $atts));
		$content = trim($content);
		$title = trim(htmlentities(strip_tags($title)));
		
		$output = '<div class="tab_title">'.$title.'</div>';
		$output .= '<div class="tab_content">'.do_shortcode($content).'</div>';
		return $output;
	}
	add_shortcode('tab', 'cpotheme_shortcode_tab');
}