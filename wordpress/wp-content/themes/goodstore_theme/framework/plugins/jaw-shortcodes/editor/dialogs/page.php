<?php

$of_options = array();


/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'id',
    'type' => 'text',
    'name' => 'Page ID',
    'desc' => 'Enter ID of the page to be displayed in this element.',
    'std' => ''
);

$of_options[] = array(
    "type" => "sectionend");


/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");


$of_options[] = array(
    "name" => "Background Image URL",
    "desc" => "Choose a background image.",
    "id" => "image",
    "type" => "text",
    'std' => ''
);

 

$of_options[] = array(
    "type" => "sectionend");
 




 

?>


         <?php echo simpleElements::elements_render($of_options); ?>


