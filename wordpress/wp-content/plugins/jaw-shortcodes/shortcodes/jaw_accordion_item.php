<?php

class jaw_accordion_item {

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

    public function jaw_accordion_item_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data($this->model($atts, $content));
        return jaw_get_template_part($this->_tmpl, 'simple-shortcodes');
    }

    private function model($atts, $content) {
      
        extract(shortcode_atts(array(
                    'class' => 'colapse',
                    'title' => '',
                        ), $atts));
        $atts['class'] = $class;
        $atts['title'] = $title;
        if(isset($content)){
            $atts['content'] = $content;
        }else{
            $atts['content'] = '';
        }
        return $atts;
    }

}
