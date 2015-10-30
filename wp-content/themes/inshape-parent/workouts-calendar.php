<?php $weeks = tfuse_page_options('workout_weeks');?>
<!-- Events Calendar -->
<section  class="main-row main-row-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="event-calendar" id="calendar_ul">

                    <!-- WeekDay Titles -->
                    <ul class="calendar-header clearfix">
                        <li><?php _e('Mon','tfuse');?></li>
                        <li><?php _e('Tue','tfuse');?></li>
                        <li><?php _e('Wed','tfuse');?></li>
                        <li><?php _e('Thu','tfuse');?></li>
                        <li><?php _e('Fri','tfuse');?></li>
                        <li><?php _e('Sat','tfuse');?></li>
                        <li><?php _e('Sun','tfuse');?></li>
                    </ul>
                    <!--/ WeekDay Titles -->
                    <!-- Exercises Slider -->
                    <div id="exercises-slider" class="exercises-slider carousel slide fade-effect">
                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            <?php                                 
                                $info = tfuse_get_workout_trainings();
                                
                               // tf_print($info['trainings']);
                            
                                //$weeks_training = tfuse_get_workout_trainings($weeks);
                                
                                $rest = $info['weeks'] % 4;
                                $month = ($rest != 0) ? (int)($info['weeks'] / 4) + 1 : (int)($info['weeks'] / 4);
                                                                
                            ?>
                            
                            <!-- Month -->
                            <?php for($i = 0; $i < $month; $i++):?>
                                <?php if($i > 0) $info['trainings'] = array_slice($info['trainings'], 4 );?>
                                <div class="<?php echo ($i == 0) ? 'active' : ''; ?> item">
                                    <ul class="calendar-month">
                                        
                                        <?php for($j = 0; $j < $info['weeks'] - ($i*4); $j++):?>
                                            <?php if($j == 4) break;?>
                                            <li>
                                                <ul class="clearfix">
                                                    <?php if(!empty($info['trainings'])):?>
                                                    
                                                        <?php for($k = 1; $k <= 7; $k++): //tf_print($info['trainings'][$i][$z]['tab_day'.$k]);?>

                                                            <?php if(!empty($info['trainings'][$j]['tab_day'.$k])): ?>
                                                                <?php 
                                                                    $exersices = tfuse_page_options('exercises_select','',$info['trainings'][$j]['tab_day'.$k]);
                                                                ?>

                                                                <?php if(!empty($exersices)):?>
                                                                    <li <?php echo ($k == 1 && $j == 0 && $i == 0) ? 'class="current"': ''; ?>>
                                                                        <a href="#exercises" data-id="<?php echo $info['trainings'][$j]['tab_day'.$k];?>" class="training_session"><span><?php echo get_the_title($info['trainings'][$j]['tab_day'.$k]);?></span></a>
                                                                    </li>
                                                                <?php else:?>
                                                                     <li <?php echo ($k == 1 && $j == 0 && $i == 0) ? 'class="disabled current"': 'class="disabled"'; ?>>
                                                                        <a href="#exercises" data-id="0" class="training_session"><span><?php _e('Rest','tfuse');?></span></a>
                                                                    </li>
                                                                <?php endif;?>

                                                            <?php else:?>

                                                                <li <?php echo ($k == 1 && $j == 0 && $i == 0) ? 'class="disabled current"': 'class="disabled"'; ?>>
                                                                    <a href="#exercises" data-id="0" class="training_session"><span><?php _e('Rest','tfuse');?></span></a>
                                                                </li>

                                                            <?php endif;?>

                                                        <?php endfor;?>
                                                                
                                                    <?php else:?>
                                                                
                                                        <?php for($k = 0; $k < 7; $k++):?>
                                                            <li class="disabled"><a href="#exercises"><span><?php _e('Rest','tfuse');?></span></a></li>
                                                        <?php endfor;?>
                                                            
                                                    <?php endif;?>
                                                </ul>
                                            </li>
                                        <?php endfor;?>
                                    </ul>
                                </div>
                            <?php endfor;?>
                            <!--/ Month -->
                        </div>

                        <!-- Carousel Indicators -->
                        <ol class="carousel-indicators">
                            <?php for($i = 0; $i < $month; $i++):?>
                            <li data-target="#exercises-slider" data-slide-to="<?php echo $i+1;?>" class="<?php echo ($i == 0) ? 'active' : ''; ?>"><?php _e('Month','tfuse');?> <?php echo $i+1;?></li>
                            <?php endfor;?>
                        </ol>

                        <!-- Carousel Nav -->
                        <a class="carousel-control left" href="#exercises-slider" data-slide="prev"><i class="tficon-chevron-left-alt"></i></a>
                        <a class="carousel-control right" href="#exercises-slider" data-slide="next"><i class="tficon-chevron-right-alt"></i></a>
                    </div>
                    <!--/ Exercises Slider -->
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Events Calendar -->