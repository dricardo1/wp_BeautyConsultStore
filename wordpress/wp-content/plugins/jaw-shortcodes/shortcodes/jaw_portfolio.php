<?php

class jaw_portfolio {

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

    public function jaw_portfolio_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data($this->model($atts));
        return jaw_get_template_part($this->_tmpl, 'custom-posts');
    }

    private function model($atts) {
        extract(shortcode_atts(array(
            'count' => -1,
            'cats' => '',
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
            $qs['jaw-portfolio-category'] = implode(',', $cats);
        } else {
            $qs['jaw-portfolio-category'] = $cats;
        }

        $qs['posts_per_page'] = $count;
        $qs['post_type'] = 'jaw-portfolio';

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
            $query->box_title = 'Portfolio';
        }

        if (!isset($atts['info_color'])) {
            $atts['info_color'] = '#000000';
        }
        if (!isset($atts['info_opacity'])) {
            $atts['info_opacity'] = '90';
            $query->info_opacity = $atts['info_opacity'];
        }

        $color = jwStyle::hex2rgb($atts['info_color']);

        $query->color_rgb = 'rgb(' . $color[0] . ',' . $color[1] . ',' . $color[2] . ')';
        $query->color_rgba = 'rgba(' . $color[0] . ',' . $color[1] . ',' . $color[2] . ',' . ($atts['info_opacity'] / 100) . ')';

        if (isset($atts['info_text_color'])) {
            $query->info_text_color = $atts['info_text_color'];
        } else {
            $query->info_text_color = '#000000';
        }
        
        if (isset($atts['box_size'])) {
            $query->box_size = $atts['box_size'];
        } else {
            $query->box_size = 'max';
        }

        $query->pagination = $pagination;

        return $query;
    }

}
