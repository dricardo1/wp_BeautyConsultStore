<?php

/* ***************************************************************************** *
 * *******************************  SHORTCODE  ********************************* *
 * ***************************************************************************** */

$of_options = array();


/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
        "name" => "Image",
    "desc" => "Put here URL or ID of attachemnt. ",
    "id" => "image",
    "type" => "text",
    'std' => ''
);


$of_options[] = array(
    'id' => 'lightbox',
    'type' => 'select',
    'name' => 'Lightbox',
    'desc' => 'Decide whether or not to open the image using lightbox.',
    'std' => '0',
    "builder" => 'true',
    "options" => array("1" => "On", "0" => "Off")
);


$of_options[] = array(
"name" => "Target Link",
    "desc" => "Insert a target URL of your image.<br><br><strong>Works only when the lightbox is disabled</strong>.",
    "id" => "link",
    "std" => "#",
    "type" => "text"
);

$of_options[] = array(
    'id' => 'target',
    'type' => 'select',
    'name' => 'Link Target',
    'desc' => 'Specify where to open the image.<br><br><strong>Works only when the lightbox is disabled</strong>.',
    'std' => '_self',
    'mod' => 'medium',
    "builder" => 'true',
    "options" => array("_blank" => "_blank", "_top" => "_top", "_parent" => "_parent", "_self" => "_self")
);

$of_options[] = array(
    "type" => "sectionend");



/* ==== Hover ==== */
$of_options[] = array(
    "name" => "Hover",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Hover Image URL",
    "desc" => "Choose the image you want to appear when mouse is moved over the main one.",
    "id" => "hover_image",
    "type" => "text",
    'std' => ''
);

$of_options[] = array(
    "type" => "sectionend");



?>


<?php

echo simpleElements::elements_render($of_options);
?>
