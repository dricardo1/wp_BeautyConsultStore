<?php

$of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Accordion",
    "desc" => "Open the Content 1 dropdown item and fill in the accordion´s title and description fields with your content.<br><br>To add another slide, click the Add New Slide.",
    "id" => "accordion",
    "std" => "",
    "type" => "tabs"
);

$of_options[] = array(
    "type" => "sectionend");


/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");

 
$of_options[] = array(
    'id' => 'open_first',
    'type' => 'select',
    'name' => 'Open First Item as Default',
    'desc' => 'Decide whether or not to open the first item as default.',
    'std' => '0',
    "builder" => 'true',
    "options" => array("1"=>"On", "0" => "Off")
);

 

$of_options[] = array(
    "type" => "sectionend");


 
?>


 <?php echo simpleElements::elements_render($of_options); ?>
