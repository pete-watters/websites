<?php 

function cpotheme_styling(){
	
	//Background styling
	$bg_color = cpotheme_get_option('cpo_bg_color');
	$bg_texture = cpotheme_get_option('cpo_bg_texture');
	$texture_file = '';
	switch($bg_texture){
		case 'dots': $texture_file = get_template_directory_uri().'/images/bg_texture_dots.png'; break;
		case 'diagonal': $texture_file = get_template_directory_uri().'/images/bg_texture_diagonal.png'; break;
		case 'bubbles': $texture_file = get_template_directory_uri().'/images/bg_texture_bubbles.png'; break;
		case 'diamonds': $texture_file = get_template_directory_uri().'/images/bg_texture_diamonds.png'; break;
		case 'stripes': $texture_file = get_template_directory_uri().'/images/bg_texture_stripes.png'; break;
		case 'grid': $texture_file = get_template_directory_uri().'/images/bg_texture_grid.png'; break;
		case 'metal': $texture_file = get_template_directory_uri().'/images/bg_texture_metal.png'; break;
		case 'stone': $texture_file = get_template_directory_uri().'/images/bg_texture_stone.png'; break;
		case 'checkerboard': $texture_file = get_template_directory_uri().'/images/bg_texture_checkerboard.png'; break;
	} ?>
	<style type="text/css">
		.wrapper {
			<?php if($texture_file != ''): ?>
			background-image:url(<?php echo $texture_file; ?>);
			<?php endif; ?>
			<?php if($bg_color != ''): ?>
			background-color:<?php echo $bg_color; ?>; 
			<?php endif; ?>
		}
    </style>
	<?php
}