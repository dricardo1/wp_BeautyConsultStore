<?php

$of_options = array();


/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'cats',
    'type' => 'text',
    'name' => 'Include Team Category',
    'desc' => 'Select the team categories you need.',
    "std" => '',
    "page" => null,
    "mod" => 'big',
    "chosen" => "true",
    "target" => 'team-category',
    "prompt" => "Choose category..",
);

$of_options[] = array(
    "name" => "Order",
    "desc" => "Items order (ascending or descending).",
    "id" => "order",
    "std" => "ASC",
    "builder" => 'true',
    "type" => "select",
    "options" => array("ASC", "DESC")
);

$of_options[] = array(
    "name" => "Order by",
    "desc" => "Order the team items by parameters.",
    "id" => "orderby",
    "std" => "menu_order",
    "type" => "select",
    "builder" => 'true',
    "options" => array("ID", "none", "author", "title", "date", "modified", "parent", "rand", "comment_count", "menu_order")
);



$of_options[] = array(
    "type" => "sectionend");

/* ==== TEXT SETTING ==== */
$of_options[] = array(
    "name" => "Format",
    "type" => "sectionstart");

$of_options[] = array("name" => "Number of Characters in Excerpt",
    "desc" => "Enter a number of characters to be shown in excerpt.",
    "id" => "letter_excerpt",
    "std" => 100,
    "mod" => 'micro',
    'maxlength' => 4,
    "type" => "text"
);


$of_options[] = array(
    "type" => "sectionend");


/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");


$of_options[] = array(
    'id' => 'clickable_title',
    'type' => 'select',
    'name' => 'Clickable title',
    'desc' => '',
    'std' => '0',
    "builder" => 'true',
    "options" => array("1" => "On", "0" => "Off")
);


$of_options[] = array(
    "type" => "sectionend");

?>



 <?php echo simpleElements::elements_render($of_options); ?>






