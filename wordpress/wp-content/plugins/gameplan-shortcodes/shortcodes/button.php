<?php


function parse_button($atts, $content){	
	$size = isset($atts['size']) ? $atts['size'] : '';	
	$id = isset($atts['id']) ? $atts['id'] : '';
	$links = isset($atts['link']) ? $atts['link'] : '';
	//$style = isset($atts['style']) ? $atts['style'] : 'default';
	$icon = isset($atts['icon']) ? $atts['icon'] : '';
	$text_color = isset($atts['text_color']) ? $atts['text_color'] : '';
	$bg_color = isset($atts['bg_color']) ? $atts['bg_color'] : '';
	$text_color_hover = isset($atts['text_color_hover']) ? $atts['text_color_hover'] : '';
	$bg_color_hover = isset($atts['bg_color_hover']) ? $atts['bg_color_hover'] : '';
	

	$html = '';
	$style_css = '';
	if($bg_color != '')
		$style_css .= '<style type="text/css" scoped="scoped">
			#'.$id.'.btn-1{border-color: '.$bg_color.';}								
		</style>';
	if($text_color != '')
		$style_css .= '<style type="text/css" scoped="scoped">
			#'.$id.'.btn-1{color: '.$text_color.';}					
		</style>';				
	if($text_color_hover != '')
		$style_css .= '<style type="text/css" scoped="scoped">
			#'.$id.'.btn-1b:hover, #'.$id.'.btn-1b:active{color: '.$text_color_hover.' !important;}
		</style>';
	if($bg_color_hover != '')
		$style_css .= '<style type="text/css" scoped="scoped">
			#'.$id.'.btn-1b:hover{border-color: '.$bg_color_hover.';}
			#'.$id.'.btn-1b:after{background-color: '.$bg_color_hover.';}	
		</style>';
	
	$html .= ''.$style_css.'<div style="position: relative; z-index: 1; display:inline-block; vertical-align:top;"><a '.($id?'id="'.$id.'"':'').' href="'.$links.'" class=" bttn btn-1 btn-1b '.$icon.' '.(($size == 'small')?'small':'').'">'.$content.'</a></div>';

	
	return $html;	
}




add_shortcode( 'button', 'parse_button' );




