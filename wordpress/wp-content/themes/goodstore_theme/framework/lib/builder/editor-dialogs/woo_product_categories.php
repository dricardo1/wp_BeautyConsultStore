<?php

//[featured_products per_page="12" columns="4" orderby="date" order="desc"]
 
 $of_options = array();


$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");


$of_options[] = array(
    'id' => 'ids',
    'type' => 'multidropdown',
    'name' => 'Categories',
    'desc' => 'Choose the product categories you want to fetch products from.' . ' ' . jwUtils::getHelp("mpb_incl_cat"),
    "std" => array(),
    "page" => null,
    "mod" => 'big',
    "chosen" => "true",
    "target" => 'product_cat_id',
    "prompt" => "Choose category..",
);

$of_options[] = array(
    "type" => "sectionend");



$of_options[] = array(
    "name" => "Bar",
    "type" => "sectionstart");


$of_options[] = array(
    'id' => 'bar_type',
    'type' => 'toggle',
    'name' => 'Bar Type',
    'desc' => 'Select this element&acute;s header type.',
    'std' => 'big',
    "builder" => 'true',
    "options" => array("off" => "Off", "space" => "Off without space", "line" => "Line", "box" => "Box", "big" => "Big title")
);

$of_options[] = array(
    "type" => "sectionend");
 
 
 /* Settings */
 global $jaw_builder_options;
$jaw_builder_options['woo_product_categories'] = $of_options;