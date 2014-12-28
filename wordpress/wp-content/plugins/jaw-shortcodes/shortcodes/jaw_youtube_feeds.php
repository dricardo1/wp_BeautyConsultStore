<?php

class jaw_youtube_feeds {

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

    public function jaw_youtube_feeds_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data($this->model((array) $atts));
        return jaw_get_template_part($this->_tmpl, 'simple-shortcodes');
    }

    private function model($atts) {
        
        if (isset($atts['user_name'])) {
            $url = 'http://gdata.youtube.com/feeds/api/users/' . $atts['user_name'] . '/uploads';

            $reponse = wp_remote_request($url, array('method' => 'GET'));

            if ($reponse instanceof WP_Error) {
                $http = new WP_Http;
                $reponse = $http->request($url, array('timeout' => 60, 'sslverify' => false));
            }


            if (isset($reponse["errors"]['http_request_failed']))
                return null;

            $data = new SimpleXMLElement($reponse["body"]);
            $videos = array();
            $count = 1;
            foreach ($data->entry as $i => $v) {
                $video['title'] = $v->title;
                if ($v->content == '') {
                    $video['content'] = $v->title;
                } else {
                    $video['content'] = $v->content;
                }
                $video['link'] = $v->link;
                $videos[] = $video;
                $count++;
                if (isset($atts['count']) && $count > $atts['count']) {
                    break;
                }
            }
            $atts['title'] = $data->title;
            $atts['url'] = 'http://www.youtube.com/' . $atts['user_name'];
            $atts['ylogo'] = $data->logo;
            $atts['videos'] = $videos;
            if (isset($atts['box_title'])) {
                $atts['box_title'] = $atts['box_title'];
            } else {
                $atts['box_title'] = '';
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
