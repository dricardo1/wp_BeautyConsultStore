<?php

class jaw_custom_text {

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

    public function jaw_custom_text_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data((array) $this->model($atts));
        return jaw_get_template_part($this->_tmpl, 'simple-shortcodes');
    }

    private function model($atts) {


        if (isset($atts['use_bg']) && $atts['use_bg'] == '1') {

            if (isset($atts['box_size'])) {
                $atts['box_size'] = $atts['box_size'];
                $atts['size'] = jwUtils::get_size($atts['box_size'], true);
            } else {
                $atts['box_size'] = 'max';
                $atts['size'] = 'original';
            }

            if (isset($atts['bg_image'])) {

                if (isset($atts['bg_image'][0]->id)) {

                    $url = wp_get_attachment_image_src($atts['bg_image'][0]->id, array($atts['size'] + 1, 10000));
                    $atts['bg_image'] = $url[0];
                } else {

                    $atts['bg_image'] = $atts['bg_image'];
                }
            }
        }
        return $atts;
    }

}
