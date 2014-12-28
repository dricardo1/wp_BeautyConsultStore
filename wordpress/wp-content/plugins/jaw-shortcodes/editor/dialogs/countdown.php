<?php
$of_options = array();


/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");


$of_options[] = array(
    "name" => "End Date & Time",
    "desc" => "Enter date and time in format YYYY-MM-DD-hh-mm-ss (e.g. 2015-05-30-16-50-00)",
    "id" => "datetime",
    "std" => "YYYY-MM-DD-hh-mm-ss",
    "type" => "text"
);

$of_options[] = array(
    "type" => "sectionend");


/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'count_style',
    'type' => 'toggle',
    'name' => 'Style',
    'desc' => 'Choose a style of the countdown element.',
    'std' => 'boxed',
    "options" => array("boxed" => "Boxed", "wide" => "Wide")
);

$of_options[] = array(
    "name" => "Text Color",
    "desc" => "Pick a color of the countdown text.",
    "id" => "color",
    "std" => "#000000",
    "type" => "color"
);

$of_options[] = array(
    'id' => 'hide_days',
    'type' => 'toggle',
    'name' => 'Days',
    'desc' => 'Decide whether or not to show days in your countdown.',
    'std' => 'show-days',
    "options" => array("show-days" => "Show", "hide-days" => "Hide")
);
$of_options[] = array(
    'id' => 'hide_sec',
    'type' => 'toggle',
    'name' => 'Seconds',
    'desc' => 'Decide whether or not to show seconds in your countdown.',
    'std' => 'show-sec',
    "options" => array("show-sec" => "Show", "hide-sec" => "Hide")
);




$of_options[] = array(
    "type" => "sectionend");

?>





         <?php echo simpleElements::elements_render($of_options); ?>


