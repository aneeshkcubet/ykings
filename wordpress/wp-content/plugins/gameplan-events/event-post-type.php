<?php
add_action( 'init', 'create_post_type_event' );
function create_post_type_event() {
	/*register_taxonomy(
		//'category',
		'event',
		array(
			'label' => __( 'Category event' ),
			'rewrite' => array( 'slug' => 'event-category'),
			'hierarchical' => true
		)
	);*/
	
	$event_slug = function_exists('ot_get_option')?ot_get_option('event_slug','event'):'event';
	
	register_post_type( 'event',
		array(
			'labels' => array(
				'name' => __( 'Event' ),
				'singular_name' => __( 'Event' ),
				'add_new' => _x('Add New', 'event'),
				'add_new_item' => __('Add New event'),
				'edit_item' => __('Edit event'),
				'new_item' => __('New event'),
				'view_item' => __('View event'),
				'search_items' => __('Search event')
			),
			'public' => true,
			'publicly_queryable' => true,
			'has_archive' => true,
			'hierarchical' => false,
			//'taxonomies' => array('category'),
			'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'comments', 'excerpt',),
			'rewrite' => array('slug' => _x( $event_slug, 'URL slug', 'cactusthemes' )),
		)
	);
}

/* ADMIN: Show event categories filter */
add_action('restrict_manage_posts','event_restrict_manage_posts');
function event_restrict_manage_posts() {
	global $typenow;

	if ($typenow=='event'){
		$args = array(
			'show_option_all' => "Show All Categories",
			'taxonomy'        => 'category',
			'name'            => 'category'		
		);
		wp_dropdown_categories($args);
	}
}
add_action( 'request', 'event_request' );
function event_request($request) {
	if (is_admin() && $GLOBALS['PHP_SELF'] == '/wp-admin/edit.php' && isset($request['post_type']) && $request['post_type']=='event') {
		$request['term'] = get_term($request['category'],'category')->name;
	}
	return $request;
}

if(is_admin()){
	add_filter('manage_edit-event_columns' , 'ct_add_events_columns');
	function ct_add_events_columns($columns) {
		$cols = array_merge(array('id' => __('ID')),$columns);
		$cols = array_merge($cols,array('start_day'=>__('Start date'),'thumbnail'=>__('Thumbnail')));
		
		return $cols;
	}
	
	/* why this does not work? column values are processed in functions.php --> ct_set_posts_columns_value()
	 *
	 *
		
	add_action( 'manage_events_custom_column' , 'ct_set_events_columns_value', 10, 2 );
	function ct_set_events_columns_value( $column, $post_id ) {
		if ($column == 'id'){
			echo $post_id;
		} else if($column == 'thumbnail'){
			echo get_the_post_thumbnail($post_id,'thumbnail');
		} else if($column == 'startdate'){
			echo get_post_meta($post_id,'start_day',true);
		}
	}
	*/
} 

/* ADMIN: Add event metadata */
// for later use
add_action( 'add_meta_boxes', 'add_event_metadatabox' );
function add_event_metadatabox(){
	add_meta_box('event-info','Event Information','build_event_metadatafields','event','normal','high',null);
}

/* Do something with the data entered */
add_action( 'save_post', 'save_event_metadatafields' );

function build_event_metadatafields($event){
  // Use nonce for verification
  wp_nonce_field( 'event_metadata', 'event_metadata' );

  $venue = get_post_meta($event->ID,'venue',true);
  $_lat_lng = get_post_meta($event->ID,'_lat_lng',true);  
  $start_day = get_post_meta($event->ID,'start_day',true);
  $end_day = get_post_meta($event->ID,'end_day',true);
  $google_shortcode = get_post_meta($event->ID,'google_shortcode',true);
  
  // The actual fields for data entry
  ob_start();
?>
  <link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
  <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_stylesheet_directory_uri()?>/css/jquery-ui-timepicker-addon.css" />
  <script language="javascript" src="http://code.jquery.com/ui/1.10.2/jquery-ui.min.js"></script>
  <script src="<?php echo get_stylesheet_directory_uri()?>/js/jquery-ui-timepicker-addon.js" language="javascript"></script>
  <script>
  jQuery(function(){
  	//jQuery('.datepicker').datetimepicker();
	
	var startDateTextBox = jQuery('.start_day');
	var endDateTextBox = jQuery('.end_day');	
	startDateTextBox.datetimepicker({
		dateFormat: "yy-mm-dd",
		timeFormat: "HH:mm:ss",
		onClose: function(dateText, inst) {
			if (endDateTextBox.val() != '') {
				var testStartDate = startDateTextBox.datetimepicker('getDate');
				var testEndDate = endDateTextBox.datetimepicker('getDate');
				if (testStartDate > testEndDate)
					endDateTextBox.datetimepicker('setDate', testStartDate);
			}
			else {
				endDateTextBox.val(dateText);
			}
		},
		onSelect: function (selectedDateTime){
			endDateTextBox.datetimepicker('option', 'minDate', startDateTextBox.datetimepicker('getDate') );
		}
	});
	endDateTextBox.datetimepicker({ 
		dateFormat: "yy-mm-dd",
		timeFormat: "HH:mm:ss",
		onClose: function(dateText, inst) {
			if (startDateTextBox.val() != '') {
				var testStartDate = startDateTextBox.datetimepicker('getDate');
				var testEndDate = endDateTextBox.datetimepicker('getDate');
				if (testStartDate > testEndDate)
					startDateTextBox.datetimepicker('setDate', testEndDate);
			}
			else {
				startDateTextBox.val(dateText);
			}
		},
		onSelect: function (selectedDateTime){
			startDateTextBox.datetimepicker('option', 'maxDate', endDateTextBox.datetimepicker('getDate') );
		}
	});
	
  });
  </script>
  <p><label for="venue" style="width:100px;display:inline-block"><?php echo _e("Address of event", 'cactusthemes');?></label>
	 <input type="text" style="width:300px;" name="venue" id="venue" value="<?php echo $venue;?>"/></p>
  <p><label for="google_shortcode" style="width:100px;display:inline-block"><?php echo _e("Google maps shortcode", 'cactusthemes');?></label>
	 <textarea cols="100" name="google_shortcode" id="google_shortcode"><?php echo $google_shortcode;?></textarea></p>
  <p><label for="start_day" style="width:100px;display:inline-block"><?php echo _e("Start day of event", 'cactusthemes');?></label>
	 <input type="text" readonly="readonly" class="datepicker start_day" name="start_day" id="start_day" value="<?php echo $start_day;?>"/><a onclick="jQuery('#start_day').val('');" href="javascript:void(0);">Remove</a></p>     
  <p><label for="end_day"style="width:100px;display:inline-block"><?php echo _e("End day of event", 'cactusthemes');?></label>
	 <input type="text" readonly="readonly" class="datepicker end_day"  name="end_day" id="end_day" value="<?php echo $end_day;?>"/><a onclick="jQuery('#end_day').val('');" href="javascript:void(0);">Remove</a></p>
<?php
	$html = ob_get_clean();
	echo $html;
}

function save_event_metadatafields($post_id){
	// verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times
  if(isset($_POST['event_metadata']))
  if ( !wp_verify_nonce( $_POST['event_metadata'], 'event_metadata' ) )
      return;
	// Check permissions
  if(isset($_POST['post_type'])){	
	  if ( 'page' == $_POST['post_type'] ) 
	  {
		if ( !current_user_can( 'edit_page', $post_id ) )
			return;
	  }
	  else
	  {
		if ( !current_user_can( 'edit_post', $post_id ) )
			return;
	  }
	  
	  if($_POST['post_type']  != 'event')
		  return;
  }
  
  $venue = isset($_POST['venue']) ? $_POST['venue'] : '';
  $start_day = isset($_POST['start_day']) ? $_POST['start_day'] : '';
  $end_day = isset($_POST['end_day']) ? $_POST['end_day'] : '';
  $google_shortcode = isset($_POST['google_shortcode']) ? $_POST['google_shortcode'] : '';
  
  //$_signin_url = $_POST['_signin_url'];
  
  

  add_post_meta($post_id,'venue',$venue, true);
  update_post_meta($post_id,'venue',$venue);
  
  add_post_meta($post_id,'start_day',$start_day, true);
  update_post_meta($post_id,'start_day',$start_day);
  
  add_post_meta($post_id,'end_day',$end_day, true);
  update_post_meta($post_id,'end_day',$end_day);
  
  add_post_meta($post_id,'google_shortcode',$google_shortcode, true);
  update_post_meta($post_id,'google_shortcode',$google_shortcode);
  
  //add_post_meta($post_id,'_lat_lng',$_lat_lng, true);
  //update_post_meta($post_id,'_lat_lng',$_lat_lng);
  
  //add_post_meta($post_id,'_signin_url',$_signin_url, true);
  //update_post_meta($post_id,'_signin_url',$_signin_url);
}



?>