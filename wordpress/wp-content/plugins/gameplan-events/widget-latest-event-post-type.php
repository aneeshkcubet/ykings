<?php
/*
Description: Adds a widget that can display recent posts from multiple categories or from custom post types.
*/

class Event_Recent_Posts_Widget extends WP_Widget {	

	function __construct() {
    	$widget_ops = array(
			'classname'   => 'advanced_event_recent_posts_widget', 
			'description' => __('Shows event posts ')
		);
    	parent::__construct('advanced-event-recent-posts', __('GP-Latest Event'), $widget_ops);
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
		$sort_by 		= empty($instance['sort_by']) ? '' : $instance['sort_by'];		
		//$show_type 		= empty($instance['show_type']) ? 'post' : $instance['show_type'];
		$number 		= empty($instance['number']) ? '' : $instance['number'];
		$perpage 		= empty($instance['perpage']) ? 2 : $instance['perpage'];
		$thumb 			= empty($instance['thumb']) ? '' : $instance['thumb'];
		$date 			= empty($instance['date']) ? '' : $instance['date'];
		$content			= empty($instance['content']) ? '' : $instance['content'];
		$address 	= empty($instance['address']) ? '' : $instance['address'];
		$thumb_w 		= empty($instance['thumb_w']) ? '' : $instance['thumb_w'];
		$thumb_h 		= empty($instance['thumb_h']) ? '' : $instance['thumb_h'];
		$args = array(
			'post_type' => 'event',
			'posts_per_page' => $number,
			'orderby' => $sort_by,
			'post_status' => 'publish',
			
		);
		if ( $ids != '' ) {
			$ids = explode(",", $ids);
			$gc = array();
			$dem=0;
			foreach ( $ids as $grid_cat ) {
				$dem++;
				array_push($gc, $grid_cat);
			}
		}

//		if(count($cats) > 0){
//			$args = array('category__in' => $cats, 'showposts' => $number);
//		}	
		$the_query = new WP_Query( $args );
		$carol = false; $pgs = 0; 
		if(count($the_query->posts) / $perpage > 1){
			$carol = true;
			$pgs = ((count($the_query->posts) / $perpage) == intval(count($the_query->posts) / $perpage)) ? (count($the_query->posts) / $perpage) : intval(count($the_query->posts) / $perpage) + 1;
		}
		$html = $before_widget;
		if ( $title ) $html .= $before_title . $title . $after_title; 
		if($the_query->have_posts()):
			if($carol):
				if(function_exists( 'head_slide' )):
				$html .= head_slide($pgs, 'recent-posts-'.rand(),'recent-post');
				endif;
			else:
				$html .= '<div class="recent-post ">';
			endif;
			$i=0;
			
			while($the_query->have_posts()): $the_query->the_post();$i++;
			$a=get_post_meta(get_the_ID(), 'start_day', true);
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
			if($ids!=''){
				for($k=0;$k<=$dem;$k++)
				{
					if($gc[$k]==get_the_ID())
					{
						$thumb_htm = '';
								$thumb_htm .= '
									<div class="postleft" style="display:table-cell;vertical-align:top;">
									  <div class="rt-image" style="">
										<span style="font-size:26px;" >'.$start_day->format('d').'</span>
										<span style="font-size:14px;" >'.$start_day->format('M').'</span>
									  </div>
									</div>
								';
						$date_html = '';
						if($date == 'on'):
							$date_html .= '                           
								<!-- Begin Date & Time --> 
								<span class="rt-date-posted"><span class="icon-time" style=" width:100%">'.$datetime." at ".$h.'</span></span>
								<!-- End Date & Time -->
							';
						endif;
						$content_html = '';
						if($content == 'on'):
							$content_html = '                           
								'.get_the_excerpt().'
							';
						endif;
		//			
						$address_html = '';
						if($address == 'on'):
							$address_html .= '
								<!-- Begin Comments -->
								<div class="rt-comment-block "> 
								<span  class="rt-comment-text"> <span class="icon-map-marker" style=" width:100%">'.get_post_meta(get_the_ID(), 'venue', true).' '.__('','cactusthemes').'</span> </span> 
								</div>                                        
								<!-- End Comments -->
							';
						endif;
						$html .= '
							<div class="row-fluid">
							  <div class="rt-article span12 event_pos">
								<div class="rt-article-bg">
								  <div class="post events_plug">
									'.$thumb_htm.'
									  <div class="rt-headline">
										<h4 class="rt-article-title"> <a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h4>
									  </div>
									  <div class="rt-articleinfo">
										'.$date_html.$address_html.'
									  </div>
									  <div class="recentpost-content">
										'.$content_html.'
									  </div>
									<!-- end post wrap -->
									<div class="clear"><!-- --></div>
								  </div>
								</div>
							  </div>
							  <!-- end span -->                              
							</div>
						';
						if($carol):
							if($i % $perpage == 0 && $i != $number)
								$html .= '
										</div>
									</div>
									<div class="slide" style="width:'.(100/$pgs).'%;">
										<div class="recent-post ">
								';					
						endif;
					}
				}
			}else
			{
				$thumb_htm = '';
						$thumb_htm .= '
							<div class="postleft" style="display:table-cell;vertical-align:top;">
							  <div class="rt-image" style="">
								<span style="font-size:26px;" >'.$start_day->format('d').'</span>
								<span style="font-size:14px;" >'.$start_day->format('M').'</span>
							  </div>
							</div>
						';
				$date_html = '';
				if($date == 'on'):
					$date_html .= '                           
						<!-- Begin Date & Time --> 
						<span class="rt-date-posted"><span class="icon-time" style=" width:100%">'.$datetime." at ".$h.'</span></span>
						<!-- End Date & Time -->
					';
				endif;
				$content_html = '';
				if($content == 'on'):
					$content_html = '                           
						'.get_the_excerpt().'
					';
				endif;
//			
				$address_html = '';
				if($address == 'on'):
					$address_html .= '
						<!-- Begin Comments -->
						<div class="rt-comment-block "> 
						<span  class="rt-comment-text"> <span class="icon-map-marker" style=" width:100%">'.get_post_meta(get_the_ID(), 'venue', true).' '.__('','cactusthemes').'</span> </span> 
						</div>                                        
						<!-- End Comments -->
					';
				endif;
				$html .= '
					<div class="row-fluid">
					  <div class="rt-article span12 event_pos">
						<div class="rt-article-bg">
						  <div class="post events_plug">
							'.$thumb_htm.'
							  <div class="rt-headline">
								<h4 class="rt-article-title"> <a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h4>
							  </div>
							  <div class="rt-articleinfo">
								'.$date_html.$address_html.'
							  </div>
							  <div class="recentpost-content">
								'.$content_html.'
							  </div>
							<!-- end post wrap -->
							<div class="clear"><!-- --></div>
						  </div>
						</div>
					  </div>
					  <!-- end span -->                              
					</div>
				';
				if($carol):
					if($i % $perpage == 0 && $i != $number)
						$html .= '
								</div>
							</div>
							<div class="slide" style="width:'.(100/$pgs).'%;">
								<div class="recent-post ">
						';					
				endif;
		
			}
			endwhile;
			if($carol):
				if(function_exists( 'footer_slide' )):
					$html .= footer_slide(NULL,'gp_latest_event');
				endif;
			else:
				$html .= '</div>';
			endif;
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
		$instance['sort_by'] = esc_attr($new_instance['sort_by']);
		$instance['show_type'] = esc_attr($new_instance['show_type']);
		$instance['number'] = absint($new_instance['number']);

		$instance['perpage'] = absint($new_instance['perpage']);

		$instance["thumb"] = esc_attr($new_instance['thumb']);
        $instance['date'] =esc_attr($new_instance['date']);
		$instance['content'] =esc_attr($new_instance['content']);
		//$instance['hour'] =esc_attr($new_instance['hour']);
        $instance['address']=esc_attr($new_instance['address']);
		$instance["thumb_w"]=absint($new_instance["thumb_w"]);
		$instance["thumb_h"]=absint($new_instance["thumb_h"]);
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
      <!-- /**/-->
        <p>
        
            <label for="<?php echo $this->get_field_id("sort_by"); ?>">
        
        <?php _e('Sort by');	 ?>:
        
        <select id="<?php echo $this->get_field_id("sort_by"); ?>" name="<?php echo $this->get_field_name("sort_by"); ?>">
        
          <option value="date"<?php selected( $instance["sort_by"], "date" ); ?>>Date</option>
        
          <option value="title"<?php selected( $instance["sort_by"], "title" ); ?>>Title</option>
        
          <option value="rand"<?php selected( $instance["sort_by"], "rand" ); ?>>Random</option>
        
        </select>
        
            </label>
        
        </p>
        
        
<!--abc-->        
        <p>
        
            <label for="<?php echo $this->get_field_id("date"); ?>">
        
                <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("date"); ?>" name="<?php echo $this->get_field_name(
				"date"); ?>"<?php checked( (bool) $instance["date"], true ); ?> />
        
                <?php _e( 'Show Start date ' ); ?>
        
            </label>
        
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("address"); ?>">
        
                <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("address"); ?>" name="<?php echo $this->get_field_name(
				"address"); ?>"<?php checked( (bool) $instance["address"], true ); ?> />
                <?php _e( 'Show address' ); ?>
        
            </label>
        </p>

        <p>
        
            <label for="<?php echo $this->get_field_id("content"); ?>">
        
                <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("date"); ?>" name="<?php echo $this->get_field_name("content"); ?>"<?php checked( (bool) $instance["content"], true ); ?> />
        
                <?php _e( 'Show Content ' ); ?>
        
            </label>
        
        </p>


        
        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts:'); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php 
		echo $number; ?>" size="3" /></p>
<!--//-->
		<p><label for="<?php echo $this->get_field_id('perpage'); ?>"><?php _e('Number of posts to show:'); ?></label>
        <input id="<?php echo $this->get_field_id('perpage'); ?>" name="<?php echo $this->get_field_name('perpage'); ?>" type="text" value="<?php 
		echo $perpage; ?>" size="3" /></p>
<!--//-->              
<?php
	}
}

// register RecentPostsPlus widget
add_action( 'widgets_init', create_function( '', 'return register_widget("Event_Recent_Posts_Widget");' ) );
?>