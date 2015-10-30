<?php
    $args = array(
            'hide_empty'    => false, 
        ); 
    //get goals tags
    $goals = get_terms('goals',$args);
    //get difficulties tags
    $difficulties = get_terms('difficulties',$args);
    //get durations tags
    $durations = get_terms('durations',$args);
?>
<section class="main-row main-row-thin border-bottom">
    <div class="container">
        <div class="row workout-filters">
            <div class="col-sm-4 col-lg-3 col-lg-offset-2">
                <div class="field-select">
                    <label for="filter-difficulty" class="label-title"><?php _e('DIFFICULTY','tfuse');?>:</label>
                    <select class="select-styled" name="filter-difficulty" id="filter-difficulty">
                        <option value=""><?php _e('All','tfuse');?></option>
                        <?php if(!empty($difficulties)):?>
                            <?php foreach ($difficulties as $difficulty):?>
                                <option value="<?php echo str_replace(' ','_',$difficulty->name);?>"><?php echo $difficulty->name;?></option>
                            <?php endforeach;?>
                        <?php endif;?>
                    </select>
                </div>
            </div>

            <div class="col-sm-4 col-lg-3">
                <div class="field-select">
                    <label for="filter-duration" class="label-title"><?php _e('Duration','tfuse');?>:</label>
                    <select class="select-styled" name="filter-duration" id="filter-duration">
                        <option value=""><?php _e('All','tfuse');?></option>
                        <?php if(!empty($durations)):?>
                            <?php foreach ($durations as $duration):?>
                                <option value="<?php echo str_replace(' ','_',$duration->name);?>"><?php echo $duration->name;?></option>
                            <?php endforeach;?>
                        <?php endif;?>
                    </select>
                </div>
            </div>

            <div class="col-sm-4 col-lg-3">
                <div class="field-select">
                    <label for="filter-goal" class="label-title"><?php _e('Workout Goal','tfuse');?>:</label>
                    <select class="select-styled" name="filter-goal" id="filter-goal">
                        <option value=""><?php _e('All','tfuse');?></option>
                        <?php if(!empty($goals)):?>
                            <?php foreach ($goals as $goal):?>
                                <option value="<?php echo str_replace(' ','_',$goal->name);?>"><?php echo $goal->name;?></option>
                            <?php endforeach;?>
                        <?php endif;?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</section>