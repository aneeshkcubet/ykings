<?php
   /*
   Plugin Name: Gameplan - Portfolio
   Plugin URI: http://www.cactusthemes.com
   Description: Gameplan - Portfolio post type functions
   Version: 1.5.2
   Author: Cactusthemes
   Author URI: http://www.cactusthemes.com
   License: GPL2
   */
   
if ( ! defined( 'GP_PORTFOLIO_BASE_FILE' ) )
    define( 'GP_PORTFOLIO_BASE_FILE', __FILE__ );
if ( ! defined( 'GP_PORTFOLIO_BASE_DIR' ) )
    define( 'GP_PORTFOLIO_BASE_DIR', dirname( GP_PORTFOLIO_BASE_FILE ) );
if ( ! defined( 'GP_PORTFOLIO_PLUGIN_URL' ) )
    define( 'GP_PORTFOLIO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
include('portfolio-post-type.php');
include('shortcode-portfolio.php');

/* Filter the single_template with our custom function*/
add_filter('single_template', 'portfolio_custom_template');

function portfolio_custom_template($single) {
    global $wp_query, $post;
/* Checks for single template by post type */
if ($post->post_type == "post-portfolio"){
    if(file_exists(GP_PORTFOLIO_BASE_DIR. '/single-post-portfolio.php'))
        return GP_PORTFOLIO_BASE_DIR . '/single-post-portfolio.php';
}
    return $single;
}

add_action( 'init', 'portfolio_size_thumb' );
function portfolio_size_thumb() {
    /* Portfolio size */
	add_image_size('thumb_193x193',193,193, true); // 6 cols
	add_image_size('thumb_231x231',231,231, true); // 5 cols
	add_image_size('thumb_289x289',289,289, true); // 4 cols
	add_image_size('thumb_386x386',386,386, true); // 3 cols
	add_image_size('thumb_760x430',760,430, true); // Single portfolio
	/* Portfolio size carousel */
	add_image_size('thumb_160x110',160,110, true); // 6 cols
	add_image_size('thumb_200x138',200,138, true); // 5 cols
	add_image_size('thumb_260x180',260,180, true); // 4 cols
	add_image_size('thumb_360x249',360,249, true); // 3 cols
}

function gp_include_custom_post_types( $query ) {
	// Don't break admin or preview pages. This is also a good place to exclude feed with ! is_feed() if desired.
	if ( ! is_preview() && ! is_admin() && ! is_singular() ) {
		if (!$query->is_feed && is_tag() && $query->is_main_query() ) {
			$my_post_type = get_query_var( 'post_type' );
			$post_types = array_merge( $my_post_type, array( 'post', 'post-portfolio' ) );
			$query->set( 'post_type', $post_types );
		}
	}
}
add_action( 'pre_get_posts', 'gp_include_custom_post_types' );
