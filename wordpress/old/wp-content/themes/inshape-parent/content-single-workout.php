<?php 
$the_query = tf_get_game_images_posts($post->ID);

if ($the_query->have_posts()) 
{ 
    $count = 0;
    while ( $the_query->have_posts() ) : $the_query->the_post(); $count++;
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
                <div class="entry-title-before"><?php _e('Exercise no','tfuse');?>. <?php echo $count;?></div>
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

    <?php
    endwhile; // end of the loop. 
}
else 
{ ?>
        <h1><?php _e('Rest Day', 'tfuse'); ?></h1>
<?php } 