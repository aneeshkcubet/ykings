<?php

// Register custom post type "Page Section"
add_action('init', 'member'); 
function member()  {
	$member_slug = function_exists('ot_get_option')?ot_get_option('member_slug','member'):'member';
  $labels = array(  
    'name' => __('Member', 'Gameplan'),  
    'singular_name' => __('Member', 'Gameplan'),  
    'add_new' => __('Add New Member', 'Gameplan'),  
    'add_new_item' => __('Add New Member', 'Gameplan'),  
    'edit_item' => __('Edit Member', 'Gameplan'),  
    'new_item' => __('New Member', 'Gameplan'),  
    'view_item' => __('View Member', 'Gameplan'),  
    'search_items' => __('Search Member', 'Gameplan'),  
    'not_found' =>  __('No Member found', 'Gameplan'),  
    'not_found_in_trash' => __('No Member found in Trash', 'Gameplan'),  
    'parent_item_colon' => '' 
  );  
  
  $args = array(  
    'labels' => $labels,  
    'menu_position' => 8, 
    'supports' => array('title','editor','thumbnail',),
	'public' => false,
	'show_ui' => true,
	/*'menu_icon' =>  get_stylesheet_directory_uri(). '/images/member.png',*/
	'publicly_queryable' => true,
	'has_archive' => true,
	'hierarchical' => false,
	'rewrite' => array('slug' => $member_slug),
  );  
  register_post_type('member',$args);  
} 

// Add meta data
add_action( 'admin_init', 'member_meta_boxes' );


function member_meta_boxes() {
	/**
	 * Supported TYPE:
	 * background
	 * ...
	 * ...
	 * ...
	 */
  $my_meta_box = array(
    'id'        => 'my_meta_box',
    'title'     => 'Info',
    'desc'      => '',
    'pages'     => array( 'member' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(
      array(
        'id'          => 'position',
        'label'       => 'Position',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
        'choices'     => array()
      ),
	  
    )
	
  );  

	if (function_exists('ot_register_meta_box')) {
	  ot_register_meta_box( $my_meta_box );
	}
}


add_filter('manage_posts_columns', 'mb_posts_columns_id', 1);
add_action('manage_posts_custom_column', 'posts_custom_id_columns', 1, 2);
function mb_posts_columns_id($defaults){
    $defaults['wps_post_id'] = __('ID');
    return $defaults;
}
function posts_custom_id_columns($column_name, $id){
        if($column_name === 'wps_post_id'){
                echo $id;
    }
}




add_action( 'admin_init', 'member_meta_boxes1' );






function member_meta_boxes1() {
	/**
	 * Supported TYPE:
	 * background
	 * ...
	 * ...
	 * ...
	 */
  $my_meta_box2 = array(
    'id'        => 'my_meta_box2',
    'title'     => 'Social',
    'desc'      => '',
    'pages'     => array( 'member' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(
      array(
        'id'          => 'dribble',
        'label'       => 'Dribble',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
        'choices'     => array()
      ),
      array(
        'id'          => 'facebook',
        'label'       => 'Facebook',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
        'choices'     => array()
      ),
      array(
        'id'          => 'flickr',
        'label'       => 'Flickr',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
        'choices'     => array()
      ),
      array(
        'id'          => 'google+',
        'label'       => 'Google+',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
        'choices'     => array()
      ),
      array(
        'id'          => 'instagram',
        'label'       => 'Instagram',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
        'choices'     => array()
      ),
      array(
        'id'          => 'linkedIn',
        'label'       => 'LinkedIn',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
        'choices'     => array()
      ),
      array(
        'id'          => 'pinterest',
        'label'       => 'Pinterest',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
        'choices'     => array()
      ),
      array(
        'id'          => 'rss',
        'label'       => 'RSS',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
        'choices'     => array()
      ),
      array(
        'id'          => 'twitter',
        'label'       => 'Twitter',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
        'choices'     => array()
      ),
      array(
        'id'          => 'vimeo',
        'label'       => 'Vimeo',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
        'choices'     => array()
      ),
      array(
        'id'          => 'youtube',
        'label'       => 'YouTube',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
        'choices'     => array()
      ),
    )
	
  );  

	if (function_exists('ot_register_meta_box')) {
  		ot_register_meta_box( $my_meta_box2 );
	}
}


