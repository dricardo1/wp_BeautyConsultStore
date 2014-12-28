/*
 *  For wordpress <=3.8 (tinemce 3+)
 * 
 */
(function() {
    var thm;
    tinymce.create('tinymce.plugins.jaw_shortcodes', {
        init: function(ed, url) {
            thm = url;
            ed.addCommand("jaw_shortcodes", function(a, params)
            {
                var code = params.identifier;

                // load thickbox
                tb_show("Insert JaW Shortcode", url + "/editor.php?code=" + code + "&width=" + 640 + "&height=" + 440);

                var id_list = 1;
                jQuery('#TB_window').find('.add-list').live('click', function() {

                    jQuery(this).parent().find('.list-li').last().after('<div class="list-li" >'
                            + '<input id="list" class="of-input" type="text" value="" name="' + jQuery(this).attr('id') + '-' + (id_list++) + '">'
                            + '</div>');
                });



            });

        },
        createControl: function(n, cm) {
            switch (n) {
                case 'jaw_shortcodes':
                    var c = cm.createMenuButton('jaw_shortcodes', {
                        title: 'Insert Shortcode',
                        image: thm + '/assets/img/shortcodes-icon.gif',
                        icons: false
                    });

                    c.onRenderMenu.add(function(c, m) {
                        var sub;

                        /* START COLUMNS **************************************/
                        sub = m.addMenu({
                            title: 'Columns'
                        });

                        sub.add({
                            title: '1/2',
                            onclick: function() {
                                tinymce.activeEditor.selection.setContent('[jaw_section size="6"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                            }
                        });



                        sub.add({
                            title: '1/3',
                            onclick: function() {
                                tinymce.activeEditor.selection.setContent('[jaw_section size="4"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                            }
                        });



                        sub.add({
                            title: '2/3',
                            onclick: function() {
                                tinymce.activeEditor.selection.setContent('[jaw_section size="8"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                            }
                        });



                        sub.add({
                            title: '1/4',
                            onclick: function() {
                                tinymce.activeEditor.selection.setContent('[jaw_section size="3"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                            }
                        });



                        sub.add({
                            title: '3/4',
                            onclick: function() {
                                tinymce.activeEditor.selection.setContent('[jaw_section size="9"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                            }
                        });

                        sub.add({
                            title: '1/6',
                            onclick: function() {
                                tinymce.activeEditor.selection.setContent('[jaw_section size="2"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                            }
                        });


                        sub.add({
                            title: '5/6',
                            onclick: function() {
                                tinymce.activeEditor.selection.setContent('[jaw_section size="10"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                            }
                        });



                        /* END COLUMNS ****************************************/






                        /* START Content *************************************/
                        sub = m.addMenu({
                            title: 'Content'
                        });

                        sub.add({
                            title: '<i class="icon-user4"></i> About author',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'author'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-newspaper"></i> Blog',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'blog'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-radio-checked"></i> Button',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'button'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-minus"></i> Divider',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'divider'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-image"></i> Image',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'image'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-list2"></i> List',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'list'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-type"></i> Title',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'title'
                                })
                            }
                        });

                        /* END Content ***************************************/


                        /* START Social & Media *************************************/
                        sub = m.addMenu({
                            title: 'Social & Media'
                        });

                        sub.add({
                            title: '<i class="icon-facebook4"></i> Social icons',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'social_icons'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-vimeo3"></i> Vimeo video',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'v_video'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-youtube"></i> YouTube video',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'y_video'
                                })
                            }
                        });

                        /* END Social & Media ***************************************/


                        /* START text content *************************************/
                        sub = m.addMenu({
                            title: 'Text content'
                        });

                        sub.add({
                            title: '<i class="icon-stack-list"></i> Accordion',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'accordion'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-quotes-left"></i> BlockQuote',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'quote'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-newspaper"></i> Call to action',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'cta'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-font"></i> Google Fonts',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'googlefonts'
                                })
                            }
                        });

                        var subSub = sub.addMenu({
                            title: '<i class="icon-type"></i> Headlines'
                        });

                        subSub.add({
                            title: 'h1',
                            onclick: function() {
                                tinymce.activeEditor.selection.setContent('[h1]' + tinymce.activeEditor.selection.getContent() + '[/h1]');
                            }
                        });

                        subSub.add({
                            title: 'h2',
                            onclick: function() {
                                tinymce.activeEditor.selection.setContent('[h2]' + tinymce.activeEditor.selection.getContent() + '[/h2]');
                            }
                        });

                        subSub.add({
                            title: 'h3',
                            onclick: function() {
                                tinymce.activeEditor.selection.setContent('[h3]' + tinymce.activeEditor.selection.getContent() + '[/h3]');
                            }
                        });

                        subSub.add({
                            title: 'h4',
                            onclick: function() {
                                tinymce.activeEditor.selection.setContent('[h4]' + tinymce.activeEditor.selection.getContent() + '[/h4]');
                            }
                        });

                        subSub.add({
                            title: 'h5',
                            onclick: function() {
                                tinymce.activeEditor.selection.setContent('[h5]' + tinymce.activeEditor.selection.getContent() + '[/h5]');
                            }
                        });

                        subSub.add({
                            title: 'h6',
                            onclick: function() {
                                tinymce.activeEditor.selection.setContent('[h6]' + tinymce.activeEditor.selection.getContent() + '[/h6]');
                            }
                        });

                        sub.add({
                            title: '<i class="icon-info"></i> Info box',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'panel_box'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-pen"></i> Message text',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'message'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-insert-template"></i> Tabs',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'tabs'
                                })
                            }
                        });

                        /* END text content ***************************************/


                        /* FEATURES *******************************************/
                        sub = m.addMenu({
                            title: 'Features'
                        });

                        sub.add({
                            title: '<i class="icon-map2"></i> Bing Map',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'bing_map'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-bubbles5"></i> Comments',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'comments'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-phone"></i> Contact',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'contact'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-clock"></i> Countdown',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'countdown'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-images2"></i> Gallery',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'gallery'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-map"></i> Google Map',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'google_map'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-IcoMoon"></i> Icon',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'icon'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-file3"></i> Iframe',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'iframe'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-qrcode"></i> QR code',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'qrcode'
                                })
                            }
                        });
                        /*
                         sub.add({
                         title: '<i class="icon-coin"></i> Pricing table',
                         onclick: function() {
                         tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                         title: title,
                         identifier: 'pricing_table'
                         })
                         }
                         });
                         */

                        sub.add({
                            title: '<i class="icon-bars2"></i> Progress bar',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'one_progressbar'
                                })
                            }
                        });

                        /* END FEATURES ***************************************/

                        /* START POST TYPES **********************************************/
                        sub = m.addMenu({
                            title: 'Post types'
                        });

                        sub.add({
                            title: '<i class="icon-question"></i> FAQ',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'faq'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-notebook"></i> Portfolio',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'portfolio'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-users4"></i> Team',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'team'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-bubble6"></i> Testimonial',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'testimonial'
                                })
                            }
                        });

                        /* END POST TYPES ******************************************/


                        /* START carousel **********************************************/
                        sub = m.addMenu({
                            title: 'Carousels'
                        });

                        sub.add({
                            title: '<i class="icon-stack-picture"></i> Blog carousel',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'blog_carousel'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-stack-picture"></i> Blog carousel vertical',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'blog_carousel_vertical'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-stack-picture"></i> Testimonial carousel',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'testimonial_carousel'
                                })
                            }
                        });

                        sub.add({
                            title: '<i class="icon-stack-picture"></i> Testimonial carousel vertical',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'testimonial_carousel_vertical'
                                })
                            }
                        });

                        /* END carousel ******************************************/


                        /* START Sliders **********************************************/
                        sub = m.addMenu({
                            title: 'Sliders'
                        });

                        sub.add({
                            title: '<i class="icon-notebook"></i> J&W slider',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'slider'
                                })
                            }
                        });

                        /* END Sliders ******************************************/


                    });

                    // Return the new menu button instance
                    return c;
            }

            return null;
        },
        getInfo: function() {
            return {
                longname: 'JaW Shortcodes',
                author: 'JaW Templates',
                authorurl: 'http://themeforest.net/user/jawtemplates/',
                infourl: 'http://www.jawtemplates.com/',
                version: "1.0"
            }
        }
    });
    tinymce.PluginManager.add('jaw_shortcodes', tinymce.plugins.jaw_shortcodes);
})();




var insert_shortcode = function(type) {
    var data = new Object();
    jQuery('#jaw_shortcodes input, #jaw_shortcodes select , #jaw_shortcodes textarea').each(function() {
        data[jQuery(this).attr('name').toString()] = jQuery(this).val();
    });
    jQuery.post(
            ajaxurl,
            {
                'action': 'jaw_shortcodes_ajax',
                'data': data,
                'type': type
            },
    function(response) {
        tinymce.activeEditor.selection.setContent(tinymce.activeEditor.selection.getContent() + response);
        tb_remove();
    }
    );

};

