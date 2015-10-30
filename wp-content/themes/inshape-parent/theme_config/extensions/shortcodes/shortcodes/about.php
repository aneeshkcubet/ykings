<?php
function tfuse_about($atts, $content) {
    extract(shortcode_atts(array('title' => '', 'img' => '', 'desc' => '','btn' => '', 'link' => ''), $atts));

    return '<article class="col-sm-4 post">
                <span class="post-thumbnail"><a href="'.$link.'"><img src="'.$img.'" alt=""><span>'.__('View Details','tfuse').'</span></a></span>
                <h3 class="entry-title"><a href="'.$link.'">'.$title.'</a></h3>
                <div class="entry-content"><p>'.($desc).'</p></div>
                <footer class="entry-meta">
                    <a href="'.$link.'" class="btn btn-black btn-small btn-transparent"><span>'.$btn.'</span></a>
                </footer>
            </article>';
}

$atts = array(
    'name' => __('About','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_about_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Image','tfuse'),
            'desc' => __('Image Url','tfuse'),
            'id' => 'tf_shc_about_img',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Short Description','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_about_desc',
            'value' => '',
            'type' => 'textarea'
        ),
        array(
            'name' => __('Btn Title','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_about_btn',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Link','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_about_link',
            'value' => '',
            'type' => 'text'
        ),
    )
);

tf_add_shortcode('about', 'tfuse_about', $atts);
