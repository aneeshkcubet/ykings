<?php
/* Register shortcode with Visual Composer */
add_action( 'after_setup_theme', 'reg_portfolio_list' );
function reg_portfolio_list(){
if(function_exists('wpb_map')){
wpb_map( array(
	"name" => __("Portfolio"),
	"base" => "portfolio",
	"class" => "",
	"controls" => "full",
	"show_settings_on_create" => true,
	"category" => __('Content'),
	"params" => array(	  
		array(		
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Portfolio IDs", 'cactusthemes'),
			"param_name" => "ids",
			"value" => '',
			"description" => __('If you want to display specific portfolios, enter list of IDs here, separated by a comma (,).', 'cactusthemes')
		),
		array(		
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Number of items", 'cactusthemes'),
			"param_name" => "items",
			"value" => '0',
			"description" => __('If <=0, all projects will be shown', 'cactusthemes')
		),
		array(		
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Tags", 'cactusthemes'),
			"param_name" => "tag",
			"value" => '',
			"description" => __('', 'cactusthemes')
		),

		array(		
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Order By", 'cactusthemes'),
			"param_name" => "order",
			"value" => array(__("Name", 'cactusthemes') => 'name', __("Date", 'cactusthemes') => 'created'),
			"description" => ''
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Styles", 'cactusthemes'),
			"param_name" => "style",
			"value" => array( __('Classic Grid', 'cactusthemes') => 'classic_grid',__('Modern Grid', 'cactusthemes') => 'modern_grid', __('Carousel', 'cactusthemes') => 'carousel'),
			"description" => __('', 'cactusthemes')
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Portfolio column", 'cactusthemes'),
			"param_name" => "columns",
			"value" => array(6,5,4,3),
			"description" => __('Number of columns. Works with Classic and Modern Grid layout. Note that 6-column layout does not work with Classic Grid', 'cactusthemes')
		),
		array(		
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Filter Bar", 'cactusthemes'),
			"param_name" => "show_filter",
			"value" => array(__("Yes", 'cactusthemes') => '1', __("No", 'cactusthemes') => '0'),
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
)
);
}
}