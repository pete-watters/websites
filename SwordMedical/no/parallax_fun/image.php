<?php wp_get_header();?>


	<div id="content">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">

<div class="solopost">


            <h2 class="title"><a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><?php echo get_the_title($post->post_parent); ?></a> &raquo; <?php the_title(); ?></h2>
        
  

				<p class="attachment"><a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php echo wp_get_attachment_image( $post->ID, 'medium' ); ?></a></p>
				<div class="caption"><?php if ( !empty($post->post_excerpt) ) the_excerpt(); // this is the "caption" ?></div>
				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
				<div class="navigation">
					<div class="alignleft"><?php previous_image_link() ?></div>
					<div class="alignright"><?php next_image_link() ?></div>
				</div>
				<br class="clear" />
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