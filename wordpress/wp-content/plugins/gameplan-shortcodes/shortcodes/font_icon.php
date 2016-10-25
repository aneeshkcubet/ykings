<?php


function parse_cticon($atts, $content){	
	$id = isset($atts['id']) ? $atts['id'] : '';
	$icon = (isset($atts['icon'])) ? $atts['icon'] : '';	
	$effect = isset($atts['effect']) ? $atts['effect'] : 'effect-1';
	$size = isset($atts['size']) ? $atts['size'] : '';
	$type = isset($atts['type']) ? $atts['type'] : '';
	$link = isset($atts['link']) ? 'href="'.$atts['link'].'"' : '';
	$text_color = isset($atts['text_color']) ? $atts['text_color'] : '';
	$bg_color = isset($atts['bg_color']) ? $atts['bg_color'] : '';
	
	
	$html = '';
	$effect_num = 'hi-icon-'.str_replace('effect-2', '5', str_replace('effect-1', '3', $effect));
	if($icon != ''){
		$html .= '<a id="'.$id.'" '.$link.' class="'.$effect_num.' hi-icon '.$type.' '.$size.' fa '.$icon.'"><!----></a>';
		if($id != '')
			$effect_num = '#'.$id;
		else
			$effect_num = '.'.$effect_num;		
		// BEGIN Parse shortcode Icon		
		if($effect == 'effect-1'){
			if($text_color != ''):		
				$html .= '<style type="text/css" scoped="scoped">
					'.$effect_num.'{color: '.$text_color.'; }
					'.$effect_num.'.hi-icon:hover{color: '.$text_color.';}
				</style>';
			endif;
			if($bg_color != '')	:
				$html .= '<style type="text/css" scoped="scoped">
					'.$effect_num.'{box-shadow: 0 0 0 3px '.$bg_color.';}
					'.$effect_num.':after{background-color: '.$bg_color.';}
				</style>';
			endif;
		}
		if($effect == 'effect-2'){
			if($text_color != ''){
				$text_color_rgb = cactus_hex2rgb($text_color);
				
				$html .= '<style type="text/css" scoped="scoped">
					'.$effect_num.'{box-shadow: 0 0 0 4px rgba('.$text_color_rgb[0].','.$text_color_rgb[1].','.$text_color_rgb[2].',1); color: '.$text_color.'}
					'.$effect_num.':hover{background: rgba('.$text_color_rgb[0].','.$text_color_rgb[1].','.$text_color_rgb[2].',1);box-shadow: 0 0 0 8px rgba('.$text_color_rgb[0].','.$text_color_rgb[1].','.$text_color_rgb[2].',0.3);}
				</style>';
			}
			if($bg_color != '')	:
				$html .= '<style type="text/css" scoped="scoped">
					'.$effect_num.':hover{color: '.$bg_color.';}
				</style>';
			endif;
		}
	}
	return $html;	
}




add_shortcode( 'cticon', 'parse_cticon' );




