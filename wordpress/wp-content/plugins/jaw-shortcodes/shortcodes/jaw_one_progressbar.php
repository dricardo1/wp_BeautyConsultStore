<?php

class jaw_one_progressbar {

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

    public function jaw_one_progressbar_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data($this->model($atts));
        return jaw_get_template_part($this->_tmpl, 'simple-shortcodes');
    }

    private function model($atts = array()) {
        
        $atts['animate'] = jaw_template_get_var('animate');
        $atts['animate_style'] = jaw_template_get_var('animate_style');
        $atts['animate_duration'] = jaw_template_get_var('animate_duration');
        $atts['animate_direction'] = jaw_template_get_var('animate_direction');
        $atts['animate_easing'] = jaw_template_get_var('animate_easing');
        
        if (isset($atts['box_size'])) {
            $atts['box_size'] = $atts['box_size'];
        } else {
            $atts['box_size'] = 'max';
        }        

        return $atts;
    }
}
