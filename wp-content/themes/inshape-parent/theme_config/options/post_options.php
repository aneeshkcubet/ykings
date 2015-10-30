<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for posts area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
    
    /* ----------------------------------------------------------------------------------- */
    /* After Textarea */
    /* ----------------------------------------------------------------------------------- */
     /* Post Media */
    array('name' => __('Media', 'tfuse'),
        'id' => TF_THEME_PREFIX . '_media',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    // Single Image Position
    array('name' => __('Image Alignment', 'tfuse'),
        'desc' => __('Select your preferred image  alignment', 'tfuse'),
        'id' => TF_THEME_PREFIX . '_single_img_position',
        'value' => '',
        'options' => array(
            '' => array($url . 'full_width.png', __('Don\'t apply an alignment', 'tfuse')),
            'pull-left' => array($url . 'left_off.png', __('Align to the left', 'tfuse')),
            'pull-right' => array($url . 'right_off.png', __('Align to the right', 'tfuse'))
            ),
        'type' => 'images',
        'divider' => true
    ), 
     array('name' => __('Rounded Image','tfuse'),
        'desc' => __('Make image rounded.','tfuse'),
        'id' => TF_THEME_PREFIX . '_rounded',
        'value' => false,
        'type' => 'checkbox',
        'divider' => true
    ),
    array('name' => __('Image Position','tfuse'),
        'desc' => __('Select post image position.','tfuse'),
        'id' => TF_THEME_PREFIX . '_img_pos',
        'value' => '',
        'options' => array('after' => __('After Title','tfuse'),'before' => __('Before Title','tfuse')),
        'type' => 'select'
    ),
   array('name' => __('Post Settings','tfuse'),
        'id' => TF_THEME_PREFIX . '_post_settings',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Short Description','tfuse'),
        'desc' => __('Post short description.','tfuse'),
        'id' => TF_THEME_PREFIX . '_post_desc',
        'value' => '',
        'type' => 'textarea'
    ),
	/* Content Options */
    array('name' => __('Content Options','tfuse'),
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