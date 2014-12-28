<?php

$of_options = array();


/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Latitude",
    "id" => "latitude",
    "std" => "",
    "desc" => "Enter a latitude value in decimal number.",
    "type" => "text"
);

$of_options[] = array(
    "name" => "Longtitude",
    "id" => "longitude",
    "std" => "",
    "desc" => "Enter a longitude value in decimal number.",
    "type" => "text"
);

$of_options[] = array(
    'id' => 'zoom',
    'type' => ' text',
    'name' => 'Zoom',
    'std' => '1',
    'value' => "1",
    'min' => '1',
    'max' => '19',
    'step' => '1',
    'unit' => '',
    'desc' => 'Select a zoom level for the map.',
);

$of_options[] = array(
    'id' => 'marker',
    'type' => 'select',
    'name' => 'Map Marker',
    "std" => "0",
    'desc' => 'Decide whether or not to show marker on the map.',
    "options" => array("1" => "On", "0" => "Off")
);



$of_options[] = array(
    'id' => 'scrollwheel',
    'type' => 'select',
    'name' => 'Disable Scroll Wheel',
    'desc' => 'Turn the option on if using of a mouse scroll wheel on the map has to be disabled.',
    "std" => "0",
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    'id' => 'dragable',
    'type' => 'select',
    'name' => 'Disable Panning the Map',
    "std" => "0",
    'desc' => 'Turn the option on to not to allow panning the map using mouse (drag & drop).',
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    "name" => "Map Type",
    "id" => "maptype",
    "std" => "auto",
    'desc' => 'Select the map type you prefer.',
    "type" => "select",
    "builder" => 'true',
    "options" => array(
        "" => "Choose",
        "auto" => "Auto",
        "road" => "Road",
        "aerial" => "Aerial",
        "birdseye" => "Birdseye"
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
    'desc' => 'Set height of your map in pixels.',
    'name' => 'Height',
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


