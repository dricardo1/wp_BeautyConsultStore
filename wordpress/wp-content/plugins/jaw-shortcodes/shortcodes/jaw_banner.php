<?php

class jaw_banner {

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

    public function jaw_banner_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data($this->model((array) $atts));
         return jaw_get_template_part('jaw_banner_widget', 'widgets');
    }

    private function model($atts) {
        if (isset($atts['banner'])) {
            $atts['instance']['custom_banner'] = $atts['banner'];
        }
        $atts['args']['before_widget'] = '';
        $atts['args']['after_widget'] = '';
        return $atts;
    }

}
