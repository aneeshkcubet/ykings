 <?php
/**
 * The template for displaying content in the single.php template.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since In Shape 1.0
 */

$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));
$img_pos = tfuse_page_options('single_img_position');

$rounded = tfuse_page_options('rounded');
$desc = tfuse_page_options('post_desc');

if($img_pos && $rounded) $image = TF_GET_IMAGE::get_src_link($image, 270, 270);
elseif ($img_pos && !$rounded) $image = TF_GET_IMAGE::get_src_link($image, 270, 380);

if($post->post_type == 'exercise') $video = tfuse_page_options('video_links');
?>
<div class="entry-meta">
    <time class="entry-date" datetime="<?php echo get_the_date(); ?>"><?php echo get_the_date(); ?></time>
    <span class="author"> <?php _e('by','tfuse');?> <a href="#"><?php the_author_posts_link() ?></a></span>
    <span class="cat-links"> <?php _e('in ','tfuse');?><?php echo tfuse_cat_links($post->post_type,$post->ID);?></span>
</div>
<div class="entry-meta">
    <h1 class="entry-title"><?php echo get_the_title();?></h1>
    <a href="#comments" class="comments-link anchor"><span><?php comments_number('0','1','%'); ?></span></a>
    <?php if(!empty($desc)):?>
        <div class="entry-desc">
            <p><?php echo $desc;?></p>
        </div>
    <?php endif;?>
</div>

<?php if($post->post_type == 'exercise'):?>
    <?php if(!empty($image)):?>
        <?php if(!empty($video)):?>
            <?php
                $size = tfuse_page_options('video_dimensions');
            ?>
            <?php  preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $video, $video_id);
                if(!empty($video_id)) 
                    echo  '<span class="post-thumbnail"><iframe src="http://www.youtube.com/embed/'.$video_id[0].'?wmode=transparent" height="'.$size[1].'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen style="width:'.$size[0].'px"></iframe></span>';
                elseif(strpos($video, 'vimeo'))
                {
                    echo '<span class="post-thumbnail"><iframe src="http://player.vimeo.com/video/' . substr($video, 17, 8) . '?title=0&amp;byline=0&amp;portrait=0" height="'.$size[1].'" frameborder="0" style="width:'.$size[0].'px"></iframe></span>';
                }
                else echo '<span class="post-thumbnail"><iframe src="'.$video.'" height="'.$size[1].'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen style="width:'.$size[0].'px"></iframe></span>';
         ?>
        <?php else:?>
            <span class="post-thumbnail"><img src="<?php echo $image;?>" alt=""></span>
        <?php endif;?>
    <?php endif;?>
<?php else:?>
    <?php if(!empty($image)):?>
        <span class="post-thumbnail <?php echo $img_pos;?> <?php echo ($rounded) ? 'rounded' : '';?>"><img src="<?php echo $image;?>" alt=""></span>
    <?php endif;?>
<?php endif;?>
        
<div class="entry-content clearfix">
    <?php the_content(); ?> 
</div>