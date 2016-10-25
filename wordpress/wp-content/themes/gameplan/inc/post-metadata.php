<?php

/**
 * Initialize the meta boxes. 
 */
add_action( 'admin_init', 'ct_post_meta_boxes' );

if ( ! function_exists( 'ct_post_meta_boxes' ) ){
	function ct_post_meta_boxes() {
	  $meta_box = array(
		'id'        => 'meta_box',
		'title'     => 'Post Settings',
		'desc'      => '',
		'pages'     => array( 'post' ),
		'context'   => 'normal',
		'priority'  => 'high',
		'fields'    => array(
		  array(
			'id'          => 'sticky_tag',
			'label'       => esc_html__('Sticky Tag','cactusthemes'),
			'desc'        => esc_html__('Enter the word which will be used for the Sticky Tag.','cactusthemes'),
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
			'id'          => 'show_hide_social',
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
        'id'          => 'single_post_layout',
        'label'       => 'Single Post Layout',
        'desc'        => esc_html__('Select layout for a single post page. This setting can be overridden in a specific post','cactusthemes'),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'singe_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
		  array(
			'value'       => 'def',
			'label'       => esc_html__('Default','cactusthemes'),
			'src'         => ''
		  ),
          array(
            'value'       => 'left',
            'label'       => esc_html__('Sidebar Left','cactusthemes'),
            'src'         => ''
          ),
          array(
            'value'       => 'right',
            'label'       => esc_html__('Sidebar Right','cactusthemes'),
            'src'         => ''
          ),
          array(
            'value'       => 'full',
            'label'       => esc_html__('Fullwidth','cactusthemes'),
            'src'         => ''
          )
        ),
      ),

		)
	  );
	  
	  ot_register_meta_box( $meta_box );

	}
}


