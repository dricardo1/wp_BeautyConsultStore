<?php

$of_options = array();


/* ==== HTML ==== */
$of_options[] = array(
    "name" => "HTML",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "HTML Code",
    "desc" => "Insert your HTML code.",
    "id" => "html_code",
    "std" => "",
    "type" => "textarea"
);

$of_options[] = array(
    "type" => "sectionend");


/* ==== JS ==== */
$of_options[] = array(
    "name" => "JavaScript",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "JavaScript Code",
    "desc" => "Insert your JavaScript code.",
    "id" => "js_code",
    "std" => "",
    "type" => "textarea"
);

$of_options[] = array(
    "type" => "sectionend");

 


/* ==== BAR ==== */
$of_options[] = array(
    "name" => "Bar",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'bar_type',
    'type' => 'select',
    'name' => 'Bar Type',
    'desc' => 'Select this element´s header type.',
    'std' => 'big',
    "builder" => 'true',
   "options" => array("off"=>"Off", "space" => "Off without space",  "line" => "Line", "box" => "Box", "big" => "Big title")
);

$of_options[] = array(
    "type" => "sectionend");
 

?>

         <?php echo simpleElements::elements_render($of_options); ?>

