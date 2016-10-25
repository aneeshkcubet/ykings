<?php
function parse_carousel($atts, $content, $id){
        wp_enqueue_style( 'ui-custom-theme' );
        wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script( 'jquery-isotope');
		$id = rand();
		global $font_awesome;
		if(class_exists('Mobile_Detect')){
			$detect = new Mobile_Detect;
			$_device_ = $detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'pc';
			if(isset($atts['animation'])){
			$animation_class = ($atts['animation']&&$_device_=='pc')?'wpb_'.$atts['animation'].' wpb_animate_when_almost_visible':'';
			}
		}else{
			if(isset($atts['animation'])){
			$animation_class = $atts['animation']?'wpb_'.$atts['animation'].' wpb_animate_when_almost_visible':'';
			}
		}

        $output = '<div class="responsive carousel-mg">';
		$output .= '<ul id="wp-carousel-'.$id.'" class="wp-cal '.$animation_class.'">';
        
		$output .=  do_shortcode(str_replace('<br class="nc" />', '', $content));
		$output .= '
			</ul>
			<div class="clear"></div>
			<div class="slides-control carousel-ctrol">
				<div class="dotted"><!---->
				<div class="control-a">
					<a href="javascript:void(0)" id="carousel-prev-'.$id.'" class="icon-sign-blank '.($font_awesome==4?'fa fa-square':'').'">
						<span class="icon-caret-left '.($font_awesome==4?'fa fa-caret-left':'').'"><!----></span>
					</a>
					<a href="javascript:void(0)" id="carousel-next-'.$id.'" class="icon-sign-blank '.($font_awesome==4?'fa fa-square':'').'">
						<span class="icon-caret-right '.($font_awesome==4?'fa fa-caret-right':'').'"><!----></span>
					</a>
				</div>	
				</div>
			</div>
		</div>
		<div class="clear"></div>
		';
		global $carousel_js;
		$carousel_js[] = '
			<script>
				jQuery(document).ready(function() {
					jQuery("#wp-carousel-'.$id.'").imagesLoaded(function(){
						jQuery("#wp-carousel-'.$id.'").carouFredSel({
							height: "auto",
							prev: "#carousel-prev-'.$id.'",
							next: "#carousel-next-'.$id.'",
							auto: false,
							width: "100%",
							align: "left",
						});
					});
				});

			</script>
			
		';
		$output = str_replace('<br class="nc" style="margin-right: 0px;">','',$output);
        return $output;
}

function parse_carousel_item($atts, $content, $id){
		$width = isset($atts['width']) ? $atts['width'] : '';
		$id = 'carousel-item-'.rand();
		$output = '<li id="'.$id.'" style="width:'.$width.'px !important" >'.preg_replace('#^<\/p>|<p>$#', '', $content).'<div class="line-car"></div></li>';
		$output .= '';
        return $output;
}
add_shortcode( 'carousel_item', 'parse_carousel_item' );
add_shortcode( 'carousel', 'parse_carousel' );
function carousel_js(){
	global $carousel_js;
	if($carousel_js) foreach($carousel_js as $acarousel_js){echo $acarousel_js;}
}
add_action('wp_footer', 'carousel_js', 100);
//Visual Composer
add_action( 'after_setup_theme', 'reg_carousel' );
function reg_carousel(){
	if(function_exists('wpb_map')){

		vc_map( array(
			"name"		=> __("Carousel", "cactusthemes"),
			"base"		=> "carousel",
			"as_parent" => array('only' => 'carousel_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
			"content_element" => true,
			"show_settings_on_create" => false,
			"icon" => "icon-carousel",
			"params"	=> array(
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
			),
			'js_view' => 'VcColumnView'
		) );
		
		vc_map( array(
			"name"		=> __("Carousel item", "cactusthemes"),
			"base"		=> "carousel_item",
			"content_element" => true,
			"as_child" => array('only' => 'carousel_item'), // Use only|except attributes to limit parent (separate multiple values with comma)
			"icon" => "icon-carousel",
			"params"	=> array(
				array(
					"type" => "textfield",
					"heading" => __("Width per item", "cactusthemes"),
					"param_name" => "width",
					"value" => "",
					"description" => __('Width per item in slide. Ex: 250', "cactusthemes")
				),
				array(
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => __("Content", "cactusthemes"),
					"param_name" => "content",
					"value" => '',
					"description" => '',
				),
			),
		) );
	}
	if(class_exists('WPBakeryShortCode') && class_exists('WPBakeryShortCodesContainer')){
	class WPBakeryShortCode_carousel extends WPBakeryShortCodesContainer{}
	class WPBakeryShortCode_carousel_item extends WPBakeryShortCode{}
	}
}
