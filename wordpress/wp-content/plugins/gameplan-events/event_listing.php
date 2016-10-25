<?php
/**
 * Template Name: Event Listing 
 */

get_header(); ?>
<div class="bg-container"> 
    <div class="body-top-color"><!----></div>
    <div class="background-color"><!----></div>    
	<div id="main-body">
		<div class="container">
        	<div class="container-pad">
				<?php 
                    if(function_exists( 'ot_get_option' )){$side_bar_event_right= ot_get_option('event_layout');}
                    ?>
                <div class="row-fluid <?php if($side_bar_event_right == "left") echo "revert-layout";?>">
                    <?php 
                    if(function_exists( 'ot_get_option' )){$side_bar_blog_right = ot_get_option('event_layout');}
                    if($side_bar_blog_right=='full')
                    {
                    ?>               
                    <div class="span12">
                    <?php } else {?>
                    <div class="span9">
                    <?php }?>

                    <!--BEGIN Blog -->
                    <?php 
					if(function_exists( 'ot_get_option' )){
                    $event_layout= ot_get_option('event_style');}
                    if($event_layout=='classic' || $event_layout=='')
                    {
                    ?> 
                        <div class="blog-listing event_listing event_lis_old">
                            <?php 
							$bp = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $args = array(
                                'post_type' => 'event',
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
                                    $start_day = new DateTime($values['start_day'][0]);
                                    //var_dump($fields);
                                    ?>
                                      <div class="article">
                                        <div class="article-bg">
                                          <div class="article-content">
												<div class="row-fluid">
													<?php
													if(function_exists( 'ot_get_option' )){
														  $righttoleft= ot_get_option('righttoleft');
													}
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
															  if(function_exists( 'ot_get_option' )){
																$event_show_big_date_text= ot_get_option('event_show_big_date_text');
															  }
																if($event_show_big_date_text=='1'|| $event_show_big_date_text=='')
																{
																?>
																<div class="date-counter">
																<?php echo $start_day->format('d')?>
                                                                <span><?php echo $start_day->format('M')?></span>
																</div>
															  <?php } 
															  if(function_exists( 'ot_get_option' )){
																$event_show_start_time= ot_get_option('event_show_start_time');}
																if($event_show_start_time=='1'|| $event_show_start_time=='')
																{
																?>
																<span><i class="icon-time"></i><?php _e('Time', 'cactusthemes');?>: <?php echo $start_day->format('h:i A')?></span> 
																<?php }
																if(function_exists( 'ot_get_option' )){
																$event_show_location= ot_get_option('event_show_location');}
																if($event_show_location=='1'|| $event_show_location=='')
																{
																?>
																<?php if($values['venue'][0]):?><span><i class="icon-map-marker"></i><?php _e(
																'Venue', 'cactusthemes');?> <?php echo $values['venue'][0];?></span><?php endif;?>
																<?php }
																if(function_exists( 'ot_get_option' )){
																$event_show_info= ot_get_option('event_show_info');
																}
																if($event_show_info=='1')
																{
																?>
																<?php foreach($fields as $i => $key){
																	if($key != 'google_shortcode' && $key != 'venue' && $key != 'start_day' && $key != 'end_day' && !startsWith($key,"_") && isset($values[$key][0]) && $values[$key][0] != ''){?>
																		<span><i class="icon-info-sign"></i><?php echo $values[$key][0];?></span>
																<?php }} }?>
															  </div>
														  <div class="cear"><!----></div>
														  <div class="recentpost-content">
															<?php echo strip_tags(get_the_excerpt());?>
														  </div>
														  <a class="viewdetails" href="<?php the_permalink();?>"><?php _e('&gt; View Details')?></a>
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
						}elseif($event_layout=='modern'){
							wp_enqueue_script( 'jquery-isotope');
							?>
 						<div class="blog-listing blog-listing-modern event-listing-modern">
                            <?php 
							$bp = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $args = array(
                                'post_type' => 'event',
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
                                    $start_day = new DateTime($values['start_day'][0]);
                                    //var_dump($fields);
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
											   if(function_exists( 'ot_get_option' )){
												$event_show_big_date_text= ot_get_option('event_show_big_date_text');
											   }
												if($event_show_big_date_text=='1'|| $event_show_big_date_text=='')
												{
												?> 
                                                <div class="date-counter"><?php echo $start_day->format('d')?> <span><?php echo 
												$start_day->format('M')?></span></div>
                                                <?php }else{?>
													<style type="text/css" scoped="scoped">
														.time-ev.noshow{ margin-left:0 !important}
														.venua-ev.noshow{ margin-left:0 !important}
													</style>
												<?php }
												if(function_exists( 'ot_get_option' )){
												$event_show_start_time= ot_get_option('event_show_start_time');
												}
												if($event_show_start_time=='1'|| $event_show_start_time=='')
												{
												?>
                                                <span class="time-ev noshow" ><span class="time-span"><i class="icon-time"></i><?php _e('Time', 'cactusthemes');?>: <?php echo $start_day->format('h:i A')?> </span></span> 
                                                <?php }
												if(function_exists( 'ot_get_option' )){
												$event_show_location= ot_get_option('event_show_location');
												}
												if($event_show_location=='1'|| $event_show_location=='')
												{
												?>
                                                <?php if($values['venue'][0]):?><span class="venua-ev noshow" ><span class="time-span"><i class="icon-map-marker"></i> <?php echo $values['venue'][0];?></span></span><?php endif;?>
                                                <?php }
												if(function_exists( 'ot_get_option' )){
												$event_show_info= ot_get_option('event_show_info');
												}
												if($event_show_info=='1')
												{
												?>
                                                <?php foreach($fields as $i => $key){
                                                    if($key != 'google_shortcode' && $key != 'venue' && $key != 'start_day' && $key != 'end_day' && !startsWith($key,"_") && isset($values[$key][0]) && $values[$key][0] != ''){?>
                                                        <span><i class="icon-info-sign"></i><?php echo $values[$key][0];?></span>
                                                <?php }}}?>
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
                    <?php }?>
                        <?php 
							if(function_exists( 'ot_get_option' )){
                            $pagination = ot_get_option('pagination-event');
							}
                            if(!isset($pagination) || $pagination == 'default'){
                                cactusthemes_content_nav('paging');
                            } else {
                                wp_pagenavi(array('query'=>$the_query));
                            }
                        ?>					
                        <!-- END Blog -->
                    </div>
					 <?php 
					if(function_exists( 'ot_get_option' )){
                    $side_bar_event_right= ot_get_option('event_layout');
					}
					if($side_bar_event_right !='full')
					{
						echo '<style typ="text/css" scoped="scoped">
						.event-listing-modern{padding-left:0}
						</style>
						';
                    ?>
                    <div class="span3">
                        <div id="mainsidebar">
                            <?php if(is_active_sidebar('event_listing_sidebar')) {
									echo get_dynamic_sidebar('event_listing_sidebar');
									}else{
									echo get_dynamic_sidebar('main_sidebar');
							}?>
                        </div>
                    </div>
                     <?php }?>
                </div>
            </div>
		</div>
	</div>	
	<?php get_template_part( 'body', 'bottom' ); // load body-bottom.php ?>
	<?php get_template_part( 'main', 'bottom' ); // load main-bottom.php ?>
</div>
<?php get_footer(); ?>