<?php  get_header();?>
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
<?php if ($sidebar_position == 'full') : ?>
    <section class="main-row">
        <div class="container">
            <div class="row">
                <div id="primary" class="col-sm-12 content-area">
<?php endif; ?> 
                    <article class="post post-details shortcodes">
                        <?php if(!tfuse_page_options('hide_title')):?>
                            <div class="entry-header">
                                <h1 class="entry-title"><?php _e('Page 404','tfuse');?></h1>
                            </div>
                        <?php endif;?>
                        <div class="entry-content">
                            <p><?php _e('Page not found', 'tfuse') ?></p>
                            <p><?php _e('The page you were looking for doesn&rsquo;t seem to exist', 'tfuse') ?>.</p>
                        </div>
                    </article>
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
<?php tfuse_shortcode_content('after'); ?>
<?php get_footer();?>