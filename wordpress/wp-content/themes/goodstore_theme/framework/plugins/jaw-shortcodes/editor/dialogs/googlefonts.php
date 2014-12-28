

<?php

$of_options = array();


/* ==== Content ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Content",
    "desc" => "Insert a content to be shown using the Google font specified in the Design tab.",
    "id" => "content",
    "std" => "",
    "type" => "textarea"
);

$of_options[] = array(
    "type" => "sectionend");



/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'font_family',
    'type' => 'text',
    'name' => 'Font Family',
    'desc' => 'Insert the Google font family you need. To get a complete list of fonts visit <a href="http://www.google.com/webfonts" target="_blank">this Google page</a>.',
    'std' => ''
);

$of_options[] = array(
    'id' => 'font_size',
    'type' => ' text',
    'name' => 'Font Size',
    'desc' => 'Set font size in pixels.',
    'std' => '18',
    'min' => '1',
    'max' => '50',
    'step' => '1',
    'unit' => 'px'
);

$of_options[] = array(
    "name" => "Font Color",
    "desc" => "Pick a text color (by default: #000000).",
    "id" => "color",
    "std" => "#000000",
    "type" => "color"
);





$of_options[] = array(
    "type" => "sectionend");
?>

<?php echo simpleElements::elements_render($of_options); ?>

