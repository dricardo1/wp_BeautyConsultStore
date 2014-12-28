<?php

$of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Title",
    "desc" => "E.g. name of your shop.",
    "id" => "title",
    "std" => "",
    "builder" => 'true',
    "type" => "text"
);

$of_options[] = array(
    "name" => "Street",
    "desc" => "",
    "id" => "street",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    "name" => "City",
    "desc" => "",
    "id" => "city",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    "name" => "Country",
    "desc" => "",
    "id" => "country",
    "std" => "",
    "type" => "text"
);


$of_options[] = array(
    "name" => "E-mail",
    "desc" => "",
    "id" => "mail",
    "std" => "",
    "builder" => 'true',
    "type" => "text"
);

$of_options[] = array(
    "name" => "Phone",
    "desc" => "",
    "id" => "phone",
    "std" => "",
    "builder" => 'true',
    "type" => "text"
);

$of_options[] = array(
    "name" => "Skype",
    "desc" => "",
    "id" => "skype",
    "std" => "",
    "builder" => 'true',
    "type" => "text"
);

$of_options[] = array(
    "name" => "Description",
    "desc" => "",
    "id" => "desc",
    "std" => "",
    "type" => "textarea"
);

$of_options[] = array(
    'id' => 'show_titles',
    'type' => 'select',
    'name' => 'Show titles / icons',
    'desc' => 'Choose a kind of representation of your data.',
    'std' => 'icon',
    "builder" => 'true',
    "options" => array("text" => "Text", "icon" => "Icon")
);


$of_options[] = array(
    "type" => "sectionend");





/* ==== Openning hours ==== */
$of_options[] = array(
    "name" => "Opening hours",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Su",
    "desc" => "e.g. 09:00 - 11:00",
    "id" => "su",
    "std" => "",
    "builder" => 'true',
    "type" => "text"
);

$of_options[] = array(
    "name" => "Mo",
    "desc" => "e.g. 09:00 - 18:00",
    "id" => "mo",
    "std" => "",
    "builder" => 'true',
    "type" => "text"
);

$of_options[] = array(
    "name" => "Tu",
    "desc" => "e.g. 09:00 - 18:00",
    "id" => "tu",
    "std" => "",
    "builder" => 'true',
    "type" => "text"
);

$of_options[] = array(
    "name" => "We",
    "desc" => "e.g. 09:00 - 18:00",
    "id" => "we",
    "std" => "",
    "builder" => 'true',
    "type" => "text"
);

$of_options[] = array(
    "name" => "Th",
    "desc" => "e.g. 09:00 - 18:00",
    "id" => "th",
    "std" => "",
    "builder" => 'true',
    "type" => "text"
);

$of_options[] = array(
    "name" => "Fr",
    "desc" => "e.g. 09:00 - 18:00",
    "id" => "fr",
    "std" => "",
    "builder" => 'true',
    "type" => "text"
);

$of_options[] = array(
    "name" => "Sa",
    "desc" => "e.g. 09:00 - 11:00",
    "id" => "sa",
    "std" => "",
    "builder" => 'true',
    "type" => "text"
);



$of_options[] = array(
    "type" => "sectionend");

?>


 <?php echo simpleElements::elements_render($of_options); ?>


