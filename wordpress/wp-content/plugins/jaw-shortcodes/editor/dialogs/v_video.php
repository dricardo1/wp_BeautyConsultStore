<?php

/* * **************************************************************************** *
 * *******************************  SHORTCODE  ********************************* *
 * ***************************************************************************** */

$of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Clip URL",
    "desc" => "Enter URL of a Vimeo video clip.",
    "id" => "clip_id",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    "type" => "sectionend");


/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'height',
    'type' => ' text',
    'name' => 'Height',
    'std' => '480',
    'value' => "10",
    'min' => '0',
    'max' => '960',
    'step' => '1',
    'unit' => 'px'
);


$of_options[] = array(
    'id' => 'autoplay',
    'type' => 'select',
    'name' => 'Autoplay',
    'std' => '0',
    'desc' => 'Decide whether or not to allow the video to automatically start playing.',
    "options" => array("1" => "On", "0" => "Off")
);


$of_options[] = array(
    "type" => "sectionend");
?>


<?php echo simpleElements::elements_render($of_options); ?>

