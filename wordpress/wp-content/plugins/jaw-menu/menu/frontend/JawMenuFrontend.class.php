<?php

/**
 *  Base menu class
 *
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
class JawMenuFrontend {

    public static function editMenuArgs($args) {

        $jaw_menu_location = get_option(JAWMENU_MENU_LOCATION);
        $jaw_menu_location['theme_location'] = $jaw_menu_location[0];

        if (isset($args['mobile-menu'])) {
            if ($args['mobile-menu'] == '1') {
                $args['items_wrap'] = '<select class="mobile-selectbox"><option>' . __('Go to ...', 'jawtemplates') . '</option>%3$s</select>';
                $args['walker'] = new jwMenuSelecetBox();
			} else if ($args['mobile-menu'] == '2') {
                $args['container'] = 'div';
                $args['container_class'] = 'jaw-menu-mobile-bar';
                $args['container_id'] = 'jaw-mobile-menu';
                $args['menu_class'] = 'top-mobile-nav';
                $args['menu_id'] = 'jw-mobile';
                $args['items_wrap'] = '<ul class="top-nav-mobile">%3$s</ul>';
                $args['walker'] = new jwMobileMenu();  
            }
        } else {
            if ($jaw_menu_location['theme_location'] == $args['theme_location']) {
                $args['container'] = 'div';
                $args['container_class'] = 'jaw-menu-bar';
                $args['container_id'] = 'jaw-menu';
                $args['menu_class'] = 'top-nav';
                $args['menu_id'] = 'jw';
                $args['items_wrap'] = '<ul class="top-nav">%3$s<div class="clear"></div></ul>';
                $args['walker'] = new JawMenuFrontendWalker();
            }
        }
        return $args;
    }
}

