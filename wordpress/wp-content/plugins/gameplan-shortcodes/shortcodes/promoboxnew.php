<?php
function parse_promoboxnew($atts, $content, $id){
	$class = isset($atts['class']) ? $atts['class'] : '';	
	$id_col=rand();
	if(class_exists('Mobile_Detect')){
		$detect = new Mobile_Detect;
		$_device_ = $detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'pc';
		$animation_class = (isset($atts['animation']) && $atts['animation'] && $_device_=='pc')?'wpb_'.$atts['animation'].' wpb_animate_when_almost_visible':'';
	}else{
		$animation_class = (isset($atts['animation'])  && $atts['animation']) ?'wpb_'.$atts['animation'].' wpb_animate_when_almost_visible':'';
	}
	str_replace("[promoboxnew_item","",$content,$i);
	global $promoboxnew_slides_number;
	$promoboxnew_slides_number = $i;
	$html = '<div class="promoboxnew '.$animation_class.'"><div class="promoboxnew-inner"><div class="row">'.do_shortcode(str_replace('<br class="nc" />', '', $content)).'</div></div></div>';
	
	return $html;
}

function parse_promoboxnew_item($atts, $content, $id){
	$title = isset($atts['title']) ? $atts['title'] : '';
	$background = isset($atts['background']) ? $atts['background'] : '';
	$link = isset($atts['link']) ? $atts['link'] : '';
	
	global $promoboxnew_slides;
	global $promoboxnew_slides_number;
	$promoboxnew_slides_number;
	//$el_class = $this->getExtraClass($el_class);
	$output = '';
	if($promoboxnew_slides_number == 2){
		$span_class = 'span6';
	}elseif($promoboxnew_slides_number == 3){
		$span_class = 'span4';
	}elseif($promoboxnew_slides_number == 4){
		$span_class = 'span3';
	}elseif($promoboxnew_slides_number == 6){
		$span_class = 'span2';
	}else{
		$span_class = 'span4';
	}
	if(isset($atts['background'])&&$atts['background']){
		$background = wp_get_attachment_image_src( $atts['background'], 'full' );
		$output .= '<div class="promoboxnew-item '.$span_class.'" style="background-image:url('.$background[0].')">';
	}else{
		$output .= '<div class="promoboxnew-item '.$span_class.'">';
	}
	if(isset($atts['link'])&&$atts['link']){
		$output .= '<a href="'.$atts['link'].'">';
	}
	$output .= '<div class="promoboxnew-item-inner">';
	$output .= '<h3 class="promoboxnew-item-heading"><i class="icon-caret-left fa fa-caret-left"></i>'.$atts['title'].'</h3>';
	$output .= '<div class="promoboxnew-item-content">';
	$output .= strip_tags($content,'<h1><h2><h3><h4><h5>');
	$output .= '</div>';
	$output .= '</div>';
	if(isset($atts['link'])&&$atts['link']){
		$output .= '</a>';
	}
	$output .= '</div>';
    return $output;
}
add_shortcode( 'promoboxnew_item', 'parse_promoboxnew_item' );
add_shortcode( 'promoboxnew', 'parse_promoboxnew' );

//Visual Composer

add_action( 'after_setup_theme', 'reg_promoboxnew' );
function reg_promoboxnew(){
	if(function_exists('wpb_map')){

		vc_map( array(
			"name"		=> __("Promo Box", "cactusthemes"),
			"base"		=> "promoboxnew",
			"as_parent" => array('only' => 'promoboxnew_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
			"content_element" => true,
			"show_settings_on_create" => false,
			"icon" => "icon-promoboxnew",
			"params"	=> array(
				array(
					"type" => "textfield",
					"heading" => __("Name", "cactusthemes"),
					"param_name" => "name",
					"value" => "",
					"description" => '',
				),
				array(		
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __("CSS Animation", 'cactusthemes'),
					"param_name" => "animation",
					"value" => array(
						__("No", 'cactusthemes') => '',
						__("Top to bottom", 'cactusthemes') => 'top-to-bottom',
						__("Bottom to top", 'cactusthemes') => 'bottom-to-top',
						__("Left to right", 'cactusthemes') => 'left-to-right',
						__("Right to left", 'cactusthemes') => 'right-to-left',
						__("Appear from center", 'cactusthemes') => 'appear',
					),
					"description" => ''
				),
			),
			"js_view" => 'VcColumnView'
		) );
		vc_map( array(
			"name"		=> __("Promo item", "cactusthemes"),
			"base"		=> "promoboxnew_item",
			"content_element" => true,
			"as_child" => array('only' => 'promoboxnew_item'), // Use only|except attributes to limit parent (separate multiple values with comma)
			"icon" => "icon-promoboxnew",
			"params"	=> array(
				array(
					"type" => "textfield",
					"heading" => __("Title", "cactusthemes"),
					"param_name" => "title",
					"value" => "",
					"description" => '',
				),
				array(
					"type" => "attach_image",
					"heading" => __("Background", "cactusthemes"),
					"param_name" => "background",
					"value" => "",
					"description" => '',
				),
				array(
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => __("Content", "cactusthemes"),
					"param_name" => "content",
					"value" => '',
					"description" => '',
				),
				array(
					"type" => "textfield",
					"heading" => __("Link to go", "cactusthemes"),
					"param_name" => "link",
					"value" => "",
					"description" => '',
				),
			),
		) );
	}
	if(class_exists('WPBakeryShortCode') && class_exists('WPBakeryShortCodesContainer')){
	class WPBakeryShortCode_promoboxnew extends WPBakeryShortCodesContainer{}
	class WPBakeryShortCode_promoboxnew_item extends WPBakeryShortCode{}
	}
}
