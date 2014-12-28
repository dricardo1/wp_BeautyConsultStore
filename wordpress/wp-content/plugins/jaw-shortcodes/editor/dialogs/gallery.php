<?php

$of_options = array();
//$image_sizes = get_intermediate_image_sizes();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Gallery",
    "desc" => "Click the button to add/edit your gallery.",
    "id" => "gallery",
    "type" => "media_picker"
);



$of_options[] = array(
    'id' => 'lightbox',
    'type' => 'select',
    'name' => 'Lightbox',
    'desc' => 'Decide whether or not to open images using lightbox.',
    'std' => '0',
    "builder" => 'true',
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    "type" => "sectionend");

?>


 <?php echo simpleElements::elements_render($of_options); ?>

