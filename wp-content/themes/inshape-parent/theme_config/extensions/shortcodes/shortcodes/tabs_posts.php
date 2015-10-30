<?php
//Recent / Most Commented Widget

function tfuse_tabs_posts($atts) {
    extract(shortcode_atts(array('items' => ''), $atts));
   
    
    $recent_posts  = tfuse_shortcode_posts_tabs(array(
                                'sort' => 'recent',
                                'items' => $items,
                                'image_post' => true,
                                'image_width' => 60,
                                'image_height' => 60,
                                'image_class' => 'thumb',
                                'date_format' => 'M j, Y',
                                'date_post' => true
                                ));
    
    $commented_posts = tfuse_shortcode_posts_tabs(array(
                                'sort' => 'popular',
                                'items' => $items,
                                'image_post' => true,
                                'image_width' => 60,
                                'image_height' => 60,
                                'image_class' => 'thumb',
                                'date_format' => 'M j, Y',
                                'date_post' => true,
                            ));
    
    $return_html = '';
    $return_html .='<div class="tf_sidebar_tabs tabs_framed no-padding">
        <ul class="nav nav-tabs clearfix active_bookmark1" id="tabs">
            <li  class="active"><a href="#tf_tabs_1">'.__('Top ','tfuse').$items.'</a></li>
            <li><a href="#tf_tabs_2">'.__('Recent','tfuse').'</a></li>
            
        </ul><div class="tab-content">';

    

       $return_html .=' <div id="tf_tabs_1" class="tab-pane fade in active">
                    <ul class="postlist-sidebar">';
                        foreach ($commented_posts as $post_val) { 
                            $cat = get_the_category( $post_val['post_id'] );
                            $return_html .= '<li class="clearfix">';
                            $return_html .= '
                                        ' . ' <a href="' . $post_val['post_link'] . '"  class="post-thumbnail pull-right">' . $post_val['post_img'] . '</a> ';
                            $return_html .= '<a href="' . $post_val['post_link'] . '" class="entry-title">' . $post_val['post_title'] . '</a>
                                        ';
                                            $return_html .=' <div class="entry-meta">
                                                        <time class="entry-date" datetime="">' . $post_val['post_date_post'] . '</time>
                                                        <span class="cat-links"> '.__('in','tfuse').' <a href="'.get_category_link($cat[0]->term_id).'" title="" rel="category tag">'.$cat[0]->name.'</a></span>
                                                    </div>';
                            $return_html .= '</li>';
                        }
     $return_html .= '</ul>
         </div>';
     $return_html .= '<div id="tf_tabs_2" class="tab-pane fade">
                    <ul class="postlist-sidebar">';
                        foreach ($recent_posts as $post_val) {
                            $cat = get_the_category( $post_val['post_id'] );
                            $return_html .= '<li class="clearfix">';
                            $return_html .= '
                                        ' . ' <a href="' . $post_val['post_link'] . '" class="post-thumbnail pull-right">' . $post_val['post_img'] . '</a>'. 
                                    ' <a href="' . $post_val['post_link'] . '" class="entry-title">' . $post_val['post_title'] . '</a>
                                        ';
                                            $return_html .=' <div class="entry-meta">
                                                        <time class="entry-date" datetime="">' . $post_val['post_date_post'] . '</time>
                                                        <span class="cat-links"> '.__('in','tfuse').' <a href="'.get_category_link($cat[0]->term_id).'" title="" rel="category tag">'.$cat[0]->name.'</a></span>
                                                    </div>';
                            $return_html .= '</li>';
                        }
    $return_html .='</ul>
        </div>
        </div>
    </div>';
     
     $return_html .='  <script>
				jQuery("#tabs a").click(function (e) {
					  e.preventDefault();
					  jQuery(this).tab("show");
					})
			</script>';
    return $return_html;
}

$atts = array(
    'name' => __('Tab Posts','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 2,
    'options' => array(
        array(
            'name' => __('Items','tfuse'),
            'desc' => __('Specifies the number of the post to show','tfuse'),
            'id' => 'tf_shc_tabs_posts_items',
            'value' => '5',
            'type' => 'text'
        ),
    )
);

tf_add_shortcode('tabs_posts','tfuse_tabs_posts', $atts);