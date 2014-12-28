<?php

class jaw_image {

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

    public function jaw_image_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data((array) $this->model($atts));
        return jaw_get_template_part($this->_tmpl, 'simple-shortcodes');
    }

    private function model($atts) {


        if (isset($atts['box_size'])) {
            $atts['size'] = jwUtils::get_size($atts['box_size'], true);
            $image_size = array($atts['size'] + 1, 10000);
        } else {
            $atts['size'] = 'max';
            $atts['box_size'] = 'max';
            $image_size = 'large';
        }
        
        if (isset($atts['box_size'])) {
            $atts['box_size'] = $atts['box_size'];
        } else {
            $atts['box_size'] = 'max';
        }
  
        if (isset($atts['image'])) {
            if ((is_array($atts['image']) && isset($atts['image'][0]))  || is_numeric($atts['image'])) {
                $atts['image'][0] = json_decode(json_encode($atts['image'][0]));
                if (isset($atts['image'][0]->id)) {
                    $id = $atts['image'][0]->id;
                } else {
                    $id = $atts['image'];
                }
                $meta = wp_get_attachment_metadata($id);

                if (isset($meta['image_meta']) && isset($meta['image_meta']['caption'])) {
                    $atts['caption'] = $meta['image_meta']['caption'];
                }
                $url = wp_get_attachment_image_src($id, $image_size);
                $url_small = wp_get_attachment_image_src($id, $image_size);

                $atts['url'] = $url[0];
                $atts['url-small'] = $url_small[0];
                $atts['url-size'] = array('width' => $url[1], 'height' => $url[2]);
            } else {
                $atts['url'] = $atts['image'];
            }
        }

        if (isset($atts['hover_image'])) {

            if ((isset($atts['hover_image'][0]) && isset($atts['hover_image'][0]->id) && $atts['hover_image'][0]->id != '' ) || (isset($atts['hover_image']) && is_numeric($atts['hover_image']))) {
                if (isset($atts['hover_image'][0]->id)) {
                    $id_hover = $atts['hover_image'][0]->id;
                } else {
                    $id_hover = $atts['hover_image'];
                }

                $meta = wp_get_attachment_metadata($id_hover);

                if (isset($meta['image_meta']['caption'])) {
                    $atts['hover_caption'] = $meta['image_meta']['caption'];
                }
                $url = wp_get_attachment_image_src($id_hover, $image_size);
                $url_small = wp_get_attachment_image_src($id_hover, $image_size);

                $atts['hover_url'] = $url[0];
                $atts['hover_url-small'] = $url_small[0];
                $atts['hover_url-size'] = array('width' => $url[1], 'height' => $url[2]);
            } else {
                $atts['hover_url'] = $atts['hover_image'];
            }
        }
        return $atts;
    }
}
