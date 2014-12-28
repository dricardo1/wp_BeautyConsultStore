<?php

class jaw_accordion {

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

    public function jaw_accordion_shortcode($atts, $content = null, $code = null) {        
        jaw_template_set_data($this->model($content));
        return jaw_get_template_part($this->_tmpl, 'simple-shortcodes');
    }    
    
    private function model($content) {
        $atts['content'] = $content;
        $atts['box_size'] = jaw_template_get_var('size','max');
        return $atts;
    }
        
}