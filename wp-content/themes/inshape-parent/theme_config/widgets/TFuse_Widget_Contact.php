<?php
class TFuse_Widget_Contact extends WP_Widget
{

    function TFuse_Widget_Contact()
    {
        $widget_ops = array('classname' => 'widget_contact', 'description' => __( 'Add Contact in Sidebar','tfuse') );
        $this->WP_Widget('contact', __('TFuse Contact Widgets','tfuse'), $widget_ops);
    }

    function widget( $args, $instance )
    {
        extract($args);
        
        echo '<div class="contact-address">';
        if ( $instance['adress'] != '')
        {
                 echo'<h6 class="title">'.__('ADDRESS','tfuse').'</h6>
                      '.$instance['adress'];
        }
        if ( $instance['name'] != '')
        {
            echo '<h6 class="title">'.__('OPENING HOURS','tfuse').'</h6>
                    <p>'.$instance['name'].'</p>';
        }
        if ( $instance['phone'] != '')
        {
            echo '<h6 class="title">'.__('PHONE NUMBER','tfuse').'</h6>';
            echo $instance['phone'];
        }
        echo '</div>';
    }

    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $new_instance = wp_parse_args( (array) $new_instance, array( 'title'=>'', 'name' => '','adress' => '','phone' => '') );

        $instance['phone']      = $new_instance['phone'];
        $instance['name']      = $new_instance['name'];
        $instance['adress']      = $new_instance['adress'];
   

        return $instance;
    }

    function form( $instance )
    {
        $instance = wp_parse_args( (array) $instance, array( 'title'=>'', 'email_1' => '','name' => '','adress' => '','phone' => '','fax'=>'','facebook' => '','twitter'=>'') );
?>
    <p>
        <label for="<?php echo $this->get_field_id('adress'); ?>"><?php _e('Adress:','tfuse'); ?></label><br/>
        <input class="widefat " id="<?php echo $this->get_field_id('adress'); ?>" name="<?php echo $this->get_field_name('adress'); ?>" type="text" value="<?php echo esc_attr($instance['adress']); ?>" />
    </p>
     <p>
        <label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Opening Hours:','tfuse'); ?></label><br/>
        <input class="widefat " id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" type="text" value="<?php echo  esc_attr($instance['name']); ?>"  />
    </p>
    
    <p>
        <label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone:','tfuse'); ?></label><br/>
       <input class="widefat " id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo esc_attr($instance['phone']); ?>" />
    </p>
    
    <?php
    }
}
register_widget('TFuse_Widget_Contact');
