<?php get_header(); ?>
<?php 
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); 
    $image = tfuse_options('header_img','',$term->term_id);
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
                            <div class="page-desc invisible" data-animate-in="fadeInRight"><?php echo term_description( $term->term_id,'exercises' );?></div>
                            <a href="#postlist-stories" class="btn btn-transparent invisible anchor" data-animate-in="fadeInUp"><span><?php _e('VIEW Exercisess','tfuse');?></span></a>
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
<?php $sidebar_position = tfuse_sidebar_position(); ?>
<?php  tfuse_shortcode_content('before'); ?>
<?php if ($sidebar_position == 'left') : ?>
    <section class="main-row  sidebar-left">
        <div class="container">
            <div class="row">
                <div id="primary" class="col-lg-8 col-sm-8 postlist-exercises">
<?php endif;?>
<?php if ($sidebar_position == 'right') : ?>
    <section class="main-row">
        <div class="container">
            <div class="row">
                <div id="primary" class="col-lg-8 col-sm-8 postlist-exercises">
<?php endif;?>
<?php if ($sidebar_position == 'full') : ?>
    <section class="main-row">
        <div class="container">
            <div class="row">
                <div id="primary" class="col-lg-8 col-sm-8 postlist-exercises">
<?php endif; ?> 
                    <div id="content_load">
                        <?php if (have_posts()) 
                         { $count = 0;
                             while (have_posts()) : the_post(); $count++;
                                 get_template_part('listing', 'exercises');
                             endwhile;
                         } 
                         else 
                         { ?>
                             <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
                   <?php } ?>
                    </div>
                    <?php if(tfuse_options('pagination_type') == 'type2'):?>
                        <div class="row text-center blog">
                           <a href="#" class="btn btn-transparent btn-padding-big" id="ajax_load_posts"><span><?php _e('LOAD MORE','tfuse');?></span></a>
                       </div>
                    <?php endif;?>
                    <?php if(tfuse_options('pagination_type') == 'type1'):?>
                        <div class="blog-pagination">     
                            <?php  tfuse_pagination();?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if (($sidebar_position == 'right') || ($sidebar_position == 'left')) : ?>
                    <div id="secondary" class="col-sm-4 sidebar widget-area">
                        <div class="inner">
                            <?php get_sidebar();?>
                        </div>
                    </div>
                <?php endif; ?>
        </div>
    </div>
</section>
<?php  $id = tfuse_get_cat_id();?>
<input type="hidden" value="<?php echo $id; ?>" name="current_cat"  />
<input type="hidden" value="<?php echo $term->taxonomy;?>" name="is_this_tax"  />
<?php  tfuse_shortcode_content('after'); ?>
<?php get_footer();?>