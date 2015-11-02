<?php
function tfuse_shortcode_header_map($atts, $content = null)
{
    extract(shortcode_atts(array('location' => '','zoom' => '','address' => '','title' => '','subtitle' => ''), $atts));
    
    $out = ''; $uniq = rand(1,100);
    
    $coords = explode(':', $location);
    if((!$coords[0]) || (!$coords[1]))
    {
        $tmp_conf ['show_all_markers'] = true;
    }
    else
    {
        $tmp_conf['post_coords']['lat']     = preg_replace('[^0-9\.]', '', $coords[0]);
        $tmp_conf['post_coords']['lng']     = preg_replace('[^0-9\.]', '', $coords[1]);
    }
    
    if(!empty($tmp_conf['post_coords']['lat']) && !empty($tmp_conf['post_coords']['lng']))
    {
        $out .= '<section class="main-row main-row-slim">
            <div class="main-header main-header-gray main-header-map">
                <div id="spinner" class="spinner">
                    <div class="wBall" id="wBall_1">
                        <div class="wInnerBall">
                        </div>
                    </div>
                    <div class="wBall" id="wBall_2">
                        <div class="wInnerBall">
                        </div>
                    </div>
                    <div class="wBall" id="wBall_3">
                        <div class="wInnerBall">
                        </div>
                    </div>
                    <div class="wBall" id="wBall_4">
                        <div class="wInnerBall">
                        </div>
                    </div>
                    <div class="wBall" id="wBall_5">
                        <div class="wInnerBall">
                        </div>
                    </div>
                </div>

                <div id="map" class="map"></div>

                <div class="page-header invisible">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-before invisible" data-animate-in="fadeInLeft">'.$title.'</div>
                                <h1 class="page-title invisible" data-animate-in="fadeInLeft">'.$subtitle.'</h1>
                                <div class="page-desc invisible" data-animate-in="fadeInRight">
                                    <strong>'.__('Location Address','tfuse').':</strong>
                                    '.$address.'
                                </div>
                                <a href="#" id="show-map" class="btn btn-transparent invisible" data-animate-in="fadeInUp"><span>'.__('VIEW LOCATION ON MAP','tfuse').'</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
            jQuery(window).ready(function ($) {
                    $("#map").gMap({
                        markers: [{
                            latitude: '.$tmp_conf['post_coords']['lat'].',
                            longitude: '.$tmp_conf['post_coords']['lng'].',
                            title: "Company Name LTD",
                            html:"<div class=\'gmap-tooltip\'>'.$address.'</div>",
                            popup: false,
                            icon: {
                                image: "'.get_template_directory_uri().'/images/icons/gmap-flag.png",
                                iconsize: [25, 34],
                                iconanchor: [12,34],
                                infowindowanchor: [0, 0]
                            }
                        }],
                        zoom: '.$zoom.',
                        scrollwheel: false
                    });

                    $("#show-map").on("click", function(e) {
                        e.preventDefault();

                        if (Modernizr.cssanimations) {
                            $(this).parents(".page-header").addClass("fadeOut").one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", function(){
                                $(this).addClass("hidden")
                            });

                        } else {
                            $(this).parents(".page-header").addClass("hidden");
                        }
                    });
                    });
        </script>';
    }
    
    return $out;
}

$atts = array(
    'name' => __('Header Map','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_header_map_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Subtitle','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_header_map_subtitle',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Map position','tfuse'),
            'desc' => __('Map position','tfuse'),
            'id' => 'tf_shc_header_map_location',
            'value' => '',
            'type' => 'maps'
        ),
        array(
            'name' => __('Zoom','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_header_map_zoom',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Adress','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_header_map_address',
            'value' => '',
            'type' => 'textarea'
        ),
    )
);

tf_add_shortcode('header_map', 'tfuse_shortcode_header_map', $atts);
