<?php 
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @package TribeEventsCalendar
 * @since  3.0
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); } 




$event = tribe_events_week_get_event();
if($event):
?>
<div class="event-item-mob">
	<?php 

	$venue_name = tribe_get_venue($event->ID, true);
	$venue_address = tribe_get_address($event->ID);

	// Venue microformats
	$has_venue = ( $venue_name ) ? ' vcard': '';
	$has_venue_address = ( $venue_address ) ? ' location': '';
	?>

	<!-- Event Title -->
	<?php do_action( 'tribe_events_before_the_event_title' ) ?>
	<h2 class="tribe-events-list-event-title summary">
		<a class="url" href="<?php tribe_event_link( $event ); ?>" title="<?php echo $event->post_title; ?>" rel="bookmark">
			<?php echo $event->post_title; ?>
		</a>
	
	<?php do_action( 'tribe_events_after_the_event_title' ) ?>

	<!-- Event Cost -->
	<?php if ( tribe_get_cost($event->ID) ) : ?> 
		<div class="tribe-events-event-cost">
			<span><?php echo tribe_get_cost( $event->ID, true ); ?></span>
		</div>
	<?php endif; ?>
	
	</h2>

	<!-- Event Meta -->
	<?php do_action( 'tribe_events_before_the_meta' ) ?>
	<div class="tribe-events-event-meta <?php echo $has_venue . $has_venue_address; ?>">

		<!-- Schedule & Recurrence Details -->
		<div class="updated published time-details">
			<?php

				if ( !empty( $event->EventStartDate ) )
					echo date_i18n( get_option( 'date_format', 'F j, Y' ), strtotime( $event->EventStartDate ) );
				if ( !tribe_get_event_meta( $event->ID, '_EventAllDay', true ) )
					echo ' ' . date_i18n( get_option( 'time_format', 'g:i a' ), strtotime( $event->EventStartDate ) );

				?>
				
			<?php

				if ( !empty( $event->EventEndDate ) && $event->EventStartDate !== $event->EventEndDate ) {
					if ( date_i18n( 'Y-m-d', strtotime( $event->EventStartDate ) ) == date_i18n( 'Y-m-d', strtotime( $event->EventEndDate ) ) ) {
						$time_format = get_option( 'time_format', 'g:i a' );
						if ( !tribe_get_event_meta( $event->ID, '_EventAllDay', true ) )
							echo " – " . date_i18n( $time_format, strtotime( $event->EventEndDate ) );
					} else {
						echo " – " . date_i18n( get_option( 'date_format', 'F j, Y' ), strtotime( $event->EventEndDate ) );
						if ( !tribe_get_event_meta( $event->ID, '_EventAllDay', true ) )
							echo ' ' . date_i18n( get_option( 'time_format', 'g:i a' ), strtotime( $event->EventEndDate ) ) . '<br />';
					}
				}

				?>
		</div>
		
		<?php if ( $has_venue ) : ?>
			<!-- Venue Display Info -->
			<div class="tribe-events-venue-details">
				<?php echo tribe_get_venue_link($event->ID);?>
				
				<?php if( $has_venue_address) : ?>
				
				<?php echo ' - ' . tribe_get_full_address($event->ID);?>
				
				<?php endif;?>
			</div> <!-- .tribe-events-venue-details -->
		<?php endif; ?>

	</div><!-- .tribe-events-event-meta -->
	<?php do_action( 'tribe_events_after_the_meta' ) ?>

	<!-- Event Content -->
	<?php do_action( 'tribe_events_before_the_content' ) ?>
	<div class="tribe-events-list-event-description tribe-events-content description entry-summary">
		<a href="<?php echo tribe_get_event_link($event) ?>" class="tribe-events-read-more" rel="bookmark"><?php _e( 'Find out more', 'tribe-events-calendar' ) ?> &raquo;</a>
	</div><!-- .tribe-events-list-event-description -->
	<?php do_action( 'tribe_events_after_the_content' ) ?>
</div>
<div class="double-dotted"><div class="inner"><!-- --></div></div>
<?php endif;?>