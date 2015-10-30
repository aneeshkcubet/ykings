<?php
function tfuse_nutrition($atts, $content) {
    extract(shortcode_atts(array('title' => '', 'img' => '', 'desc' => '','btn' => '', 'link' => '', 'post' => ''), $atts));

    $out = '';
    
    $out .= '<article class="col-sm-4 post">
                <span class="post-thumbnail"><a href="'.$link.'"><img src="'.$img.'" alt=""><span>'.__('View Details','tfuse').'</span></a></span>
                <h3 class="entry-title"><a href="'.$link.'">'.$title.'</a></h3>
                <div class="entry-content">
                    <p>'.$desc.'</p>';
                    if(!empty($post))
                    {
                        $out .='<ul class="links">';
                            $posts = explode(',',$post);
                            foreach ($posts as $id) {
                                $out .='<li><a href="'.get_permalink($id).'">'.get_the_title($id).'</a></li>';
                            }
                        $out .='</ul>';
                    }
                $out .='</div>
                <footer class="entry-meta">
                    <a href="'.$link.'" class="btn btn-black btn-small btn-transparent"><span>'.$btn.'</span></a>
                </footer>
            </article>';
    
    return $out;
}

$atts = array(
    'name' => __('Nutrition','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_nutrition_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Image','tfuse'),
            'desc' => __('Image Url','tfuse'),
            'id' => 'tf_shc_nutrition_img',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Short Description','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_nutrition_desc',
            'value' => '',
            'type' => 'textarea'
        ),
        array(
            'name' => __('Select Nutrition Post','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_nutrition_post',
            'value' => '',
            'type' => 'multi',
            'subtype' => 'advice'
        ),
        array(
            'name' => __('Btn Title','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_nutrition_btn',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Link','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_nutrition_link',
            'value' => '',
            'type' => 'text'
        ),
    )
);

tf_add_shortcode('nutrition', 'tfuse_nutrition', $atts);
