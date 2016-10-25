<?php

function heading_func($atts, $content){
	$style = isset($atts['style']) ? $atts['style'] : 'def';
	$color = isset($atts['color']) ? $atts['color'] : '';
	$icon = isset($atts['icon']) ? $atts['icon'] : '';
	$heading = isset($atts['heading']) ? $atts['heading'] : '';
	$firstword = isset($atts['firstword']) ? $atts['firstword'] : 'yes';
	$dotted = isset($atts['dotted']) ? $atts['dotted'] : 'yes';
	$paddingtop = isset($atts['paddingtop']) ? $atts['paddingtop'] : '';
	$paddingbottom = isset($atts['paddingbottom']) ? $atts['paddingbottom'] : '';
	
	$id=rand();
	$html='';
	if($style==''||$style=='def')
	{
		if($paddingtop != ''|| $paddingbottom!= ''){
			$html .= '<style type="text/css" scoped="scoped">
				#heading-id'.$id.'{padding-top:'.$paddingtop.'px; padding-bottom:'.$paddingbottom.'px}
			</style>';
		}
		$html.='
			<div class="box-style-1 heading-shortcode" id="heading-id'.$id.'">
				<div class="module-title"><h2 class="title def_style" style="color: '.$color.' !important"><span><span class="firstword" style="color: '.$color.' !important">'.$heading.'</span></span></h2></div>
			</div>
		';
		
	}else
	{
		if($paddingtop != ''|| $paddingbottom!= ''){
			$html .= '<style type="text/css" scoped="scoped">
				#heading-id'.$id.'{padding-top:'.$paddingtop.'px; padding-bottom:'.$paddingbottom.'px}
			</style>';
		}
	
		$firstw = '';
		if($firstword == 'yes'){
			$firstw = explode(' ',trim($heading));
			if($color == ''){
				$heading = '<span>'.$firstw[0].'</span>' . str_replace($firstw[0], '', $heading);
			}else{
				$heading = '<span style="color:'.$color.'">'.$firstw[0].'</span>' . str_replace($firstw[0], '', $heading);
			}
		}
		if($icon != ''){
			if($color == ''){
				$icon = '<i class="fa '.$icon.'"><!----></i>';
			}else{
				$icon = '<i style="color:'.$color.'" class="fa '.$icon.'"><!----></i>';
			}
		}
		if($dotted == 'yes'){
			$dotted = '<div class="dotted"><!----></div>';
		}else{
			$dotted = '';
		}
		
		$html .= heading($icon,$heading,$id,$dotted,$color);
	}
	return $html;

}
add_shortcode( 'heading', 'heading_func' );

function heading($icon,$heading,$id,$dotted,$color){
	$rtl = function_exists('ot_get_option')?ot_get_option('righttoleft'):0;	
	if($rtl == 0){
		$html = '
			<div class="box-style-1 heading-shortcode" id="heading-id'.$id.'">
				<div class="module-title"><h2 class="title" style="color:'.$color.'; line-height:40px">'.$icon.$heading.'</h2>'.$dotted.'</div>
			</div>
		';
	}else{
		$html = '
			<div class="box-style-1 heading-shortcode" id="heading-id'.$id.'">
				<div class="module-title">'.$dotted.'<h2 class="title" style="padding-right:0; padding-left:10px; color:'.$color.'">'.$heading.$icon.'</h2></div>
			</div>
		';
	}
	return $html;
}

/* Register shortcode with Visual Composer */
add_action( 'after_setup_theme', 'reg_heading' );
function reg_heading(){
	if(function_exists('wpb_map')){
		wpb_map( array(
		   "name" => __("Heading"),
		   "base" => "heading",
		   "class" => "",
		   "controls" => "full",
		   "category" => __('Content'),
		   "params" => array(
			  array(
				 "type" => "dropdown",
				 "holder" => "div",
				 "class" => "",
				 "heading" => __("Style", 'cactusthemes'),
				 "param_name" => "style",
				 "value" => array(__('Default', 'cactusthemes') => 'def', __('Dotted', 'cactusthemes') => 'dot'),
				 "description" => ''
			  ),
			  array(
				 "type" => "textfield",
				 "holder" => "div",
				 "class" => "",
				 "heading" => __("Icon", 'cactusthemes'),
				 "param_name" => "icon",
				 "value" => '',
				 "description" => __('Name of font Awesome in http://fortawesome.github.io/Font-Awesome/icons for style dotted. Ex: icon-mobile-phone')
			  ),
			  array(
				 "type" => "textfield",
				 "holder" => "div",
				 "class" => "",
				 "heading" => __("Heading", 'cactusthemes'),
				 "param_name" => "heading",
				 "value" => '',
				 "description" => '',
			  ),
			  array(
				 "type" => "colorpicker",
				 "holder" => "div",
				 "class" => "",
				 "heading" => __("Color", 'cactusthemes'),
				 "param_name" => "color",
				 "value" => '',
				 "description" => 'Color for text ex: #fff',
			  ),
			  array(
				 "type" => "dropdown",
				 "holder" => "div",
				 "class" => "",
				 "heading" => __("First Word Different for style Dotted", 'cactusthemes'),
				 "param_name" => "firstword",
				 "value" => array(__('Yes', 'cactusthemes') => 'yes', __('No', 'cactusthemes') => 'no'),
				 "description" => ''
			  ),
			  array(
				 "type" => "dropdown",
				 "holder" => "div",
				 "class" => "",
				 "heading" => __("Show dotted for style Dotted", 'cactusthemes'),
				 "param_name" => "dotted",
				 "value" => array(__('Yes', 'cactusthemes') => 'yes', __('No', 'cactusthemes') => 'no'),
				 "description" => ''
			  ),
			  array(
				"type" => "textfield",
				"heading" => __("Padding Top", "js_composer"),
				"param_name" => "paddingtop",
				"value" => "",
				"description" => __("Padding top (in pixels). Ex. 10. Default:0"),
			  ),
			  array(
				"type" => "textfield",
				"heading" => __("Padding Bottom", "js_composer"),
				"param_name" => "paddingbottom",
				"value" => "",
				"description" => __("Padding bottom (in pixels). Ex.10. Default:0"),
			  ),
		
		   )
		) );
	}
}