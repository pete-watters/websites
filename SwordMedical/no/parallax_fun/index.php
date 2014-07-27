<?php wp_get_header(); ?>

<div id="content">

	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

<div class="solopost">

				
<h2 class="title">
<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>


<div class="postmeta">

Published on <span class="date"><?php the_time('j M')?></span> by <span class="user"><?php the_author_posts_link(); ?></span> with  <span class="com"><?php comments_popup_link('0 replies', '1 reply', '% replies'); ?></span><br/>
in <span class="categ"><?php the_category(' &bull; '); ?></span>


</div>

</div></div>


		<?php endwhile; ?>
		
	<?php else : ?>
<div class="post">
<div id="pagepost">
<div id="ask">
<h1> Nothing Found...</h1>

<?php include(TEMPLATEPATH."/src_form.php");?>
</div>


<div id="archive">
<?php include(TEMPLATEPATH."/archives.php");?>
</div>

</div>

</div>
      	<?php endif; ?>

</div>
<?php get_sidebar();?>

<div class="navigation">

<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } 
			else { ?>

			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
				<?php } ?>

		</div>
</div>
<?php wp_get_footer(); ?>