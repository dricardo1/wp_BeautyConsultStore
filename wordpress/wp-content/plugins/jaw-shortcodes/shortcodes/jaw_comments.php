<?php

class jaw_comments {

    private $_data = array();
    private $_tmpl;

    public function __construct($tmpl = null) {
        $this->class_name = get_class();
        if (isset($tmpl)) {
            $this->_tmpl = $tmpl;
        } else {
            $this->_tmpl = substr($this->class_name, 4);
        }
        add_shortcode($this->class_name, array($this, $this->class_name . '_shortcode'));
    }

    public function jaw_comments_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data($this->model((array) $atts));
        return jaw_get_template_part($this->_tmpl, 'simple-shortcodes');
    }

    private function model($atts) {
 
        shortcode_atts(array(
            'number' => '12',
            'offset' => '',
            'orderby' => 'comment_date_gmt ',
            'order' => 'DESC',
            'post_id' => 0,
            'post_type' => '',
            'status' => '',
            'animate' => '1',
            'animate_style' => 'slide',
            'animate_duration' => '800',
            'animate_direction' => 'left',
            'animate_easing' => 'slide'
                ), $atts);
        
        $atts['comments'] = get_comments($atts);
        
        if (isset($atts['box_title'])) {
            $atts['box_title'] = $atts['box_title'];
        }
        
        if (isset($atts['box_size'])) {
            $atts['box_size'] = $atts['box_size'];
        } else {
            $atts['box_size'] = 'max';
        }
        
        //$atts = array_merge($atts, $atts);
        
        return $atts;
    }
}
