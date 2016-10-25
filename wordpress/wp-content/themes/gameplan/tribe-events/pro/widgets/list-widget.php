<?php
/**
 * Events Pro List Widget Template
 * This is the template for the output of the events list widget.
 * All the items are turned on and off through the widget admin.
 * There is currently no default styling, which is highly needed.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/widgets/list-widget.php
 *
 * When the template is loaded, the following vars are set: $start, $end, $venue,
 * $address, $city, $state, $province'], $zip, $country, $phone, $cost
 *
 * @package TribeEventsCalendarPro
 * @since  1.0
 * @author Modern Tribe Inc.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_plural = tribe_get_event_label_plural();

$posts = tribe_get_list_widget_events();

// Check if any posts were found
if ( $posts ):
	?>
	<ol class="hfeed vcalendar">
		<?php
		foreach( $posts as $post ) :
			setup_postdata( $post );
			?>
			<li class="<?php tribe_events_event_classes() ?>" style=" margin-left:2em">

				<?php do_action( 'tribe_events_list_widget_before_the_event_title' ); ?>

				<h4 class="entry-title summary">
					<a href="<?php echo tribe_get_event_link(); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h4>

				<?php do_action( 'tribe_events_list_widget_after_the_event_title' ); ?>

				<?php do_action( 'tribe_events_list_widget_before_the_meta' ) ?>

				<div class="duration">
					<?php echo tribe_events_event_schedule_details(); ?>
				</div>
				<?php if ( $cost && tribe_get_cost() != '' ) { ?>
					<span class="tribe-events-divider">|</span>
					<div class="tribe-events-event-cost" style="display:block">
						<?php echo tribe_get_cost( null, true ); ?>
					</div>
				<?php } ?>
				<?php do_action( 'tribe_events_list_widget_after_the_meta' ) ?>

			</li>
		<?php
		endforeach;
		?>
	</ol><!-- .hfeed -->

	<p class="tribe-events-widget-link">
		<a href="<?php echo esc_url( tribe_get_events_link() ); ?>" rel="bookmark">
			<?php _e( 'View More&hellip;', 'tribe-events-calendar' ) ?>
		</a>
	</p>
<?php
// No Events were Found
else:
	?>
	<p><?php _e( 'There are no upcoming events at this time.', 'tribe-events-calendar' ) ?></p>
<?php
endif;