<?php
$of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'product_cat',
    'type' => 'multidropdown',
    'name' => 'Include Product Category',
    'desc' => 'Select the WooCommerce product categories to use with the carousel.',
    "page" => null,
    "chosen" => "true",
    "target" => 'product_cat',
    "prompt" => "Choose category..",
    "builder" => "true"
);

$of_options[] = array(
    'id' => 'count',
    'type' => ' text',
    'name' => 'Number of Products',
    'desc' => 'Set number of products per page.',
    'std' => '8',
    'min' => '1',
    'max' => '40',
    'step' => '1',
    'unit' => ''
);

$of_options[] = array("name" => "Number of Products in one slide",
    "desc" => "Set number of products to be shown in one slide.",
    "id" => "post_in_slide",
    "std" => 4,
    "mod" => 'micro',
    'maxlength' => 4,
    "type" => "text"
);

$of_options[] = array(
    'id' => 'order',
    'type' => 'select',
    'name' => 'Products Order',
    'desc' => 'Products order (ascending or descending).',
    'std' => 'desc',
    'mod' => 'small',
    "builder" => 'true',
    'options' => array("desc" => "Desc", "asc" => "Asc")
);

$of_options[] = array(
    'id' => 'orderby',
    'type' => 'select',
    'name' => 'Products Order by',
    'desc' => 'Order Products by parameters. Help on <a target="_blank" href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters">Order by Parameters</a>',
    'std' => 'date',
    'mod' => 'medium',
    "builder" => 'true',
    'options' => array("date" => "Date", "none" => "None", "ID" => "ID",
        "author" => "Author", "title" => "Title", "modified" => "Modified",
        "parent" => "Parent", "rand" => "Rand", "comment_count" => "Comment count")
);

$of_options[] = array(
    'id' => 'dateformat',
    'type' => 'text',
    'name' => 'Post Date Format',
    'desc' => '<a target="_blank" href="http://codex.wordpress.org/Formatting_Date_and_Time">Formatting Date and Time in Wordpress</a>',
    'std' => 'F j, Y',
    'mod' => 'mini'
);


$of_options[] = array(
    "type" => "sectionend");


/* ==== TEXT SETTING ==== */
$of_options[] = array(
    "name" => "Format",
    "type" => "sectionstart");

$of_options[] = array("name" => "Number of Characters - Excerpt in Main Post",
    "desc" => "Enter a number of characters in the preview content.",
    "id" => "letter_excerpt",
    "std" => 300,
    "mod" => 'micro',
    'maxlength' => 4,
    "type" => "text"
);

$of_options[] = array("name" => "Number of Characters - Post Titles",
    "desc" => "Enter a number of characters for your post titles.",
    "id" => "letter_excerpt_title",
    "std" => 60,
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
    'id' => 'carousel_style',
    'type' => 'toggle',
    'name' => 'Carousel Navigation Style',
    'desc' => 'Decide where to place the carousel´s navigation arrows.',
    'std' => 'bar',
    "builder" => 'true',
    "options" => array("bar" => "In bar", "side" => "On the sides")
);

$of_options[] = array(
    'id' => 'automatic_slide',
    'type' => 'select',
    'name' => 'Automatic Sliding',
    'desc' => 'Decide whether or not to allow moving a content of your carousel automatically.',
    'std' => '0',
    "builder" => 'true',
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    'id' => 'box_style',
    'type' => 'select',
    'name' => 'Product Box Style',
    'desc' => 'Select the product box style you prefer.',
    'std' => '0',
    'mod' => 'small',
    "builder" => 'true',
    'options' => array("0" => "Light", "1" => "Color", "2" => "Boxed")
);

$of_options[] = array(
    "type" => "sectionend");



?>

<?php echo simpleElements::elements_render($of_options); ?>