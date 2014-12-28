<?php

class jaw_social_icons {

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

    public function jaw_social_icons_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data($this->model((array) $atts));
        return jaw_get_template_part($this->_tmpl, 'simple-shortcodes');
    }

    private function model($atts) {



        if (isset($atts['use_author']) && $atts['use_author'] == '1') {
            if (isset($atts['build_authors'])) {
                $author = get_user_by('id', $atts['build_authors']);
                $all_meta_for_user = get_user_meta($author->data->ID);
                $atts['social'] = array();
                if (isset($all_meta_for_user['facebook'][0])) {
                    $atts['social']['facebook'] = $all_meta_for_user['facebook'][0];
                }
                if (isset($all_meta_for_user['twitter'][0])) {
                    $atts['social']['twitter'] = $all_meta_for_user['twitter'][0];
                }
                if (isset($all_meta_for_user['google'][0])) {
                    $atts['social']['google'] = $all_meta_for_user['google'][0];
                }
                if (isset($all_meta_for_user['youtube'][0])) {
                    $atts['social']['youtube'] = $all_meta_for_user['youtube'][0];
                }
                if (isset($all_meta_for_user['linkedin'][0])) {
                    $atts['social']['linkedin'] = $all_meta_for_user['linkedin'][0];
                }
                if (isset($all_meta_for_user['vimeo'][0])) {
                    $atts['social']['vimeo'] = $all_meta_for_user['vimeo'][0];
                }
                if (isset($all_meta_for_user['flickr'][0])) {
                    $atts['social']['flickr'] = $all_meta_for_user['flickr'][0];
                }
            }
        } else {
            $atts['social'] = array();
            if (isset($atts['facebook']) && $atts['facebook'] != "") {
                $atts['social']['facebook'] = $atts['facebook'];
            }
            if (isset($atts['twitter']) && $atts['twitter'] != "") {
                $atts['social']['twitter'] = $atts['twitter'];
            }
            if (isset($atts['google']) && $atts['google'] != "") {
                $atts['social']['google'] = $atts['google'];
            }
            if (isset($atts['youtube']) && $atts['youtube'] != "") {
                $atts['social']['youtube'] = $atts['youtube'];
            }
            if (isset($atts['linkedin']) && $atts['linkedin'] != "") {
                $atts['social']['linkedin'] = $atts['linkedin'];
            }
            if (isset($atts['vimeo']) && $atts['vimeo'] != "") {
                $atts['social']['vimeo'] = $atts['vimeo'];
            }
            if (isset($atts['flickr']) && $atts['flickr'] != "") {
                $atts['social']['flickr'] = $atts['flickr'];
            }
            if (isset($atts['pinterest']) && $atts['pinterest'] != "") {
                $atts['social']['pinterest'] = $atts['pinterest'];
            }
            if (isset($atts['instagram']) && $atts['instagram'] != "") {
                $atts['social']['instagram'] = $atts['instagram'];
            }
        }
        
        if (isset($atts['box_size'])) {
            $atts['box_size'] = $atts['box_size'];
        } else {
            $atts['box_size'] = 'max';
        }
        
        return $atts;
    }

}
