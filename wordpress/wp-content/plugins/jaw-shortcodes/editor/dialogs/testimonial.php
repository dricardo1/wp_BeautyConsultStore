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
    'desc' => 'Add the testimonial categories you need.',
    "std" => '',
    "page" => null,
    "mod" => 'big',
    "chosen" => "true",
    "target" => 'testimonial-category',
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
    'id' => 'count',
    'type' => ' text',
    'name' => 'Number of Posts',
    'desc' => 'Set number of testimonial posts per page.',
    'std' => '6',
    'min' => '1',
    'max' => '40',
    'step' => '1',
    'unit' => ''
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
    "type" => "sectionend");



?>



 <?php echo simpleElements::elements_render($of_options); ?>






