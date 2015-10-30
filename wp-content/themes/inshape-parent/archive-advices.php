<?php get_header(); ?>
<?php 
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); 
    $image = tfuse_options('header_img','',$term->term_id);
    $items = get_option('posts_per_page');
?>
<?php if(!empty($image)):?>
    <section class="main-row main-row-slim">
        <div class="main-header main-header-blog">
            <!-- Loading Spinner -->
            <div id="spinner" class="spinner">
                <div class="wBall" id="wBall_1">
                    <div class="wInnerBall">
                    </div>
                </div>
                <div class="wBall" id="wBall_2">
                    <div class="wInnerBall">
                    </div>
                </div>
                <div class="wBall" id="wBall_3">
                    <div class="wInnerBall">
                    </div>
                </div>
                <div class="wBall" id="wBall_4">
                    <div class="wInnerBall">
                    </div>
                </div>
                <div class="wBall" id="wBall_5">
                    <div class="wInnerBall">
                    </div>
                </div>
            </div>
            <!--/ Loading Spinner -->

            <!-- Page Header -->
            <div class="page-header invisible" style="background-image: url(<?php echo $image;?>);">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-before invisible" data-animate-in="fadeInLeft"><?php echo tfuse_options('header_title_bef','',$term->term_id)?></div>
                            <h1 class="page-title invisible" data-animate-in="fadeInLeft"><?php echo tfuse_options('header_title','',$term->term_id)?></h1>
                            <div class="page-desc invisible" data-animate-in="fadeInRight"><?php echo term_description( $term->term_id,'nutrition' );?></div>
                            <a href="#postlist-services" class="btn btn-transparent invisible anchor" data-animate-in="fadeInUp"><span><?php _e('VIEW NUTRITION ADVICE','tfuse');?></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Page Header -->
        </div>
    </section>
    <script>
    jQuery(function($) {
            jQuery('.main-slider, .page-header').prepend('<img src="<?php echo $image;?>" alt="" id="testimage" class="hidden">');
        });
    </script>
<?php endif;?>
<?php  tfuse_shortcode_content('before'); ?>
<section class="main-row">
    <div id="postlist-services" class="postlist-services">
        <div class="container">
            <div class="row"  id="content_load">
            <?php if (have_posts()) 
             { $count = 0;
                 while (have_posts()) : the_post(); 
                        get_template_part('listing','advices');
                    $count++;
                 endwhile;
             } 
             else 
             { ?>
                 <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
       <?php } ?>
            </div>
        </div>
        <?php if(tfuse_options('pagination_type') == 'type2'):?>
            <div class="row text-center">
               <a href="#" class="btn btn-transparent btn-padding-big" id="ajax_load_posts"><span><?php _e('LOAD MORE','tfuse');?></span></a>
           </div>
        <?php endif;?>
    </div>
</section>
<?php if(tfuse_options('pagination_type') == 'type1'):?>
    <div class="services-pagination">
        <?php  tfuse_pagination();?>
    </div>
<?php endif;?>
<?php  tfuse_shortcode_content('after'); ?>
<?php  $id = tfuse_get_cat_id();?>
<input type="hidden" value="<?php echo $id; ?>" name="current_cat"  />
<input type="hidden" value="<?php echo $term->taxonomy;?>" name="is_this_tax"  />
<?php get_footer();?>