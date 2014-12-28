<?php

$of_options = array();


/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'cats',
    'type' => 'text',
    'name' => 'Include Category',
    'desc' => 'Choose the portfolio categories to be shown in your portfolio.',
    "std" => '',
    "page" => null,
    "mod" => 'big',
    "chosen" => "true",
    "target" => 'portfolio-category',
    "prompt" => "Choose category..",
);

$of_options[] = array(
    "name" => "Order",
    "desc" => "Portfolio items order (ascending or descending).",
    "id" => "order",
    "std" => "ASC",
    "type" => "select",
    "builder" => 'true',
    "options" => array("ASC", "DESC")
);

$of_options[] = array(
    "name" => "Order By",
    "desc" => "Order portfolio items by parameters.",
    "id" => "orderby",
    "std" => "menu_order",
    "type" => "select",
    "builder" => 'true',
    "options" => array("ID", "none", "author", "title", "date", "modified", "parent", "rand", "comment_count", "menu_order")
);

$of_options[] = array(
    "name" => "Portfolios items per page",
    "desc" => "Set number of portfolio items per page.",
    "id" => "count",
    "std" => "50",
    "mod" => "medium",
    "type" => "text"
);


$of_options[] = array(
    "name" => "Pagination style",
    "desc" => "Select the pagination style you prefer.",
    "id" => "pagination",
    "std" => "none",
    "builder" => 'true',
    "type" => "select",
    "options" => array("ajax" => "ajax", "infinite" => "infinite", "infinitemore" => "infinite with more", "none" => "none", "number" => "number", "wordpress" => "wordpress")
);

$of_options[] = array(
    "type" => "sectionend");



/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");



$of_options[] = array(
    "name" => "Info box Text Color",
    "desc" => "Pick a color of the info box text which appears when mouse is moved over item (by default: #000000).",
    "id" => "info_text_color",
    "std" => "#000000",
    "type" => "color"
);


$of_options[] = array(
    "name" => "Info Box Color",
    "desc" => "Pick a background color of the info box (by default: #ffffff).",
    "id" => "info_color",
    "std" => "#ffffff",
    "type" => "color"
);


$of_options[] = array(
    'id' => 'info_opacity',
    'type' => ' text',
    'name' => 'Info Box Opacity',
    'desc' => 'Set transparency level for the info box (by default: 90%).',
    'std' => '90',
    'min' => '0',
    'max' => '100',
    'step' => '10',
    'unit' => '%'
);

$of_options[] = array(
    "type" => "sectionend");

?>



 <?php echo simpleElements::elements_render($of_options); ?>






