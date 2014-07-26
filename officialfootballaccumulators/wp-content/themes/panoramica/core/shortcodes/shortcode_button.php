<?php 

/* Button Shortcode */
if(!function_exists('cpotheme_shortcode_button')){
	function cpotheme_shortcode_button($atts, $content = null){
		$attributes = extract(shortcode_atts(array(
			'url' => '',
			'size' => '',
			'color' => ''
			), 
			$atts));
		
		$content = trim(strip_tags($content));
		$url = htmlentities($url);
		
		$size = trim(strip_tags($size));
		switch($size){
			case 'small': $button_size = 'button_small'; break;
			case 'medium': $button_size = 'button_medium'; break;
			case 'large': $button_size = 'button_large'; break;
			default: $button_size = ''; break;
		}
		switch($color){
			case 'red': $button_color = ' button_red'; break;
			case 'blue': $button_color = ' button_blue'; break;
			case 'green': $button_color = ' button_green'; break;
			case 'gray': $button_color = ' button_gray'; break;
			case 'pink': $button_color = ' button_pink'; break;
			case 'orange': $button_color = ' button_orange'; break;
			case 'purple': $button_color = ' button_purple'; break;
			case 'teal': $button_color = ' button_teal'; break;
			case 'yellow': $button_color = ' button_yellow'; break;
			case 'black': $button_color = ' button_black'; break;
			case 'white': $button_color = ' button_white'; break;
			default: $button_color = ''; break;
		}
		return '<a class="button '.$button_size.$button_color.'" href="'.$url.'">'.$content.'</a>';
	}
	add_shortcode('button', 'cpotheme_shortcode_button');
}