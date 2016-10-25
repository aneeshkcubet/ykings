<?php
function parse_member_func($atts, $content){
	$id = isset($atts['id']) ? $atts['id'] : '';
	$bg_color = isset($atts['bg_color']) ? $atts['bg_color'] : '';
	$animation_class = isset($atts['animation'])?'wpb_'.$atts['animation'].' wpb_animate_when_almost_visible':'';
	wp_reset_postdata();
	
	$args = array(
		'post_type' => 'member',
		'p' => $id,	
		'post_status' => 'publish',	
	);
	

	$html = '
		<div class="row-fluid">
	';
	$the_query = new WP_Query( $args );
	if($the_query->have_posts()){
		while($the_query->have_posts()){ $the_query->the_post();
			$meta_data = get_post_custom();
			$cont = get_the_content();
			$cont = apply_filters('the_content', $cont);
			$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'thumbname' );
			$arr_social = array(
				'facebook' => isset($meta_data['facebook'][0]) ? $meta_data['facebook'][0] : '',
				'flickr' => isset($meta_data['flickr'][0]) ? $meta_data['flickr'][0] : '',
				'google-plus' => isset($meta_data['google+'][0]) ? $meta_data['google+'][0] : '',
				'instagram' => isset($meta_data['instagram'][0]) ? $meta_data['instagram'][0] : '',
				'linkedin' => isset($meta_data['linkedIn'][0]) ? $meta_data['linkedIn'][0] : '',
				'pinterest' => isset($meta_data['pinterest'][0]) ? $meta_data['pinterest'][0] : '',
				'rss' => isset($meta_data['rss'][0]) ? $meta_data['rss'][0] : '',
				'twitter' => isset($meta_data['twitter'][0]) ? $meta_data['twitter'][0] : '',
				'youtube' => isset($meta_data['youtube'][0]) ? $meta_data['youtube'][0] : '',
			);
			$html .= '
				<div class="span12 '.$animation_class.'">
					<div class="member" style="background:'.$bg_color.'">
						<img src="'.$image_src[0].'" style="");/>
						<div class="member-info">
								<span class="member-name">'.get_the_title().'</span>
								<p>'.$meta_data['position'][0].'</p>
								<div class="dotted"></div>
								'.$cont.'
								<div class="dotted"></div>
								<div class="member-social">
									'.show_social_icon_mb($arr_social).'
								</div>
						</div>
					</div>
				</div>
			';
		}
	}
	$html .= '
		</div>
	';
	
	
	wp_reset_postdata();
	return $html;

}

add_shortcode( 'member', 'parse_member_func' );
if(!function_exists('show_social_icon_mb')){
	function show_social_icon_mb($arr_social = array()){
		$html = '';
		if(count($arr_social) > 0){
			foreach($arr_social as $key => $value){
				if(isset($value) && $value != '')
					$html .= '<a href="'.$value.'" class="icon-social icon-'.str_replace('_', '-', $key).'"><!-- --></a>';
			}
		}
		return $html;
	}
}