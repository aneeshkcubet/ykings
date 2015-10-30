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

        <!-- Main Slider -->
        <div id="workout-slider" class="main-slider workout-slider carousel slide fade-effect invisible">
            <!-- Carousel items -->
            <div class="carousel-inner">
                <?php $count = 0; foreach ($view_variables['slides'] as $slide):?>
                    <!-- Item -->
                    <section class="<?php echo ($count == 0) ? 'active' : '';?> item" style="background-image: url(<?php echo $slide['slide_src'];?>);">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-title-before" data-animate-in="fadeInDown" data-animate-out="fadeOutUp"><?php _e('FEATURED WORKOUT','tfuse')?></div>
                                    <h1 class="page-title" data-animate-in="fadeInDown" data-animate-out="fadeOutUp"><?php echo $slide['slide_title'];?></h1>
                                </div>
                            </div>
                            <div class="row" data-animate-in="fadeInUpSmall" data-animate-out="fadeOutDownSmall">
                                
                                <div class="col-sm-4 col-lg-offset-1">
                                    <?php if(!empty($slide['slide_left_column'])):?>
                                        <div class="text-left">
                                            <?php echo $slide['slide_left_column'];?>
                                        </div>
                                    <?php endif;?>
                                </div>
                                
                                <div class="col-sm-4 col-lg-2">
                                    <div class="workout-rating">
                                        <span><?php _e('workout rating','tfuse');?></span>
                                        <?php 
                                            $rating_info = get_post_meta($slide['slide_id'], TF_THEME_PREFIX . '_rating', true);

                                            $stars = $rest = $count = 0;

                                            if(!empty($rating_info))
                                            {
                                                $count = $rating_info['workout-'.$slide['slide_id'].'-rating']['count'];
                                                $stars = (int)($rating_info['workout-'.$slide['slide_id'].'-rating']['val']/$count);
                                                $rest = ($rating_info['workout-'.$slide['slide_id'].'-rating']['val']/$count) - (int)($rating_info['workout-'.$slide['slide_id'].'-rating']['val']/$count);

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
                                        <span><?php _e('from','tfuse');?> <?php echo $count?> <?php _e('votes','tfuse');?></span>
                                    </div>
                                </div>
                                
                                <div class="col-sm-4">
                                    <?php if(!empty($slide['slide_right_column'])):?>
                                        <div class="text-right">
                                            <?php echo $slide['slide_right_column'];?>
                                        </div>
                                    <?php endif;?>
                                </div>
                                
                                <div class="col-sm-12">
                                    <a href="<?php echo $slide['slide_url'];?>" class="btn"><span><?php _e('VIEW more details','tfuse');?></span></a>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--/ Item -->
                <?php $count++; endforeach;?>
            </div>
            <!-- Carousel indicators -->
            <ol class="carousel-indicators">
                <?php for($i = 0; $i < count($view_variables['slides']); $i++):?>
                    <li data-target="#workout-slider" data-slide-to="<?php echo $i;?>" class="<?php echo ($i == 0) ? 'active' : '';?>"></li>
                <?php endfor;?>
            </ol>
            <!-- Carousel nav -->
            <a class="carousel-control left invisible" data-animate-in="fadeInLeft" data-animate-out="fadeOutLeft" href="#workout-slider" data-slide="prev"><i class="tficon-chevron-left-alt"></i></a>
            <a class="carousel-control right invisible" data-animate-in="fadeInRight" data-animate-out="fadeOutRight" href="#workout-slider" data-slide="next"><i class="tficon-chevron-right-alt"></i></a>
        </div>
        <!--/ Main Slider -->
    </div>
</section>
<!--/ Page Titles & Slider or image -->
<script>
    jQuery(function($) {
        $('.main-slider, .page-header').prepend('<img src="<?php echo $slide['slide_src'];?>" alt="" id="testimage" class="hidden">');
    });
    jQuery(window).load(function() {
        jQuery('#workout-slider')
            .carousel({interval: <?php if(isset($view_variables['general']['slider_interval'])) echo $view_variables['general']['slider_interval']; else echo '10000';?>, pause: 'none'})
            .sliderApi();
    });
</script>