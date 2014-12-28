<?php

class jaw_testimonial {

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

    public function jaw_testimonial_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data($this->model($atts));
        return jaw_get_template_part($this->_tmpl, 'custom-posts');
    }

    private function model($atts) {
        extract(shortcode_atts(array(
                    'count' => -1,
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
        if (is_front_page()) {
            $qs['paged'] = (get_query_var('page')) ? get_query_var('page') : 1;
        } else {
            $qs['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
        }

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
        if ($posts && $posts != '') {
            $qs['post__in'] = explode(',', $posts);
        }

        $query = new WP_Query($qs);

        if (isset($atts['box_title'])) {
            $query->box_title = $atts['box_title'];
        } else {
            $query->box_title = 'Testimonial';
        }
        
        if (isset($atts['box_size'])) {
            $query->box_size = $atts['box_size'];
        } else {
            $query->box_size = 'max';
        }

        return $query;
    }

}
