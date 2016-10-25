<?php
function parse_tribe_timelineevent_func($atts, $content){
		$ids 		=isset($atts['ids']) ? $atts['ids'] : '';
		$number 	= isset($atts['number']) ? $atts['number'] : '-1';
		$emonth 	= isset($atts['emonth']) ? $atts['emonth'] : '';
		$year 		= isset($atts['year']) ? $atts['year'] : '';
		$eventold 	= isset($atts['eventold']) ? $atts['eventold'] : '';
		$categories 			= isset($atts['categories']) ? $atts['categories'] : '';
		$upcoming 	= isset($atts['upcoming']) ? $atts['upcoming'] : '';
		$animation_class =isset( $atts['animation'])?'wpb_'.$atts['animation'].' wpb_animate_when_almost_visible':'';
		$demsl=0;
		$y_m=$year.'-1-1';
		$y_m = new DateTime($y_m);
		$nowe = $y_m->format("Y");
		if($emonth){
			$y_m=$year.'-'.$emonth.'-01';
			$y_m = new DateTime($y_m);
			$nowe = $y_m->format("Y-m");
		}
		if($year=='' && $emonth==''){ $nowe='';}
		if ( $ids != '' ) {
			$ids = explode(",", $ids);
			$gc = array();
			$demsl=0;
			foreach ( $ids as $grid_cat ) {
				$demsl++;
				array_push($gc, $grid_cat);
			}
			$args = array(
				'post_type' => 'tribe_events',
				'posts_per_page' => -1,
				'post_status' => 'publish',
				'post__in' =>  $gc ,
				'order'=> 'ASC',
			);
	
		}else if($ids =='' && $eventold=='yes' && $emonth=='' ){
			$args = array(
				'post_type' => 'tribe_events',
				'eventDisplay'=>'past',
				'posts_per_page' => $number,
				'post_status' => 'publish',
				'orderby' => 'meta_value',
				'meta_key' => '_EventStartDate',
				'order'=> 'ASC',
			);
		}else  if($ids =='' && $upcoming=='yes' && $emonth=='' ) {
			$args = array(
				'post_type' => 'tribe_events',
				'eventDisplay'=>'upcoming',
				'posts_per_page' => $number,
				'post_status' => 'publish',
				'orderby' => 'meta_value',
				'meta_key' => '_EventStartDate',
				'meta_value' => $nowe,
				'meta_compare' => 'LIKE',
				'order'=> 'ASC',
			);
		}else {
			$args = array(
				'post_type' => 'tribe_events',
				'eventDisplay'=>'all',
				'posts_per_page' => $number,
				'post_status' => 'publish',
				'orderby' => 'meta_value',
				'meta_key' => '_EventStartDate',
				'meta_value' => $nowe,
				'meta_compare' => 'LIKE',
				'order'=> 'ASC',
			);
		}
		$now = getdate();
		$monnow =$now["mon"];
		$daynow = $now["mday"] ;
		$yearnow = $now["year"] ;
	if($emonth!=''&&$ids=='')
	{
		$html = '
			<div class="nextcl" style="height:0">
			</div>	
			<div class="eventlist '.$animation_class.'"  style="height:100%;overflow:hidden ">
			<div class="timeline-event">
		';
		
	}else
	$html = '
		<div class="eventlist '.$animation_class.'"  style="height:100%;overflow:hidden ">
		<div class="timeline-event">
	';
	if(isset($categories)&&$categories){
		$cats = explode(",",$categories);
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
		//print_r($tax_query);
		$args['tax_query'] = $tax_query;
	}

	$the_query = new WP_Query( $args );
	//print_r($the_query);
	if($the_query->have_posts()){
		while($the_query->have_posts()){ $the_query->the_post();
			$demsl++;
			$a=get_post_meta(get_the_ID(), '_EventStartDate', true);
			$b=get_post_meta(get_the_ID(), '_EventEndDate', true);
			$dati=substr($a,5,2);
			$dati1=substr($a,6,4);		
			$date_m=substr($a,8,2);	
			$d_year=substr($a,0,4);	
			$h= substr($a, 11);
			$h1= substr($b, 11);
			$dt = get_option('date_format');
			$dte = new DateTime($a);
			$dte1 = new DateTime($b);
			$datetime = $dte->format($dt);
			$datetime1 = $dte1->format($dt);
			$d= substr($datetime, 3, -11);
			$m= substr($datetime, 0, -14);
			$arr=array("/",",");
			$arr1=array("F","m" , "M");
			$arr2=array("d","j");
			$dtn= str_replace($arr," ",$dt);
			$cy2=str_replace("d"," ",$dtn);
			$cy=str_replace("Y"," ",$dtn);
			$cm= $dte->format(str_replace($arr2," ",$cy));
			$cd= $dte->format(str_replace($arr1," ",$cy));
			$cyy= $dte->format(str_replace($arr1," ",$cy2));
			$meta_data = get_post_custom();
			$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'thumbname' );
			
			$start_day = new DateTime(tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = 'Y-m-d H:m:i'));
						if($image_src[0]==''){
								$html.='<div class="two-block" style="">
									<div class="timeline1" >
									<div class="row-fluid" >
										<div class="span12">
												<span class="dot"><span></span></span>
													<div class="postleft" style="">
													  <div class="rt-image" style="">
														<span class="big-date"  >'.tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = 'd').'</span>
														<span class="small-date" >'.tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = 'M').'</span>
													  </div>
													</div>
						
												<div>
													<div class="title" >
													<span class="event_title"><a href="'.tribe_get_event_link().'" >'.get_the_title().'</a></span>
													</br>
													<span class="rt-date-posted"><span class="icon-time">
													&nbsp;&nbsp;'.__('Start','cactusthemes').':&nbsp;&nbsp;'.tribe_get_start_date( $event = null, $displayTime = true, $dateFormat = $dt).'&nbsp;&nbsp;-&nbsp;&nbsp;'.__('End','cactusthemes').':&nbsp;&nbsp;'.tribe_get_end_date( $event = null, $displayTime = true, $dateFormat = $dt).'</span></span>
													</br>
													<span class="rt-date-posted"><span class="icon-map-marker">	
													&nbsp;&nbsp;&nbsp;'.__('Venue','cactusthemes').':&nbsp;&nbsp;'.tribe_get_venue( get_the_ID()).' , '.tribe_get_address( get_the_ID()).' , '.tribe_get_city(get_the_ID() ).' , '.tribe_get_country( get_the_ID()).'</span></span>
													</br>
													<span class="cte">'.get_the_excerpt().'</span>
													</div>
													<span class="line"></span>
												</div>
										</div>
									</div>
									</div>
									</div>';						
						}else
						{
						$html.='<div class="two-block" style="">
							<div class="timeline1" >
							<div class="row-fluid" >
								<div class="span3" ><a href="'.tribe_get_event_link().'" >'.get_the_post_thumbnail(get_the_ID(), 'thumb_360x240', array('alt' => get_the_title())).'</a></div>
								<div class="span9">
										<span class="dot"><span></span></span>
											<div class="postleft" style="">
											  <div class="rt-image" style="">
												<span class="big-date"  >'.tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = 'd').'</span>
												<span class="small-date" >'.tribe_get_start_date( $event = null, $displayTime = false, $dateFormat = 'M').'</span>
											  </div>
											</div>
				
										<div>
											<div class="title" >
											<span class="event_title" ><a href="'.tribe_get_event_link().'" >'.get_the_title().'</a></span>
											</br>
											<span class="rt-date-posted"><span class="icon-time">&nbsp;&nbsp;'.__('Start','cactusthemes').':&nbsp;&nbsp;'.tribe_get_start_date( $event = null, $displayTime = true, $dateFormat = $dt).'&nbsp;&nbsp;-&nbsp;&nbsp;'.__('End','cactusthemes').':&nbsp;&nbsp;'.tribe_get_end_date( $event = null, $displayTime = true, $dateFormat = $dt).'</span>
											</span>
											</br>
											<span class="rt-date-posted"><span class="icon-map-marker">	
											&nbsp;&nbsp;&nbsp;'.__('Venue','cactusthemes').':&nbsp;&nbsp;'.tribe_get_venue( get_the_ID()).' , '.tribe_get_address( get_the_ID()).' , '.tribe_get_city(get_the_ID() ).' , '.tribe_get_country( get_the_ID()).'</span></span>
											</br>
											<span class="cte" >'.get_the_excerpt().'</span>
											</div>
											<span class="line"></span>
										</div>
								</div>
							</div>
							</div>
							</div>';
					}
	}
	}
	$html .= '
	</div>
	</div>
	';	
	if($demsl==1)
	{
		$html .= '
			<style type="text/css" scoped="scoped">
				.timeline1 .row-fluid .span9 .line{ border-left:0 !important;} 
				.timeline1 .row-fluid .span12 .line{ border-left:0 !important;} 
			</style>
		';	
	}
	wp_reset_query();
	return $html;

}
add_shortcode( 'timeline_event', 'parse_tribe_timelineevent_func' );