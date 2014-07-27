<div id="sidebar">

<ul>

<li>
<div class="side">
<form style="padding: 20px 0 20px 40px;background: url(<?php bloginfo('template_url'); ?>/images/clds.png) top repeat-x;" method="get" action="<?php bloginfo('url'); ?>/">
  <input type="text" value="<?php the_search_query(); ?>" name="s" id="searchform" size="70%" class="input_text" />
  <input type="submit" id="glass" value="<?php _e(''); ?>" />
</form> 
</div>
</li>

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>


<li>
<div class="side">
<h2>Recent Posts</h2>
			<ul>
				<?php wp_get_archives('type=postbypost&limit=10'); ?>
			</ul>

</div>
		</li>


<li>
<div class="side">
<h2>Categories</h2>
<ul>
				<?php wp_list_categories('sort_column=name&title_li=&depth=2'); ?>
			</ul>

</div>
		</li>

<li>
<div class="side">
<h2>Archives</h2>

			<ul>
				<?php wp_get_archives('type=monthly'); ?>
			</ul>

</div>
		</li>

<li>
<div class="side">
<h2>Blogroll</h2>

			<ul>
				<?php wp_list_bookmarks('title_li=&categorize=0'); ?>
			</ul>

</div>
		</li>
		<li>
<div class="side">
<h2>Meta</h2>

			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				
			</ul>
</div>

		</li>


<?php endif; ?>

</ul>
		
</div>