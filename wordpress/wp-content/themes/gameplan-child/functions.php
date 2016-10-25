<?php

add_filter( 'xmlrpc_enabled', '__return_false' );

// Disable X-Pingback to header
add_filter( 'wp_headers', 'disable_x_pingback' );
function disable_x_pingback( $headers ) {
    unset( $headers['X-Pingback'] );

return $headers;
}

add_action( 'wp_enqueue_scripts', 'gameplan_parent_style' );

function gameplan_parent_style() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array('google-font', 'bootstrap', 'bootstrap-responsive', 'bootstrap-no-icons', 'flipclock', 'gameplan-font-awesome', 'prettyPhoto'));
}
