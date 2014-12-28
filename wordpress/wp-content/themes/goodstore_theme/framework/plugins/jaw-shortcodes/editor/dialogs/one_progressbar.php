<?php

$of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Title",
    "desc" => "Value is in percent 0 - 100",
    "id" => "title",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    "name" => "Value",
    "desc" => "Value is in percent 0 - 100",
    "id" => "value",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    "name" => "Color",
    "desc" => "",
    "id" => "color",
    "std" => "#EFEFEF",
    "type" => "color"
);

$of_options[] = array(
    "type" => "sectionend");





?>

         <?php echo simpleElements::elements_render($of_options); ?>
