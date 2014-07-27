<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.jparallax.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#parallax').jparallax({});
});
</script>

<div id="parallax">
	<div style="width: 1000px; height: 300px;">
		<img alt="" src="<?php bloginfo('template_url'); ?>/images/sky.jpg"/>
	</div>
	<div style="width: 700px; height: 300px;">
		<img style="position:absolute; top:20px; left:100px;" alt="" src="<?php bloginfo('template_url'); ?>/images/cloud2.png"/>
	</div>
	<div style="width: 400px; height: 300px;">
		<img style="position:absolute; top:20px; left:600px;" alt="" src="<?php bloginfo('template_url'); ?>/images/cloud2.png"/>
	</div>
	<div style="width: 980px; height: 300px;">
		<img style="position:absolute; top:0px; left:780px;" alt="" src="<?php bloginfo('template_url'); ?>/images/sun.png"/>
	</div>
	<div style="width: 500px; height: 300px;">
		<img style="position:absolute; top:10px; left:300px;" alt="" src="<?php bloginfo('template_url'); ?>/images/cloud.png"/>
	</div>
	<div style="width: 990px; height: 300px;">
		<img style="position:absolute; top:90px; left:400px;" alt="" src="<?php bloginfo('template_url'); ?>/images/treefar.png"/>
	</div>
	<div style="width: 950px; height: 295px;">
		<img style="position:absolute; top:170px; left:100px;" alt="" src="<?php bloginfo('template_url'); ?>/images/flower1.png"/>
	</div>
	<div style="width: 500px; height: 280px;">
		<img style="position:absolute; top:180px; left:-10px;" alt="" src="<?php bloginfo('template_url'); ?>/images/snake.png"/>
	</div>
	<div style="width: 1500px; height: 290px;">
		<img style="position:absolute; top:220px; left:800px;" alt="" src="<?php bloginfo('template_url'); ?>/images/snail.png"/>
	</div>
	<div style="width: 1000px; height: 300px;">
		<a href="<?php echo get_option('home'); ?>/"><img style="position:absolute; top:50px; left:30px;" alt="<?php bloginfo('name'); ?>" src="<?php bloginfo('template_url'); ?>/images/board.png"/></a>
	</div>
	<div style="width: 1000px; height: 300px;">
		<?
/* This code retrieves admin options. */
global $options;
foreach ($options as $value) {
	if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>

<? if ($prlx_logo == "true") { ?>

   <a href="<?php echo get_option('home'); ?>/"><img style="position:absolute; top:50px; left:30px;" src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>"/> </a> 
    
<? } else { ?>

<a href="<?php echo get_option('home'); ?>/"><h1 class="main"><?php bloginfo('name'); ?></h1> </a> 

<? } ?>
	</div>
	<div style="width: 3000px; height: 200px;">
		<img style="position:absolute; top:10px; left:2000px;" alt="" src="<?php bloginfo('template_url'); ?>/images/bird.png"/>
	</div>
	<div style="width: 1250px; height: 300px;">
		<img style="position:absolute; top:199px; left:-100px;" alt="" src="<?php bloginfo('template_url'); ?>/images/grass.png"/>
	</div>
	<div style="width: 1000px; height: 300px;">
		<img style="position:absolute; top:0px; left:0px;" alt="" src="<?php bloginfo('template_url'); ?>/images/over.png"/>
	</div>
	
</div>

