<?php get_header();
global $font_awesome;
?>
<div class="bg-container"> 
    <div class="body-top-color"><!----></div>
    <div class="background-color"><!---->
    </div>    
	<div id="main-body">
		<div class="container">
        	<div class="container-pad">
				<?php $side_bar_blog_right= ot_get_option('blog_layout');?> 
                <div class="row-fluid <?php echo $side_bar_blog_right == "left" ? "revert-layout":"";?>">
                    <?php 
                    if($side_bar_blog_right=='full')
                    {
                    ?>               
                    <div class="span12">
                    <?php } else {?>
                    <div class="span9">
                    <?php }?>
                        <!--BEGIN Blog -->
                    <?php 
                    $blog_layout= ot_get_option('blog_style');
					$global_sticky_tag = ot_get_option('sticky_tag_blog');
					$show_readmore = ot_get_option('blog_show_readmore');
					if($global_sticky_tag == '') $global_sticky_tag = esc_html__('STICKY','cactusthemes');
					
                    if($blog_layout=='classic' || $blog_layout=='')
                    {
                    ?>       
                        <div class="blog-listing">
                            <?php if ( have_posts() ) : 
                                // get some options
                                	while ( have_posts() ) : the_post();
										$sticky_tag = get_post_meta(get_the_ID(),'sticky_tag',true);
										if(is_sticky()){
											if($sticky_tag == '') $sticky_tag = $global_sticky_tag;
										}

										if($side_bar_blog_right == 'full'){
											$thumb = 'thumb_467x9999';
										} else {
											$thumb = 'thumb_360x240';
										}
									?>
                                      <div <?php post_class("article"); ?>>
                                        <div class="article-bg">
                                          <div class="article-content">
											<div class="row-fluid">
												<?php $righttoleft= ot_get_option('righttoleft');
												if(has_post_thumbnail()){
												if($righttoleft=='' || $righttoleft==0)	{?>
												<div class="span5">
												  <div class="rt-image">
													<a href="<?php the_permalink();?>" title="<?php echo get_the_title();?>"><?php echo get_the_post_thumbnail(get_the_ID(), $thumb, array('alt' => get_the_title()));?></a>
												  </div>
												</div>
												<?php }}?>
												<div class="span<?php echo (!has_post_thumbnail() ? "12":"7") ?>">
													<div class="post-wrap">
														<div class="rt-headline">
															<h3 class="rt-article-title"> <a href="<?php the_permalink();?>"><?php echo get_the_title();?></a><?php if($sticky_tag){?>
																<i class="bookmark">
																	<?php echo $sticky_tag; ?>
																</i><?php }?></h3>
														</div>
														<div class="rt-articleinfo">                                         
															<!-- Begin Date & Time -->
															<?php 
															$show_authorblog= ot_get_option('blog_show_author');
															if($show_authorblog=='1'|| $show_authorblog=='')
															{
															?>
																<span class="author"><span class="icon-user <?php echo $font_awesome==4?'fa fa-user':''; ?>"><?php the_author_posts_link(); ?></span></span> 
															<!-- End Date & Time -->                                         
															<!-- Begin Comments -->                                        
															 <?php }
															$show_dateblog= ot_get_option('blog_show_date');
															if($show_dateblog=='1'|| $show_dateblog=='')
															{
															?>
															|
																<span class="rt-date-posted"><span class="icon-calendar <?php echo $font_awesome==4?'fa fa-calendar':''; ?>"><?php echo date_i18n(get_option('date_format')  ,get_the_time('U'));?></span></span> 
															<!-- End Date & Time -->                                         
															<!-- Begin Comments -->                                        
															  <?php 
															 }
															$show_cmblog= ot_get_option('blog_show_comment_number');
															if($show_cmblog=='1'|| $show_cmblog=='')
															{
															 ?>
															|
															<span class="rt-comment-block "> 
                                                       
															  <a href="<?php comments_link(); ?>" class="rt-comment-text"> <span class="icon-comments <?php echo $font_awesome==4?'fa fa-comments':''; ?>"><?php echo get_comments_number(get_the_ID()) . ' ' . esc_html__('comments','cactusthemes');?></span> </a> 
															</span> 
															<?php }?>                                       
															<!-- End Comments -->                                         
														</div>
														<div class="recentpost-content">
															<?php echo strip_tags(get_the_excerpt());?>
															<?php if(!isset($show_readmore) || $show_readmore){?>
                                                            <a class="readmore" href="<?php the_permalink(); ?>"><?php echo esc_html__('&rsaquo; Read more','cactusthemes');?></a>
															<?php }?>
														</div>
													<?php 
													$show_tagblog= ot_get_option('blog_show_tag');
													if($show_tagblog=='1'|| $show_tagblog=='')
													{
														$posttags = get_the_tags();
														if ($posttags) {?>
														  <div class="post-tags">
															<i class="icon-tag <?php echo $font_awesome==4?'fa fa-tag':''; ?>" style="margin-right:3px;"></i>
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
														<?php } 
													}
													?>
													<?php 
													$show_cat = ot_get_option('blog_show_cat');
													if($show_cat == '1' || $show_cat =='')
													{
														$cats = get_the_category();
														$separator = ', ';
														$output = '';
														if ($cats) {?>
														  <div class="post-cats post-tags">
															<i class="icon-bookmark <?php echo $font_awesome==4?'fa fa-bookmark':''; ?>" style="margin-right:3px;"></i>
															<?php
																$i = 0;
															  foreach($cats as $cat) {
																$output .= '<a href="'.get_category_link( $cat->term_id ).'" title="' . esc_attr( sprintf( esc_html__( "View all posts in %s", 'cactusthemes'), $cat->name ) ) . '">'.$cat->cat_name.'</a>'.$separator;
															  }
															  
															  echo trim($output, $separator);
															?>
														  </div>
														<?php } 
													}
													?>
													</div>
													<!-- end post wrap -->
												</div> <!-- end span7 -->
                                                <?php if($righttoleft=='1')	{?>
												<div class="span5">
												  <div class="rt-image">
													<a href="<?php the_permalink();?>" title="<?php echo get_the_title();?>"><?php echo get_the_post_thumbnail(get_the_ID(), $thumb, array('alt' => get_the_title()));?></a>
												  </div>
												</div>
												<?php }?>
											</div> <!-- end row-fluid -->
                                          </div>
                                        </div>
                                      </div>
                                      <!-- end article -->
    
                                    <div class="double-dotted"><div class="inner"><!-- --></div></div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    <?php 
					}elseif($blog_layout=='wide'){?>
                        <div class="blog-listing wide_style">
                            <?php if ( have_posts() ) : 
                                // get some options
                                	while ( have_posts() ) : the_post();
										$sticky_tag = get_post_meta(get_the_ID(),'sticky_tag',true);
									?>
                                      <div class="article <?php post_class(); ?>">
                                        <div class="article-bg">
                                          <div class="article-content">
                                            <?php if(has_post_thumbnail()){?>
											<div class="row-fluid">
												<div class="span12">
												  <div class="rt-image">
													<a href="<?php the_permalink();?>" title="<?php echo get_the_title();?>"><?php echo get_the_post_thumbnail(get_the_ID(), 'full', array('alt' => get_the_title()));?></a>
												  </div>
												</div>
											</div>
                                            <?php }?>
											<div class="row-fluid">
												<div class="span12 post-wrap">
												  <div class="rt-headline">
													<h3 class="rt-article-title"> <a href="<?php the_permalink();?>"><?php echo get_the_title();?></a><?php if($sticky_tag){?>
													<i class="bookmark">
													<?php
														echo $sticky_tag;
													?>
													</i><?php }?></h3>
												  </div>
												  <div class="rt-articleinfo">                                         
													<!-- Begin Date & Time -->
													<?php 
													$show_authorblog= ot_get_option('blog_show_author');
													if($show_authorblog=='1'|| $show_authorblog=='')
													{
													?>
														<span class="rt-date-posted"><span class="icon-user <?php echo $font_awesome==4?'fa fa-user':''; ?>"><?php the_author_posts_link(); ?></span></span> 
													<!-- End Date & Time -->                                         
													<!-- Begin Comments -->                                        
													 <?php }
													$show_dateblog= ot_get_option('blog_show_date');
													if($show_dateblog=='1'|| $show_dateblog=='')
													{
													?>
													|
														<span class="rt-date-posted"><span class="icon-calendar <?php echo $font_awesome==4?'fa fa-calendar':''; ?>"><?php echo date_i18n(get_option('date_format') ,get_the_time('U'));?></span></span> 
													<!-- End Date & Time -->                                         
													<!-- Begin Comments -->                                        
													  <?php }
													$show_cmblog= ot_get_option('blog_show_comment_number');
													if($show_cmblog=='1'|| $show_cmblog=='')
													{
													 ?>
													|
													<div class="rt-comment-block "> 
                                                    
													  <a href="<?php comments_link(); ?>" class="rt-comment-text"> <span class="icon-comments <?php echo $font_awesome==4?'fa fa-comments':''; ?>"><?php echo get_comments_number(get_the_ID()) . ' ' . esc_html__('comments','cactusthemes');?></span> </a> 
													</div> 
													<?php }?>                                       
													<!-- End Comments -->                                         

												  </div>
												  <div class="recentpost-content">
													<?php echo strip_tags(get_the_excerpt());?>
                                                    <?php if(!isset($show_readmore) || $show_readmore){?>
                                                            <a class="readmore" href="<?php the_permalink(); ?>"><?php echo esc_html__('&rsaquo; Read more','cactusthemes');?></a>
															<?php }?>
												  </div>
													 <?php 
													$show_tagblog= ot_get_option('blog_show_tag');
													if($show_tagblog=='1'|| $show_tagblog=='')
													{
														$posttags = get_the_tags();
														if ($posttags) {?>
														  <div class="post-tags">
															<i class="icon-tags <?php echo $font_awesome==4?'fa fa-tags':''; ?>"></i>
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
														<?php } }?>
														
														<?php 
													$show_cat = ot_get_option('blog_show_cat');
													if($show_cat == '1' || $show_cat =='')
													{
														$cats = get_the_category();
														$separator = ', ';
														$output = '';
														if ($cats) {?>
														  <div class="post-cats post-tags">
															<i class="icon-bookmark <?php echo $font_awesome==4?'fa fa-bookmark':''; ?>" style="margin-right:3px;"></i>
															<?php
																$i = 0;
															  foreach($cats as $cat) {
																$output .= '<a href="'.get_category_link( $cat->term_id ).'" title="' . esc_attr( sprintf( esc_html__( "View all posts in %s" ), $cat->name ) ) . '">'.$cat->cat_name.'</a>'.$separator;
															  }
															  
															  echo trim($output, $separator);
															?>
														  </div>
														<?php } 
													}
													?>
												</div>
											</div>
                                            <!-- end post wrap -->
                                          </div>
                                        </div>
                                      </div>
                                      <!-- end article -->
                                    <div class="double-dotted"><div class="inner"><!-- --></div></div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
					<?php 
					}else
					if($blog_layout=='modern'){
						wp_enqueue_script( 'jquery-isotope');
						?>
 						<div class="blog-listing blog-listing-modern">
                            <?php if ( have_posts() ) : 
                                // get some options
                                	while ( have_posts() ) : the_post();
										$sticky_tag = get_post_meta(get_the_ID(),'sticky_tag',true);
									?>
                                    <div class="item <?php post_class(); ?>">
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
                                                <h3 class="rt-article-title"> <a href="<?php the_permalink();?>"><?php echo get_the_title();?></a><?php if($sticky_tag){?>
                                                <i class="bookmark">
                                                <?php
                                                    echo $sticky_tag;
                                                ?>
                                                </i><?php }?></h3>
                                              </div>
                                              <div class="dotted"><div class="inner"></div></div>
                                              <div class="rt-articleinfo">                                         
                                                <!-- Begin Date & Time -->
                                                <?php 
												$show_authorblog= ot_get_option('blog_show_author');
												if($show_authorblog=='1'|| $show_authorblog=='')
												{
													$author_cut= get_the_author();
													$demsl= strlen($author_cut);
													if($demsl>13){
														$author_cut = substr($author_cut,0,12) ;
														?>
                                                    	<span class="rt-date-posted"><span class="icon-user <?php echo $font_awesome==4?'fa fa-user':''; ?>"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo $author_cut;?> ...</a></span></span> 	
													<?php }else{ ?>
														<span class="rt-date-posted"><span class="icon-user <?php echo $font_awesome==4?'fa fa-user':''; ?>"><?php the_author_posts_link(); ?></span></span> 	
													<?php }?>
                                                <!-- End Date & Time -->                                         
                                                <!-- Begin Comments -->                                        
                                                 <?php }
												$show_dateblog= ot_get_option('blog_show_date');
												if($show_dateblog=='1'|| $show_dateblog=='')
												{
												?>
                                                |
                                                	<span class="rt-date-posted"><span class="icon-calendar <?php echo $font_awesome==4?'fa fa-calendar':''; ?>"><?php echo date_i18n(get_option('date_format')  ,get_the_time('U'));?></span></span> 
                                                <!-- End Date & Time -->                                         
                                                <!-- Begin Comments -->                                        
                                                  <?php }
												$show_cmblog= ot_get_option('blog_show_comment_number');
												if($show_cmblog=='1'|| $show_cmblog=='')
												{
												 ?>
                                                <div class="rt-comment-block "> 
                                                  <a href="<?php comments_link(); ?>" class="rt-comment-text"> <span class="icon-comments <?php echo $font_awesome==4?'fa fa-comments':''; ?>"><?php echo get_comments_number(get_the_ID()) . ' ' . esc_html__('comments','cactusthemes');?></span> </a> 
                                                </div> 
                                                <?php }?>                                       
                                                <!-- End Comments -->                                         

                                              </div>
                                              <div class="recentpost-content">
                                                <?php echo strip_tags(get_the_excerpt());?>
                                                <?php if(!isset($show_readmore) || $show_readmore){?>
                                                            <a class="readmore" href="<?php the_permalink(); ?>"><?php echo esc_html__('&rsaquo; Read more','cactusthemes');?></a>
															<?php }?>
                                              </div>
                                                 <?php 
												$show_tagblog= ot_get_option('blog_show_tag');
												if($show_tagblog=='1')
												{
													$posttags = get_the_tags();
													if ($posttags) {?>
													  <div class="post-tags">
														<i class="icon-tags <?php echo $font_awesome==4?'fa fa-tags':''; ?>"></i>
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
												  	<?php } }?>
													
													<?php 
													$show_cat = ot_get_option('blog_show_cat');
													if($show_cat == '1' || $show_cat =='')
													{
														$cats = get_the_category();
														$separator = ', ';
														$output = '';
														if ($cats) {?>
														  <div class="post-cats post-tags">
															<i class="icon-bookmark <?php echo $font_awesome==4?'fa fa-bookmark':''; ?>" style="margin-right:3px;"></i>
															<?php
																$i = 0;
															  foreach($cats as $cat) {
																$output .= '<a href="'.get_category_link( $cat->term_id ).'" title="' . esc_attr( sprintf( esc_html__( "View all posts in %s" ), $cat->name ) ) . '">'.$cat->cat_name.'</a>'.$separator;
															  }
															  
															  echo trim($output, $separator);
															?>
														  </div>
														<?php } 
													}
													?>
                                            </div>
                                            <!-- end post wrap -->
                                            <div class="clear"><!-- --></div>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- end article -->
                                      </div>
                                    <!--<div class="double-dotted"><div class="inner"></div></div>-->
                                <?php endwhile; ?>
                            <?php endif; ?>
                    </div>
                    <script>
					jQuery(document).ready(function(e) {
//                        var container = document.querySelector('.blog-listing');
//						var msnry = new Masonry( container, {
//						  // options
//						  columnWidth:289,
//						  itemSelector: '.item',
//						  "gutter": 1
//						});
//                    });
					jQuery(function(){
					  
					  var container = jQuery('.blog-listing');
					  
					  jQuery(container).isotope({
						itemSelector: '.item'
					  });
					  
					});
					});
					</script>
					<?php }?>					
 
                        <!-- END Blog -->
					<?php 
						$pagination = ot_get_option('pagination');
						if(!isset($pagination) || $pagination == 'default' || !function_exists('wp_pagenavi')){
							cactusthemes_content_nav('paging');
						} else {
							wp_pagenavi();
						}
					?>
                    </div>
					 <?php 
                    
					if($side_bar_blog_right=='full')
					{
						echo '<style typ="text/css" scoped="scoped">
						.blog-listing-modern{padding-left:7px}
						</style>
						';
					} else {                    
                    ?>
                    <div class="span3">
                        <div id="mainsidebar">
                        <?php if(is_active_sidebar('blog_sidebar')) {
							echo get_dynamic_sidebar('blog_sidebar');
							}else{
							echo get_dynamic_sidebar('main_sidebar');
							}?>
                        </div>
                    </div>
					<?php }?>
                </div>
            </div>
		</div>
	</div>	
	<?php get_template_part( 'body', 'bottom' ); // load body-bottom.php ?>
	<?php get_template_part( 'main', 'bottom' ); // load main-bottom.php ?>
</div>
<?php get_footer(); ?>