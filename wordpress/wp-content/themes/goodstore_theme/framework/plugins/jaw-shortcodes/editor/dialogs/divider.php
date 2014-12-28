<?php

$of_options = array();


/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Divider Text",
    "desc" => "Insert a text to be placed in the middle of the divider.",
    "id" => "divider_text",
    "std" => "",
    "type" => "text"
);


$of_options[] = array(
    'id' => 'icon',
    'type' => 'text',
    'name' => 'Divider Icon',
    "desc" => 'Type here class (mentioned in documentation) to choose the icon you prefer.',
    'std' => '',
);

$of_options[] = array(
    "type" => "sectionend");


/* ==== To top ==== */
$of_options[] = array(
    "name" => "To top",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Back To Top Link",
    "desc" => "Decide whether or not to show the Back To Top Link above the divider.",
    "id" => "divider_totop",
    "std" => "0",
    "type" => "select",
    "builder" => "true",
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    "name" => "Back To Top Text",
    "desc" => "Text of the ´Back To Top´ link (by default: Back To Top).",
    "id" => "divider_title",
    "std" => "Back To Top",
    "type" => "text"
);

$of_options[] = array(
    "name" => "Back To Top Text Align",
    "desc" => "Choose an alignment of the link.",
    "id" => "totop_align",
    "std" => "right",
    "type" => "select",
    "builder" => "true",
    "options" => array("left" => "Left", "right" => "Right")
);

$of_options[] = array(
    "type" => "sectionend");

/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");


$of_options[] = array(
    "name" => "Clear",
    "desc" => "Decide whether or not to show divider without space.",
    "id" => "clear",
    "std" => "clear-off",
    "type" => "select",
    "builder" => "true",
    "options" => array("clear-on" => "On", "clear-off" => "Off")
);


$of_options[] = array(
    'id' => 'divider_style',
    'type' => 'select',
    'name' => 'Line Style',
    'desc' => 'Choose the line style.',
    'std' => 'solid',
    'mod' => 'medium',
    "builder" => 'true',
    'options' => array("solid" => "Solid", "dotted" => "Dotted", "dashed" => "Dashed", "none" => "none"),
);

$of_options[] = array(
    "name" => "Divider Text Color",
    "desc" => "Pick a color of your divider text (by default: #000000).",
    "id" => "text_color",
    "std" => "#000000",
    "type" => "color"
);


$of_options[] = array(
    "name" => "Divider Line Color",
    "desc" => "Pick a color of the divider line (by default: #000000).",
    "id" => "color",
    "std" => "#000000",
    "type" => "color"
);

$of_options[] = array(
    'id' => 'width',
    'type' => ' text',
    'name' => 'Divider Thickness',
    'desc' => 'Set thickness of the divider.',
    'std' => '1',
    'min' => '1',
    'max' => '5',
    'step' => '1',
    'unit' => 'px'
);

$of_options[] = array(
    "name" => "Space Before",
    "desc" => "Set size of the space before your divider.",
    "id" => "space",
    'std' => '0',
    'min' => '0',
    'max' => '100',
    'step' => '1',
    'unit' => 'px',
    'type' => ' text',
);
$of_options[] = array(
    "name" => "Space After",
    "desc" => "Set size of the space after your divider.",
    "id" => "space_after",
    'std' => '0',
    'min' => '0',
    'max' => '100',
    'step' => '1',
    'unit' => 'px',
    'type' => ' text',
);



$of_options[] = array(
    "type" => "sectionend");
?>

<?php echo simpleElements::elements_render($of_options); ?>
