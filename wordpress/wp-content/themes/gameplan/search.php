<?php 
global $font_awesome;
//$template = ;
//echo "Template: " . $template;
//include get_post_meta( ot_get_option('search_page','search'), '_wp_page_template', true );
//exit();
$sidebar = ot_get_option('blog_layout');
if(ot_get_option('search_page','search')){
	global $post;
	$post = get_page(ot_get_option('search_page','search'));
	$template = get_post_meta( ot_get_option('search_page','search'), '_wp_page_template', true );
	if($template == 'page-templates/full-width.php')
		$sidebar = 'full';
	elseif($template == 'page-templates/sidebar-left.php')
		$sidebar = 'left';
	elseif($template == 'page-templates/sidebar-right.php')
		$sidebar = 'right';
}
get_header();
?>
<div class="bg-container"> 
    <div class="body-top-color"><!----></div>
    <div class="background-color"><!----></div>    
	<div id="main-body">
		<div class="container">
        	<div class="container-pad">
                <div class="row-fluid <?php echo ($sidebar == 'left') ? "revert-layout" : "";?>">
                    <div class="<?php echo ($sidebar == 'full') ? 'span12' : 'span9'?>">
                        <div class="search-list blog-listing">
                            <?php
                                wp_reset_postdata();
                                if(have_posts()){	?>
                                <?php while(have_posts()): the_post(); ?>	
                              <div <?php post_class("article");?>>
                                <div class="article-bg">
                                  <div class="article-content">
                                    <div class="span12">
                                      <div class="rt-headline">
                                        <h3 class="rt-article-title"> <a href="<?php the_permalink();?>"><?php echo get_the_title();?></a><?php if(is_sticky()){?>
                                        <i class="bookmark">
                                        <?php
                                            $tag = get_post_meta(get_the_ID(),'sticky_tag',true);
                                            if($tag != '') $sticky_tag = $tag;
                                            echo $sticky_tag;
                                        ?>
                                        </i><?php }?></h3>
                                      </div>
                                      <div class="rt-articleinfo"> 
                                      <span class="rt-author-posted"><span class="icon-user <?php echo $font_awesome==4?'fa fa-user':''; ?>"><?php echo get_the_author();?></span></span> 
                                        |                                        
                                        <!-- Begin Date & Time --> 
                                        <span class="rt-date-posted"><span class="icon-calendar <?php echo $font_awesome==4?'fa fa-calendar':''; ?>"><?php echo date_i18n(get_option('date_format')  ,get_the_time('U'));?></span></span> 
                                        <!-- End Date & Time -->                                         
                                        <!-- Begin Comments -->                                        
                                        |
                                        <div class="rt-comment-block "> 
                                          <a href="<?php comments_link(); ?>" class="rt-comment-text"> <span class="icon-comments <?php echo $font_awesome==4?'fa fa-comments':''; ?>"><?php echo get_comments_number(get_the_ID()) . ' ' . __('comments','cactusthemes');?></span> </a> 
                                        </div>                                        
                                        <!-- End Comments -->                                         
                                      </div>
                                      <div class="recentpost-content">
                                        <?php echo strip_tags(get_the_excerpt());?>
                                      </div>
                                      <?php 
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
                                      <?php }?>
                                    </div>
                                    <!-- end post wrap -->
                                    <div class="clear"><!-- --></div>
                                  </div>
                                </div>
                              </div>
                              <!-- end article -->

                            <div class="double-dotted"><div class="inner"><!-- --></div></div>
                            <?php endwhile; ?>
                             <?php  
                                    $pagination = ot_get_option('pagination');
                                    if(!isset($pagination) || $pagination == 'default'|| !function_exists('wp_pagenavi') ){
                                        cactusthemes_content_nav('paging');
                                    } else {
                                        wp_pagenavi();
                                    }
                                } else {
                                    echo "<h5>";
                                    echo  _e('No search results for', 'castusthemes');
									echo _e(' "');
									echo get_query_var('s');
                                    echo  _e('"');
                                    echo "</h5>";
                                }
                            ?>
                        </div>
                    </div>
                    <?php if($sidebar != 'full'):?>
                        <div class="span3">
                            <div id="mainsidebar">
                                <?php if(is_active_sidebar('search_sidebar')) {
								echo get_dynamic_sidebar('search_sidebar');
							}else{
								echo get_dynamic_sidebar('main_sidebar');
							}?>
                            </div>
                        </div>
                    <?php endif;?>
                </div>
            </div>
		</div>
	</div>	
	<?php get_template_part( 'body', 'bottom' ); // load body-bottom.php ?>
	<?php get_template_part( 'main', 'bottom' ); // load main-bottom.php ?>
</div>
<?php get_footer(); ?>