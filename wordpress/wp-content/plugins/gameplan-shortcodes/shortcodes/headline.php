<?php
function headline_func($atts, $content){
	wp_enqueue_script( 'js-scrollbox');
	$number = isset($atts['number']) ? $atts['number'] : -1;
	$cat = isset($atts['cat']) ? $atts['cat'] : '';
	$sort_by = isset($atts['sortby']) ? $atts['sortby'] : 'rand';
	$icon = isset($atts['icon']) ? $atts['icon'] : '';
	$link = isset($atts['link']) ? $atts['link'] : 'yes';
	$color = isset($atts['color']) ? $atts['color'] : '';
	$coloricon = isset($atts['coloricon']) ? $atts['coloricon'] : '';	
	$bg_color = isset($atts['background']) ? $atts['background'] : '';
	$posttypes = isset($atts['posttypes']) ? $atts['posttypes'] : 'post';
	if(class_exists('Mobile_Detect')){
		$detect = new Mobile_Detect;
		$_device_ = $detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'pc';
		$animation_class = ($atts['animation']&&$_device_=='pc')?'wpb_'.$atts['animation'].' wpb_animate_when_almost_visible':'';
	}else{
		$animation_class = $atts['animation']?'wpb_'.$atts['animation'].' wpb_animate_when_almost_visible':'';
	}
	$args = array(
		'post_type' => split(',',$posttypes),
		'posts_per_page' => $number,
		'orderby' => $sort_by,
		'post_status' => 'publish',
		
	);
	$id = rand();
	if(count($cats) > 0){
		$args = array('category__in' => $cats, 'showposts' => $number);
	}	
	if($bg_color != ''){
					$html .= '<style type="text/css" scoped="scoped">
						#head'.$id.' .htitle{background:'.$bg_color.';color:'.$color.';}
						#head'.$id.' .scroll-text  a{color:'.$color.';}
						#head'.$id.' .scroll-text  p{color:'.$color.';}
						#head'.$id.' .htitle .hicon i{color: '.$coloricon.'; }
						#head'.$id.' .htitle:before{color: '.$bg_color.'; }
					</style>';
	}

	$the_query = new WP_Query( $args );
	$html .= '
				<div class="headline '.$animation_class.'" id="head'.$id.'" >
				<div class="row-fluid">
					<div class="htitle">
					<span class="hicon"><i class="fa '.$icon.'"></i></span>
					<div id="demo1'.$id.'"  class="scroll-text" >
						<ul>
						
	';
	
				if($the_query->have_posts()){
					while($the_query->have_posts()){ $the_query->the_post();
					if($link=="yes"){
					$html .= '
									<li><a href='.get_permalink().'>'.get_the_title().'</a></li>
					';
					}else
					{
						$html .= '
						<li><p>'.get_the_title().'</p></li>
						';
					}
					}
				}
				wp_reset_query();
				$html .= '
						
						</ul>
						</div>
					</div>
				</div>
			</div>
	';
	global $headline_js;
	$headline_js[]='
		<script>
			jQuery(document).ready(function(e) {
				jQuery(function () {
				  jQuery("#demo1'.$id.'").scrollbox({
					speed: 50
				  });
				});
			});
		</script>
	';
	return $html;

}
add_shortcode( 'headline', 'headline_func' );

function headline_js(){
	global $headline_js;
	if($headline_js) foreach($headline_js as $aheadline_js){echo $aheadline_js;}
}
add_action('wp_footer', 'headline_js', 100);

/* Register shortcode with Visual Composer */
add_action( 'after_setup_theme', 'reg_headline' );
function reg_headline(){
	if(function_exists('wpb_map')){
		wpb_map( array(
		   "name" => __("Headline", 'castusthemes'),
		   "base" => "headline",
		   "class" => "",
		   "controls" => "full",
		   "category" => __('Content'),
		   "params" => array(
			  array(
				 "type" => "textfield",
				 "holder" => "div",
				 "class" => "",
				 "heading" => __("Number of post to show", 'castusthemes'),
				 "param_name" => "number",
				 "value" => '',
				 "description" => ''
			  ),
		
			  array(
				 "type" => "textfield",
				 "holder" => "div",
				 "class" => "",
				 "heading" => __("Categories ID", 'castusthemes'),
				 "param_name" => "cat",
				 "value" => '',
				 "description" => '',
			  ),
				array(
					"type" => "posttypes",
					"heading" => __("Post types", "js_composer"),
					"param_name" => "posttypes",
					"description" => __("Select post types to populate posts from.", "js_composer")
				),
		
			  array(
				 "type" => "dropdown",
				 "holder" => "div",
				 "class" => "",
				 "heading" => __("Link", 'castusthemes'),
				 "param_name" => "link",
				 "value" => array(__('Yes') => 'yes', __('No') => 'no'),
				 "description" => __("Link for title", 'castusthemes'),
			  ),
		
			  array(
				 "type" => "dropdown",
				 "holder" => "div",
				 "class" => "",
				 "heading" => __("Sort by", 'castusthemes'),
				 "param_name" => "sortby",
				 "value" => array(__('Random') => 'rand', __('Title') => 'title', __('Date') => 'date'),
				 "description" => ''
			  ),
			  array(
				 "type" => "textfield",
				 "holder" => "div",
				 "class" => "",
				 "heading" => __("Icon", 'castusthemes'),
				 "param_name" => "icon",
				 "value" => '',
				 "description" => __("Name Font-Awesome. Ex: icon-sort-by-alphabet", 'castusthemes'),
			  ),
			  array(
				 "type" => "colorpicker",
				 "holder" => "div",
				 "class" => "",
				 "heading" => __("Color for icon", 'castusthemes'),
				 "param_name" => "coloricon",
				 "value" => "",
				 "description" => __("Color for Icon: #fff", 'castusthemes'),
			  ),
			  
			  array(
				 "type" => "colorpicker",
				 "holder" => "div",
				 "class" => "",
				 "heading" => __("Color", 'castusthemes'),
				 "param_name" => "color",
				 "value" => "",
				 "description" => __("Color for text ex: #fff", 'castusthemes'),
			  ),
			  array(
				 "type" => "colorpicker",
				 "holder" => "div",
				 "class" => "",
				 "heading" => __("Background", 'castusthemes'),
				 "param_name" => "background",
				 "value" => "",
				 "description" => __("Color Background ex: #fff", 'castusthemes'),
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
		) );
	}
}