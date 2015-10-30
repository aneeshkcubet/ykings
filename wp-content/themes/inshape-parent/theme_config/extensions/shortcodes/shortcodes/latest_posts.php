<?php
/**
 * Latest Posts
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * items:
 * title:
 * image_width:
 * image_height:
 * image_class:
 */

function tfuse_latest_post($atts, $content = null)
{
    remove_filter('excerpt_more', 'custom_excerpt_more');
    add_filter( 'excerpt_more', 'custom_excerpt_more_shortcode' );
    $return_html = '';
    extract(shortcode_atts(array(
                                'items' => 5,
                                'title' => 'Recent Posts',
                                'image_width' => 60,
                                'image_height' => 60,
                                'image_class' => ''
                           ), $atts));

    $latest_posts = tfuse_shortcode_posts(array(
                                               'sort' => 'recent',
                                               'items' => $items,
                                               'image_post' => true,
                                               'image_width' => $image_width,
                                               'image_height' => $image_height,
                                               'image_class' => $image_class,
                                                'date_format'=> 'F jS,Y',
                                               'date_post' => true,
                                          ));
    $return_html .= '
    <div class="widget postlist-sidebar recent-posts">';
         $return_html .= !empty($title) ? '<h3 class="widget-title">' . $title . '</h3>' : '';
    $return_html .= '<ul>';
    foreach ($latest_posts as $post_val): $cat = get_the_category( $post_val['post_id'] );
		$time = strtotime($post_val['post_date_post']);
	
        $return_html .= '<li class="clearfix">';
        $return_html .= '<a href="' . $post_val['post_link'] . '" class="post-thumbnail pull-left">'.$post_val['post_img'].'</a>
            <a href="' . $post_val['post_link'] . '" class="entry-title">' . $post_val['post_title'] . '</a>';
        $return_html .= '<div class="entry-meta">
                            <time class="entry-date" datetime="'.date('Y-m-d',$time).'T'.date('g:i:s',$time).'">'.$post_val['post_date_post'].'</time>
                            <span class="cat-links"> '.__('in','tfuse').' <a href="'.get_category_link($cat[0]->term_id).'" title="" rel="">'.$cat[0]->name.'</a></span>
                        </div>';
        $return_html .= '</li>';
    endforeach;
    $return_html .='</ul></div> ';

    return $return_html;
}

$atts = array(
    'name' => __('Latest Posts','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Items','tfuse'),
            'desc' => __('Specifies the number of the post to show','tfuse'),
            'id' => 'tf_shc_latest_posts_items',
            'value' => '5',
            'type' => 'text'
        ),
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Specifies the title for an shortcode','tfuse'),
            'id' => 'tf_shc_latest_posts_title',
            'value' => __('Recent Posts','tfuse'),
            'type' => 'text'
        ),
        array(
            'name' => __('Image Width','tfuse'),
            'desc' => __('Specifies the width of an thumbnail','tfuse'),
            'id' => 'tf_shc_latest_posts_image_width',
            'value' => '70',
            'type' => 'text'
        ),
        array(
            'name' => __('Image Height','tfuse'),
            'desc' => __('Specifies the height of an thumbnail','tfuse'),
            'id' => 'tf_shc_latest_posts_image_height',
            'value' => '70',
            'type' => 'text'
        ),
        array(
            'name' => __('Image Class','tfuse'),
            'desc' => __('Specifies one or more class names for an shortcode. To specify multiple classes,<br /> separate the class names with a space, e.g. <b>"left important"</b>.','tfuse'),
            'id' => 'tf_shc_latest_posts_image_class',
            'value' => 'thumbnail',
            'type' => 'text'
        )
    )
);

tf_add_shortcode('latest_posts', 'tfuse_latest_post', $atts);
