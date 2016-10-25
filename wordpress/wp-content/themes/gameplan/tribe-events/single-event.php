<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 * 
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @since  2.1
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); }
$venue_details = array();

if ($venue_name = tribe_get_meta( 'tribe_event_venue_name' ) ) {
	$venue_details[] = $venue_name;	
}

if ($venue_address = tribe_get_meta( 'tribe_event_venue_address' ) ) {
	$venue_details[] = $venue_address;	
}
// Venue microformats
$has_venue = ( $venue_details ) ? ' vcard': '';
$has_venue_address = ( $venue_address ) ? ' location': '';

$event_id = get_the_ID();

?>
                <?php 
                $start_day = '';
                $fields = $values = array();
                if ( have_posts() ) : 
                    while ( have_posts() ) : the_post(); 
                        $fields = get_post_custom_keys(get_the_ID());
                        $values = get_post_custom(get_the_ID());
                        $start_day = new DateTime(tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = 'Y-m-d H:m:i'));
                    endwhile; 
                endif; 
				$dt = get_option('date_format');
                ?>                

<div id="tribe-events-content " class="tribe-events-single event_single_fix">

	<!-- Notices -->
					<div class="meta-table">
                            <div class="custom-pot-1"> 
                                <div class="meta-row date_start_big"> 
                                    <div class="date-counter"><span class="d_big"><?php echo tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = 'd')?> </span><span class="d_small"><?php echo tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = 'M')?></span></div>
                                </div>                              
                            </div>
                            <div class="meta-row meta-data"> 
                                    <p class="date_st"><?php 
										 $time_for = get_option('time_format');
										 $timestart = strtotime(tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = $dt)); 
										 $timesend = strtotime(tribe_get_end_date( $event = null, $displayTime = false, $dateFormat = $dt)); 
										 echo tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = $dt)  ; 
										 if (!tribe_event_is_all_day()){
										 	echo ' '.tribe_get_start_date( $event = null, $displayTime = true, $dateFormat = $time_for); 
										 }
										 if (!tribe_event_is_all_day() || $timestart!= $timesend){
										 	echo ' - ';
										 }
										 if($timestart!= $timesend){ 
										  echo tribe_get_end_date($event = null, $displayTime = false, $dateFormat = $dt);
										 }
										 if (!tribe_event_is_all_day()){
										 echo ' '.tribe_get_end_date($event = null, $displayTime = true, $dateFormat = $time_for);?>
										 <?php
										 }
									if(function_exists('tribe_is_recurring_event')){
									if(is_plugin_active('gameplan-shortcodes/gameplan-shortcodes.php')&&tribe_is_recurring_event(get_the_ID())){
										echo '<span>';
										$tooltip_recur = '<span class="tribe-events-divider">|</span>'.esc_html__( 'Recurring Event', 'tribe-events-calendar' );
										echo do_shortcode('[tooltip id="tooltip_333" title="'.tribe_get_recurrence_text( get_the_ID() ).'"]'.$tooltip_recur.'[/tooltip]');
										echo sprintf(' <a href="%s">%s</a>',
										tribe_all_occurences_link( get_the_ID(), false ),
										esc_html__( '(See all)', 'tribe-events-calendar' )
										);
										echo '</span>';
									}else{
										echo tribe_events_event_recurring_info_tooltip();
									}
									}
									?></p> 
                                    <span class="mapgg"><?php 
									$full_address = '';

									$venue = tribe_get_venue( get_the_ID());
									if($venue != '') echo $venue . ', ';
									$address = tribe_get_address( get_the_ID());
									if($address != '') echo $address . ', ';
									$city = tribe_get_city(get_the_ID() );
									if($city != '') echo $city . ', ';
									$region = tribe_get_region( get_the_ID());
									if($region != '') echo $region . ' ';
									$zip_code = tribe_get_zip(get_the_ID()) ;
									if($zip_code != '') echo $zip_code . ' ';
									$country = tribe_get_country( get_the_ID());
									if($country != '') echo $country . '';
									$full_address = $venue . $address . $city . $country;
									//$full_address = substr($full_address,-2); // strip off last 2 characters

									//echo $full_address;
									
									if (get_event_google_map_link ()!='') { echo '<a class="tribe-events-gmap" href="'.get_event_google_map_link ().'" title="Click to view a Google Map" target="_blank">+ Google Map</a>'; } ?>
									</span>
                                    <h3 class="ev_price"><?php echo  tribe_get_cost(get_the_ID(),true);?></h3>
                                </div>
							<?php if(function_exists('get_post_meta')){ 
								$b = get_post_meta(get_the_ID(),'website_subscribe',true);
								$text_bt = get_post_meta(get_the_ID(),'text_subscribe',true);
								$subscribe_bt = get_post_meta(get_the_ID(),'subscribe_button',true);
							} 
							//check has pass
							$gmt_offset = ( get_option( 'gmt_offset' ) >= '0' ) ? ' +' . get_option( 'gmt_offset' ) : " " . get_option( 'gmt_offset' );
							$gmt_offset = str_replace( array( '.25', '.5', '.75' ), array( ':15', ':30', ':45' ), $gmt_offset );
							$is_pass = strtotime( tribe_get_end_date( get_the_ID(), false, 'Y-m-d G:i' ) . $gmt_offset ) <= time();
							$notices = TribeEvents::getNotices();
							if($b!=''&&empty( $notices )){ ?>                           
                            <div class="ev_button bt-top <?php if($subscribe_bt=='pp_buygift'){echo 'pp_buygift';} ?>">
							  <?php 
							  if($b!=''){
								  if($subscribe_bt=='def')
								  {
									  if($text_bt==''){ 
									  echo  do_shortcode('[button id="button_71" size="small" link="'.$b.'" ]'. esc_html__('Join Now', 'cactusthemes').'[/button]'); 
									  }else{
									  echo  do_shortcode('[button id="button_71" size="small" link="'.$b.'" ]'.$text_bt.'[/button]');	
									  }
								  }else { pp_buttom($subscribe_bt,$b); }
							  }
								?>
                            </div>
                            <?php } ?>
                        </div>

	<!-- Notices -->
	<?php tribe_events_the_notices() ?>

	<?php //the_title( '<h2 class="tribe-events-single-event-title summary">', '</h2>' ); ?>

	<div class="tribe-events-schedule updated published tribe-clearfix">
		<!--<h3><?php //echo tribe_events_event_schedule_details(); ?></h3>-->
		<?php // if ( tribe_get_cost() ) :  ?>
			<!--<span class="tribe-events-divider">|</span>
			<span class="tribe-events-cost"><?php //echo tribe_get_cost( null, true ) ?></span>-->
		<?php // endif; ?>
	</div>

	<!-- Event header -->
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
		<!-- Navigation -->
		<h3 class="tribe-events-visuallyhidden"><?php esc_html_e( 'Event Navigation', 'tribe-events-calendar' ) ?></h3>
		<ul class="tribe-events-sub-nav">
			<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '&laquo; %title%' ) ?></li>
			<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% &raquo;' ) ?></li>
		</ul><!-- .tribe-events-sub-nav -->
	</div><!-- #tribe-events-header -->

	<?php while ( have_posts() ) :  the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('vevent'); ?>>
			<!-- Event featured image -->
			<?php echo tribe_event_featured_image(); ?>

			<!-- Event content -->
			<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
			<div class="tribe-events-single-event-description tribe-events-content entry-content description">
				<?php the_content(); ?>
			</div><!-- .tribe-events-single-event-description -->
			<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>
			
			<!-- Event meta -->
			<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
			<?php
			/**
			 * The tribe_events_single_event_meta() function has been deprecated and has been
			 * left in place only to help customers with existing meta factory customizations
			 * to transition: if you are one of those users, please review the new meta templates
			 * and make the switch!
			 */
			if ( ! apply_filters( 'tribe_events_single_event_meta_legacy_mode', false ) ) {
				tribe_get_template_part( 'modules/meta' );
			} else {
				echo tribe_events_single_event_meta();
			}
			?>
            <?php
			$notices = Tribe__Events__Main::getNotices();
			if($b!=''&&empty( $notices )){ ?>
			<div class="ev_button_end">
            	<div class="evpos">
				   <?php 
							  if($b!=''){
								  if($subscribe_bt=='def')
								  {
									  if($text_bt==''){ 
									  echo  do_shortcode('[button id="button_71" size="small" link="'.$b.'" ]'. esc_html__('Join Now', 'cactusthemes').'[/button]'); 
									  }else{
									  echo  do_shortcode('[button id="button_71" size="small" link="'.$b.'" ]'.$text_bt.'[/button]');	
									  }
								  }else { 
								  	  pp_buttom($subscribe_bt,$b); 
								  }
							  }
                      ?>

                </div>
            </div>
            <?php } ?>
			<div class="clear"></div>
			<?php 
			if(class_exists('Tribe__Events__Pro__Main')){
			$callback = array( Tribe__Events__Pro__Main::instance(), 'register_related_events_view' );
				remove_action( 'tribe_events_single_event_after_the_meta', $callback) ;
			}
			?>
			<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
			<?php
			if(ot_get_option('show-related-events',1)){
				tribe_single_related_events_fix();
			}
			?>
				
			</div><!-- .hentry .vevent -->
		<?php if( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments','no' ) == 'yes' ) { comments_template(); } ?>
	<?php endwhile; ?>

	<!-- Event footer -->
    <div id="event_fix_footer">		
		<!-- Navigation -->
		<h3 class="tribe-events-visuallyhidden"><?php esc_html_e( 'Event Navigation', 'tribe-events-calendar' ) ?></h3>
        
    </div><!-- #tribe-events-footer -->

</div><!-- #tribe-events-content -->
