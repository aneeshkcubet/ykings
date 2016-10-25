<?php
/**
 * Photo View Content
 * The content template for the photo view of events. This template is also used for
 * the response that is returned on photo view ajax requests.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/photo/content.php
 *
 * @package TribeEventsCalendar
 * @since  3.0
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); } ?>

<div id="tribe-events-content" class="tribe-events-list tribe-events-photo">
 <?php wp_enqueue_script( 'jquery-isotope'); ?>
 <div class="blog-listing blog-listing-modern event-listing-modern tribe_event_fix">
	<!-- Photo View Title -->
	<?php do_action( 'tribe_events_before_the_title' ); ?>
	<!--<h2 class="tribe-events-page-title"><?php //echo tribe_get_events_title(); ?>
    </h2>-->
	<?php //do_action( 'tribe_events_after_the_title' ); ?>

	<!-- Notices -->
	<?php tribe_events_the_notices(); ?>

	<!-- Photo View Header -->
	<?php do_action( 'tribe_events_before_header' ); ?>
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes(); ?>>

		<!-- Header Navigation -->
		<?php do_action( 'tribe_events_before_header_nav' ); ?>
		<?php tribe_get_template_part( 'photo/nav', 'header' ); ?>
		<?php do_action( 'tribe_events_after_header_nav' ); ?>

	</div><!-- #tribe-events-header -->
	<?php do_action( 'tribe_events_after_header' ); ?>

	<!-- Events Loop -->
	<?php if ( have_posts() ) : ?>
		<?php do_action( 'tribe_events_before_loop' ); ?>
			<?php do_action( 'tribe_events_before_loop' ); ?>
				<?php while ( have_posts() ) : the_post(); 
                    $fields = get_post_custom_keys(get_the_ID());
                    $values = get_post_custom(get_the_ID());
                    $start_day = new DateTime($values['_EventStartDate'][0]);
                    //var_dump($fields);
                    $dt = get_option('date_format');?>
                
					<div class="item">
                        <div class="article">
                          <div class="article-bg">
                            <div class="article-content">
                              <?php if(has_post_thumbnail()){?>
                              <div class="span12 imge">
                                <div class="rt-image">
                                  <a href="<?php echo tribe_get_event_link();?>" title="<?php echo get_the_title();?>"><?php echo get_the_post_thumbnail(get_the_ID(), 'thumb_360x240', array('alt' => get_the_title()));?></a>
                                </div>
                              </div>
                              <?php }?>
                              <div class="span12 modern_style">
                                <div class="rt-headline">
                                  <h3 class="rt-article-title"> 
                                      <a href="<?php echo tribe_get_event_link();?>"><?php echo get_the_title();?></a>
                                  </h3>
                                </div>                                          
                                <div class="dotted dot-event"><div class="inner"></div></div>
                                <div class="custom-pot-1"> 
                                 <?php 
                                  $event_show_big_date_text= ot_get_option('event_show_big_date_text');
                                  if($event_show_big_date_text=='1'|| $event_show_big_date_text=='')
                                  {
                                  ?> 
                                  <div class="date-counter"><?php echo tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = 'd')?> <span><?php echo 
                                  tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = 'M')?></span></div>
                                  <?php }else{?>
                                      <style type="text/css" scoped>
                                          .time-ev.photo-noshow{ margin-left:0}
                                      </style>
                                  <?php }
                                  $id_e = rand();
                                  $event_show_start_time= ot_get_option('event_show_start_time');
                                  if($event_show_start_time=='1'|| $event_show_start_time=='')
                                  {
                                  ?>
                                  <span class="time-ev photo-noshow" id="time-<?php $id_e?>"><span class="time-span"><?php echo $start_day->format('h:i A')?></span> 
                                  <?php }
                                  $event_show_location= ot_get_option('event_show_location');
                                  if($event_show_location=='1'|| $event_show_location=='')

                                  {
                                  ?>
                                  <span class="mapgg"><?php echo tribe_get_venue( get_the_ID());?><br /><?php  if (get_event_google_map_link ()!='') { echo '<a class="tribe-events-gmap" href="'.get_event_google_map_link ().'" title="Click to view a Google Map" target="_blank">+ Google Map</a>'; } ?></span>
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
				<!-- end a event -->
				<?php endwhile;?>
			<?php do_action( 'tribe_events_after_loop' ); ?>
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

	<!-- List Footer -->
	<?php do_action( 'tribe_events_before_footer' ); ?>
	<div id="tribe-events-footer">

		<!-- Footer Navigation -->
		<?php do_action( 'tribe_events_before_footer_nav' ); ?>
		<?php tribe_get_template_part( 'photo/nav', 'footer' ); ?>
		<?php do_action( 'tribe_events_after_footer_nav' ); ?>

	</div><!-- #tribe-events-footer -->
	<?php do_action( 'tribe_events_after_footer' ); ?>

</div><!-- #tribe-events-content -->