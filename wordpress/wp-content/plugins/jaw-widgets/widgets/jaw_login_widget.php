<?php

/**
 * jwlogin_widget
 * 
 * 
 */
class jaw_login_widget extends jaw_default_widget {
    
    protected $options = array(        
        0 => array(
            'id' => 'login_form_title_before',
            'description' => 'Title before login:',
            'type' => 'text', // 
            'default' => ''),
        1 => array(
            'id' => 'login_form_title_after',
            'description' => 'Title after login',
            'type' => 'text', // 
            'default' => ''
        )
    );

    function jaw_login_widget() {
        $options = array('classname' => 'jw_login_widget', 'description' => "Theme-based login window");
        $controls = array('width' => 250, 'height' => 200);
        $this->WP_Widget('jw_login_widget', 'J&W - Login  Widget', $options, $controls);
    }

    function widget($args, $instance) {
        
        $ret['args'] = $args;
        $ret['instance'] = $instance;
        extract($args);     

        echo $before_widget;
        
        if (is_user_logged_in()) {
            if (strlen($instance['login_form_title_after']) > 0) {
                echo $before_title . $instance['login_form_title_after'] . $after_title;
            }
        } else {
            if (strlen($instance['login_form_title_before']) > 0) {
                echo $before_title . $instance['login_form_title_before'] . $after_title;
            }
        }
        
        jaw_template_set_data($ret, $this);
        echo do_shortcode('[jaw_login]');
        
        echo $after_widget;
    }
}

