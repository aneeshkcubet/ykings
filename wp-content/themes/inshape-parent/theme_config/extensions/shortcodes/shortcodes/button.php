<?php

/**
 * Buttons
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * style: custom css style
 * link: the destination of a link e.g. http://themefuse.com/
 * class: css class
 * target: _blank, _self, _parent, _top 
 */

function tfuse_button($atts, $content = null)
{
    extract( shortcode_atts(array('style' => '', 'link' => '#', 'class' => '', 'target' => '_self','disabled'=>'','size'=>'','transparent'=>''), $atts) );
    if($disabled == '') $visible = '';
    else $visible = 'disabled';
    
    if($transparent == '') $trans = '';
    else $trans = 'btn-transparent';
    
    if($size =='default') $s = '';
    elseif($size == 'large') $s = 'btn-big';
    elseif($size == 'small') $s = 'btn-small';
    else $s = '';
   
    if ( !empty($style) )
    {
        $class = '';
        $style = ' style="' . $style . '"';
    }
    else
        $class = ' ' . $class;

    return '<a href="' . $link . '" class="btn ' . $class . ' '.$visible.' '.$trans.' '.$s.'"  target="' . $target . '"><span ' . $style . '>' . $content . '</span></a>';
}

$atts = array(
    'name' => __('Buttons','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the button shortcode.','tfuse'),
    'category' => 2,
    'options' => array(
        array(
            'name' => __('Target','tfuse'),
            'desc' => __('Specifies where to open the linked shortcode','tfuse'),
            'id' => 'tf_shc_button_target',
            'value' => '_self',
            'options' => array(
                '_blank' => __('Opens the link in a new window or tab','tfuse'),
                '_parent' => __('Opens the link in the parent frame','tfuse'),
                '_self' => __('Opens the link in the same frame as it was clicked (this is default)','tfuse'),
                '_top' => __('Opens the link in the full body of the window','tfuse'),
            ),
            'type' => 'select'
        ),
        array(
            'name' => __('Style','tfuse'),
            'desc' => __('Specify an inline style for an shortcode','tfuse'),
            'id' => 'tf_shc_button_style',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Class','tfuse'),
            'desc' => __('<b>Predefined classes:</b>btn-default,btn-primary,btn-success,btn-info,btn-warning,
                            btn-danger,btn-link,btn-pink,btn-teal,btn-purple,btn-orange,btn-brown,btn-black','tfuse'),
            'id' => 'tf_shc_button_class',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Transparent','tfuse'),
            'desc' => __('Make button transparent','tfuse'),
            'id' => 'tf_shc_button_transparent',
            'value' => '',
            'options' => array(
                '' => __('Default','tfuse'),
                'btn-transparent' => __('Make button transparent','tfuse'),
            ),
            'type' => 'select'
        ),
        array(
            'name' => __('Add Disabled','tfuse'),
            'desc' => __('Make button disabled or active','tfuse'),
            'id' => 'tf_shc_button_disabled',
            'value' => '',
            'options' => array(
                '' => __('Make button active','tfuse'),
                'disabled' => __('Make button disabled','tfuse'),
            ),
            'type' => 'select'
        ),
        array(
            'name' => __('Size','tfuse'),
            'desc' => __('Select button size','tfuse'),
            'id' => 'tf_shc_button_size',
            'value' => '',
            'options' => array(
                'default' => __('Default size','tfuse'),
                'large' => __('Large size','tfuse'),
                'small' => __('Small size','tfuse'),
            ),
            'type' => 'select'
        ),
        array(
            'name' => __('Link','tfuse'),
            'desc' => __('Specifies the URL of the page the link goes to','tfuse'),
            'id' => 'tf_shc_button_link',
            'value' => '#',
            'type' => 'text'
        ),
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter shortcode content','tfuse'),
            'id' => 'tf_shc_button_content',
            'value' => 'button',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('button', 'tfuse_button', $atts);
