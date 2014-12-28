<?php

class jaw_author {

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

    public function jaw_author_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data($this->model((array) $atts));
        return jaw_get_template_part($this->_tmpl, 'simple-shortcodes');
    }

    private function model($atts) {
   
        if (isset($atts['build_authors'])) {
            $author = get_user_by('id', $atts['build_authors']);
            if (isset($author->data->ID)) {
                $atts['id'] = $author->data->ID;
            }
            if (isset($author->data->user_nicename)) {
                $atts['nicename'] = $author->data->user_nicename;
            }
            if (isset($author->data->user_email)) {
                $atts['email'] = $author->data->user_email;
            }
            if (isset($author->data->user_registered)) {
                $atts['registered'] = $author->data->user_registered;
            }
            if (isset($author->data->display_name)) {
                $atts['name'] = $author->data->display_name;
            }
            if (isset($author->data->user_status)) {
                $atts['status'] = $author->data->user_status;
            }
            if (isset($author->data->user_url)) {
                $atts['url'] = $author->data->user_url;
            }
            if (isset($atts['box_title'])) {
                $atts['box_title'] = $atts['box_title'];
            }
            if (isset($atts['box_size'])) {
                $atts['box_size'] = $atts['box_size'];
            } else {
                $atts['box_size'] = 'max';
            }
        }
        return $atts;
    }

}
