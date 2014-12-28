<?php

/**
 * 
 * 
 * 
 */
class jaw_latest_post_widget extends jaw_default_widget {
    
    protected $options = array(        
        0 => array(
            'id' => 'latest_post_title',
            'description' => 'Widget title:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => ''),
        1 => array(
            'id' => 'posts_categories',
            'description' => 'Exclude / include categories by id. E.g. 1,5,-8:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => ''
        ),
         2 => array(
            'id' => 'number_of_posts',
            'description' => 'Number of Posts',
            'type' => 'text', // [[ text, check, select ]]
            'default' => ''
        )
    );

    function jaw_latest_post_widget() {
        $options = array('classname' => 'jaw_latest_post_widget', 'description' => "Latest post widget.");
        $controls = array('width' => 250, 'height' => 200);
        $this->WP_Widget('jaw_latest_post_widget', 'J&W - Latest Post Widget', $options, $controls);
    }

    private function _print_widget($args, $instance, $postData) {
        global $post;

        if (!isset($instance["time_format"])) {
            $instance["time_format"] = 'F j, Y';
        }
        $ret['args'] = $args;
        $ret['instance'] = $instance;
        $ret['postData'] = $postData;

        jaw_template_set_data($ret, $this);
        echo jaw_get_template_part('jaw_latest_post_widget', 'widgets');
    }

    function widget($args, $instance) {
        $post_args = array(
            'posts_per_page' => $instance['number_of_posts'],
            'offset' => 0,
            'category' => $instance['posts_categories'],
            'orderby' => 'post_date',
            'order' => 'DESC',
            'include' => '',
            'exclude' => '',
            'meta_key' => '',
            'meta_value' => '',
            'post_type' => 'post',
            'post_mime_type' => '',
            'post_parent' => '',
            'post_status' => 'publish',
            'suppress_filters' => true
        );
        $postData = $this->_get_latest_post($post_args);
        $this->_print_widget($args, $instance, $postData);
    }

    private function _get_latest_post($args) {
        $posts = get_posts($args);
        return $posts;
    }

}
