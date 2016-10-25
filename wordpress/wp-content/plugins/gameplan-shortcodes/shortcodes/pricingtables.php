<?php
/**
 * WPBakery Visual Composer shortcodes
 *
 * @package WPBakeryVisualComposer
 *
 */

class WPBakeryShortCode_c_row extends WPBakeryShortCode_VC_Tab {
    protected  $predefined_atts = array(
        'title' => '',
		'text' => ''
		
    );
/*fff*/
    public function content( $atts, $content = null ) {
        $title = '';
		$text = '';
        extract(shortcode_atts(array(
            'title' => __("Section", "js_composer"),
			'text' => '',
        ), $atts));

        $output = '';

        $output .= "\n\t\t\t" . '<div class="timeline">';
        $output .= "\n\t\t\t\t" . '<div class="row-fluid">';
		$output .= "\n\t\t\t\t" . '<div class="col1">';
		$output .= "\n\t\t\t\t" . '</div>';
		$output .= "\n\t\t\t\t" . '<div class="col11">';
		$output .= "\n\t\t\t\t" . '<span class="dot"><i class="icon-circle fa fa-circle"></i></span>';
		$output .= "\n\t\t\t\t" . '<span class="line"></span>';
		$output .= "\n\t\t\t\t" . '<p class="title" >'.$title.'</p>';
        $output .= "\n\t\t\t\t" . '<p class="content">'.$text.'</p>';
        $output .= "\n\t\t\t\t" . '</div>';
		$output .= "\n\t\t\t\t" . '</div>';
        $output .= "\n\t\t\t" . '</div> ';

        return $output;
    }

/*fff*/

    public function contentAdmin($atts, $content = null) {
        $width = $el_class = $title = '';
        extract(shortcode_atts($this->predefined_atts, $atts));
        $output = '';

        $column_controls = $this->getColumnControls($this->settings('controls'));
        $column_controls_bottom =  $this->getColumnControls('add', 'bottom-controls');

        if ( $width == 'column_14' || $width == '1/4' ) {
            $width = array('span3');
        }
        else if ( $width == 'column_14-14-14-14' ) {
            $width = array('span3', 'span3', 'span3', 'span3');
        }

        else if ( $width == 'column_13' || $width == '1/3' ) {
            $width = array('span4');
        }
        else if ( $width == 'column_13-23' ) {
            $width = array('span4', 'span8');
        }
        else if ( $width == 'column_13-13-13' ) {
            $width = array('span4', 'span4', 'span4');
        }

        else if ( $width == 'column_12' || $width == '1/2' ) {
            $width = array('span6');
        }
        else if ( $width == 'column_12-12' ) {
            $width = array('span6', 'span6');
        }

        else if ( $width == 'column_23' || $width == '2/3' ) {
            $width = array('span8');
        }
        else if ( $width == 'column_34' || $width == '3/4' ) {
            $width = array('span9');
        }
        else if ( $width == 'column_16' || $width == '1/6' ) {
            $width = array('span2');
        }
        else {
            $width = array('');
        }


        for ( $i=0; $i < count($width); $i++ ) {
            $output .= '<div class="group wpb_sortable" >';
            $output .= '<div class="wpb_element_wrapper">';
            $output .= '<div class="row-fluid wpb_row_container not-row-inherit">';
            $output .= '<h3><a href="#">'.$title.'</a></h3>';
            $output .= '<div '.$this->mainHtmlBlockParams($width, $i).'>';
            $output .= '<input type="hidden" class="wpb_vc_sc_base" name="" value="'.$this->settings['base'].'" />';
            $output .= str_replace("%column_size%", wpb_translateColumnWidthToFractional($width[$i]), $column_controls);
            $output .= '<div class="wpb_element_wrapper">';
			$output .= '<h4>'.$title.'</h4>';           
		    $output .= '<div class="row-fluid wpb_'.$this->settings['base'].'_container wpb_container_block">'.'<p>'.$text.'</p>'.'<h4><a href="wpb_vc_param_value title textfield" name="title">'.$name.'</a></h4>';
			
           // $output .= '<div class="row-fluid wpb_sortable_container wpb_vc_param_value title textfield wpb_'.$this->settings['base'].'_container " name="title">';
			//$output .= '<h4><a href="wpb_vc_param_value title textfield" name="name">'.$name.'</a></h4>';
            $output .= '</div>';
            if ( isset($this->settings['params']) ) {
                $inner = '';
                foreach ($this->settings['params'] as $param) {
                    $param_value = $$param['param_name'];
                    //var_dump($param_value);
                    if ( is_array($param_value)) {
                        // Get first element from the array
                        reset($param_value);
                        $first_key = key($param_value);
                        $param_value = $param_value[$first_key];
                    }
                    $inner .= $this->singleParamHtmlHolder($param, $param_value);
                }
                $output .= $inner;
            }
            $output .= '</div>';
            $output .= str_replace("%column_size%", wpb_translateColumnWidthToFractional($width[$i]), $column_controls_bottom);
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
        }
        return $output;
    }

}
wpb_map( array(
    "name"		=> __("c_row", "js_composer"),
    "base"		=> "c_row",
    "class"		=> "",
    "icon"      => "",
    "wrapper_class" => "",
    "controls"	=> "full",
    "content_element" => false,
    "params"	=> array(
        array(
            "type" => "tab_row_title",
            "heading" => __("Title", "js_composer"),
            "param_name" => "title",
            "value" => "",
            "description" => '',
        ),
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __("Content", "js_composer"),
            "param_name" => "content",
            "value" => '',
            "description" => '',
        ),

    )
) );
/*Call tab*/
function tab_row_title_field($settings, $value) {
    $dependency = vc_generate_dependencies_attributes($settings);
    return '<div class="my_param_block">'
        .'<input name="'.$settings['param_name']
        .'" class="wpb_vc_param_value wpb-textinput'
        .$settings['param_name'].' '.$settings['type'].'_field" type="text" value="'
        .$value.'" ' . $dependency . ' data-js-function="wpb_change_accordion_tab_title" />'
        .'</div>';
}

/*End Call tab*/
add_shortcode_param('tab_row_title', 'tab_row_title_field');

//clumn
class WPBakeryShortCode_VC_Tabcolumn extends WPBakeryShortCode_VC_Column {
    protected $predefined_atts = array(
                        'tab_id' => TAB_TITLE,
                        'title' => ''
                        );
    public function content( $atts, $content = null ) {
        wp_enqueue_script('jquery_ui_tabs_rotate');
        $title = $tab_id = '';
        extract(shortcode_atts($this->predefined_atts, $atts));
        $output = '';
        $output .= "\n\t\t\t" . '<div id="tab-'. (empty($tab_id) ? sanitize_title( $title ) : $tab_id) .'" class="wpb_tab wpb_row vc_row-fluid ui-tabs-panel wpb_ui-tabs-hide clearfix">';
        $output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "js_composer") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
        $output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.wpb_tab');
        return $output;
    }
    public function customAdminBlockParams() {
        return ' id="tab-'.$this->atts['tab_id'] .'"';
    }
    public function mainHtmlBlockParams($width, $i) {
        return 'data-element_type="'.$this->settings["base"].'" class="wpb_'.$this->settings['base'].' wpb_sortable wpb_container_block wpb_content_holder"'.$this->customAdminBlockParams();
    }
    public function containerHtmlBlockParams($width, $i) {
        return 'class="row-fluid wpb_column_container wpb_sortable_container wpb_'.$this->settings['base'].'_container wpb_container_block wpb_no_content_element_inside"';
    }
}

wpb_map( array(
    "name"		=> __("Tab", "js_composer"),
    "base"		=> "vc_tab",
    "class"		=> "",
    "icon"      => "",
    "wrapper_class" => "",
    "controls"	=> "full",
    "content_element" => false,
    "params"	=> array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "js_composer"),
            "param_name" => "title",
            "value" => "",
            "description" => __("Title which will be displayed as the tab anchor in navigation control", "js_composer")
        ),
    )
) );

add_shortcode_param('tab_id', 'tab_id_settings_field');

//
class WPBakeryShortCode_comparetables extends WPBakeryShortCode {

    public function __construct($settings) {
        parent::__construct($settings);
        // WPBakeryVisualComposer::getInstance()->addShortCode( array( 'base' => 'vc_accordion_tab' ) );
    }

    protected function content( $atts, $content = null ) {
        wp_enqueue_style( 'ui-custom-theme' );
        wp_enqueue_script('jquery-ui-accordion');
        $title = $interval = $width = $el_position = $el_class = '';
        //
        extract(shortcode_atts(array(
            'title' => '',
            'interval' => 0,
            'width' => '1/1',
            'el_position' => '',
            'el_class' => ''
        ), $atts));
        $output = '';

        $el_class = $this->getExtraClass($el_class);
        $width = '';//wpb_translateColumnWidthToSpan($width);

        $output .= "\n\t".'<div class="wpb_accordion wpb_content_element '.$width.$el_class.' not-column-inherit">'; //data-interval="'.$interval.'"
        $output .= "\n\t\t".'<div class="wpb_wrapper wpb_accordion_wrapper ui-accordion">';
        //$output .= ($title != '' ) ? "\n\t\t\t".'<h2 class="wpb_heading wpb_accordion_heading">'.$title.'</h2>' : '';
        $output .= wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_accordion_heading'));

        $output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
        $output .= "\n\t".'</div> '.$this->endBlockComment($width);

        //
        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;

    }

    public function contentAdmin( $atts, $content ) {
        $width = $custom_markup = '';
        $shortcode_attributes = array('width' => '1/1');
        foreach ( $this->settings['params'] as $param ) {
            if ( $param['param_name'] != 'content' ) {
                if ( is_string($param['value']) ) {
                    $shortcode_attributes[$param['param_name']] = __($param['value'], "js_composer");
                } else {
                    $shortcode_attributes[$param['param_name']] = $param['value'];
                }
            } else if ( $param['param_name'] == 'content' && $content == NULL ) {
                $content = __($param['value'], "js_composer");
            }
        }
        extract(shortcode_atts(
            $shortcode_attributes
            , $atts));

        $output = '';

        $elem = $this->getElementHolder($width);

        $iner = '';
        foreach ($this->settings['params'] as $param) {
            $param_value = '';
            $param_value = $$param['param_name'];
            if ( is_array($param_value)) {
                // Get first element from the array
                reset($param_value);
                $first_key = key($param_value);
                $param_value = $param_value[$first_key];
            }
            $iner .= $this->singleParamHtmlHolder($param, $param_value);
        }
        //$elem = str_ireplace('%wpb_element_content%', $iner, $elem);
        $tmp = '';
        $template = '<div class="wpb_template">'.do_shortcode('[c_row title="New row item"][/c_row]').'</div>';

        if ( isset($this->settings["custom_markup"]) && $this->settings["custom_markup"] != '' ) {
            if ( $content != '' ) {
                $custom_markup = str_ireplace("%content%", $tmp.$content.$template, $this->settings["custom_markup"]);
            } else if ( $content == '' && isset($this->settings["default_content"]) && $this->settings["default_content"] != '' ) {
                $custom_markup = str_ireplace("%content%", $this->settings["default_content"].$template, $this->settings["custom_markup"]);
            }
            //$output .= do_shortcode($this->settings["custom_markup"]);
            $iner .= do_shortcode($custom_markup);
        }
        $elem = str_ireplace('%wpb_element_content%', $iner, $elem);
        $output = $elem;

        return $output;
    }
}
wpb_map( array(
    "name"		=> __("Compare tables", "js_composer"),
    "base"		=> "comparetables",
    "controls"	=> "full",
    "show_settings_on_create" => false,
    "class"		=> "wpb_timeline vc_not_inner_content wpb_container_block",
	"icon"		=> "icon-wpb-ui-timeline",
	"category"  => __('Content', 'js_composer'),
//	"wrapper_class" => "clearfix",
    "params"	=> array(
        array(
            "type" => "textfield",
            "heading" => __("Number column", "js_composer"),
            "param_name" => "c_column",
            "value" => '',
            "description" => ''
        ),

    ),
    "custom_markup" => '

	<div class="wpb_comparetables_holder wpb_holder clearfix">
		%content%
	</div>
    <div class="tab_controls">
		<button class="add_tab" title="'.__("Add pricingtables section", "js_composer").'">'.__("Add pricingtables section", "js_composer").'</button>
	</div>
	',
    'default_content' => '
        <ul class="tabs_controls">
            <li><a href="#tab-'.$tab_id_1.'"><span>'.__('Tab 1', 'js_composer').'</span></a></li>
            <li><a href="#tab-'.$tab_id_2.'"><span>'.__('Tab 2', 'js_composer').'</span></a></li>
        </ul>
        [vc_tab title="Tab 1" tab_id="'.$tab_id_1.'"][/vc_tab]
        [vc_tab title="Tab 2" tab_id="'.$tab_id_2.'"][/vc_tab]

    ',
    'default_content_old' => '
		<ul>
		<li><a href="#tab-1"><span>'.__('Tab 1', 'js_composer').'</span></a></li>
		<li><a href="#tab-2"><span>'.__('Tab 2', 'js_composer').'</span></a></li>
	</ul>

	<div id="tab-1" class="row-fluid wpb_row_inner_container wpb_sortable_container not-column-inherit">
		[vc_column_inner width="1/1"][/vc_column_text]
	</div>

	<div id="tab-2" class="row-fluid wpb_column_container wpb_sortable_container not-column-inherit">
		[vc_column_inner width="1/1"] '.__('I am text block. Click edit button to change this text.', 'js_composer').' [/vc_column_text]
	</div>
	<div class="group">
		<h3><a href="#">'.__('Section 1', 'js_composer').'</a></h3>
            <div>
                <div class="row-fluid wpb_column_container wpb_sortable_container not-column-inherit">
                    [vc_column_text width="1/1"] '.__('I am text block. Click edit button to change this text.', 'js_composer').' [/vc_column_text]
                </div>
            </div>
	</div>
	<div class="group">
		<h3><a href="#">'.__('Section 2', 'js_composer').'</a></h3>
		<div>
			<div class="row-fluid wpb_column_container wpb_sortable_container not-column-inherit">
				[vc_column_text width="1/1"] '.__('I am text block. Click edit button to change this text.', 'js_composer').' [/vc_column_text]
			</div>
		</div>
	</div>',
    "js_callback" => array("init" => "wpbComparetablesInitCallBack","init1" => "wpbTabsInitCallBack"  /* "shortcode" => "wpbAccordionGenerateShortcodeCallBack" */)
) );



