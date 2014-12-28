<?php

class jaw_y_video {

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

    public function jaw_y_video_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data($this->model((array) $atts));
        return jaw_get_template_part($this->_tmpl, 'simple-shortcodes');
    }

    private function model($atts) {

        shortcode_atts(array(
            'clip_id' => '',
            'width' => '100%',
            'height' => '300',
            'autohide' => '2',
            'autoplay' => '0',
            'loop' => '0',
            'rel' => '1',
            'playlist' => false,
                ), $atts);

        if (!isset($atts['width'])) {
            $atts['width'] = '100%';
        }
        if (!isset($atts['height'])) {
            $atts['height'] = '300';
        }

        if (isset($atts['playlist'])) {
            $playlist = array();

            foreach ((array) $atts['playlist'] as $key => $id) {
                if (isset($id->playlist)) {
                    $video = jwShortcodeUtils::get_video_info($id->playlist);
                    $playlist[] = $video->id;
                }
            }
            $atts['playlist'] = implode(',', $playlist);
        }
        if (isset($atts['clip_id'])) {
            if (class_exists('jwUtils')) {
                $atts['clip_info'] = jwUtils::get_video_info($atts['clip_id']);
            } else {
                $atts['clip_info']->id = $atts['clip_id'];
            }
        }

        $atts['url'] = 'http://www.youtube.com/embed/';

        if (isset($atts['clip_info']->id)) {
            $atts['url'] .= $atts['clip_info']->id;
            if (isset($atts['autohide'])) {
                $atts['url'] .= '?autohide=' . $atts['autohide'];
            }
            if (isset($atts['autoplay'])) {
                $atts['url'] .= '&autoplay=' . $atts['autoplay'];
            }
            if (isset($atts['loop'])) {
                $atts['url'] .= '&loop=' . $atts['loop'];
            }
            if (isset($atts['rel'])) {
                $atts['url'] .= '&rel=' . $atts['rel'];
            }
            if (isset($atts['playlist']) && $atts['playlist']) {
                $atts['url'] .= '&playlist=' . $atts['playlist'];
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
