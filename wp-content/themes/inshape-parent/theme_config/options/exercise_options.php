<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for pages area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
   /* ----------------------------------------------------------------------------------- */
    /* After Textarea */
    /* ----------------------------------------------------------------------------------- */   
	/* Content Options */
    array('name' => __('General Settings','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_settings',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Video','tfuse'),
        'desc' => __('Copy paste the video URL or embed code. The video URL works only for Vimeo and YouTube videos. Read ','tfuse').'<a target="_blank" href="http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/">'.__('prettyPhoto documentation','tfuse').'</a>
                    for more info on how to add video or flash in this text area
                    ',
        'id' => TF_THEME_PREFIX . '_video_links',
        'value' => '',
        'type' => 'textarea'
    ),
    array('name' => __('Video Resize (px)', 'tfuse'),
        'desc' => __('These are the default width and height values. If you want to resize the video change the values with your own. If you input only one, the video will get resized with constrained proportions based on the one you specified.', 'tfuse'),
        'id' => TF_THEME_PREFIX . '_video_dimensions',
        'value' => array(600,332),
        'type' => 'textarray',
        'divider' => true
    ),
    array('name' => __('Exercise Reps','tfuse'),
        'desc' => __('Exercise Reps and sets.','tfuse'),
        'id' => TF_THEME_PREFIX . '_reps',
        'value' => '',
        'type' => 'textarea'
    ),
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