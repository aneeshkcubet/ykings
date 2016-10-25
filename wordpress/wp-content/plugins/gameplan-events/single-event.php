<?php get_header(); ?>
<div class="bg-container single-post-body"> 
    <div class="body-top-color"><!----></div>
    <div class="background-color"><!----></div> 
    <div class="container">
	<?php 
	if(function_exists( 'ot_get_option' )){$event_single_layout = ot_get_option('event_single_layout');}?>
		<div class="container-pad">
            <div class="row-fluid <?php if($event_single_layout == "left") echo "revert-layout";?>">
                <div class="span9">
                <?php 
                $start_day = '';
                $fields = $values = array();
                if ( have_posts() ) : 
                    while ( have_posts() ) : the_post(); 
                        $fields = get_post_custom_keys(get_the_ID());
                        $values = get_post_custom(get_the_ID());
                        $start_day = new DateTime($values['start_day'][0]);
                    endwhile; 
                endif; 
                ?>                
                <div class="meta-table">
                            <div class="custom-pot-1"> 
                                <div class="meta-row"> 
                                    <div class="date-counter"><?php echo $start_day->format('d')?> <span><?php echo $start_day->format('M')?></span></div>
                                </div>
                                <div class="meta-row meta-data"> 
                                    <span><i class="icon-time"></i><?php _e('Time', 'cactusthemes');?>: <?php echo $start_day->format('d M Y')?> <?php _e('at', 'cactusthemes')?> <?php echo $start_day->format('h:i A')?></span> 
                                    <?php if($values['venue'][0]):?><span><i class="icon-map-marker"></i><?php _e('Venue', 'cactusthemes');?>: <?php echo $values['venue'][0];?> 
                                        <?php if($values['google_shortcode'][0]):?><a href="#event_maps" data-toggle="modal"><?php _e('&gt; ViewMap', 'cactusthemes')?></a><?php endif;?>
                                    </span><?php endif;?>
                                    <?php 
									
									$arr_excludes = array('venue','value','google_shortcode','start_day','end_day','page_subhead','background','header_height');/* these are default metadata and should not be displayed */
									
									foreach($fields as $i => $key){
                                        if(!startsWith($key,"_") && isset($values[$key][0]) && $values[$key][0] != '' && !in_array($key,$arr_excludes)){?>
                                            <span><i class="icon-info-sign"></i><?php echo $values[$key][0];?></span>
                                    <?php }}?>
                                </div>
                            </div>
                        </div>
                 <div class="dotteddark" style="margin-top:20px; margin-bottom:30px"></div>       
                <?php 
                $start_day = '';
                $fields = $values = array();
                if ( have_posts() ) : 
                    while ( have_posts() ) : the_post(); 
                        the_content();
                        $fields = get_post_custom_keys(get_the_ID());
                        $values = get_post_custom(get_the_ID());
                        $start_day = new DateTime($values['start_day'][0]);
                    endwhile; 
                endif; 
                ?>
                </div>
                <div class="span3">
                	<div id="mainsidebar">
                        <div class="meta-table"> 
							<?php if(is_active_sidebar('single_event_sidebar')) {
                                    echo get_dynamic_sidebar('single_event_sidebar');
                                }else{
                                    echo get_dynamic_sidebar('main_sidebar');
                                }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<div class="bg-container">
<?php get_template_part( 'body', 'bottom' ); // load body-bottom.php ?>
<?php get_template_part( 'main', 'bottom' ); // load main-bottom.php ?>
</div>

<?php get_footer(); ?>
<div id="event_maps" class="event-gmap modal fade" style="top:50%;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4><?php _e('Location', 'cactusthemes');?></h4>
    </div>
    <div class="modal-body">
    	<?php echo do_shortcode($values['google_shortcode'][0]);?>
    </div>
           	                
</div>