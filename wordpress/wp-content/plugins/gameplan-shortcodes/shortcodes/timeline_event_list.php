<?php
/* Register shortcode with Visual Composer */
add_action( 'after_setup_theme', 'reg_timeline_event' );
function reg_timeline_event(){
	if(function_exists('wpb_map')){

	wpb_map( array(
		"name" => __("Timeline Events"),
		"base" => "timeline_event",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"category" => __('Content'),
		"params" => array(	  
			array(		
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("List of IDs(optional):", 'cactusthemes'),
				"param_name" => "ids",
				"value" => '',
				"description" => __("Ex: 1, 2 ,3 ", 'cactusthemes'),
			),
			array(		
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Number of posts:", 'cactusthemes'),
				"param_name" => "number",
				"value" => '',
				"description" => __("Default all", 'cactusthemes'),
			),
			array(
				"type" => "exploded_textarea",
				"heading" => __("Categories", "js_composer"),
				"param_name" => "categories",
				"description" => __("List of cat ID (or slug), separated by a comma", "cactustheme"),
			),	
			array(		
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Show Events this month only:", 'cactusthemes'),
				"param_name" => "emonth",
				"value" => array(__(''),__('01'), __('02'),__('03'),__('04'),__('05'),__('06'),__('07'),__('08'),__('09'),__('10'),__('11'),__('12')),
				"description" => '',
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"heading" => __("Select Year", "cactusthemes"),
				"param_name" => "year",
				"value" => array(__(''),__('2005'), __('2006'),__('2007'),__('2008'),__('2009'),__('2010'),__('2011'),__('2012'),__('2013'),__('2014'),__('2015'),__('2016'),__('2017'),__('2018'),__('2019'),__('2020'),__('2021'),__('2022'), __('2023'),__('2024'),__('2025')),
				"description" => __("", "js_composer"),
			),
			array(
			  "type" => 'checkbox',
			  "heading" => __("Show upcoming Event", 'cactusthemes'),
			  "param_name" => "upcoming",
			  "value" => Array(__("Yes", 'cactusthemes') => 'yes'),
			  "description" => __("If not checked, All events will be displayed. If checked, upcoming events will be displayed", 'cactusthemes'),
			),
			array(
			  "type" => 'checkbox',
			  "heading" => __("Show past Event", 'cactusthemes'),
			  "param_name" => "eventold",
			  "value" => Array(__("Yes", 'cactusthemes') => 'yes'),
			  "description" => __("If not checked, All events will be displayed. If checked, past events will be displayed", 'cactusthemes'),
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
	)
	);
	}
}