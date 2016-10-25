<?php
function parse_facebox_func($atts, $content){
	$links = isset($atts['links']) ? $atts['links'] : '';
	$width = isset($atts['width']) ? $atts['width'] : '450';
	$layout = isset($atts['layout']) ? $atts['layout'] : '';
	//$style = isset($atts['style']) ? $atts['style'] : '';
	$colorscheme = isset($atts['colorscheme']) ? $atts['colorscheme'] : '';
	$sendbutton = isset($atts['sendbutton']) ? $atts['sendbutton'] : '';
	$showfaces = isset($atts['showfaces']) ? $atts['showfaces'] : '';
	if($links=='')
	{
		$links=curPageURL();
	}
	$html = '
	<iframe src="//www.facebook.com/plugins/like.php?href='.urlencode($links).'&amp;width='.$width.'&amp;height=35&amp;colorscheme='.$colorscheme.'&amp;layout='.$layout.'&amp;action=like&amp;show_faces='.$showfaces.'&amp;send='.$sendbutton.'" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$width.'px; height:35px;" allowTransparency="true"></iframe>
		';
	return $html;
	
}

add_shortcode( 'facebook', 'parse_facebox_func' );
/*'.urlencode($links).'*/