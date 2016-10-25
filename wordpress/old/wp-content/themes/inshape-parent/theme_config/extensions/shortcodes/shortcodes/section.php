<?php
function tfuse_section($atts, $content = null) {
    
    extract(shortcode_atts(array('bg' => '','sect' => '','border' => '' ,'row' => '','before' => '','title' => ''), $atts));
        
    $output = '';
    
    switch($bg)
    {
        case 'default' : $back = ''; break;
        case 'gray' : $back = 'main-row-gray'; break;
        default : $back = ''; break;
    }
    
    switch($row)
    {
        case 'thin' : $row_type = 'main-row-thin'; break;
        case 'slim' : $row_type = 'main-row-slim'; break;
        default : $row_type = ''; break;
    }
    
    if($sect == 'top')
    {
        $output .=  '<section class="main-row main-row-slim">
            <div class="main-header main-header-gray">
                <div class="page-header invisible">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-before invisible" data-animate-in="fadeInLeft">'.$before.'</div>
                                <h1 class="page-title invisible" data-animate-in="fadeInRight">'.$title.'</h1>';
            $output .= do_shortcode($content);
        $output .= '</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>';
    }
    else 
    {
        $output .=  '<div class="main-row '.$back.' '.$row_type.'  '.$border.'">
            <div class="container">';
            $output .= do_shortcode($content);
        $output .= '</div></div>';
    }
        
    
    

    
    return $output;
}

$atts = array(
    'name' => __('Section', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 4,
    'options' => array(
        array(
            'name' => __('Section', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_section_sect',
            'value' => 'row',
            'options' => array('row' => __('Row Section','tfuse'),'top' => __('Header Section','tfuse')),
            'type' => 'select',
        ),
        array(
            'name' => __('Background', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_section_bg',
            'value' => 'default',
            'options' => array('default' => __('Default','tfuse'),'gray' => __('Gray Background','tfuse')),
            'type' => 'select',
        ),
        array(
            'name' => __('Border Top', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_section_border',
            'value' => '',
            'options' => array('' => __('Default','tfuse'),'border-top' => __('With Border Top','tfuse')),
            'type' => 'select',
        ),
        array(
            'name' => __('Row', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_section_row',
            'value' => 'default',
            'options' => array('default' => __('Default','tfuse'),'slim' => __('Slim','tfuse')),
            'type' => 'select',
        ),
         array(
            'name' => __('Before Title', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_section_before',
            'value' => '',
            'type' => 'text',
        ),
         array(
            'name' => __('Title', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_section_title',
            'value' => '',
            'type' => 'text',
        ),
        array(
            'name' => __('Content', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_section_content',
            'value' => '',
            'type' => 'textarea',
        ),

    )
);

tf_add_shortcode('section', 'tfuse_section', $atts);