<?php

$of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Tabs",
    "desc" => "Open up the Content item and fill in the tab´s title and description fields.<br><br>To add a new tab, click the Add New Tab button.",
    "id" => "tabs",
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
    'id' => 'style',
    'type' => 'select',
    'name' => 'Style',
    'desc' => 'Select the tab style you prefer.',
    'std' => 'light',
    "builder" => 'true',
    "options" => array("light" => "Light", "colored" => "Colored")
);

$of_options[] = array(
    "type" => "sectionend");


?>


         <?php echo simpleElements::elements_render($of_options); ?>

