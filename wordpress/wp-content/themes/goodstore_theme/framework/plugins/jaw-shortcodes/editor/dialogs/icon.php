<?php

$of_options = array();


/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");


$of_options[] = array(
    'id' => 'icon',
    'type' => 'text',
    'name' => 'Icon',
    "desc" => 'Type here class (mentioned in documentation) to choose the icon you prefer.',
    'std' => '',
);

$of_options[] = array(
    "type" => "sectionend");


/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Color",
    "desc" => "Pick a color of your icon (by default: #000000).",
    "id" => "color",
    "std" => "#000000",
    "type" => "color"
);

$of_options[] = array(
    'id' => 'size',
    'type' => ' text',
    'name' => 'Size',
    'desc' => 'Size size of your icon',
    'std' => '32',
    'min' => '10',
    'max' => '100',
    'step' => '1',
    'unit' => ''
);

$of_options[] = array(
    "type" => "sectionend");



?>


 <?php echo simpleElements::elements_render($of_options); ?>


