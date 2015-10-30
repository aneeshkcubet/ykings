<?php get_header(); global $TFUSE;  ?>
<?php $sidebar_position = tfuse_sidebar_position(); ?>
<?php  tfuse_shortcode_content('before'); ?>
<?php if ($sidebar_position == 'left') : ?>
    <section class="main-row  sidebar-left">
        <div class="container">
            <div class="row">
                <div id="primary" class="col-sm-8 content-area">
<?php endif;?>
<?php if ($sidebar_position == 'right') : ?>
    <section class="main-row">
        <div class="container">
            <div class="row">
                <div id="primary" class="col-sm-8 content-area">
<?php endif;?>
<?php if ($sidebar_position == 'full') : ?>
    <section class="main-row">
        <div class="container">
            <div class="row">
                <div id="primary" class="col-sm-12 content-area">
<?php endif; ?> 
                    <section class="postlist">
                        <h1><?php _e('Search Page');?></h1>
                            <?php if (have_posts()) 
                             { $count = 0;
                                 while (have_posts()) : the_post(); $count++;
                                     get_template_part('listing', 'search');
                                 endwhile;
                             } 
                             else 
                             { ?>
                                 <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
                       <?php } ?>
                    </section>
                    <?php  tfuse_pagination();?>
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
<?php  tfuse_shortcode_content('after'); ?>
<?php get_footer();?>