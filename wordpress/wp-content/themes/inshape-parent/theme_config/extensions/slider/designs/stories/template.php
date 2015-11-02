<!-- PostList Slider -->
<section class="main-row main-row-gray main-row-slim">
    <div id="post-slider" class="postlist-stories post-slider carousel slide fade-effect">
        <div class="carousel-inner">
            <?php $count = 0; foreach ($view_variables['slides'] as $slide):?>
                <article class="<?php echo ($count == 0) ? 'active' : '';?> item post clearfix">
                    <span class="post-thumbnail"><?php echo $slide['slide_src'];?></span>
                    <div class="entry-content">
                        <div class="entry-title-before" data-animate-in="fadeInDown" data-animate-out="fadeOutUp"><?php echo $slide['slide_category'];?></div>
                        <h2 class="entry-title" data-animate-in="fadeInLeft" data-animate-out="fadeOutRight">
						<a href="<?php echo $slide['slide_url'];?>"><span><?php echo $slide['slide_title'];?></span></a></h2>
                        <p data-animate-in="fadeInLeft" data-animate-out="fadeOutRight"><?php echo $slide['slide_content'];?></p>
                    </div>
                </article>
            <?php $count++; endforeach;?>
        </div>

        <!-- Carousel indicators -->
        <ol class="carousel-indicators" data-animate-in="fadeInUp" data-animate-out="fadeOutDown">
            <?php for($i = 0; $i < count($view_variables['slides']); $i++):?>
                <li data-target="#post-slider" data-slide-to="<?php echo $i;?>" class="<?php echo ($i == 0) ? 'active' : '';?>"></li>
            <?php endfor;?>
        </ol>
        <!-- Carousel nav -->
        <a class="carousel-control left" href="#post-slider" data-slide="prev">&lsaquo;</a>
        <a class="carousel-control right" href="#post-slider" data-slide="next">&rsaquo;</a>
    </div>
</section>
<!--/ PostList Slider -->
<script>
    jQuery(window).load(function() {
        jQuery('#post-slider')
            .carousel({interval: <?php if(isset($view_variables['general']['slider_interval'])) echo $view_variables['general']['slider_interval']; else echo '10000';?>, pause: 'none'})
            .sliderApi();
    });
</script>