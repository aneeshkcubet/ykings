<?php
/**
 * Template Name: Demo Event Tribe Listing Modern
 */

get_header();
wp_enqueue_script( 'jquery-isotope');
?>
<div class="bg-container"> 
    <div class="body-top-color"><!----></div>
    <div class="background-color"><!----></div>    
	<div id="main-body">
		<div class="container">
        	<div class="container-pad">
                <div class="row-fluid">
                           
                    <div class="span12">

                    <!--BEGIN Blog -->
                    <?php wp_enqueue_script( 'jquery-isotope'); ?>
 						<div class="blog-listing blog-listing-modern event-listing-modern">
                            <?php 
							$bp = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $args = array(
                                'post_type' => 'tribe_events',
                                'posts_per_page' => get_option('posts_per_page'),
                                'orderby' => '',
								'paged' => $bp,
                                'post_status' => 'publish',
                            );	
                            $the_query = new WP_Query( $args );
                            if ( $the_query->have_posts() ) : 
                                 while ( $the_query->have_posts() ) : $the_query->the_post(); 
                                    $fields = get_post_custom_keys(get_the_ID());
                                    $values = get_post_custom(get_the_ID());
                                    $start_day = new DateTime($values['_EventStartDate'][0]);
                                    //var_dump($fields);
									$dt = get_option('date_format');
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
                                                <h3 class="rt-article-title"> 
                                                    <a href="<?php the_permalink();?>"><?php echo get_the_title();?></a>
                                                </h3>
                                              </div>                                          
                                              <div class="dotted dot-event"><div class="inner"></div></div>
                                              <div class="custom-pot-1"> 
                                               <?php 
												$event_show_big_date_text= ot_get_option('event_show_big_date_text');
												if($event_show_big_date_text=='1'|| $event_show_big_date_text=='')
												{
												?> 
                                                <div class="date-counter"><?php echo tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = "d")?> <span><?php echo tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = "M")?></span></div>
                                                <?php }else{?>
													<style type="text/css" scoped="scoped">
														.time-ev.demo-noshow{ margin-left:0 !important}
													</style>
												<?php }
												$id_e = rand();
												$event_show_start_time= ot_get_option('event_show_start_time');
												if($event_show_start_time=='1'|| $event_show_start_time=='')
												{
												?>
                                                <span class="time-ev demo-noshow" id="time-<?php $id_e?>"><span class="time-span"><?php echo $start_day->format('h:i A');?></span> 
                                                <?php }
												$event_show_location= ot_get_option('event_show_location');
												if($event_show_location=='1'|| $event_show_location=='')

												{
												?>
                                                <span class="mapgg"><?php echo tribe_get_venue( get_the_ID());?><br />
                                                <?php
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
                                                <?php }
												?>
                                              </div>
                                              
                                              
                                              <div class="clear"><!----></div>
                                              <div class="recentpost-content">
                                                <?php echo strip_tags(get_the_excerpt());?>
                                              </div>
                                            </div>
                                            <!-- end post wrap -->
                                            <div class="clear"><!-- --></div>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- end article -->
                                     </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>

                    <script>
					jQuery(document).ready(function(e) {
					jQuery(function(){
					  
					  var container = jQuery('.blog-listing');
					  
					  jQuery(container).isotope({
						itemSelector: '.item'
					  });
					  
					});
					});
					</script>
                        <?php 
                            $pagination = ot_get_option('pagination-event');
                            if(!isset($pagination) || $pagination == 'default' || !function_exists('wp_pagenavi')){
                                cactusthemes_content_nav('paging');
                            } else {
                                wp_pagenavi(array('query'=>$the_query));
                            }
                        ?>					
                        <!-- END Blog -->
                    </div>
                </div>
            </div>
		</div>
	</div>	
	<?php get_template_part( 'body', 'bottom' ); // load body-bottom.php ?>
	<?php get_template_part( 'main', 'bottom' ); // load main-bottom.php ?>
</div>
<?php get_footer(); ?>