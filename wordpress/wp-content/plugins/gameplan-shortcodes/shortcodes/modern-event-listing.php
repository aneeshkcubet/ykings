<?php


function parse_modern_event_func($atts, $content){
	$count 					= isset($atts['count']) ? $atts['count'] : 4;
	$posts_in 				= isset($atts['posts_in']) ? $atts['posts_in'] : '';
	$categories 			= isset($atts['categories']) ? $atts['categories'] : '';
	$orderby 				= isset($atts['orderby']) ? $atts['orderby'] : '';
	$order 					= isset($atts['order']) ? $atts['order'] : 'ASC';
	$el_class 				= isset($atts['el_class']) ? $atts['el_class'] : '';
	global $font_awesome;
	if(class_exists('Mobile_Detect')){
		$detect = new Mobile_Detect;
		$_device_ = $detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'pc';
		$animation_class = ($atts['animation']&&$_device_=='pc')?'wpb_'.$atts['animation'].' wpb_animate_when_almost_visible':'';
	}else{
		$animation_class = $atts['animation']?'wpb_'.$atts['animation'].' wpb_animate_when_almost_visible':'';
	}
	add_filter( 'excerpt_length', 'mel_custom_excerpt_length', 999 );
	if($posts_in){
		$args = array(
			'post_type' => 'event',
			'posts_per_page' => $count,
			'post_status' => 'publish',
			'orderby' => $orderby,
			'order' => $order
		);
	}else{
		$args = array(
			'post_type' => 'event',
			'posts_per_page' => $count,
			'post_status' => 'publish',
			'orderby' => $orderby,
			'order' => $order,
			'meta_key' => 'start_day',
			'meta_query' => array(
				array(
					'key' => 'start_day',
					'value' => date('Y-m-d H:m:i'),
					'compare' => '>=',
					'type' => 'DATETIME'
				)
			)
		);
	}
	
	if($posts_in != ''){
		$posts_in = split(',',$posts_in);
		$args += array('post__in'=> $posts_in);
	}
	
	if(isset($categories)&&$categories){
		$cats = explode(",",$categories);
		if(is_numeric($cats[0])){
			$args['cat'] = $categories;
		}else{			 
			$args['category_name'] = $categories;
		}
	}
	
	$the_query = new WP_Query( $args );
	ob_start();
	echo '
	<div class="modern-event-listing-wrap '.$animation_class.'">
	<div class="modern-event-listing blog-listing blog-listing-modern event-listing-modern">';
	if($the_query->have_posts()){
		while($the_query->have_posts()){ $the_query->the_post();
		$fields = get_post_custom_keys(get_the_ID());
        $values = get_post_custom(get_the_ID());
        $start_day = new DateTime($values['start_day'][0]);
		if($the_query->post_count==2){$span_class='span6';}
		elseif($the_query->post_count==3){$span_class='span4';}
		elseif($the_query->post_count==4){$span_class='span3';}
		elseif($the_query->post_count==6){$span_class='span2';}
		else{$span_class='span3';}
		?>
        	<div class="wrap-item <?php echo $span_class ?>">
			<div class="item">
              <div class="article">
                <div class="article-bg">
                  <div class="article-content">
                    <?php if(has_post_thumbnail()){?>
                    <div class="span12 imge">
                      <div class="rt-image">
                        <a href="<?php the_permalink();?>" title="<?php echo get_the_title();?>"><?php echo get_the_post_thumbnail(get_the_ID(), 'thumb_360x240', array('alt' => get_the_title()));?></a>
                      </div>
                    </div>
                    <?php }?>
                    <div class="span12 modern_style">
                      <div class="rt-headline">
                        <h3 class="rt-article-title"> 
                            <a href="<?php the_permalink();?>"><?php echo get_the_title();?></a>
                        </h3>
                      </div>                                          
                      <div class="dotted dot-event"><div class="inner"></div></div>
                      <div class="custom-pot-1"> 
                       <?php 
					   if(function_exists( 'ot_get_option' )){
                        $event_show_big_date_text= ot_get_option('event_show_big_date_text');
					   }
                        if($event_show_big_date_text=='1'|| $event_show_big_date_text=='')
                        {
                        ?> 
                        <div class="date-counter"><?php echo $start_day->format('d')?> <span><?php echo 
                        $start_day->format('M')?></span></div>
                        <?php }else{?>
                            <style type="text/css" scoped="scoped">
                                .time-ev.modern-noshow{ margin-left:0 !important}
                                .venua-ev.modern-noshow{ margin-left:0 !important}
                            </style>
                        <?php }
						if(function_exists( 'ot_get_option' )){
                        $event_show_start_time= ot_get_option('event_show_start_time');
						}
                        if($event_show_start_time=='1'|| $event_show_start_time=='')
                        {
                        ?>
                        <span class="time-ev modern-noshow" ><span class="time-span"><i class="icon-time <?php echo $font_awesome==4?'fa fa-clock-o':'' ?>"></i><?php echo $start_day->format('h:i A')?> </span></span> 
                        <?php }
						if(function_exists( 'ot_get_option' )){
                        	$event_show_location= ot_get_option('event_show_location');
						}
                        if($event_show_location=='1'|| $event_show_location=='')
                        {
                        ?>
                        <?php if($values['venue'][0]):?><span class="venua-ev modern-noshow" ><span class="time-span"><i class="icon-map-marker <?php echo $font_awesome==4?'fa fa-map-marker':'' ?>"></i> <?php echo $values['venue'][0];?></span></span><?php endif;?>
                        <?php }
						if(function_exists( 'ot_get_option' )){
                        $event_show_info= ot_get_option('event_show_info');
						}
                        ?>
                      </div>
                      
                      
                      <div class="clear"><!----></div>
                      <div class="recentpost-content">
                        <?php echo strip_tags(get_the_excerpt());?>
                      </div>
                    </div>
                    <!-- end post wrap -->
                    <div class="clear"><!-- --></div>
                  </div>
                </div>
              </div>
              <!-- end article -->
              <div class="clear"><!-- --></div>
             </div>
             </div>
		<?php }
	}
	echo '
	</div>
	</div>
	';
	wp_reset_query();
	$output_string=ob_get_contents();
	ob_end_clean();
	remove_filter( 'excerpt_length', 'mel_custom_excerpt_length' );
	return $output_string;
}

add_shortcode( 'modern-event-listing', 'parse_modern_event_func' );

function mel_custom_excerpt_length( $length ) {
	return 20;
}

/* Register shortcode with Visual Composer */
add_action( 'after_setup_theme', 'reg_modern_event' );
function reg_modern_event(){
	if(function_exists('wpb_map')){

	wpb_map( array(
		"name"		=> __("Modern Event Listing", "js_composer"),
		"base"		=> "modern-event-listing",
		"class"		=> "wpb_vc_modern-event-listing",
		//"icon"		=> "icon-wpb-slideshow",
		"category"  => __('Content', 'js_composer'),
		"params"	=> array(
			array(
				"type" => "textfield",
				"heading" => __("Posts count", "js_composer"),
				"param_name" => "count",
				"value" => "",
				"description" => __('How many events to show? Enter number or "All".', "js_composer")
			),
			array(
				"type" => "textfield",
				"heading" => __("Post/Page IDs", "js_composer"),
				"param_name" => "posts_in",
				"value" => "",
				"description" => __('Fill this field with page/posts IDs separated by commas (,), to retrieve only them. Use this in conjunction with "Post types" field.', "js_composer")
			),
			array(
				"type" => "exploded_textarea",
				"heading" => __("Categories", "js_composer"),
				"param_name" => "categories",
				"description" => __("If you want to narrow output, enter category names here. Note: Only listed categories will be included. Divide categories with linebreaks (Enter).", "js_composer")
			),
			array(
				"type" => "dropdown",
				"heading" => __("Order by", "js_composer"),
				"param_name" => "orderby",
				"value" => array(
					__("None", "js_composer") => "",
					__("Meta Value", "js_composer") => "meta_value",
					__("Date", "js_composer") => "date",
					__("ID", "js_composer") => "ID", 
					__("Author", "js_composer") => "author", 
					__("Title", "js_composer") => "title", 
					__("Modified", "js_composer") => "modified", 
					__("Random", "js_composer") => "rand", 
					__("Comment count", "js_composer") => "comment_count", 
					__("Menu order", "js_composer") => "menu_order" 
				),
				"description" => __('Select how to sort retrieved posts. More at <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>.', 'js_composer')
			),
			array(
				"type" => "dropdown",
				"heading" => __("Order by", "js_composer"),
				"param_name" => "order",
				"value" => array( __("Ascending", "js_composer") => "ASC", __("Descending", "js_composer") => "DESC" ),
				"description" => __('Designates the ascending or descending order. More at <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>.', 'js_composer')
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
		  )
		)
	) );
	}
}