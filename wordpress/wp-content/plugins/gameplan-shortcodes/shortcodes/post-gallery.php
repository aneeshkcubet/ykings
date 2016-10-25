<?php

/* This shortcode [gallery] is used in post loop only */
function parse_post_ctgallery($atts, $content){
	$id = get_the_ID();
	$feature_image_id = get_post_thumbnail_id($id);
	global $font_awesome;
	$args = array(
		'order'          => 'ASC',
		'orderby'        => 'menu_order',
		'post_type'      => 'attachment',
		'post_parent'    => $id,
		'post_mime_type' => 'image',
		'post_status'    => null,
		'numberposts'    => -1
	);
	$attachments = get_posts($args);
	
	$html = '<div class="carouselfred"><div id="post_gallery">';
	
	if(isset($atts['include_feature_image']) && $atts['include_feature_image'] = 1 && $feature_image_id != ''){
		$html .= "<div class='slide'>" . get_the_post_thumbnail($id,'full') . '</div>';
	}
	
	foreach($attachments as $attachment){
		if(isset($atts['include_feature_image']) && $atts['include_feature_image'] = 1 && $feature_image_id != '' && $feature_image_id == $attachment->ID){
			continue;
		}
		$html .= "<div class='slide'><img alt='" . apply_filters( 'the_title', $attachment->post_title ) . "' src='". $attachment->guid . "'/></div>";
	}
	
	$html .= '</div><div class="clearfix"></div><a class="pprev" id="foo1_prev" href="javascript:void(0)"><i class="icon-angle-left '.($font_awesome==4?'fa fa-angle-left':'').'"></i></a><a class="nnext" id="foo1_next" href="javascript:void(0)"><i class="icon-angle-right '.($font_awesome==4?'fa fa-angle-right':'').'"></i></a><div class="g-pagination" id="foo3_pag"></div></div>';

	return $html;
}
add_shortcode( 'ctgallery', 'parse_post_ctgallery' );