<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-1.4.js"></script>

<script src="<?php bloginfo('template_url'); ?>/js/jquery.easing.1.3.js" type="text/javascript"></script>

<script src="<?php bloginfo('template_url'); ?>/js/animated-menu.js" type="text/javascript"></script>

<div id="menuwrap">


<ul id="menu">

 <li class="home"><a href="<?php echo get_settings('home'); ?>">Home</a></li>
			<?php wp_list_pages('title_li=&depth=1&sort_column=menu_order'); ?>


<li class="rss">
<a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/hover.gif" alt="rss" /></a></li>

</ul>
</div>





	