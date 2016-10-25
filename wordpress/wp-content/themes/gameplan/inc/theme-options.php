<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'general',
        'title'       => '<i class="gp_general">General</i>'
      ),
	  array(
        'id'          => 'color_settings',
        'title'       => '<i class="gp_color_setting">Color & Background</i>'
      ),
	  array(
        'id'          => 'fonts',
        'title'       => '<i class="gp_font_setting">Font Settings</i>'
      ),
	  array(
        'id'          => 'social_accounts',
        'title'       => '<i class="gp_social_account">Social Accounts</i>'
      ),
      array(
        'id'          => 'top_menu',
        'title'       => '<i class="gp_topmenu">Top Menu</i>'
      ),
      array(
        'id'          => 'main_navigation',
        'title'       => '<i class="gp_main_mavi">Main Navigation</i>'
      ),
      array(
        'id'          => 'main_slider_section',
        'title'       => '<i class="gp_home_page">HomePage</i>'
      ),            
      array(
        'id'          => 'blog',
        'title'       => '<i class="gp_blog">Blog</i>'
      ),
      array(
        'id'          => 'singe_post',
        'title'       => '<i class="gp_single_post">Single Post</i>'
      ),
      array(
        'id'          => 'single_page',
        'title'       => '<i class="gp_single_page">Single Page</i>'
      ),
	  array(
        'id'          => 'search',
        'title'       => '<i class="gp_search">Search</i>'
      ),
	  array(
        'id'          => '404',
        'title'       => '<i class="gp_404">404</i>'
      ), 
    ), 
    'settings'        => array( 
	array(
        'id'          => 'theme_style',
        'label'       => 'Style',
        'desc'        => 'Select site style',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'dark',
            'label'       => 'Dark',
            'src'         => ''
          ),
          array(
            'value'       => 'light',
            'label'       => 'Light',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'layout',
        'label'       => 'Layout',
        'desc'        => 'Select theme layout',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'wide',
            'label'       => 'Wide',
            'src'         => ''
          ),
          array(
            'value'       => 'boxed',
            'label'       => 'Boxed',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'responsive',
        'label'       => 'Responsive',
        'desc'        => 'Toggle theme\'s responsive feature. A responsive theme will automatically re-arrange its elements to fit mobile devices\s screen. If you plan to serve different layout for mobile devices, you should turn this off',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),    
		array(
        'id'          => 'righttoleft',
        'label'       => 'RTL Support',
        'desc'        => 'Turn this on if you are using RTL (Right-To-Left) language',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'custom_css',
        'label'       => 'Custom CSS',
        'desc'        => 'Enter custom CSS code here, NOT including [style] tags. For example: <i>.class{color:blue;}</i>',
        'std'         => '',
        'type'        => 'css',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'google_analytics_code',
        'label'       => 'Custom Code',
        'desc'        => 'Enter custom CSS or JS code here, including [style] & [script] tags. For example, enter Google Analytics',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'font_awesome',
        'label'       => 'Font Awesome Version',
        'desc'        => 'If you change this option, you need to edit all your shortcodes to match new Font Awesome\'s icon class format. (All previous Gameplan versions are using Font Awesome 3.x)',
        'std'         => '3',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '3',
            'label'       => '3.x',
            'src'         => ''
          ),
          array(
            'value'       => '4',
            'label'       => '4.x',
            'src'         => ''
          )
        ),
      ),
	  
      array(
        'id'          => 'page404_title',
        'label'       => '404 Page - Title',
        'desc'        => 'Title of 404 Page',
        'std'         => '',
        'type'        => 'text',
        'section'     => '404',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'page404_heading',
        'label'       => '404 Page - Heading',
        'desc'        => 'Heading of 404 Page',
        'std'         => '',
        'type'        => 'text',
        'section'     => '404',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'page404_subheading',
        'label'       => '404 Page - Sub Heading',
        'desc'        => 'Sub-heading of 404 Page',
        'std'         => '',
        'type'        => 'text',
        'section'     => '404',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'page404_content',
        'label'       => '404 Page - Content',
        'desc'        => 'Content of 404 Page',
        'std'         => '',
        'type'        => 'textarea',
        'section'     => '404',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      	  
      array(
        'id'          => 'topmenu_visible',
        'label'       => 'Show Top Menu',
        'desc'        => 'Show or hide Top Menu bar',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'top_menu',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'topmenu_bg',
        'label'       => 'Background Color',
        'desc'        => 'Background Color of Top Menu',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'top_menu',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'nav_show',
        'label'       => 'Show Main Navigation',
        'desc'        => 'Show or hide Main Navigation section',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'main_navigation',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'navigation_transparent',
        'label'       => 'Navigation Transparency',
        'desc'        => 'Enter numeric value of Navigation section\'s Transparency (percentage, ex. 80%)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'main_navigation',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'logo_image',
        'label'       => 'Logo Image',
        'desc'        => 'Upload your logo image',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'main_navigation',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'retina_logo',
        'label'       => 'Retina Logo (optional)',
        'desc'        => 'Retina logo should be two time bigger than the custom logo. Retina Logo is optional, use this setting if you want to strictly support retina devices.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'main_navigation',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'responsive_navigation_mobile',
        'label'       => 'Responsive - Navigation',
        'desc'        => 'Specify browser width (in pixels) at which Navigation turns into mobile mode. For example, if you enter 640, then when browser width is less than 640, navigation turns into mobile mode',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'main_navigation',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),

      array(
        'id'          => 'footerlogo_show',
        'label'       => 'Show Footer Logo',
        'desc'        => 'Show or hide logo in Footer',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'main_navigation',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'footerlogo_size',
        'label'       => 'Footer Logo size',
        'desc'        => 'Size of footer logo, in percentage (compared to main logo image). For example: 80%',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'main_navigation',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'sticky_show_menu',
        'label'       => 'Sticky menu',
        'desc'        => '',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'main_navigation',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),


      array(
        'id'          => 'slider_section',
        'label'       => 'Use Slider',
        'desc'        => 'Choose what kind of slider to use in Home Page',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'main_slider_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'revslider',
            'label'       => 'Revolution Slider',
            'src'         => ''
          ),
          array(
            'value'       => 'noslider',
            'label'       => 'No slider (Use Widget in MainTop sidebar)',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'revslider_name',
        'label'       => 'Revolution Slider Alias Name',
        'desc'        => 'Alias Name of revolution slider to use (this will only work if "Use Slider" is set to "Revolution Slider"',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'main_slider_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'slider_style',
        'label'       => 'Slider style',
        'desc'        => 'Choose style of slider to use in Home Page',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'main_slider_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'wide',
            'label'       => 'Wide (Full width)',
            'src'         => ''
          ),
          array(
            'value'       => 'boxed',
            'label'       => 'Boxed',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'background_slider',
        'label'       => 'Background of slider',
        'desc'        => 'Used when "Use Slider" is set to "No slider"',
        'std'         => '',
        'type'        => 'background',
        'section'     => 'main_slider_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'main_color',
        'label'       => 'Main Color',
        'desc'        => 'Main color of theme. By default, Light style is #ee4422 and Dark style is #ffd600',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'color_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'body_background',
        'label'       => 'Body Background',
        'desc'        => 'Body Background. By default, Light style is #efe9d3 and Dark style is #252525',
        'std'         => '',
        'type'        => 'background',
        'section'     => 'color_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'subpage_header',
        'label'       => 'Inner Pages Header',
        'desc'        => 'Choose default inner-pages header\'s color and background. This setting can be overridden in a specific page',
        'std'         => '',
        'type'        => 'background',
        'section'     => 'color_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'subpage_heading_color',
        'label'       => 'Inner Pages Heading Text Color',
        'desc'        => 'Color of inner-pages\'s heading text. This setting can be overridden in a specific page. By default, Light style is #e23e38 and Dark style is #ffd600',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'color_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'subpage_heading_size',
        'label'       => 'Inner Pages Heading Font Size',
        'desc'        => 'Font size of inner-pages\'s heading. For example: "18px" or "1.5em". This setting can be overridden in a specific page',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'font_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'subpage_subheading_color',
        'label'       => 'Inner Pages Sub-heading Text Color',
        'desc'        => 'Color of sub-heading of inner pages. This setting can be overridden in a specific page. By default, Light style is #323232 and Dark style is #b7b7b7',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'color_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'subpage_subheading_size',
        'label'       => 'Inner Pages Sub-heading Font Size',
        'desc'        => 'Font size of inner-pages\'s sub-heading. For example "14px" or "1.2em". This setting can be overridden in a specific page',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'color_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'topmenu_socialicon_color',
        'label'       => 'Top Menu Social Icons - Color',
        'desc'        => 'Color of social icons on Top Menu section. Default: #fff',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'color_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'topmenu_socialicon_bg',
        'label'       => 'Top Menu Social Icons - Background Color',
        'desc'        => 'Background color of social icons on Top Menu section',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'color_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'topmenu_socialicon_hovercolor',
        'label'       => 'Top Menu Social Icons - Hover Color',
        'desc'        => 'Color of social icons on Top Menu section when hovered. By default, Light style is #e13d3e and Dark style is #ffd600',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'color_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'topmenu_socialicon_hoverbg',
        'label'       => 'Top Menu Social Icons - Hover Background Color',
        'desc'        => 'Background color of social icons on Top Menu section when hovered. Default: #fff ',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'color_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'content_textcolor',
        'label'       => 'Content - Text Color',
        'desc'        => 'Text Color of content. By default, Light style is #323232 and Dark style is #b7b7b7',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'color_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'content_linkcolor',
        'label'       => 'Content - Link Color',
        'desc'        => 'Color of links. By default, Light style is #323232 and Dark style is #ffffff',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'color_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'content_hoverlinkcolor',
        'label'       => 'Content - Hover Link Color',
        'desc'        => 'Color of links when hovered. By default, Light style is #e23e38 and Dark style is #ffd600',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'color_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'content_headingcolor',
        'label'       => 'Content - Heading Color',
        'desc'        => 'Color of page heading. By default, Light style is #e23e38 and Dark style is #ffffff',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'color_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'content_metacolor',
        'label'       => 'Content - Meta Text Color',
        'desc'        => 'Color of meta text (date-time, author,... ). By default, Light style is #989898 and Dark style is #D0D0D0',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'color_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'content_button_textcolor',
        'label'       => 'Button - Text Color',
        'desc'        => 'Text color of button. This setting can be overridden in a specific button shortcode . By default, Light style is #e23e38 and Dark style is #ffd600',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'color_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'content_button_bgcolor',
        'label'       => 'Button - Border Color',
        'desc'        => 'Border color of button. This setting can be overridden in a specific button shortcode. By default, Light style is #e23e38 and Dark style is #ffd600',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'color_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'content_button_hovercolor',
        'label'       => 'Button - Hover Text Color',
        'desc'        => 'Text color of button when hovered. This setting can be overridden in a specific button shortcode. By default, Light style is #fff and Dark style is #0f0f0f',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'color_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'content_button_hoverbg',
        'label'       => 'Button - Hover Background Color',
        'desc'        => 'Background color of button when hovered. This setting can be overridden in a specific button shortcode. By default, Light style is #e23e38 and Dark style is #ffd600',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'color_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'text_font',
        'label'       => 'Content Text - Font',
        'desc'        => 'Enter font-family name here. <a href="http://www.google.com/fonts/" target="_blank">Google Fonts</a> are supported. For example, if you choose "Source Code Pro" Google Font with font-weight 400,500,600, enter <i>Source Code Pro:400,500,600</i>',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'text_size',
        'label'       => 'Content Text - Size',
        'desc'        => 'Enter font size for content. For example "13px"',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'text_weight',
        'label'       => 'Content Text - Weight',
        'desc'        => 'Enter font weight for content. For example "200"',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),

      array(
        'id'          => 'h1_font',
        'label'       => 'Heading - Font (H1,H2,H3)',
        'desc'        => 'Enter font-family name here. <a href="http://www.google.com/fonts/" target="_blank">Google Fonts</a> are supported. For example, if you choose "Source Code Pro" Google Font with font-weight 400,500,600, enter <i>Source Code Pro:400,500,600</i>',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'h1_size',
        'label'       => 'H1 - Size',
        'desc'        => 'Enter font size for H1. For example, "18px" or "2em"',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'h1_weight',
        'label'       => 'H1 - Weight',
        'desc'        => 'Enter font weight for H1. For example "200"',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'h2_size',
        'label'       => 'H2 - Size',
        'desc'        => 'Enter font size for H2. For example "16px" or "1.2em"',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'h2_weight',
        'label'       => 'H2 - Weight',
        'desc'        => 'Enter font weight for H2. For example "200"',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'h3_size',
        'label'       => 'H3 - Size',
        'desc'        => 'Enter font size for H3. For example "14px" or "1em"',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'h3_weight',
        'label'       => 'H3 - Weight',
        'desc'        => 'Enter font weight for H3. For example "200"',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'nav_font',
        'label'       => 'Main Navigation - Font',
        'desc'        => 'Enter font-family name here. <a href="http://www.google.com/fonts/" target="_blank">Google Fonts</a> are supported. For example, if you choose "Source Code Pro" Google Font with font-weight 400,500,600, enter <i>Source Code Pro:400,500,600</i>',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'nav_size',
        'label'       => 'Main Navigation - Size',
        'desc'        => 'Enter font size for Navigation. For example, "18px" or "2em"',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'nav_weight',
        'label'       => 'Main Navigation - Weight',
        'desc'        => 'Enter font weight for Navigation. For example "200"',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'nav_font_style',
        'label'       => 'Heading & Navigation Font Style',
        'desc'        => 'Enter font style for Navigation & Heading. For example "italic"',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'custom_font_1',
        'label'       => 'Upload Custom Font 1',
        'desc'        => 'Upload your font, uses this font with name "Custom Font 1" in above settings',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'custom_font_2',
        'label'       => 'Upload Custom Font 2',
        'desc'        => 'Upload your font, uses this font with name "Custom Font 2" in above settings',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'blog_style',
        'label'       => 'Blog Style',
        'desc'        => 'Select blog style',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'classic',
            'label'       => 'Classic',
            'src'         => ''
          ),
          array(
            'value'       => 'wide',
            'label'       => 'Wide',
            'src'         => ''
          ),
          array(
            'value'       => 'modern',
            'label'       => 'Modern',
            'src'         => ''
          )
        ),
      ),

      array(
        'id'          => 'blog_layout',
        'label'       => 'Blog Layout',
        'desc'        => 'Select layout for Blog. This setting can be overridden in a specific page',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'left',
            'label'       => 'Sidebar Left',
            'src'         => ''
          ),
          array(
            'value'       => 'right',
            'label'       => 'Sidebar Right',
            'src'         => ''
          ),
          array(
            'value'       => 'full',
            'label'       => 'Fullwidth',
            'src'         => ''
          )
        ),
      ),

      array(
        'id'          => 'blog_show_comment_number',
        'label'       => 'Show Comment Number',
        'desc'        => 'Show number of comments info. This will affect both blog list and single post page',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'blog_show_date',
        'label'       => 'Show Date',
        'desc'        => 'Show published date info. This will affect both blog list and single post page',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'blog_show_author',
        'label'       => 'Show Author',
        'desc'        => 'Show author name info. This will affect both blog list and single post page',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'blog_show_tag',
        'label'       => 'Show Tags',
        'desc'        => 'Show item\'s tags info. This will affect blog list and single post page',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'blog_show_cat',
        'label'       => esc_html__('Show Categories','cactusthemes'),
        'desc'        => esc_html__('Show item\'s categories info. This will affect blog list and single post page','cactusthemes'),
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => esc_html__('Show','cactusthemes'),
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => esc_html__('Hide','cactusthemes'),
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'blog_show_readmore',
        'label'       => esc_html__('Show Read More Link','cactusthemes'),
        'desc'        => esc_html__('Show Read More Link','cactusthemes'),
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 1,
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => 0,
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'pagination',
        'label'       => esc_html__('Pagination','cactusthemes'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => esc_html__('Use WP-PageNavi plugin','cactusthemes'),
            'src'         => ''
          ),
          array(
            'value'       => 'default',
            'label'       => esc_html__('Default','cactusthemes'),
            'src'         => ''
          )
        ),
      ),
	  array(
		'id'          => 'sticky_tag_blog',
		'label'       => esc_html__('Sticky Tag','cactusthemes'),
		'desc'        => esc_html__('Enter the word which will be used for the Sticky Tag.','cactusthemes'),
		'std'         => '',
		'type'        => 'text',
		'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
		'choices'     => array()
	  ),
//
	  array(
        'id'          => 'event_listing_page',
        'label'       => 'Choose Event Listing page',
        'desc'        => 'Choose a page to be Event Listing page',
        'std'         => '',
        'type'        => 'page-select',
        'section'     => 'event',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
      ),
	  
      array(
        'id'          => 'event_style',
        'label'       => 'Listing Style',
        'desc'        => 'Select style for Events page',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'event',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'classic',
            'label'       => 'Classic',
            'src'         => ''
          ),
          array(
            'value'       => 'modern',
            'label'       => 'Modern',
            'src'         => ''
          )
        ),
      ),

      array(
        'id'          => 'event_layout',
        'label'       => 'Page Layout',
        'desc'        => 'Select layout for Events Listing page',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'event',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'left',
            'label'       => 'Sidebar Left',
            'src'         => ''
          ),
          array(
            'value'       => 'right',
            'label'       => 'Sidebar Right',
            'src'         => ''
          ),
          array(
            'value'       => 'full',
            'label'       => 'Fullwidth',
            'src'         => ''
          )
        ),
      ),
	  
	  array(
        'id'          => 'event_single_layout',
        'label'       => 'Single Event Layout',
        'desc'        => 'Select layout for Single Event page',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'event',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'left',
            'label'       => 'Sidebar Left',
            'src'         => ''
          ),
          array(
            'value'       => 'right',
            'label'       => 'Sidebar Right',
            'src'         => ''
          ),
          array(
            'value'       => 'full',
            'label'       => 'Fullwidth',
            'src'         => ''
          )
        ),
      ),
	  array(
		'id'          => 'number_re_event',
		'label'       => __('Related Events - Count','cactusthemes'),
		'desc'        => __('Enter number Ex:6 (default:3)','cactusthemes'),
		'std'         => '',
		'type'        => 'text',
		'section'     => 'event',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
		'choices'     => array()
	  ),
      array(
        'id'          => 'event_show_big_date_text',
        'label'       => 'Show Start Date',
        'desc'        => 'Show Start Date (big text) of event in Events Listing page',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'event',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'event_show_start_time',
        'label'       => 'Show Start Time Metadata',
        'desc'        => 'Show Start Time Metadata of event in Events Listing page',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'event',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'event_show_location',
        'label'       => 'Show Location Metadata',
        'desc'        => 'Show Location Metadata of event is Events Listing page',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'event',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'event_show_info',
        'label'       => 'Show Event Metadata',
        'desc'        => 'Show all other Metadata (except Start Time and Location) of event in Events Listing Page',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'event',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'show-related-events',
        'label'       => 'Show Related Events',
        'desc'        => '',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'event',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 1,
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => 0,
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),

      array(
        'id'          => 'pagination-event',
        'label'       => 'Pagination',
        'desc'        => '',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'event',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Use WP-PageNavi',
            'src'         => ''
          ),
          array(
            'value'       => 'default',
            'label'       => 'Default',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'event_slug',
        'label'       => 'Custom Slug for Event Custom Post Type',
        'desc'        => 'If you want to use custom slug instead of \'event\', enter value here. * Requires re-saving permalink setting after changing. Go to Settings --> Permalink to re-save',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'event',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),

      array(
        'id'          => 'related_posts',
        'label'       => 'Related Posts - Count',
        'desc'        => 'Enter number of related posts to query. Leave empty to display all',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'singe_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'conditions_posts',
        'label'       => 'Conditions',
        'desc'        => 'Condition to query related posts',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'singe_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Posts have similar Tags',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Posts in same Category',
            'src'         => ''
          ),
        ),
      ),
      array(
        'id'          => 'show_re_metadata',
        'label'       => 'Show Metadata',
        'desc'        => 'Show Metadata of items in Related Posts',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'singe_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'No',
            'src'         => ''
          ),
        ),
      ),

      array(
        'id'          => 'post_layout',
        'label'       => 'Single Post Layout',
        'desc'        => 'Select layout for a single post page. This setting can be overridden in a specific post',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'singe_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'left',
            'label'       => 'Sidebar Left',
            'src'         => ''
          ),
          array(
            'value'       => 'right',
            'label'       => 'Sidebar Right',
            'src'         => ''
          ),
          array(
            'value'       => 'full',
            'label'       => 'Fullwidth',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'blog_show_authorbio',
        'label'       => 'Show Author\'s bio',
        'desc'        => 'Show author\'s bio in single post page. This can be overridden in a specific post',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'singe_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'blog_show_socialsharing',
        'label'       => 'Social Networks sharing',
        'desc'        => 'Show social networks\' sharing icons in a single post',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'singe_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
//
	  array(
        'id'          => 'single_portfolio_layout',
        'label'       => 'Single Portfolio Layout',
        'desc'        => 'Select style for single Portfolio page',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'singe_post_portfolio',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
		'choices'     => array( 
          array(
            'value'       => 'classic',
            'label'       => 'Classic',
            'src'         => ''
          ),
          array(
            'value'       => 'wide',
            'label'       => 'Wide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'related_posts_port',
        'label'       => 'Other Projects - Count',
        'desc'        => 'Number of other projects. Portfolios with the same tags will be displayed. Enter value here (-1 for All). ',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'singe_post_portfolio',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'singe_post_portfolio_items_per_page',
        'label'       => 'Other Projects - Item Per Page',
        'desc'        => 'Number of item per page in Other Projects section',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'singe_post_portfolio',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
		'choices'     => array( 
          array(
            'value'       => '3',
            'label'       => '3',
            'src'         => ''
          ),
          array(
            'value'       => '4',
            'label'       => '4',
            'src'         => ''
          ),
		  array(
            'value'       => '5',
            'label'       => '5',
            'src'         => ''
          ),
		  array(
            'value'       => '6',
            'label'       => '6',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'porfolio_show_socialsharing',
        'label'       => 'Social Networks sharing',
        'desc'        => 'Show social networks\' sharing icons in a single post',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'singe_post_portfolio',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),

//
      array(
        'id'          => 'page_layout',
        'label'       => 'Page Layout',
        'desc'        => 'Layout of a single page. This can be overridden in a specific page',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'left',
            'label'       => 'Sidebar Left',
            'src'         => ''
          ),
          array(
            'value'       => 'right',
            'label'       => 'Sidebar Right',
            'src'         => ''
          ),
          array(
            'value'       => 'full',
            'label'       => 'Fullwidth',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'page_show_authorbio',
        'label'       => 'Show Author\'s bio',
        'desc'        => 'Show or hide author\'s bio in pages',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'single_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'page_show_socialsharing',
        'label'       => 'Social Networks',
        'desc'        => 'Show or hide social networks\' sharing icons',
        'std'         => '',
        'type'        => 'radio',
        'section'     => 'single_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
	  array(
		'id'          => 'header_height_page',
		'label'       => __('Height of page header','cactusthemes'),
		'desc'        => __('Enter number Ex:600px','cactusthemes'),
		'std'         => '',
		'type'        => 'text',
		'section'     => 'single_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
		'choices'     => array()
	  ),
      array(
        'id'          => 'portfolio_animation',
        'label'       => 'Filter Animation',
        'desc'        => 'Choose animation effect for [portfolio] shortcode when filtering',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'portfolio',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'isoptope',
            'label'       => 'Isotope',
            'src'         => ''
          ),
          array(
            'value'       => 'no',
            'label'       => 'No animation',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'portfolio_slug',
        'label'       => 'Custom Slug for Portfolio post type',
        'desc'        => 'If you want to use custom slug instead of \'portfolio\', enter value here. * Requires re-saving permalink setting after changing. Go to Settings --> Permalink to re-save',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'portfolio',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),      
      array(
        'id'          => 'social_link_open',
        'label'       => 'Open Social link in new tab?',
        'desc'        => '',
        'std'         => 'off',
        'type'        => 'select',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'off',
            'label'       => 'Disable',
            'src'         => ''
          ),
          array(
            'value'       => 'on',
            'label'       => 'Enable',
            'src'         => ''
          )
        ),
      ),

      array(
        'id'          => 'acc_facebook',
        'label'       => 'Facebook',
        'desc'        => 'Enter full link to your account (including http://)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'acc_envelope',
        'label'       => 'Email',
        'desc'        => 'Enter your email account',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'acc_twitter',
        'label'       => 'Twitter',
        'desc'        => 'Enter full link to your account (including http://)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'acc_linkedin',
        'label'       => 'LinkedIn',
        'desc'        => 'Enter full link to your account (including http://)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'acc_flickr',
        'label'       => 'Flickr',
        'desc'        => 'Enter full link to your account (including http://)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'acc_dribbble',
        'label'       => 'Dribbble',
        'desc'        => 'Enter full link to your account (including http://)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'acc_google_plus',
        'label'       => 'Google Plus',
        'desc'        => 'Enter full link to your account (including http://)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'acc_instagram',
        'label'       => 'Instagram',
        'desc'        => 'Enter full link to your account (including http://)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'acc_tumblr',
        'label'       => 'Tumblr',
        'desc'        => 'Enter full link to your account (including http://)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'acc_youtube',
        'label'       => 'YouTube',
        'desc'        => 'Enter full link to your account (including http://)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
       array(
        'id'          => 'acc_github',
        'label'       => 'GitHub',
        'desc'        => 'Enter full link to your account (including http://)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'acc_pinterest_sign',
        'label'       => 'Pinterest',
        'desc'        => 'Enter full link to your account (including http://)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_accounts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),	
	  array(
        'id'          => 'search_page',
        'label'       => 'Choose Search Page',
        'desc'        => 'Choose a page to be Search page',
        'std'         => '',
        'type'        => 'page-select',
        'section'     => 'search',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
      ),

    )
  );
  /*option base on plugin active status*/
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
  if(is_plugin_active('gameplan-portfolio/gameplan-portfolio.php')){
	  $custom_settings['sections'][]=array(
        'id'          => 'portfolio',
        'title'       => '<i class="gp_portfolio">Portfolios</i>'
      );
	  $custom_settings['sections'][]=array(
        'id'          => 'singe_post_portfolio',
        'title'       => '<i class="gp_singe_post_portfolio">Single Portfolio</i>'
      );
  }
  if(is_plugin_active('gameplan-events/gameplan-events.php')){
	  $custom_settings['sections'][]=array(
        'id'          => 'event',
        'title'       => '<i class="gp_event">Events</i>'
      );
  }
  if(is_plugin_active('gameplan-tribe-addons/gameplan-tribe-addons.php')){
	  $custom_settings['sections'][]=array(
        'id'          => 'event',
        'title'       => '<i class="gp_event">Events</i>'
      );
  }
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}