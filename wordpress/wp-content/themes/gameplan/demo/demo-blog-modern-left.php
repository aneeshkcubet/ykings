<?php
/**
 * Template Name: Demo Blog Modern Left sidebar
 */
get_header();
wp_enqueue_script( 'jquery-isotope');
?>
<div class="bg-container"> 
    <div class="body-top-color"><!----></div>
    <div class="background-color"><!---->
    </div>    
	<div id="main-body">
		<div class="container">
        	<div class="container-pad">
                <div class="row-fluid revert-layout">
                    <div class="span9">

                        <!--BEGIN Blog -->
                    <?php
                    if(1)
                    {
                    ?>
                    	<div class="blog-listing blog-listing-modern">
                            <?php 
								$paged = get_query_var('paged')?get_query_var('paged'):1;
								query_posts( 'post_type="post"&paged='.$paged );
								if ( have_posts() ) :  	
                                // get some options
                                	while ( have_posts() ) : the_post();
										$sticky_tag = get_post_meta(get_the_ID(),'sticky_tag',true);
									?>
                                    <div class="item">
                                      <div class="article">
                                        <div class="article-bg">
                                          <div class="article-content">
                                            <?php if(has_post_thumbnail()){?>
                                            <div class="span12 imge">
                                              <div class="rt-image">
                                                <a href="<?php the_permalink();?>" title="<?php echo get_the_title();?>"><?php echo get_the_post_thumbnail(get_the_ID(), 'thumb_360x240', array('alt' => get_the_title()));?></a>
                                              </div>
                                              
                                            </div>
                                            <?php }?>
                                            <div class="span12 modern_style">
                                              <div class="rt-headline">
                                                <h3 class="rt-article-title"> <a href="<?php the_permalink();?>"><?php echo get_the_title();?></a><?php if($sticky_tag){?>
                                                <i class="bookmark">
                                                <?php
                                                    echo $sticky_tag;
                                                ?>
                                                </i><?php }?></h3>
                                              </div>
                                              <div class="dotted"><div class="inner"></div></div>
                                              <div class="rt-articleinfo">                                         
                                                <!-- Begin Date & Time -->
                                                <?php 
												$show_authorblog= ot_get_option('blog_show_author');
												if($show_authorblog=='1'|| $show_authorblog=='')
												{
													$author_cut= get_the_author();
													$demsl= strlen($author_cut);
													if($demsl>13){
														$author_cut = substr($author_cut,0,12) ;
														?>
                                                    	<span class="rt-date-posted"><span class="icon-user"><?php echo $author_cut;?>...</span></span> 	
													<?php }else{ ?>
														<span class="rt-date-posted"><span class="icon-user"><?php echo $author_cut;?></span></span> 	
													<?php }?>
                                                <!-- End Date & Time -->                                         
                                                <!-- Begin Comments -->                                        
                                                 <?php }
												$show_dateblog= ot_get_option('blog_show_date');
												if($show_dateblog=='1'|| $show_dateblog=='')
												{
												?>
                                                |
                                                	<span class="rt-date-posted"><span class="icon-calendar"><?php echo get_the_date();?></span></span> 
                                                <!-- End Date & Time -->                                         
                                                <!-- Begin Comments -->                                        
                                                  <?php }
												$show_cmblog= ot_get_option('blog_show_comment_number');
												if($show_cmblog=='1'|| $show_cmblog=='')
												{
												 ?>
                                                <div class="rt-comment-block "> 
                                                  <a href="<?php comments_link(); ?>" class="rt-comment-text"> <span class="icon-comments"><?php echo get_comments_number(get_the_ID()) . ' ' . esc_html__('comments','cactusthemes');?></span> </a> 
                                                </div> 
                                                <?php }?>                                       
                                                <!-- End Comments -->                                         

                                              </div>
                                              <div class="recentpost-content">
                                                <?php echo strip_tags(get_the_excerpt());?>
                                              </div>
                                                 <?php 
												$show_tagblog= ot_get_option('blog_show_tag');
												if($show_tagblog=='1')
												{
													$posttags = get_the_tags();
													if ($posttags) {?>
													  <div class="post-tags">
														<i class="icon-tags"></i>
														<?php
															$i = 0;
														  foreach($posttags as $tag) {
															echo 
															'<a title="'.$tag->name.'" href="' . get_tag_link($tag->term_id) .'">'.$tag->name . '</a>';
															if($i < count($posttags) - 1) echo ', '; 
															$i++;
														  }
														?>
													  </div>
												  	<?php } }?>
                                            </div>
                                            <!-- end post wrap -->
                                            <div class="clear"><!-- --></div>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- end article -->
                                      </div>
                                    <!--<div class="double-dotted"><div class="inner"></div></div>-->
                                <?php endwhile; ?>
                            <?php endif; ?>
                    </div>
                    <script>
					jQuery(document).ready(function(e) {
//                        var container = document.querySelector('.blog-listing');
//						var msnry = new Masonry( container, {
//						  // options
//						  columnWidth:289,
//						  itemSelector: '.item',
//						  "gutter": 1
//						});
//                    });
					jQuery(function(){
					  
					  var container = jQuery('.blog-listing');
					  
					  jQuery(container).isotope({
						itemSelector: '.item'
					  });
					  
					});
					});
					</script>
                        
                    <?php 
					}
					?>					
 
                        <!-- END Blog -->
					<?php 
						$pagination = ot_get_option('pagination');
						if(!isset($pagination) || $pagination == 'default' || !function_exists('wp_pagenavi')){
							cactusthemes_content_nav('paging');
						} else {
							wp_pagenavi();
						}
					?>
                    </div>
                    <div class="span3">
                        <div id="mainsidebar">
							<?php if(is_active_sidebar('blog_sidebar')) {
                                echo get_dynamic_sidebar('blog_sidebar');
                                }else{
                                echo get_dynamic_sidebar('main_sidebar');
                                }?>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>	
	<?php get_template_part( 'body', 'bottom' ); // load body-bottom.php ?>
	<?php get_template_part( 'main', 'bottom' ); // load main-bottom.php ?>
</div>
<?php get_footer(); ?>