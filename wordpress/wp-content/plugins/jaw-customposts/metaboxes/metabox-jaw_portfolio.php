<?php
global $custom_meta_portfolio;



$custom_meta_portfolio[] = array(
    'id' => 'portfolio_type',
    'type' => 'select',
    'label' => 'Portfolio Type',
    'desc' => 'Choose your portfolio post type.',
    'std' => 'image',
    'mod' => 'medium',
    "options" => array("image" => "Image", "gallery" => "Gallery", "video" => "Video", "audio" => "Audio",  "link" => "Link")
);


//Image
$custom_meta_portfolio[] = array("label" => "Portfolio Image",
    "desc" => "Upload your image.",
    "id" => "_portfolio_image",
    "std" => "",
    "type" => "simplemediapicker");

//Gallery
$custom_meta_portfolio[] = array("label" => "Gallery",
    "desc" => "",
    "id" => "_portfolio_gallery",
    "type" => "media_picker",
);

//Video
$custom_meta_portfolio[] = array("label" => "Video src",
    "desc" => "URL video (youtube, vimeo). Create a thumbnail using Featured Image.",
    "id" => "_portfolio_video_link",
    "std" => "",
    "type" => "text");

// Doc, Link
$custom_meta_portfolio[] = array("label" => "URL Link",
    "desc" => "Insert the link on which you want to redirect a user after clicking.",
    "id" => "_portfolio_link",
    "std" => "",
    "type" => "text");

$custom_meta_portfolio[] = array("label" => "Link Target",
    "desc" => "Define a link target.",
    "id" => "_portfolio_link_target",
    "std" => "_blank",
    "type" => "select",
    "options" => array("_blank" => "_blank", "_top" => "_top", "_parent" => "_parent", "_self" => "_self"));


//soundcloud
$custom_meta_portfolio[] = array("label" => "Soundcloud URL",
    "desc" => "Insert the soundcloud URL",
    "id" => "_portfolio_sound",
    "std" => "",
    "type" => "text");


?>