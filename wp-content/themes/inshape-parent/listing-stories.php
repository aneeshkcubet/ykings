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
?>
<article class="post clearfix">
    <span class="post-thumbnail">
        <?php if(!empty($image)):?>
            <img src="<?php echo $image;?>" alt="">
        <?php endif;?>
    </span>
    <div class="entry-content">
        <div class="entry-title-before"><?php echo $term->name;?></div>
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title();?></a></h2>
        <p><?php if ( tfuse_options('post_content') == 'content' ) the_content(''); else the_excerpt(); ?></p>
        <a href="<?php the_permalink(); ?>" class="btn btn-transparent"><span><?php _e('Read More','tfuse');?></span></a>
    </div>
</article>