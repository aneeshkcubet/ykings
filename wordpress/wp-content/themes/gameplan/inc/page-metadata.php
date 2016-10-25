<?php

/**
 * Initialize the meta boxes. 
 */
add_action( 'admin_init', 'ct_page_meta_boxes' );

if ( ! function_exists( 'ct_page_meta_boxes' ) ){
	function ct_page_meta_boxes() {
	  $meta_box = array(
		'id'        => 'meta_box',
		'title'     => 'Page Settings',
		'desc'      => '',
		'pages'     => array( 'page' ),
		'context'   => 'normal',
		'priority'  => 'high',
		'fields'    => array(
			array(
			'id'          => 'page_subhead',
			'label'       => esc_html__('Page Sub-Heading','cactusthemes'),
			'desc'        => '',
			'std'         => '',
			'type'        => 'text',
			'class'       => '',
			'choices'     => array()
		  ),
		  array(
			'id'          => 'background',
			'label'       => esc_html__('Background','cactusthemes'),
			'desc'        => esc_html__('Background image for page header','cactusthemes'),
			'std'         => '',
			'type'        => 'background',
			'class'       => '',
			'choices'     => array()
		  ),
		  array(
			'id'          => 'header_height',
			'label'       => esc_html__('Header height','cactusthemes'),
			'desc'        => esc_html__('Height of page header (in px)','cactusthemes'),
			'std'         => '',
			'type'        => 'text',
			'class'       => '',
			'choices'     => array()
		  ),
		  array(
			'id'          => 'showhide_social',
			'label'       => esc_html__('Show/hide social sharing','cactusthemes'),
			'desc'        => '',
			'std'         => '',
			'type'        => 'select',
			'class'       => '',
			'choices'     => array(
				array(
				'value'       => 'def',
				'label'       => esc_html__('Default','cactusthemes'),
				'src'         => ''
			  ),
			  array(
				'value'       => 'show',
				'label'       => esc_html__('Show','cactusthemes'),
				'src'         => ''
			  ),
			  array(
				'value'       => 'hide',
				'label'       => esc_html__('Hide','cactusthemes'),
				'src'         => ''
			  )			  
			)
		  ),
			array(
			'id'          => 'revslider',
			'label'       => esc_html__('Revolution Slider Alias Name (used with Front-Page template only)','cactusthemes'),
			'desc'        => esc_html__('Enter Alias Name of Revolution Slider to load if this page uses Front-Page template','cactusthemes'),
			'std'         => '',
			'type'        => 'text',
			'class'       => '',
			'choices'     => array()
		  ),
		  array(
			'id'          => 'slider_style',
			'label'       => esc_html__('Slider Style','cactusthemes'),
			'desc'        => '',
			'std'         => '',
			'type'        => 'select',
			'class'       => '',
			'choices'     => array(
				array(
				'value'       => 'def',
				'label'       => esc_html__('Default','cactusthemes'),
				'src'         => ''
			  ),
			  array(
				'value'       => 'wide',
				'label'       => esc_html__('Wide (Full width)','cactusthemes'),
				'src'         => ''
			  ),
			  array(
				'value'       => 'boxed',
				'label'       => esc_html__('Boxed','cactusthemes'),
				'src'         => ''
			  )			  
			)
		  ),
		  array(
			'id'          => 'sidebar_name',
			'label'       => esc_html__('Custom Sidebar','cactusthemes'),
			'desc'        => esc_html__('Enter ID of sidebar to use in this page. This sidebar will replace main sidebar. Custom Sidebar only works with Sidebar Left or Sidebar Right Page Template. Custom Sidebars can be created in Appearance > Sidebars','cactusthemes'),
			'std'         => '',
			'type'        => 'text',
			'class'       => '',
			'choices'     => array()
		  ),
		)
	  );
	  
	  ot_register_meta_box( $meta_box );

	}
}


