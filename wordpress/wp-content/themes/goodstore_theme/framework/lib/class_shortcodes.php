<?php

if (!class_exists('jwShort')) {

    class jwShort {

        public static function shortcode_contact_form($attr) {
            $shortcode = '';
            $shortcode .= '[contact-form-7 ';
            foreach ((array) $attr as $index => $val) {
                $shortcode .= ' ' . $index . '="' . $val . '" ';
            }
            $shortcode .= '] ';
            return $shortcode;
        }

        public static function shortcode_wysija_form($attr) {
            $shortcode = '';
            $shortcode .= '[wysija_form ';
            foreach ((array) $attr as $index => $val) {
                $shortcode .= ' ' . $index . '="' . $val . '" ';
            }
            $shortcode .= '] ';
            return $shortcode;
        }

        public static function shortcode_tabs($attr) {
            $shortcode = '';
            $shortcode .= '[jaw_tabs ';
            $title = '';
            $content = '';
            $class = 'active';
            $attr = (array) $attr;
            if (isset($attr)) {
                if (isset($attr['style'])) {
                    $shortcode .= 'style="' . $attr['style'] . '" ]';
                }

                $attr = (array) $attr;
                if (isset($attr['tabs'])) {
                    foreach ((array) $attr['tabs'] as $i => $tab) {
                        $tab = (array) $tab;
                        if (isset($tab['title']) && isset($tab['description'])) {
                            $title .= '[jaw_tabs_title class="' . $class . '" id="' . $i . '"]' . $tab['title'] . '[/jaw_tabs_title]';
                            $content .= '[jaw_tabs_content class="' . $class . '" id="' . $i . '"]' . $tab['description'] . '[/jaw_tabs_content]';
                            $class = '';
                        }
                    }
                }
            }
            $shortcode .= '[jaw_tabs_titles]' . $title . '[/jaw_tabs_titles]';
            $shortcode .= '[jaw_tabs_contents]' . $content . '[/jaw_tabs_contents]';
            $shortcode .= '[/jaw_tabs]';
            return $shortcode;
        }

        public static function shortcode_accordion($attr) {
            $shortcode = '';
            $shortcode .= '[jaw_accordion]';
            $item = '';
            $first = true;
            if (isset($attr['accordion'])) {
                foreach ((array) $attr['accordion'] as $i => $tab) {
                    if (isset($tab->title) && isset($tab->description)) {
                        $class = 'collapse';
                        if ($first && isset($attr['open_first']) && $attr['open_first'] == '1') {
                            $class = 'collapse in';
                            $first = false;
                        }

                        $item .= '[jaw_accordion_item class="' . $class . '" title="' . $tab->title . '" id="' . $i . '"]' . $tab->description . '[/jaw_accordion_item]';
                    }
                }
            }
            $shortcode .= $item;
            $shortcode .= '[/jaw_accordion]';
            return $shortcode;
        }

        public static function shortcode_page_content($attr) {
            $shortcode = '';
            $shortcode .= '[jaw_page_content]';
            return $shortcode;
        }

        public static function shortcode_list($attr) {
            $shortcode = '';
            $shortcode .= '[jaw_list ';
            $list = array();

            foreach ((array) $attr as $index => $val) {
                if (strpos($index, 'ist')) {
                    $list[] = $val;
                } else {
                    $shortcode .= ' ' . $index . '="' . $val . '"';
                }
            }
            $shortcode .= '] ';
            if (isset($list[0])) {
                foreach ((array) $list[0] as $li) {
                    $shortcode .= '[jaw_list_item ';
                    $shortcode .= 'list ="' . $li->list . '"';
                    $shortcode .= ' ]';
                }
            }

            $shortcode .= '[/jaw_list]';
            return $shortcode;
        }

        public static function shortcode_progressbar($attr) {
            $shortcode = '';
            $shortcode .= '[jaw_progressbar ';
            $charts = $attr['chart'];
            unset($attr['chart']);
            foreach ((array) $attr as $index => $val) {
                $shortcode .= ' ' . $index . '="' . $val . '" ';
            }
            $shortcode .= '] ';
            foreach ((array) $charts as $chart) {
                $shortcode .= '[jaw_one_progressbar ';
                foreach ((array) $chart as $index => $c) {
                    $shortcode .= ' ' . $index . '="' . $c . '" ';
                }
                $shortcode .= ' ] ';
            }
            $shortcode .= '[/jaw_progressbar] ';

            return $shortcode;
        }

        public static function shortcode_shortcode($attr) {
            $shortcode = '';
            if (isset($attr->shortcode)) {
                $shortcode .= $attr->shortcode;
            }
            return $shortcode;
        }

        public static function shortcode_circle_chart($attr) {
            $shortcode = '';
            $shortcode .= '[jaw_circle_chart ';
            $item = '';
            $attr = (array) $attr;
            if (isset($attr['chart'])) {
                foreach ((array) $attr['chart'] as $i => $tab) {
                    $tab = (array) $tab;
                    if (isset($tab['color']) && isset($tab['value']) && isset($tab['title'])) {
                        $item .= '[jaw_chart_item color="' . $tab['color'] . '" value="' . $tab['value'] . '"  title="' . $tab['title'] . '" /]';
                    }
                }
                unset($attr['chart']);
            }

            foreach ((array) $attr as $index => $val) {
                $shortcode .= ' ' . $index . '="' . $val . '" ';
            }
            $shortcode .= ' ]';
            $shortcode .= $item;
            $shortcode .= '[/jaw_circle_chart]';
            return $shortcode;
        }

        public static function shortcode_pricing_table($attr) {
            $shortcode = '';
            $shortcode .= '[jaw_pricing_table ';
            $item = '';
            $attr = (array) $attr;
            if (isset($attr['pricing_table'])) {
                foreach ((array) $attr['pricing_table'] as $i => $tab) {
                    $tab = (array) $tab;
                    $item .= '[jaw_pricing_table_item ';
                    foreach ((array) $tab as $key => $val) {
                        $shortcode .= $key . '="' . $val . '" ';
                    }
                    $item .= ' /]';
                }
                unset($attr['pricing_table']);
            }
            foreach ((array) $attr as $index => $val) {
                $shortcode .= ' ' . $index . '="' . $val . '" ';
            }
            $shortcode .= ' ]';
            $shortcode .= $item;
            $shortcode .= '[/jaw_pricing_table]';
            return $shortcode;
        }

        public static function shortcode_gallery($attr) {
            $shortcode = '';
            $shortcode .= '[jaw_gallery ';
            if (isset($attr['gallery'])) {
                $shortcode .= ' gallery="';
                foreach ((array) $attr['gallery'] as $img) {
                    $img = (array) $img;
                    $shortcode .= $img['id'] . ',';
                }
                $shortcode .= '"';
                unset($attr['gallery']);
            }

            foreach ((array) $attr as $index => $val) {
                $shortcode .= ' ' . $index . '="' . $val . '" ';
            }

            $shortcode .= '] ';
            return $shortcode;
        }

        //SLIDERS========================================================

        public static function shortcode_slider_revolution($attr) {
            $shortcode = '';
            $shortcode .= '[rev_slider  ';
            if (isset($attr['slider'])) {
                $shortcode .= $attr['slider'];
            }
            $shortcode .= '] ';
            return $shortcode;
        }

        //WooCommerce========================================================
        public static function shortcode_woo_product_categories($attr) {
            $shortcode = '';
            $shortcode .= '[product_categories   ';
            foreach ((array) $attr as $index => $val) {
                if (is_array($val)) {
                    $val = implode(',', $val);
                }
                $shortcode .= ' ' . $index . '="' . $val . '" ';
            }
            $shortcode .= '] ';
            return $shortcode;
        }

        public static function shortcode_woo_featured_products_big($attr) {
            $shortcode = '';
            $shortcode .= '[featured_products   ';
            foreach ((array) $attr as $index => $val) {
                $shortcode .= ' ' . $index . '="' . $val . '" ';
            }
            $shortcode .= '] ';
            return $shortcode;
        }

        public static function shortcode_woo_featured_products_small($attr) {
            $shortcode = self::shortcode_woo_featured_products_big($attr);
            return $shortcode;
        }

        public static function shortcode_woo_product_by_category_big($attr) {
            $shortcode = '';
            $shortcode .= '[product_category  ';

            foreach ((array) $attr as $index => $val) {
                if (is_array($val)) {
                    $val = implode(',', $val);
                }
                $shortcode .= ' ' . $index . '="' . $val . '" ';
            }
            $shortcode .= '] ';
            return $shortcode;
        }

        public static function shortcode_woo_product_by_category_small($attr) {
            $shortcode = self::shortcode_woo_product_by_category_big($attr);
            return $shortcode;
        }

        public static function shortcode_woo_products_by_big($attr) {
            $shortcode = '';
            $shortcode .= '[products   ';
            foreach ((array) $attr as $index => $val) {
                if (is_array($val)) {
                    $val = implode(',', $val);
                }
                if ($val != '') {
                    $shortcode .= ' ' . $index . '="' . $val . '" ';
                }
            }
            $shortcode .= '] ';
            return $shortcode;
        }

        public static function shortcode_woo_products_by_small($attr) {
            $shortcode = self::shortcode_woo_products_by_big($attr);
            return $shortcode;
        }

        public static function shortcode_woo_recent_product_big($attr) {
            $shortcode = '';
            $shortcode .= '[recent_products ';
            foreach ((array) $attr as $index => $val) {
                $shortcode .= ' ' . $index . '="' . $val . '" ';
            }
            $shortcode .= '] ';
            return $shortcode;
        }

        public static function shortcode_woo_recent_product_small($attr) {
            $shortcode = self::shortcode_woo_recent_product_big($attr);
            return $shortcode;
        }

        public static function shortcode_woo_product_button($attr) {
            $shortcode = '';
            $shortcode .= '[add_to_cart ';
            foreach ((array) $attr as $index => $val) {
                $shortcode .= ' ' . $index . '="' . $val . '" ';
            }
            $shortcode .= '] ';
            return $shortcode;
        }

        public static function shortcode_woo_order_tracking($attr) {
            $shortcode = '[woocommerce_order_tracking]';
            return $shortcode;
        }

        public static function shortcode_woo_wishlist($attr) {
            $shortcode = '[yith_wcwl_wishlist]';
            return $shortcode;
        }

        public static function shortcode_woo_messages($attr) {
            $shortcode = '[woocommerce_messages]';
            return $shortcode;
        }

        public static function shortcode_woo_page($attr) {
            $shortcode = '';
            if (isset($attr['page'])) {
                $shortcode .= '[woocommerce_' . $attr['page'] . ']';
            }
            return $shortcode;
        }

        //DEFAULT========================================================
        public static function shortcode_default($name, $attr) {
            $shortcode = '';
            $shortcode .= '[' . $name . ' ';
            foreach ((array) $attr as $index => $val) {
                if (is_array($val)) {
                    $val = implode(',', $val);
                }
                $shortcode .= ' ' . $index . '="' . $val . '" ';
            }
            $shortcode .= '] ';
            return $shortcode;
        }

    }

}

