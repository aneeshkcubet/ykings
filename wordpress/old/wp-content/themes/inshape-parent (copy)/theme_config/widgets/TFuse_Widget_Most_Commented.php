<?php
// =============================== Recent Posts Widget ======================================

class TFuse_Widget_Most_Commented extends WP_Widget {

    function TFuse_Widget_Most_Commented() {
        $widget_ops = array('description' => '' );
        parent::WP_Widget(false, __('TFuse - Most Commented', 'tfuse'),$widget_ops);
    }

    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Most Commented','tfuse') : $instance['title'], $instance, $this->id_base);
        $number = esc_attr($instance['number']);
        if ($number>0) {} else $number = 8;
    ?>

 <div class="widget widget-most-comment">
     <h3 class="widget-title"><?php echo tfuse_qtranslate($title); ?></h3>
        <ul class="side-postlist">
            <?php
            $pop_posts =  tfuse_shortcode_posts(array(
                                'sort' => 'commented',
                                'items' => $number,
                                'image_post' => false,
                            ));

            foreach($pop_posts as $post_val):?>
                <li>
                    <a href="<?php echo $post_val['post_link']; ?>"><strong><?php echo $post_val['post_comnt_numb'];?></strong><span><?php echo $post_val['post_title']; ?></span></a>
                </li>

            <?php endforeach; ?>
        </ul>
    </div>

    <?php
    }

   function update($new_instance, $old_instance) {
       $new_instance['b'] = isset($new_instance['b']);
       return $new_instance;
   }

   function form($instance) {
        $instance = wp_parse_args( (array) $instance, array(  'title' => '', 'number' => '') );
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number = esc_attr($instance['number']);
        ?>

       <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label>
       <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts','tfuse'); ?>:</label>
            <input type="text" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $number; ?>" class="widefat" id="<?php echo $this->get_field_id('number'); ?>" />
        </p>

    <?php
    }
}

register_widget('TFuse_Widget_Most_Commented');
