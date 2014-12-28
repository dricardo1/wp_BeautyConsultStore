<?php

class jaw_blog_big {

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

    public function jaw_blog_big_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data($this->model($atts));
        return jaw_get_template_part('blog','blog');
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
                    'pagination' => 'none',
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
        if (is_front_page()) {
            $qs['paged'] = (get_query_var('page')) ? get_query_var('page') : 1;
        } else {
            $qs['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
        }
        
        if ($cats) {
            $qs['cat'] = implode(',',$cats);
        }

        $qs['posts_per_page'] = $count;
        $qs['post_type'] = 'post';

        $qs['order'] = $order;
        $qs['orderby'] = $orderby;
        $qs['dateformat'] = $dateformat;
        $qs['pagination'] = $pagination;
        $qs['excerpt'] = $excerpt;
        $qs['blog'] = true;
        $qs['slider'] = $slider;
        $qs['slider_source'] = $slider_source;
        $qs['slider_max'] = $slider_max;
        $qs['post__not_in'] = $post__not_in;

        if ($author) {
            $qs['author'] = $author;
        }
        if ($posts) {
            $qs['post__in'] = explode(',', $posts);
        }

        $blog_query = new WP_Query($qs);
        if (isset($atts['box_title'])) {
            $blog_query->box_title = $atts['box_title'];
        } else {
            $blog_query->box_title = 'Blog';
        }
        
        if (isset($atts['letter_excerpt'])) {
            $blog_query->letter_excerpt = $atts['letter_excerpt'];
        } else {
            $blog_query->letter_excerpt = 300;
        }
        
        if (isset($atts['letter_excerpt_title'])) {
            $blog_query->letter_excerpt_title = $atts['letter_excerpt_title'];
        } else {
            $blog_query->letter_excerpt_title = 60;
        }
        
        if (class_exists('jwOpt')) {
            $blog_query->element_blog_dateformat = jwOpt::get_option('blog_dateformat', 'M j, Y');
        } else {
            $blog_query->element_blog_dateformat = 'M j, Y';
        }
        
        if (isset($atts['type'])) {
            $blog_query->type = $atts['type'];
        } else {
            $blog_query->type = 'classical';
        }
        
        if (isset($atts['blog_metadate'])) {
            $blog_query->blog_metadate = $atts['blog_metadate'];
        } else {
            $blog_query->blog_metadate = '1';
        }
        
        if (isset($atts['blog_ratings'])) {
            $blog_query->blog_ratings = $atts['blog_ratings'];
        } else {
            $blog_query->blog_ratings = '1';
        }
        
        if (isset($atts['blog_meta_type_icon'])) {
            $blog_query->blog_meta_type_icon = $atts['blog_meta_type_icon'];
        } else {
            $blog_query->blog_meta_type_icon = '1';
        }
        
        if (isset($atts['blog_meta_author'])) {
            $blog_query->blog_meta_author = $atts['blog_meta_author'];
        } else {
            $blog_query->blog_meta_author = '1';
        }
        
        if (isset($atts['blog_comments_count'])) {
            $blog_query->blog_comments_count = $atts['blog_comments_count'];
        } else {
            $blog_query->blog_comments_count = '1';
        }
        
        if (isset($atts['blog_meta_category'])) {
            $blog_query->blog_meta_category = $atts['blog_meta_category'];
        } else {
            $blog_query->blog_meta_category = '1';
        }

        $blog_query->pagination =  $pagination;

        return $blog_query;
    }
}