<?php
function divider_func($atts, $content){
	$colorstyle= isset($atts['colorstyle']) ? $atts['colorstyle'] : 'colorstyle_1';
	$dividerstyle= isset($atts['dividerstyle']) ? $atts['dividerstyle'] : 'style_1';
	$paddingtop= isset($atts['paddingtop']) ? 'padding-top:'.$atts['paddingtop'].'px;' : '';
	$paddingbottom= isset($atts['paddingbottom']) ? 'padding-bottom:'.$atts['paddingbottom'].'px;' : '';
	$id=rand();
	$animation_class = '';
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
	$html='';
	$style = '';
	if($colorstyle=='colorstyle_1'){
		if($paddingtop != ''|| $paddingbottom!= ''){
			$style = '<style type="text/css" scoped="scoped">
				#divider'.$id.'{'.$paddingtop.' '.$paddingbottom.'}
			</style>';
		}

		switch($dividerstyle){
			case 'style_1':
				$html .= ''.$style.'
							<div class="row-fluid">
							<div class="divider '.$animation_class.'" id="divider'.$id.'">
								<div class="dotteddark"><!-- --></div>
							</div>
							</div>
				';
				break;
			case 'style_2':
				$html .= ''.$style.'
							<div class="row-fluid">
							<div class="divider '.$animation_class.'" id="divider'.$id.'">
								<div class="dotteddark" style="margin-bottom:10px"><!-- --></div>
								<div class="dotteddark"><!-- --></div>
							</div>
							</div>
				';
				break;
			case 'style_3':
				$html .= ''.$style.'
							<div class="row-fluid">
							<div class="divider '.$animation_class.'" id="divider'.$id.'">
								<div class="dotted1"><!-- --></div>
							</div>
							</div>
				';
				break;
			case 'style_4':
				$html .= ''.$style.'
							<div class="row-fluid">
							<div class="divider '.$animation_class.'" id="divider'.$id.'">
								<div class="dotted1a"><!-- --></div>
							</div>
							</div>	
				';
				break;
			case 'style_5':
				$html .= ''.$style.'
							<div class="row-fluid">
							<div class="divider '.$animation_class.'" id="divider'.$id.'">
								<div class="dotted2"><!-- --></div>
							</div>
							</div>
				';
				break;
			case 'style_6':
				$html .= ''.$style.'
							<div class="row-fluid">
							<div class="divider '.$animation_class.'" id="divider'.$id.'">
								<div class="forlight"><!-- --></div>
							</div>
							</div>
				';
				break;

		}
	} elseif($colorstyle=='colorstyle_2'){
		
		if($paddingtop != ''|| $paddingbottom!= ''){
			$style = '<style type="text/css" scoped="scoped">
				#divider'.$id.'{'.$paddingtop.' '.$paddingbottom.'}
			</style>';
		}
			
		switch($dividerstyle){
			case 'style_1':
				$html .= ''.$style.'	
							<div class="row-fluid">
							<div class="divider '.$animation_class.'" id="divider'.$id.'">
								<div class="dottedlight" ><!-- --></div>
							</div>
							</div>
				';
				break;
			case 'style_2':
				$html .= ''.$style.'
							<div class="row-fluid">
							<div class="divider '.$animation_class.'" id="divider'.$id.'">
								<div class="dottedlight" style=" margin-bottom:10px"></div>
								<div class="dottedlight" ><!-- --></div>
							</div>
							</div>	
				';
				break;
			case 'style_3':
				$html .= ''.$style.'	
							<div class="row-fluid">
							<div class="divider '.$animation_class.'" id="divider'.$id.'">
								<div class="dotted4"><!-- --></div>
							</div>
							</div>
				';
				break;
			case 'style_4':
				$html .= ''.$style.'	
							<div class="row-fluid">
							<div class="divider '.$animation_class.'" id="divider'.$id.'">
								<div class="dotted4a"><!-- --></div>
							</div>
				';
				break;
			case 'style_5':
				$html .= ''.$style.'	
							<div class="row-fluid">
							<div class="divider '.$animation_class.'" id="divider'.$id.'">
								<div class="dotted3"><!-- --></div>
							</div>
							</div>
				';
				break;
			case 'style_6':
				$html .= ''.$style.'	
							<div class="row-fluid">
							<div class="divider '.$animation_class.'" id="divider'.$id.'">
								<div class="fordark"><!-- --></div>
							</div>
							</div>
				';
				break;
		}
		
	}
	return '<div>'.$html.'</div>';
}
add_shortcode( 'divider', 'divider_func' );

/* Register shortcode with Visual Composer */
add_action( 'after_setup_theme', 'reg_divider' );
function reg_divider(){
	if(function_exists('wpb_map')){
	wpb_map( array(
	   "name" => __("Divider"),
	   "base" => "divider",
	   "class" => "",
	   "controls" => "full",
	   "category" => __('Content'),
	   "params" => array(
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Color style"),
			 "param_name" => "colorstyle",
			 "value" => array(__('Light') => 'colorstyle_1', __('Dark') => 'colorstyle_2'),
			 "description" => ''
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Divider style"),
			 "param_name" => "dividerstyle",
			 "value" => array(__('Dotted') => 'style_1', __('Double dotted') => 'style_2', __('Solid grey') => 'style_3', __('1px Soild Grey') => 'style_4',__('Solid color') => 'style_5',__('Drop shadow') => 'style_6'),
			 "description" => ''
		  ),
	
		  array(
			"type" => "textfield",
			"heading" => __("Padding Top", "js_composer"),
			"param_name" => "paddingtop",
			"value" => "",
			"description" => __("Padding top (in pixels). Ex. 10. Default:0"),
		  ),
		  array(
			"type" => "textfield",
			"heading" => __("Padding Bottom", "js_composer"),
			"param_name" => "paddingbottom",
			"value" => "",
			"description" => __("Padding bottom (in pixels). Ex.10. Default:0"),
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
	));
	}
}