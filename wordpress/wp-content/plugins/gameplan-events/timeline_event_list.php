<?php
function parse_timelineevent_func($atts, $content){
		$ids 		=isset($atts['ids']) ? $atts['ids'] : '';
		$emonth 	= isset($atts['emonth']) ? $atts['emonth'] : '';
		$year 		= isset($atts['year']) ? $atts['year'] : '';
		$eventold 	= isset($atts['eventold']) ? $atts['eventold'] : '';
		$animation_class =isset( $atts['animation'])?'wpb_'.$atts['animation'].' wpb_animate_when_almost_visible':'';
		$args = array(
			'post_type' => 'event',
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'orderby' => 'meta_value',
			'meta_key' => 'start_day',
			'order'=> 'ASC'
		);
		$now = getdate();
		$monnow =$now["mon"];
		$daynow = $now["mday"] ;
		$yearnow = $now["year"] ;
		
	if ( $ids != '' ) {
		$ids = explode(",", $ids);
		$gc = array();
		$dem=0;
		foreach ( $ids as $grid_cat ) {
			$dem++;
			array_push($gc, $grid_cat);
		}
	}
	$demsl=0;
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

	$the_query = new WP_Query( $args );
	if($the_query->have_posts()){
		while($the_query->have_posts()){ $the_query->the_post();
			$a=get_post_meta(get_the_ID(), 'start_day', true);
			$b=get_post_meta(get_the_ID(), 'end_day', true);
			$dati=substr($a,0,2);
			$dati1=substr($a,6,4);		
			$date_m=substr($a,3,2);	
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
			$dtn= str_replace($arr," ",$dt)."<br/>";
			$cy2=str_replace("d"," ",$dtn)."<br/>";
			$cy=str_replace("Y"," ",$dtn)."<br/>";
			$cm= $dte->format(str_replace($arr2," ",$cy))."<br/>";
			$cd= $dte->format(str_replace($arr1," ",$cy))."<br/>";
			$cyy= $dte->format(str_replace($arr1," ",$cy2))."<br/>";
			$meta_data = get_post_custom();
			$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'thumbname' );
			
			if($ids!=''){
				
				for($i=0;$i<=$dem;$i++)
				{
					if($gc[$i]==get_the_ID())
					{
						
						$demsl++;
						if($image_src[0]==''){
								$html.='<div class="two-block" style="">
									<div class="timeline1" >
									<div class="row-fluid" >
										<div class="span12">
												<span class="dot"><span></span></span>
													<div class="postleft" style="">
													  <div class="rt-image" style="">
														<span style="font-size:26px;" >'.str_replace(' ','',$cd).'</span>
														<span style="font-size:14px;" >'.str_replace(' ','',$cm).'</span>
													  </div>
													</div>
						
												<div>
													<div class="title" >
													<span class="event_title"><a href="'.get_permalink().'" >'.get_the_title().'</a></span>
													</br>
													<span class="rt-date-posted"><span class="icon-time">
													&nbsp;&nbsp;Start:&nbsp;&nbsp;'.$datetime.
													"&nbsp; at 
													&nbsp;".$h."&nbsp;&nbsp;- &nbsp;&nbsp;End:&nbsp;&nbsp;".$datetime1."&nbsp; at 
													&nbsp;".$h1.'</span>
													</span>
													</br>
													<span class="rt-date-posted"><span class="icon-map-marker">	
													&nbsp;&nbsp;&nbsp;Venue:&nbsp;&nbsp;'.
													$meta_data['venue'][0].'</span></span>
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
								<div class="span3" ><a href="'.get_permalink().'" >'.get_the_post_thumbnail(get_the_ID(), 'thumb_360x240', array('alt' => get_the_title())).'</a></div>
								<div class="span9">
										<span class="dot"><span></span></span>
											<div class="postleft" style="">
											  <div class="rt-image" style="">
												<span style="font-size:26px;" >'.str_replace(' ','',$cd).'</span>
												<span style="font-size:14px;" >'.str_replace(' ','',$cm).'</span>
											  </div>
											</div>
				
										<div>
											<div class="title" >
											<span class="event_title" ><a href="'.get_permalink().'" >'.get_the_title().'</a></span>
											</br>
											<span class="rt-date-posted"><span class="icon-time">&nbsp;&nbsp;Start:&nbsp;&nbsp;'.$datetime.
											"&nbsp; at 
											&nbsp;".$h."&nbsp;&nbsp;- &nbsp;&nbsp;End:&nbsp;&nbsp;".$datetime1."&nbsp; at &nbsp;".$h1.'</span>
											</span>
											</br>
											<span class="rt-date-posted"><span class="icon-map-marker">	
											&nbsp;&nbsp;&nbsp;Venue:&nbsp;&nbsp;'.
											$meta_data['venue'][0].'</span></span>
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
				
			}else
			if($emonth!='' && $ids==''){
				if($dati==$emonth && $dati1==$year)
				{
				$demsl++;
				if($image_src[0]==''){
						$html.='<div class="two-block" style="">
							<div class="timeline1" >
							<div class="row-fluid" >
								<div class="span12">
										<span class="dot"><span></span></span>
											<div class="postleft" style="">
											  <div class="rt-image" style="">
												<span style="font-size:26px;" >'.str_replace(' ','',$cd).'</span>
												<span style="font-size:14px;" >'.str_replace(' ','',$cm).'</span>
											  </div>
											</div>
				
										<div>
											<div class="title" >
											<span class="event_title" ><a href="'.get_permalink().'" >'.get_the_title().'</a></span>
											</br>
											<span class="rt-date-posted"><span class="icon-time">
											&nbsp;&nbsp;Start:&nbsp;&nbsp;'.$datetime.
											"&nbsp; at 
											&nbsp;".$h."&nbsp;&nbsp;- &nbsp;&nbsp;End:&nbsp;&nbsp;".$datetime1."&nbsp; at 
											&nbsp;".$h1.'</span>
											</span>
											</br>
											<span class="rt-date-posted"><span class="icon-map-marker">	
											&nbsp;&nbsp;&nbsp;Venue:&nbsp;&nbsp;'.
											$meta_data['venue'][0].'</span></span>
											</br>
											<span class="cte" >'.get_the_excerpt().'</span>
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
							<div class="span3" ><a href="'.get_permalink().'" >'.get_the_post_thumbnail(get_the_ID(), 'thumb_360x240', array('alt' => get_the_title())).'</a></div>
							<div class="span9">
									<span class="dot"><span></span></span>
										<div class="postleft" style="">
										  <div class="rt-image" style="">
											<span style="font-size:26px;" >'.str_replace(' ','',$cd).'</span>
											<span style="font-size:14px;" >'.str_replace(' ','',$cm).'</span>
										  </div>
										</div>
			
									<div>
										<div class="title" >
										<span class="event_title" ><a href="'.get_permalink().'" >'.get_the_title().'</a></span>
										</br>
										<span class="rt-date-posted"><span class="icon-time">&nbsp;&nbsp;Start:&nbsp;&nbsp;'.$datetime.
										"&nbsp; at 
										&nbsp;".$h."&nbsp;&nbsp;- &nbsp;&nbsp;End:&nbsp;&nbsp;".$datetime1."&nbsp; at &nbsp;".$h1.'</span>
										</span>
										</br>
										<span class="rt-date-posted"><span class="icon-map-marker">	
										&nbsp;&nbsp;&nbsp;Venue:&nbsp;&nbsp;'.
										$meta_data['venue'][0].'</span></span>
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
			else
			if($ids=='' && $emonth=='' && $eventold=='yes'){
				if($monnow==$dati && $date_m <= $daynow)
				{
					$demsl++;
					if($image_src[0]==''){
							$html.='<div class="two-block" style="">
								<div class="timeline1" >
								<div class="row-fluid" >
									<div class="span12">
											<span class="dot"><span></span></span>
												<div class="postleft" style="">
												  <div class="rt-image" style="">
													<span style="font-size:26px;" >'.str_replace(' ','',$cd).'</span>
													<span style="font-size:14px;" >'.str_replace(' ','',$cm).'</span>
												  </div>
												</div>
					
											<div>
												<div class="title" >
												<span class="event_title" ><a href="'.get_permalink().'" >'.get_the_title().'</a></span>
												</br>
												<span class="rt-date-posted"><span class="icon-time">
												&nbsp;&nbsp;Start:&nbsp;&nbsp;'.$datetime.
												"&nbsp; at 
												&nbsp;".$h."&nbsp;&nbsp;- &nbsp;&nbsp;End:&nbsp;&nbsp;".$datetime1."&nbsp; at 
												&nbsp;".$h1.'</span>
												</span>
												</br>
												<span class="rt-date-posted"><span class="icon-map-marker">	
												&nbsp;&nbsp;&nbsp;Venue:&nbsp;&nbsp;'.
												$meta_data['venue'][0].'</span></span>
												</br>
												<span class="cte" >'.get_the_excerpt().'</span>
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
									<div class="span3" ><a href="'.get_permalink().'" >'.get_the_post_thumbnail(get_the_ID(), 'thumb_360x240', array('alt' => get_the_title())).'</a></div>
									<div class="span9">
											<span class="dot"><span></span></span>
												<div class="postleft" style="">
												  <div class="rt-image" style="">
													<span style="font-size:26px;" >'.str_replace(' ','',$cd).'</span>
													<span style="font-size:14px;" >'.str_replace(' ','',$cm).'</span>
												  </div>
												</div>
					
											<div>
												<div class="title" >
												<span class="event_title" ><a href="'.get_permalink().'" >'.get_the_title().'</a></span>
												</br>
												<span class="rt-date-posted"><span class="icon-time">&nbsp;&nbsp;Start:&nbsp;&nbsp;'.$datetime.
												"&nbsp; at 
												&nbsp;".$h."&nbsp;&nbsp;- &nbsp;&nbsp;End:&nbsp;&nbsp;".$datetime1."&nbsp; at &nbsp;".$h1.'</span>
												</span>
												</br>
												<span class="rt-date-posted"><span class="icon-map-marker">	
												&nbsp;&nbsp;&nbsp;Venue:&nbsp;&nbsp;'.
												$meta_data['venue'][0].'</span></span>
												</br>
												<span class="cte">'.get_the_excerpt().'</span>
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
			else
			if($ids=='' && $emonth=='' && $eventold=='')
			{
				if($monnow==$dati && $date_m >= $daynow)
				{
					$demsl++;
					if($image_src[0]==''){
							$html.='<div class="two-block" style="">
								<div class="timeline1" >
								<div class="row-fluid" >
									<div class="span12">
											<span class="dot"><span></span></span>
												<div class="postleft" style="">
												  <div class="rt-image" style="">
													<span style="font-size:26px;" >'.str_replace(' ','',$cd).'</span>
													<span style="font-size:14px;" >'.str_replace(' ','',$cm).'</span>
												  </div>
												</div>
					
											<div>
												<div class="title" >
												<span class="event_title" ><a href="'.get_permalink().'" >'.get_the_title().'</a></span>
												</br>
												<span class="rt-date-posted"><span class="icon-time">
												&nbsp;&nbsp;Start:&nbsp;&nbsp;'.$datetime.
												"&nbsp; at 
												&nbsp;".$h."&nbsp;&nbsp;- &nbsp;&nbsp;End:&nbsp;&nbsp;".$datetime1."&nbsp; at 
												&nbsp;".$h1.'</span>
												</span>
												</br>
												<span class="rt-date-posted"><span class="icon-map-marker">	
												&nbsp;&nbsp;&nbsp;Venue:&nbsp;&nbsp;&nbsp;'.
												$meta_data['venue'][0].'</span></span>
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
								<div class="span3" ><a href="'.get_permalink().'" >'.get_the_post_thumbnail(get_the_ID(), 'thumb_360x240', array('alt' => get_the_title())).'</a></div>
								<div class="span9">
										<span class="dot"><span></span></span>
											<div class="postleft" style="">
											  <div class="rt-image" style="">
												<span style="font-size:26px;" >'.str_replace(' ','',$cd).'</span>
												<span style="font-size:14px;" >'.str_replace(' ','',$cm).'</span>
											  </div>
											</div>
				
										<div>
											<div class="title" >
											<span class="event_title"><a href="'.get_permalink().'" >'.get_the_title().'</a></span>
											</br>
											<span class="rt-date-posted"><span class="icon-time">&nbsp;&nbsp;Start:&nbsp;&nbsp;'.$datetime.
											"&nbsp; at 
											&nbsp;".$h."&nbsp;&nbsp;- &nbsp;&nbsp;End:&nbsp;&nbsp;".$datetime1."&nbsp; at &nbsp;".$h1.'</span>
											</span>
											</br>
											<span class="rt-date-posted"><span class="icon-map-marker">	
											&nbsp;&nbsp;&nbsp;Venue:&nbsp;&nbsp;&nbsp;'.
											$meta_data['venue'][0].'</span></span>
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
				.timeline1 .row-fluid .span9 .line{ border-left:0;} 
				.timeline1 .row-fluid .span12 .line{ border-left:0;} 
			</style>
		';	
	}
	return $html;

}
add_shortcode( 'timeline_event', 'parse_timelineevent_func' );