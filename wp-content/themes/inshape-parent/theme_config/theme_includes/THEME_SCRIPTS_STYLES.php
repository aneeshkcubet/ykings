<?php

add_action( 'wp_enqueue_scripts', 'tfuse_add_css' );
add_action( 'wp_enqueue_scripts', 'tfuse_add_js' );

if ( ! function_exists( 'tfuse_add_css' ) ) :
/**
 * This function include files of css.
 */
    function tfuse_add_css()
    {
        wp_register_style( 'bootstrap',  tfuse_get_file_uri('/css/bootstrap.min.css', false, '') );
        wp_enqueue_style( 'bootstrap' );
    
        wp_register_style( 'style', get_stylesheet_uri());
        wp_enqueue_style( 'style' );
        
        wp_register_style( 'font-awesome',  tfuse_get_file_uri('/css/font-awesome.css', true, '') );
        wp_enqueue_style( 'font-awesome' );

        wp_register_style( 'prettyPhoto', TFUSE_ADMIN_CSS . '/prettyPhoto.css', false, '' );
        wp_enqueue_style( 'prettyPhoto' );
        
        wp_register_style( 'animate',  tfuse_get_file_uri('/css/animate.css', true, '') );
        wp_enqueue_style( 'animate' );
        
        wp_register_style( 'print',  tfuse_get_file_uri('/css/print.css', true, ''), array(), false, 'print' );
        wp_enqueue_style( 'print' );
        
        wp_register_style( 'shCore',  tfuse_get_file_uri('/css/shCore.css', true, '') );
        wp_enqueue_style( 'shCore' );
        
        wp_register_style( 'video-js',  tfuse_get_file_uri('/css/video-js.css', true, '') );
        wp_enqueue_style( 'video-js' );
        
        wp_register_style( 'shThemeDefault',  tfuse_get_file_uri('/css/shThemeDefault.css', true, '') );
        wp_enqueue_style( 'shThemeDefault' );
    }
endif;


if ( ! function_exists( 'tfuse_add_js' ) ) :
/**
 * This function include files of javascript.
 */
    function tfuse_add_js()
    {

        wp_enqueue_script( 'jquery' );
        
        wp_register_script( 'modernizr', tfuse_get_file_uri('/js/libs/modernizr.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'modernizr' );
		
        wp_register_script( 'respond', tfuse_get_file_uri('/js/libs/respond.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'respond' );	

        wp_register_script( 'jquery-ui-1.10.4.min', tfuse_get_file_uri('/js/libs/jquery-ui-1.10.4.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery-ui-1.10.4.min' );
        
        wp_register_script( 'bootstrap', tfuse_get_file_uri('/js/libs/bootstrap.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'bootstrap' );

        wp_register_script( 'general', tfuse_get_file_uri('/js/general.js'), array('jquery'), '', true );
        wp_enqueue_script( 'general' );
                
        wp_register_script( 'cusel-min',  tfuse_get_file_uri('/js/cusel.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'cusel-min' );
        
        wp_register_script( 'jquery.carouFredSel-6.2.1-packed',  tfuse_get_file_uri('/js/jquery.carouFredSel-6.2.1-packed.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.carouFredSel-6.2.1-packed' );
        
        wp_register_script( 'jquery.customInput',  tfuse_get_file_uri('/js/jquery.customInput.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.customInput' );
        
        wp_register_script('maps.google.com', 'http://maps.google.com/maps/api/js?sensor=false', array('jquery'), '1.0', true);
        wp_enqueue_script('maps.google.com');
        
        wp_register_script( 'jquery.gmap.min',  tfuse_get_file_uri('/js/jquery.gmap.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.gmap.min' );
        
        wp_register_script( 'isotope.pkgd.min',  tfuse_get_file_uri('/js/isotope.pkgd.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'isotope.pkgd.min' );
		
	wp_register_script( 'jquery.powerful-placeholder.min',  tfuse_get_file_uri('/js/jquery.powerful-placeholder.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.powerful-placeholder.min' );
        
        wp_register_script( 'jquery.slicknav.min',  tfuse_get_file_uri('/js/jquery.slicknav.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.slicknav.min' );
        
	wp_register_script( 'jquery.touchSwipe.min',  tfuse_get_file_uri('/js/jquery.touchSwipe.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.touchSwipe.min' );
        
        wp_register_script( 'video',  tfuse_get_file_uri('/js/video.js'), array('jquery'), '', true );
        wp_enqueue_script( 'video' );
        
        wp_register_script( 'prettyPhoto', TFUSE_ADMIN_JS . '/jquery.prettyPhoto.js', array('jquery'), '3.1.4', true );
        wp_enqueue_script( 'prettyPhoto' );
        
        // JS is include on the footer
        wp_register_script( 'shCore', tfuse_get_file_uri('/js/shCore.js'), array('jquery'), '', true );
        wp_enqueue_script( 'shCore' );
        
        wp_register_script( 'shBrushPlain', tfuse_get_file_uri('/js/shBrushPlain.js'), array('jquery'), '', true );
        wp_enqueue_script( 'shBrushPlain' );
        
        wp_register_script( 'sintaxHighlighter', tfuse_get_file_uri('/js/sintaxHighlighter.js'), array('jquery'), '', true );
        wp_enqueue_script( 'sintaxHighlighter' );
    }
endif;