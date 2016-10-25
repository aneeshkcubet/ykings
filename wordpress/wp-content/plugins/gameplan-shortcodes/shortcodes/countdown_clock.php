<?php


function parse_countdown_func($atts, $content){
	wp_enqueue_style( 'flipclock' );
	wp_enqueue_script( 'prefixfree' );
	wp_enqueue_script( 'flipclock' );
	$year 		= isset($atts['year']) ? $atts['year'] : 0;
	$month 		= isset($atts['month']) ? $atts['month'] : 0;
	$day 		= isset($atts['day']) ? $atts['day'] : 0;
	$hour 		= isset($atts['hour']) ? $atts['hour'] : 0;
	$minute		= isset($atts['minute']) ? $atts['minute'] : 0;
	$bg_color	= isset($atts['bg_color']) ? $atts['bg_color'] : '';
	$text_color	= isset($atts['text_color']) ? $atts['text_color'] : '';
	$unit_color	= isset($atts['unit_color']) ? $atts['unit_color'] : '';
	if(class_exists('Mobile_Detect')){
		$detect = new Mobile_Detect;
		$_device_ = $detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'pc';
		$animation_class = (isset($atts['animation'])&&$_device_=='pc')?'wpb_'.$atts['animation'].' wpb_animate_when_almost_visible':'';
	}else{
		$animation_class = isset($atts['animation'])?'wpb_'.$atts['animation'].' wpb_animate_when_almost_visible':'';
	}
	
	$id = 'clock_'.rand();
	$html = '<div id="'.$id.'" class="your-clock '.$animation_class.'"></div>';
	$seconds = 0;
	$seconds = strtotime($year.'-'.$month.'-'.$day.' '.$hour.':'.$minute);
	$seconds = $seconds - strtotime(date('Y-m-d H:i'));
	global $countdown_js;
	$countdown_js[] = "
		<script>
			var days = '".__('DAY', 'cactusthemes')."';
			var hours = '".__('HR', 'cactusthemes')."';
			var minutes = '".__('MIN', 'cactusthemes')."';
			var seconds = '".__('Second', 'cactusthemes')."';
			jQuery(function(){
				var ".$id." = jQuery('#".$id."').FlipClock({
					//countdown: true,
					clockFace: 'DailyCounter',
					//autoStart: false,
				});
				".
				(($seconds > 0) ? $id.".setTime(".$seconds.");" : "")
				."
				".$id.".setCountdown(true);
				var days = ".$id.".time.getDays();
				if(days > 99 && days < 999){
					jQuery('#".$id." .days .flip-clock-label').css('right', '-86px');
				}
				if(days > 999 && days < 9999){
					jQuery('#".$id." .days .flip-clock-label').css('right', '-110px');
				}
				if(days > 9999){
					jQuery('#".$id." .days .flip-clock-label').css('right', '-132px');
				}
			});
		</script>
	";
	if($bg_color != ''){
		$bg_color_rgb = cactus_hex2rgb($bg_color);
		$html .= '
			<style type="text/css" scoped="scoped">
				#'.$id.' ul li a div div.inn{background-color:'.$bg_color.'}
				#'.$id.' ul{box-shadow: 0 2px 5px rgba('.$bg_color_rgb[0].', '.$bg_color_rgb[1].', '.$bg_color_rgb[2].', .7);}
				/*#'.$id.' ul li a div.up:after{background-color:rgba('.$bg_color_rgb[0].', '.$bg_color_rgb[1].', '.$bg_color_rgb[2].',1.4)}*/
				#'.$id.' .flip-clock-dot{background:'.$bg_color.';box-shadow: 0 0 5px rgba('.$bg_color_rgb[0].', '.$bg_color_rgb[1].', '.$bg_color_rgb[2].', .5);}
			</style>
		';
	}
	if($text_color != ''){
		$html .= '
			<style type="text/css" scoped="scoped">
				#'.$id.' ul li a div div.inn{color:'.$text_color.';text-shadow: 0 1px 2px '.$text_color.';}
			</style>
		';
	}
	if($unit_color != ''){
		$html .= '
			<style type="text/css" scoped="scoped">
				#'.$id.' .flip-clock-divider .flip-clock-label{color:'.$unit_color.';}
			</style>
		';
	}
	
	return $html;
}
function countdown_js(){
	global $countdown_js;
	if($countdown_js) foreach($countdown_js as $acountdown_js){echo $acountdown_js;}
}
add_action('wp_footer', 'countdown_js', 100);
add_shortcode( 'countdown', 'parse_countdown_func' );



/* Register shortcode with Visual Composer */
add_action( 'after_setup_theme', 'reg_countdown' );
function reg_countdown(){
	if(function_exists('wpb_map')){
	$current_year = date("Y");
	$years = array();
	for($i=0; $i<10; $i++){
		$years[$current_year+$i] = ($current_year+$i);
	}
	$months = array();
	for($i=1; $i<=12; $i++){
		$months[date("F", mktime(0, 0, 0, $i, 10))] = $i;
	}
	$days = array();
	for($i=1; $i<=31; $i++){
		$days[$i] = $i;
	}
	$hours = array();
	for($i=0; $i<=23; $i++){
		$hours[$i] = $i;
	}
	$minutes = array();
	for($i=0; $i<=59; $i++){
		$minutes[$i] = $i;
	}
		
	wpb_map( array(
	   "name" => __("Countdown", 'emerald'),
	   "base" => "countdown",
	   "class" => "",
	   "controls" => "full",
	   "category" => __('Content', 'emerald'),
	   "params" => array( 
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Year:", 'emerald'),
			 "param_name" => "year",
			 "value" => $years,
			 "description" => ''
		  ),	  
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Month", 'emerald'),
			 "param_name" => "month",
			 "value" => $months,
			 "description" => ''
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Day", 'emerald'),
			 "param_name" => "day",
			 "value" => $days,
			 "description" => ''
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Hour", 'emerald'),
			 "param_name" => "hour",
			 "value" => $hours,
			 "description" => ''
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Minute", 'emerald'),
			 "param_name" => "minute",
			 "value" => $minutes,
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
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Unit Color", 'emerald'),
			 "param_name" => "unit_color",
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














