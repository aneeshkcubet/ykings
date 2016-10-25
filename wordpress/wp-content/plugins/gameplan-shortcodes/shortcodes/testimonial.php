<?php
function parse_testimonial($atts, $content, $id){
	global $testimonial_slides;
	wp_enqueue_style( 'ui-custom-theme' );
	wp_enqueue_script('jquery-ui-accordion');
	$class = isset($atts['class']) ? $atts['class'] : '';	
	if(class_exists('Mobile_Detect')){
		$detect = new Mobile_Detect;
		$_device_ = $detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'pc';
		if(isset($atts['animation'])){
		$animation_class = ($atts['animation']&&$_device_=='pc')?'wpb_'.$atts['animation'].' wpb_animate_when_almost_visible':'';
		}
	}else{
		if(isset($atts['animation'])){
		$animation_class = $atts['animation']?'wpb_'.$atts['animation'].' wpb_animate_when_almost_visible':'';
		}
	}
	str_replace("[testimonial_item","",$content,$i);
	if($i > 1){
		//echo 'okk';
		$testimonial_slides = $i;
		if(function_exists( 'head_slide' )){
		$html .= head_slide($i, 'testimonial-'.rand(), $animation_class, array('head'=>true));
		}
	}
	$html .= do_shortcode(str_replace('<br class="nc" />', '', $content));
	if($i > 1){
		if(function_exists( 'footer_slide' )){
		$html .= footer_slide(array('head'=>true));
		}
	}
	return $html;
}

function parse_testimonial_item($atts, $content, $id){
	$position = isset($atts['position']) ? $atts['position'] : '';
	$name = isset($atts['name']) ? $atts['name'] : '';
	$company = isset($atts['company']) ? $atts['company'] : '';
	wp_enqueue_script( 'jquery-isotope');
    global $testimonial_slides;
	
	$output = '';
	if($testimonial_slides > 1){
		if(function_exists( 'head_slide' )){
			$output .= head_slide($testimonial_slides, '', '', array('page'=>true));
		}
	}
	$output .= '<div class="testimonial style-1">';
	$output .= '<div class="tt-content icon-quote-right fa fa-quote-right">';
	$output .= strip_tags($content);
	$output .= '<div class="tt-tooltip"><!----></div>';
	$output .= '</div>';
	$output .= '<div class="name">'.$atts['name'].($atts['position']?', '.$atts['position']:'').($atts['company']?' - '.$atts['company']:'').'</div>';
	$output .= '</div>';
	if($testimonial_slides > 1){
		if(function_exists( 'footer_slide' )){
			$output .= footer_slide(array('page'=>true));
		}
	}
	return $output;

}
add_shortcode( 'testimonial_item', 'parse_testimonial_item' );
add_shortcode( 'testimonial', 'parse_testimonial' );

//Visual Composer

add_action( 'after_setup_theme', 'reg_testimonial' );
function reg_testimonial(){
	if(function_exists('wpb_map')){
		vc_map( array(
			"name"		=> __("Testimonial", "cactusthemes"),
			"base"		=> "testimonial",
			"as_parent" => array('only' => 'testimonial_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
			"content_element" => true,
			"show_settings_on_create" => false,
			"icon" => "icon-testimonial",
			"params"	=> array(
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
			'js_view' => 'VcColumnView'
		) );
		wpb_map( array(
			"name"		=> __("Testimonial item", "cactusthemes"),
			"base"		=> "testimonial_item",
			"content_element" => true,
			"as_child" => array('only' => 'testimonial_item'), // Use only|except attributes to limit parent (separate multiple values with comma)
			"icon" => "icon-testimonial",
			"params"	=> array(
				array(
					"type" => "textfield",
					"heading" => __("Name", "cactusthemes"),
					"param_name" => "name",
					"value" => "",
					"description" => '',
				),
				array(
					"type" => "textfield",
					"heading" => __("Position", "cactusthemes"),
					"param_name" => "position",
					"value" => "",
					"description" => '',
				),
		
		
				array(
					"type" => "textfield",
					"heading" => __("Company", "cactusthemes"),
					"param_name" => "company",
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
			),
		) );
	}
	if(class_exists('WPBakeryShortCode') && class_exists('WPBakeryShortCodesContainer')){
	class WPBakeryShortCode_testimonial extends WPBakeryShortCodesContainer{}
	class WPBakeryShortCode_testimonial_item extends WPBakeryShortCode{}
	}
}
