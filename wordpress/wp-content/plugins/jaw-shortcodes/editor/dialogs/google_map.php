<?php

$of_options = array();


/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");


$of_options[] = array(
    "name" => 'Latitude',
    "id" => "latitude",
    "std" => "",
    "desc" => "Enter a latitude value in decimal number (if the Address field above is empty).",
    "type" => "text"
);

$of_options[] = array(
    "name" => 'Longitude',
    "id" => "longitude",
    "std" => "",
    "desc" => "Enter a longitude value in decimal number (if the Address field above is empty).",
    "type" => "text"
);

$of_options[] = array(
    'id' => 'zoom',
    'type' => ' text',
    'name' => 'Zoom',
    'desc' => 'Select a zoom level for the map.',
    'std' => '1',
    'value' => "1",
    'min' => '1',
    'max' => '19',
    'step' => '1',
    'unit' => ''
);

$of_options[] = array(
    'id' => 'marker',
    'type' => 'select',
    'name' => 'Map marker',
    "std" => "0",
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    "name" => 'Marker Description',
    "desc" => "Enter your marker description via HTML code.",
    "id" => "description",
    "std" => "",
    "type" => "textarea"
);
$of_options[] = array(
    'id' => 'description_open',
    'type' => 'select',
    'name' => 'Marker Marker Description Opened',
    "desc" => "Decide when the marker description has to be opened.",
    "std" => "start",
    "options" => array("click" => "After click", "start" => "On start")
);

$of_options[] = array(
    'id' => 'controls',
    'type' => 'select',
    'name' => 'Map Controls',
    "desc" => "Decide whether or not to make the map control tools available.",
    "std" => "1",
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    'id' => 'disabledoubleclickzoom',
    'type' => 'select',
    'name' => 'Disable Doubleclick Zoom',
    "desc" => "Turn this option on to disable doubleclick zoom feature.",
    "std" => "1",
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    'id' => 'scrollwheel',
    'type' => 'select',
    'name' => 'Enable Scrool Wheel',
    "desc" => "Turn this option on to enable using of a mouse scroll wheel on the map.",
    "std" => "0",
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    'id' => 'dragable',
    'type' => 'select',
    'name' => 'Panning Map',
    'desc' => 'Decide whether or not to allow panning the map using mouse (drag & drop).',
    "std" => "1",
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    "name" => 'Map Type',
    "id" => "maptype",
    "std" => "ROADMAP",
    "type" => "select",
    "desc" => "Select the map type you prefer.",
    "builder" => 'true',
    "options" => array(
        "" => "Choose",
        "ROADMAP" => "Road Map",
        "SATELLITE" => "Google Earth Map",
        "HYBRID" => "Mixture of normal and satellite",
        "TERRAIN" => "Physical Map"
    )
);

$of_options[] = array(
    "type" => "sectionend");


/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'height',
    'type' => ' text',
    'name' => 'Height',
    'desc' => 'Set height of your map.',
    'std' => '600',
    'value' => "10",
    'min' => '0',
    'max' => '960',
    'step' => '1',
    'unit' => 'px'
);



$of_options[] = array(
    "type" => "sectionend");
?>


<?php echo simpleElements::elements_render($of_options); ?>


