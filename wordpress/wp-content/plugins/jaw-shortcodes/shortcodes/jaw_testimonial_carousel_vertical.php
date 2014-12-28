<?php

class jaw_testimonial_carousel_vertical {

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

    public function jaw_testimonial_carousel_vertical_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data($this->model($atts));
        return jaw_get_template_part($this->_tmpl, 'custom-posts');
    }

    private function model($atts) {
        extract(shortcode_atts(array(
            'count' => 6,
            'cats' => array(),
            'author' => '',
            'posts' => '',
            'paged' => 1,
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
            'post__not_in' => ''
                        ), $atts));

        $qs = array();
        $qs['paged'] = 1;
        if (is_array($cats)) {
            $qs['jaw-testimonial-category'] = implode(',', $cats);
        } else {
            $qs['jaw-testimonial-category'] = $cats;
        }

        $qs['posts_per_page'] = $count;
        $qs['post_type'] = 'jaw-testimonial';

        $qs['order'] = $order;
        $qs['orderby'] = $orderby;
        $qs['dateformat'] = $dateformat;
        $qs['pagination'] = $pagination;
        $qs['excerpt'] = $excerpt;
        $qs['post__not_in'] = $post__not_in;


        if ($author) {
            $qs['author'] = $author;
        }
        if ($posts) {
            $qs['post__in'] = explode(',', $posts);
        }

        $query = new WP_Query($qs);

        if (isset($atts['box_title'])) {
            $query->box_title = $atts['box_title'];
        } else {
            $query->box_title = 'Testimonial';
        }
        if (isset($atts['count_carousel_post'])) {
            $query->count_carousel_post = $atts['count_carousel_post'];
        } else {
            $query->count_carousel_post = '6';
        }

        if (isset($atts['post_in_slide'])) {
            $query->post_in_slide = $atts['post_in_slide'];
        } else {
            $query->post_in_slide = '3';
        }
        
        if (isset($atts['automatic_slide'])) {
            $query->automatic_slide = $atts['automatic_slide'];
        } else {
            $query->automatic_slide = '0';
        }
        if (isset($atts['carousel_style'])) {
            $query->carousel_style = $atts['carousel_style'];
        } else {
            $query->carousel_style = 'bar';
        }
        return $query;
    }

}
