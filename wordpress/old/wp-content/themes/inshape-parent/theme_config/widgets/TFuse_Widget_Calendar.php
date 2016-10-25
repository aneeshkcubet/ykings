<?php
class TFuse_Widget_Calendar extends WP_Widget {

	function TFuse_Widget_Calendar() {
		$widget_ops = array('classname' => 'widget_calendar', 'description' => __( 'A calendar of your site&#8217;s posts','tfuse') );
		parent::__construct('calendar', __('TFuse Calendar','tfuse'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
                $title = apply_filters('widget_title', empty($instance['title']) ? __('','tfuse') : $instance['title'], $instance, $this->id_base);
                $link = apply_filters('widget_link', empty($instance['link']) ? __('','tfuse') : $instance['link'], $instance, $this->id_base);
                $before_title = '<h3 class="widget-title">';
		$after_title = '</h3>';
		$before_widget = ' <div class="widget widget-calendar">
                                ';
		$after_widget = '</div>';
		$title = tfuse_qtranslate($title);
		echo $before_widget;
                if ( $title )
                    echo $before_title . $title . $after_title;
                
		echo '<div id="calendar_wrap">';
                    get_calendar(false);
		echo '</div>';
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
                $instance['title'] = $new_instance['title'];
                $instance['link'] = $new_instance['link'];
		
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array('title' => '', 'link' => '') );
                $title = $instance['title'];
                $link = $instance['link'];
?>
<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

    <?php
	}
}


function TFuse_Unregister_WP_Widget_Calendar() {
	unregister_widget('WP_Widget_Calendar');
}
add_action('widgets_init','TFuse_Unregister_WP_Widget_Calendar');

register_widget('TFuse_Widget_Calendar');
