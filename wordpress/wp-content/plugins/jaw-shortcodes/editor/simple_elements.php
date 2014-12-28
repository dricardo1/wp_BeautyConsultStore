<?php

/**
 * Library of simple HTML elements. Offshot of Elements class from theme framework. Use only in admin area
 * 
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
class simpleElements {

    public static function elements_render($elements, $data = null, $layout = 'default') {
        $out = '';
        $out .= '<form id="jaw_shortcodes" ng-controller="shotcodeEditor">';
        foreach ($elements as $element) {
            $out .= self::elements_machine($element, $data, $layout);
        }
        $out .= '</form>';
        $out .= '<script>';
        $out .= 'jQuery(document).ready(function() {

                    angular.bootstrap(jQuery("#jaw_shortcodes"), ["shotcode_editor"]);
                    
                });';
        $out .= '</script>';

        return $out;
    }

    public static function elements_machine($value, $data = null, $layout = 'default') {
        $output = '';
        if (isset($value['type']) && $value['type'] != "headingstart" && $value['type'] != "headingend" && $value['type'] != "sectionstart" && $value['type'] != "sectionend") {


            $output .= '<div id="section-' . self::convert($value['id']) . '" class="section jw_shortcodes_option section-' . $value['type'] . ' " >' . "\n";
            $output .= '<h3 class="heading">' . $value['name'] . '</h3>' . "\n";

            $output .= '<div class="controls"><!-- end controls -->';
            $c = "element_" . $value['type'];
            if (method_exists(get_class(), $c)) {
                $output .= simpleElements::$c($value, $data);
            } else {
                $output .= simpleElements::element_text($value, $data);
            }
            if (isset($value['desc'])) {
                $explain_value = ' <p class="description">' . $value['desc'] . '</p>' . "\n";
                $output .= '</div><!-- end controls -->' . $explain_value . "\n";
            }
            $output .= '<div class="clear"></div>
                        </div><!-- end options -->' . "\n";
        }
        return $output;
    }

    public static function convert($id) {
        $id = str_replace('[', '-', $id);
        $id = str_replace(']', '', $id);

        return $id;
    }

    /*     * *************************************************************************
     * ***************************   ELEMENTS   ****************************** *
     * ************************************************************************ */

    public static function element_text($value, $data = null) {
        $output = '';
        if (isset($data)) {
            $evalue = $data;
        } else if (isset($value['std'])) {
            $evalue = $value['std'];
        } else {
            $evalue = '';
        }

        $t_value = stripslashes((string) $evalue);

        $class = '';
        if (isset($value['mod'])) {
            $class .= $value['mod'];
        }
        if (isset($value['class'])) {
            $class .= ' ' . $value['class'];
        }
        if (isset($value['maxlength'])) {
            $maxlength = 'maxlength=' . $value['maxlength'];
        } else {
            $maxlength = '';
        }
        if (!isset($value['type'])) {
            $value['type'] = 'text';
        }

        $output .= '<input class="of-input ' . $class . '" name="' . $value['id'] . '"  ' . $maxlength . ' id="' . self::convert($value['id']) . '" type="text" value="' . $t_value . '" />';
        if (isset($value['unit'])) {
            $output .= '<span>' . $value['unit'] . '</span>';
        }
        return $output;
    }

    public static function element_select($value, $data = null, $type = 'default') {
        $output = '';

        if (isset($data)) {
            $evalue = $data;
        } else if (isset($value['std'])) {
            $evalue = $value['std'];
        } else {
            $evalue = '';
        }
        if (!isset($value['mod']))
            $mini = '';
        else
            $mini = $value['mod'];

        $output .= '<div class="select_wrapper_jaw ' . $mini . '">';

        $output .= '<select class="select of-input" name="' . $value['id'] . '" id="' . self::convert($value['id']) . '" >';
        if (isset($value['options']) && count($value['options']) > 0)
            foreach ((array) $value['options'] as $select_ID => $option) {
                $output .= '<option id="' . $select_ID . '" value="' . $select_ID . '" ' . selected($evalue, $select_ID, false) . ' >' . $option . '</option>';
            }
        $output .= '</select></div>';
        return $output;
    }

    public static function element_textarea($value, $data = null) {
        $output = '';

        if (isset($data)) {
            $evalue = $data;
        } else if (isset($value['std'])) {
            $evalue = $value['std'];
        } else {
            $evalue = '';
        }

        $cols = '8';
        $rows = '4';
        $class = '';

        if (isset($value['cols'])) {
            $cols = $value['cols'];
        }
        if (isset($value['rows'])) {
            $rows = $value['rows'];
        }

        if (isset($value['style'])) {
            $class = $value['style'];
        }
        $ta_value = stripslashes($evalue);
        $output .= '<textarea class="of-input wp-editor-area ' . $class . '" name="' . $value['id'] . '" id="' . self::convert($value['id']) . '" cols="' . $cols . '" rows="' . $rows . '">' . $ta_value . '</textarea>';
        return $output;
    }

    public static function element_toggle($value, $data = null) {
        $output = $yes = $no = $yess = $nos = '';

        if (isset($data)) {
            $evalue = $data;
        } else if (is_null($data) && isset($value['std']) && $value['std'] != '') {
            $evalue = $value['std'];
        } else {
            $evalue = '0';
        }


        if (!isset($value['options'])) {
            $value['options'] = array("1" => "On", "0" => "Off");
        }

        $output.='<ul class="tooglebutton btn-group" id="' . self::convert($value['id']) . '"  >';
        foreach ($value['options'] as $key => $option) {
            $check = '';
            if ($evalue == $key) {
                $check = ' checked="checked" ';
            }
            $output.= '<li class="one-option">';
            $output.='<label for="' . self::convert($value['id']) . $key . '">' . $option . '</label>';
            $output.='<input  type="radio" id="' . self::convert($value['id']) . $key . '"  ' . $check . ' name="' . $value['id'] . '"  value="' . $key . '" />';
            $output.= '</li>';
        }
        $output.='</ul>';

        return $output;
    }

    public static function element_list($value, $data = null) {
        $output = '';

        if (isset($data))
            $evalue = $data;
        else if (isset($value['std']))
            $evalue = $value['std'];
        else
            $evalue = '';
        $t_value = '';
        $t_value = stripslashes((string) $evalue);


        $output .= '<div class="list-li" >';
        $output .= '<input class="of-input" name="' . $value['id'] . '-0"  type="text" value="' . $t_value . '"  />';
        $output .= '</div>';
        $output .= '<a href="#" class="button-primary blue jaw add-list" id="' . $value['id'] . '" >+</a>';
        return $output;
    }

    public static function element_tabs($value, $data = null) {
        $output = '';

        if (isset($data))
            $evalue = $data;
        else if (isset($value['std']))
            $evalue = $value['std'];
        else
            $evalue = '';

        $output .= '<div class="slider"><ul id="' . $value['id'] . '"  >';
        $slides = $evalue;
        $count = count($slides);
        if ($count < 2) {
            $oldorder = 1;
            $order = 1;
            $output .= simpleElements::elements_tabs_function($value['id'], $value['std'], $oldorder, $order);
        } else {
            $i = 0;
            foreach ($slides as $slide) {
                $oldorder = $slide['order'];
                $i++;
                $order = $i;
                $output .= simpleElements::elements_tabs_function($value['id'], $value['std'], $oldorder, $order);
            }
        }
        $output .= '</ul>';
        $output .= '<a href="#" class="button tab_add_button"  >Add New Slide</a></div>';

        return $output;
    }

    public static function elements_tabs_function($id, $std, $oldorder, $order) {

        $data = get_option(OPTIONS);
        $slider = '';
        $slide = array();
        if (isset($data[$id]))
            $slide = $data[$id];

        if (isset($slide[$oldorder])) {
            $val = $slide[$oldorder];
        } else {
            $val = $std;
        }

        //initialize all vars
        $slidevars = array('title', 'url', 'link', 'description');

        foreach ($slidevars as $slidevar) {
            if (!isset($val[$slidevar])) {
                $val[$slidevar] = '';
            }
        }
        $slider .= '<li ><div class="slide_header" >';
        //begin slider interface	
        if (!empty($val['title'])) {
            $slider .= '<strong>' . stripslashes($val['title']) . '</strong>';
        } else {
            $slider .= '<strong>Slide</strong>';
        }

        $slider .= '<input type="hidden" class="slide of-input order" name="' . $id . '[' . $order . '][order]" id="' . $id . '_' . $order . '_slide_order" value="' . $order . '" />';

        $slider .= '<a class="tab_edit_button" href="#">Edit</a></div>';

        $slider .= '<div class="slide_body">';

        $slider .= '<label>Title</label>';
        $slider .= '<input  class="slide of-input of-slider-title" name="' . $id . '[' . $order . '][title]" id="' . $id . '_' . $order . '_slide_title" value="' . stripslashes($val['title']) . '" />';

        $slider .= '<label>Description (optional)</label>';
        $slider .= '<textarea  class="slide of-input" name="' . $id . '[' . $order . '][description]" id="' . $id . '_' . $order . '_slide_description" cols="8" rows="8">' . stripslashes($val['description']) . '</textarea>';

        $slider .= '<a class="tab_delete_button" href="#" >Delete</a>';
        $slider .= '<div class="clear"></div>' . "\n";

        $slider .= '</div>';
        $slider .= '</li>';

        return $slider;
    }
    
    public static function element_media_picker($value, $data = null) {
            $output = '';
            //add_filter( 'media_view_settings',  'Elements::media_view_settings', 10, 2 );
            if (isset($data)) {
                $evalue = $data;
            } else if (isset($value['std'])) {
                $evalue = $value['std'];
            } else {
                $evalue = '';
            }
            $a_default = 'init_edit(\'' . $value['id'] . '\',json_decode(\'' . addslashes(str_replace('"', '\'', $evalue)) . '\'));';
            $_id = strip_tags(strtolower($value['id']));
            if (!isset($value['mod']))
                $value['mod'] = '';

            $output .= '<span ng-init="' . $a_default . '" ></span>';
            $output .= '<div gallerypicker ng-model="edit[\'' . $value['id'] . '\']" name="' . $value['id'] . '"></div>';

            return $output;
        }

}

?>
