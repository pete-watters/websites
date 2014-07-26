<?php get_header ();?>
                    	<div class="leftCol">
                            <!-- loop start-->
							<?php 
                            if (have_posts()) : 
                                $i=1;
                                while (have_posts()) : the_post(); 
                            ?>
                            <div class="post" id="post-<?php the_ID(); ?>">
                            	<div class="info_wrap">
                                    <h2 style="width:100%; float:none;"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                                </div>
                                <div class="post_content">
                                    <div class="clear"></div>
									<?php the_content('Read More')?>
                                    	
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <?php
								$i++; 
								endwhile; 
							else : 
							endif; ?>
                            
                        </div>
						<?php get_sidebar ();?>
<?php get_footer ();?>