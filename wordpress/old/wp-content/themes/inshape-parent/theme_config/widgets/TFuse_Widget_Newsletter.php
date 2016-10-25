<?php

// =============================== Newsletetr widget ======================================

class TFuse_newsletter extends WP_Widget {

    function TFuse_newsletter() {
        $widget_ops = array('description' => '');
        parent::__construct(false, __('TFuse - Newsletter', 'tfuse'), $widget_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $newsletter_title = empty($instance['newsletter_title']) ? 'Newsletter' : esc_attr($instance['newsletter_title']);
        $rss = empty($instance['rss']) ? '' : esc_attr($instance['rss']);
        $text = empty($instance['text']) ? '' : esc_attr($instance['text']);
        ?>

<div class="widget widget-newsletter newsletter_subscription_box newsletterBox">
                <?php if ($newsletter_title != '') { ?><h3 class="widget-title"><?php echo tfuse_qtranslate($newsletter_title); ?></h3><?php } ?>
                
                <div class="newsletter_subscription_messages before-text">
                    <div class="newsletter_subscription_message_initial">
                        <?php _e('','tfuse') ?>
                    </div>
                    <div class="newsletter_subscription_message_success">
                        <?php _e('Thank you for your subscription.','tfuse') ?>
                    </div>
                    <div class="newsletter_subscription_message_wrong_email">
                        <?php _e('Your email format is wrong!','tfuse') ?>
                    </div>
                    <div class="newsletter_subscription_message_failed">
                        <?php _e('Sad, but we couldn\'t add you to our mailing list ATM.','tfuse') ?>
                    </div>
                </div>
                <div class="widget-content">
                    <p><?php echo $text;?></p>
                </div>
                <form action="#" method="post" class="newsletter_subscription_form">
                    <div class="field-text buttoned">
                        <input type="text" value="" name="newsletter" id="newsletter" class="newsletter_subscription_email" placeholder="<?php _e('Enter Your Email','tfuse') ?>" />
                        <button type="submit" class="newsletter_subscription_submit" ><i class="tficon-arrow-right"></i></button>
                    </div>
                    <div class="newsletter_subscription_ajax"> <?php _e('Loading...','tfuse') ?></div>
                    <div class="newsletter_text">
                        <?php if ($rss == 'on') { ?>
                        <a class="newssetter_subscribe" href="<?php echo tfuse_options('feedburner_url', get_bloginfo_rss('rss2_url'));?>"><?php  _e('I also want to subscribe to the RSS Feed', 'tfuse');?></a>
                        <?php } ?>
                    </div>
                </form>
        </div>
        <?php
    }

    function update($new_instance, $old_instance) {
		$new_instance = wp_parse_args( (array) $new_instance, array('rss' => '','text' => '') );
                
                $new_instance['text'] = $new_instance['text'];
                
        return $new_instance;
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('newsletter_title' => '', 'rss' => '',  'text' => ''));
        $newsletter_title = esc_attr($instance['newsletter_title']);
        $rss = esc_attr($instance['rss']);
        $text = ($instance['text']);
		
        ?>
		
        <p>
            <label for="<?php echo $this->get_field_id('newsletter_title'); ?>"><?php _e('Title:', 'tfuse'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('newsletter_title'); ?>" value="<?php echo $newsletter_title; ?>" class="widefat" id="<?php echo $this->get_field_id('newsletter_title'); ?>" />
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Newsletter Text:', 'tfuse'); ?></label></p>
            <textarea  rows="8" cols="31" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text;?></textarea>
        
       <p>
            <label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('Activate RSS', 'tfuse'); ?>:</label>
            <?php if ($rss=='on') $checked = ' checked="checked" '; else $checked = ''; ?>
            <input <?php echo $checked; ?>  type="checkbox" name="<?php echo $this->get_field_name('rss'); ?>" class="checkbox" id="<?php echo $this->get_field_id('rss'); ?>" />
        </p>
        <?php
    }

}

register_widget('TFuse_newsletter');
