<?php

/* * **************************************************************************** *
 * *******************************  SHORTCODE  ********************************* *
 * ***************************************************************************** */

$of_options = array();


/* ==== Custom URLs ==== */
$of_options[] = array(
    "name" => "Custom URLs",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => " Facebook URL",
    "desc" => "",
    "id" => "facebook",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    "name" => " Twitter URL",
    "desc" => "",
    "id" => "twitter",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    "name" => " Google URL",
    "desc" => "",
    "id" => "google",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    "name" => " YouTube URL",
    "desc" => "",
    "id" => "youtube",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    "name" => " Linked-in URL",
    "desc" => "",
    "id" => "linkedin",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    "name" => " Vimeo URL",
    "desc" => "",
    "id" => "vimeo",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    "name" => " Flickr URL",
    "desc" => "",
    "id" => "flickr",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    "name" => " Pinterest URL",
    "desc" => "",
    "id" => "pinterest",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    "name" => " Instagram URL",
    "desc" => "",
    "id" => "instagram",
    "std" => "",
    "type" => "text"
);


$of_options[] = array(
    "type" => "sectionend");


/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");


$of_options[] = array(
    'id' => 'target',
    'type' => 'select',
    'name' => 'Links Target',
    'desc' => 'Specify where to open a target link.',
    'std' => '_self',
    'mod' => 'medium',
    "builder" => 'true',
    "options" => array("_blank" => "_blank", "_top" => "_top", "_parent" => "_parent", "_self" => "_self")
);

$of_options[] = array(
    'id' => 'size',
    'type' => ' text',
    'name' => 'Size',
    'desc' => 'Set size of icons.',
    'std' => '32',
    'min' => '10',
    'max' => '100',
    'step' => '1',
    'unit' => ''
);

$of_options[] = array(
    "type" => "sectionend");
?>


<?php echo simpleElements::elements_render($of_options); ?>
