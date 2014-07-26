<?php get_header ();?>
                    	<div class="leftCol">
                        	<div class="mainHeading">
                            	<?php /* If this is a home page */ if (is_home()) { ?>
                                <h3>Recent Posts</h3>
                                <?php /* If this is a category archive */ }elseif (is_category()) { ?>
                                <h3><?php single_cat_title(); ?></h3>
                                <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
                                <h3>Posts Tagged <span>&#8216;<?php single_tag_title(); ?>&#8217;</span></h3>
                                <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
                                <h3>Archive for <span><?php the_time('F jS, Y'); ?></span></h3>
                                <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
                                <h3>Archive for <span><?php the_time('F, Y'); ?></span></h3>
                                <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
                                <h3>Archive for <span><?php the_time('Y'); ?></span></h2>
                                <?php /* If this is an author archive */ } elseif (is_author()) { ?>
                                <h3>Author's <span>Archive</span></h2>
                                <?php /* If this is an author archive */ } elseif (is_search()) { ?>
                                <h3>Search Results for <span><?php the_search_query();?></span></h3>
                                <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                                <h3>Blog <span>Archives</span></h3>
                                <?php } ?>
                            </div>
                            
                            <!-- loop start-->
							<?php 
                            if (have_posts()) : 
                                $i=1;
                                while (have_posts()) : the_post(); 
                            ?>
                            <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
                            	<div class="info_wrap">
                                	<div class="dateImage">
                                    	<span class="dt"><?php the_time('d')?></span>
                                        <?php the_time('M')?>
                                    </div>
                                    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                                </div>
                                <div class="post_content">
                                	<?php if (show_post_image()):?>
                                	<div class="imagearea">
                                    	<div class="image">
                                        	<img src="<?php the_tab_image(190, 140);?>" width="190" height="140" alt="" />
                                        </div>
                                        <ul class="listInfo">
                                        	<li>Written by: <?php the_author_posts_link(); edit_post_link('Edit', ' | ', '');  ?></li>
                                            <li class="licomments">Comments: <?php comments_popup_link('N/A', '1', '%');?></li>
                                            <li class="liviews">Views: <?php echo get_post_meta($post->ID, 'post-counter', true);?></li>
                                        </ul>
                                    </div>
                                    <?php endif;?>
                                    <?php the_excerpt('Read More')?>
                                    <div class="clear"></div>
                          
                                    <?php if (!show_post_image()):?>
                                    	<ul class="listInfo listInfoFlt">
                                        	<li class="written"><?php the_author_posts_link(); edit_post_link('Edit', ' | ', '');  ?></li>
                                            <li class="licomments"><?php comments_popup_link('N/A', '1', '%');?></li>
                                            <li class="liviews"><?php echo get_post_meta($post->ID, 'post-counter', true);?></li>
                                            <li class="readmore"><a href="<?php the_permalink() ?>">Read More</a></li>
                                        </ul>
                                    <?php endif;?>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <?php
								$i++; 
								endwhile; 
							?>
                            <div class="navigations">
                            	<?php if (!function_exists("wp_pagenavi")):?>
                                <div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
                                <div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
                                <div class="clear"></div>
                                <?php 
								else:
									wp_pagenavi();
								endif;
								?>
                            </div>
                            <?php
							else : 
							endif; ?>
                            
                        </div>
						<?php get_sidebar ();?>
<?php get_footer ();?>