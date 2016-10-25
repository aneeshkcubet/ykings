<?php

// Register custom post type "Page Section"
add_action('init', 'one_portfolio'); 
function one_portfolio()  { 
  $portfolio_slug = function_exists('ot_get_option')?ot_get_option('portfolio_slug','post-portfolio'):'post-portfolio';
  $labels = array(  
    'name' => __('Portfolio', 'Gameplan'),  
    'singular_name' => __('Portfolio', 'Gameplan'),  
    'add_new' => __('Add New Portfolio', 'Gameplan'),  
    'add_new_item' => __('Add New Portfolio', 'Gameplan'),  
    'edit_item' => __('Edit Portfolio', 'Gameplan'),  
    'new_item' => __('New Portfolio', 'Gameplan'),  
    'view_item' => __('View Portfolio', 'Gameplan'),  
    'search_items' => __('Search Portfolio', 'Gameplan'),  
    'not_found' =>  __('No Portfolio found', 'Gameplan'),  
    'not_found_in_trash' => __('No Portfolio found in Trash', 'Gameplan'),  
    'parent_item_colon' => '' 
  );  
  
  $args = array(  
    'labels' => $labels,  
    'menu_position' => 5, 
    'supports' => array('title','editor','thumbnail'),
	'taxonomies' => array('post_tag'),
	'public' => true,
	'publicly_queryable' => true,
	'has_archive' => true,
	'hierarchical' => false,
	'rewrite' => array('slug' => _x( $portfolio_slug, 'URL slug', 'cactusthemes' )),
  );  
  register_post_type('post-portfolio',$args);  
}

if(is_admin()){
	add_filter('manage_edit-post-portfolio_columns' , 'ct_add_portfolios_columns');
	function ct_add_portfolios_columns($columns) {
		$cols = array_merge(array('id' => __('ID')),$columns);
		$cols = array_merge($cols,array('thumbnail'=>__('Thumbnail')));
		
		return $cols;
	}
	
	add_action( 'manage_post-portfolios_custom_column' , 'ct_set_portfolios_columns_value', 10, 2 );
	function ct_set_portfolios_columns_value( $column, $post_id ) {
		if ($column == 'id'){
			echo $post_id;
		} else if($column == 'thumbnail'){
			echo get_the_post_thumbnail($post_id,'thumbnail');
		}
	}
}

/**
 * Initialize the meta boxes. 
 */
add_action( 'admin_init', 'ct_portfolio_meta_boxes' );

if ( ! function_exists( 'ct_portfolio_meta_boxes' ) ){
	function ct_portfolio_meta_boxes() {
	  $meta_box = array(
		'id'        => 'meta_box',
		'title'     => 'Page Settings',
		'desc'      => '',
		'pages'     => array( 'post-portfolio' ),
		'context'   => 'normal',
		'priority'  => 'high',
		'fields'    => array(
		   array(
			'id'          => 'single_portfolio_layout',
			'label'       => 'Single Portfolio Layout',
			'desc'        => '',
			'std'         => '',
			'type'        => 'select',
			'choices'     => array( 
			  array(
				'value'       => '',
				'label'       => 'Default',
				'src'         => ''
			  ),
			  array(
				'value'       => 'classic',
				'label'       => 'Classic',
				'src'         => ''
			  ),
			  array(
				'value'       => 'wide',
				'label'       => 'Wide',
				'src'         => ''
			  )
			),
		  ),

		  array(
			'id'          => 'show_hide_social_porfolio',
			'label'       => __('Show/hide social sharing','cactusthemes'),
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
				'value'       => 'show',
				'label'       => __('Show','cactusthemes'),
				'src'         => ''
			  ),
			  array(
				'value'       => 'hide',
				'label'       => __('Hide','cactusthemes'),
				'src'         => ''
			  )
			)
		  ),
		  
		  array(
			'id'          => 'custom_link',
			'label'       => __('Portfolio Custom Link (Optional)','cactusthemes'),
			'desc'        => __('Destination URL when clicking on portfolio in listing shortcode','cactusthemes'),
			'std'         => '',
			'type'        => 'text',
			'class'       => '',
			'choices'     => array()
		  ),

			array(
			'id'          => 'page_subhead',
			'label'       => __('Page Sub-Heading','cactusthemes'),
			'desc'        => '',
			'std'         => '',
			'type'        => 'text',
			'class'       => '',
			'choices'     => array()
		  ),
		  array(
			'id'          => 'background',
			'label'       => __('Background','cactusthemes'),
			'desc'        => __('Background image for page header','cactusthemes'),
			'std'         => '',
			'type'        => 'background',
			'class'       => '',
			'choices'     => array()
		  ),
		  array(
			'id'          => 'header_height',
			'label'       => __('Header height','cactusthemes'),
			'desc'        => __('Height of page header (in px)','cactusthemes'),
			'std'         => '',
			'type'        => 'text',
			'class'       => '',
			'choices'     => array()
		  )
		)
	  );
	  if (function_exists('ot_register_meta_box')) {
		  ot_register_meta_box( $meta_box );
	  }
	}
}
?>
