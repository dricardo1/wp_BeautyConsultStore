<?php

/**
 * Menu for iphone and android, print simple select box menu 
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
// Customize output for menu
class jwMobileMenu extends Walker_Nav_Menu {

    private $_menu_options = null;

    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        if (is_array($args)) {
            echo do_shortcode('[jaw_message message_text="You don\'t have set Theme locations in menu settings" message_style="danger" show_icon="1" show_close="0"] ');
            die();
        }

        $indent = ( $depth ) ? str_repeat("\t", $depth) : '';

        // GET SIDEBARS
        $sidebar = $this->get_jawmenu_menuitem_option($item->ID, 'widget-area');

        $class_names = $value = '';
        $html5 = array();
                
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $classes[] = 'jaw-menu-item-depth-' . $depth;

        if (isset($sidebar) && !empty($sidebar) && $sidebar != 'none') {
            $classes[] = "jaw-menu-item-has-widgets";
            $classes[] = "has-dropdown";
        }

        if (isset($args->has_children) && $args->has_children == true) {
            $classes[] = "has-dropdown";
            $html5[] = 'aria-haspopup="true"';
        } else {
            $classes[] = "no-dropdown";
            $html5[] = 'aria-haspopup="false"';
        }

        $cols_count = $this->get_jawmenu_menuitem_option($item->ID, 'cols-count');
        if (isset($cols_count)) {
            $classes[] = 'cols-count-' . $cols_count;
        }

        $sub_menu_icon = '';
        //Full Width Submenus
        if ($this->get_jawmenu_menuitem_option($item->ID, 'menu-type') == 'fullwidth') {
            $classes[] = 'jaw-menu-item-fullwidth';
        } else if ($this->get_jawmenu_menuitem_option($item->ID, 'menu-type') == 'custom') {
            $classes[] = 'jaw-menu-item-custom';
        } else if ($this->get_jawmenu_menuitem_option($item->ID, 'menu-type') == 'hidden') {
            $classes[] = 'jaw-menu-item-hidden';
        } else {
            $classes[] = 'jaw-menu-item-dropdown';
            //$sub_menu_icon = '<span class="jaw-menu-submenu-icon icon-arrow-right-gs" aria-hidden="true"></span>';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . ' '.  implode(' ', $html5).'>';

        $atts = array();
        $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
        $atts['href'] = !empty($item->url) ? $item->url : '';

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ( 'href' === $attr ) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }


        $icon_class = $this->get_jawmenu_menuitem_option($item->ID, 'icon-class');

        $item_output = $args->before;

        $is_menu_link_active = $this->get_jawmenu_menuitem_option($item->ID, 'active-link');

        $disabled = '';
        $link_class = '';
        if ($is_menu_link_active == 'no') {
            $disabled = 'onclick="return false"';
            $link_class = 'link-no-active';
        }

        $item_output .= '<a class="' . $link_class . '"' . $disabled . $attributes . '>';

        if (strlen($sub_menu_icon) > 0) {
            $item_output .= $sub_menu_icon;
        }

        $item_output .= '<span class="jaw-menu-icon ' . $icon_class . '" aria-hidden="true"></span>';

        $item_output .= '<span class="jaw-menu-href-title">';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</span>';
        if (isset($item->attr_title) && !empty($item->attr_title)) {
            $item_output .= '<br />';
            $item_output .= '<span class="jaw-menu-href-description">' . $item->attr_title . '</span>';
        }
        $item_output .= '</a>';
        $item_output .= $args->after;

        if ($depth == 0) {
            if (isset($sidebar) && !empty($sidebar)) {
                $item_output .= $this->get_jawmenu_menuitem_sidebar($sidebar);
            }
        }

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {

        if (!$element) {
            return;
        }

        $id_field = $this->db_fields['id'];

        if (is_object($args[0])) {
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);
        }
        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    function get_jawmenu_menuitem_option($item_id, $menu_id) {

        $menu_id = 'menu-item-' . $menu_id;

        $ret = '';

        if (isset($this->_menu_options[$item_id][$menu_id])) {
            $ret = $this->_menu_options[$item_id][$menu_id];
        } else {
            $this->_menu_options[$item_id] = get_post_meta($item_id, JAWMENU_ITEM_OPTIONS, true);
            if (isset($this->_menu_options[$item_id][$menu_id]) && !empty($this->_menu_options[$item_id][$menu_id])) {
                $ret = $this->_menu_options[$item_id][$menu_id];
            }
        }

        return $ret;
    }

    function get_jawmenu_menuitem_sidebar($name = null) {
        if (!is_null($name) && $name != 'none') {
            ob_start();
            echo '<ul class="sub-menu widget-sub-menu">';
            dynamic_sidebar($name);
            echo '</ul>';
            $a = ob_get_clean();
            return $a;
        }
    }

}