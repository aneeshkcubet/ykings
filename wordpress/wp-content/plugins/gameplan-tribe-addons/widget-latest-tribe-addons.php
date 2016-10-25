<?php
/*
Description: Adds a widget that can display recent posts from multiple categories or from custom post types.
*/

class Event_Tribe_Recent_Posts_Widget extends WP_Widget {	

	function __construct() {
    	$widget_ops = array(
			'classname'   => 'advanced_event_recent_posts_widget', 
			'description' => __('Shows event posts ')
		);
    	parent::__construct('advanced-event-recent-posts', __('GP-Latest Tribe Event'), $widget_ops);
	}


	function widget($args, $instance) {
		wp_enqueue_script( 'jquery-isotope');
		$cache = wp_cache_get('widget_event_recent_posts', 'widget');		
		if ( !is_array($cache) )
			$cache = array();

		if ( !isset( $argsxx['widget_id'] ) )
			$argsxx['widget_id'] = $this->id;
		if ( isset( $cache[ $argsxx['widget_id'] ] ) ) {
			echo $cache[ $argsxx['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);
		
		$ids 			= empty($instance['ids']) ? '' : $instance['ids'];
		$title 			= empty($instance['title']) ? '' : $instance['title'];
		$title          = apply_filters('widget_title', $title);
		$cats 			= empty($instance['cats']) ? '' : $instance['cats'];
		$sort_by 		= empty($instance['sort_by']) ? '' : $instance['sort_by'];		
		//$show_type 		= empty($instance['show_type']) ? 'post' : $instance['show_type'];
		$number 		= empty($instance['number']) ? '' : $instance['number'];
		$perpage 		= empty($instance['perpage']) ? 2 : $instance['perpage'];
		$date 			= empty($instance['date']) ? '' : $instance['date'];
		if ( $ids != '' ) {
			$ids = explode(",", $ids);
			$gc = array();
			$dem=0;
			foreach ( $ids as $grid_cat ) {
				$dem++;
				array_push($gc, $grid_cat);
			}
		
		$args = array(
			'post_type' => 'tribe_events',
			'posts_per_page' => $number,
			'orderby' => $sort_by,
			'post_status' => 'publish',
			'post__in' =>  $gc 
			
		);
		}else if( $ids == '' )
		{
			$args = array(
			'post_type' => 'tribe_events',
			'posts_per_page' => $number,
			'orderby' => $sort_by,
			'post_status' => 'publish',
			'eventDisplay'=>'upcoming',
			
		);
		if($sort_by =='start_date'){
			$args['meta_key'] = '_EventStartDate';
			$args['orderby'] = 'meta_value_num';
			$args['order'] = 'ASC';
		}

		}
		if(count($cats) > 0 && is_array($cats)){
			if(count($cats) > 1){
				$tax_query = array('relation'=>'OR');
			} else {
				$tax_query = array();
			}
			foreach($cats as $cat){
				$tax_query = array_merge($tax_query,array(array('taxonomy' => 'tribe_events_cat',
												'field' => is_numeric($cat) ? 'id' : 'slug',
												'terms' => array($cat),
												'operator' => 'IN')));
			}
			$args['tax_query'] = $tax_query;
		}	
		$the_query = new WP_Query( $args );
		$carol = false; $pgs = 0; 
		if(count($the_query->posts) / $perpage > 1){
			$carol = true;
			$pgs = ((count($the_query->posts) / $perpage) == intval(count($the_query->posts) / $perpage)) ? (count($the_query->posts) / $perpage) : intval(count($the_query->posts) / $perpage) + 1;
		}
		$html = $before_widget;
		if ( $title ) $html .= $before_title . $title . $after_title; 
		if($the_query->have_posts()):
			$id_accordion = 'accordion'.$id;
			$html .= '<div class="event_widget_fix">
					<div class="accordion" id="'.$id_accordion.'">';
			$i=0;
			while($the_query->have_posts()): $the_query->the_post();$i++;
			$a=get_post_meta(get_the_ID(), '_EventStartDate', true);
			$start_day = new DateTime($a);
			$h= substr($a, 11);
			$dt = get_option('date_format');
			$dte = new DateTime($a);
			$datetime = $dte->format($dt);
			$d= substr($datetime, 3, -11);
			$m= substr($datetime, 0, -14);
			$arr=array("/",",");
			$arr1=array("F","m","M");
			$arr2=array("d","j");
			$dtn= str_replace($arr," ",$dt)."<br/>";
			$cy=str_replace("Y"," ",$dtn)."<br/>";
			$cm= $dte->format(str_replace($arr2," ",$cy))."<br/>";
			$cd= $dte->format(str_replace($arr1," ",$cy))."<br/>";
			$id=rand();
			$links=get_permalink();
			{
				$html .= '
						  <div class="accordion-group">
							<div class="accordion-heading">
							  <h4><a class="accordion-toggle" data-toggle="collapse" data-parent="#'.$id_accordion.'" href="#collapse'.$id.'">'.get_the_title().'</a></h4>
							  <a class="accordion-toggle date_event" data-toggle="collapse" data-parent="#'.$id_accordion.'" href="#collapse'.$id.'">'.tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = "d").' '.tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = "M").'</a>
							  <a class="accordion-toggle price_event" data-toggle="collapse" data-parent="#'.$id_accordion.'" href="#collapse'.$id.'">'.tribe_get_cost(get_the_ID(),true).'</a>
							</div>
							<div id="collapse'.$id.'" class="accordion-body collapse">
							  <div class="accordion-inner">
								'.get_the_excerpt().'
								<div class="ev_button">'.do_shortcode('[button size="small" link="'.$links.'" ]'. __('Details', 'cactusthemes').'[/button]').'</div>
							  </div>
							</div>
							</div>
						  
				';
			}
			endwhile;
		$html.='</div></div>';
		endif;
		$html .= $after_widget;
		echo $html;
		wp_reset_postdata();
		$cache[$argsxx['widget_id']] = ob_get_flush();
		wp_cache_set('widget_recent_posts', $cache, 'widget');
	}
	
	function flush_widget_cache() {
		wp_cache_delete('widget_custom_type_posts', 'widget');
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['ids'] = strip_tags($new_instance['ids']);
		$instance['cats'] = $new_instance['cats'];
		$instance['sort_by'] = esc_attr($new_instance['sort_by']);
		$instance['show_type'] = esc_attr($new_instance['show_type']);
		$instance['number'] = absint($new_instance['number']);

		$instance['perpage'] = absint($new_instance['perpage']);

        $instance['date'] =esc_attr($new_instance['date']);
		return $instance;
	}
	
	
	
	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Event';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
		$ids = isset($instance['ids']) ? esc_attr($instance['ids']) : '';
		$perpage = isset($instance['perpage']) ? absint($instance['perpage']) : 2;

		//$thumb_h = isset($instance['thumb_h']) ? absint($instance['thumb_h']) : 50;
		//$thumb_w = isset($instance['thumb_w']) ? absint($instance['thumb_w']) : 50;
		$show_type = isset($instance['show_type']) ? esc_attr($instance['show_type']) : 'post';
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" 
        value="<?php echo $title; ?>" /></p>
      <!-- /**/-->
        <p>
          <label for="<?php echo $this->get_field_id('ids'); ?>"><?php _e('ID list show:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('ids'); ?>" name="<?php echo $this->get_field_name('ids'); ?>" type="text" 
          value="<?php echo $ids; ?>" />
        </p>

         <p>
            <label for="<?php echo $this->get_field_id('cats'); ?>"><?php _e('Categories:','cactusthemes');?> 
            
                <?php
				$args = array(
					'type'                     => 'tribe_events',
					'child_of'                 => 0,
					'parent'                   => '',
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 0,
					'hierarchical'             => 1,
					'exclude'                  => '',
					'include'                  => '',
					'number'                   => '',
					'taxonomy'                 => 'tribe_events_cat',
					'pad_counts'               => false 
				
				); 
                   $categories=  get_categories($args);
                     echo "<br/>";
                     foreach ($categories as $cat) {
                         $option='<input type="checkbox" id="'. $this->get_field_id( 'cats' ) .'[]" name="'. $this->get_field_name( 'cats' ) .'[]"';
                            if (is_array($instance['cats'])) {
                                foreach ($instance['cats'] as $cats) {
                                    if($cats==$cat->term_id) {
                                         $option=$option.' checked="checked"';
                                    }
                                }
                            }
                            $option .= ' value="'.$cat->term_id.'" />';
        
                            $option .= $cat->cat_name;
                            
                            $option .= '<br />';
                            echo $option;
                         }
                    
                    ?>
            </label>
        </p>
      <!-- /**/-->
        <p>
        
            <label for="<?php echo $this->get_field_id("sort_by"); ?>">
        
        <?php _e('Sort by');	 ?>:
        
        <select id="<?php echo $this->get_field_id("sort_by"); ?>" name="<?php echo $this->get_field_name("sort_by"); ?>">
        
          <option value="date"<?php selected( $instance["sort_by"], "Publish date" ); ?>>Date</option>
          
          <option value="start_date"<?php selected( $instance["sort_by"], "Start date" ); ?>>Start Date</option>
        
          <option value="title"<?php selected( $instance["sort_by"], "title" ); ?>>Title</option>
        
          <option value="rand"<?php selected( $instance["sort_by"], "rand" ); ?>>Random</option>
        
        </select>
        
            </label>
        
        </p>
        
        
        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts:'); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php 
		echo $number; ?>" size="3" /></p>
<!--//-->
<!--//-->              
<?php
	}
}

// register RecentPostsPlus widget
add_action( 'widgets_init', create_function( '', 'return register_widget("Event_Tribe_Recent_Posts_Widget");' ) );
?>