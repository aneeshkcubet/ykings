<?php
function parse_timeline($atts, $content, $id){
	str_replace("[timeline_item","",$content,$i);
	$output = '';
	global $sl;
	global $id;
	$sl=$i;
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
	$output .= '<div class="wpb_content_element  '.$animation_class.' not-column-inherit">'; 
	$output .= '<div class="wpb_wrapper wpb_accordion_wrapper ui-helper-reset ui-accordion boxed timeline-list">';

	$output .= do_shortcode(str_replace('<br class="nc" />', '', $content));
	$output .= '</div> ';
	$output .= '</div> ';
	if($sl==1)
	{
		$output .= '
		<style type="text/css" scoped="scoped">
		#tl'.$id.'.timeline .row-fluid .col11 .line{ position:absolute;top:-17px; left:-34px; font-size:18px; border-left:0 ;}
		</style> 
		';
	}
	return $output;
}

function parse_timeline_item($atts, $content, $id){
	$title = isset($atts['title']) ? $atts['title'] : '';
	$text = isset($atts['text']) ? $atts['text'] : '';
	global $id;
	$id = rand();
	global $sl;
	$output = '';

	$output .= '<div class="timeline" id="tl'.$id.'">';
	$output .= '<div class="row-fluid">';
	$output .= '<div class="col1">';
	$output .=  '</div>';
	$output .=  '<div class="col11">';
	$output .=  '<span class="dot"><span></span></span>';
	$output .=  '<span class="line"></span>';
	$output .=  '<span class="title" >'.$title.'</span>';
	$output .=  '<span class="content">'.$text.'</span>';
	$output .=  '</div>';
	$output .=  '</div>';
	$output .=  '</div> ';
	return $output;
}
add_shortcode( 'timeline_item', 'parse_timeline_item' );
add_shortcode( 'timeline', 'parse_timeline' );

//Visual Composer

add_action( 'after_setup_theme', 'reg_timeline' );
function reg_timeline(){
	if(function_exists('wpb_map')){

		vc_map( array(
			"name"		=> __("Timeline", "cactusthemes"),
			"base"		=> "timeline",
			"as_parent" => array('only' => 'timeline_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
			"content_element" => true,
			"show_settings_on_create" => false,
			"icon" => "icon-promoboxnew",
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


		vc_map( array(
			"name"		=> __("Timeline item", "cactusthemes"),
			"base"		=> "timeline_item", 
			"content_element" => true,
			"as_child" => array('only' => 'timeline_item'), // Use only|except attributes to limit parent (separate multiple values with comma)
			"icon" => "icon-timeline",
			"params"	=> array(
				array(
					"type" => "textfield",
					"heading" => __("Title", "cactusthemes"),
					"param_name" => "title",
					"value" => "",
					"description" => '',
				),
				array(
					"type" => "textarea",
					"heading" => __("Content", "cactusthemes"),
					"param_name" => "text",
					"value" => "",
					"description" => '',
				),
		
			),
		) );

	}
	if(class_exists('WPBakeryShortCode') && class_exists('WPBakeryShortCodesContainer')){
	class WPBakeryShortCode_timeline extends WPBakeryShortCodesContainer{}
	class WPBakeryShortCode_timeline_item extends WPBakeryShortCode{}
	}
}
