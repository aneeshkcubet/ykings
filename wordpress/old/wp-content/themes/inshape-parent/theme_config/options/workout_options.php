<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for pages area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
   /* ----------------------------------------------------------------------------------- */
    /* After Textarea */
    /* ----------------------------------------------------------------------------------- */ 
    array('name' => __('Training Sessions','tfuse'),
        'id' => TF_THEME_PREFIX . '_training_option',
        'type' => 'metabox',
        'context' => 'normal'
    ),
     array(
            'name' => __('Training Sessions','tfuse'),
            'id' => TF_THEME_PREFIX . '_content_weeks',
            'desc' => __('Add training sessions for each day of the week.','tfuse'),
            'btn_labels'=>array('Add Week','Delete Week'),
            'class' => 'tf-post-table ',
            'style' => '',
            'default_value' => array(
                'tab_day1'=>'',
                'tab_day2'=>'',
                'tab_day3'=>'',
                'tab_day4'=>'',
                'tab_day5'=>'',
                'tab_day6'=>'',
                'tab_day7'=>'',
                'tab_repeat'=>''
            ),
            'value' => array(
                array(
                    'tab_day1'=>'',
                    'tab_day2'=>'',
                    'tab_day3'=>'',
                    'tab_day4'=>'',
                    'tab_day5'=>'',
                    'tab_day6'=>'',
                    'tab_day7'=>'',
                    'tab_repeat'=>''
                )
            ),
            'type' => 'div_table',
            'columns' => array(
                array(
                    'id' =>  'tab_day1',
                    'type' => 'multi',
                    'subtype'=> 'session',
                    'limit' => 1,
                    'properties' => array('placeholder' => __('Add Training Session', 'tfuse')),
                    'desc' => __('Select day 1 training session','tfuse')
                ),
                array(
                    'id' =>  'tab_day2',
                    'type' => 'multi',
                    'subtype'=> 'session',
                    'limit' => 1,
                    'properties' => array('placeholder' => __('Add Training Session', 'tfuse')),
                    'desc' => __('Select day 2 training session','tfuse')
                ),
                array(
                    'id' =>  'tab_day3',
                    'type' => 'multi',
                    'subtype'=> 'session',
                    'limit' => 1,
                    'properties' => array('placeholder' => __('Add Training Session', 'tfuse')),
                    'desc' => __('Select day 3 training session','tfuse')
                ),
                array(
                    'id' =>  'tab_day4',
                    'type' => 'multi',
                    'subtype'=> 'session',
                    'limit' => 1,
                    'properties' => array('placeholder' => __('Add Training Session', 'tfuse')),
                    'desc' => __('Select day 4 training session','tfuse')
                ),
                array(
                    'id' =>  'tab_day5',
                    'type' => 'multi',
                    'subtype'=> 'session',
                    'limit' => 1,
                    'properties' => array('placeholder' => __('Add Training Session', 'tfuse')),
                    'desc' => __('Select day 5 training session','tfuse')
                ),
                array(
                    'id' =>  'tab_day6',
                    'type' => 'multi',
                    'subtype'=> 'session',
                    'limit' => 1,
                    'properties' => array('placeholder' => __('Add Training Session', 'tfuse')),
                    'desc' => __('Select day 6 training session','tfuse')
                ),
                array(
                    'id' =>  'tab_day7',
                    'type' => 'multi',
                    'subtype'=> 'session',
                    'limit' => 1,
                    'properties' => array('placeholder' => __('Add Training Session', 'tfuse')),
                    'desc' => __('Select day 7 training session','tfuse')
                ),
                array(
                    'id' =>  'tab_repeat',
                    'value' => false,
                    'options' => array(
                            'no' => __('Don\'t repeat','tfuse'),
                            '1' => __('1 Week','tfuse'),
                            '2' => __('2 Weeks','tfuse'),
                            '3' => __('3 Weeks','tfuse'),
                            '4' => __('4 Weeks','tfuse'),
                            '5' => __('5 Weeks','tfuse'),
                            '6' => __('6 Weeks','tfuse'),
                            '7' => __('7 Weeks','tfuse'),
                            '8' => __('8 Weeks','tfuse'),
                            '9' => __('9 Weeks','tfuse'),
                            '10' => __('10 Weeks','tfuse'),
                            '11' => __('11 Weeks','tfuse'),
                            '12' => __('12 Weeks','tfuse'),
                            '13' => __('13 Weeks','tfuse'),
                            '14' => __('14 Weeks','tfuse'),
                            '15' => __('15 Weeks','tfuse'),
                            '16' => __('16 Weeks','tfuse'),
                            '17' => __('17 Weeks','tfuse'),
                            '18' => __('18 Weeks','tfuse'),
                            '19' => __('19 Weeks','tfuse'),
                            '20' => __('20 Weeks','tfuse'),
                            '21' => __('21 Weeks','tfuse'),
                            '22' => __('22 Weeks','tfuse'),
                            '23' => __('23 Weeks','tfuse'),
                            '24' => __('24 Weeks','tfuse'),
                            '25' => __('25 Weeks','tfuse'),
                            '26' => __('26 Weeks','tfuse'),
                            '27' => __('27 Weeks','tfuse'),
                            '28' => __('28 Weeks','tfuse'),
                            '29' => __('29 Weeks','tfuse'),
                            '30' => __('30 Weeks','tfuse'),
                            '31' => __('31 Weeks','tfuse'),
                            '32' => __('32 Weeks','tfuse'),
                            '33' => __('33 Weeks','tfuse'),
                            '34' => __('34 Weeks','tfuse'),
                            '35' => __('35 Weeks','tfuse'),
                            '36' => __('36 Weeks','tfuse'),
                            '37' => __('37 Weeks','tfuse'),
                            '38' => __('38 Weeks','tfuse'),
                            '39' => __('39 Weeks','tfuse'),
                            '40' => __('40 Weeks','tfuse'),
                            '41' => __('41 Weeks','tfuse'),
                            '42' => __('42 Weeks','tfuse'),
                            '43' => __('43 Weeks','tfuse'),
                            '44' => __('44 Weeks','tfuse'),
                            '45' => __('45 Weeks','tfuse'),
                            '46' => __('46 Weeks','tfuse'),
                            '47' => __('47 Weeks','tfuse'),
                            '48' => __('48 Weeks','tfuse')),
                    'type' => 'select',
                    'properties' => array('placeholder' => __('', 'tfuse')),
                    'desc' => __('Repeat this week\'s training sessions for the next','tfuse')
                ),
            )
        ),
    array('name' => __('General Setting','tfuse'),
        'id' => TF_THEME_PREFIX . '_workout_option',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Header Image','tfuse'),
        'desc' => __('Upload Header Image.','tfuse'),
        'id' => TF_THEME_PREFIX . '_header_image',
        'value' => '',
        'type' => 'upload',
        'divider' => true
    ),
    
    array('name' => __('Short Description','tfuse'),
        'desc' => __('The short description is displayed under the workout title on the workout listing page.','tfuse'),
        'id' => TF_THEME_PREFIX . '_workout_desc',
        'value' => '',
        'type' => 'textarea',
        'divider' => true
    ),
    array(
        'name' => __('Workout Goals Percentage','tfuse'),
            'id' => TF_THEME_PREFIX . '_content_tabs_table',
            'desc' => __('Add workout goals percentage.','tfuse'),
            'btn_labels'=>array('Add Row','Delete Row'),
            'class' => 'tf-post-table ',
            'style' => '',
            'default_value' => array(
                'tab_title'=>'',
                'tab_percentage'=>''
            ),
            'value' => array(
                array(
                    'tab_title'=>'',
                    'tab_percentage'=>''
                )
            ),
            'type' => 'div_table',
            'columns' => array(
                array(
                    'id' =>  'tab_title',
                    'options' => tfuse_list_goals(),
                    'type' => 'select',
                    'properties' => array('placeholder' => __('Add Goal', 'tfuse'))
                ),
                array(
                    'id' =>  'tab_percentage',
                    'type' => 'text',
                    'properties' => array('placeholder' => __('Add Percentage', 'tfuse'))
                )
            ),
        'divider' => true
        ),
    
    array('name' => __('Enable Similar Workouts', 'tfuse'),
        'desc' => __('This will display similar workouts at the bottom of a workout page, prioritizing first on difficulty, then on goal and lastly on duration.', 'tfuse'),
        'id' => TF_THEME_PREFIX . '_enable_similar_workouts',
        'value' => 'true',
        'type' => 'checkbox'
    ),
    array('name' => __('Workout Slider Text','tfuse'),
        'id' => TF_THEME_PREFIX . '_workout_slider',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Left Column', 'tfuse'),
        'desc' => __('Text for slider left column. You\'ll need to manually add this workout in Workout Slider (in the ') .'<a  target="_blank" href="'.get_admin_url().'?page=tf_slider_list">'.__('Sliders page','tfuse').'</a> '. __(') to make it appear in the slider.', 'tfuse'),
        'id' => TF_THEME_PREFIX . '_left_column',
        'value' => '',
        'type' => 'textarea'
    ),
    array('name' => __('Right Column','tfuse'),
        'desc' => __(' Text for slider right column. You\'ll need to manually add this workout in Workout Slider (in the ') .'<a  target="_blank" href="'.get_admin_url().'?page=tf_slider_list">'.__('Sliders page','tfuse').'</a> '. __(') to make it appear in the slider.','tfuse'),
        'id' => TF_THEME_PREFIX . '_right_column',
        'value' => '',
        'type' => 'textarea'
    ),
	/* Content Options */
    array('name' => __('Shortcodes','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_option',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Shortcodes before Content','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_top',
        'value' => '',
        'type' => 'textarea'
    ),
    array('name' => __('Shortcodes after Content','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_bottom',
        'value' => '',
        'type' => 'textarea'
    )
    
);

/* * *********************************************************
  Advanced
 * ********************************************************** */
?>