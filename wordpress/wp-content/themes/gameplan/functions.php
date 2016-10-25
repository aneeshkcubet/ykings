<?php

if(!defined('PARENT_THEME')){
	define('PARENT_THEME','gameplan');
}

/* Define list of recommended and required plugins */
$_theme_required_plugins = array(
        array(
            'name'      => 'WP Pagenavi',
            'slug'      => 'wp-pagenavi',
            'required'  => true
        ),
		array(
            'name'      => 'Custom Sidebars',
            'slug'      => 'custom-sidebars',
            'required'  => false
        ),
		array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => false
        ),
		array(
            'name'      => 'The Events Calendar',
            'slug'      => 'the-events-calendar',
            'required'  => false
        ),
		array(
            'name'      => 'Flickr Badges Widget',
            'slug'      => 'flickr-badges-widget',
            'required'  => false
        ),
		array(
            'name'      => 'Gameplan - Member',
            'slug'      => 'gameplan-member',
            'required'  => false
        ),
		array(
            'name'      => 'Gameplan - Portfolio',
            'slug'      => 'gameplan-portfolio',
            'required'  => false
        ),
		array(
            'name'      => 'Gameplan - Shortcodes',
            'slug'      => 'gameplan-shortcodes',
            'required'  => true
        ),
		array(
            'name'      => 'Gameplan - Tribe - Addons',
            'slug'      => 'gameplan-tribe-addons',
            'required'  => false
        ),
		array(
            'name'      => 'Revolution Slider',
            'slug'      => 'revslider',
            'required'  => false
        )
    );
	
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); //for check plugin status


/**
 * =============== CACTUSTHEMES.COM ===================
 * ======== Cactusthemes Skeleton Framework ===========
 *          version 0.1 - created 29/4/2013
 * ====================================================
 */
require_once 'inc/core/skeleton-core.php';

/**
 * Load Theme Options settings
 */ 
require_once 'inc/theme-options.php';

/**
 * Load Theme Core Functions, Hooks & Filter
 */
require_once 'inc/core/theme-core.php';

if(is_plugin_active('woocommerce/woocommerce.php')){
	require_once 'inc/functions-woocommerce.php';
}

require_once 'sample-data/gp_importer.php'; /* to enable "one click install" sample data

/**
 * Sets up theme defaults and registers the various WordPress features that
 * theme supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 */
function cactusthemes_setup() {
	/*
	 * Makes theme available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 */
	load_theme_textdomain( 'cactusthemes', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	
	add_theme_support( 'woocommerce' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'gallery'));

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'cactusthemes' ) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'cactusthemes_setup' );

/**
 * Enqueues scripts and styles for front-end.
 */
function cactusthemes_scripts_styles() {
	global $wp_styles;
	
	/*
	 * Loads our main javascript.
	 */	
	
	wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '', true );
	wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/js/jquery-easing-1.3.js', array(), '', true );
	wp_register_script( 'jquery-isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array('jquery'), '', true );
	wp_register_script( 'isotope-portfolio', get_template_directory_uri() . '/js/isotope-portfolio.js', array('jquery'), '', true );
	wp_enqueue_script( 'modernizr-custom', get_template_directory_uri() . '/js/modernizr.custom.97074.js', array(), '', true );
	wp_register_script( 'jquery-hoverdir', get_template_directory_uri() . '/js/jquery.hoverdir.js', array('jquery'), '', true );
	wp_register_script( 'jquery-prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array('jquery'), '', true );	
	wp_enqueue_script( 'caroufredsel', get_template_directory_uri() . '/js/jquery.caroufredsel-6.2.1.min.js', array(), '', true );
	wp_register_script( 'gauge', get_template_directory_uri() . '/js/gauge.js', array(), '', true );
	wp_register_script( 'countto', get_template_directory_uri() . '/js/jquery.countTo.js', array(), '', true );
	// Include Flipclock
	wp_register_script( 'prefixfree', get_template_directory_uri() . '/js/flipclock/libs/prefixfree.min.js', array(), '', true );
	wp_register_script( 'flipclock', get_template_directory_uri() . '/js/flipclock/flipclock.min.js', array('jquery'), '', true );
		
	wp_enqueue_script( 'template', get_template_directory_uri() . '/js/template.js', array('jquery'), '', true );
    
	wp_register_script( 'js-scrollbox', get_template_directory_uri() . '/js/jquery.scrollbox.js', array(), '', true );
	wp_enqueue_script( 'waypoints' );

	/*
	 * Loads our main stylesheet.
	 */
	$gp_all_font = array();
	if(ot_get_option( 'text_font', 'Lato')!='Custom Font 1' && ot_get_option( 'text_font', 'Lato')!='Custom Font 2'){
		$gp_all_font[] = ot_get_option( 'text_font', 'Lato');
	}
	if(ot_get_option( 'h1_font', 'Gotham_Bold')!='Custom Font 1' && ot_get_option( 'h1_font', 'Gotham_Bold')!='Custom Font 2'){
		$gp_all_font[] = ot_get_option( 'h1_font', 'Gotham_Bold');
	}
	if(ot_get_option( 'nav_font', 'Open Sans')!='Custom Font 1' && ot_get_option( 'nav_font', 'Open Sans')!='Custom Font 2'){
		$gp_all_font[] = ot_get_option( 'nav_font', 'Open Sans');
	}
	$all_font=implode('|',$gp_all_font);

	wp_enqueue_style( 'google-font', '//fonts.googleapis.com/css?family='.$all_font );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style( 'bootstrap-responsive', get_template_directory_uri() . '/css/bootstrap-responsive.min.css');
	wp_enqueue_style( 'bootstrap-no-icons', get_template_directory_uri() . '/css/bootstrap.no-icons.min.css');
	wp_register_style( 'flipclock', get_template_directory_uri() . '/css/flipclock.css');
	global $font_awesome;
	if(ot_get_option('font_awesome')=='4'){
		wp_enqueue_style( 'gameplan-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');
		$font_awesome = 4;
	}else{
		wp_enqueue_style( 'gameplan-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css');
		$font_awesome = 3;
	}
	wp_register_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css');
	
	if(is_singular() ) wp_enqueue_script( 'comment-reply' );

	wp_enqueue_style( 'gameplan-style', get_bloginfo( 'stylesheet_url' ), array(),'20131023');
	wp_enqueue_style( 'icon-effect', get_template_directory_uri() . '/css/icon-effect.css');
	if(ot_get_option( 'theme_style') == 'dark'){
		wp_enqueue_style( 'dark-style', get_template_directory_uri() . '/css/dark-style.css');
	}

	if(is_plugin_active('woocommerce/woocommerce.php')){
		wp_enqueue_style( 'gameplan-woocommerce', get_template_directory_uri() . '/css/gameplan-woocommerce.css');
	}
	
	//wp_enqueue_style( 'custom-css', get_template_directory_uri() . '/css/custom.css.php');
	if(ot_get_option( 'righttoleft', 0)){
		wp_enqueue_style( 'rtl', get_template_directory_uri() . '/css/rtl.css');
	}
	if(ot_get_option( 'responsive', 1)!=1){
		wp_enqueue_style( 'no-responsive', get_template_directory_uri() . '/css/no-responsive.css');
	}	
}
add_action( 'wp_enqueue_scripts', 'cactusthemes_scripts_styles' );

add_action('wp_head','cactus_wp_head',100);
if(!function_exists('cactus_wp_head')){
	function cactus_wp_head(){
		echo '<!-- custom css -->
				<style type="text/css">';
		
		require get_template_directory() . '/css/custom.css.php';
		
		echo '</style>
			<!-- end custom css -->';
	}
}
/**
 * Registers our main widget area and the front page widget areas. 
 */
function cactusthemes_widgets_init() {
	$rtl = ot_get_option( 'righttoleft', 0);
	$rtl = 0; //fix new language selector
	
	register_sidebar( array(
		'name' => esc_html__( 'Main Sidebar', 'cactusthemes' ),
		'id' => 'main_sidebar',
		'description' => esc_html__( 'Appears all pages & posts, exepts for pages which have defined sidebar such as Blog or Search page.', 'cactusthemes' ),
		'before_widget' => '<div id="%1$s" class="widget box-style-1 %2$s">',
		'after_widget' => '</div>',
		'before_title' => $rtl ? '<div class="module-title"><span class="dotted">&nbsp;</span><h2 class="title">' : '<div class="module-title"><h2 class="title">',
		'after_title' => $rtl ? '</h2></div>' : '</h2><span class="dotted">&nbsp;</span></div>',
	));
	
	register_sidebar( array(
		'name' => esc_html__( 'Top Menu', 'cactusthemes' ),
		'id' => 'top_menu',
		'description' => '',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	
	register_sidebar( array(
		'name' => esc_html__( 'Search', 'cactusthemes' ),
		'id' => 'search',
		'description' => '',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));	
	
	register_sidebar( array(
		'name' => esc_html__( 'Navigation', 'cactusthemes' ),
		'id' => 'navigation',
		'description' => '',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	
	register_sidebar( array(
		'name' => esc_html__( 'Main Top', 'cactusthemes' ),
		'id' => 'main_top',
		'description' => '',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));

	
	register_sidebar( array(
		'name' => esc_html__( 'Single Blog Sidebar', 'cactusthemes' ),
		'id' => 'single_blog_sidebar',
		'description' => esc_html__( 'Sidebar in single post page. If there is no widgets, Main Sidebar will be used ', 'cactusthemes' ),
		'before_widget' => '<div id="%1$s" class="widget box-style-1 %2$s">',
		'after_widget' => '</div>',
		'before_title' => $rtl ? '<div class="module-title"><span class="dotted">&nbsp;</span><h2 class="title">' : '<div class="module-title"><h2 class="title">',
		'after_title' => $rtl ? '</h2></div>' : '</h2><span class="dotted">&nbsp;</span></div>',
	));
	register_sidebar( array(
		'name' => esc_html__( 'Single Event Sidebar', 'cactusthemes' ),
		'id' => 'single_event_sidebar',
		'description' => esc_html__( 'Sidebar in single event page. If there is no widgets, Main Sidebar will be used ', 'cactusthemes' ),
		'before_widget' => '<div id="%1$s" class="widget box-style-1 %2$s">',
		'after_widget' => '</div>',
		'before_title' => $rtl ? '<div class="module-title"><span class="dotted">&nbsp;</span><h2 class="title">' : '<div class="module-title"><h2 class="title">',
		'after_title' => $rtl ? '</h2></div>' : '</h2><span class="dotted">&nbsp;</span></div>',
	));
	register_sidebar( array(
		'name' => esc_html__( 'Blog Sidebar', 'cactusthemes' ),
		'id' => 'blog_sidebar',
		'description' => esc_html__( 'Sidebar in blog page. If there is no widgets, Main Sidebar will be used ', 'cactusthemes' ),
		'before_widget' => '<div id="%1$s" class="widget box-style-1 %2$s">',
		'after_widget' => '</div>',
		'before_title' => $rtl ? '<div class="module-title"><span class="dotted">&nbsp;</span><h2 class="title">' : '<div class="module-title"><h2 class="title">',
		'after_title' => $rtl ? '</h2></div>' : '</h2><span class="dotted">&nbsp;</span></div>',
	));
	register_sidebar( array(
		'name' => esc_html__( 'Event Listing Sidebar', 'cactusthemes' ),
		'id' => 'event_listing_sidebar',
		'description' => esc_html__( 'Sidebar in event listing page. If there is no widgets, Main Sidebar will be used ', 'cactusthemes' ),
		'before_widget' => '<div id="%1$s" class="widget box-style-1 %2$s">',
		'after_widget' => '</div>',
		'before_title' => $rtl ? '<div class="module-title"><span class="dotted">&nbsp;</span><h2 class="title">' : '<div class="module-title"><h2 class="title">',
		'after_title' => $rtl ? '</h2></div>' : '</h2><span class="dotted">&nbsp;</span></div>',
	));
	register_sidebar( array(
		'name' => esc_html__( 'Search Sidebar', 'cactusthemes' ),
		'id' => 'search_sidebar',
		'description' => esc_html__( 'Sidebar in search page. If there is no widgets, Main Sidebar will be used ', 'cactusthemes' ),
		'before_widget' => '<div id="%1$s" class="widget box-style-1 %2$s">',
		'after_widget' => '</div>',
		'before_title' => $rtl ? '<div class="module-title"><span class="dotted">&nbsp;</span><h2 class="title">' : '<div class="module-title"><h2 class="title">',
		'after_title' => $rtl ? '</h2></div>' : '</h2><span class="dotted">&nbsp;</span></div>',
	));

	register_sidebar( array(
		'name' => esc_html__( 'Body Bottom', 'cactusthemes' ),
		'id' => 'body_bottom',
		'description' => '',
		'before_widget' => '<div id="%1$s" class="widget box-style-3 %2$s">',
		'after_widget' => '</div>',
		'before_title' => $rtl ? '<div class="module-title"><span class="dotted">&nbsp;</span><h2 class="title">' : '<div class="module-title"><h2 class="title">',
		'after_title' => $rtl ? '</h2></div>' : '</h2><span class="dotted">&nbsp;</span></div>',
	));	
	
	register_sidebar( array(
		'name' => esc_html__( 'Main Bottom', 'cactusthemes' ),
		'id' => 'main_bottom',
		'description' => '',
		'before_widget' => '<div id="%1$s" class="widget box-style-3 %2$s">',
		'after_widget' => '</div>',
		'before_title' => $rtl ? '<div class="module-title"><span class="dotted">&nbsp;</span><h2 class="title">' : '<div class="module-title"><h2 class="title">',
		'after_title' => $rtl ? '</h2></div>' : '</h2><span class="dotted">&nbsp;</span></div>',
	));
		
	register_sidebar( array(
		'name' => esc_html__( 'Copyright', 'cactusthemes' ),
		'id' => 'copyright',
		'description' => '',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	
	if(is_plugin_active('woocommerce/woocommerce.php')){
		register_sidebar( array(
			'name' => esc_html__( 'WooCommerce Sidebar', 'cactusthemes' ),
			'id' => 'woocommerce',
			'description' => esc_html__( 'Appears in WooCommerce Pages. If empty, Main Sidebar will be used', 'cactusthemes' ),
			'before_widget' => '<div id="%1$s" class="widget box-style-1 %2$s">',
			'after_widget' => '</div>',
			'before_title' => $rtl ? '<div class="module-title"><span class="dotted">&nbsp;</span><h2 class="title">' : '<div class="module-title"><h2 class="title">',
			'after_title' => $rtl ? '</h2></div>' : '</h2><span class="dotted">&nbsp;</span></div>',
		));
	}
}
add_action( 'widgets_init', 'cactusthemes_widgets_init' );

/* Functions, Hooks, Filters and Registers in Admin */
require_once 'inc/functions-admin.php';

/* Register Thumbnail Size */
add_image_size('thumb_100x100',100,100, true);
add_image_size('thumb160x120',160,120, true);
add_image_size('thumb_360x240',360,240, true);// classic blog listing (with sidebar)
add_image_size('thumb_467x9999',467,312, true);// classic blog listing (no sidebar)
add_image_size('small-carousel',245,136, true);// small carousel
add_image_size('medium-carousel',390,217, true);// medium carousel

add_image_size('thumb_250x200',250,200, true);
add_image_size('thumb_860x430',860,430, true);

//mobile bg
add_image_size('page_mobile_bg',540,9999, true);
//shop
add_image_size('thumb_279x358',279,358, true); //shop

// Hook widget 'SEARCH'
add_filter('get_search_form', 'cactus_search_form'); 
function cactus_search_form($text) {
	$text = str_replace('value=""', 'placeholder="'.esc_html__("SEARCH",'cactusthemes').'"', $text);
    return $text;
}

/**
 * Hook before widget 
 */
if(!is_admin()){
	add_filter('dynamic_sidebar_params', 'gameplan_hook_before_widget'); 	
	function gameplan_hook_before_widget($params){
		/* Add a wrapper <div> to widgets in Body Bottom and Main Bottom based on layout setting in Theme Options */
		$pos = array('body_bottom','main_bottom');
		foreach($pos as $p){
			if($params[0]['id'] == $p){
				$layout = ot_get_option($p.'_layout',4); // not yet working
				$span = 12;
				switch($layout){
					case 1:
						$span = 12;
						break;
					case 2:
						$span = 6;
						break;
					case 3:
						$span = 4;
						break;
					case 4:
						$span = 3;
						break;
				}
				
				$params[0]['before_widget'] = preg_replace('/<div/', '<div class="span'.$span.'"><div', $params[0]['before_widget'], 1);
				$params[0]['after_widget'] .= '</div>';
			}
		}
	
		return $params;
	} 
}

/* Filter widget titles to add first word different */
add_filter('widget_title','gameplan_filter_widget_titles');
function gameplan_filter_widget_titles($old_title){
	$title = explode( " ", $old_title, 2 );
	$title[0] = isset($title[0]) ? $title[0] : null;
	$title[1] = isset($title[1]) ? $title[1] : null;
	$titleNew='';
	if($title[0]!=''||$title[1]!=''){
	$titleNew = "<span class='title def_style'>
		<span class='title-text'>
			<span class='firstword'>$title[0]</span> $title[1]
		</span>
	</span>";
	}
	return $titleNew;
}

// Functions 
function head_slide($pgs, $id='', $class='', $single_page=array()){
	if($single_page == NULL){
		$html = '
			<div id="'.$id.'" class="customslider">
				<div class="slides">
					<div class="slide">
						<div class="'.$class.'">
		';
	}elseif(isset($single_page['head']) && $single_page['head']){
		$html = '
			<div id="'.$id.'" class="'.$class.' customslider">
				<div class="slides">
		';
	}elseif(isset($single_page['page']) && $single_page['page']){
		$html = '
			<div class="slide">
				<div class="'.$class.'">
		';
	}	
	return $html;
}

function footer_slide($single_page=array(),$class=''){
	global $font_awesome;
	if($single_page == NULL){
		$html = '
						</div>
					</div>
				</div>
				<div class="clear"><!----></div>
				<div class="'.$class.' slides-control">
					<div class="dotted"><!---->
					<div class="control-a">
						<a href="javascript:void(0)" class="pre icon-sign-blank '.($font_awesome==4?'fa fa-square':'').'">
							<span class="icon-caret-left '.($font_awesome==4?'fa fa-caret-left':'').'"><!----></span>
						</a>
						<a href="javascript:void(0)" class="next icon-sign-blank '.($font_awesome==4?'fa fa-square':'').'">
							<span class="icon-caret-right '.($font_awesome==4?'fa fa-caret-right':'').'"><!----></span>
						</a>
					</div>
					</div>
				</div>
				<div class="clear"><!----></div>
			</div>
		';
	}elseif(isset($single_page['head'])){
		$html = '
				</div>
				<div class="clear"><!----></div>
				<div class="slides-control">
					<div class="dotted"><!---->
					<div class="control-a">
						<a href="javascript:void(0)" class="pre icon-sign-blank '.($font_awesome==4?'fa fa-square':'').'">
							<span class="icon-caret-left '.($font_awesome==4?'fa fa-caret-left':'').'"><!----></span>
						</a>
						<a href="javascript:void(0)" class="next icon-sign-blank '.($font_awesome==4?'fa fa-square':'').'">
							<span class="icon-caret-right '.($font_awesome==4?'fa fa-caret-right':'').'"><!----></span>
						</a>
					</div>
					</div>
				</div>
				<div class="clear"><!----></div>
			</div>
		';
	}elseif(isset($single_page['page'])){
		$html = '
					</div>
				</div>
		';
	}
	return $html;
}
if(!function_exists('show_social_icon')){
	function show_social_icon($arr_social = array()){
		global $font_awesome;
		$html = '';
		$social_link_open = ot_get_option( 'social_link_open');
		if($social_link_open=='on'){$target='target="_blank"';}
		if(count($arr_social) > 0){
			foreach($arr_social as $key => $value){
				if(isset($value) && $value != ''){
					if($key=='envelope'){
						$html .= '<a href="mailto:'.$value.'" class="icon-social icon-'.str_replace('_', '-', $key).' '.($font_awesome==4?'fa fa-'.str_replace('_', '-', $key):'').'" style="padding-top: 2.5px; padding-right: 8.5px; padding-left: 6px;" '.$target.' ><!-- --></a>';
					}else {
						$html .= '<a href="'.$value.'" class="icon-social icon-'.str_replace('_', '-', $key).' '.($font_awesome==4?'fa fa-'.str_replace('_', '-', $key):'').'" '.$target.'><!-- --></a>';
					}
				}
			}
		}
		return $html;
	}
}

function get_related_posts($post_id) {
	$query = new WP_Query();
    
    $args = '';

	$args = wp_parse_args($args, array(
		'showposts' => -1,
		'post__not_in' => array($post_id),
		'ignore_sticky_posts' => 0,
        'category__in' => wp_get_post_categories($post_id)
	));
	
	$query = new WP_Query($args);
	
  	return $query;
}

function gp_social_share($post_ID){ ?>
<div id="social-share">
    <a href="#" style="text-decoration:none" title="Share on Facebook" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href),'facebook-share-dialog','width=626,height=436');return false;">
        <img src="<?php echo get_template_directory_uri() ?>/images/facebook.gif" style="vertical-align:top; margin-top:1px" />
    </a>
    &nbsp;
    <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink($post_ID)) ?>&amp;width=450&amp;height=21&amp;colorscheme=light&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;send=false&amp;appId=498927376861973" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:85px; height:21px;" allowTransparency="true"></iframe>
    &nbsp;
    <a href="https://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
	&nbsp;
    <a href="//pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink($post_ID)) ?>&media=<?php echo urlencode(wp_get_attachment_url( get_post_thumbnail_id($post_ID))); ?>&description=<?php echo urlencode(get_the_title($post_ID)) ?>" data-pin-do="buttonPin" data-pin-config="none"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a>
    <script type="text/javascript">
    (function(d){
      var f = d.getElementsByTagName('SCRIPT')[0], p = d.createElement('SCRIPT');
      p.type = 'text/javascript';
      p.async = true;
      p.src = '//assets.pinterest.com/js/pinit.js';
      f.parentNode.insertBefore(p, f);
    }(document));
    </script>
    &nbsp;
    <div class="g-plusone" data-size="medium" data-annotation="none"></div>
    <script type="text/javascript">
      window.___gcfg = {lang: 'en-GB'};
    
      (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/plusone.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
      })();
    </script>
</div>
<?php }


if(!function_exists('html_tags_project')){
	/* Function to write project/portfolio tags filter */
	function html_tags_project($all_tags){
		$html = '';
		if(count($all_tags) > 0){
			$html .= '
				<div class="center">			
				   <ul id="project-tags" class="project-tags">
						<li><a class="active" href="javascript:void(0)" data-filter="*">'.esc_html__('All','cactusthemes').'</a></li>
			';
			foreach ($all_tags as $tag){
				//var_dump($tag);
				$html .= '				
					<li><a href="javascript:void(0)" data-filter=".'.$tag->slug.'">'.$tag->name.'</a></li>
				';
			}
			$html .= '
					</ul>
				</div>
			';
		}
		return $html;
	}
}

/* Tribe Events Calendar support 
 *
 *
 */


/* Get heading of Tribe Events page
 * 
 * Return : array[2]{heading,sub-heading} if found, false if not found
 * check https://gist.github.com/jo-snips/2415009
 *
 */
function get_tribe_events_page_heading(){

	if(class_exists('Tribe__Events__Main') && is_tribe_page()){
		if(((tribe_is_event() || get_post_type() == 'tribe_organizer') && is_single()) || tribe_is_venue()){
			// Single Eveng
			$heading = get_the_title(get_the_ID());
		} else {
			// List View
			$heading = tribe_get_events_title(); 		
		}
		if(is_single()){
		$sub_heading = '<a class="single_links" href="'.tribe_get_events_link().'">&laquo; ' . esc_html__('All Events','cactusthemes') . '</a>';
		}
		return array($heading,$sub_heading);
	} else return false;
}

/* Check if current page is a tribe page (listing, single ...) */
function is_tribe_page(){
	wp_reset_postdata();//reset custom query
	if(class_exists('Tribe__Events__Main')){
		if( tribe_is_month() && !is_tax() ) { // Month View Page 
			return true;		 
		} elseif( tribe_is_month() && is_tax() ) { // Month View Category Page
		 
		return true;
		 
		} elseif( tribe_is_past() || tribe_is_upcoming() && !is_tax() ) { // List View Page
		 
		return true;
		 
		} elseif( tribe_is_past() || tribe_is_upcoming() && is_tax() ) { // List View Category Page
		 
		return true;
		 
		} elseif( tribe_is_event() && is_single() ) { // Single Events
		 
		return true;
		 
		} elseif(class_exists('Tribe__Events__Pro__Main')){
			if( tribe_is_week() && !is_tax() ) { // Week View Page
		 
		return true;
		 
		} elseif( tribe_is_week() && is_tax() ) { // Week View Category Page
		 
		return true;
		 
		} elseif( tribe_is_day() && !is_tax() ) { // Day View Page
		 
		return true;
		 
		} elseif( tribe_is_day() && is_tax() ) { // Day View Category Page
		 
		return true;
		 
		} elseif( tribe_is_map() && !is_tax() ) { // Map View Page
		 
		return true;
		 
		} elseif( tribe_is_map() && is_tax() ) { // Map View Category Page
		 
		return true;
		 
		} elseif( tribe_is_photo() && !is_tax() ) { // Photo View Page
		 
		return true;
		 
		} elseif( tribe_is_photo() && is_tax() ) { // Photo View Category Page
		 
		return true;
		 
		} elseif( get_post_type() == 'tribe_organizer' && is_single() ) { // Single Organizers
		 
		return true;
		 
		} elseif( tribe_is_venue() ) { // Single Venues
		 
		return true;
		 
		} 
		}
	}
	return false;
}
function tribe_single_related_events_fix($count = 3, $post_type = Tribe__Events__Main::POSTTYPE ) {
	if(function_exists('tribe_get_related_posts')){
	$count = ot_get_option( 'number_re_event');
	if($count==''){$count=3;}
	$posts = tribe_get_related_posts( $count);
	if ( is_array( $posts ) && !empty( $posts ) ) {
		echo '<div>'.do_shortcode('[divider colorstyle="colorstyle_2" dividerstyle="style_2" paddingtop="40" paddingbottom="10" animation="" ]').'</div>';
		echo '<h3 class="tribe-events-related-events-title">'.  esc_html__( 'Related Events', 'tribe-events-calendar-pro' ) .'</h3>';
		echo '<ul class="tribe-related-events tribe-clearfix hfeed vcalendar">';
		foreach ( $posts as $post ) {
			echo '<li>';

				$thumb = ( has_post_thumbnail( $post->ID ) ) ? get_the_post_thumbnail( $post->ID, 'thumb_100x100' ) : '<img src="'. trailingslashit( Tribe__Events__Pro__Main::instance()->pluginUrl ) . 'resources/images/tribe-related-events-placeholder.png" alt="'. get_the_title( $post->ID ) .'" />';;
				echo '<div class="tribe-related-events-thumbnail">';
				echo '<a href="'. get_permalink( $post->ID ) .'" class="url" rel="bookmark">'. $thumb .'</a>';
				echo '</div>';
				echo '<div class="tribe-related-event-info">';
					echo '<h3 class="tribe-related-events-title summary"><a href="'. get_permalink( $post->ID ) .'" class="url" rel="bookmark">'. get_the_title( $post->ID ) .'</a></h3>';

					if ( class_exists( 'Tribe__Events__Main' ) && $post->post_type == Tribe__Events__Main::POSTTYPE && function_exists( 'tribe_events_event_schedule_details' ) ) {
						echo tribe_events_event_schedule_details( $post );
					}
					if ( class_exists( 'Tribe__Events__Main' ) && $post->post_type == Tribe__Events__Main::POSTTYPE && function_exists( 'tribe_events_event_recurring_info_tooltip' ) ) {
						echo tribe_events_event_recurring_info_tooltip( $post->ID );
					}
				echo '</div>';
			echo '</li>';
		}
		echo '</ul>';
		echo '<div>'.do_shortcode('[divider colorstyle="colorstyle_2" dividerstyle="style_1" paddingtop="" paddingbottom="" animation="" ]').'</div>'; 	
	}
	}
}
function gp_is_plugin_active( $plugin ) {
    return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
}
function gp_excerpt_more($more) {
	return '';
}
add_filter('excerpt_more', 'gp_excerpt_more');
function tribe_events_single_event_meta_fix() {
	$event_id = get_the_ID();
	$skeleton_mode = apply_filters( 'tribe_events_single_event_the_meta_skeleton', false, $event_id ) ;
	$group_venue = apply_filters( 'tribe_events_single_event_the_meta_group_venue', false, $event_id );
	$html = '';

	if ( $skeleton_mode ) {

		// show all visible meta_groups in skeleton view
		$html .= tribe_get_the_event_meta();

	} else {
		$html .= '<div class="dotted"></div><div class="tribe-events-single-section tribe-events-event-meta tribe-clearfix">';
		// Event Details
		$html .= tribe_get_meta_group( 'tribe_event_details' );

		// When there is no map show the venue info up top
		if ( ! $group_venue && ! tribe_embed_google_map( $event_id ) ) {
			// Venue Details
			$html .= tribe_get_meta_group( 'tribe_event_venue' );
			$group_venue = false;
		} else if ( ! $group_venue && ! tribe_has_organizer( $event_id ) && tribe_address_exists( $event_id ) && tribe_embed_google_map( $event_id ) ) {
			$html .= sprintf( '%s<div class="tribe-events-meta-group tribe-events-meta-group-gmap">%s</div>',
				tribe_get_meta_group( 'tribe_event_venue' ),
				tribe_get_meta( 'tribe_venue_map' )
			);
			$group_venue = false;
		} else {
			$group_venue = true;
		}

		// Organizer Details
		if ( tribe_has_organizer( $event_id ) ) {
			$html .= tribe_get_meta_group( 'tribe_event_organizer' );
		}

		$html .= apply_filters( 'tribe_events_single_event_the_meta_addon', '', $event_id );
		$html .= '</div>';

	}

	if ( ! $skeleton_mode && $group_venue ) {
		// If there's a venue map and custom fields or organizer, show venue details in this seperate section
		$venue_details = tribe_get_meta_group( 'tribe_event_venue' ) .
						 tribe_get_meta( 'tribe_venue_map' );

		if ( !empty($venue_details) ) {
			$html .= apply_filters( 'tribe_events_single_event_the_meta_venue_row', sprintf( '<div class="dotted"></div><div class="tribe-events-single-section tribe-events-event-meta tribe-clearfix">%s</div>',
				$venue_details
			) );
		}
	}
	return apply_filters( 'tribe_events_single_event_meta', $html );
}
function pp_buttom($subscribe_bt,$b) {
	if($subscribe_bt=='pp_buynow'){
		echo '<a href="'.$b.'"><img alt="'. esc_html__('Buy Now Button', 'cactusthemes').'" class="button_pp" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" /></a>';
	}else if($subscribe_bt=='pp_subscribe'){
		echo '<a href="'.$b.'"><img alt="'. esc_html__('Subscribe Button', 'cactusthemes').'" class="button_pp" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribe_LG.gif" /></a>';
	}else if($subscribe_bt=='pp_donate'){
		echo '<a href="'.$b.'"><img alt="'. esc_html__('Donate Button', 'cactusthemes').'" class="button_pp" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" /></a>';
	}else if($subscribe_bt=='pp_addtocart'){
		echo '<a href="'.$b.'"><img alt="'. esc_html__('Add to cart Button', 'cactusthemes').'" class="button_pp" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_LG.gif" /></a>';
	}else if($subscribe_bt=='pp_buygift'){
		echo '<a href="'.$b.'"><img alt="'. esc_html__('Buy gift Button', 'cactusthemes').'" class="button_pp buygift" src="https://www.paypalobjects.com/en_US/i/btn/btn_gift_LG.gif" /></a>';
	}
}






