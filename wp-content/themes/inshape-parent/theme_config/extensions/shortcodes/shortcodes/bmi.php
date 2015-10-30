<?php
function tfuse_bmi($atts, $content) {
    extract(shortcode_atts(array('title' => '', 'img' => ''), $atts));

    

    return "<article class='col-sm-4 post'>
                        <span class='post-thumbnail'><a ><img src='".$img."' alt=''><span>".__('Calculate BMI','tfuse')."</span></a></span>
                        <h3 class='entry-title'>".$title."</h3>
                        <div class='entry-content'>
                            <p>".do_shortcode($content)."</p>

                            <div class='bmi-calc clearfix'>
                                <div class='system-normal'>
                                    <div class='select-section pull-left'>
                                        <label for='height1' class='label-title'>".__('Height','tfuse')."</label>
                                        <div class='field-select pull-left'>
                                            <select class='select-styled' name='height1' id='height1'>
                                                <option value='3'>3'</option>
                                                <option value='4'>4'</option>
                                                <option value='5' selected>5'</option>
                                                <option value='6'>6'</option>
                                                <option value='7'>7'</option>
                                                <option value='8'>8'</option>
                                            </select>
                                        </div>
                                        <div class='field-select pull-right'>
                                            <select class='select-styled' name='height2' id='height2'>
                                                <option value='0'>0''</option>
                                                <option value='1'>1''</option>
                                                <option value='2'>2''</option>
                                                <option value='3'>3''</option>
                                                <option value='4'>4''</option>
                                                <option value='5'>5''</option>
                                                <option value='6'>6''</option>
                                                <option value='7'>7''</option>
                                                <option value='8'>8''</option>
                                                <option value='9' selected>9''</option>
                                                <option value='10'>10''</option>
                                                <option value='11'>11''</option>
                                                <option value='12'>12''</option>
                                            </select>
                                        </div>
                                        <div class='input-label'>".__('FT/IN','tfuse')."</div>
                                    </div>

                                    <div class='input-section field-text pull-right'>
                                        <label for='weight' class='label-title'>".__('Weight','tfuse')."</label>
                                        <input type='text' name='weight' id='weight' value='' placeholder='150'>
                                        <div class='input-label'>".__('LBS','tfuse')."</div>
                                    </div>

                                    <div class='clearfix'></div>
                                    <a class='switch' href='#'>".__('Switch to Metric','tfuse')."</a>
                                </div>
                                <div class='system-metric hidden'>
                                    <div class='input-section field-text pull-left'>
                                        <label for='height-metric' class='label-title'>".__('Height','tfuse')."</label>
                                        <input type='text' name='height-metric' id='height-metric' value='' placeholder='180'>
                                        <div class='input-label'>".__('Cm','tfuse')."</div>
                                    </div>

                                    <div class='input-section field-text pull-right'>
                                        <label for='weight-metric' class='label-title'>".__('Weight','tfuse')."</label>
                                        <input type='text' name='weight-metric' id='weight-metric' value='' placeholder='80'>
                                        <div class='input-label'>".__('Kg','tfuse')."</div>
                                    </div>

                                    <div class='clearfix'></div>
                                    <a class='switch' href='#'>".__('Switch to Standard','tfuse')."</a>
                                </div>

                                <div class='bmi-results hidden'>
                                    <strong id='bmi-result'></strong>
                                    <dl>
                                        <dt>&lt; 18.5</dt><dd>".__('Underweight','tfuse')."</dd>
                                        <dt>18.5 - 24.9</dt><dd>".__('Good','tfuse')."</dd>
                                        <dt>25.0 - 29.9</dt><dd>".__('Overweight','tfuse')."</dd>
                                        <dt>30.0 +</dt><dd>".__('Obese','tfuse')."</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <footer class='entry-meta'>
                            <a href='#' id='bmi-submit' class='btn btn-black btn-small btn-transparent'><span>".__('CALCULATE YOUR BMI','tfuse')."</span></a>
                            <a href='#' id='bmi-reset' class='btn btn-black btn-small btn-transparent hidden'><span>".__('Reset','tfuse')."</span></a>
                        </footer>
                    </article>";
}

$atts = array(
    'name' => __('BMI','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_bmi_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Image','tfuse'),
            'desc' => __('Image Url','tfuse'),
            'id' => 'tf_shc_bmi_img',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Short Description','tfuse'),
            'desc' => __('','tfuse'),
            'id' => 'tf_shc_bmi_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('bmi', 'tfuse_bmi', $atts);
