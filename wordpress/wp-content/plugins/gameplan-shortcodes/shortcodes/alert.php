<?php
function alert_func($atts, $content){
	$message = isset($atts['message']) ? $atts['message'] : '';
	$icon = isset($atts['icon']) ? $atts['icon'] : '';
	$style = isset($atts['style']) ? $atts['style'] : '';
	$color = isset($atts['color']) ? $atts['color'] : '';
	$bd_color = isset($atts['bd_color']) ? $atts['bd_color'] : '';
	$bg_color = isset($atts['background']) ? $atts['background'] : '';
	if(class_exists('Mobile_Detect')){
		$detect = new Mobile_Detect;
		$_device_ = $detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'pc';
		$animation_class = (isset($atts['animation']) && $atts['animation'] && $_device_=='pc')?'wpb_'.$atts['animation'].' wpb_animate_when_almost_visible':'';
	}else{
		$animation_class = (isset($atts['animation'])  && $atts['animation']) ?'wpb_'.$atts['animation'].' wpb_animate_when_almost_visible':'';
	}
	
	$html = '';
switch($style){
		case 'border_style':
		$html .= '
			
			<div class="alert-style-2 '.$animation_class.'" style="background:'.$bg_color.'; color:'.$color.'; border-color:'.$bd_color.'">
			
				<div class="row-fluid">
					<div class="coll1" style="color:'.$color.'" ><i class="fa '.$icon.'" style=" font-size:30px"></i></div>
					<div class="coll11">'.$message.'</div>
				</div>
			</div>
		';
		break;
		case '':
		$html .= '
		
			<div class="alert-style-2 '.$animation_class.'" style="background:'.$bg_color.'; color:'.$color.'; border:0">
				<div class="row-fluid">
					<div class="coll1" style="color:'.$color.'" ><i class="fa '.$icon.'" style=" font-size:30px"></i></div>
					<div class="coll11">'.$message.'</div>
				</div>
			</div>
		';
		break;

		}
	return $html;

}

add_shortcode( 'alert', 'alert_func' );


/* Register shortcode with Visual Composer */
add_action( 'after_setup_theme', 'reg_alert' );
function reg_alert(){
	if(function_exists('wpb_map')){
	wpb_map( array(
	   "name" => __("Alert", 'castusthemes'),
	   "base" => "alert",
	   "class" => "",
	   "controls" => "full",
	   "category" => __('Content', 'castusthemes'),
	   "params" => array(
		  array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Message", 'castusthemes'),
			 "param_name" => "message",
			 "value" => '',
			 "description" => ''
		  ),
	
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon", 'castusthemes'),
			 "param_name" => "icon",
			 "value" => '',
			 "description" => 'Name Font-Awesome. Ex: icon-sort-by-alphabet',
		  ),
	
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Style", 'castusthemes'),
			 "param_name" => "style",
			 "value" => array(__("", "") => "",__("Border Style", 'castusthemes') => "border_style"),
			 "description" => ''
		  ),
		  
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Color", 'castusthemes'),
			 "param_name" => "color",
			 "value" => "",
			 "description" => 'Color for text ex: #fff'
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Border Color", 'castusthemes'),
			 "param_name" => "bd_color",
			 "value" => "",
			 "description" => 'Border Color for style :border_style'
		  ),
	
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background", 'castusthemes'),
			 "param_name" => "background",
			 "value" => "",
			 "description" => 'Color Background ex: #fff'
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
	   )
	)
	);
	}
}