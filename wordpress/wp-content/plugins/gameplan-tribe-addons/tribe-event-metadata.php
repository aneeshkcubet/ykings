<?php

/**
 * Initialize the meta boxes. 
 */
add_action( 'admin_init', 'ct_tribe_event_meta_boxes' );

if ( ! function_exists( 'ct_tribe_event_meta_boxes' ) ){
	function ct_tribe_event_meta_boxes() {
	  $meta_box = array(
		'id'        => 'meta_box',
		'title'     => __('More Settings','cactusthemes'),
		'desc'      => '',
		'pages'     => array( 'tribe_events' ),
		'context'   => 'normal',
		'priority'  => 'high',
		'fields'    => array(
		  array(
			'id'          => 'website_subscribe',
			'label'       => __('Subscribe URL','cactusthemes'),
			'desc'        => __('Enter subscribe URL for event here. You can also use Paypal Link. To get Paypal Link, see http://en.support.wordpress.com/paypal/ ','cactusthemes'),
			'std'         => '',
			'type'        => 'text',
			'class'       => '',
			'choices'     => array()
		  ),
		  array(
			'id'          => 'text_subscribe',
			'label'       => __('Subscribe Text','cactusthemes'),
			'desc'        => __('','cactusthemes'),
			'std'         => '',
			'type'        => 'text',
			'class'       => '',
			'choices'     => array()
		  ),
		  array(
			'id'          => 'subscribe_button',
			'label'       => __('Subscribe Button','cactusthemes'),
			'desc'        => __('','cactusthemes'),
			'std'         => '',
			'type'        => 'select',
			'class'       => '',
			'choices'     => array(
			  array(
				'value'       => 'def',
				'label'       => __('Default','cactusthemes'),
				'src'         => ''
			  ),
			  array(
				'value'       => 'pp_buynow',
				'label'       => __('Paypal Buy Now','cactusthemes'),
				'src'         => ''
			  ),
			  array(
				'value'       => 'pp_subscribe',
				'label'       => __('Paypal Subscribe','cactusthemes'),
				'src'         => ''
			  ),
			  array(
				'value'       => 'pp_donate',
				'label'       => __('Paypal Donate','cactusthemes'),
				'src'         => ''
			  ),
			  array(
				'value'       => 'pp_addtocart',
				'label'       => __('Paypal Add To Cart','cactusthemes'),
				'src'         => ''
			  ),
			  array(
				'value'       => 'pp_buygift',
				'label'       => __('Paypal Buy Gift Certificate','cactusthemes'),
				'src'         => ''
			  )
			)
		  ),




		)
	  );
	  if(function_exists( 'ot_register_meta_box' )){
	  ot_register_meta_box( $meta_box );
	  }

	}
}


