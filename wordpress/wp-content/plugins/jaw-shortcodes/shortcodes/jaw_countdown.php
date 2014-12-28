<?php

class jaw_countdown {

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

    public function jaw_countdown_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data($this->model((array) $atts));
        return jaw_get_template_part($this->_tmpl, 'simple-shortcodes');
    }

    private function model($atts) {

        $atts['id'] = rand(1000, 10000);
        if (isset($atts['datetime'])) {
            preg_match('/([0-9][0-9][0-9][0-9])\-([0-9][0-9])\-([0-9][0-9])\-([0-9][0-9])\-([0-9][0-9])\-([0-9][0-9])/', $atts['datetime'], $match);
            if (sizeof($match) == 7) {
                $atts['years'] = $match[1];
                $atts['months'] = $match[2]-1;
                $atts['days'] = $match[3];
                $atts['hours'] = $match[4];
                $atts['minutes'] = $match[5];
                $atts['seconds'] = $match[6];
            }
        }
        if (isset($atts['type'])) {
            $atts['type'] = $atts['type'];
        }
        
        if (isset($atts['bar_show'])) {
            $atts['bar_show'] = $atts['bar_show'];
        }
        
        if (isset($atts['bar_type'])) {
            $atts['bar_type'] = $atts['bar_type'];
        }

        if (isset($atts['color'])) {
            $atts['color'] = $atts['color'];
        }
        
        if (isset($atts['box_size'])) {
            $atts['box_size'] = $atts['box_size'];
        } else {
            $atts['box_size'] = 'max';
        }
        
        if (isset($atts['box_title'])) {
            $atts['box_title'] = $atts['box_title'];
        }
        
        return $atts;
    }
}
