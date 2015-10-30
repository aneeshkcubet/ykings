<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for categories area.             */
/* ----------------------------------------------------------------------------------- */

$options = array(
    array('name' => __('Header Before Title','tfuse'),
        'desc' => __('Category header before title.','tfuse'),
        'id' => TF_THEME_PREFIX . '_header_title_bef',
        'value' => '',
        'type' => 'text'
    ),
    array('name' => __('Header Title','tfuse'),
        'desc' => __('Category header title.','tfuse'),
        'id' => TF_THEME_PREFIX . '_header_title',
        'value' => '',
        'type' => 'text'
    ),
    array('name' => __('Header Image','tfuse'),
        'desc' => __('Upload category header image.','tfuse'),
        'id' => TF_THEME_PREFIX . '_header_img',
        'value' => '',
        'type' => 'upload'
    ),
   // Bottom Shortcodes
    array('name' => __('Shortcodes before Content','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_top',
        'value' => '',
        'type' => 'textarea'
    ),
    // Bottom Shortcodes
    array('name' => __('Shortcodes after Content','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_bottom',
        'value' => '',
        'type' => 'textarea'
    )
   
);

?>