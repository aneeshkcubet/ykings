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
        <div id="main-slider" class="main-slider carousel slide fade-effect invisible">
            <!-- Carousel items -->
            <div class="carousel-inner">
                <?php $count = 0; foreach ($view_variables['slides'] as $slide):?>
                    <section class="<?php echo ($count == 0) ? 'active' : '';?> item" style="background-image: url(<?php echo $slide['slide_src'];?>);">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h1 class="page-title" data-animate-in="fadeInLeft" data-animate-out="fadeOutLeft"><?php echo $slide['slide_title'];?></h1>
                                </div>
                                <div class="col-sm-6">
                                    <div class="page-desc" data-animate-in="fadeInRight" data-animate-out="fadeOutRight"><?php echo $slide['slide_content'];?><span class="angle"></span></div>
                                    <a href="<?php echo $slide['slide_url'];?>" class="btn" data-animate-in="fadeInUp" data-animate-out="fadeOutDown"><span><?php echo $slide['slide_button'];?></span></a>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php $count++; endforeach;?>
            </div>
            <!-- Carousel indicators -->
            <ol class="carousel-indicators" data-animate-in="fadeInUp" data-animate-out="fadeOutDown">
                <?php for($i = 0; $i < count($view_variables['slides']); $i++):?>
                    <li data-target="#main-slider" data-slide-to="<?php echo $i;?>" class="<?php echo ($i == 0) ? 'active' : '';?>"></li>
                <?php endfor;?>
            </ol>
            <!-- Carousel nav -->
            <a class="carousel-control left" href="#main-slider" data-slide="prev">&lsaquo;</a>
            <a class="carousel-control right" href="#main-slider" data-slide="next">&rsaquo;</a>
        </div>
        <!--/ Main Slider -->
    </div>
</section>
<script>
    jQuery(function($) {
        $('.main-slider, .page-header').prepend('<img src="<?php echo $slide['slide_src'];?>" alt="" id="testimage" class="hidden">');
    });
    jQuery(window).load(function() {
        jQuery('#main-slider')
            .carousel({interval: <?php if(isset($view_variables['general']['slider_interval'])) echo $view_variables['general']['slider_interval']; else echo '8000';?>, pause: 'none'})
            .sliderApi();
    });
</script>
