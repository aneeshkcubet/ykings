<?php
   /*
   Plugin Name: Gameplan - Events
   Plugin URI: http://www.cactusthemes.com
   Description: Gameplan - Events post type functions
   Version: 1.4.5
   Author: Cactusthemes
   Author URI: http://www.cactusthemes.com
   License: Commercial
   */
   
if ( ! defined( 'GP_EVENTS_BASE_FILE' ) )
    define( 'GP_EVENTS_BASE_FILE', __FILE__ );
if ( ! defined( 'GP_EVENTS_BASE_DIR' ) )
    define( 'GP_EVENTS_BASE_DIR', dirname( GP_EVENTS_BASE_FILE ) );
if ( ! defined( 'GP_EVENTS_PLUGIN_URL' ) )
    define( 'GP_EVENTS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
include('event-post-type.php');
include('widget-latest-event-post-type.php');
include('timeline_event_list.php');

/* Filter the single_template with our custom function*/
add_filter('single_template', 'events_custom_template');

function events_custom_template($single) {
    global $wp_query, $post;
/* Checks for single template by post type */
if ($post->post_type == "event"){
    if(file_exists(GP_EVENTS_BASE_DIR. '/single-event.php'))
        return GP_EVENTS_BASE_DIR . '/single-event.php';
}
    return $single;
}

//page template for slug
add_filter( 'page_template', 'event_listing_page_template' );
function event_listing_page_template( $page_template )
{
	$event_listing_page = function_exists('ot_get_option')?ot_get_option('event_listing_page','events-list'):'events-list';
    if ( is_page( $event_listing_page ) ) {
        $page_template = dirname( __FILE__ ) . '/event_listing.php';
    }
    return $page_template;
}