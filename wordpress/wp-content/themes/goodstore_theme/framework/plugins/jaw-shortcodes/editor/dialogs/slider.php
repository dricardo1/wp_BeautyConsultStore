<?php

$of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");


$of_options[] = array(
    'id' => 'posts_per_page',
    'type' => ' text',
    'name' => 'Number of Items',
    'desc' => 'Set a number of items for your slider.',
    'std' => '6',
    'min' => '5',
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



/* ==== Posts ==== */
$of_options[] = array(
    "name" => "Posts",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'category__in',
    'type' => 'text',
    'name' => 'Include Category (optional)',
    'desc' => 'Insert IDs of all the categories you need to fetch posts from.',
    "std" => '',
    "page" => null,
    "mod" => 'big',
    "chosen" => "true",
    "target" => 'cat',
    "prompt" => "Choose category..",
);

$of_options[] = array(
    'id' => 'post__in',
    'type' => 'text',
    'name' => 'Include Posts (optional)',
    'desc' => 'The specific posts you want to display (in format 52, 45, 87)',
    "std" => '',
);

$of_options[] = array(
    'id' => 'author__in',
    'type' => 'tčext',
    'name' => 'Include Authors (ID)',
    'desc' => 'The specific authors posts you want to display',
    "std" => '',
    "page" => null,
    "mod" => 'big',
    "chosen" => "true",
    "target" => 'author',
    "prompt" => "Choose Authors..",
);

$of_options[] = array(
    'id' => 'tag__in',
    'type' => 'text',
    'name' => 'Include Tags (ID)',
    'desc' => 'Choose the post tags you want to fetch the post.',
    "std" => '',
    "page" => null,
    "mod" => 'big',
    "chosen" => "true",
    "target" => 'tag',
    "prompt" => "Choose tag..",
);

$of_options[] = array(
    'id' => 'sticky_posts',
    'type' => 'select',
    'name' => 'Sticky posts',
    'desc' => 'Choose how to use your sticky posts.',
    'std' => '0',
    "builder" => 'true',
    "options" => array("0" => "Use as classic posts", "ignore_sticky_posts" => "Ignore sticky posts", "show_only_sticky" => "Show only sticky posts")
);

$of_options[] = array(
    "type" => "sectionend");




/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");



$of_options[] = array(
    "name" => "Info Box Text Color",
    "desc" => "Pick a color of your text content of the info box (by default: #000000).",
    "id" => "info_text_color",
    "std" => "#000000",
    "type" => "color"
);


$of_options[] = array(
    "name" => "Info Box Color",
    "desc" => "Pick a background color for the info box (by default: #ffffff).",
    "id" => "info_color",
    "std" => "#ffffff",
    "type" => "color"
);


$of_options[] = array(
    'id' => 'info_opacity',
    'type' => ' text',
    'name' => 'Info Box Opacity',
    'desc' => 'Set an opacity level.',
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
