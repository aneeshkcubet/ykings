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
    
//get difficulties tags
$level = wp_get_post_terms($post->ID,'difficulties'); 
//get durations tags
$durations = wp_get_post_terms($post->ID,'durations'); 
//get goals tags
$goals = wp_get_post_terms($post->ID,'goals');

$desc = tfuse_page_options('workout_desc');
    
$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));
?>
<li class="workout-item isotope" 
    <?php if(!empty($level)):?>
        data-difficulty="<?php foreach ($level as $diff):?>
                            <?php echo str_replace(' ','_',$diff->name);?>
                        <?php endforeach;?>"
    <?php endif;?>
            
    <?php if(!empty($durations)):?>
        data-duration="<?php foreach ($durations as $duration):?>
                            <?php echo str_replace(' ','_',$duration->name);?>
                        <?php endforeach;?>"
    <?php endif;?>
    <?php if(!empty($goals)):?>
        data-goal="<?php foreach ($goals as $goal):?>
                        <?php echo str_replace(' ','_',$goal->name);?>
                    <?php endforeach;?>"
    <?php endif;?>
>
    <?php if(!empty($image)):?>
        <div class="workout-image"><a href="<?php the_permalink(); ?>"><span><?php _e('View Details','tfuse');?></span>
                <img src="<?php echo TF_GET_IMAGE::get_src_link($image, 200, 200);?>" alt=""></a>
        </div>
    <?php endif;?>
    <?php if(!empty($level)):?>
        <div class="workout-title-before">
            <?php $count = 0; foreach ($level as $diff): $count++;?>
                <?php echo ($count == count($level)) ? $diff->name : $diff->name . ', ';?>
            <?php endforeach;?>
        </div>
    <?php endif;?>
    <h4 class="workout-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title();?></a></h4>
    <?php if(!empty($desc)):?>
        <div class="workout-desc"><p><?php echo $desc;?></p></div>
    <?php endif;?>
    <a href="<?php the_permalink(); ?>" class="btn btn-small btn-black btn-transparent"><span><?php _e('VIEW Workout','tfuse');?></span></a>
</li>