<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for posts area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
    
    /* ----------------------------------------------------------------------------------- */
    /* After Textarea */
    /* ----------------------------------------------------------------------------------- */
    array('name' => __('General Settings', 'tfuse'),
        'id' => TF_THEME_PREFIX . '_settings',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Select Exercises','tfuse'),
        'desc' => __('Select exercises posts for this session training post by starting typing exercise post title.','tfuse'),
        'id' => TF_THEME_PREFIX . '_exercises_select',
        'value' => '',
        'type' => 'multi',
        'subtype' => 'exercise',
        'divider' =>true
    ),
    array(
        'name' => __('Bodyparts Worked','tfuse'),
            'id' => TF_THEME_PREFIX . '_content_tabs_t',
            'desc' => __('Add Bodyparts Worked and their percentage.','tfuse'),
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
                    'type' => 'text',
                    'properties' => array('placeholder' => __('Add Bodypart', 'tfuse'))
                ),
                array(
                    'id' =>  'tab_percentage',
                    'type' => 'text',
                    'properties' => array('placeholder' => __('Add Percentage', 'tfuse'))
                )
            )
        ),

);

?>