<?php

class jwSimpleShort {

    //DEFAULT========================================================
    public static function shortcode_default($name, $attr) {
        $shortcode = '';
        $shortcode .= '[' . $name . ' ';
        foreach ((array) $attr as $index => $val) {
            $shortcode .= ' ' . $index . '="' . $val . '"';
        }
        $shortcode .= '] ';
        return $shortcode;
    }

    //LIST========================================================
    public static function shortcode_list($attr) {
        $shortcode = '';
        $shortcode .= '[jaw_list ';
        // var_dump($attr); //parsovat list-X

        $list = array();

        foreach ((array) $attr as $index => $val) {
            if (strpos($index, 'ist-')) {
                $list[] = $val;
            } else {
                $shortcode .= ' ' . $index . '="' . $val . '"';
            }
        }
        $shortcode .= '] ';

        foreach ((array) $list as $li) {
            $shortcode .= '[jaw_list_item ';
            $shortcode .= 'list ="' . $li . '"';
            $shortcode .= ' ]';
        }

        $shortcode .= '[/jaw_list]';
        return $shortcode;
    }

    //Tabs========================================================
    public static function shortcode_tabs($attr) {
        $shortcode = '';
        $shortcode .= '[jaw_tabs ';
        $title = '';
        $content = '';
        $class = 'active';
        $attr = (array) $attr;
        if (isset($attr)) {



            foreach ((array) $attr as $index => $tab) {
                $i = substr($index, 5);
                if (strpos($index, 'abs')) {
                    $tab = (array) $tab;
                    if (isset($tab['title']) && isset($tab['description'])) {
                        $title .= '[jaw_tabs_title class="' . $class . '" id="' . $i . '"]' . $tab['title'] . '[/jaw_tabs_title]';
                        $content .= '[jaw_tabs_content class="' . $class . '" id="' . $i . '"]' . $tab['description'] . '[/jaw_tabs_content]';
                        $class = '';
                    }
                } else {
                    $shortcode .= ' ' . $index . '="' . $tab . '"';
                }
            }
        }
        $shortcode .= ']';
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
        $attr = (array) $attr;
        if (isset($attr)) {



            foreach ((array) $attr as $index => $tab) {
                $i = substr($index, 5);
                if (strpos($index, 'ccordion')) {
                    $tab = (array) $tab;
                    if (isset($tab['title']) && isset($tab['description'])) {
                        $class = 'collapse';
                        if ($first && isset($attr['open_first']) && $attr['open_first'] == '1') {
                            $class = 'collapse in';
                            $first = false;
                        }
                        $shortcode .= '[jaw_accordion_item class="' . $class . '" title="' . $tab['title'] . '"]' . $tab['description'] . '[/jaw_accordion_item]';
                        $class = '';
                    }
                }
            }
        }
        $shortcode .= '[/jaw_accordion]';
        return $shortcode;
    }

    public static function shortcode_gallery($attr) {
        $shortcode = '';
        $shortcode .= '[jaw_gallery ';
        if (isset($attr['gallery'])) {
            $shortcode .= ' gallery="';
            foreach ((array) $attr['gallery'] as $img) {

                $img = json_decode(stripcslashes($img));
                foreach ($img as $i) {
                    $shortcode .= $i->id . ',';
                }
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

}

?>
