<?php

class jaw_banner_widget extends jaw_default_widget {

    /**
     *  Defining the widget options
     */
    protected $options = array(
        0 => array('id' => 'custom_banner',
            'description' => 'Banner',
            'type' => 'select',
            'values' => array(
                array('name' => 'Custom Banner 1', 'value' => '1'),
                array('name' => 'Custom Banner 2', 'value' => '2')
            ),
            'default' => 'custom_banner_1',
        ),
    );

    /**
     * Registering the widget to the wordpress
     */
    function jaw_banner_widget() {
        $options = array('classname' => 'jwBannerWidget', 'description' => "The widget for displaying your custom Banner");
        $controls = array('width' => 250, 'height' => 200);
        $this->WP_Widget('jwBannerWidget', 'J&W - Custom Banner Widget', $options, $controls);
    }

    function widget($args, $instance) {
        $ret['args'] = $args;
        $ret['instance'] = $instance;

        jaw_template_set_data($ret, $this);
        echo jaw_get_template_part('jaw_banner_widget', 'widgets');
    }

}

?>