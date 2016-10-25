<?php
function parse_portfolio_func($atts, $content){
	wp_enqueue_script( 'jquery-isotope');
	wp_enqueue_script( 'jquery-hoverdir');
	wp_enqueue_script( 'jquery-prettyPhoto');
	wp_enqueue_script( 'isotope-portfolio');
	wp_enqueue_style( 'prettyPhoto' );
	global $portfolio_js;
	global $font_awesome;
	$order 			= isset($atts['order']) ? $atts['order'] : 'name';	
	$style 			= isset($atts['style']) ? $atts['style'] : 'classic_grid';
	$items 			= (isset($atts['items']) && $atts['items'] > 0) ? $atts['items'] : -1;
	$ids 			= isset($atts['ids']) ? $atts['ids'] : '';
	$tags 			= isset($atts['tag']) ? $atts['tag'] : '';
	$item_size = isset($atts['columns']) ? $atts['columns'] : 6; // number of column
	$show_filter = isset($atts['show_filter']) ? $atts['show_filter'] : '1';
	
	$animation_class = '';
	if(class_exists('Mobile_Detect')){
		$detect = new Mobile_Detect;
		$_device_ = $detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'pc';
		$animation_class = (isset($atts['animation'])&&$_device_=='pc')?'wpb_'.$atts['animation'].' wpb_animate_when_almost_visible':'';
	}else{
		$animation_class = isset($atts['animation'])?'wpb_'.$atts['animation'].' wpb_animate_when_almost_visible':'';
	}
	/* 
	 * $item_size = 6 --> width = 193px
	 * $item_size = 5 --> width = 231px
	 * $item_size = 4 --> width = 289px
	 * $item_size = 3 --> width = 386px
	 */
	
	$args = array(
		'post_type' => 'post-portfolio',
		'posts_per_page' => $items,
		'post_status' => 'publish',
		'tag' => $tags,
	);
	
	if($order == 'name'){
		$args['orderby'] = 'title';
		$args['order'] = 'ASC';
	}elseif($order == 'created'){
		$args['orderby'] = 'date';
		$args['order'] = 'DESC';
	}
	if($ids != ''){
		$ids = explode(',',$ids);
		$args += array('post__in'=> $ids);
	}
	$all_tags = array();	
	$the_query = new WP_Query( $args );
	if($style=='carousel'){
		$html = '
			<div class="portfolio-3 responsive portfolio-container '.$animation_class.'">
		';
		$id = rand();
		$thumbsize = 'thumb_260x180';
		switch($item_size){
			case 3: $thumbsize = 'thumb_360x249';break;
			case 4: $thumbsize = 'thumb_260x180';break;
			case 5: $thumbsize = 'thumb_200x138';break;
			case 6: $thumbsize = 'thumb_160x110';break;
			default:
				$thumbsize = 'thumb_260x200';break;
		}
		//echo $thumbsize;
		if($the_query->have_posts()){
			$html .= '<ul id="portfolio-'.$id.'">';
			while($the_query->have_posts()){ $post = $the_query->the_post();
				$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
				$custom_link = get_post_meta(get_the_ID(),'custom_link',true);
				$html .= '
				<li class="'.$thumbsize.'">
					<a href="'.($custom_link?$custom_link:get_permalink()).'" title="'.get_the_title().'">'.get_the_post_thumbnail(get_the_ID(), $thumbsize, array('alt' => get_the_title())).'</a>
					<div>
						<h3>'.get_the_title().'</h3>
						<a href="'.$url.'" title="'.get_the_title().'" class="icon-search fa fa-search" rel="prettyPhoto[gallery1]"><!----></a>
						<a href="'.($custom_link?$custom_link:get_permalink()).'" class="icon-link fa fa-link"><!----></a>
					</div>
				</li>';
			}
			$html .= '
				</ul>
				<div class="clear"></div>
				<div class="slides-control">
					<div class="dotted"><!---->
					<div class="control-a">
						<a href="javascript:void(0)" class="icon-sign-blank fa fa-square" id="portfolio-prev-'.$id.'">
							<span class="icon-caret-left '.($font_awesome==4?'fa fa-caret-left':'').'"><!----></span>
						</a>
						<a href="javascript:void(0)" class="icon-sign-blank fa fa-square" id="portfolio-next-'.$id.'">
							<span class="icon-caret-right '.($font_awesome==4?'fa fa-caret-right':'').'"><!----></span>
						</a>
					</div>	
					</div>
				</div>
			';
		}
		$html .= '
			</div>
			<div class="clear"></div>
		';
		$portfolio_js[]='
			<script>
				jQuery(document).ready(function() {
					jQuery("#portfolio-'.$id.'").carouFredSel({
						height: "auto",
						prev: "#portfolio-prev-'.$id.'",
						next: "#portfolio-next-'.$id.'",
						auto: false,
						width: "100%",
						align: "left",
						items	: {
							visible	: function(visibleItems){ return visibleItems+1;},
							minimum	: 1,
						},
					});
				});
				jQuery(window).resize(function(){
					var windowWidth = jQuery(window).width();
					if(jQuery(window).width()<=1200){
						jQuery("#portfolio-'.$id.'").trigger("configuration", {
								scroll		: {
									items	: 1
								},
								items	: {
									visible	: function(visibleItems){ return visibleItems;},
									minimum	: 1,
								},
							}
						);
					}
				});
			</script>
		';
		return $html;
	}else{
		$id = rand();
		
		$portfolio_html = '';
		$margin = 0;
		$thumbsize = '';
		if($style == 'modern_grid'){ 
			switch($item_size){
				case 3: $column_width = 386;break;
				case 4: $column_width = 289;break;
				case 5: $column_width = 231;break;
				default:
					$column_width = 193;break;
			}
			
			$thumbsize = 'thumb_'.$column_width.'x'.$column_width;
		} else {
			$margin = 40;
			switch($item_size){
				case 3: 
					$column_width = 348+$margin;
					$thumbsize = 'thumb_386x386';break;
				case 4: 
					$column_width = 250+$margin;
					$thumbsize = 'thumb_289x289';break;
				default:
					$column_width = 192+$margin;
					$thumbsize = 'thumb_193x193';break;
			}					
		}
		
		$style_css = '<style type="text/css" scoped="scoped">
					#portfolio-'.$id.' .element .wp-post-image,#portfolio-'.$id.' .element div{max-width:'.($column_width-$margin).'px; max-height:'.($column_width-$margin).'px;}
					#portfolio-'.$id.' .element,#portfolio-'.$id.' .element .wp-post-image{width:'.$column_width.'px;height:'.$column_width.'px;}
					#portfolio-'.$id.' .element div{margin:0 '.($margin/2).'px}
				</style>
				';
				
		$html = $style_css . '
					<div class="'.(($style=='modern_grid')?'portfolio-1 portfolio-modern':'portfolio-1 portfolio-2 portfolio-classic').' '.$animation_class.'">';
				
		$all_tags = array();
		$i = 0;
		if($the_query->have_posts()){
			$portfolio_html .= '
				<div id="portfolio-'.$id.'" class="portfolio-column-'.$item_size.' portfolio-container center '.((function_exists('ot_get_option') && ot_get_option('portfolio_animation') == 'no') ? 'no-isotope' : '').'">
			';
			while($the_query->have_posts()){ $post = $the_query->the_post(); $i++;
				$tags = wp_get_post_tags(get_the_ID());
				$post_tags = array();
				$tags_class = '';
				foreach ($tags as $tag){
					$post_tags[$tag->term_id] = $tag;
					$tags_class .= $tag->slug.' ';
				}
				$all_tags = $all_tags + $post_tags;
				//var_dump($post);
				$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
				$custom_link = get_post_meta(get_the_ID(),'custom_link',true);
				$portfolio_html .= '
					<div class="element '.$tags_class.'">
						'.get_the_post_thumbnail(get_the_ID(), $thumbsize, array('alt' => get_the_title()));
						
				if($style == 'modern_grid'){
					$portfolio_html .= '<a href="'.($custom_link?$custom_link:get_permalink()).'" title="'.get_the_title().'" class="portfolio-title">'.get_the_title().'</a>';
				}
						
				$portfolio_html .= 						
						'<div class="blur"><a href="'.($custom_link?$custom_link:get_permalink()).'" title="'.get_the_title().'"><!-- --></a></div>';

				if($style != 'modern_grid'){					
					$portfolio_html .= 
							'<div class="acts">
								<h3>'.get_the_title().'</h3>
								<a href="'.$url.'" title="'.get_the_title().'" class="icon-search fa fa-search" rel="prettyPhoto[gallery1]"><!----></a>
								<a href="'.($custom_link?$custom_link:get_permalink()).'" class="icon-link fa fa-link"><!----></a>
							</div>
							<span class="number">'.$i.'</span>';
				}
				
				$portfolio_html .= '</div>';

			}
			$portfolio_html .= '</div>';
			if($style == 'modern_grid'){
				$portfolio_js[] = '
					<script type="text/javascript">
						jQuery(document).ready(function(){
							build_portfolio_modern("#portfolio-'.$id.'",'.$column_width.');
						});
					</script>
					';
			} else{
				$portfolio_js[] = '
				<script type="text/javascript">
					jQuery(document).ready(function(){
						build_portfolio_classic("#portfolio-'.$id.'",1);
					});
				</script>
				';
			}
		}
		if($show_filter){
			$html .= html_tags_project($all_tags);	
		}
		$html .= $portfolio_html;
		$html .= '</div>';
		wp_reset_postdata();
		return '<div>'.$html.'</div>';
	}
}

add_shortcode( 'portfolio', 'parse_portfolio_func' );

function portfolio_js(){
	global $portfolio_js;
	if($portfolio_js) foreach($portfolio_js as $aportfolio_js){echo $aportfolio_js;}
}
add_action('wp_footer', 'portfolio_js', 100);

if(!function_exists('html_tags_project')){
	function html_tags_project($all_tags){
		$html = '';
		if(count($all_tags) > 0){
			$html .= '
				<div class="center">			
				   <ul id="project-tags" class="project-tags">
						<li><a class="active" href="javascript:void(0)" data-filter="*">'.__('All','cactusthemes').'</a></li>
			';
			foreach ($all_tags as $tag){
				//var_dump($tag);
				$html .= '				
					<li><a href="javascript:void(0)" data-filter=".'.$tag->slug.'">'.$tag->name.'</a></li>
				';
			}
			$html .= '
					</ul>
				</div>
			';
		}
		return $html;
	}
}