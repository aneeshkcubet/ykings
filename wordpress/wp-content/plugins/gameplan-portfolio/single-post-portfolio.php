<?php get_header(); ?>
<div class="bg-container single-post-body single-portfolio"> 
    <div class="body-top-color"><!----></div>
    <div class="background-color"><!----></div> 
    <div class="container">
    	<div class="container-pad">
        	<?php 
			
				if ( have_posts() ) : 
                    while ( have_posts() ) : the_post();					
					if (function_exists('ot_get_option')) {
						$layout = get_post_meta(get_the_ID(),'single_portfolio_layout',true)?get_post_meta(get_the_ID(),'single_portfolio_layout',true):ot_get_option('single_portfolio_layout','');
					}
			?>
            <div class="row-fluid">
            	<div class="<?php if($layout!='wide'){ ?>span8<?php }?>">
            		<?php
                                $thumb      = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'medium' );
                                $imgurl     = $thumb['0']; 	                        	
	                        	?>

                	
						<div id="post-gallery" class="aligncenter">
						<img alt="<?php echo get_the_title(); ?>"  src="<?php echo $imgurl; ?>" >';
						</div>
					
                </div>
                <div class="<?php if($layout!='wide'){ ?>span4<?php }?>">
                	<?php
						echo '<div class="single-portfolio-content">';
                    	the_content();
						echo '</div>';
					?>
                    <!-- BEGIN Tags -->
                    <?php
						$posttags = get_the_tags();
						if ($posttags) {
							echo do_shortcode('[divider colorstyle="colorstyle_1" dividerstyle="style_1"]');
					?>					
                    <span class="rt-tags">										
                      <div class="post-tags">
                        <i class="icon-tag fa fa-tag"></i>
                        <?php
                            $i = 0;
                          foreach($posttags as $tag) {
                            echo 
                            '<a title="'.$tag->name.'" href="' . get_tag_link($tag->term_id) .'">'.$tag->name . '</a>';
                            if($i < count($posttags) - 1) echo ', '; 
                            $i++;
                          }
                        ?>
                      </div>
                    </span>
					<?php 
							echo do_shortcode('[divider colorstyle="colorstyle_1" dividerstyle="style_1"]');
						} 
						$show_hide_social_porfolio= get_post_meta($post->ID,'show_hide_social_porfolio',true);
						if($show_hide_social_porfolio=='show'){ //check if show social share
							gp_social_share(get_the_ID());
						}
						if($show_hide_social_porfolio=='def'){
							if(function_exists( 'ot_get_option' )){
							if( ot_get_option( 'porfolio_show_socialsharing', 1)){ //check if show social share
								gp_social_share(get_the_ID());
							}
							}
						}
						echo '<div class="single-portfolio-movie">';
						previous_post_link('%link', ' ');
						next_post_link('%link', ' ');
						echo '</div>';
					?>
                    <!-- END Tags -->
                </div>
            </div>
            <?php            
            		endwhile;								
				endif;
				if(function_exists( 'ot_get_option' )){ $numberpost = ot_get_option('related_posts_port');}
				$show_re_metadata = ot_get_option('show_re_metadata_port');
				if( $numberpost==''){
					$numberpost=-1;
				}
				
				$posttags = get_the_tags();
				$tags = '';
				if ($posttags) {
					foreach($posttags as $tag) {
						$tags .= ',' . $tag->slug; 
					}
				}
				$tags = substr($tags, 1); 
			?>
            <!-- BEGIN Other Project -->            
				<?php 
					// get IDS of related portfolio

					$_args = array(
						'post_type' => 'post-portfolio',
						'posts_per_page' => $numberpost,
						'post_status' => 'publish',
						'tag' => ($tags),
						'query_vars'=>array()
					);
					if ( function_exists('icl_object_id') ) {
						$_args['suppress_filters'] = true;
					}
					$related_posts = new WP_Query($_args);
					$ids = '';
					if($related_posts->have_posts()){					
						while($related_posts->have_posts()){ 
							$related_posts->the_post();							
							$ids .= ','.get_the_ID();
						}
						$ids = substr($ids, 1); 
						wp_reset_query();
					}
					
					// write portfolio
					if($ids != ''){

			?>
				<div id="related-posts">
				<div class="dotted-title">
					<?php if(function_exists( 'ot_get_option' )){ if(!ot_get_option('righttoleft')){?>
					<h3><?php echo __('Other Projects','cactusthemes');?></h3>
					<?php }}?>
					<div class="dotted"></div>
					<?php if(function_exists( 'ot_get_option' )){ if(ot_get_option('righttoleft')){?>
					<h3><?php echo __('Other Projects','cactusthemes');?></h3>
					<?php }}?>
				</div>
			<?php		
			if(function_exists( 'ot_get_option' )){
				$item_per_page = ot_get_option('singe_post_portfolio_items_per_page');
			}
				if(!$item_per_page) $item_per_page = 4;

				echo do_shortcode('[portfolio show_filter=0 columns="'.$item_per_page.'" style=carousel ids="'.$ids.'"]');
			?>
				</div>
			<?php
					}
                ?>
		</div>
    </div>
</div>
<div class="bg-container">
<?php get_template_part( 'body', 'bottom' ); // load body-bottom.php ?>
<?php get_template_part( 'main', 'bottom' ); // load main-bottom.php ?>
</div>
<?php get_footer(); ?>