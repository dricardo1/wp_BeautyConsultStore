<?php

$absolute_path = __FILE__;
$path_to_file = explode('wp-content', $absolute_path);
$path_to_wp = $path_to_file[0];

//Access WordPress
require_once( $path_to_wp . '/wp-load.php' );

if (locate_template('framework/plugins/jaw-shortcodes/editor/dialogs/' . $_GET['code'] . '.php')) {

    echo '<div id="jaw_shortcodes" class="editor-content from-theme"  ng-controller="shotcodeEditor">';
    locate_template('framework/plugins/jaw-shortcodes/editor/dialogs/' . $_GET['code'] . '.php', true, true);
    echo '</div>';
    echo '<script>';
    echo 'jQuery(document).ready(function() {
                    angular.bootstrap(jQuery("#jaw_shortcodes"), ["shotcode_editor"]); 
                });';
    echo '</script>';

    echo '<div class="controll-bar">';
    echo '<button type="button" class="button button-primary button-large editor-insert" onclick="insert_shortcode(\'' . $_GET['code'] . '\')">Insert</button>';
    echo '</div>';
} else if (file_exists('dialogs/' . $_GET['code'] . '.php')) {
    echo '<div class="editor-content">';
    include_once('dialogs/' . $_GET['code'] . '.php');
    echo '</div>';
    echo '<div class="controll-bar">';
    echo '<button type="button" class="button button-primary button-large editor-insert" onclick="insert_shortcode(\'' . $_GET['code'] . '\')">Insert</button>';
    echo '</div>';
} else {
    echo 'Sorry but dilagog for "' . $_GET['code'] . '" not exist.';
}
?>
