<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><html lang="en" class="no-js" <?php language_attributes(); ?>> <![endif]-->
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php
    // if(tfuse_options('disable_tfuse_seo_tab')) {
    //     wp_title( '|', false, 'right' );
    //     bloginfo( 'name' );
    //     $site_description = get_bloginfo( 'description', 'display' );
    //     if ( $site_description && ( is_home() || is_front_page() ) )
    //         echo " | $site_description";
    // } else
    //     wp_title('');
    the_title('YKings ');?>
    </title>
    <?php tfuse_meta(); ?>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php
        global $is_tf_blog_page;
        if ( is_singular() && get_option( 'thread_comments' ) )
                wp_enqueue_script( 'comment-reply' );

        tfuse_head();
        wp_head();
    ?>
</head>
<body <?php body_class();?>>
    <div id="page" class="hfeed site">
        <header id="masthead" class="site-header">
            
            <span id="menu-call" class="tficon-menu invisible"></span>
            
            <div class="header invisible <?php //echo tfuse_sticky_menu();?>">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="site-logo"><?php tfuse_type_logo();?></div>
                            <?php  tfuse_menu('default');  ?>
                        </div>
                         <!-- <div class="btn">
                            <a><span>NEWSLETTER SIGNUP</span>
                        </div> -->
                    </div>

                </div>
            </div>
        </header>
<?php if($is_tf_blog_page) tfuse_category_on_blog_page();?>
    <div id="main" class="site-main" role="main">