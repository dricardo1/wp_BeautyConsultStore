<?php

$of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Title",
    "desc" => "Title of your list.",
    "id" => "title",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    'id' => 'icon',
    'type' => 'text',
    'name' => 'Bullet Icon',
    "desc" => 'Type here class (mentioned in documentation) to choose the icon you prefer.',
    'std' => 'icon-circle-small',
);

$of_options[] = array(
    "name" => "List Items",
    "desc" => "Fill in the list item field with your text and click the [ + ] button to add next item.<br><br>The trash option removes the item.",
    "id" => "list",
    "std" => "",
    "type" => "list"
);

$of_options[] = array(
    "type" => "sectionend");
?>

<?php echo simpleElements::elements_render($of_options); ?>


