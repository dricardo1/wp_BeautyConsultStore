<?php

$of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Title",
    "desc" => "Insert title of your info box.",
    "id" => "title",
    "std" => "",
    "type" => "textarea"
);

$of_options[] = array(
    "name" => "Content",
    "desc" => "Fill in the field with your text.",
    "id" => "text_content",
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
    'id' => 'message_style',
    'type' => 'select',
    'name' => 'Message Type',
    'desc' => 'Select a type of message. Depending on the selected item, the look of your message will vary.',
    'std' => 'success',
    'mod' => 'medium',
    "builder" => 'true',
    'options' => array( "success" => "Success","info" => "Info", "warning" => "Warning", "danger" => "Danger"),
);

$of_options[] = array(
    "type" => "sectionend");

  
 



?>


         <?php echo simpleElements::elements_render($of_options); ?>


