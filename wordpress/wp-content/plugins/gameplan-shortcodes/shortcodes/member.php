<?php
/* Register shortcode with Visual Composer */
add_action( 'after_setup_theme', 'reg_member' );
function reg_member(){
	if(function_exists('wpb_map')){
	wpb_map( array(
	   "name" => __("Member"),
	   "base" => "member",
	   "class" => "",
	   "controls" => "full",
	   "category" => __('Content'),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("ID Member"),
			 "param_name" => "id",
			 "value" => '',
			 "description" => '',
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Background color"),
			 "param_name" => "bg_color",
			 "value" => '',
			 "description" => '',
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