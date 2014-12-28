<?php

/**
 * Menu for iphone and android, print simple select box menu 
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
// Customize output for menu
class jwMenuSelecetBox extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth = 0, $args = array()) {
	$indent = str_repeat("-", $depth); // don't output children opening tag (`<ul>`)
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {
	$indent = str_repeat("-", $depth); // don't output children closing tag
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id=0) {
	$indent = ( $depth ) ? str_repeat("-", $depth) : '';
	// add spacing to the title based on the depth
	$item->title = str_repeat("- ", $depth) . $item->title;

	$class_names = $value = '';

	
	$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
	$attributes .=!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
	$attributes .=!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
	$attributes .=!empty($item->url) ? ' value="' . esc_attr($item->url) . '"' : '';

	$item_output = '<option id="menu-item-' . $item->ID . '"' . $value . $class_names . '' . $attributes . '>';
	$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID);
	$item_output .= '</option>';

	$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);



	// no point redefining this method too, we just replace the li tag...
	$output = str_replace('<li', '<option', $output);
    }

    function end_el(&$output, $object, $depth = 0, $args = array()) {
	$output .= "\n"; // replace closing </li> with the option tag
    }

}

?>