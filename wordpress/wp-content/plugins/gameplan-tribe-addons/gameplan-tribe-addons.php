<?php
   /*
   Plugin Name: Gameplan - Tribe - Addons
   Plugin URI: http://www.cactusthemes.com
   Description: Gameplan - Tribe - Addons
   Version: 1.5.13
   Author: Cactusthemes
   Author URI: http://www.cactusthemes.com
   License: Commercial
   */
   
if ( ! defined( 'GP_TRIBE_BASE_FILE' ) )
    define( 'GP_TRIBE_BASE_FILE', __FILE__ );
if ( ! defined( 'GP_TRIBE_BASE_DIR' ) )
    define( 'GP_TRIBE_BASE_DIR', dirname( GP_TRIBE_BASE_FILE ) );
if ( ! defined( 'GP_TRIBE_PLUGIN_URL' ) )
    define( 'GP_TRIBE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
include('widget-latest-tribe-addons.php');
include('timeline_tribe_list.php');
include('tribe-event-metadata.php');

/* Filter the single_template with our custom function*/
add_filter('single_template', 'tribe_custom_template');

function tribe_custom_template($single) {
    global $wp_query, $post;
/* Checks for single template by post type */
if ($post->post_type == "tribe_event"){
    if(file_exists(GP_TRIBE_BASE_DIR. '/single-tribe-addons.php'))
        return GP_TRIBE_BASE_DIR . '/single-tribe-addons.php';
}
    return $single;
}

//page template for slug
add_filter( 'page_template', 'tribe_listing_page_template' );
function tribe_listing_page_template( $page_template )
{
	$event_listing_page = function_exists('ot_get_option')?ot_get_option('event_listing_page','events-list'):'events-list';
    if ( is_page( $event_listing_page ) ) {
        $page_template = dirname( __FILE__ ) . '/listing_tribe_addons.php';
    }
    return $page_template;
}