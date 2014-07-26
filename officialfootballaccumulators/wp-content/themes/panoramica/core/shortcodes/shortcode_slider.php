<?php 

/* Slideshow Wrapper Shortcode */
if(!function_exists('cpotheme_shortcode_slideshow')){
	function cpotheme_shortcode_slideshow($atts, $content = null){
		$content = trim($content);
		$output = '<div class="inline_slider">';
		$output .= do_shortcode($content);
		//$output .= '<div class="pages"></div>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode('slideshow', 'cpotheme_shortcode_slideshow');
}

/* Slides Shortcode */
if(!function_exists('cpotheme_shortcode_slide')){
	function cpotheme_shortcode_slide($atts, $content = null){
		$content = trim($content);
		return '<div class="slide">'.do_shortcode($content).'</div>';
	}
	add_shortcode('slide', 'cpotheme_shortcode_slide');
}