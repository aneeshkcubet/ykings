<?php get_header(); global $post;?>
<?php  
    tfuse_shortcode_content('before');
    $image = tfuse_page_options('header_image');
    //get goals percentage
    $goals = tfuse_page_options('content_tabs_table');
?>
<?php if(!empty($image)):?>
<?php
    //get difficulties tags
    $level = wp_get_post_terms($post->ID,'difficulties');
    $desc = tfuse_page_options('workout_desc');
?>
    <!-- Page Titles & Slider or image -->
    <section class="main-row main-row-slim">
        <div class="main-header">
            <!-- Loading Spinner -->
            <div id="spinner" class="spinner">
                <div class="wBall" id="wBall_1">
                    <div class="wInnerBall">
                    </div>
                </div>
                <div class="wBall" id="wBall_2">
                    <div class="wInnerBall">
                    </div>
                </div>
                <div class="wBall" id="wBall_3">
                    <div class="wInnerBall">
                    </div>
                </div>
                <div class="wBall" id="wBall_4">
                    <div class="wInnerBall">
                    </div>
                </div>
                <div class="wBall" id="wBall_5">
                    <div class="wInnerBall">
                    </div>
                </div>
            </div>
            <!--/ Loading Spinner -->

            <!-- Page Header -->
            <div class="page-header invisible" style="background-image: url(<?php echo $image;?>);">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php if(!empty($level)):?>
                                <div class="page-title-before invisible" data-animate-in="fadeInLeft">
                                    <?php _e('workout type','tfuse');?>: 
                                    <?php $count = 0; foreach ($level as $diff): $count++;?>
                                        <?php echo ($count == count($level)) ? $diff->name : $diff->name . ', ';?>
                                    <?php endforeach;?>
                                </div>
                            <?php endif;?>
                            <h1 class="page-title invisible" data-animate-in="fadeInLeft"><?php echo get_the_title();?></h1>
                            <div class="workout-rating invisible" data-animate-in="fadeInLeft">
                                <span><?php _e('rating','tfuse');?></span>
                                
                                <?php 
                                    $rating_info = get_post_meta($post->ID, TF_THEME_PREFIX . '_rating', true);
                                    
                                    $stars = $rest = $count = 0;
                                    
                                    if(!empty($rating_info))
                                    {
                                        $count = $rating_info['workout-'.$post->ID.'-rating']['count'];
                                        $stars = (int)($rating_info['workout-'.$post->ID.'-rating']['val']/$count);
                                        $rest = ($rating_info['workout-'.$post->ID.'-rating']['val']/$count) - (int)($rating_info['workout-'.$post->ID.'-rating']['val']/$count);
                                        
                                    }
                                    if($rest >= 0.5) $stars += 1;
                                ?>
                                <div class="rating">
                                    <?php for($i = 1; $i <= $stars; $i++):?>
                                        <span class="tficon-star voted"></span>
                                    <?php endfor;?>
                                    <?php for($i = 1; $i <= 5 - $stars; $i++):?>
                                        <span class="tficon-star"></span>
                                    <?php endfor;?>
                                </div>
                                <span><?php echo $count?> <?php _e('votes','tfuse');?></span>
                            </div>
                            <?php if(!empty($desc)):?>
                                <div class="page-desc invisible" data-animate-in="fadeInRight">
                                    <?php echo $desc;?>
                                </div>
                            <?php endif;?>
                            <a href="#calendar_ul" class="btn btn-transparent invisible anchor" data-animate-in="fadeInUp"><span><?php _e('let\'s get started','tfuse');?></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Page Header -->
        </div>
    </section>
    <script>
        jQuery(function($) {
            $('.main-slider, .page-header').prepend('<img src="<?php echo $image;?>" alt="" id="testimage" class="hidden">');
        });
    </script>
    <!--/ Page Titles & Slider or image -->
<?php endif;?>

<?php get_template_part('workouts', 'calendar'); ?>
        
<section class="main-row">
    <div class="container">
        <div class="row">
            <div class="col-md-12 postlist-exercises">
                <div id="exercises" class="section-title-before"><?php _e('Week','tfuse');?> 1, <?php _e('Day','tfuse');?> 1</div>
                <h2 id="exerciseTitle" class="section-subtitle"></h2>
            </div>

            <div class="col-lg-8 col-md-9 postlist-exercises posts_to_display">
                <?php 
                    get_template_part('content','single-workout');
                    wp_reset_query();
                ?>
            </div>

            <div class="col-md-3 col-lg-offset-1">
                <!-- Statistics -->
                <?php 
                    $trainings = tfuse_page_options('content_weeks');
                    $weeks_training = tfuse_page_options('content_weeks');
                    $bodyparts = tfuse_page_options('content_tabs_t','',$weeks_training[0]['tab_day1']);
                ?>
                <?php if(!empty($trainings) && !empty($trainings[0]['tab_day1'])):?>
                    <?php if(!empty($bodyparts)):?>
                        <section class="exercise-stats bodyparts">
                            <h6 class="section-title"><?php _e('bodyparts worked','tfuse');?></h6>
                            <?php foreach($bodyparts as $bodypart):?>
                                <div class="progress-wrap">
                                    <div class="progress-label"><?php echo $bodypart['tab_title']?></div>
                                    <div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="<?php echo (int)$bodypart['tab_percentage'];?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo (int)$bodypart['tab_percentage'];?>%;"></div></div>
                                    <div class="progress-mark clearfix"><span class="pull-left">0%</span><span class="pull-right">100%</span></div>
                                </div>
                            <?php endforeach;?>
                        </section>
                    <?php endif;?>

                    <?php if(!empty($goals)):?>
                        <section class="exercise-stats workout_goals">
                            <h6 class="section-title"><?php _e('workout goals','tfuse');?></h6>
                            <?php foreach($goals as $goal):?>
                                <?php $term = get_term( $goal['tab_title'] , 'goals' );?>
                                <div class="progress-wrap">
                                    <div class="progress-label"><?php echo $term->name;?></div>
                                    <div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="<?php echo (int)$goal['tab_percentage'];?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo (int)$goal['tab_percentage'];?>%;"></div></div>
                                    <div class="progress-mark clearfix"><span class="pull-left">0%</span><span class="pull-right">100%</span></div>
                                </div>
                            <?php endforeach;?>
                        </section>
                    <?php endif;?>
                    <!--/ Statistics -->
                <?php endif;?>
            </div>
        </div>
    </div>
</section>
<!-- Workout Meta -->
<section class="main-row border-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12 workout-meta">
                <a href="#" class="btn btn-transparent" id="goToPrint" ><span><?php _e('print workout','tfuse');?></span></a>

                <!-- Rating Button -->
                <div class="workout-rating rating-button">
                    <div class="inner">
                        <span><?php _e('Rate It','tfuse');?>:</span>
                        <div class="rating rating_bottom" id='workout-<?php echo $post->ID;?>-rating'>
                            <span class="tficon-star " data-vote="1"></span>
                            <span class="tficon-star " data-vote="2"></span>
                            <span class="tficon-star " data-vote="3"></span>
                            <span class="tficon-star " data-vote="4"></span>
                            <span class="tficon-star " data-vote="5"></span>
                        </div>
                        <input type="hidden" name="rate" id="rate" value="">
                    </div>
                </div>
                <!--/ Rating Button -->

            </div>
        </div>
    </div>
</section>
<!--/ Workout Meta -->

<?php if(tfuse_page_options('enable_similar_workouts','',$post->ID)):?>
    <?php
        $posts = tf_get_similar_workouts($post->ID);
    ?>
    <?php if(!empty($posts)):?>
        <!-- Similar Workouts -->
        <section class="main-row border-top">
            <div class="container">
                <div class="row workout-similar">
                    <div class="col-md-12">
                        <h4 class="section-title"><?php _e('check-out similar workouts','tfuse');?>:</h4>
                    </div>
                    <?php foreach($posts as $post):?>
                        <?php 
                            $level = wp_get_post_terms($post->ID,'difficulties');
                            $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));
                        ?>
                        <div class="col-sm-4">
                            <div class="workout">
                                <a href="<?php get_permalink($post->ID);?>">
                                    <?php if(!empty($image)):?>
                                        <div class="workout-image"><a href="<?php the_permalink(); ?>">
                                                <img src="<?php echo $image;?>" style="width:360px; height:202px;" alt="">
                                        </div>
                                    <?php endif;?>
                                    <div class="workout-desc">
                                        <div class="inner">
                                            <h3 class="workout-title"><?php echo get_the_title($post->ID);?></h3>
                                            <?php if(!empty($level)):?>
                                                <div class="workout-subtitle">
                                                    <?php $count = 0; foreach ($level as $diff): $count++;?>
                                                        <?php echo ($count == count($level)) ? $diff->name : $diff->name . ', ';?>
                                                    <?php endforeach;?>
                                                </div>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </section>
        <!--/ Similar Workouts -->
    <?php endif;?>
<?php endif;?>
<?php tfuse_shortcode_content('after'); ?>
<?php get_footer();?>