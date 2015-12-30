<?php 
global $is_tf_blog_page;
get_header();
if ($is_tf_blog_page) die(); 
?>
<?php $sidebar_position = tfuse_sidebar_position(); ?>
<?php tfuse_shortcode_content('before');?>
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
<?php if($post->post_content == ''){?>
    <section class="main-row" style="display:none;">
    </section>
<?php }
else if (have_posts()): while (have_posts()): the_post(); ?>
<?php if ($sidebar_position == 'full') : ?>
    <?php echo '<section class="main-row">'; ?>
        <div class="container">
            <div class="row">
                <div id="primary" class="col-sm-12 content-area">
<?php endif; ?> 
                    <article class="post post-details shortcodes">
                            <?php if(!tfuse_page_options('hide_title')):?>
                                <div class="entry-header">
                                    <h1 class="entry-title"><?php echo get_the_title();?></h1>
                                </div>
                            <?php endif;?>
                            
                            <div class="entry-content">
                                <?php // while ( have_posts() ) : the_post();?>   
                                    <?php the_content(); ?>
                                <?php //break; endwhile; // end of the loop. ?>
                            </div>
                           
                        </article>
                            <?php if ( comments_open() ) : ?>
                                <?php tfuse_comments(); ?>
                            <?php endif;?>
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
<?php echo '</section>' ; ?>
<?php endwhile; endif;?>
<?php tfuse_shortcode_content('after'); ?>
<?php get_footer();?>