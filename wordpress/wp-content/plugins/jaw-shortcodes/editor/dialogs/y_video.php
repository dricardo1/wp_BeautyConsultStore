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
    "name" => "Initial Clip URL",
    "desc" => "Enter URL of a YouTube video clip.",
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
    'desc' => 'Set height of the video window.',
    'std' => '480',
    'value' => "10",
    'min' => '0',
    'max' => '960',
    'step' => '1',
    'unit' => 'px'
);

$of_options[] = array(
    'id' => 'autohide',
    'type' => 'select',
    'name' => 'Autohide',
    'desc' => 'This parameter indicates whether/how the video controls will automatically hide after the video starts.',
    'std' => '2',
    'mod' => 'medium',
    "builder" => 'true',
    "options" => array("2"=>"Fade out timeline", "1" => "Fade out whole bar", "0" => "Show bar all time")
);

$of_options[] = array(
    'id' => 'autoplay',
    'type' => 'select',
    'name' => 'Autoplay',
    'desc' => 'Decide whether or not to allow the video to automatically start playing.',
    'std' => '0',
    "options" => array("1" => "On", "0" => "Off")
);


$of_options[] = array(
    'id' => 'loop',
    'type' => 'toggle',
    'name' => 'Loop',
    'desc' => 'In case of a single video player, the On option will cause that the player plays the initial video over and over again.',
    'std' => '0',
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    'id' => 'rel',
    'type' => 'select',
    'name' => 'Related',
    'desc' => 'Decide whether or not to allow the player to show related videos after playback ends.',
    'std' => '1',
    "options" => array("1" => "On", "0" => "Off")
);



$of_options[] = array(
    "type" => "sectionend");


 

?>


 <?php echo simpleElements::elements_render($of_options); ?>