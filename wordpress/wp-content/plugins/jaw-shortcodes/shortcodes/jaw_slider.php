<?php

class jaw_slider {

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

    public function jaw_slider_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data($this->model($atts));
        return jaw_get_template_part($this->_tmpl, 'simple-shortcodes');
    }

    private function model($atts) {
        extract(shortcode_atts(array(
            'posts_per_page' => 6,
            'category__in' => array(),
            'author__in' => array(),
            'post_type' => 'post',
            'paged' => 1,
            'order' => '',
            'orderby' => '',
            'excerpt' => '15',
            'post__in' => '',
            'tag__in' => array(),
            'sticky_posts' => '0',
            'woo_category__in' => array(),
            'woo_post__in' => '',
            'woo_tag__in' => array(),
            'featured_products' => '0'
                        ), $atts));

        $qs = array();

        $qs['posts_per_page'] = $posts_per_page;
        $qs['post_type'] = $post_type;
        $qs['order'] = $order;
        $qs['orderby'] = $orderby;
        $qs['excerpt'] = $excerpt;


        if ($post_type == 'post') {
            if ($post__in != '') {
                $qs['post__in'] = explode(',', $post__in);
            }
            if (isset($category__in[0]) && $category__in[0] != 0) {
                $qs['category__in'] = $category__in;
            }
            if (isset($tag__in[0]) && $tag__in[0] != 0) {
                $qs['tag__in'] = $tag__in;
            }
            if (isset($author__in[0]) && $author__in[0] != 0) {
                $qs['author__in'] = $author__in;
            }
        } else if ($post_type == 'product') {
            if ($woo_post__in != '') {
                $qs['post__in'] = explode(',', $woo_post__in);
            }
            if (is_array($woo_category__in) && isset($woo_category__in[0]) && $woo_category__in[0] != '0') {

                $qs['tax_query'][] = array(
                    'taxonomy' => 'product_cat',
                    'terms' => $woo_category__in,
                    'field' => 'slug',
                    'operator' => 'IN'
                );
            }

            if (is_array($woo_tag__in) && isset($woo_tag__in[0]) && $woo_tag__in[0] != '0') {
                $qs['tax_query'][] = array(
                    'taxonomy' => 'product_tag',
                    'terms' => $woo_tag__in,
                    'field' => 'slug',
                    'operator' => 'IN'
                );
            }
            if ($featured_products == '1') {
                $qs['meta_query'][] = array(
                    'key' => '_featured',
                    'value' => 'yes'
                );
            }
            $qs['meta_query'][] = array(
                'key' => '_visibility',
                'value' => array('catalog', 'visible'),
                'compare' => 'IN'
            );
        }

        switch ($sticky_posts) {
            case 'ignore_sticky_posts': $qs['ignore_sticky_posts'] = 1;
                break;
            case 'show_only_sticky': $qs['post__in'] = get_option('sticky_posts');
                break;
        }

        $query = new WP_Query($qs);

        $slides['slides'] = $this->get_slides($query, $atts);

        $length = sizeof($slides['slides']);
        if (isset($length) && $length >= 5) {
            $keys = array_keys($slides['slides']);
            array_unshift($keys, $length - 2, $length - 1);
            array_splice($keys, $length);

            array_unshift($slides['slides'], $slides['slides'][$length - 2], $slides['slides'][$length - 1]);
            array_splice($slides['slides'], $length);

            foreach ($slides['slides'] as $key => $value) {
                $s[$keys[$key]] = $value;
            }

            $slides['slides'] = $s;
        } else {
            echo 'J&W Slider: <b>Too few posts!</b> - required minimum are 5 (the featured image may be missing) !!!';
        }

        if (isset($atts['box_title'])) {
            $slides['box_title'] = $atts['box_title'];
        } else {
            $slides['box_title'] = 'Blog';
        }
        if (isset($atts['type'])) {
            $slides['type'] = $atts['type'];
        } else {
            $slides['type'] = 'default';
        }
        if (isset($atts['animate_latency'])) {
            $slides['animate_latency'] = $atts['animate_latency'];
        } else {
            $slides['animate_latency'] = '5000';
        }
        if (isset($atts['animate_duration'])) {
            $slides['animate_duration'] = $atts['animate_duration'];
        } else {
            $slides['animate_duration'] = '1500';
        }
        if (isset($atts['info_color'])) {
            $slides['info_color'] = $atts['info_color'];
        } else {
            $slides['info_color'] = '#ffffff';
        }
        if (isset($atts['info_text_color'])) {
            $slides['info_text_color'] = $atts['info_text_color'];
        } else {
            $slides['info_text_color'] = '#000000';
        }
        if (isset($atts['info_opacity'])) {
            $slides['info_opacity'] = $atts['info_opacity'];
        } else {
            $slides['info_opacity'] = '90';
        }
        if (isset($atts['post_type'])) {
            $slides['post_type'] = $post_type;
        } else {
            $slides['post_type'] = 'post';
        }
        if (isset($atts['lookbook_products'])) {
            $slides['lookbook_products'] = $atts['lookbook_products'];
        } else {
            $slides['lookbook_products'] = 'off';
        }
        
        return $slides;
        
    }

    private function get_slides($query, $atts) {
        global $wp_query, $post;
        $backup_query = $wp_query;
        $wp_query = null;
        $wp_query = $query;       

        $slides = array();
        
        if (isset($atts['lookbook_products'])) {
            $lookbook_products = $atts['lookbook_products'];
        } else {
            $lookbook_products = 'off';
        }        

        while (have_posts()) {
            $slide = array();
            the_post();
            if (has_post_thumbnail()) {            
                $slide['title'] = jwShortcodeUtils::crop_length(get_the_title(), 35);
                $slide['content'] = jwShortcodeUtils::crop_length(strip_shortcodes(strip_tags(get_the_content())), 100);
                $slide['thumbnail'] = get_the_post_thumbnail(get_the_ID(), 'slider-size');
                $slide['link'] = get_permalink();
                
                if ($wp_query->query_vars['post_type'] == 'product') {
                    $slide['price'] = sprintf(get_woocommerce_price_format(), get_woocommerce_currency_symbol(), get_post_meta(get_the_ID(), '_price', true));
                    
                    if ($lookbook_products == 'on') {
                        $alt_title = get_post_meta(get_the_ID(), '_prod_lookbook_alternative_title', true);
                        $alt_desc = get_post_meta(get_the_ID(), '_prod_lookbook_alternative_desc', true);
                        if (strlen($alt_title) > 0) {
                            $slide['alt_lb_title'] = jwShortcodeUtils::crop_length($alt_title, 35);
                        } else {
                            $slide['alt_lb_title'] = jwShortcodeUtils::crop_length(get_the_title(), 35);
                        }
                        $slide['alt_lb_desc'] = jwShortcodeUtils::crop_length($alt_desc, 100);
                    }
                    
                }
                $slides[] = $slide;
            }
        }

        $wp_query = null;
        $wp_query = $backup_query;
        wp_reset_postdata();

        return $slides;
    }

}
