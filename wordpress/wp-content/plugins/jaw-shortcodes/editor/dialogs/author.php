<?php

$of_options = array();

$sdbs = get_users();
$authors = array();
if (isset($sdbs) && count($sdbs) > 0) {
    foreach ((array) $sdbs as $k => $sdb) {
        $authors[$sdb->data->ID] = $sdb->data->display_name;
    }
}

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart"
);



$of_options[] = array(
    "name" => "Author",
    "desc" => 'Choose an author from the dropdown list.',
    "id" => "build_authors",
    "type" => "select",
    "builder" => 'true',
    'options' => $authors
);
$of_options[] = array(
    "type" => "sectionend");



?>


<?php echo simpleElements::elements_render($of_options); ?>

