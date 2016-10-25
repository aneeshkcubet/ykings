<?php


function parse_skill_func($atts, $content){
	wp_enqueue_script( 'gauge');
	wp_enqueue_script( 'countto');
	global $_device_, $default_color;
	global $skill_js;
	$theme_style = function_exists('ot_get_option')?ot_get_option('theme_style'):'';
	$color_default = ($theme_style == 'dark') ? '#232323' : '#E9E9E9';

	$val = (isset($atts['values']) && $atts['values'] <= 100) ? $atts['values'] : 50;
	$color = isset($atts['color']) ? $atts['color'] : $default_color;
	$bg_color = isset($atts['bg_color']) ? $atts['bg_color'] : $color_default;
	$text_color = isset($atts['text_color']) ? $atts['text_color'] : '';	
	$speed = isset($atts['speed']) ? $atts['speed'] : 1000;
	$type = isset($atts['type']) ? $atts['type'] : 'counter_circle';
	$start_animation = isset($atts['start_animation']) ? $atts['start_animation'] : 'appearance';
	if(class_exists('Mobile_Detect')){
		$detect = new Mobile_Detect;
		$_device_ = $detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'pc';
		$animation_class = (isset($atts['animation']) && $atts['animation'] &&$_device_=='pc')?'wpb_'.$atts['animation'].' wpb_animate_when_almost_visible':'';
	}else{
		$animation_class = (isset($atts['animation']) && $atts['animation'])?'wpb_'.$atts['animation'].' wpb_animate_when_almost_visible':'';
	}
	$val = str_replace('%', '', $val);
	$html = '';
	$id = 'counter_'.rand();
	if($type == 'counter_circle'){
		$val = $val*100/125;
		$speed = $speed / 20;
		$html .= '
			<div class="counter-circle-wrapper '.$animation_class.'">
				<canvas width="200" height="200" class="counter-circle" id="'.$id.'" ></canvas>
				<div class="counter-circle-content" style="background-color:'.$bg_color.'; color:'.$text_color.'">'.do_shortcode(strip_tags($content, '<br><strong><em><a>')).'</div>
			</div>
		';
		if(trim($start_animation) == 'scroll'){
			$skill_js[] = '
				<script>
					(function($){						
						$(function(){
							var j = $;
							var circle'.$id.' = true;						
							j(window).scroll(function(){
								if(circle'.$id.' == true){
									var currentScrollTop = j(document).scrollTop();					
									if(j("#'.$id.'").offset().top - 500 <= currentScrollTop){
										var opts={lines: 120,angle:1,lineWidth:0.05,colorStart:"'.$color.'",colorStop:"'.$color.'",strokeColor:"'.$bg_color.'",generateGradient:true};
										var gauge_1=new Donut(document.getElementById("'.$id.'")).setOptions(opts);gauge_1.maxValue=125;gauge_1.animationSpeed='.$speed.';gauge_1.set('.$val.');	
										circle'.$id.' = false;											
									}
								}
							});
						});
					})(jQuery);
				</script>
			';
		}else{
			$skill_js[] = '
				<script>
					(function($){						
						$(function(){
							var j = $;						
							var currentScrollTop = j(document).scrollTop();				
								var opts={lines: 120,angle:1,lineWidth:0.05,colorStart:"'.$color.'",colorStop:"'.$color.'",strokeColor:"'.$bg_color.'",generateGradient:true};
								var gauge_1=new Donut(document.getElementById("'.$id.'")).setOptions(opts);gauge_1.maxValue=125;gauge_1.animationSpeed='.$speed.';gauge_1.set('.$val.');	
						});
					})(jQuery);
				</script>
			';
		}
		
	}elseif($type == 'progress_bar'){		
		$html .= '
			<div id="'.$id.'" class="progress-bar '.$animation_class.'" style="background-color:'.$bg_color.';">
            	<div class="progress-bar-content" data-percentage="'.$val.'" style="width: 0%; background-color:'.$color.'"></div>
            	<span class="progress-title" style="background-color:'.$bg_color.'; color:'.$text_color.'">'.do_shortcode(strip_tags($content, '<br><strong><em><a>')).'</span>
			</div>		
		';
		if(trim($start_animation) == 'scroll'){
			$skill_js[] = "
				<script>
					(function($){
						$(function(){
							var j = $;
							var progress".$id." = true;						
							j(window).scroll(function(){
								if(progress".$id." == true){
									var currentScrollTop = j(document).scrollTop();					
									if(j('#".$id."').offset().top - 500 <= currentScrollTop){
										var percentage = j('#".$id."').find('.progress-bar-content').data('percentage');
										j('#".$id."').find('.progress-bar-content').css('width', '0%');
										j('#".$id."').find('.progress-bar-content').animate({
											width: percentage+'%'
										}, ".$speed.");
										progress".$id." = false;		
									}
								}
							});
						});
					})(jQuery);
				</script>
			";
		}else{
			$skill_js[] = "
				<script>
					(function($){
						$(function(){
							var j = $;						
							var percentage = j('#".$id."').find('.progress-bar-content').data('percentage');
							j('#".$id."').find('.progress-bar-content').css('width', '0%');
							j('#".$id."').find('.progress-bar-content').animate({
								width: percentage+'%'
							}, ".$speed.");
						});
					})(jQuery);
				</script>
			";
		}
	}elseif($type == 'content_box'){
		$html .= '
			<div class="counter-box-wrapper '.$animation_class.'" style="background-color:'.$bg_color.';">
				<div class="content-box-percentage" style="color:'.$color.';"><span id="'.$id.'" class="display-percentage" data-percentage="'.$val.'">0</span><span class="percent">%</span></div>
				<div class="counter-box-content" style="color:'.$text_color.'">'.do_shortcode(strip_tags($content, '<br><strong><em><a>')).'</div>
			</div>
		';
		if(trim($start_animation) == 'scroll'){
			$skill_js[] = "
				<script>
					jQuery(function(){
						var j = jQuery;
						var progress".$id." = true;						
						j(window).scroll(function(){
							if(progress".$id." == true){
								var currentScrollTop = j(document).delay( 800 ).scrollTop();					
								if(j('#".$id."').offset().top - 500 <= currentScrollTop){
									var percentage = j('#".$id."').data('percentage');
									j('#".$id."').delay( 800 ).countTo({from: 0, to: percentage, speed: ".$speed."});
									progress".$id." = false;		
								}
							}
						});
					});
				</script>
			";
		}else{
			$skill_js[] = "
				<script>
					jQuery(function(){
						var j = jQuery;						
						var percentage = j('#".$id."').data('percentage');
						j('#".$id."').delay( 800 ).countTo({from: 0, to: percentage, speed: ".$speed."});
					});
				</script>
			";
		}		
	}
	
	return $html;
}


add_shortcode( 'skill', 'parse_skill_func' );
function skill_js(){
	global $skill_js;
	if($skill_js) foreach($skill_js as $askill_js){echo $askill_js;}
}
add_action('wp_footer', 'skill_js', 100);


/* Register shortcode with Visual Composer */
add_action( 'after_setup_theme', 'reg_skill' );
function reg_skill(){
	if(function_exists('wpb_map')){
	wpb_map( array(
	   "name" => __("Counters", 'emerald'),
	   "base" => "skill",
	   "class" => "",
	   "controls" => "full",
	   "category" => __('Content', 'emerald'),
	   "params" => array( 
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Skill type", 'emerald'),
			 "param_name" => "type",
			 "value" => array(
				__('Counter Circle', 'cactusthemes') => 'counter_circle', 
				__('Progress Bar', 'cactusthemes') => 'progress_bar', 
				__('Content Box', 'cactusthemes') => 'content_box'
			 ),
			 "description" => ''
		  ),	  
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Values (%)", 'emerald'),
			 "param_name" => "values",
			 "value" => '',
			 "description" => ''
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Speed", 'emerald'),
			 "param_name" => "speed",
			 "value" => '',
			 "description" => 'Ex: 1000'
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Start Animation ...", 'emerald'),
			 "param_name" => "start_animation",
			 "value" => array(__('At appearance', 'cactusthemes') => 'appearance', __('When User scroll to', 'cactusthemes') => 'scroll'),
			 "description" => ''
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Progress Color", 'emerald'),
			 "param_name" => "color",
			 "value" => '',
			 "description" => ''
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background Color", 'emerald'),
			 "param_name" => "bg_color",
			 "value" => '',
			 "description" => ''
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Text Color", 'emerald'),
			 "param_name" => "text_color",
			 "value" => '',
			 "description" => ''
		  ),
		  array(
			 "type" => "textarea_html",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Content", 'emerald'),
			 "param_name" => "content",
			 "value" => '',
			 "description" => ''
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















