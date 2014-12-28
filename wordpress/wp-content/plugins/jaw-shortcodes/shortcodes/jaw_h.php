<?php

class jaw_h{

    private $_data = array();
    private $_tmpl;

    public function __construct($tmpl = null) {
        $this->class_name = get_class();
        if (isset($tmpl)) {
            $this->_tmpl = $tmpl;
        }else{
            $this->_tmpl = substr($this->class_name, 4);                
        }
        add_shortcode('h1', array($this, $this->class_name . '_shortcode'));
        add_shortcode('h2', array($this, $this->class_name . '_shortcode'));
        add_shortcode('h3', array($this, $this->class_name . '_shortcode'));
        add_shortcode('h4', array($this, $this->class_name . '_shortcode'));
        add_shortcode('h5', array($this, $this->class_name . '_shortcode'));
        add_shortcode('h6', array($this, $this->class_name . '_shortcode'));
    }

    public function jaw_h_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data($this->model($content,$code));
        return jaw_get_template_part($this->_tmpl,'simple-shortcodes');
    }
    
    
    private function model($content = '',$code = ''){
        $atts['content'] = $content;
        $atts['code'] = $code;
        
        if (isset($atts['box_size'])) {
            $atts['box_size'] = $atts['box_size'];
        } else {
            $atts['box_size'] = 'max';
        }
        
        return $atts;
    } 
}
