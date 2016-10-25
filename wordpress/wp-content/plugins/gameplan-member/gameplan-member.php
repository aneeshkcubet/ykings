<?php
   /*
   Plugin Name: Gameplan - Member
   Plugin URI: http://www.cactusthemes.com
   Description: Gameplan - Member post type functions
   Version: 1.0
   Author: Cactusthemes
   Author URI: http://www.cactusthemes.com
   License: GPL2
   */
   
if ( ! defined( 'GP_MEMBER_BASE_FILE' ) )
    define( 'GP_MEMBER_BASE_FILE', __FILE__ );
if ( ! defined( 'GP_MEMBER_BASE_DIR' ) )
    define( 'GP_MEMBER_BASE_DIR', dirname( GP_MEMBER_BASE_FILE ) );
if ( ! defined( 'GP_MEMBER_PLUGIN_URL' ) )
    define( 'GP_MEMBER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
include('member-post-type.php');
include('shortcode-member.php');
