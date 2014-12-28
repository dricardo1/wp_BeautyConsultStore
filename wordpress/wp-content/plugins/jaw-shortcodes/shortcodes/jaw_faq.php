<?php

class jaw_faq {

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

    public function jaw_faq_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data($this->model((array) $atts));
        return jaw_get_template_part($this->_tmpl, 'custom-posts');
    }

    private function model($atts) {
        extract(shortcode_atts(array(
                    'count' => -1,
                    'cats' => '',
                    'author' => '',
                    'posts' => '',
                    'paged' => 0,
                    'order' => '',
                    'orderby' => '',
                    'dateformat' => '',
                    'pagination' => '',
                    'excerpt' => '15',
                    'metaauthor' => '',
                    'metacategory' => '',
                    'metadate' => '',
                    'metacomments' => '',
                    'metacaption' => '',
                    'ratings' => '',
                    'slider' => false,
                    'slider_source' => '',
                    'slider_max' => 3,
                    'image_clickable' => '0',
                    'image_lightbox' => '1',
                    'post__not_in' => ''
                        ), $atts));

        $qs = array();

        if (is_array($cats)) {
            $qs['jaw-faq-category'] = implode(',', $cats);
        } else {
            $qs['jaw-faq-category'] = $cats;
        }

        $qs['posts_per_page'] = $count;
        $qs['post_type'] = 'jaw-faq';
        $qs['order'] = $order;
        $qs['orderby'] = $orderby;

   
        $query = new WP_Query($qs);

        if (isset($atts['box_title'])) {
            $query->box_title = $atts['box_title'];
        } else {
            $query->box_title = 'Blog';
        }
        
        if (isset($atts['box_size'])) {
            $query->box_size = $atts['box_size'];
        } else {
            $query->box_size = 'max';
        }

        return $query;
    }
}
