<?php
   /*
   Plugin Name: Gameplan - Shortcodes
   Plugin URI: http://www.cactusthemes.com
   Description: Gameplan - Shortcodes
   Version: 1.5.13
   Package: GamePlan
   Author: Cactusthemes
   Author URI: http://www.cactusthemes.com
   License: Commercial
   */
if ( ! defined( 'GP_SHORTCODE_BASE_FILE' ) )
    define( 'GP_SHORTCODE_BASE_FILE', __FILE__ );
if ( ! defined( 'GP_SHORTCODE_BASE_DIR' ) )
    define( 'GP_SHORTCODE_BASE_DIR', dirname( GP_SHORTCODE_BASE_FILE ) );
if ( ! defined( 'GP_SHORTCODE_PLUGIN_URL' ) )
    define( 'GP_SHORTCODE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
	
/* ================================================================
 *
 * 
 * Class to register shortcode with TinyMCE editor
 *
 * Add to button to tinyMCE editor
 *
 */
class CactusThemeShortcodes{
	
	function __construct()
	{
		add_action('init',array(&$this, 'init'));
	}
	
	function init(){		
		if(is_admin()){
			// CSS for button styling
			wp_enqueue_style("ct_shortcode_admin_style", GP_SHORTCODE_PLUGIN_URL . '/shortcodes/shortcodes.css');
		}

		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
	    	return;
		}
	 
		if ( get_user_option('rich_editing') == 'true' ) {
			add_filter( 'mce_external_plugins', array(&$this, 'regplugins'));
			add_filter( 'mce_buttons_3', array(&$this, 'regbtns') );
			
			// remove a button. Used to remove a button created by another plugin
			remove_filter('mce_buttons_3', array(&$this, 'remobtns'));
		}
	}
	
	function remobtns($buttons){
		// add a button to remove
		// array_push($buttons, 'ct_shortcode_collapse');
		return $buttons;	
	}
	
	function regbtns($buttons)
	{
	    // register shortcode buttons
		// array_push($buttons, [name]);
		// array_push($buttons, 'shortcode_button_name');
		array_push($buttons, 'ct_font_icons');
		array_push($buttons, 'ct_dropcap');
		array_push($buttons, 'ct_heading');
		array_push($buttons, 'ct_checklist');
		array_push($buttons, 'shortcode_button');	
		array_push($buttons, 'ct_shortcode_compare_table');
		array_push($buttons, 'shortcode_facelike');
		array_push($buttons, 'shortcode_tooltip');
		array_push($buttons, 'shortcode_testimonial');
		array_push($buttons, 'shortcode_promoboxnew');
		
		array_push($buttons, 'shortcode_alert');
		array_push($buttons, 'shortcode_boxed');
		array_push($buttons, 'shortcode_carousel');
		array_push($buttons, 'shortcode_divider');
		array_push($buttons, 'shortcode_timeline');
		array_push($buttons, 'ct_shortcode_timeline_event');
		array_push($buttons, 'shortcode_portfolio');
		array_push($buttons, 'shortcode_member');
		array_push($buttons, 'shortcode_countdown_clock');
		array_push($buttons, 'shortcode_headline');
//		array_push($buttons, 'shortcode_promobox');
		array_push($buttons, 'shortcode_recentpost');
		array_push($buttons, 'shortcode_skill');
		array_push($buttons, 'shortcode_padding');
		return $buttons;
	}
	
	function regplugins($plgs)
	{
		// $plgs['shortcode_button_name'] = get_template_directory_uri() . '/inc/shortccodes/shortcode_sample.js';
		$plgs['ct_font_icons'] = GP_SHORTCODE_PLUGIN_URL . 'shortcodes/js/font-icon.js';
		$plgs['ct_heading'] = GP_SHORTCODE_PLUGIN_URL . 'shortcodes/js/heading.js';
		$plgs['ct_dropcap'] = GP_SHORTCODE_PLUGIN_URL . 'shortcodes/js/dropcap.js';
		$plgs['ct_checklist'] = GP_SHORTCODE_PLUGIN_URL . 'shortcodes/js/checklist.js';
		$plgs['ct_shortcode_compare_table'] = GP_SHORTCODE_PLUGIN_URL . 'shortcodes/js/compare-table.js';
		$plgs['shortcode_button'] = GP_SHORTCODE_PLUGIN_URL . 'shortcodes/js/button.js';
		$plgs['shortcode_facelike'] = GP_SHORTCODE_PLUGIN_URL . 'shortcodes/js/facelike.js';
		$plgs['shortcode_tooltip'] = GP_SHORTCODE_PLUGIN_URL . 'shortcodes/js/tooltip.js';
		$plgs['shortcode_testimonial'] = GP_SHORTCODE_PLUGIN_URL . 'shortcodes/js/testimonial.js';
		$plgs['shortcode_promoboxnew'] = GP_SHORTCODE_PLUGIN_URL . 'shortcodes/js/promoboxnew.js';
		
		$plgs['shortcode_alert'] = GP_SHORTCODE_PLUGIN_URL . 'shortcodes/js/alert.js';
		$plgs['shortcode_boxed'] = GP_SHORTCODE_PLUGIN_URL . 'shortcodes/js/boxedicon.js';
		$plgs['shortcode_carousel'] = GP_SHORTCODE_PLUGIN_URL . 'shortcodes/js/carousel.js';
		$plgs['shortcode_divider'] = GP_SHORTCODE_PLUGIN_URL . 'shortcodes/js/divider.js';
		$plgs['shortcode_timeline'] = GP_SHORTCODE_PLUGIN_URL . 'shortcodes/js/timeline.js';
		$plgs['ct_shortcode_timeline_event'] = GP_SHORTCODE_PLUGIN_URL . 'shortcodes/js/timeline-event-list.js';
		$plgs['shortcode_portfolio'] = GP_SHORTCODE_PLUGIN_URL . 'shortcodes/js/portfolio.js';
		$plgs['shortcode_member'] = GP_SHORTCODE_PLUGIN_URL . 'shortcodes/js/member.js';
		$plgs['shortcode_countdown_clock'] = GP_SHORTCODE_PLUGIN_URL . 'shortcodes/js/countdown_clock.js';
		$plgs['shortcode_headline'] = GP_SHORTCODE_PLUGIN_URL . 'shortcodes/js/headline.js';
//		$plgs['shortcode_promobox'] = GP_SHORTCODE_PLUGIN_URL . 'shortcodes/js/promobox.js';
		$plgs['shortcode_recentpost'] = GP_SHORTCODE_PLUGIN_URL . 'shortcodes/js/recent-post.js';
		$plgs['shortcode_skill'] = GP_SHORTCODE_PLUGIN_URL . 'shortcodes/js/skill.js';
		$plgs['shortcode_padding'] = GP_SHORTCODE_PLUGIN_URL . 'shortcodes/js/padding.js';
		return $plgs;
	}
}

$ctshortcode = new CactusThemeShortcodes();
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); //for check plugin status
// Register element with visual composer and do shortcode
/*include('inc/shortcodes/postslider.php');*/
//include('shortcodes/fliper.php');
if(is_plugin_active('gameplan-portfolio/gameplan-portfolio.php')){
	include('shortcodes/portfolio.php');
}

if(is_plugin_active('gameplan-member/gameplan-member.php')){
	include('shortcodes/member.php');
}
include('shortcodes/tooltip.php');
include('shortcodes/facelikebox.php');
include('shortcodes/compare_table.php');
include('shortcodes/testimonial.php');
include('shortcodes/promoboxnew.php');
include('shortcodes/timeline.php');
if(is_plugin_active('gameplan-events/gameplan-events.php')){
	include('shortcodes/timeline_event_list.php');
	include('shortcodes/modern-event-listing.php');
} elseif(is_plugin_active('the-events-calendar/the-events-calendar.php')){
	include('shortcodes/tribe-event-listing.php');
	include('shortcodes/timeline_event_list.php');
}

include('shortcodes/carousel.php');
include('shortcodes/font_icon.php');
include('shortcodes/heading.php');
include('shortcodes/checklist.php');
include('shortcodes/countdown_clock.php');

include('shortcodes/recent-post.php');
include('shortcodes/related-post.php');
include('shortcodes/boxedicon.php');
include('shortcodes/headline.php');
include('shortcodes/alert.php');
include('shortcodes/button.php');
include('shortcodes/divider.php');

include('shortcodes/skill.php');
include('shortcodes/dropcap.php');
include('shortcodes/image-frame.php');
include('shortcodes/post-gallery.php');
include('shortcodes/padding.php');

//function
if(!function_exists('cactus_hex2rgb')){
	function cactus_hex2rgb($hex) {
	   $hex = str_replace("#", "", $hex);
	
	   if(strlen($hex) == 3) {
		  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
		  $r = hexdec(substr($hex,0,2));
		  $g = hexdec(substr($hex,2,2));
		  $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   //return implode(",", $rgb); // returns the rgb values separated by commas
	   return $rgb; // returns an array with the rgb values
	}
}