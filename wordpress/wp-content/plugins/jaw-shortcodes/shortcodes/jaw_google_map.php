<?php
class jaw_google_map {

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

    public function jaw_google_map_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data($this->model((array) $atts));
        return jaw_get_template_part($this->_tmpl, 'simple-shortcodes');
    }

    private function model($atts) {
        shortcode_atts(array(
            "width" => false,
            "height" => '400',
            "address" => '',
            "latitude" => 0,
            "longitude" => 0,
            "zoom" => 14,
            "html" => '',
            "popup" => 'false',
            "controls" => 'false',
            'pancontrol' => 'true',
            'zoomcontrol' => 'true',
            'maptypecontrol' => 'true',
            'scalecontrol' => 'true',
            'streetviewcontrol' => 'true',
            'overviewmapcontrol' => 'true',
            "dragable" => "true",
            "scrollwheel" => 'true',
            'disabledoubleclickzoom' => 'true',
            "maptype" => 'ROADMAP',
            "marker" => 'true',
                ), $atts);
        
        if (isset($atts['box_size'])) {
            $atts['box_size'] = $atts['box_size'];
        } else {
            $atts['box_size'] = 'max';
        }
    
        if (!isset($atts['width'])) {
            $atts['width'] = '100%';
        }
        if (!isset($atts['height'])) {
            $atts['width'] = '300px';
        }
        
        if ($atts['width']) {
            if (is_numeric($atts['width'])) {
                $atts['width'] = $atts['width'] . 'px';
            }
            $atts['width'] = 'width:100%;';
        } else {
            $atts['width'] = '';

        }
        if (isset($atts['height']) && $atts['height']) {
            if (is_numeric($atts['height'])) {
                $atts['height'] = $atts['height'] . 'px';
            }
            $atts['height'] = 'height:' . $atts['height'] . ';';
        } else {
            $atts['height'] = '';
        }

        $atts['id'] = rand(1000, 10000);

        return $atts;
    }
}
