<?php

class jaw_gallery {

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

    public function jaw_gallery_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data((array) $this->model($atts));
        return jaw_get_template_part($this->_tmpl, 'simple-shortcodes');
    }

    private function model($atts) {
        $ret = array();
        $ret = $atts;
        $ret['gallery'] = array();
        
        if (isset($atts['box_size'])) {
            $size = jwUtils::get_size($atts['box_size']);
        } else {
            $size = jwUtils::get_size('12');
        }
        
        $ret['size'] = $size;
        
        if (isset($atts['box_size'])) {
            $ret['box_size'] = $atts['box_size'];
        } else {
            $ret['box_size'] = 'max';
        }
        
        if (isset($atts['gallery'])) {
            if(!is_array($atts['gallery'])){
            $atts['gallery'] = explode(',', $atts['gallery']);
            }
            foreach ((array) $atts['gallery'] as $key => $image) {
                $out = array();

                $url = wp_get_attachment_image_src($image, array($size+1, 10000));
                

                if (isset($url[0])) {
                    $url_small = wp_get_attachment_image_src($image, 'lazyload');
                    $item = get_post($image);
                    $out['alt'] = get_post_meta( $item->ID, '_wp_attachment_image_alt', true );
                    $out['caption'] = strip_tags($item->post_excerpt);
                    $out['description'] = strip_tags($item->post_content);
                    
                    $out['url'] = $url[0];
                    $out['url-small'] = $url_small[0];
                    $out['size'] = array('width' => $url[1],'height' => $url[2]); 
                    

                    $ret['gallery'][] = $out;
                }
                
            }
        }
        return $ret;
    }
}

