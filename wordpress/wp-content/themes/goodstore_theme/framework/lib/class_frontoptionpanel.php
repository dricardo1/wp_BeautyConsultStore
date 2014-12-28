<?php

/**
 * A side switch options panel. Use only for demo site! 
 *
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
if (!class_exists('jwFrontOptionPanel')) {
class jwFrontOptionPanel {

    static public function render() {

        $template_body_main_color = array(
            "lime" => '#aec71e',
            "orange" => '#ec5923',
            "darkblue" => '#2d5c88',
            "cyan" => '#2997ab',
            "darkgreen" => '#719430',
            "grunge" => '#85742e',
            "lightblue" => '#8bbbe0',
            "lightgreen" => '#8eccb3',
            "navy" => '#435960',
            "pink" => '#e44884',
            "purple" => '#46424f',
            "darkred" => '#a81010',
            "darkgrey" => '#464646',
            "red" => '#d73300',
            "green" => '#579b18',
            "blue" => '#20b1ea',
            "yellow" => '#f8c741',
            "salmon" => '#FF717E'
        );

        ob_start();
        ?>


        <div id="jaw-rwpanel">
            <div class="jaw-rwpanel-holder">
                <div class="main-title">Style Selector</div>
                <div class="item-title">Template Color</div>
                <div class="item-box">
                    <ul id="live_backgroundimage_select">
                        <?php foreach ($template_body_main_color as $key => $color) { ?>
                            <li class="" data="<?php echo $key; ?>" style="background-color:<?php echo $color; ?>" ></li>     
                        <?php } ?>
                    </ul> 
                    <div class="clear"></div>
                </div>

                <div class="item-title">Background Texture</div>
                <div class="item-box">
                    <ul id="live_backgroundtexture_select">
                        <?php
                        $patterns = jwUtils::fileLoader(STYLESHEETPATH . '/images/bg_texture/', array('.png', '.jpg'), $bg_images_url = get_template_directory_uri() . '/images/bg_texture/');
                        foreach ($patterns as $pattern) {
                            ?>
                            <li>
                                <img src="<?php echo $pattern; ?>"/>
                            </li>

                        <?php } ?>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="item-title">Background image

                    <?php
                    if (isset($_COOKIE['bg_image']) && $_COOKIE['bg_image'] !== '')
                        $bg = $_COOKIE['bg_image'];
                    else
                        $bg = 0;
                    ?>
                    <input name="bg_image" id="bg_image" type="checkbox" <?php echo checked($bg, '1', false) ?> />
                </div>
                
                
                 <div class="item-title">RTL

                    <?php
                    if (isset($_COOKIE['rtl_support']) && $_COOKIE['rtl_support'] !== '')
                        $rtl = $_COOKIE['rtl_support'];
                    else
                        $rtl = 0;
                    ?>
                    <input name="rtl_support" id="rtl_support" type="checkbox" <?php echo checked($rtl, '1', false) ?> />
                </div>
                
                

                <div class="item-box reset-panel">
                    <a id="resetopt" href="./">Reset</a>
                </div>

            </div>
            <div class="jawpanel-nav"><img id="jawpanel-naw-arrow" class="" alt="minus" src="<?php echo get_template_directory_uri() ?>/images/optionpanel.png"></div>
        </div>
        <style>
            @media only screen and (max-width: 767px)  {#jaw-rwpanel {display:none}}
            #jaw-rwpanel .item-box {padding: 10px 0px 10px 15px;}
            #jaw-rwpanel .item-box,#jaw-rwpanel .main-title,#jaw-rwpanel .item-title {border-bottom: 1px solid rgba(23, 24, 26, 0.15);color: #000000;text-align: left;}
            #jaw-rwpanel .main-title {line-height: 36px;text-align: center;}
            #jaw-rwpanel .item-title {line-height: 36px;text-align: center;}
            .jaw-rwpanel-holder input.checkbox {width: 30px;margin-top:3px;}
            .jaw-rwpanel-holder input.checkbox {width: 30px;margin-top:3px;}
            .jaw-rwpanel-holder .of-radio-img-img:hover {opacity:.8;}
            .jaw-rwpanel-holder .of-radio-tile-radio {display: none}
            .jaw-rwpanel-holder .of-radio-tile-img {width:10px;height:10px;border:3px solid #f9f9f9;margin:0 5px 10px 0;display:none;cursor:pointer;float:left;}
            #jaw-rwpanel {left: -181px;position: fixed;top: 154px;width: 180px;z-index: 100;background-color: #fff;border: 1px solid rgba(23, 24, 26, 0.15);border-bottom-left-radius:2px;border-top-left-radius:2px;box-shadow:0 2px 9px 2px rgba(0, 0, 0, 0.14);}
            #jaw-rwpanel ul {width:150px}
            .jaw-rwpanel-holder {position: relative}
            .jawpanel-nav {position: absolute;top:37px;left:178px;background-color: #fff; padding: 5px; height: 36px; width: 36px;cursor:pointer;border-bottom-right-radius:2px;border-top-right-radius:2px;border:1px solid #DCDCDC;border-left: 0px none;z-index: 90;   }
            .reset-panel {padding: 20px 0px 10px 0px;}
            .reset-panel a#resetopt {color: #e32b23;}
            #live_backgroundimage_select li {float:left;width:20px;height:20px; margin:5px 5px 0px 0;cursor:pointer;list-style: none outside none;}
            #live_backgroundimage_select li:hover,#live_backgroundtexture_select li:hover{opacity: 0.7}
            #live_backgroundtexture_select li {float:left;width:30px;height:30px; margin:5px 5px 0px 0;cursor:pointer;list-style: none outside none;}
            #live_backgroundtexture_select img {border:1px solid #B8BEC1;width:30px;height:30px;}

        </style>
        <script>
            // Parse URL Queries Method


            jQuery(document).ready(function($) {
                jQuery('#resetopt').click(function() {
                    setCookie('preset', '0');
                    setCookie('background_texture', '');
                    setCookie('bg_image', '');
                    setCookie('rtl_support', '');
                    setCookie('template_body_main_color', '');
                });

                function setCookie(c_name, value) {
                    var exdate = new Date();
                    var time = exdate.getTime();
                    time += 3600 * 1000;
                    exdate.setTime(time);
                    var c_value = escape(value) + "; expires=" + exdate.toUTCString();
                    document.cookie = c_name + "=" + c_value;
                }

                jQuery('#live_backgroundimage_select li').click(function() {
                    setCookie('preset', '1');
                    setCookie('template_body_main_color', $(this).attr('data'));
                    window.location = window.location;
                });

                jQuery('#live_backgroundtexture_select li').click(function() {
                    setCookie('preset', '1');
                    var i = $(this).children().attr('src');
                    if (i.substr(i.length - 8) == 'none.png')
                        setCookie('background_texture', '');
                    else
                        setCookie('background_texture', $(this).children().attr('src'));
                    window.location = window.location;
                });

                jQuery('#bg_image').click(function() {
                    setCookie('preset', '1');

                    var $t = $(this);
                    if ($t.prop('checked'))
                        setCookie('bg_image', '1');
                    else
                        setCookie('bg_image', '0');
                    window.location = window.location;
                });
                
                jQuery('#rtl_support').click(function() {
                    setCookie('preset', '1');

                    var $t = $(this);
                    if ($t.prop('checked')){
                        setCookie('rtl_support', '1');                       
                    }else{
                        setCookie('rtl_support', '0');
                     }
                     window.location = window.location;
                });
                
                if($.cookie("rtl_support") == '1'){
                    jQuery("body").addClass("rtl");
                }
    


                jQuery('.jawpanel-nav').click(function() {
                    left = jQuery('#jaw-rwpanel').css('left');
                    leftInt = parseInt(left.replace("px", ""));
                    if (leftInt == 0) {
                        jQuery('#jaw-rwpanel').animate({left: '-181px'});
                    } else {
                        jQuery('#jaw-rwpanel').animate({left: '0px'});
                    }
                });
            });
        </script>

        <?php
        ob_get_flush();
    }

}
}

