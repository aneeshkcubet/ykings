<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for posts area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
    
    /* ----------------------------------------------------------------------------------- */
    /* After Textarea */
    /* ----------------------------------------------------------------------------------- */
     /* Post Media */

   array('name' => __('General Settings','tfuse'),
        'id' => TF_THEME_PREFIX . '_post_settings',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Short Description','tfuse'),
        'desc' => __('The short description is displayed under the title on the service detail page.','tfuse'),
        'id' => TF_THEME_PREFIX . '_post_desc',
        'value' => '',
        'type' => 'textarea',
        'divider' => true
    ),
    array('name' => __('Make Appointment Link','tfuse'),
        'desc' => __('Make Appointment Link.','tfuse'),
        'id' => TF_THEME_PREFIX . '_app_link',
        'value' => '',
        'type' => 'text'
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

?>