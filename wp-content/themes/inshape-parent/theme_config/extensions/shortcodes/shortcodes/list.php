<?php

/**
 * List Styles
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 */

function tfuse_list($atts, $content = null)
{
    extract( shortcode_atts(array('type' => ''), $atts) );
    
    switch($type)
    {
        case 'arrows': $class = 'list-caret-right'; break;
        case 'checklist': $class = 'list-check'; break;
        case 'remove': $class = 'list-remove'; break;
        case 'links': $class = 'list-external-link'; break;
        case 'chevron': $class = 'list-chevron-sign-right'; break;
        case 'thumbs': $class = 'list-thumbs-up'; break;
        case 'music': $class = 'list-music'; break;
        case 'questions': $class = 'list-question-sign'; break;
        case 'download': $class = 'list-download'; break;
        case 'text': $class = 'list-file-text-alt'; break;
        case 'hand': $class = 'list-hand-right'; break;
        default: $class = 'list-ok';break;
    }
    
    
    return '<div class="'.$class.'">' . do_shortcode($content) . '</div>';
}

$atts = array(
    'name' => __('List', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 2,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('List type','tfuse'),
            'desc' => __('Select list type','tfuse'),
            'id' => 'tf_shc_list_type',
            'value' => '',
            'options' => array(
                'arrows' => __('Arrows list','tfuse'),
                'checklist' => __('Checklist','tfuse'),
                'remove' => __('Remove list','tfuse'),
                'links' => __('Links list','tfuse'),
                'chevron' => __('Chevron list','tfuse'),
                'thumbs' => __('Thumbs up list','tfuse'),
                'music' => __('Music list','tfuse'),
                'questions' => __('Questions list','tfuse'),
                'download' => __('Download list','tfuse'),
                'text' => __('Text Files list','tfuse'),
                'hand' => __('Hand Right list','tfuse'),
                'ok' => __('OK list','tfuse'),
            ),
            'type' => 'select'
        ),
        array(
            'name' => __('Content', 'tfuse'),
            'desc' => __('Use the &lt;ul&gt; tag together with the &lt;li&gt; tag to create check lists', 'tfuse'),
            'id' => 'tf_shc_list_content',
            'value' => '
                <ul>
                    <li>List item 1</li>
                    <li>List item 2</li>
                    <li>List item 3</li>
                </ul>
            ',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('list', 'tfuse_list', $atts);