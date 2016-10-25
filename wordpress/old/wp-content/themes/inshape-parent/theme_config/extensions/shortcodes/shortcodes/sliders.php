<?php
function tfuse_sliders($atts){
    global $TFUSE;
    extract(shortcode_atts(array('slider_id' => ''), $atts));
    $output = '';
    
    if($slider_id != '-1')
    {
        $slider = $TFUSE->ext->slider->model->get_slider($slider_id);
        $posts = '';

        switch ($slider['type']):
           case 'custom':
                if ( is_array($slider['slides']) ) :
                    $slider_image_resize = ( isset($slider['general']['slider_image_resize']) && $slider['general']['slider_image_resize'] == 'true' ) ? true : false;
                    foreach ($slider['slides'] as $k => $slide) : 
                        $image = new TF_GET_IMAGE();
                        if ( $slider['design'] == 'stories')
                        { 
                            $slider['slides'][$k]['slide_src'] = $image->width(629)->height(500)->src($slide['slide_src'])->resize($slider_image_resize)->get_src();
                        }
                        elseif ( $slider['design'] == 'home')
                        { 
                            $slider['slides'][$k]['slide_src'] = $image->width(1680)->height(670)->src($slide['slide_src'])->resize($slider_image_resize)->get_src();
                        }
                        elseif ( $slider['design'] == 'workouts')
                        { 
                            $slider['slides'][$k]['slide_src'] = $image->width(1680)->height(670)->src($slide['slide_src'])->resize($slider_image_resize)->get_src();
                        }
                    endforeach;
                endif;

                break;
            case 'posts':
                $slides_posts = array();

                     $from = $slider['general']['posts_select'];
                                
                    $args = array( 'post__in' => explode(',',$from) );
                    $slides_posts = explode(',',$from);
               
                foreach($slides_posts as $slide_posts):
                    $posts[] = get_post($slide_posts);
                endforeach; 
                $posts = array_reverse($posts);
//                $args = apply_filters('tfuse_slider_posts_args', $args, $slider);
//                $args = apply_filters('tfuse_slider_posts_args_'.$ID, $args, $slider);
                break;
            case 'categories':
//                    $args = 'cat='.$slider['general']['categories_select'].
//                    '&posts_per_page='.$slider['general']['sliders_posts_number'];
//                    $args = apply_filters('tfuse_slider_categories_args', $args, $slider);
//                    $args = apply_filters('tfuse_slider_categories_args_'.$ID, $args, $slider);
                    
               
                    $slides_posts = isset($slider['general']['categories_select_stories']) ? explode(',',$slider['general']['categories_select_stories']) : '';
                    $taxonomy = 'stories';
                
                    if(empty($slides_posts))
                    {
                        $slides_posts = explode(',',$slider['general']['categories_select_workouts']);
                        $taxonomy = 'workouts';
                    }
                
                    $args = array(
                            'posts_per_page' => $slider['general']['sliders_posts_number'],
                            'tax_query' => array(
                                    array(
                                            'taxonomy' => $taxonomy,
                                            'field' => 'id',
                                            'terms' => $slides_posts
                                    )
                            )
                    );
                
                
                    $query = new WP_Query($args);
                    $posts  = $query->get_posts();
                break;
        endswitch;
        
        if ( is_array($posts) ) :
            $slider['slides'] = tfuse_get_slides_from_posts($posts,$slider);
        endif;

        if ( !is_array($slider['slides']) ) return;
        
        $output .= tfuse_render_view(locate_template( '/theme_config/extensions/slider/designs/'.$slider['design'].'/template.php'),$slider);
    
    }
        
    $output .= '';

    
    return $output;
}
global $TFUSE;

$atts = array(
    'name' => __('Sliders', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 4,
    'options' => array( 
        array(
            'name' => __('Select Slider', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_sliders_slider_id',
            'value' => '',
            'options' => $TFUSE->ext->slider->get_sliders_dropdown(),
            'type' => 'select',
        )
    )
);

tf_add_shortcode('sliders', 'tfuse_sliders', $atts);