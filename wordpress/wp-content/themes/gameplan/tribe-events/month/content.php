<?php
/**
 * Month View Content Template
 * The content template for the month view of events. This template is also used for
 * the response that is returned on month view ajax requests.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/month/content.php
 *
 * @package TribeEventsCalendar
 * @since  3.0
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); } ?>

<div id="tribe-events-content" class="tribe-events-month">
	
	<!-- Month Title -->
	<?php do_action( 'tribe_events_before_the_title' ) ?>
	<h2 class="tribe-events-page-title"><?php tribe_events_title() ?></h2>
	<?php do_action( 'tribe_events_after_the_title' ) ?>

	<!-- Notices -->
	<?php tribe_events_the_notices() ?>

	<!-- Month Header -->
	<?php do_action( 'tribe_events_before_header' ) ?>
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>

		<!-- Header Navigation -->
		<?php tribe_get_template_part( 'month/nav' ); ?>

	</div><!-- #tribe-events-header -->
	<?php do_action( 'tribe_events_after_header' ) ?>
	
	<?php
	global $detect;
	if($detect->isMobile()) {
						?>
                        <style>
                        #tribe-events-mobile-template{display:block}
                        </style>
                        <?php
							// if on mobile, grid should not be shown
							// don't know what to do here, so leave it blank!
						} else { ?>

	<!-- Month Grid -->
	<?php tribe_get_template_part( 'month/loop', 'grid' ) ?>
	
	<!-- Month Footer -->
	<?php do_action( 'tribe_events_before_footer' ) ?>
	<div id="tribe-events-footer">

		<!-- Footer Navigation -->
		<?php do_action( 'tribe_events_before_footer_nav' ); ?>
		<?php tribe_get_template_part( 'month/nav' ); ?>
		<?php do_action( 'tribe_events_after_footer_nav' ); ?>

	</div><!-- #tribe-events-footer -->
	<?php do_action( 'tribe_events_after_footer' ) ?>
	<?php tribe_get_template_part( 'month/tooltip' ); ?>
	<?php 
	} // end if is not mobile
	?>
	
	<div id="tribe-events-mobile-template">
		<?php do_action( 'tribe_events_before_template' ); ?>
		<?php while (tribe_events_have_month_days()) : tribe_events_the_month_day(); ?>
			<?php tribe_get_template_part( 'list/single-event_month_mob' );?>
		<?php endwhile; ?>
		
		<?php		
			echo '<div id="tribe-events-mobile-nav">';
					tribe_get_template_part( 'month/nav' );
				echo '</div>';
		?>
		
		<?php do_action( 'tribe_events_after_template' ) ?>
	</div>
	
</div><!-- #tribe-events-content -->
