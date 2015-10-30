<?php 
$sessions = tfuse_page_options('content_weeks','',$view_variables['general']['posts_select']);

?>
<!-- Workout Calendar -->
<section class="main-row main-row-slim">
    <div class="calendar-slider">
        <div class="calendar-controls">
            <div class="inner">
                <div class="section-title-before"><?php _e('POPULAR plan','tfuse');?></div>
                <h2 class="section-title"><?php echo $view_variables['slides']['slide_title']?></h2>
                <div class="section-subtitle"><?php echo $view_variables['general']['slider_title'];?></div>
            </div>
            <a class="prev" id="calendar-prev" href="#"><i class="tficon-chevron-left-alt"></i></a>
            <a class="next" id="calendar-next" href="#"><i class="tficon-chevron-right-alt"></i></a>
        </div>
        <ul id="calendar-slider">
            <?php if(!empty($sessions)):?>
                <?php foreach($sessions as $session):?>
                    <li class="calendar-item">
                        <a href="<?php echo $view_variables['slides']['slide_url']?>">
                            <h6><?php _e('Monday','tfuse');?></h6>
                            <div class="exercises">
                                <ul>
                                    <?php if(!empty($session['tab_day1'])):?>
                                        <li>
                                            <strong><?php echo get_the_title((int)$session['tab_day1']);?></strong>
                                        </li>
                                    <?php else:?>
                                        <li><strong><?php _e('REST','tfuse');?></strong></li>
                                    <?php endif;?>
                                </ul>
                            </div>
                            <div class="more"><span><?php _e('More Details','tfuse');?></span><i></i></div>
                        </a>
                    </li>
                    <li class="calendar-item">
                        <a href="<?php echo $view_variables['slides']['slide_url']?>">
                            <h6><?php _e('Tuesday','tfuse');?></h6>
                            <div class="exercises">
                                <ul>
                                    <?php if(!empty($session['tab_day2'])):?>
                                        <li>
                                            <strong><?php echo get_the_title((int)$session['tab_day2']);?></strong>
                                        </li>
                                    <?php else:?>
                                        <li><strong><?php _e('REST','tfuse');?></strong></li>
                                    <?php endif;?>
                                </ul>
                            </div>
                            <div class="more"><span><?php _e('More Details','tfuse');?></span><i></i></div>
                        </a>
                    </li>
                    <li class="calendar-item">
                        <a href="<?php echo $view_variables['slides']['slide_url']?>">
                            <h6><?php _e('Wednesday','tfuse');?></h6>
                            <div class="exercises">
                                <ul>
                                    <?php if(!empty($session['tab_day3'])):?>
                                        <li>
                                            <strong><?php echo get_the_title((int)$session['tab_day3']);?></strong>
                                        </li>
                                    <?php else:?>
                                        <li><strong><?php _e('REST','tfuse');?></strong></li>
                                    <?php endif;?>
                                </ul>
                            </div>
                            <div class="more"><span><?php _e('More Details','tfuse');?></span><i></i></div>
                        </a>
                    </li>
                    <li class="calendar-item">
                        <a href="<?php echo $view_variables['slides']['slide_url']?>">
                            <h6><?php _e('Thursday','tfuse');?></h6>
                            <div class="exercises">
                                <ul>
                                    <?php if(!empty($session['tab_day4'])):?>
                                        <li>
                                            <strong><?php echo get_the_title((int)$session['tab_day4']);?></strong>
       
                                        </li>
                                    <?php else:?>
                                        <li><strong><?php _e('REST','tfuse');?></strong></li>
                                    <?php endif;?>
                                </ul>
                            </div>
                            <div class="more"><span><?php _e('More Details','tfuse');?></span><i></i></div>
                        </a>
                    </li>
                    <li class="calendar-item">
                        <a href="<?php echo $view_variables['slides']['slide_url']?>">
                            <h6><?php _e('Friday','tfuse');?></h6>
                            <div class="exercises">
                                <ul>
                                    <?php if(!empty($session['tab_day5'])):?>
                                        <li>
                                            <strong><?php echo get_the_title((int)$session['tab_day5']);?></strong>
                                        </li>
                                    <?php else:?>
                                        <li><strong><?php _e('REST','tfuse');?></strong></li>
                                    <?php endif;?>
                                </ul>
                            </div>
                            <div class="more"><span><?php _e('More Details','tfuse');?></span><i></i></div>
                        </a>
                    </li>
                    <li class="calendar-item">
                        <a href="<?php echo $view_variables['slides']['slide_url']?>">
                            <h6><?php _e('Saturday','tfuse');?></h6>
                            <div class="exercises">
                                <ul>
                                    <?php if(!empty($session['tab_day6'])):?>
                                        <li>
                                            <strong><?php echo get_the_title((int)$session['tab_day6']);?></strong>
                                        </li>
                                    <?php else:?>
                                        <li><strong><?php _e('REST','tfuse');?></strong></li>
                                    <?php endif;?>
                                </ul>
                            </div>
                            <div class="more"><span><?php _e('More Details','tfuse');?></span><i></i></div>
                        </a>
                    </li>
                    <li class="calendar-item">
                        <a href="<?php echo $view_variables['slides']['slide_url']?>">
                            <h6><?php _e('Sunday','tfuse');?></h6>
                            <div class="exercises">
                                <ul>
                                    <?php if(!empty($session['tab_day7'])):?>
                                        <li>
                                            <strong><?php echo get_the_title((int)$session['tab_day7']);?></strong>
                                        </li>
                                    <?php else:?>
                                        <li><strong><?php _e('REST','tfuse');?></strong></li>
                                    <?php endif;?>
                                </ul>
                            </div>
                            <div class="more"><span><?php _e('More Details','tfuse');?></span><i></i></div>
                        </a>
                    </li>
                    <?php if($session['tab_repeat']) break;?>
                <?php endforeach;?>
            <?php endif;?>
        </ul>
    </div>
</section>
<!--/ Workout Calendar -->