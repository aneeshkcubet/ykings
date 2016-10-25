<?php

function parse_checklist_func($atts, $content){
	$type = isset($atts['type']) ? $atts['type'] : 'default';
	$icon = isset($atts['icon']) ? $atts['icon'] : '';
	$id = isset($atts['id']) ? $atts['id'] : '';
	$html = '';
	if($icon != ''){
		$content = str_replace('<li>', '<li><i class="fa '.$icon.'"><!----></i>', strip_tags($content, '<ul><li><b><em><ol><img><blockquote><a>'));
		$html .= '
			<style type="text/css" scoped="scoped">
				#'.$id.' ul li{padding-left:26px;}
			</style>
		';
	}
	if($type == 'boxed'){
		$html .= '<div id="'.$id.'" class="boxed-icon-checklist">'.$content.'</div>';
	}else{
		$html .= '<div id="'.$id.'" class="icon-checklist">'.$content.'</div>';
	}	
	return $html;
}


add_shortcode( 'checklist', 'parse_checklist_func' );




















