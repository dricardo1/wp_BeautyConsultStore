<?php

/* ***************************************************************************** *
 * *******************************  SHORTCODE  ********************************* *
 * ***************************************************************************** */


$of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Description Text",
    "desc" => "Create your description for the Call To Action element.",
    "id" => "text",
    "std" => "",
    "type" => "textarea"
);

$of_options[] = array(
    'id' => 'button_type',
    'type' => 'select',
    'name' => 'Button Type',
    'desc' => 'Decide whether to use a button or an icon for the Call To Action feature.',
    'std' => 'button',
    "builder" => 'true',
    "options" => array("button" => "Button", "icon" => "Icon")
);

$of_options[] = array(
    'id' => 'cta_button_possition',
    'type' => 'select',
    'name' => 'Button Placement',
    'desc' => 'Select a placement of a button (icon).',
    'std' => 'right',
    "builder" => 'true',
    "options" => array("top" => "Top", "left" => "Left", "bottom" => "Bottom", "right" => "Right")
);

$of_options[] = array(
    "name" => "Button Label",
    "desc" => "Fill in the button label.",
    "id" => "title",
    "std" => "Button",
    "type" => "text"
);

$of_options[] = array(
    "name" => "Icon",
    "desc" => 'Type here class (mentioned in documentation) to choose the icon you prefer.',
    "id" => "icon",
    "std" => "icon-king",
    "type" => "text"
);

$of_options[] = array(
    "name" => "Target Link",
    "desc" => "Insert a target URL for your button/icon.",
    "id" => "link",
    "std" => "http://",
    "type" => "text"
);

$of_options[] = array(
    'id' => 'target',
    'type' => 'select',
    'name' => 'Link Target',
    'desc' => 'Specify where to open a target link.',
    'std' => '_self',
    'mod' => 'medium',
    "builder" => 'true',
    "options" => array("_blank" => "_blank", "_top" => "_top", "_parent" => "_parent", "_self" => "_self")
);

$of_options[] = array(
    "type" => "sectionend");


/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");


$of_options[] = array(
    "name" => "Background Color",
    "desc" => "Pick a color of the description´s background around the button/icon (by default: #EFEFEF).",
    "id" => "color",
    "std" => "#EFEFEF",
    "type" => "color"
);



$of_options[] = array(
    'id' => 'border_type',
    'type' => 'select',
    'name' => 'Border Style',
    'desc' => 'Choose the element´s border style.',
    'std' => 'none',
    "builder" => 'true',
    "options" => array("none" => "None", "solid" => "Solid", "dotted" => "Dotted", "dashed" => "Dashed")
);

$of_options[] = array(
    'id' => 'border_width',
    'type' => ' text',
    'name' => 'Border Width',
    'desc' => 'Set the element´s border width in pixels.',
    'std' => '1',
    'min' => '0',
    'max' => '10',
    'step' => '1',
    'unit' => 'px'
);

$of_options[] = array(
    "name" => "Border Color",
    "desc" => "Pick a color of the element´s border (by default: #EFEFEF).",
    "id" => "border_color",
    "std" => "#EFEFEF",
    "type" => "color"
);

$of_options[] = array(
    'id' => 'cta_button_size',
    'type' => 'select',
    'name' => 'Button Size',
    'desc' => 'Select a button size.',
    'std' => 'default',
    'mod' => 'medium',
    "builder" => 'true',
    "options" => array("btn-xs" => "Extra small", "btn-sm" => "Small", "default" => "Default", "btn-lg" => "Large")
);

$of_options[] = array(
    'id' => 'cta_button_bg_color',
    'type' => 'color',
    'name' => 'Button Background Color',
    'desc' => 'Pick a background color for the button (by default: #EFEFEF).',
    'std' => '#EFEFEF',
    "builder" => 'true',
);

$of_options[] = array(
    'id' => 'cta_button_border_color',
    'type' => 'color',
    'name' => 'Button Border Color',
    'desc' => 'Pick a border color of the button (by default: #5E605F).',
    'std' => '#5E605F',
    "builder" => 'true',
);

$of_options[] = array(
    'id' => 'cta_button_font_color',
    'type' => 'color',
    'name' => 'Custom Button Font Color',
    'desc' => 'Pick a color of the button label text (by default: #5E605F).',
    'std' => '#5E605F',
    "builder" => 'true',
);

$of_options[] = array(
    "type" => "sectionend");

?>


 <?php echo simpleElements::elements_render($of_options); ?>


