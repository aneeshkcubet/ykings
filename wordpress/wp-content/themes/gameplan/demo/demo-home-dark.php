<?php
/**
 * Template Name: Demo Home Dark
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<?php if(ot_get_option( 'responsive', 0)){ ?>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<?php } ?>
		<script type="text/javascript">
			_THEME_URL_ = "<?php echo get_stylesheet_directory_uri(); ?>";
		</script>
		<title>
			<?php 
			$headings = get_tribe_events_page_heading();
			if($headings !== false){
				echo strip_tags($headings[0]);
			} elseif(is_404()&&ot_get_option('page404_title',false)){
				echo ot_get_option('page404_title','Page not found'); 
			}
			else {
				wp_title( '|', true, 'right' ); 
			}
			?>
		</title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
		<![endif]-->
		<script type="text/javascript">
			var is_isotope = false;
			<?php if(ot_get_option('portfolio_animation') == 'isoptope'):?> is_isotope = true; <?php endif;?>
		</script>
		<?php
		if(is_active_sidebar('main_top')){
			$background = ot_get_option('background_slider');
			$back1=isset($background['background-image'])?$background['background-image']:'';
			$back2=isset($background['background-color'])?$background['background-color']:'';
			if($back1!='' || $back2!='')	{
		?>
		
		<style type="text/css" >
			#slider{
				<?php if(isset($background['background-image'])){?>background:<?php echo $background['background-color'];?> url(<?php echo $background['background-image'];?>) <?php echo $background['background-attachment'];?> center 0 <?php echo $background['background-repeat'];?>;background-size:cover<?php }?>
			}
		</style>
		<?php
			}
		}
		?>
<?php if(ot_get_option('retina_logo')):?>
<style type="text/css" >
	@media only screen and (-webkit-min-device-pixel-ratio: 2),(min-resolution: 192dpi) {
		/* Retina Logo */
		.logo{background:url(<?php echo get_template_directory_uri()?>/images/gameplan-logo-dark-2x.png) no-repeat center; display:inline-block !important; background-size:contain;}
		.logo img{ opacity:0; visibility:hidden}
		.logo *{display:inline-block}
	}
</style>
<?php endif;?>


<style type="text/css">
	<?php
	$gp_navigation_transparent = 100;
		$gp_theme_style = 'dark-style';
		$gp_navigation_bg = $gp_theme_style=='light'?'FFFFFF':'000000';
	?>
	#navigation #nav-bottom.bg-container .nav-bottom {
		background:rgba(<?php echo cactus_hex2rgba($gp_navigation_bg,$gp_navigation_transparent) ?>) !important;
	}
	body.dark{
		background:url(http://gameplan.cactusthemes.com/wp-content/uploads/2014/02/Dark-Pattern.png) repeat !important;
	}
</style>
<?php 
global $gp_main_color;
$gp_main_color = '#ff7d00';
wp_enqueue_style( 'dark-style', get_template_directory_uri() . '/css/dark-style.css');
wp_head(); ?>
<!--[if lte IE 9]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie.css" />
<![endif]-->						
</head>
<?php
$body_class = '';
$body_class .= 'light dark ';
$body_class .= ot_get_option( 'layout', false) ? ot_get_option( 'layout' ).' ' : '';
$body_class .= ot_get_option( 'responsive', 1) ? '' : 'no-responsive ';

$body_class .= 'home ';
$revslider = get_post_meta($post->ID,'revslider',true);
$body_class .= ($revslider == '') ? 'use-maintop-sidebar ' : '';
global $default_color;
$default_color = '#ffd600';
?>
<body <?php body_class($body_class) ?>>
<a name="top" style="height:0; position:absolute; top:0;"></a>
	<div class="clear"></div>
    <header>
		<?php 
            // Navigation part of template
            global $font_awesome;
        ?>
        <div id="navigation">
                    <?php if(ot_get_option( 'topmenu_visible', 1)){?>
                    <div class="bg-container" id="nav-top">
                        <div class="container">
                            <div class="container-pad">
                                <div class="row-fluid">
                                    <div class="span6">
                                        <div class="nav-contact">
                                            <?php if(is_active_sidebar('top_menu')):?>                                    
                                                <?php echo get_dynamic_sidebar('top_menu');?>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                <div class="span6 text-right">
                                    <?php 
                                    $arr_social = array(
                                        'facebook' => ot_get_option('acc_facebook'),
                                        'envelope' => ot_get_option('acc_envelope'),
                                        'twitter' => ot_get_option('acc_twitter'),
                                        'linkedin' => ot_get_option('acc_linkedin'),
                                        //'behance' => ot_get_option('acc_behance'),
                                        'dribbble' => ot_get_option('acc_dribbble'),
                                        'flickr' => ot_get_option('acc_flickr'),
                                        'google_plus' => ot_get_option('acc_google_plus'),
                                        'instagram' => ot_get_option('acc_instagram'),
                                        'tumblr' => ot_get_option('acc_tumblr'),
                                        'pinterest_sign' => ot_get_option('acc_pinterest_sign'),
                                        'github' => ot_get_option('acc_github'),
                                        'youtube' => ot_get_option('acc_youtube'),
                                    );
                                    echo show_social_icon($arr_social);
                                    ?>
                                    <?php if(is_active_sidebar('search')):?>
                                        <div id="search">
                                            <?php echo get_dynamic_sidebar('search');?>
                                        </div>
                                    <?php endif;?>
                                    <span style="height:35px;display:inline-block;vertical-align:middle; margin-left:-4px"></span>
                                </div>
        
                            </div>
                        </div>
                    </div>
                    </div>
                    <?php }?>
                    <?php if(ot_get_option( 'nav_show', 1)){?>
                    <div class="bg-container" id="nav-bottom">
                        <div class="shadow"><!----></div>
                        <div class="nav-bottom">                	
                            <div class="container">
                                <div class="container-pad">
                                    <div class="row-fluid">
                                        <div class="span3">
                                            <a class="logo" href="<?php echo get_home_url(); ?>" title="<?php wp_title( '|', true, 'right' ); ?>"><img src="<?php echo get_template_directory_uri()?>/images/gameplan-logo-dark-1x.png" alt="<?php wp_title( '|', true, 'right' ); ?>" /></a>
                                        </div>
                                        <div class="span9">                            
                                            <div id="navigation-menu">
                                                <div class="current-menu"></div>                            
                                                <?php
                                                    if(is_active_sidebar('navigation'))
                                                        echo get_dynamic_sidebar('navigation');
                                                    else
                                                        wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'menu','container_class'=>'menu-main-menu-container','walker'=> new custom_walker_nav_menu()));
                                                ?>                                                                           
                                            </div>
                                            <div id="navigation-menu-mobile" class="hide">
                                                <?php
                                                    wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'menu-mobile','container_class'=>'menu-main-menu-container','walker'=> new custom_walker_nav_menu_mobile(), 'items_wrap' => '<div class="divselect"><select onchange="if(this.value != \'\' && this.value != \'#\') location.href=this.value" id="%1$s" class="%2$s"><option value="#" style=" display:none"></option>%3$s</select><span class="spanselect"></span><i class="icon-reorder '.($font_awesome==4?'fa fa-reorder':'').'"></i></div>','fallback_cb'=>false));
                                                    
                                                ?>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    $sticky_show_menu=ot_get_option( 'sticky_show_menu');
                    if($sticky_show_menu=='1'){ ?>
                        <script>
                        jQuery(document).ready(function(){
                            if(jQuery(document).scrollTop()>35){
                                jQuery('#navigation').addClass('pos_fixed_nav');
                            }
                           jQuery(window).scroll(function(e){
                               if(jQuery(document).scrollTop()>35){
                                    jQuery('#navigation').addClass('pos_fixed_nav');
                               }else{
                                   jQuery('#navigation').removeClass('pos_fixed_nav');
                               }
                           }); 
                        });
                        </script>
                    <?php }?>
        </div>		<?php 
		$revslider = get_post_meta($post->ID,'revslider',true);
		$slider = ot_get_option('slider_section');
		if($revslider != ''){
			// use revolution slider
			$slider_style = (get_post_meta(get_the_ID(),'slider_style',true)=='def'||get_post_meta(get_the_ID(),'slider_style',true)=='')?ot_get_option('slider_style','wide'):get_post_meta(get_the_ID(),'slider_style',true);
			?>
			<div id="slider" class="<?php echo $slider_style ?>">
			<?php echo do_shortcode('[rev_slider '.$revslider.']');?>
			</div>
			<?php
		}
		?>
    </header>
    <div class="clear"></div>
    <div id="body">
    	<div id="wrapper">      

        <div class="bg-container single-post-body"> 
            <div class="body-top-color"><!----></div>
            <div class="background-color"><!----></div> 
            <div class="container">
                <div class="row-fluid">
                    <div class="span12">
                        <?php get_template_part('content','page');?>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-container">	
            <?php get_template_part( 'body', 'bottom' ); // load body-bottom.php ?>
            <?php get_template_part( 'main', 'bottom' ); // load main-bottom.php ?>
        </div>
<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 */
global $font_awesome;
?>
		<footer>
            <div class="bg-container">
                <div id="copyright">
                    <div class="container">
						<div id="footlogo">
                        <?php if(ot_get_option('footerlogo_show') != 0){?>
                                <a class="logo" href="<?php echo get_home_url(); ?>" title="<?php wp_title( '|', true, 'right' ); ?>"><img src="<?php echo get_template_directory_uri()?>/images/gameplan-logo-dark-1x.png" alt="<?php wp_title( '|', true, 'right' ); ?>" /></a>
                        <?php }?>				
						</div>
                        <?php if(is_active_sidebar('copyright')) echo do_shortcode(get_dynamic_sidebar('copyright'));?>
                    </div>
                </div>
            </div>
        </footer>
    </div>        
</div>
<a href="#top" id="gototop" class="notshow" title="Go to top"><i class="icon-angle-up <?php echo $font_awesome==4?'fa fa-angle-up':''; ?>"></i></a>
<?php $gcode = ot_get_option( 'google_analytics_code', ''); if($gcode != ''){ echo $gcode;}?>
<?php wp_footer(); ?>
</body>
</html>