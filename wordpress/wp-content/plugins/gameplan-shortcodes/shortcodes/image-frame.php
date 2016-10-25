<?php


function parse_image_frame_func($atts, $content){
	$type = isset($atts['type']) ? $atts['type'] : '';
	$image = isset($atts['image']) ? $atts['image'] : '';	
	$size = isset($atts['size']) ? $atts['size'] : '';
	$alt = isset($atts['alt']) ? $atts['alt'] : '';
	
	$html = '';
	
	if($size != ''){ 
		list($width, $height) = split(',', $size);
		$html .= '<div class="'.$type.' imageframe">'.wp_get_attachment_image($image, array($width, $height), false, array('alt' => $alt));
		if($type == 'image_bottomshadow' || $type == 'image_bottomshadow_2'){
			$html .= '<span class="imageframe-shadow-left"></span><span class="imageframe-shadow-right"></span>';
		}
		$html .= '</div>';
	}else{
		$html .= '<div class="'.$type.' imageframe">'.wp_get_attachment_image($image, array(), false, array('alt' => $alt));		
		if($type == 'image_bottomshadow' || $type == 'image_bottomshadow_2'){
			$html .= '<span class="imageframe-shadow-left"></span><span class="imageframe-shadow-right"></span>';
		}
		$html .= '</div>';
	}
	return $html;	
}

add_shortcode( 'imageframe', 'parse_image_frame_func' );






/* Register shortcode with Visual Composer */
add_action( 'after_setup_theme', 'reg_imageframe' );
function reg_imageframe(){
	if(function_exists('wpb_map')){

	wpb_map( array(
	   "name" => __("Image Frames", 'emerald'),
	   "base" => "imageframe",
	   "class" => "",
	   "controls" => "full",
	   "category" => __('Content', 'emerald'),
	   "params" => array(	  
		  array(
			 "type" => "attach_image",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Image", 'emerald'),
			 "param_name" => "image",
			 "value" => '',
			 "description" => ''
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Image size", 'emerald'),
			 "param_name" => "size",
			 "value" => '',
			 "description" => 'Exam: 150,150'
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Image ALT", 'emerald'),
			 "param_name" => "alt",
			 "value" => '',
			 "description" => ''
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Type Image Frames", 'emerald'),
			 "param_name" => "type",
			 "value" => array(
				__('None', 'framework'), 
				__('Image Border', 'framework'),
				__('Image Glow', 'framework'),
				__('Image DropShadow', 'framework'),
				__('Image BottomShadow', 'framework'),
				__('Image BottomShadow 2', 'framework'),
				__('Image Lifted corners', 'framework'),
				__('Image Raised box', 'framework'),
				__('Image Horizontal curves', 'framework'),
				__('Image Single horizontal curve', 'framework')
			 ),
			 "description" => ''
		  ),
	   )
	) );
	}
}



