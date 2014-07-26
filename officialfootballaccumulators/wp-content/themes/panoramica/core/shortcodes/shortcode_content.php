<?php 
/* Recent Posts Shortcode */
if(!function_exists('cpotheme_shortcode_recentposts')){
	function cpotheme_shortcode_recentposts($atts, $content = null){
		$attributes = extract(shortcode_atts(array('number' => 5), $atts));
		if(!is_numeric($number)) $number = 5; elseif($number < 1) $number = 1; elseif($number > 99) $number = 99;
		
		$recent_posts = new WP_Query(array('posts_per_page' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1));
		if($recent_posts->have_posts()):
		$output = '<ul>';
		while($recent_posts->have_posts()): $recent_posts->the_post();
			$output .= '<li>';
			$output .= '<a href="'.get_permalink().'">'.get_the_title().'</a>';
			//$output .= get_the_time(get_option('date_format'));
			$output .= '</li>';
		endwhile;
		$output .= '</ul>';
		wp_reset_query();
		endif;
		
		return $output;
	}
	add_shortcode('recent_posts', 'cpotheme_shortcode_recentposts');
}

/* Portfolio Items Shortcode */
if(!function_exists('cpotheme_shortcode_portfolio')){
	function cpotheme_shortcode_portfolio($atts, $content = null){
		$attributes = extract(shortcode_atts(array('number' => 5), $atts));
		if(!is_numeric($number)) $number = 5; elseif($number < 1) $number = 1; elseif($number > 99) $number = 99;
		
		$recent_posts = new WP_Query(array('post_type' => 'cpo_portfolio', 'posts_per_page' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1));
		if($recent_posts->have_posts()):
		$output = '<ul>';
		while($recent_posts->have_posts()): $recent_posts->the_post();
			$output .= '<li>';
			$output .= '<a href="'.get_permalink().'">'.get_the_title().'</a>';
			$output .= '</li>';
		endwhile;
		$output .= '</ul>';
		wp_reset_query();
		endif;
		
		return $output;
	}
	add_shortcode('recent_portfolio', 'cpotheme_shortcode_portfolio');
}