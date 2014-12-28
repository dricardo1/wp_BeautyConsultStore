<?php
$of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'cats',
    'type' => 'text',
    'name' => 'Include Category (slug)',
    'desc' => 'Choose the categories you want to use in the carousel.',
    "std" => '',
    "page" => null,
    "mod" => 'big',
    "chosen" => "true",
    "target" => 'portfolio-category',
    "prompt" => "Choose category..",
);

$of_options[] = array(
    'id' => 'posts',
    'type' => 'text',
    'name' => 'Testimonial Posts',
    'desc' => 'Insert IDs of the testimonial posts you want to show.',
    'std' => ''
);

$of_options[] = array(
    'id' => 'order',
    'type' => 'select',
    'name' => 'Post Order',
    'desc' => 'Posts order (ascending or descending).',
    'std' => 'desc',
    'mod' => 'small',
    "builder" => 'true',
    'options' => array("desc" => "Desc", "asc" => "Asc")
);

$of_options[] = array(
    'id' => 'orderby',
    'type' => 'select',
    'name' => 'Post Order by',
    'desc' => 'Order posts by parameters. Help on <a target="_blank" href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters">Order by Parameters</a>',
    'std' => 'date',
    'mod' => 'medium',
    "builder" => 'true',
    'options' => array("date" => "Date", "none" => "None", "ID" => "ID",
        "author" => "Author", "title" => "Title", "modified" => "Modified",
        "parent" => "Parent", "rand" => "Rand", "comment_count" => "Comment count")
);


$of_options[] = array(
    'id' => 'count_carousel_post',
    'type' => ' text',
    'name' => 'Count Posts',
    'desc' => 'Count posts per page.',
    'std' => '6',
    'min' => '1',
    'max' => '40',
    'step' => '1',
    'unit' => ''
);
$of_options[] = array(
    'id' => 'post_in_slide',
    'type' => ' text',
    'name' => 'Posts in one slide',
    'desc' => '',
    'std' => '3',
    'min' => '1',
    'max' => '10',
    'step' => '1',
    'unit' => ''
);

$of_options[] = array(
    "type" => "sectionend");


/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'automatic_slide',
    'type' => 'select',
    'name' => 'Automatic sliding',
    'desc' => '',
    'std' => '0',
    "builder" => 'true',
    "options" => array("1" => "On", "0" => "Off")
);


$of_options[] = array(
    "type" => "sectionend");

?>


 <?php echo simpleElements::elements_render($of_options); ?>
