<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template' 
 * is selected in Events -> Settings -> Template -> Events Template.
 * 
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 * @since  3.0
 * @author Modern Tribe Inc.
 *
 */
 
 /* This is default template for page: Right Sidebar 
 *
 * Check theme option to display default layout
 */
if(tribe_is_event() && is_single()){
	$layout = ot_get_option('event_single_layout');
}else{
	$layout = ot_get_option('event_layout');
}

if ( !defined('ABSPATH') ) { die('-1'); } ?>

<?php get_header(); ?>
<div class="bg-container single-page-body"> 
    <div class="body-top-color"><!----></div>
    <div class="background-color"><!----></div> 
    <div class="container">    	
		<div class="container-pad">
            <div class="row-fluid <?php echo ($layout == 'left') ? "revert-layout":"";?>">
					<div class="<?php if($layout == 'full') echo 'span12'; else echo 'span9';?>">

						<div id="tribe-events-pg-template">
							<?php tribe_events_before_html(); ?>
							<?php tribe_get_view(); ?>
							<?php tribe_events_after_html(); ?>
						</div> <!-- #tribe-events-pg-template -->
						
					</div>
				<?php if($layout != 'full'){?>
                <div class="span3">
                	<div id="mainsidebar">
                    <?php 
						if(tribe_is_event() && is_single()){
							if(is_active_sidebar('single_event_sidebar')) {
								echo get_dynamic_sidebar('single_event_sidebar');
							} elseif(is_active_sidebar('event_listing_sidebar')) {
								echo get_dynamic_sidebar('event_listing_sidebar');
							} else {
								echo get_dynamic_sidebar('main_sidebar');
							}
						} else {
							if(is_active_sidebar('event_listing_sidebar')) {
								echo get_dynamic_sidebar('event_listing_sidebar');
							} else {
								echo get_dynamic_sidebar('main_sidebar');
							}
						}
					?>
					
                    </div>
                </div>
				<?php }?>
            </div>
		</div>
    </div>
</div>

<div class="bg-container">
<?php get_template_part( 'body', 'bottom' ); // load body-bottom.php ?>
<?php get_template_part( 'main', 'bottom' ); // load main-bottom.php ?>
</div>
<?php get_footer(); ?>