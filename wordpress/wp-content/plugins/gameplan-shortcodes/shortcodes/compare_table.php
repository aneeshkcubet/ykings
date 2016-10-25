<?php
/* SHORT CODE FOR COMPARE TABLE 
 *
 * [testimonial name="" job=""]
 *			Testimonial content
 *		[testi-avatar]
 *			Avatar of testimonial author
 *		[/testi-avatar]
 * [/testimonial]
 *
 */
function parse_compare_table($atts, $content){
	/*$name = ($atts['name']) ? $atts['name'] : '';
	$job = ($atts['job']) ? $atts['job'] : '';	
	$testi = strip_shortcodes($content);
	preg_match('/\[testi-avatar\](.*)\[\/testi-avatar\]/s',$content,$matches);
	if(count($matches)>0){
		$avatar = $matches[0];
	} else {
		$avatar = '';
	}*/
	$class = isset($atts['class']) ? $atts['class'] : 'tb-style-1';	
	$id = isset($atts['id']) ? $atts['id'] : '';	
	if(class_exists('Mobile_Detect')){
		$detect = new Mobile_Detect;
		$_device_ = $detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'pc';
		$animation_class = (isset($atts['animation']) && $atts['animation'] &&$_device_=='pc')?'wpb_'.$atts['animation'].' wpb_animate_when_almost_visible':'';
	}else{
		$animation_class = (isset($atts['animation']) && $atts['animation'])?'wpb_'.$atts['animation'].' wpb_animate_when_almost_visible':'';
	}
	$html = '
		<div class="'.$class.' '.$animation_class.'" id="'.$id.'">
			'.do_shortcode(str_replace('<br class="nc" />', '', $content, $id)).'			
		</div>
	';
	return $html;	
}

function parse_compare_table_column($atts, $content, $id){
	$class = isset($atts['class']) ? $atts['class'] : '';	
	$id_col=rand();
	$widthcolumn = isset($atts['column']) ? (100/$atts['column']) : 100;
	$bg_color = isset($atts['bg_color']) ? 'background-color:'.$atts['bg_color'].' !important;' : '';
	if($bg_color=='#'){
		$bg_color='';
	}
	$html = '
		<style type="text/css" scoped="scoped">
			.tb-style-1 #com1-'.$id_col.'{'.$bg_color.'}
			.tb-style-2 #com1-'.$id_col.'{'.$bg_color.'}
			@media screen and (-webkit-min-device-pixel-ratio:0) { 
			.tb-style-1 #com1-'.$id_col.'{ background-color: transparent !important}
				.tb-style-1 .compare-table-column .compare-table-row{ '.$bg_color.'}
			}			
		</style>

		<div style="width:'.$widthcolumn.'%; float:left; " class="column" >
			<div class="compare-table-column '.$class.'" id="com1-'.$id_col.'">
				'.do_shortcode(str_replace('<br class="nc" />', '', $content, $id)).'
			</div>
		</div>
	';
	
	return $html;
}

function parse_compare_table_row($atts, $content, $id){
	$class = isset($atts['class']) ? $atts['class'] : '';
	$headding = isset($atts['title']) ? '<h3>'.$atts['title'].'</h3>' : '';
	$color = isset($atts['color']) ? 'background-color:'.$atts['color'].'!important;' : '';
	$color_border = isset($atts['color']) ? $atts['color'] : '';
	if($color=='#'){
		$color='';
	}	
	$html = '
		<div class="compare-table-row '.$class.'" ><div class="compare-table-content" style="'.$color.'">
			'.$headding.'<span>'.do_shortcode(str_replace('<br class="nc" />', '', $content)).'</span>'.'
		</div></div>
	';
	$html=str_replace("<p></p>","",$html);
	return $html;
}


add_shortcode( 'comparetable', 'parse_compare_table' );
add_shortcode( 'c-column', 'parse_compare_table_column' );
add_shortcode( 'c-row', 'parse_compare_table_row' );
?>