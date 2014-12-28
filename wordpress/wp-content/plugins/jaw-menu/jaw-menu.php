<?php

/*
  Plugin Name: JaW Menu
  Plugin URI: http://jawtemplates.com
  Description: Ultimate menu plugin by JaW Templates
  Version: 1.2.1
  Author: JaW Templates
  Author URI: http://jawtemplates.com

 *  */

define('JAWMENU_VERSION', '1.2');
define('JAWMENU_OPTIONS', 'jaw-menu-options');
define('JAWMENU_MENU_LOCATION', 'jaw-menu-location');
define('JAWMENU_ITEM_OPTIONS', 'jaw-menu-item-options');

require_once( 'menu/JawMenu.class.php' );

$jawMenu = new JawMenu();