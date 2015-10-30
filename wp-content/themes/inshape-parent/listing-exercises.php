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
$reps = tfuse_page_options('reps');
$video = tfuse_page_options('video_links');

?>
<!-- Exercise -->
<article class="post clearfix">
    
    <?php if(!empty($video)):?>
        <div class="post-thumbnail video">
            <?php if(!empty($image)):?>
                <a data-rel="prettyPhoto" title="<?php echo get_the_title();?>" href="<?php echo $video;?>">
                <img src="<?php echo $image;?>" alt=""></a>
            <?php else:?>
                <?php 
                    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $video, $video_id);
                    if(!empty($video_id)) echo  '<iframe src="http://www.youtube.com/embed/'.$video_id[0].'?wmode=transparent" width="560" height="332" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                    else echo '<iframe src="'.$video.'" width="560" height="332" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                ?>
            <?php endif;?>
        </div>
    <?php else:?>
        <?php if(!empty($image)):?>
            <div class="post-thumbnail"><img src="<?php echo $image;?>" alt=""></div>
        <?php endif;?>
    <?php endif;?>
 
    <div class="entry-content">
        <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title();?></a></h4>
        <p><?php if ( tfuse_options('post_content') == 'content' ) the_content(''); else the_excerpt(); ?></p>
        <?php if(!empty($reps)):?>
            <footer class="entry-meta">
                <i class="tficon-clock"></i><?php echo $reps;?>
            </footer>
        <?php endif;?>
    </div>
</article>
<!--/ Exercise -->