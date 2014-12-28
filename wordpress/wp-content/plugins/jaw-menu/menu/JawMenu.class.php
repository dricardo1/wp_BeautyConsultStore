<?php

require_once( 'admin/JawMenuWalker.class.php' );
require_once( 'admin/JawMenuOptionsPrinter.class.php' );

require_once( 'frontend/JawMenuFrontend.class.php' );
require_once( 'frontend/JawMenuFrontendWalker.class.php' );
require_once( 'frontend/JawMenuFrontedMobileWalker.class.php' );
require_once( 'frontend/JawMenuFrontedMobileNewWalker.class.php' );

class JawMenu {

    public $settings = null;
    public $defaultOption = null;

    function __construct() {

        add_action('init', array($this, 'registerSidebars'));

        if (is_admin()) {
            add_filter('wp_edit_nav_menu_walker', array($this, 'jawMenuEditFilter'));
            add_action('wp_update_nav_menu', array($this, 'jawMenuUpdateOptions'));
            add_action('wp_update_nav_menu_item', array($this, 'jawMenuUpdateNavMenuItem'), 10, 3);

            add_action('jaw_menu_walker_add_fields', array($this, 'addJawFields'));

            $this->defaultOption = array(
                'menu-type',
                'widget-area',
                'cols-count',
                'active-link',
                'icon-class',
            );

            add_action('admin_menu', array($this, 'adminInit'));
            add_action('admin_head', array($this, 'addJawMenuMetaBox'));
        } else {
            add_action('plugins_loaded', array($this, 'init'));
            add_action('wp_enqueue_scripts', array($this, 'initAssets'));
        }
    }

    function init() {
        add_filter('wp_nav_menu_args', array('JawMenuFrontend', 'editMenuArgs'));
    }

    function addJawMenuMetaBox() {
        if (wp_get_nav_menus()) {
            add_meta_box('nav-menu-theme-megamenus', __('Select JaW Menu Locations', 'jawmenu'), array($this, 'createJawMenuMetaBox'), 'nav-menus', 'side', 'high');
        }
    }

    function createJawMenuMetaBox() {
        if (isset($_POST['jawmenu-locations']) && $_POST['jawmenu-location-submit'] == 'Save') {
            $data = $_POST['jawmenu-locations'];
            $data = explode(',', $data);
            update_option(JAWMENU_MENU_LOCATION, $data);
            echo 'Changes saved';
        } else if (isset($_POST['jawmenu-location-submit']) && $_POST['jawmenu-location-submit'] == 'Save') {
            echo 'Please select one menu Theme Location';
        }

        $active = get_option(JAWMENU_MENU_LOCATION, array());

        echo '<div class="megaMenu-metaBox">';

        //echo '<form enctype="multipart/form-data" method="post" action="" id="jaw-update-nav-menu-position">';

        $locs = get_registered_nav_menus();

        echo '<ul class="categorychecklist form-no-clear" id="postchecklist-most-recent">';

        foreach ($locs as $slug => $desc) {
            echo '<li>';
            echo '<label class="menu-item-title" for="jawmenu-location-' . $slug . '">' .
            '<input class="menu-item-checkbox" style="margin-right: 4px;" type="checkbox" value="' . $slug . '" id="jawmenu-location-' . $slug . '" name="jawmenu-locations" ' .
            checked(in_array($slug, $active), true, false) . '/>' .
            $desc . '</label>';
            echo '</li>';
        }

        echo '</ul>';

        echo '<p class="button-controls">' .
        '<img class="waiting" src="' . esc_url(admin_url('images/wpspin_light.gif')) . '" alt="" style="display:none;"/>' .
        '<input id="jawmenu-location-submit" type="submit" class="button-primary" name="jawmenu-location-submit" value="' . __('Save', 'ubermenu') . '" />' .
        '</p>';

        //echo '</form>';

        echo '<p>' . __('You can use only one JaW Menu', 'jawmenu') . '</p>';

        echo '</div>';
    }

    function registerSidebars() {

        $widgets_area = array(
            'widget-menu-area-1' => 'Widget menu area 1',
            'widget-menu-area-2' => 'Widget menu area 2',
            'widget-menu-area-3' => 'Widget menu area 3',
            'widget-menu-area-4' => 'Widget menu area 4',
        );

        foreach ($widgets_area as $key => $area) {
            register_sidebar(array(
                'name' => __($area),
                'id' => $key,
                'description' => __('Widgets in this area will be shown on the right-hand side.'),
                'before_widget' => '<li id="%1$s" class="widget %2$s">',
                'after_widget' => '</li>',
                'before_title' => '<h3 class="title">',
                'after_title' => '</h3>'
            ));
        }
    }

    function initAssets() {
        wp_register_style('jawmenu-style', plugins_url() . '/' . dirname(str_replace(basename(__FILE__), "", plugin_basename(__FILE__))) . '/menu/frontend/assets/css/jawmenu.css', array(), JAWMENU_VERSION);
        wp_enqueue_style('jawmenu-style');
    }

    function adminInit() {
        wp_register_style('jawmenu-admin-style', plugins_url() . '/' . dirname(str_replace(basename(__FILE__), "", plugin_basename(__FILE__))) . '/menu/admin/assets/css/jawmenu-admin.css', false, JAWMENU_VERSION);
        wp_enqueue_style('jawmenu-admin-style');
    }

    function jawMenuEditFilter() {
        return 'JawMenuWalker';
    }

    function jawMenuUpdateOptions() {
        // zde bude funkce pro ukladani globalniho nasteveni pluginu menu
    }

    function jawMenuUpdateNavMenuItem($menu_id, $menu_item_db_id, $args) {
        $menu_option = array();
        foreach ($this->defaultOption as $key => $item) {
            $menu_item = 'menu-item-' . $item;
            if (isset($_POST[$menu_item][$menu_item_db_id])) {
                $menu_option[$menu_item] = $_POST[$menu_item][$menu_item_db_id];
            }
        }
        if (sizeof($menu_option) > 0) {
            update_post_meta($menu_item_db_id, JAWMENU_ITEM_OPTIONS, $menu_option);
        }
    }

    function addJawFields($itemId) {
        $menuPrinter = new JawMenuOptionsPrinter();

        $menuPrinter->showMenuOption(
                $itemId, 'menu-type', array(
            'type' => 'select',
            'title' => __('Select menu type', 'jawmenu'),
            'width' => 'wide',
            'customClass' => '',
            'selectData' => array(
                'dropdown' => 'Dropdown menu',
                'fullwidth' => 'Fullwidth menu',
                //'custom' => 'Custom menu',  // prozatim nepouzito
                'hidden' => 'Hidden menu'
            ),
            'defaultValue' => '',
            'showLevel' => 'zero'
                )
        );

        $menuPrinter->showMenuOption(
                $itemId, 'widget-area', array(
            'type' => 'select',
            'title' => __('Menu widget area', 'jawmenu'),
            'width' => 'wide',
            'customClass' => '',
            'selectData' => array(
                'none' => 'None',
                'widget-menu-area-1' => 'Widget menu area 1',
                'widget-menu-area-2' => 'Widget menu area 2',
                'widget-menu-area-3' => 'Widget menu area 3',
                'widget-menu-area-4' => 'Widget menu area 4',
            ),
            'defaultValue' => '',
            'showLevel' => 'zero'
                )
        );

        $menuPrinter->showMenuOption(
                $itemId, 'cols-count', array(
            'type' => 'select',
            'title' => __('Cols count', 'jawmenu'),
            'width' => 'wide',
            'customClass' => '',
            'selectData' => array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
            ),
            'defaultValue' => '',
            'showLevel' => 'zero'
                )
        );

        $menuPrinter->showMenuOption(
                $itemId, 'active-link', array(
            'type' => 'select',
            'title' => __('Active menu link', 'jawmenu'),
            'width' => 'wide',
            'customClass' => '',
            'selectData' => array(
                'yes' => 'Yes',
                'no' => 'No',
            ),
            'defaultValue' => '',
            'showLevel' => 'zero-plus'
                )
        );

        $menuPrinter->showMenuOption(
                $itemId, 'icon-class', array(
            'type' => 'text',
            'title' => __('Icon class', 'jawmenu'),
            'width' => 'thin',
            'customClass' => '',
            'defaultValue' => '',
            'showLevel' => 'zero-plus'
                )
        );
    }

}
