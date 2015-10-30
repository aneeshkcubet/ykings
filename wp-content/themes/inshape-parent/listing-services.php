<?php
/**
 * The template for displaying posts on archive pages.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Gamezone 1.0
 */
 global $more,$post;
    $more = apply_filters('tfuse_more_tag',0);
    
$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));


$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));

$link = tfuse_page_options('app_link');

?>
<div class="col-sm-4">
    <article class="post">
        <div class="entry-content">
            <div class="entry-title-before"><?php echo $term->name;?></div>
            <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title();?></a></h3>
            <?php if ( tfuse_options('post_content') == 'content' ) the_content(''); else the_excerpt(); ?>
        </div>
        <a href="<?php the_permalink(); ?>" class="post-thumbnail"><span><?php _e('View Details','tfuse');?></span>
            <?php if(!empty($image)):?>
                <img src="<?php echo $image;?>" alt="">
            <?php endif;?>
        </a>
        <?php if(!empty($link)):?>
            <footer class="entry-meta clearfix">
                <a href="<?php echo $link;?>" class="btn btn-small btn-transparent btn-black pull-left"><span><?php _e('MAKE appointment','tfuse');?></span></a>
            </footer>
        <?php endif;?>
    </article>
</div>