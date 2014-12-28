<?php

class jaw_paralax_video {

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

    public function jaw_paralax_video_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data($this->model((array) $atts));
        return jaw_get_template_part($this->_tmpl, 'simple-shortcodes');
    }

    private function model($atts) {
        shortcode_atts(array(
            'custom_text' => '',
            'bg_video_mp4_src' => '',
            'bg_video_ogg_src' => '',
            'bg_video_image' => '',
            'bg_video_color' => '#000000',
            'pattern' => '',
            'padding' => '',
            'bar_type' => ''
                ), $atts);

        if (isset($atts['bg_video_mp4_src'][0]->id)) {
            $atts['bg_video_mp4_url'] = wp_get_attachment_url($atts['bg_video_mp4_src'][0]->id);
        }

        if (isset($atts['bg_video_ogg_src'][0]->id)) {
            
            $atts['bg_video_ogg_url'] = wp_get_attachment_url($atts['bg_video_ogg_src'][0]->id);
            $atts['bg_video_ogg_type'] = substr(get_post_mime_type($atts['bg_video_ogg_src'][0]->id), 6);
        }
        if (isset($atts['bg_video_image'][0]->id)) {
            $url = wp_get_attachment_image_src($atts['bg_video_image'][0]->id, 'full');
            $atts['bg_video_image_url'] = $url[0];
        }
        return $atts;
    }

}
