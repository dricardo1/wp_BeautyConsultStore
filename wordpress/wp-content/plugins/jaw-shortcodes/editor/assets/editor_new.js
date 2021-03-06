/*
 *  For wordpress >=3.9 (tinemce 4+)
 * 
 */


tinymce.PluginManager.add('jaw_shortcodes', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('jaw_shortcodes', {
        title: 'Insert Shortcode',
        icon: 'jawshortcodeicon',
        type: 'menubutton',
        
        menu: [
            /* START COLUMNS **************************************/
            {text: 'Columns',
                menu: [
                    {text: '1/2',
                        onclick: function() {
                            tinymce.activeEditor.selection.setContent('[jaw_section size="6"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                        }},
                    {text: '1/3',
                        onclick: function() {
                            tinymce.activeEditor.selection.setContent('[jaw_section size="4"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                        }}
                    ,
                    {text: '2/3',
                        onclick: function() {
                            tinymce.activeEditor.selection.setContent('[jaw_section size="8"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                        }}
                    ,
                    {text: '1/4',
                        onclick: function() {
                            tinymce.activeEditor.selection.setContent('[jaw_section size="3"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                        }}
                    ,
                    {text: '3/4',
                        onclick: function() {
                            tinymce.activeEditor.selection.setContent('[jaw_section size="9"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                        }}
                    ,
                    {text: '1/6',
                        onclick: function() {
                            tinymce.activeEditor.selection.setContent('[jaw_section size="2"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                        }}
                    ,
                    {text: '5/6',
                        onclick: function() {
                            tinymce.activeEditor.selection.setContent('[jaw_section size="10"]' + tinymce.activeEditor.selection.getContent() + '[/jaw_section]');
                        }}
                ]
            }
            /* END COLUMNS ****************************************/
            
            
            /* START Content *************************************/
            , {
                text: 'Content',
                menu: [
                    {text: 'About author',
                        icon: ' jaw-icon icon-user4',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'author'
                            })
                        }},
                    {text: 'Blog',
                        icon: ' jaw-icon icon-newspaper',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'blog'
                            })
                        }}
                    ,
                    {text: 'Button',
                        icon: ' jaw-icon icon-radio-checked',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'button'
                            })
                        }}
                    ,
                    {text: 'Divider',
                        icon: ' jaw-icon jaw-icon icon-minus',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'divider'
                            })
                        }}
                    ,
                    {text: 'Image',
                        icon: ' jaw-icon icon-image',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'image'
                            })
                        }}
                    ,
                    {text: 'List',
                        icon: ' jaw-icon icon-list2',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'list'
                            })
                        }}
                    ,
                    {text: 'Title',
                        icon: ' jaw-icon icon-type',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'title'
                            })
                        }}
                ]
            }
            /* END Content ***************************************/
            
            
            /* START Social & Media *************************************/
            , {
                text: 'Social & Media',
                menu: [
                    {text: 'Social icons',
                        icon: ' jaw-icon icon-facebook4',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'social_icons'
                            })
                        }},
                    {text: 'Vimeo video',
                        icon: ' jaw-icon icon-vimeo3',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'v_video'
                            })
                        }}
                    ,
                    {text: 'YouTube video',
                        icon: ' jaw-icon icon-youtube',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'y_video'
                            })
                        }}

                ]
            }
             /* END Social & Media ***************************************/


            /* START text content *************************************/
             , {
                text: 'Text content',
                menu: [
                    {text: 'Accordion',
                        icon: ' jaw-icon icon-stack-list',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'accordion'
                            })
                        }},
                    {text: 'BlockQuote',
                        icon: ' jaw-icon icon-quotes-left',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'quote'
                            })
                        }},
                    {text: 'Call to action',
                        icon: ' jaw-icon icon-newspaper',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'cta'
                            })
                        }}
                    ,
                    {text: 'Google Fonts',
                        icon: ' jaw-icon icon-font',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'googlefonts'
                            })
                        }}
                    ,
                    {
                        text: 'Headlines',
                        icon: ' jaw-icon icon-type',
                        menu: [
                            {text: 'H1',
                                onclick: function() {
                                    tinymce.activeEditor.selection.setContent('[h1]' + tinymce.activeEditor.selection.getContent() + '[/h1]');
                                }},
                            {text: 'H2',
                                onclick: function() {
                                    tinymce.activeEditor.selection.setContent('[h2]' + tinymce.activeEditor.selection.getContent() + '[/h2]');
                                }},
                            {text: 'H3',
                                onclick: function() {
                                    tinymce.activeEditor.selection.setContent('[h3]' + tinymce.activeEditor.selection.getContent() + '[/h3]');
                                }},
                            {text: 'H4',
                                onclick: function() {
                                    tinymce.activeEditor.selection.setContent('[h4]' + tinymce.activeEditor.selection.getContent() + '[/h4]');
                                }},
                            {text: 'H5',
                                onclick: function() {
                                    tinymce.activeEditor.selection.setContent('[h5]' + tinymce.activeEditor.selection.getContent() + '[/h5]');
                                }},
                            {text: 'H6',
                                onclick: function() {
                                    tinymce.activeEditor.selection.setContent('[h6]' + tinymce.activeEditor.selection.getContent() + '[/h6]');
                                }},
                        ]
                    },
                    {text: 'Info box',
                        icon: ' jaw-icon icon-info',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'panel_box'
                            })
                        }}
                    ,
                    {text: 'Message text',
                        icon: ' jaw-icon icon-pen',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'message'
                            })
                        }}
                    ,
                    {text: 'Tabs',
                        icon: ' jaw-icon icon-insert-template',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'tabs'
                            })
                        }}
                    ,
                ]
            }
            /* END text content ***************************************/


           /* FEATURES *******************************************/ 
            , {
                text: 'Features',
                menu: [
                    {text: 'Bing Map',
                        icon: ' jaw-icon icon-map2',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'bing_map'
                            })
                        }},
                    {text: 'Comments',
                        icon: ' jaw-icon icon-bubbles5',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'comments'
                            })
                        }}
                    ,
                    {text: 'Contact',
                        icon: ' jaw-icon icon-phone',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'contact'
                            })
                        }},
                    {text: 'Countdown',
                        icon: ' jaw-icon icon-clock',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'countdown'
                            })
                        }},
                    {text: 'Gallery',
                        icon: ' jaw-icon icon-images2',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'gallery'
                            })
                        }}
                    ,
                    {text: 'Google Map',
                        icon: ' jaw-icon icon-map',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'google_map'
                            })
                        }},
                    {text: 'Icon',
                        icon: ' jaw-icon icon-IcoMoon',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'icon'
                            })
                        }},
                    {text: 'Iframe',
                        icon: ' jaw-icon icon-file3',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'iframe'
                            })
                        }}
                    ,
                    {text: 'QR code',
                        icon: ' jaw-icon icon-qrcode',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'qrcode'
                            })
                        }}
                    /* ,
                     {text: 'Pricing table',
                     icon: ' jaw-icon icon-coin',
                     onclick: function() {
                     tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                     title: title,
                     identifier: 'pricing_table'
                     })
                     }}*/
                    ,
                    {text: 'Progress bar',
                        icon: ' jaw-icon icon-bars2',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'one_progressbar'
                            })
                        }}

                ]
            }
            /* END FEATURES ***************************************/


            /* START POST TYPES **********************************************/      
            , {
                text: 'Post types',
                menu: [
                    {text: 'FAQ',
                        icon: ' jaw-icon icon-question',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'faq'
                            })
                        }},
                    {text: 'Portfolio',
                        icon: ' jaw-icon icon-notebook',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'portfolio'
                            })
                        }}
                    ,
                    {text: 'Team',
                        icon: ' jaw-icon icon-users4',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'team'
                            })
                        }},
                    {text: 'Testimonial',
                        icon: ' jaw-icon icon-bubble6',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'testimonial'
                            })
                        }}
                ]
            }
            /* END POST TYPES ******************************************/


            /* START carousel **********************************************/
            , {
                text: 'Carousels',
                menu: [
                    {text: 'Blog carousel',
                        icon: ' jaw-icon icon-stack-picture',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'blog_carousel'
                            })
                        }},
                    {text: 'Blog carousel vertical',
                        icon: ' jaw-icon icon-stack-picture',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'blog_carousel_vertical'
                            })
                        }}
                    ,
                    {text: 'Testimonial carousel',
                        icon: ' jaw-icon icon-stack-picture',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'testimonial_carousel'
                            })
                        }},
                    {text: 'Testimonial carousel vertical',
                        icon: ' jaw-icon icon-stack-picture',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'testimonial_carousel_vertical'
                            })
                        }}
                ]
            }
            /* END carousel ******************************************/


            /* START Sliders **********************************************/
            , {
                text: 'Sliders',
                menu: [
                    {text: 'J&W slider',
                        icon: ' jaw-icon icon-notebook',
                        onclick: function() {
                            tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                title: title,
                                identifier: 'slider'
                            })
                        }}
                ]
            }
            /* END Sliders ******************************************/
        ],
    });

    editor.addCommand("jaw_shortcodes", function(a, params)
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


});




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

