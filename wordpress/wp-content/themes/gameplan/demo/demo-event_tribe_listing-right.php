<?php
/**
 * Template Name: Demo Event Tribe Listing Classic Right Sidebar
 */

get_header(); ?>
<div class="bg-container"> 
    <div class="body-top-color"><!----></div>
    <div class="background-color"><!----></div>    
	<div id="main-body">
		<div class="container">
        	<div class="container-pad">
                <div class="row-fluid">
                    <div class="span9">
                        <!--BEGIN Blog -->
                        <div class="blog-listing event_listing">
                            <?php 
							$bp = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $args = array(
                                'post_type' => 'tribe_events',
                                'posts_per_page' => get_option('posts_per_page'),
                                'orderby' => '',
								'paged' => $bp,
                                'post_status' => 'publish',
                            );	
							$dt = get_option('date_format');
                            $the_query = new WP_Query( $args );
                            if ( $the_query->have_posts() ) : 
                                 while ( $the_query->have_posts() ) : $the_query->the_post(); 
                                    $fields = get_post_custom_keys(get_the_ID());
                                    $values = get_post_custom(get_the_ID());
                                    $start_day = new DateTime($values['_EventStartDate'][0]);
									$dt = get_option('date_format');
									//$start_day = $start_day->format($dt);
                                    //var_dump($fields);
                                    ?>
                                      <div class="article">
                                        <div class="article-bg">
                                          <div class="article-content">
												<div class="row-fluid">
													<?php $righttoleft= ot_get_option('righttoleft');
													if(has_post_thumbnail()){
													if($righttoleft=='' || $righttoleft==0)	{
													$side_bar_blog_right = 'full';
													if($side_bar_blog_right == 'full'){
														$thumb = 'thumb_467x9999';
													} else {
														$thumb = 'thumb_360x240';
													}
													?>
													<div class="span5">
													  <div class="rt-image">
														<a href="<?php the_permalink();?>" title="<?php echo get_the_title();?>"><?php echo get_the_post_thumbnail(get_the_ID(), 'thumb_360x240', array('alt' => get_the_title()));?></a>
													  </div>
													</div>
													<?php }}?>
													<div class="span<?php echo (!has_post_thumbnail() ? "12":"7") ?>">
														<div class="post-wrap">
															  <div class="rt-headline">
																<h3 class="rt-article-title"> 
																	<a href="<?php the_permalink();?>"><?php echo get_the_title();?></a>
																</h3>
															  </div>                                          
													  
															  <div class="custom-pot-1">  
															  <?php 
																$event_show_big_date_text= ot_get_option('event_show_big_date_text');
																if($event_show_big_date_text=='1'|| $event_show_big_date_text=='')
																{
																?>
																<div class="date-counter">
																<?php echo tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = "d")?>
                                                                <span><?php echo tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = "M")?></span>
																</div>
															  <?php } 
																$event_show_start_time= ot_get_option('event_show_start_time');
																if($event_show_start_time=='1'|| $event_show_start_time=='')
																{
																?>
																<span><?php echo tribe_get_start_date( $event = null, $displayTime = true, $dateFormat = $dt) ; echo ' - '; echo tribe_get_end_date($event = null, $displayTime = true, $dateFormat = $dt); ?></span> 
																<?php }
																$event_show_location= ot_get_option('event_show_location');
																if($event_show_location=='1'|| $event_show_location=='')
																{	
																?>
																<span class="mapgg"><?php echo tribe_get_venue( get_the_ID()); echo ' , '; echo tribe_get_address( get_the_ID());echo ' , ';   echo tribe_get_city(get_the_ID() );echo ' , ';   echo tribe_get_country( get_the_ID());?> <?php 
																$glink = tribe_get_map_link(get_the_ID());
																if(isset($glink) && $glink != ''){
																$link = sprintf('<a class="tribe-events-gmap" href="%s" title="%s" target="_blank">%s</a>',
																$glink,
																esc_html__( 'Click to view a Google Map', 'tribe-events-calendar' ),
																esc_html__( 'Google Map', 'tribe-events-calendar' )
																);
																
																echo $link;
										
																}					
																?>											
																</span>
                                                                <span class="tribe-price"><?php echo  tribe_get_cost(get_the_ID(),true);?></span>
																<?php  }
																$event_show_info= ot_get_option('event_show_info');
																?>
																
															  </div>
														  <div class="cear"><!----></div>
														  <div class="recentpost-content">
															<?php echo strip_tags(get_the_excerpt());?>
														  </div>
														  <a class="viewdetails" href="<?php the_permalink();?>"><?php _e('> View Details','cactusthemes')?></a>
														</div>
														<!-- end post wrap -->
													</div>    
                                                    <?php if($righttoleft=='1')	{
													$side_bar_blog_right = 'full';
													if($side_bar_blog_right == 'full'){
														$thumb = 'thumb_467x9999';
													} else {
														$thumb = 'thumb_360x240';
													}
													?>
													<div class="span5">
													  <div class="rt-image">
														<a href="<?php the_permalink();?>" title="<?php echo get_the_title();?>"><?php echo get_the_post_thumbnail(get_the_ID(), 'thumb_360x240', array('alt' => get_the_title()));?></a>
													  </div>
													</div>
													<?php }?>                                      
												</div>
											</div>
                                        </div>
                                      </div>
                                      <!-- end article -->
    
                                    <div class="double-dotted"><div class="inner"><!-- --></div></div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                        <?php 
                            $pagination = ot_get_option('pagination');
                            if(!isset($pagination) || $pagination == 'default' || !function_exists('wp_pagenavi')){
                                cactusthemes_content_nav('paging', $the_query);
                            } else {
                                wp_pagenavi(array('query'=>$the_query));
                            }
                        ?>					
                        <!-- END Blog -->
                    </div>
                    <div class="span3">
                        <div id="mainsidebar">
                            <?php if(is_active_sidebar('event_listing_sidebar')) {
									echo get_dynamic_sidebar('event_listing_sidebar');
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