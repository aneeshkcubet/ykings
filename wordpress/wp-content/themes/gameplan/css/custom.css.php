<?php

/*header('Content-type: text/css');

require '../../../../wp-load.php';*/

/* Get Theme Options here and echo custom CSS */
// 
// for example: 
// $topmenu_visible = ot_get_option( 'topmenu_visible', 1);

$backgroundbody = ot_get_option('body_background');
if(@$backgroundbody['background-color']||@$backgroundbody['background-image']){
echo '
body.'.ot_get_option("theme_style",'').'{background:'.$backgroundbody['background-color'].' '.($backgroundbody['background-image']?'url('.$backgroundbody['background-image'].') ':'').$backgroundbody['background-position'].' '.$backgroundbody['background-repeat'].' '.$backgroundbody['background-attachment'].';}';
}
global $gp_main_color;
if(!isset($gp_main_color) || $gp_main_color==''){
	$gp_main_color = ot_get_option('main_color');
}

if(!$gp_main_color && ot_get_option('theme_style') == 'dark') $gp_main_color = '#ffd600';

if($gp_main_color){ //CSS main color 

$gp_main_color_rgb = cactus_hex2rgb($gp_main_color);

?>
/*custom color*/
a,a:hover,h1,.box-style-1.firstword .module-title h1 span,.box-style-1.firstword .module-title h2 span,.box-style-1.firstword .module-title h3 span, .box-style-1 .module-title h1 [class^="icon-"],.box-style-1 .module-title h2 [class^="icon-"],.box-style-1 .module-title h3 [class^="icon-"], .box-style-1 .module-title h1 [class*=" icon-"],.box-style-1 .module-title h2 [class*=" icon-"],.box-style-1 .module-title h3 [class*=" icon-"],.widget.firstword .firstword, .dotted-style.box-style-3.firstword .module-title h2 .firstword, .dotted-style.box-style-4.firstword .module-title h2 .firstword, .dotted-style.box-style-2.firstword .module-title h2 .firstword, .dotted-style.box-style-1.firstword .module-title h2 .firstword,#navigation ul.menu li.parent .sub-menu a:hover,#slider h1:before,.accordion .accordion-heading:before,.table-soid tr:first-child td,.boxed-icon.style-1 .heading .icon-caret-left,.promo-style-1:before,.promo-style-lay2:before,.portfolio-container ul li div a,.icon-checklist ul i,.ok-sign li:before,.alert-style-1:before,.alert-style-2:before,.timeline .row-fluid .col11 .dot,.timeline .row-fluid .col11:before,.timeline1 .row-fluid .span9 .dot,.timeline1 .row-fluid .span9:before,.timeline1 .row-fluid .span12 .dot,.timeline1 .row-fluid .span12:before,.event_listing .viewdetails,.meta-table .custom-pot-1 .meta-data span a,#mainsidebar .widget ul .cat-item a:hover,#mainsidebar .widget ul.menu li a:hover,.boxed-icon.style-3 .boxed-item:hover .contain-content,.boxed-icon.style-3 .boxed-item:hover .heading,.headline .htitle .hicon i,body.dark #navigation-menu-mobile .divselect i.icon-reorder,#navigation-menu-mobile .divselect i.icon-reorder,.color-def,#nav-top > .container > .container-pad:before, .event-listing-modern .rt-article-title a:hover, .ev_price,.tribe-price, .event_listing .custom-pot-1 span.tribe-price, .event-listing-modern .rt-article-title a:hover,#tribe-events h2.tribe-events-page-title,
.woocommerce #body ul.cart_list li a:hover, .woocommerce #body ul.product_list_widget li a:hover, .woocommerce-page #body ul.cart_list li a:hover, .woocommerce-page #body ul.product_list_widget li a:hover,.woocommerce #body .products .product h3.price, .woocommerce #body .products .product h3.price span, .woocommerce #body .products .product h3 a:hover,body.woocommerce .star-rating span, body.woocommerce-page .star-rating span,body .woocommerce .star-rating span, body .woocommerce-page .star-rating span, body.dark.woocommerce .star-rating span,body.dark .related.products h2,body.dark #body .woocommerce table.cart th,body #body .woocommerce .cart_totals h2,body #body .woocommerce .shipping_calculator h2 a,body.dark .woo-page .woocommerce h2,body.dark .editaddress .woocommerce h3,body.woocommerce #body .products .product .product_type_variable:hover,body.woocommerce #body .products .product .add_to_cart_button:hover,body.dark.woocommerce #body .products .product .product_type_variable:hover,body.dark.woocommerce #body .products .product .add_to_cart_button:hover,body.woocommerce .widget_shopping_cart_content .buttons a:hover,body.dark.woocommerce .widget_shopping_cart_content .buttons a:hover,body.dark.woocommerce .star-rating span,body.dark.woocommerce-page .star-rating span,#body .woocommerce-message .button:hover,#body #customer_details h3,.dark #body #customer_details h3{color:<?php echo $gp_main_color ?>;}
.wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header:before,
.wpb_toggle:before, #content h4.wpb_toggle:before{color:<?php echo $gp_main_color ?> !important;}

.bookmark, .light #nav-top, #slider h1,.box-style-2 .module-title,.events_plug .postleft .rt-image,.custom-pot-1 .date-counter,.boxed-icon.style-1 .heading,.boxed-icon.style-1 .boxed-item .boxed-item-bg,.boxed-icon.style-2 .boxed-item .boxed-item-s2,.portfolio-1 .project-tags li a.active,.portfolio-1 .project-tags li a:hover,.portfolio-3 li div,.boxed-icon-checklist ul i,#comment-submit:hover,  input[type="submit"]:hover, .btn-1a:hover,#comment-submit:active, .btn-1a:active,.timeline1 .row-fluid .span9 .postleft .rt-image,.timeline1 .row-fluid .span12 .postleft .rt-image,.paging li a.active,#main-body .wp-pagenavi .current,body #main-body .wp-pagenavi a:hover,#main-body .woocommerce-pagination a.page-numbers:hover,body.dark #main-body .woocommerce-pagination a.page-numbers:hover,#main-body .woocommerce-pagination span.current,.widget .tagcloud a:hover,.sml_submitbtn:hover, .sml_submitbtn:active,a#gototop,.btn-1b:after, .btn-3, .btn-3:hover,.tagcloud a:hover,.carouselfred .g-pagination a.selected,.wpb_gallery_slides .flex-control-paging li a.flex-active, .flexslider .flex-control-paging li > a:hover, .theme-default .nivo-controlNav a.active,.portfolio-modern .element:hover a.portfolio-title,.tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"], .tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"]>a, #tribe_events_filters_wrapper input[type=submit], .tribe-events-button, .tribe-events-button.tribe-inactive, .tribe-events-button:hover, .tribe-events-button.tribe-active:hover, .tribe-grid-allday .hentry.vevent > div, .tribe-grid-body div[id*="tribe-events-event-"] .hentry.vevent, .light .tribe-mini-calendar-event .list-date,.light .tribe-mini-calendar td.tribe-events-has-events.tribe-events-present, .tribe-mini-calendar td.tribe-events-has-events.tribe-mini-calendar-today,
.dark.woocommerce #body .single_add_to_cart_button,body.dark.woocommerce .quantity.buttons_added .minus:hover,body.dark.woocommerce .quantity.buttons_added .plus:hover,body.dark .woocommerce .quantity.buttons_added .minus:hover,body.dark .woocommerce .quantity.buttons_added .plus:hover,body.dark.woocommerce #body .single_add_to_cart_button,body.woocommerce a.button,body.woocommerce-page a.button,body.woocommerce #respond .form-submit  input#submit,body.woocommerce a.button,body.woocommerce-page a.button:hover,body.woocommerce #respond .form-submit input#submit:hover,body.woocommerce button.button,body.woocommerce button.button:hover,body .woocommerce input.button,body .woocommerce input.button:hover,body .woocommerce button.button,body .woocommerce button.button:hover,body.woocommerce input.button.alt,body .woocommerce input.button.alt,body.woocommerce input.button.alt:hover,body .woocommerce input.button.alt:hover,body.dark.woocommerce a.button,body.dark.woocommerce-page a.button,body.dark.woocommerce-page a.button:hover,body.woocommerce #respond input#submit:hover,body.dark.woocommerce button.button,body.dark.woocommerce button.button:hover,body #body .woocommerce input.button,body #body .woocommerce input.button:hover,body #body .woocommerce button.button,body #body .woocommerce button.button:hover,body.woocommerce input.button.alt,body #body .woocommerce input.button.alt,body.woocommerce input.button.alt:hover,body #body .woocommerce input.button.alt:hover,body.woocommerce #body .widget_price_filter .ui-slider .ui-slider-handle,body.woocommerce-page #body .widget_price_filter .ui-slider .ui-slider-handle,body #main-body .woocommerce-pagination span.current,body #main-body .woocommerce-pagination a.page-numbers:hover,.woocommerce #body .single_add_to_cart_button{background-color:<?php echo $gp_main_color ?>;}

body.woocommerce #body .single_add_to_cart_button:hover,body.dark.woocommerce #body .single_add_to_cart_button:hover{background:rgba(<?php echo $gp_main_color_rgb[0]?>,<?php echo $gp_main_color_rgb[1]?>,<?php echo $gp_main_color_rgb[2]?>,.85)}
body .woocommerce .quantity.buttons_added .minus:hover,body .woocommerce .quantity.buttons_added .plus:hover,body.woocommerce  .quantity.buttons_added .minus:hover,body.woocommerce .quantity.buttons_added .plus:hover{background-color:<?php echo $gp_main_color ?>;border-color:<?php echo $gp_main_color ?>}

a.icon-social:hover{background-color:#fff; color:<?php echo $gp_main_color ?>}

.hi-icon-3{box-shadow: 0 0 0 3px <?php echo $gp_main_color ?>;}
.hi-icon-3:after{background-color:rgba(<?php echo $gp_main_color_rgb[0]?>, <?php echo $gp_main_color_rgb[1]?>, <?php echo $gp_main_color_rgb[2]?>, 1); color:#fff}

.hi-icon-5{box-shadow: 0 0 0 4px <?php echo $gp_main_color ?>;}
.hi-icon-5:hover{background-color:rgba(<?php echo $gp_main_color_rgb[0]?>, <?php echo $gp_main_color_rgb[1]?>, <?php echo $gp_main_color_rgb[2]?>, 1); color:#fff; box-shadow:0 0 0 8px rgba(<?php echo $gp_main_color_rgb[0]?>, <?php echo $gp_main_color_rgb[1]?>, <?php echo $gp_main_color_rgb[2]?>, 0.3)}
.hi-icon-5{color:<?php echo $gp_main_color ?>;}

.boxed-icon.style-2 .heading,.boxed-icon.style-3 .heading i{color:<?php echo $gp_main_color ?>;}

.portfolio-1 .element div, .portfolio-3 li div{background-color: rgba(<?php echo $gp_main_color_rgb[0]?>, <?php echo $gp_main_color_rgb[1]?>, <?php echo $gp_main_color_rgb[2]?>, 0.8)}
.wpb_tabs .ui-tabs-nav li.ui-tabs-active a{border-color:<?php echo $gp_main_color ?>;}
.wpb_content_element .wpb_tabs_nav li.ui-tabs-active a,.dark.woocommerce #body .single_add_to_cart_button,body.dark.woocommerce .quantity.buttons_added .minus:hover,body.dark.woocommerce .quantity.buttons_added .plus:hover,body.dark .woocommerce .quantity.buttons_added .minus:hover,body.dark .woocommerce .quantity.buttons_added .plus:hover{border-color:<?php echo $gp_main_color ?> !important;}
.promo-style-1{border-top:3px solid <?php echo $gp_main_color ?>;}
.promo-style-lay2{border:3px solid <?php echo $gp_main_color ?>;}
#comment-submit,.btn-1, input[type="submit"]{border: 3px solid <?php echo $gp_main_color ?>;color: <?php echo $gp_main_color ?>;}
.alert-style-1{border-top:<?php echo $gp_main_color ?> 3px solid;}
.alert-style-2{border:3px solid <?php echo $gp_main_color ?>;}
.headline{border:0px solid <?php echo $gp_main_color ?>;}
.timeline .row-fluid .col11 .dot span{border:1px <?php echo $gp_main_color ?> solid; background-color:<?php echo $gp_main_color ?>;}
.timeline .row-fluid .col11{ border-left:3px <?php echo $gp_main_color ?> solid;}
.timeline1 .row-fluid{border-left:3px <?php echo $gp_main_color ?> solid;}
.timeline1 .row-fluid .span9 .dot span{border:1px <?php echo $gp_main_color ?> solid;background-color:<?php echo $gp_main_color ?>;}
.timeline1 .row-fluid .span12 .dot span{border:1px <?php echo $gp_main_color ?> solid; background-color:<?php echo $gp_main_color ?>;}
.sml_submitbtn{border: 4px solid <?php echo $gp_main_color ?>;color: <?php echo $gp_main_color ?>;}
textarea:focus,input[type='text']:focus,input[type='email']:focus,input[type='number']:focus{border: solid 1px <?php echo $gp_main_color ?>;}

.member .member-info .member-social a.icon-social:hover{background: <?php echo $gp_main_color ?>;}
body.dark .member .member-info .member-social a.icon-social:hover{background: <?php echo $gp_main_color ?>;}
.dotted2{border-bottom:3px solid <?php echo $gp_main_color ?>;}
/*dark custom color*/
body.dark .firstword h1 span,body.dark .firstword h2 span,body.dark .firstword h3 span,body.dark .firstword h4 span,
body.dark h1,
body.dark .box-style-1.firstword .module-title h1 span,body.dark .dotted-style.box-style-1.firstword .module-title h2 .firstword,body.dark .box-style-1.firstword .module-title h3 span,
body.dark .box-style-1 .module-title h1 [class^="icon-"],body.dark .box-style-1 .module-title h2 [class^="icon-"],body.dark .box-style-1 .module-title h3 [class^="icon-"],body.dark .box-style-1 .module-title h1 [class*=" icon-"],body.dark .box-style-1 .module-title h2 [class*=" icon-"],body.dark .box-style-1 .module-title h3 [class*=" icon-"],
body.dark #navigation ul.menu li.parent .sub-menu a:hover,
body.dark #slider h1:before,
body.dark .accordion .accordion-heading:before,
body.dark .table-soid tr:first-child td,
body.dark .table-transparent tr:first-child td,
body.dark .boxed-icon.style-1 .heading .icon-caret-left,
body.dark .promo-style-1:before,
body.dark .portfolio-3 .hi-icon,
body.dark .portfolio-3 .hi-icon-2.hi-icon:hover,
body.dark .icon-checklist ul i,
body.dark .ok-sign li:before,
body.dark .btn-1,
body.dark .alert-style-1:before,
body.dark .alert-style-2:before,
body.dark .timeline .row-fluid .col11 .dot,
body.dark .timeline .row-fluid .col11:before,
body.dark .timeline1 .row-fluid .span9 .dot,
body.dark .timeline1 .row-fluid .span9:before,
body.dark .timeline1 .row-fluid .span12 .dot,
body.dark .timeline1 .row-fluid .span12:before,
body.dark .event_listing .viewdetails,
body.dark .meta-table .custom-pot-1 span a,
body.dark #mainsidebar .widget ul .cat-item a:hover,
body.dark #mainsidebar .widget h4,
body.dark #mainsidebar .widget h4,
body.dark .sml_submitbtn,
body.dark .portfolio-container ul li div a,
body.dark .event-listing-modern .rt-article-title a:hover,
body.dark .event_listing .custom-pot-1 span.tribe-price,
.dark.woocommerce #body ul.cart_list li a:hover, .dark.woocommerce #body ul.product_list_widget li a:hover, .dark.woocommerce-page #body ul.cart_list li a:hover, .dark.woocommerce-page #body ul.product_list_widget li a:hover,
body.dark.woocommerce #body .products .product h3.price, body.dark.woocommerce #body .products .product h3.price span, body.dark.woocommerce #body .products .product h3 a:hover,
.woocommerce #body .products .span4.product-category.product .cat-name:hover h3,
.woocommerce #body .products .span4.product-category.product .cat-name:hover,
body.dark.woocommerce #body .products .span4.product-category.product .cat-name:hover h3,
body.dark.woocommerce #body .products .span4.product-category.product .cat-name:hover,
body.dark.single-product.woocommerce #body h3.price,body.dark.single-product.woocommerce #body h3.price span
{color:<?php echo $gp_main_color ?>;}

body.dark #nav-top{background-color:<?php echo $gp_main_color ?>;color:#000}
.woocommerce span.onsale, .woocommerce-page span.onsale{ background:<?php echo $gp_main_color ?>}
body.dark .bookmark,
body.dark #slider h1,
body.dark .box-style-2 .module-title,
body.dark .boxed-icon.style-1 .heading,
body.dark .boxed-icon.style-1 .boxed-item .boxed-item-bg,
body.dark .boxed-icon.style-2 .boxed-item .boxed-item-s2,
body.dark .portfolio-1 .project-tags li a.active,body.dark .portfolio-1 .project-tags li a:hover,
body.dark .portfolio-3 li div,
body.dark .boxed-icon-checklist ul i,
body.dark .btn-1a:hover,body.dark  .btn-1a:active,
body.dark .timeline .row-fluid .col11 .dot span,
body.dark .timeline1 .row-fluid .span9 .postleft .rt-image,
body.dark .timeline1 .row-fluid .span9 .dot span,
body.dark .timeline1 .row-fluid .span12 .postleft .rt-image,
body.dark .timeline1 .row-fluid .span12 .dot span,
body.dark .paging li a.active,
body.dark #main-body .wp-pagenavi .current,
body.dark #main-body .woocommerce-pagination span.current,
body.dark .sml_submitbtn:hover,body.dark .sml_submitbtn:active,
body.dark .hi-icon-3:after{background-color:<?php echo $gp_main_color ?>;color:#000}
<?php if($gp_main_color){?>
body.dark .tp-bullets .tp-bullet:hover,
body.dark .tp-bullets .tp-bullet.selected,
body.dark .tp-bullets .tp-bullet:hover,
body.dark .tp-bullets .tp-bullet.selected,
body.light .tp-bullets .tp-bullet:hover,
body.light .tp-bullets .tp-bullet.selected,
body.light .tp-bullets .tp-bullet:hover,
body.light .tp-bullets .tp-bullet.selected{background-color:<?php echo $gp_main_color ?>!important; opacity:1}
<?php } else{?>
body.dark .tp-bullets .tp-bullet:hover,
body.dark .tp-bullets .tp-bullet.selected,
body.dark .tp-bullets .tp-bullet:hover,
body.dark .tp-bullets .tp-bullet.selected,
body.light .tp-bullets .tp-bullet:hover,
body.light .tp-bullets .tp-bullet.selected,
body.light .tp-bullets .tp-bullet:hover,
body.light .tp-bullets .tp-bullet.selected{background-color:#000000!important; opacity:1}
<?php }?>

body.dark .tp-bullets .tp-bullet, body.light .tp-bullets .tp-bullet{background-image:none !important; background-color:#fff !important; opacity:0.5; width:10px; height:10px; border-radius:20px; -webkit-border-radius:20px; -moz-border-radius:20px; margin-top:0}

body.dark .boxed-icon.style-2 .heading,body.dark .boxed-icon.style-3 .heading i{color:<?php echo $gp_main_color ?>;}

body.dark .portfolio-1 .element div,body.dark .portfolio-3 li div{background-color: rgba(<?php echo $gp_main_color_rgb[0]?>,<?php echo $gp_main_color_rgb[1]?>,<?php echo $gp_main_color_rgb[2]?>, 0.8)}
body.dark .wpb_tabs .ui-tabs-nav li.ui-tabs-active a{border-color:<?php echo $gp_main_color ?>;}
body.dark .promo-style-1{border-top:3px solid <?php echo $gp_main_color ?>;}
body.dark .promo-style-lay2{border:3px solid <?php echo $gp_main_color ?>;}
body.dark #copyright, #copyright{border-bottom:5px solid <?php echo $gp_main_color ?>;}
body.dark #comment-submit,body.dark .btn-1 {border: 3px solid <?php echo $gp_main_color ?>;color: <?php echo $gp_main_color ?>;}
body.dark .alert-style-1{border-top:<?php echo $gp_main_color ?> 3px solid;}
body.dark .alert-style-2{border:3px solid <?php echo $gp_main_color ?>;}
body.dark .headline{border:0px solid <?php echo $gp_main_color ?>;}
body.dark .timeline .row-fluid .col11 .dot span{border:1px <?php echo $gp_main_color ?> solid; background-color:<?php echo $gp_main_color ?>;}
body.dark .timeline .row-fluid .col11{ border-left:3px <?php echo $gp_main_color ?> solid;}
body.dark .timeline1 .row-fluid{border-left:3px <?php echo $gp_main_color ?> solid;}
body.dark .timeline1 .row-fluid .span9 .dot span{border:1px <?php echo $gp_main_color ?> solid;background-color:<?php echo $gp_main_color ?>;}
body.dark .timeline1 .row-fluid .span12 .dot span{border:1px <?php echo $gp_main_color ?> solid; background-color:<?php echo $gp_main_color ?>;}
body.dark .sml_submitbtn{border: 4px solid <?php echo $gp_main_color ?>;color: <?php echo $gp_main_color ?>;}
body.dark .hi-icon-5{box-shadow: 0 0 0 4px rgba(<?php echo $gp_main_color_rgb[0]?>,<?php echo $gp_main_color_rgb[1]?>,<?php echo $gp_main_color_rgb[2]?>,1);}
body.dark .hi-icon-5:hover{background: rgba(<?php echo $gp_main_color_rgb[0]?>,<?php echo $gp_main_color_rgb[1]?>,<?php echo $gp_main_color_rgb[2]?>,1); box-shadow: 0 0 0 8px rgba(<?php echo $gp_main_color_rgb[0]?>,<?php echo $gp_main_color_rgb[1]?>,<?php echo $gp_main_color_rgb[2]?>,0.3);}
body.dark .hi-icon-3 {box-shadow: 0 0 0 3px <?php echo $gp_main_color ?>;}
/*end custom color*/

<?php }

if($gp_ic_color = ot_get_option('topmenu_socialicon_color')){
?>
#nav-top .text-right .icon-social{color:<?php echo $gp_ic_color?> !important; }
<?php }
if($gp_ic_bgcolor = ot_get_option('topmenu_socialicon_bg')){
?>
#nav-top .text-right .icon-social{background:<?php echo $gp_ic_bgcolor?> !important;}
<?php }
if($gp_ic_colorhover = ot_get_option('topmenu_socialicon_hovercolor')){
?>
#nav-top .text-right .icon-social:hover{ color:<?php echo $gp_ic_colorhover?> !important;transition: color 0.3s; -webkit-transition: color 0.3s;-moz-transition: color 0.3s;}
<?php }
if($gp_ic_bgcolorhover = ot_get_option('topmenu_socialicon_hoverbg')){
?>
#nav-top .text-right .icon-social:hover{ background:<?php echo $gp_ic_bgcolorhover?> !important;transition: background 0.3s; -webkit-transition: background 0.3s;-moz-transition: background 0.3s;}
<?php
}
if($gp_ct_textcolor = ot_get_option('content_textcolor')){
?>
body.dark,
body{color:<?php echo $gp_ct_textcolor?>}
<?php }
if($gp_ct_headingcolor = ot_get_option('content_headingcolor')){
?>




h1,h2,h3,h4,.heading,h1 span,h2 span, h3 span,h1 a,h2 a, h3 a,h1 a,h2 a, h3 a,h4 a, h4 a{color:<?php echo $gp_ct_headingcolor?> !important;}
h1 span,h2 span, h3 span, h4 span{color:<?php echo $gp_ct_headingcolor?>;}
<?php }
if($gp_ct_linkcolor = ot_get_option('content_linkcolor')){
?>
a{color:<?php echo $content_linkcolor?> !important;}
<?php }
if($gp_ct_hoverlinkcolor = ot_get_option('content_hoverlinkcolor')){
?>
a:hover{color:<?php echo $gp_ct_hoverlinkcolor?> !important;}
<?php }
if($gp_ct_metacolor = ot_get_option('content_metacolor')){
?>
.rt-articleinfo .rt-date-posted span{color:<?php echo $gp_ct_metacolor?>;}
.rt-articleinfo .rt-comment-block span{color:<?php echo $gp_ct_metacolor?>;}
.post-tags,.rt-comment-block,.rt-comment-block a span, .author span, .author span a, .inner, .rt-date-posted span,
.post-tags a{color:<?php echo $gp_ct_metacolor?> !important;}
<?php
}
if($custom_font_1 = ot_get_option( 'custom_font_1')){ ?>
	@font-face
    {
    font-family: 'Custom Font 1';
    src: url('<?php echo $custom_font_1 ?>');
    }
<?php }
if($custom_font_2 = ot_get_option( 'custom_font_2')){ ?>
	@font-face
    {
    font-family: 'Custom Font 2';
    src: url('<?php echo $custom_font_2 ?>');
    }
<?php }
$gp_text_font = ot_get_option( 'text_font', 'Open Sans');
$gp_text_font_family = explode(":", $gp_text_font);
$gp_text_font_family = $gp_text_font_family[0];
$gp_text_size = ot_get_option( 'text_size', '14px');
$gp_text_weight = ot_get_option( 'text_weight', '');
$gp_h1_font = ot_get_option( 'h1_font', 'Open Sans');
$gp_h1_font_family = explode(":", $gp_h1_font);
$gp_h1_font_family = $gp_h1_font_family[0];
$gp_h1_size = ot_get_option( 'h1_size', '35px');
$gp_h1_weight = ot_get_option( 'h1_weight', '');
$gp_h2_size = ot_get_option( 'h2_size', '31.5px');
$gp_h2_weight = ot_get_option( 'h2_weight', '');
$gp_h3_size = ot_get_option( 'h3_size', '24.5px');
$gp_h3_weight = ot_get_option( 'h3_weight', '');
$gp_nav_font = ot_get_option( 'nav_font', 'Open Sans');
$gp_nav_font_family = explode(":", $gp_nav_font);
$gp_nav_font_family = $gp_nav_font_family[0];
$gp_nav_size = ot_get_option( 'nav_size', '18px');
$gp_nav_weight = ot_get_option( 'nav_weight', '700');
$gp_nav_style = ot_get_option( 'nav_font_style', 'italic');
?>
html, body, div, applet, object, iframe, p, blockquote, pre, a, abbr, acronym, address, big, cite, del, dfn, em, font, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, caption, input, textarea, blockquote p, select, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input,#navigation ul.sub-menu li a,.single-post h4 .bookmark{
	font-size: <?php echo $gp_text_size ?>;
    font-family: '<?php echo $gp_text_font_family ?>', sans-serif;
}
html, body, div, applet, object, iframe, p, blockquote, pre, a, abbr, acronym, address, big, cite, del, dfn, em, font, img, ins, kbd, q, s, samp, small, strike, sub, sup, tt, var, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, caption, input, textarea, blockquote p, select, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input,#navigation ul.sub-menu li a,.single-post h4 .bookmark{
    font-weight: <?php echo $gp_text_weight ?>;
}
html, body, div, span, applet, object, iframe, .bttn, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, font, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, caption, input, textarea, blockquote p{font-family: '<?php echo $gp_text_font_family ?>', sans-serif; !important;}
span{font-size:inherit}

.tp-caption.big_heading,.rev-button{font-family: '<?php echo $gp_h1_font_family ?>', sans-serif !important;}
<?php if($gp_main_color != ''){?>
.tp-caption a.rev-button{background:<?php echo $gp_main_color;?> !important}
<?php }?>

h1, h1 span, h1 a, h1 a:hover{
	font-size: <?php echo $gp_h1_size ?>;
	font-family: '<?php echo $gp_h1_font_family ?>', sans-serif !important;
    font-weight: <?php echo $gp_h1_weight ?>;
    font-style: <?php echo $gp_nav_style ?>;
}
h2, h2 span, h2 a, h2 a:hover{
	font-size: <?php echo $gp_h2_size ?>;
	font-family: '<?php echo $gp_h1_font_family ?>', sans-serif !important;
    font-weight: <?php echo $gp_h2_weight ?>;
    font-style: <?php echo $gp_nav_style ?>;
}
.woocommerce div.product .single_variation span.price,.woocommerce div.product .single_variation span.price ins,.product_list_widget li ins,.woocommerce #body span.onsale, .woocommerce-page #body span.onsale, h3,.portfolio-modern .element a.portfolio-title{
	font-size: <?php echo $gp_h3_size ?>;
	font-family: '<?php echo $gp_h1_font_family ?>', sans-serif !important;
    font-weight: <?php echo $gp_h3_weight ?>;
    font-style: <?php echo $gp_nav_style ?>;
}
h3 span, h3 a, h3 a:hover{
	font-family: '<?php echo $gp_h1_font_family ?>', sans-serif !important;
    font-size: <?php echo $gp_h3_size ?>;
    font-weight: <?php echo $gp_h3_weight ?>;
    font-style: <?php echo $gp_nav_style ?>;
}
.timeline .row-fluid .col11 .title{font-family: '<?php echo $gp_h1_font_family ?>', sans-serif !important; font-weight: <?php echo $gp_h2_weight ?>;}
.table-transparent tr:first-child td{font-family: '<?php echo $gp_text_font_family ?>', sans-serif; font-weight: <?php echo $gp_text_weight ?>;}
.post-title .link_title{ font-size: <?php echo $gp_h3_size ?>; font-weight: <?php echo $gp_h3_weight ?>;}
.boxed-item .boxed_title{font-family: '<?php echo $gp_h1_font_family ?>', sans-serif !important; font-weight: <?php echo $gp_h3_weight ?>;}
.timeline .row-fluid .col11 .content{
	font-size: <?php echo $gp_text_size ?>;
    font-family: '<?php echo $gp_text_font_family ?>', sans-serif;
    font-weight: <?php echo $gp_text_weight ?>;
}
.custom-pot-1 .date-counter{
	font-style: <?php echo $gp_nav_style ?>;
    <?php if($gp_nav_style=='italic'){ ?>
    margin-right: 18px;
	padding-right: 2px;
    <?php }?>
}
#tribe-events-content .event_listing .rt-article-title a, .event_widget_fix .accordion .accordion-heading h4, .event_widget_fix .accordion .accordion-inner .ev_button .btn-1{ font-style:<?php echo $gp_nav_style ?>;}
.wpb_call_to_action .wpb_call_text{font-size: <?php echo $gp_text_size ?> !important; font-weight: <?php echo $gp_text_weight ?>;}
.inner .author .icon-user{font-family: '<?php echo $gp_text_font_family ?>', sans-serif !important; font-size: <?php echo $gp_text_size ?>; font-weight: <?php echo $gp_text_weight ?>; }
.posts-carousel .postright h3 a{font-size:14px}
.timeline1 .row-fluid .span9 .title .cte, .timeline1 .row-fluid .span12 .title .cte{
	font-family: '<?php echo $gp_text_font_family ?>', sans-serif !important; 
	font-size: <?php echo $gp_text_size ?>;
    font-weight: <?php echo $gp_text_weight ?>;
}
.timeline-event .timeline1 .row-fluid .span9 .title a,.timeline-event .timeline1 .row-fluid .span12 .title a{font-family: '<?php echo $gp_h1_font_family ?>', sans-serif !important; font-weight: <?php echo $gp_h3_weight ?>;}
#mainsidebar .widget ul .recentcomments .recentcommentsauthor,
#comment-submit, .btn-1, input[type="submit"]{
	font-family: '<?php echo $gp_text_font_family ?>', sans-serif;
}
.timeline-event .two-block .timeline1 .title .rt-date-posted .icon-time,.timeline-event .two-block .timeline1 .title .rt-date-posted .icon-map-marker{font-family: '<?php echo $gp_text_font_family ?>', sans-serif !important; font-size: <?php echo $gp_text_size ?>;}
.blog-listing .rt-articleinfo *{font-family: '<?php echo $gp_text_font_family ?>', sans-serif !important; font-size: <?php echo $gp_text_size ?>; font-weight: <?php echo $gp_text_weight ?>;}
.timeline1 .row-fluid .span9 .postleft .rt-image span{font-family: '<?php echo $gp_text_font_family ?>', sans-serif !important;}

.rt-articleinfo .author .icon-user,.rt-comment-block .rt-comment-text .icon-comments,.rt-date-posted .icon-calendar{font-family: '<?php echo $gp_text_font_family ?>', sans-serif !important; font-size: <?php echo $gp_text_size ?>; font-weight: <?php echo $gp_text_weight ?>;}

.blog-listing-modern .rt-article-title a, .blog-listing .rt-article-title a{ font-size: <?php echo $gp_h3_size ?> !important; font-weight: <?php echo $gp_h3_weight ?>;}

h4,h5,h6,
.portfolio-1 .element h3, .portfolio-3 li h3,
.rt-articleinfo,
.custom-pot-1,
.custom-pot-1 .date-counter,
.custom-pot-1 .date-counter span,
.events_plug .postleft .rt-image,
.tt-content.icon-quote-right,
.accordion .accordion-heading a,
.content-box-percentage span,
.blog-listing-modern .rt-article-title a, .blog-listing .rt-article-title a, .recent-post .rt-articleinfo *
{font-family: '<?php echo $gp_text_font_family ?>', sans-serif !important;}
.recent-post .rt-articleinfo *{font-size: <?php echo $gp_text_size ?>; font-weight: <?php echo $gp_text_weight ?>;}
#navigation .menu > li > a {
    font-family: '<?php echo $gp_nav_font_family ?>', sans-serif !important;
    font-size: <?php echo $gp_nav_size ?> !important;
    font-weight: <?php echo $gp_nav_weight ?> !important;
    font-style: <?php echo $gp_nav_style ?> !important;
}
h3.promoboxnew-item-heading{
	background:<?php echo $gp_main_color ?>;
}
.promoboxnew-item-heading .icon-caret-left{
	color:<?php echo $gp_main_color ?>;
}
.promoboxnew-item:hover .promoboxnew-item-inner{
	background: rgba(<?php echo $gp_main_color_rgb[0]?>,<?php echo $gp_main_color_rgb[1]?>,<?php echo $gp_main_color_rgb[2]?>,.8);
}
#navigation .menu > li > a > [class^="icon-"],#navigation .menu > li > a > [class*=" icon-"] {
	line-height:<?php echo $gp_nav_size ?>;
    vertical-align: inherit;
}
<?php if($gp_topmenu_bg = ot_get_option( 'topmenu_bg', false)){ ?>
/*Navigation*/
#nav-top.bg-container {
	background-color: <?php echo $gp_topmenu_bg ?>;
}
body.dark #nav-top.bg-container {
	background-color: <?php echo $gp_topmenu_bg ?>;
}
<?php }
if($gp_navigation_transparent = ot_get_option( 'navigation_transparent', false)){
	$gp_theme_style = ot_get_option( 'theme_style', 'light');
	$gp_navigation_bg = $gp_theme_style=='light'?'FFFFFF':'000000';
?>
#navigation #nav-bottom.bg-container .nav-bottom {
	background:rgba(<?php echo cactus_hex2rgba($gp_navigation_bg,$gp_navigation_transparent) ?>);
}
<?php }?>
<?php if($footerlogo_size = ot_get_option( 'footerlogo_size', false)){ ?>
#footlogo a.logo img{width:<?php echo $footerlogo_size?>}
<?php }?>
.tp-bullets{opacity:1; z-index:800; position:absolute}
.tp-bullets.hidebullets{opacity:1;}
.tp-leftarrow.default{background-color:rgba(0,0,0,0.25) !important; background-image:none !important; left:0 !important;}
.tp-leftarrow{background-image:none !important; background-color:rgba(0,0,0,0.25) !important; }
.tp-leftarrow:hover{background-color:rgba(0,0,0,0.5)!important;transition: background-color 0.35s ease 0.15s;
 -moz-transition:background-color 0.35s ease 0.15s;
 -o-transition:background-color 0.35s ease 0.15s;
 -webkit-transition:background-color 0.35s ease 0.15s;}
.tparrows.tp-leftarrow:before{content: "\F104";font-family:FontAwesome;position:absolute;font-size:18px; line-height:20px; top:10px;  z-index:200; left:15px; color:rgba(255,255,255,1); }
.tp-rightarrow.default{ background-color:rgba(0,0,0,0.25) !important;background-image:none !important; right:0 !important; }
.tp-rightarrow{background-color:rgba(0,0,0,0.25) !important; background:url(); }
.tp-rightarrow:hover{background-color:rgba(0,0,0,0.5)!important;transition: background-color 0.35s ease 0.15s;
 -moz-transition:background-color 0.35s ease 0.15s;
 -o-transition:background-color 0.35s ease 0.15s;
 -webkit-transition:background-color 0.35s ease 0.15s;}
.tparrows.tp-rightarrow:before{content: "\F105"; font-family:FontAwesome;position:absolute;font-size:18px; line-height: 20px; top:10px;  z-index:200; right:18px; color:rgba(255,255,255,1);}
.tp-bullets.simplebullets.round .bullet{background-image:none !important; background-color:#fff !important; opacity:0.5; width:10px; height:10px; border-radius:20px; -webkit-border-radius:20px; -moz-border-radius:20px; margin-top:0; margin-left:9px}
<?php if($gp_main_color!=''){?>
.tp-bullets.simplebullets.round .bullet:hover, .tp-bullets.simplebullets.round .bullet.selected, .tp-bullets.simplebullets.navbar .bullet:hover, .tp-bullets.simplebullets.navbar .bullet.selected{background-color:<?php echo $gp_main_color ?>!important;background-position:center!important;  opacity:1}

/* start CSS Tribe Events Calendar */
#tribe-bar-form input[type="text"]:focus{border-color: <?php echo $gp_main_color ?>;}
#tribe-bar-form .tribe-bar-submit input[type="submit"],.tribe-mini-calendar td.tribe-events-has-events.tribe-mini-calendar-today{background:<?php echo $gp_main_color ?>}
#tribe-bar-form .tribe-bar-submit input[type="submit"]:hover,#tribe-events-footer .tribe-events-sub-nav li a:hover{background:rgba(<?php echo $gp_main_color_rgb[0]?>,<?php echo $gp_main_color_rgb[1]?>,<?php echo $gp_main_color_rgb[2]?>,.85)}
#tribe-bar-form input[type="text"]:focus{color:<?php echo $gp_main_color ?>}
body.dark .tribe-events-grid .tribe-grid-header .tribe-grid-content-wrap .column{background-color:<?php echo $gp_main_color ?>}
body.dark .tribe-grid-allday .hentry.vevent > div,body.dark .tribe-grid-body div[id*="tribe-events-event-"] .hentry.vevent,body.dark .tribe-grid-allday .hentry.vevent > div:hover{background-color:<?php echo $gp_main_color ?>}
.events-archive.events-gridview #tribe-events-content table .vevent{background:<?php echo $gp_main_color ?>}
.tribe-grid-header,.tribe-events-calendar thead th{background-color:<?php echo $gp_main_color ?>}
.tribe-events-tooltip .tribe-events-event-body .date-start,.tribe-events-tooltip .tribe-events-event-body .date-end,#tribe_events_filters_wrapper .tribe_events_slider_val, .single-tribe_events a.tribe-events-ical, .single-tribe_events a.tribe-events-gcal{color:<?php echo $gp_main_color ?>}
body.dark .tribe-venue-widget-list h4 a:hover,body.dark .vcalendar h4 a:hover,.tribe-events-widget-link a,body.dark .tribe-mini-calendar-wrapper .list-info h2 a:hover{color:<?php echo $gp_main_color ?>}
body.dark ol.vcalendar > li:before,body.dark .tribe-venue-widget-list li:before,body.dark .tribe-mini-calendar-event .list-date,body.dark .tribe-mini-calendar .tribe-events-has-events:hover a:hover,#tribe-events-footer .tribe-events-sub-nav li a,.tribe-venue-widget-list li:before,ol.vcalendar > li:before{background:<?php echo $gp_main_color ?>}
/* end setting Tribe Events Calendar */

<?php } else{?>
.tp-bullets.simplebullets.round .bullet:hover, .tp-bullets.simplebullets.round .bullet.selected, .tp-bullets.simplebullets.navbar .bullet:hover, .tp-bullets.simplebullets.navbar .bullet.selected{background-color: #ee4422 !important;background-position:center!important; opacity:1}
<?php }?>

<?php
$subpage_heading_color = ot_get_option( 'subpage_heading_color');
$subpage_subheading_color = ot_get_option( 'subpage_subheading_color');
$subpage_subheading_size = ot_get_option( 'subpage_subheading_size');


?>
#page-header .bg-container .container-pad h1{ color:<?php echo $subpage_heading_color ?> !important}
#page-header .bg-container .container-pad p{ color:<?php echo $subpage_subheading_color; echo $subpage_subheading_size?';font-size:'.$subpage_subheading_size:'' ?>}
<?php
$responsive_navigation_mobile = ot_get_option( 'responsive_navigation_mobile');
if($responsive_navigation_mobile!='')
{
?>
@media(max-width:<?php echo  $responsive_navigation_mobile ?>px) and (min-width:<?php echo  $responsive_navigation_mobile ?>px){
	#navigation-menu-mobile {margin-top: 20px;}
}
@media(max-width:<?php echo  $responsive_navigation_mobile ?>px){
	body{padding:0;}
	.container{padding:0 20px;}
	body.boxed #body .container{padding:0}
	body.boxed #body .container>.container-pad{padding:0 20px}	
	body.boxed #body #body-bottom .container{padding:0 20px}
	body.boxed #body .vc_row-fluid{padding-left:20px;padding-right:20px}
    body.boxed #body .vc_row-fluid .vc_row-fluid{padding-left:0;padding-right:0} 
	body.wide .container-pad{padding-left:20px; padding-right:20px;}
	body.wide .container-pad .container-pad{padding-left:0; padding-right:0;}
	body.home #wrapper{top:-5px}
	
	/* Rev Slider */
	.home #slider{min-height:initial}
	.home #slider .tp-bullets{bottom: 30px !important}
	
	#navigation{position:static;}	
	#navigation .nav-contact{margin-top:10px; margin-bottom:2px;}
	#navigation .nav-contact *{font-size:13px; border:0;}
	#navigation .nav-contact .textwidget i{float:none;line-height:6px; top:3px}
	#navigation-menu{display:none;}
	#navigation .nav-bottom .span3{line-height:0; margin:20px 0 11px; padding:0;text-align:center; width:100%}
    #navigation .nav-bottom .span9{line-height:0; margin:20px 0 11px; padding:0; width:100%}
	#navigation-menu-mobile{display:block !important;}
	#nav-top > .container > .container-pad:before{display:none}/* hide the triagle */
	.light #navigation .nav-bottom{height:auto; border:0;}
	#navigation.pos_fixed_nav{position: relative !important; margin-top:0; width:100%; max-width:100%; z-index:1000 }
	#navigation.pos_fixed_nav #nav-bottom .nav-bottom{height:auto !important; transiton:none;}
	#navigation.pos_fixed_nav #nav-bottom .nav-bottom ul li a{line-height:100px}
	#navigation.pos_fixed_nav #nav-bottom .nav-bottom .span3{line-height: 0 !important}
	#navigation .pos_fixed_nav #nav-bottom .nav-bottom{ width:100%}
	body.boxed #navigation.pos_fixed_nav  #nav-bottom .nav-bottom{ width:100%; max-width:1240px; margin: inherit}
	#navigation.pos_fixed_nav #nav-bottom .nav-bottom .logo img{ max-height: none}
	#navigation.pos_fixed_nav #nav-top {display: block;}
	body.admin-bar #navigation.pos_fixed_nav {top: inherit;}
	#page-header .bg-container{padding-top:30px; padding-bottom:30px;}
}
<?php }?>
<?php if($gp_main_color!='') {?>
.widget_flickr .title,
.title.def_style{
    background-color:<?php echo $gp_main_color ?> !important;
}
.widget_flickr .title:after,
.title.def_style:after {
    border-top: 43px solid <?php echo $gp_main_color ?> !important;
}
.title.def_style .first-word{ color:#ffffff} 
.blog-listing .rt-article-title a:hover{ color:<?php echo $gp_main_color ?>;}
body.dark .blog-listing .rt-article-title a:hover{ color:<?php echo $gp_main_color ?>;}
.posts-carousel .postright h3 a:hover{color:<?php echo $gp_main_color ?>;}
body.dark .posts-carousel .postright h3 a:hover{color:<?php echo $gp_main_color ?>;}
.post-title a.link_title:hover{ color:<?php echo $gp_main_color ?>}
body.dark .post-title a.link_title:hover{ color:<?php echo $gp_main_color ?>}

<?php }?>
.tribe-related-events li .tribe-related-event-info .tribe-related-events-title a:hover{ color:<?php echo $gp_main_color ?>  !important;}
.event_single_fix .meta-table .ev_price{color:<?php echo $gp_main_color ?> !important;}
<?php 
$content_linkcolor = ot_get_option('content_linkcolor');
if($content_linkcolor!=''){
?>
h1 a, h2 a, h3 a,a
body.dark h1 a,body.dark h2 a,body.dark h3 a,body.dark a
{ color:<?php echo $content_linkcolor ?>}
<?php }?>

<?php 
$content_button_textcolor = ot_get_option('content_button_textcolor');
if($content_button_textcolor!=''){
?>
body.dark #comment-submit, body.dark .btn-1,
#comment-submit,.btn-1{ color:<?php echo $content_button_textcolor ?>}
<?php }?>

<?php 
$content_button_hovercolor = ot_get_option('content_button_hovercolor');
if($content_button_hovercolor!=''){
?>
body.dark #comment-submit:hover, body.dark .btn-1:hover,
#comment-submit:hover,.btn-1:hover{ color:<?php echo $content_button_hovercolor ?>}
<?php }?>

<?php 
$content_button_bgcolor = ot_get_option('content_button_bgcolor');
if($content_button_bgcolor!=''){
?>
body.dark #comment-submit, body.dark .btn-1,
#comment-submit,.btn-1{ border-color:<?php echo $content_button_bgcolor ?>}
<?php }?>

<?php 
$content_button_hoverbg = ot_get_option('content_button_hoverbg');
if($content_button_hoverbg!=''){
?>
body.dark #comment-submit:hover, body.dark .btn-1:hover,
#comment-submit:hover,.btn-1:hover{}
.btn-1b:after{ background:<?php echo $content_button_hoverbg ?>}
<?php }?>

.woocommerce #main-body .product .woocommerce-tabs ul.tabs li.active a,.woocommerce-page #main-body .product .woocommerce-tabs ul.tabs li.active a,.dark.woocommerce #main-body .product .woocommerce-tabs ul.tabs li.active a,.dark.woocommerce-page #main-body .product .woocommerce-tabs ul.tabs li.active a{border-top:2px solid <?php echo $gp_main_color;?>}

.woocommerce .woocommerce-message:before{background-color:<?php echo $gp_main_color;?>}
.woocommerce .woocommerce-message{border-top:3px solid <?php echo $gp_main_color;?>;box-shadow:none}
.woocommerce .woocommerce-message,.woocommerce .woocommerce-error,.woocommerce .woocommerce-info{box-shadow:none}

<?php //custom CSS
echo ot_get_option('custom_css','');