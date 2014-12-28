<?php

$of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Quote",
    "desc" => "Fill in the field with the content to be presented as a block quote.",
    "id" => "custom_text",
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
    'id' => 'design_type',
    'type' => 'select',
    'name' => 'Blockquote Style',
    'desc' => 'Select the blockquote style you prefer.',
    'std' => 'quote_icon',
    "builder" => 'true',
    "options" => array("stripe" => "Stripe", "quote_icon" => "Quote icon")
);



$of_options[] = array(
    "type" => "sectionend");
 


 
?>


         <?php echo simpleElements::elements_render($of_options); ?>


