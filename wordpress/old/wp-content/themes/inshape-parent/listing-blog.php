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
    
$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));
$img_pos = tfuse_page_options('single_img_position');

$rounded = tfuse_page_options('rounded');

$position = tfuse_page_options('img_pos');

if($img_pos && $rounded) $image = TF_GET_IMAGE::get_src_link($image, 270, 270);
elseif ($img_pos && !$rounded) $image = TF_GET_IMAGE::get_src_link($image, 270, 380);

$post_date = get_the_date();
$time = strtotime($post_date);

?>
<?php //echo TF_GET_IMAGE::get_src_link($image, 270); ?>

<article class="post clearfix <?php echo (is_sticky()) ? 'is_sticky' : '';?>">
    <?php if($position == 'before'):?>
            <?php if(!empty($image)):?>
                <span class="post-thumbnail <?php echo $img_pos;?>  <?php echo ($rounded) ? 'rounded' : '';?>"><img src="<?php echo $image;?>" alt=""></span>
            <?php endif;?>
        <?php endif;?>
    <div class="entry-meta">
        <time class="entry-date" datetime="<?php echo  date('Y-m-d',$time).'T'.date('g:i:s',$time) ?>"><?php echo get_the_date(); ?></time>
        <span class="author"> <?php _e('by','tfuse');?> <?php the_author_posts_link() ?></span>
        <span class="cat-links"> <?php _e('in','tfuse');?> <?php echo tfuse_cat_links($post->post_type,$post->ID);?></span>
    </div>
    <div class="entry-content">
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title();?></a></h2>
        <?php if($position != 'before'):?>
            <?php if(!empty($image)):?>
                <span class="post-thumbnail <?php echo $img_pos;?> <?php echo ($rounded) ? 'rounded' : '';?>"><img src="<?php echo $image;?>" alt=""></span>
            <?php endif;?>
        <?php endif;?>
        <?php if ( tfuse_options('post_content') == 'content' ) the_content(''); else the_excerpt(); ?>
    </div>
    <footer class="entry-meta clearfix">
        <a href="<?php the_permalink(); ?>" class="btn btn-small btn-transparent"><span><?php _e('find out more','tfuse');?></span></a>
        <a href="<?php the_permalink(); ?>#comments" class="comments-link"><span><?php comments_number('0','1','%'); ?></span></a>
    </footer>
    <span id="post-<?php the_ID(); ?>" <?php post_class(); ?>></span>
</article>
