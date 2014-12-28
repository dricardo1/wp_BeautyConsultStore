<?php

/*
  Name: Simple Breadcrumb Navigation
  Description: A simple and very lightweight breadcrumb navigation that covers nested pages and categories
  Version: 1
  Author: Christian "Kriesi" Budschedl
  Author URI: http://www.kriesi.at/
 */

/*
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

//SUPPORT FOR YOAST SEO PLUGIN
if (function_exists('yoast_breadcrumb')) {
    $options = get_option('wpseo_internallinks');
}
if (isset($options['breadcrumbs-enable']) && $options['breadcrumbs-enable'] === true) {
    yoast_breadcrumb('<span id="breadcrumbs" class="breadcrumb">', '</span>');
} else {//CLASSICAL BREADCRUMBS
    global $post, $blog_page;

    $markup = '';




    echo '<span class="breadcrumb" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . home_url() . '" itemprop="url">';
    echo '<span itemprop="title">' . __('Home', 'jawtemplates') . '</span>';
    echo "</a>";

    if (!is_front_page()) {
        echo $markup;
    }

    if (is_page()) {
        $link = '';
        if ($post->post_parent) {
            $anc = array_reverse(get_post_ancestors($post->ID));
            $title = get_the_title();
            foreach ($anc as $ancestor) {
                $link .= '<a itemprop="url" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '"><span itemprop="title">' . get_the_title($ancestor) . '</span></a>' . $markup;
            }
            echo $link;
        }
    }

    if (is_tag()) {
        echo '<a href="#">' . __('Tag:', 'jawtemplates') . ' ' . single_tag_title('', FALSE) . '</a>';
    } else if (is_author()) {
        $curauth = get_user_by('id', get_query_var('author'));
        echo '<a href="#">' . __('Author:', 'jawtemplates') . ' ' . $curauth->nickname . '</a>';
    } else if (is_year()) {
        $k_year = get_the_time('Y');
        echo "<a href='" . get_year_link($k_year) . "'>" . $k_year . "</a>";
    } else if (is_month()) {
        $k_year = get_the_time('Y');
        $k_month = get_the_time('F');
        echo "<a href='" . get_year_link($k_year) . "'>" . $k_year . "</a>";
        echo "<a href='" . get_month_link($k_year, $k_year) . "'>" . $k_month . "</a>";
    } else if (is_day() || is_time()) {
        $k_year = get_the_time('Y');
        $k_month = get_the_time('F');
        $k_day = get_the_time('j');
        echo "<a href='" . get_year_link($k_year) . "'>" . $k_year . "</a>";
        echo "<a href='" . get_month_link($k_year, $k_year) . "'>" . $k_month . "</a>";
        echo "<a href='" . get_day_link($k_year, $k_year, $k_day) . "'>" . $k_day . "</a>";
    } else if (function_exists('is_product') && function_exists('is_product_category') && ( is_product_category() || is_product())) {
        //WOOCOMMERCE
        if (is_product_category()) {
            $terms = get_term_by('slug', get_query_var('term'), 'product_cat');
        } else {
            $terms = get_the_terms(get_the_ID(), 'product_cat');
            if (!empty($terms)) {
                $terms = current($terms);
            }
        }
        if (!empty($terms)) {
            $parent = get_term_by('id', $terms->term_id, 'product_cat');
            // climb up the hierarchy until we reach a term with parent = '0'
            $term_parent[] = $parent;
            if (isset($parent->parent) && sizeof($parent->parent) > 0) {
                while ($parent->parent != '0') {
                    $parent = get_term_by('id', $parent->parent, 'product_cat');
                    $term_parent[] = $parent;
                }
                $term_parent = array_reverse($term_parent);
                foreach ((array) $term_parent as $trm) {
                    echo '<a href="' . get_term_link($trm, 'product_cat') . '">' . ($trm->name ) . '</a>';
                }
            }
        }
    } else if (function_exists('is_product_tag') && is_product_tag()) {
        $terms = get_term_by('slug', get_query_var('term'), 'product_tag');
        if (isset($terms->name)) {
            echo '<a href="#">' . __('Tag:', 'jawtemplates') . ' ' . $terms->name . '</a>';
        }
    } else if ((taxonomy_exists('jaw-portfolio-category') && is_tax('jaw-portfolio-category')) || (get_post_type() == 'jaw-portfolio')) {
        //PORTFOLIO
        if (is_tax('jaw-portfolio-category')) {
            $term = get_term_by('slug', get_query_var('term'), 'jaw-portfolio-category');
        } else {
            $term = get_the_terms(get_the_ID(), 'jaw-portfolio-category');
            if (isset($term) && sizeof($term) > 0 && is_array($term)) {
                $term = current($term);
            }
        }
        if ($term && sizeof($term) > 0) {

            $categories[] = $term;

            while (isset(end($categories)->parent) && end($categories)->parent > 0) {
                $categories[] = get_term(end($categories)->parent, 'jaw-portfolio-category');
            }
            if (sizeof($categories) > 0 && $categories != '') {
                $categories = array_reverse($categories);
                foreach ((array) $categories as $key => $cat) {
                    echo '<a href="' . get_term_link($cat, 'jaw-portfolio-category') . '">' . $cat->name . '</a>';
                }
            }
        }
    } else if (is_404()) {
        echo '<a href="#">' . __('File not found', 'jawtemplates') . '</a>';
    } else if (is_search()) {
        echo '<a href="#">' . __('Search:', 'jawtemplates') . ' ' . get_search_query() . '</a>';
    } else if (is_category() || is_single()) {
        //POST | CATEGORY
        $cats = get_the_category();
        if (isset($cats[0])) { // pokud neni v kategorii post neyobrazi se breadcrumb
            //Post
            $category = $cats[0]->name;
            $cat_id = $cats[0]->term_id;

            if (sizeof($category) > 0 && $category != '') {

                echo get_category_parents($cat_id, TRUE, $markup, FALSE);
            }
        }
    } else if (is_tax('shop_vendor')) {    
        $term_id = $wp_query->get_queried_object_id();
        
        $term = get_term($term_id, 'shop_vendor');  
        
        $term_link = get_term_link($term_id, 'shop_vendor' );        
        
        echo '<a href="' . $term_link . '">' . $term->name . '</a>';
    }

    if (is_page() || is_single()) {
        echo '<a href="' . get_permalink() . '">' . jwUtils::crop_length(strip_tags(get_the_title()), jwOpt::get_option('blog_cut_breadcrumb',50)) . '</a>';
    }
}
echo '<div class="clear"></div>';
