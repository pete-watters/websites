<?php 

/* Half Column Shortcode */
if(!function_exists('cpotheme_shortcode_column2')){
	function cpotheme_shortcode_column2($atts, $content = null){
		$content = $content;	
		return '<div class="column col2">'.wpautop(cpotheme_remove_autop($content)).'</div>';
	}
	add_shortcode('column_half', 'cpotheme_shortcode_column2');
}

/* Half Last Column Shortcode */
if(!function_exists('cpotheme_shortcode_column2_last')){
	function cpotheme_shortcode_column2_last($atts, $content = null){
		$content = $content;	
		return '<div class="column col2_last">'.wpautop(cpotheme_remove_autop($content)).'</div><div class="col_divide"></div>';
	}
	add_shortcode('column_half_last', 'cpotheme_shortcode_column2_last');
}

/* Third Column Shortcode */
if(!function_exists('cpotheme_shortcode_column3')){
	function cpotheme_shortcode_column3($atts, $content = null){
		$content = $content;	
		return '<div class="column col3">'.wpautop(cpotheme_remove_autop($content)).'</div>';
	}
	add_shortcode('column_third', 'cpotheme_shortcode_column3');
}

/* Third Last Column Shortcode */
if(!function_exists('cpotheme_shortcode_column3_last')){
	function cpotheme_shortcode_column3_last($atts, $content = null){
		$content = $content;	
		return '<div class="column col3_last">'.wpautop(cpotheme_remove_autop($content)).'</div><div class="col_divide"></div>';
	}
	add_shortcode('column_third_last', 'cpotheme_shortcode_column3_last');
}

/* Quarter Column Shortcode */
if(!function_exists('cpotheme_shortcode_column4')){
	function cpotheme_shortcode_column4($atts, $content = null){
		$content = $content;	
		return '<div class="column col4">'.wpautop(cpotheme_remove_autop($content)).'</div>';
	}
	add_shortcode('column_fourth', 'cpotheme_shortcode_column4');
}

/* Quarter Last Column Shortcode */
if(!function_exists('cpotheme_shortcode_column4_last')){
	function cpotheme_shortcode_column4_last($atts, $content = null){
		$content = $content;	
		return '<div class="column col4_last">'.wpautop(cpotheme_remove_autop($content)).'</div><div class="col_divide"></div>';
	}
	add_shortcode('column_fourth_last', 'cpotheme_shortcode_column4_last');
}

/* Quintet Column Shortcode */
if(!function_exists('cpotheme_shortcode_column5')){
	function cpotheme_shortcode_column5($atts, $content = null){
		$content = $content;	
		return '<div class="column col5">'.wpautop(cpotheme_remove_autop($content)).'</div>';
	}
	add_shortcode('column_fifth', 'cpotheme_shortcode_column5');
}

/* Quintet Last Column Shortcode */
if(!function_exists('cpotheme_shortcode_column5_last')){
	function cpotheme_shortcode_column5_last($atts, $content = null){
		$content = $content;	
		return '<div class="column col5_last">'.wpautop(cpotheme_remove_autop($content)).'</div><div class="col_divide"></div>';
	}
	add_shortcode('column_fifth_last', 'cpotheme_shortcode_column5_last');
}

/* Divider Shortcode */
if(!function_exists('cpotheme_shortcode_divide')){
	function cpotheme_shortcode_divide($atts, $content = null){
		return '<hr/>';
	}
	add_shortcode('divide', 'cpotheme_shortcode_divide');
}


/* Separator Shortcode */
if(!function_exists('cpotheme_shortcode_separator')){
	function cpotheme_shortcode_separator($atts, $content = null){
		$attributes = extract(shortcode_atts(array('type' => ''), $atts));
		$content = trim(strip_tags($content));
		
		$output = '<div class="pageseparator">';
		$output .= '<div class="line"></div>';
		if($type == 'top')
			$output .= '<a class="top" href="#top"></a>';
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode('separator', 'cpotheme_shortcode_separator');
}

/* Clearing Shortcode */
if(!function_exists('cpotheme_shortcode_clear')){
	function cpotheme_shortcode_clear($atts, $content = null){
		return '<div style="clear:both;width:100%;"></div>';
	}
	add_shortcode('clear', 'cpotheme_shortcode_clear');
}