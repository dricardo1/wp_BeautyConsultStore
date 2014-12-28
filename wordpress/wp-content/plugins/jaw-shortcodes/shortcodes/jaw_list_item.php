<?php

class jaw_list_item{

    private $_data = array();
    private $_tmpl;

    public function __construct($tmpl = null) {
        $this->class_name = get_class();
        if (isset($tmpl)) {
            $this->_tmpl = $tmpl;
        }else{
            $this->_tmpl = substr($this->class_name, 4);                
        }
        add_shortcode($this->class_name, array($this, $this->class_name . '_shortcode'));
    }

    public function jaw_list_item_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data($this->model($atts));
        return jaw_get_template_part($this->_tmpl,'simple-shortcodes');
    }
    
    
    private function model($atts){
        return array_merge(jaw_template_get_data(),$atts); 
    }   
}