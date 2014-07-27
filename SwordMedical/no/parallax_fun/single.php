<?php wp_get_header();?>

	<div id="content">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

<div class="solopost">

				
<h2 class="title">
<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>


<div class="postmeta">

Published on <span class="date"><?php the_time('j M')?></span> by <span class="user"><?php the_author_posts_link(); ?></span> with  <span class="com"><?php comments_popup_link('0 replies', '1 reply', '% replies'); ?></span><br/>
in <span class="categ"><?php the_category(' &bull; '); ?></span>


</div>

</div></div></div>

<?php get_sidebar();?>

<div id="replies">
	<?php comments_template(); ?>
</div>

	<?php endwhile; else: ?>
	    <?php include(TEMPLATEPATH."/404.php");?>
      <?php endif; ?>


</div>
<?php wp_get_footer(); ?>