<?php get_header(); global $post;?>
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
                    <article class="post post-details">
                            <?php  while ( have_posts() ) : the_post();?>
                                    <?php get_template_part('content','single');?>
                            <?php endwhile; // end of the loop. ?> 
                    </article>
                    <?php $tags = tfuse_tags_links($post->post_type,$post->ID); 
                        if (!empty($tags)):?>
                        <section class="widget widget-tagcloud">
                            <div class="tagcloud"><?php echo $tags;?></div>
                        </section>
                    <?php endif;?>
                    
                    <?php get_template_part('content','author'); ?>
                    
                    <section class="clearfix">
                        <?php if(tfuse_options('post_share')):?>
                            <div class="social-links">
                                <a class="link-twitter" href="https://twitter.com/share?url=<?php echo get_permalink(); ?>" target="_blank"><span><?php _e('Tweet','tfuse'); ?></span></a>
                                <a class="link-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank"><span><?php _e('Share','tfuse'); ?></span></a>
                                <a class="link-pinterest" href="http://www.pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>" target="_blank"><span><?php _e('Pin it','tfuse'); ?></span></a>
                            </div>
                        <?php endif;?>
                        <?php custom_wp_link_pages(); ?>
                    </section>
                    
                    <section class="blog-post-navigation clearfix">
                        <?php previous_post_link( '%link','<i class="tficon-chevron-left-alt"></i><span>'.__('Previous Story','tfuse').'</span>%title' ); ?>
                        <?php next_post_link( '%link', '<i class="tficon-chevron-right-alt"></i><span>'.__('Next Story','tfuse').'</span>%title' ); ?>
                    </section>
                    
                    <?php tfuse_show_similar_posts($post->ID,$post->post_type); ?>
                    
                    <?php if ( comments_open() ) : ?>
                        <?php  tfuse_comments(); ?>
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
</div>
<?php tfuse_shortcode_content('after'); ?>
<?php get_footer();?>