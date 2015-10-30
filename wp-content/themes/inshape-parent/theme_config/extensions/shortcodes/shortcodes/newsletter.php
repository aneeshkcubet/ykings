<?php

/**
 * Newsletter
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * title: e.g. Newsletter signup
 * text: e.g. Thank you for your subscription.
 * action: URL where to send the form data.
 * rss_feed:
 */

function tfuse_newsletter($atts, $content = null)
{
    extract(shortcode_atts(array('title' => '', 'text' => '', 'rss_feed' => ''), $atts));

    if (empty($title))
        $title = __('Newsletter', 'tfuse');
    if (empty($text))
        $text = __('', 'tfuse');

    $out = '
    <div class="widget widget-newsletter newsletter_subscription_box">
        <h3 class="widget-title">' . $title . '</h3> 
                <div class="newsletter_subscription_messages before-text">
                    <div class="newsletter_subscription_message_initial">
                        '. __('','tfuse').' 
                    </div>
                    <div class="newsletter_subscription_message_success">
                        '.__('Thank you for your subscription.','tfuse').'
                    </div>
                    <div class="newsletter_subscription_message_wrong_email">
                        '.__('Your email format is wrong!','tfuse') .'
                    </div>
                    <div class="newsletter_subscription_message_failed">
                        '. __('Sad, but we couldn\'t add you to our mailing list ATM.','tfuse') .'
                    </div>
                </div>
                <div class="widget-content">
                    <p>'.$text.'</p>
                </div>
                <form action="#" method="post" class="newsletter_subscription_form">
                        <div class="field-text buttoned">
                            <input type="text" value="" name="newsletter" id="newsletter" class="newsletter_subscription_email" placeholder="'. __('Enter Your Email', 'tfuse').'"/>
                            <button type="submit" title="Subscribe" class="newsletter_subscription_submit"><i class="tficon-arrow-right"></i></button>
                        </div>
                        <div class="newsletter_subscription_ajax">'. __('Loading...','tfuse') .'</div>
                        <div class="newsletter_text">';
                if ($rss_feed != 'false') {  
                    $out .= '<a class="newssetter_subscribe" href="'.tfuse_options('feedburner_url', get_bloginfo_rss('rss2_url')).'">'. __('I also want to subscribe to the RSS Feed', 'tfuse').'</a>';
                        } 
                        $out .= '
                        </div>
                </form>
        </div>';
        

    return $out;
}

$atts = array(
    'name' => __('Newsletter','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Enter the title of the Newsletter form','tfuse'),
            'id' => 'tf_shc_newsletter_title',
            'value' => __('Newsletter','tfuse'),
            'type' => 'text'
        ),
        array(
            'name' => __('Text','tfuse'),
            'desc' => __('Specify the newsletter message','tfuse'),
            'id' => 'tf_shc_newsletter_text',
            'value' => __('Sign up for our weekly newsletter to receive updates, news, and promos:','tfuse'),
            'type' => 'textarea'
        ),
        array(
            'name' => __('RSS Feed','tfuse'),
            'desc' => __('Show RSS Feed link?','tfuse'),
            'id' => 'tf_shc_newsletter_rss_feed',
            'value' => 'false',
            'type' => 'checkbox'
        )
    )
);

tf_add_shortcode('newsletter', 'tfuse_newsletter', $atts);
