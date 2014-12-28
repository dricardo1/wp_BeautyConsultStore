var rtl;
var window_width = 0;
var first = true;
var left_offset = 16;
var mobile = false;
if (navigator.userAgent.match(/Android|BlackBerry|iPhone|iPod|Opera Mini|IEMobile/i)) {
    mobile = 'mobile';
} else if (navigator.userAgent.match(/iPad/i)) {
    mobile = 'tablet';
}

var offset = 0;
var offsetTopBar = 0;
var offsetMenuBar = 0;
var isotope_init = false;
jQuery(document).ready(function($) {
    if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
        var msViewportStyle = document.createElement("style");
        msViewportStyle.appendChild(
                document.createTextNode(
                        "@-ms-viewport{width:auto!important}"
                        )
                );
        document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
    }

    $('.jaw-counter').countTo();
    $('.post.format-gallery .carousel').carousel({
        interval: 5000
    });
    $('.tab-post-row .carousel').carousel({
        interval: 5000
    });
    // *** ISOTOPE**************************************************************

    if (rtl == '1' || $.cookie("rtl_support") == '1') {
        $.Isotope.prototype._positionAbs = function(x, y) {
            return {
                right: x,
                top: y
            };
        };
    }


    $('#main').on('click', '.items-sortby-list a', function() {
        sortName = $(this).attr('href').slice(1);
        if (sortName == 'name' || sortName == 'price' || sortName == 'category') {
            sortAscending = true;
        } else {
            sortAscending = false;
        }
        $(this).parents('.builder-section').find('.elements_iso').isotope({
            sortBy: sortName,
            sortAscending: sortAscending
        });
        return false;
    });
    // END ISOTOPE**************************************************************

    //ISOtope - filtrování portfolii-------------------------------------------

    // filter items when filter link is clicked
    $('.items-filter-list a').click(function() {
        var selector = $(this).attr('data-filter');
        $(this).parents('.builder-section').find('.elements_iso').isotope({
            filter: selector
        });
        return false;
    });
    /*************************************************************************** 
     * BANNERS - Skyscrapper 
     * ************************************************************************/
    $('.skyscrapper').css({
        top: $('#header').height() + "px"
    });
    /***************************************************************************
     * TO TOP 
     ***************************************************************************/
    $(window).scroll(function() {
        offset = $(window).scrollTop();
        if (offset >= 50 && wWidth > 959) {
            $('#totop').show(250);
        } else {
            $('#totop').hide(250);
        }
    });
    $('#totop').hover(function() {
        $(this).animate({
            'opacity': '1'
        }, 150);
    }, function() {
        $(this).animate({
            'opacity': '0.8'
        }, 150);
    });
    $('#totop').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 350);
    });
    /* CAPTION FADE EFFECT *****************************************************/

    /* SELECT BOX MENU */
    $(".mobile-selectbox").change(
            function() {
                window.location = $(this).find("option:selected").val();
            }
    );
    /* ADD LAST CHILD CLASS IF IE 8 *******************************************/
    if ($("html").hasClass("ie8")) {
        $('*:last-child').addClass('last-child');
        $('#sidebar #searchform #searchsubmit').val(' ');
    }




    /* STARS RATING *******************************************************/
    $('.user-rating').mousemove(function(e) {

        $jw_rating_id = $(this).find(".jw_rating_id").val();
        $jw_rating_post_id = $(this).find(".jw_rating_post_id").val();
        cookieName = "jw_user_rating_" + $jw_rating_post_id + "_" + $jw_rating_id;
        if ($.cookie(cookieName) == 1) {
            $(this).find(".rating-top-stars").removeClass("user_editable");
        }

        if ($(this).find('.rating-top-stars').hasClass("user_editable")) {

            $('.jw-rating-userrating-name').text($('.jw-rating-userrating-name').attr('data-rel') + ':');
            userRating = (e.pageX - $(this).offset().left);
            if (userRating > 77) {
                userRating = 77;
            }
            if ($('body').hasClass('rtl'))
                userRating = 77 - userRating;
            //$('#rating-top-stars').css({width:Math.round(userRating)+"px"});
            switch (true) {
                case (userRating < 7):
                    $(this).find('.rating-top-stars').css({
                        width: "0px"
                    });
                    $('.jw-rating-userrating-score').text(0);
                    $(this).find('.jw_rating_user_value').val(0);
                    break;
                case (userRating >= 7 && userRating < 15):
                    $(this).find('.rating-top-stars').css({
                        width: "9%"
                    });
                    $('.jw-rating-userrating-score').text(0.5);
                    $(this).find('.jw_rating_user_value').val(0.1);
                    break;
                case (userRating >= 15 && userRating < 22):
                    $(this).find('.rating-top-stars').css({
                        width: "20%"
                    });
                    $('.jw-rating-userrating-score').text(1);
                    $(this).find('.jw_rating_user_value').val(0.2);
                    break;
                case (userRating >= 22 && userRating < 31):
                    $(this).find('.rating-top-stars').css({
                        width: "29%"
                    });
                    $('.jw-rating-userrating-score').text(1.5);
                    $(this).find('.jw_rating_user_value').val(0.3);
                    break;
                case (userRating >= 31 && userRating < 38):
                    $(this).find('.rating-top-stars').css({
                        width: "40%"
                    });
                    $('.jw-rating-userrating-score').text(2);
                    $(this).find('.jw_rating_user_value').val(0.4);
                    break;
                case (userRating >= 38 && userRating < 46):
                    $(this).find('.rating-top-stars').css({
                        width: "49%"
                    });
                    $('.jw-rating-userrating-score').text(2.5);
                    $(this).find('.jw_rating_user_value').val(0.5);
                    break;
                case (userRating >= 46 && userRating < 53):
                    $(this).find('.rating-top-stars').css({
                        width: "60%"
                    });
                    $('.jw-rating-userrating-score').text(3);
                    $(this).find('.jw_rating_user_value').val(0.6);
                    break;
                case (userRating >= 53 && userRating < 62):
                    $(this).find('.rating-top-stars').css({
                        width: "69%"
                    });
                    $('.jw-rating-userrating-score').text(3.5);
                    $(this).find('.jw_rating_user_value').val(0.7);
                    break;
                case (userRating >= 62 && userRating < 68):
                    $(this).find('.rating-top-stars').css({
                        width: "80%"
                    });
                    $('.jw-rating-userrating-score').text(4);
                    $(this).find('.jw_rating_user_value').val(0.8);
                    break;
                case (userRating >= 68 && userRating < 75):
                    $(this).find('.rating-top-stars').css({
                        width: "89%"
                    });
                    $('.jw-rating-userrating-score').text(4.5);
                    $(this).find('.jw_rating_user_value').val(0.9);
                    break;
                case (userRating >= 75):
                    $(this).find('.rating-top-stars').css({
                        width: "100%"
                    });
                    $('.jw-rating-userrating-score').text(5);
                    $(this).find('.jw_rating_user_value').val(1);
                    break;
            }
        }
    });
    $('.jw-rating-area-percent-user-rating').find('.user-rating').mouseleave(function() {
        ratingScore = Math.round($(this).find(".jw_rating_value").val() * 100);
        $(this).find('.rating-top-stars').css({
            width: ratingScore + "%"
        });
        $('.jw-rating-userrating-name').text($(this).find(".jw_rating_name").val() + ":");
        if ($(this).find('.rating-top-stars').hasClass("user_editable")) {
            $('.jw-rating-userrating-score').text((Math.round(ratingScore) / 100 * 5).toFixed(1));
        }
    });
    $('.ratig-background-stars').click(function() {

        var ratingBg = $(this);
        jw_rating_id = ratingBg.find(".jw_rating_id").val();
        jw_rating_post_id = ratingBg.find(".jw_rating_post_id").val();
        var cookieName = "jw_user_rating_" + jw_rating_post_id + "_" + jw_rating_id;
        if (ratingBg.find('.rating-top-stars').hasClass("user_editable")) {
            var data = {
                postId: ratingBg.find(".jw_rating_post_id").val(),
                ratingId: ratingBg.find(".jw_rating_id").val(),
                score: ratingBg.find(".jw_rating_user_value").val()
            };
            $.post(
                    site_url + '/wp-admin/admin-ajax.php',
                    {
                        'action': 'jwrating_vote', // nebo jwrating_get
                        'data': data
                    },
            function(response) {
                var resp = jQuery.parseJSON(response);
                ratingBg.find(".jw_rating_value").val(resp.score);
                var label = $('.jw-rating-userrating-votes').attr('data-rel');
                $('.jw-rating-userrating-votes').text("(" + resp.voted + ": " + label + ")");
                $('.jw-rating-userrating-score').text(Math.round((resp.score * 100) / 2) / 10);
                ratingBg.find('.rating-top-stars').css({
                    width: Math.round(resp.score * 100) + "px"
                });
                ratingBg.find('.rating-top-stars').removeClass('user_editable');
                $.cookie(cookieName, 1, {
                    expires: 1,
                    path: '/'
                });
            });
        }
    });
    /* END STARS RATING ***************************************************/


    var jaw_dropdown = document.getElementById("cat");
    function onCatChange() {
        if (jaw_dropdown.options[jaw_dropdown.selectedIndex].value > 0) {
            /// LOCATION dodelat!!,
            //alert(site_url);

            location.href = site_url + "/?cat=" + jaw_dropdown.options[jaw_dropdown.selectedIndex].value;
        }
    }
    if (document.getElementById("cat") !== null && jaw_dropdown.length > 0) {
        jaw_dropdown.onchange = onCatChange;
    }

    /* Background banner klik *********************************************** */

    backgroundBannerWidth();
    //fullscreen
    left_offset = 20;
    if (jQuery(window).width() < 1000) {
        left_offset = 15;
    } else if (jQuery(window).width() < 1030) {
        left_offset = 10;
    } else if (jQuery(window).width() < 1263) {
        left_offset = 20;
    } else {
        left_offset = 20;
        if (jQuery('body').hasClass('wide-theme')) {
            left_offset = 50;
        }
    }
    jQuery('.row-fullwidth-item').each(function(el) {
        if (jQuery(this).hasClass('el-slider')) {
            jQuery(this).find('.jaw_slider').css("left", -jQuery("#container").offset().left - left_offset);
            jQuery(this).find('.jaw_slider_row').css("left", jQuery(window).width() / 2 - 1225);
            jQuery(this).find('.bullet_row').css("left", jQuery(window).width() / 2);
        } else {
            jQuery(this).css("left", jQuery("#container").offset().left * (-1) - left_offset);
            jQuery(this).width(jQuery(window).width() + 50);
        }

    });


// ShortCode Divider Back to Top
    $('.divider_to_top').click(function() {
        $('body,html').animate({
            scrollTop: 0
        }, 300);
        return false;
    });
    // Dropdown widget menu
    jQuery('.widget_nav_menu ul.menu > li, .jw_login_widget ul.menu > li').each(function() {
        jQuery(this).addClass('item-lvl-0');
        if (jQuery(this).find('ul.sub-menu').length !== 0) {
            jQuery(this).find('ul.sub-menu li').each(function() {
                jQuery(this).prepend('<div class="widget-menu-dropdown"><span class="icon-arrow-right-gs"></span></div>');
            });
            if (jQuery(this).hasClass('current-menu-item')) {
                jQuery(this).find('ul.sub-menu').addClass('item-show');
                jQuery(this).prepend('<div class="widget-menu-dropdown"><span class="icon-arrow-up-gs"></span></div>');
            } else {
                jQuery(this).prepend('<div class="widget-menu-dropdown"><span class="icon-arrow-down-gs"></span></div>');
            }
        } else {
            jQuery(this).prepend('<div class="widget-menu-dropdown"><span class="icon-arrow-right-gs"></span></div>');
        }
    });
    jQuery('.widget_nav_menu .widget-menu-dropdown, .jw_login_widget .widget-menu-dropdown').click(function() {
        if (jQuery(this).parent().find('> ul.sub-menu').hasClass('item-show')) {
            jQuery(this).parent().find('> ul.sub-menu').removeClass('item-show').slideUp("slow");
            jQuery(this).find('span.icon-arrow-up-gs').removeClass('icon-arrow-up-gs').addClass('icon-arrow-down-gs');
        } else {
            jQuery(this).parent().find('> ul.sub-menu').addClass('item-show').slideDown("slow");
            jQuery(this).find('span.icon-arrow-down-gs').removeClass('icon-arrow-down-gs').addClass('icon-arrow-up-gs');
        }
    });
    jQuery('.widget_nav_menu li.item-lvl-0 > a, .jw_login_widget li.item-lvl-0 > a').hover(
            function() {
                jQuery(this).parent().addClass('active-item');
            },
            function() {
                jQuery(this).parent().removeClass('active-item');
            }
    );
    // Drop down product category
    jQuery('.widget_product_categories ul.product-categories > li').each(function() {
        jQuery(this).addClass('item-lvl-0');
        if (jQuery(this).find('ul.children').length !== 0) {
            jQuery(this).find('ul.children li').each(function() {
                jQuery(this).prepend('<div class="widget-menu-dropdown"><span class="icon-arrow-right-gs"></span></div>');
            });
            if (jQuery(this).hasClass('current-cat')) {
                jQuery(this).find('ul.children').addClass('item-show');
                jQuery(this).prepend('<div class="widget-menu-dropdown"><span class="icon-arrow-up-gs"></span></div>');
            } else {
                jQuery(this).prepend('<div class="widget-menu-dropdown"><span class="icon-arrow-down-gs"></span></div>');
            }
        } else {
            jQuery(this).prepend('<div class="widget-menu-dropdown"><span class="icon-arrow-right-gs"></span></div>');
        }
    });
    jQuery('.widget_product_categories li.item-lvl-0').hover(
            function() {
                jQuery(this).addClass('active-item');
            },
            function() {
                jQuery(this).removeClass('active-item');
            }
    );
    jQuery('.widget_product_categories li .children').hover(
            function() {
                jQuery(this).closest('li.item-lvl-0').unbind('mouseenter').unbind('mouseleave').removeClass('active-item');
            },
            function() {
                jQuery(this).closest('li.item-lvl-0').bind({
                    mouseenter: function(e) {
                        jQuery(this).addClass('active-item');
                    },
                    mouseleave: function(e) {
                        jQuery(this).removeClass('active-item');
                    }
                }).addClass('active-item');
            }
    );
    //ONLOAD dropdownmenu
    jQuery('.widget_product_categories').each(function(e) {
        jQuery(this).find('.current-cat-parent').find('ul.children').addClass('item-show').slideDown("slow");
        jQuery(this).find('.current-cat-parent').find('span.icon-arrow-down-gs').removeClass('icon-arrow-down-gs').addClass('icon-arrow-up-gs');
    });
    jQuery('.widget_product_categories .widget-menu-dropdown').click(function() {
        if (jQuery(this).parent().find('> ul.children').hasClass('item-show')) {
            jQuery(this).parent().find('> ul.children').removeClass('item-show').slideUp("slow");
            jQuery(this).find('span.icon-arrow-up-gs').removeClass('icon-arrow-up-gs').addClass('icon-arrow-down-gs');
        } else {
            jQuery(this).parent().find('> ul.children').addClass('item-show').slideDown("slow");
            jQuery(this).find('span.icon-arrow-down-gs').removeClass('icon-arrow-down-gs').addClass('icon-arrow-up-gs');
        }
    });
    // Posts category
    jQuery('.widget_categories > ul > li').each(function() {
        jQuery(this).addClass('item-lvl-0');
        if (jQuery(this).find('ul.children').length !== 0) {
            jQuery(this).find('ul.children li').each(function() {
                jQuery(this).prepend('<div class="widget-menu-dropdown"><span class="icon-arrow-right-gs"></span></div>');
            });
            if (jQuery(this).hasClass('current-menu-item')) {
                jQuery(this).find('ul.children').addClass('item-show');
                jQuery(this).prepend('<div class="widget-menu-dropdown"><span class="icon-arrow-up-gs"></span></div>');
            } else {
                jQuery(this).prepend('<div class="widget-menu-dropdown"><span class="icon-arrow-down-gs"></span></div>');
            }
        } else {
            jQuery(this).prepend('<div class="widget-menu-dropdown"><span class="icon-arrow-right-gs"></span></div>');
        }
    });
    jQuery('.widget_categories .widget-menu-dropdown').click(function() {
        if (jQuery(this).parent().find('> ul.children').hasClass('item-show')) {
            jQuery(this).parent().find('> ul.children').removeClass('item-show').slideUp("slow");
            jQuery(this).find('span.icon-arrow-up-gs').removeClass('icon-arrow-up-gs').addClass('icon-arrow-down-gs');
        } else {
            jQuery(this).parent().find('> ul.children').addClass('item-show').slideDown("slow");
            jQuery(this).find('span.icon-arrow-down-gs').removeClass('icon-arrow-down-gs').addClass('icon-arrow-up-gs');
        }
    });
    jQuery('.widget_categories li.item-lvl-0').hover(
            function() {
                jQuery(this).addClass('active-item');
            },
            function() {
                jQuery(this).removeClass('active-item');
            }
    );
    jQuery('.widget_categories li .children').hover(
            function() {
                jQuery(this).closest('li.item-lvl-0').unbind('mouseenter').unbind('mouseleave').removeClass('active-item');
            },
            function() {
                jQuery(this).closest('li.item-lvl-0').bind({
                    mouseenter: function(e) {
                        jQuery(this).addClass('active-item');
                    },
                    mouseleave: function(e) {
                        jQuery(this).removeClass('active-item');
                    }
                }).addClass('active-item');
            }
    );
    jQuery('.widget_nav_menu .widget-menu-dropdown, .widget_product_categories .widget-menu-dropdown, .widget_categories ul li.item-lvl-0 > .widget-menu-dropdown').hover(
            function() {
                jQuery(this).parent().addClass('active-item');
            },
            function() {
                jQuery(this).parent().removeClass('active-item');
            }
    );
    if (mobile) {
        jQuery.each(jQuery('.paralax'), function() {
            jQuery(this).find('.fullwidth-block').css('background-attachment', 'scroll');
            jQuery(this).find('.fullwidth-block').css('margin-left', '-65px');
            jQuery(this).find('.fullwidth-block').css('margin-right', '-50px');
            jQuery(this).find('.fullwidth-block').css('padding-left', '65px');
            jQuery(this).find('.fullwidth-block').css('padding-right', '50px');
            jQuery(this).addClass('static');
        });

    } else {
        jQuery.each(jQuery('.paralax.dynamic'), function() {
            var scrolled = jQuery(window).scrollTop() - jQuery(this).offset().top;
            jQuery(this).find('.row').css('background-position', '50% ' + (-(scrolled * 0.5)) + 'px');
        });

    }
    jQuery('.js-paralax_video').jawParalaxVideo({mobile: mobile});


//LAZYLOAD images
    $("img.lazy").lazyload({event: 'show_lazy'});
    //Images
    $('.builder-img').find('img.lazy').trigger('show_lazy');
    //Image in big blog
    $('.content-big .box').find('img.lazy').lazyload();
    //Trigger for gallery
    $(document).on("slid", function(event) {
        $(event.target).find('.active').find('img.lazy').trigger('show_lazy');
        $(event.target).find('.content-big.format-gallery').find('img.lazy').trigger('show_lazy');
    });
    $("#skyscrapper-left").css({
        "left": (jQuery('#container').offset().left - jQuery("#skyscrapper-left").width() - 7) + "px",
        "top": jQuery('#header').height() + 'px'
    });
    $("#skyscrapper-right").css({
        "right": (jQuery('#container').offset().left - jQuery("#skyscrapper-right").width() - 7) + "px",
        "top": jQuery('#header').height() + 'px'
    });
    if (jQuery('.row-menu-bar-fixed').length) {

        offset = jQuery(window).scrollTop();
        offsetTopBar = jQuery('#template-box').offset().top;
        topBarHeight = jQuery('.page-top').outerHeight();
        if (jQuery('.topbar-fixed').length) {
            jQuery('.body-big-menu.body-fix-menu #template-box').css({
                marginTop: (jQuery('.big-menu.main-menu').outerHeight()) - 2 + topBarHeight + 'px'
            });
        } else {
            jQuery('.body-big-menu.body-fix-menu #template-box').css({
                marginTop: (jQuery('.big-menu.main-menu').outerHeight()) - 2 + 'px'
            });
        }

//menuHeaderBars();
        offsetMenuBar = jQuery('.row-menu-bar-fixed').offset().top;
        jQuery(window).scrollTop(0);
        topBarHeight = jQuery('.page-top').outerHeight();
        if (jQuery('.admin-bar').length) {
            jQuery('.big-menu.row-menu-bar-fixed-on').css({
                top: topBarHeight + jQuery('#wpadminbar').height() - 1 + 'px'
            });
        } else {
            jQuery('.big-menu.row-menu-bar-fixed-on').css({
                top: topBarHeight + 'px'
            });
        }
    }

    jQuery('ul.top-nav-mobile li.jaw-menu-item-depth-0.has-dropdown > a .jaw-menu-icon').click(function() {

        var parent = jQuery(this).parent().parent();
        if (parent.hasClass('jaw-active-item')) {
            parent.removeClass('jaw-active-item');
        } else {
            parent.addClass('jaw-active-item');
        }


        return false;
    });
    if (jQuery('.search .search-product').length > 0) {
        if (jQuery('.search .search-product').hasClass('.active')) {
            jQuery('.woo-sort-cat-form').show();
        } else {
            jQuery('.woo-sort-cat-form').hide();
        }
    }


// **** PRETTYPHOTO**************************
    $("a[rel^='prettyPhoto'], a[data-rel^='prettyPhoto'] ").prettyPhoto({
        social_tools: false,
        default_width: 800,
        default_height: 500,
        show_title: false
    });
});
//DOCUMENT ready  =  END  =====================================================



jQuery(window).load(function() {
    jQuery(document).ready(function($) {

// selectric - pro hezci selecty
        jQuery('select').not('.mobile-selectbox').not('.country_to_state').not('#calc_shipping_state').not('#billing_state').not('#shipping_state').not('#wc_product_finder select').selectric();
        //pri kliku na clear selection na woocommerce
        jQuery('.variations_form').bind('woocommerce_update_variation_values', function() {
            jQuery('select').selectric('refresh');
        });

        
        var sortAscending = false;
        var sortName = 'date';
        var transformsEnabled = false;
        var animationEngine = 'css';
        //Když je IE 8 nebo RTL     -  $.cookie("rtl_support")  - pro panel
        if ($.browser.msie === true && parseInt($.browser.version, 10) === 8 && $.cookie("rtl_support") != '1') {
            transformsEnabled = false;
            animationEngine = 'css';
        } else if (rtl == '1' || $.cookie("rtl_support") == '1') {
            transformsEnabled = false;
            animationEngine = 'best-available';
        } else {
            transformsEnabled = true;
            animationEngine = 'jquery';
        }

        jQuery('.video').each(function() {
            jQuery(this).height(jQuery(this).width() / 1.78);
        });
        $('.elements_iso').each(function(key, el) {
            $(el).isotope({
                animationEngine: animationEngine,
                transformsEnabled: transformsEnabled,
                itemSelector: '.element',
                getSortData: {
                    name: function($elem) {
                        return $elem.attr('sort_name');
                    },
                    date: function($elem) {
                        return $elem.attr('sort_date');
                    },
                    rating: function($elem) {
                        return parseFloat($elem.attr('sort_rating'));
                    },
                    popular: function($elem) {
                        return parseFloat($elem.attr('sort_popular'));
                    },
                    price: function($elem) {
                        return parseFloat($elem.attr('sort_price'));
                    },
                    sales: function($elem) {
                        return parseFloat($elem.attr('sort_sales'));
                    },
                    category: function($elem) {
                        return $elem.attr('sort_category');
                    }}
            },
            function() {
                isotope_init = true;
                //Pri nacteni stranky se ykontroluje vyska vsech stranek v caruselu a vsem se nastavi stejna -> aby to neskakalo
                jQuery('.carousel').find('.carousel-inner').removeClass('carousel-initialized'); // Safari fix
                setTimeout(function() {
                    $(el).parents('.carousel').each(function(key, element) {
                        var max_height_carousel = 0;
                        jQuery(element).find('.item').each(function(k, item) {
                            var el_height = jQuery(item).height();
                            if (max_height_carousel < el_height) {
                                max_height_carousel = el_height;
                            }
                        });
                        jQuery(element).find('.item').height(max_height_carousel);
                        jQuery(element).find('.carousel-inner').height(max_height_carousel);
                    });
                    $(el).isotope('reLayout', function() {
                        jQuery('.carousel').find('.carousel-inner').addClass('carousel-initialized'); // Safari fix
                    });
                }, 1000);
            });
        });
        // ========= INFINITY LIST ===========================================
        var count_page = 0;
        var num_page_on_page = 2; // <<--- Nuber of ajax section on page
        if (typeof infinite_scroll != 'undefined') {

            $.each(infinite_scroll, function(i, in_sc) {

                $(in_sc.contentSelector).infinitescroll(in_sc, function(newElements) {

                    $(this).isotope("appended", $(newElements)); //>>>>> Speed gallery slider (on the main page) for next pages in infinite list<<<<<
                    $('#infinite_load_' + in_sc.id + ' .morebutton').show();
                    if (in_sc.type == 'ajax') {
                        count_page++;
                        if (count_page >= (num_page_on_page - 1)) {
                            $(in_sc.contentSelector).infinitescroll({
                                state: {
                                    isDone: true
                                }
                            });
                            $("#infinite_load_" + in_sc.id).append(window.next_page);
                            $("#infinite_load_" + in_sc.id).append($('#infinite_load_' + in_sc.id + ' #post-nav-infinite .post-next-infinite').html());
                        }
                    }

                    jQuery("a[rel^='prettyPhoto'], a[data-rel^='prettyPhoto'] ").prettyPhoto({
                        social_tools: false,
                        default_width: 800,
                        default_height: 500,
                        show_title: false
                    });
                    jQuery('.content-big .box').find('img.lazy').lazyload();
                    setTimeout(function() {
                        jQuery('.carousel').find('.carousel-inner').removeClass('carousel-initialized'); // Safari fix
                        $(newElements).parent().isotope('reLayout', function() {
                            jQuery('.carousel').find('.carousel-inner').addClass('carousel-initialized'); // Safari fix
                        });
                    }, 500);
                });
                if (in_sc.type == 'infinitemore') {
                    $('#infinite_load_' + in_sc.id + ' #post-nav-infinite').hide();
                    $("#infinite_load_" + in_sc.id).append(more);
                    $(in_sc.contentSelector).infinitescroll('pause');
                    $('#infinite_load_' + in_sc.id + ' .morebutton').click(function() {
                        $(in_sc.contentSelector).infinitescroll('retrieve');
                        $('#infinite_load_' + in_sc.id + ' .morebutton').hide();
                    });
                } else if (in_sc.type == 'infinite') {
                    $('#infinite_load_' + in_sc.id + ' #post-nav-infinite').hide();
                }
            });
        }


//po nacteni revslideru
        jQuery('.rev_slider').bind('revolution.slide.onloaded', function() {
            setTimeout(function() {
                jQuery('.elements_iso').each(function(key, el) {
                    jQuery('.carousel').find('.carousel-inner').removeClass('carousel-initialized'); // Safari fix
                    jQuery(el).isotope('reLayout', function() {
                        jQuery('.carousel').find('.carousel-inner').addClass('carousel-initialized'); // Safari fix
                    });
                });
            }, 500);
        });
    });
});
function backgroundBannerWidth() {
    var offset_left = 0;
    if (jQuery('.container').offset() !== undefined) {
        offset_left = jQuery('.container').offset().left;
    } else {
        offset_left = 0;
    }
    var banner_left_width = jQuery('.background_banner_link.left').width();
    var banner_right_width = jQuery('.background_banner_link.right').width();
    if (banner_left_width > 0) {
        jQuery('.background_banner_link.left').css({
            left: (offset_left - banner_left_width) + 'px',
            height: '100%'
        });
    } else {
        jQuery('.background_banner_link.left').css({
            width: offset_left + 'px',
            height: '100%'
        });
    }

    if (banner_right_width > 0) {
        jQuery('.background_banner_link.right').css({
            right: (offset_left - banner_right_width) + 'px',
            height: '100%'
        });
    } else {
        jQuery('.background_banner_link.right').css({width: offset_left + 'px',
            height: '100%'
        });
    }
}

/* =============== GOOD STORE ================== 
 * =========================*/

// Window scrolling functions 
jQuery(window).scroll(function() {

    menuHeaderBars();
    if (!mobile) {
        jQuery.each(jQuery('.paralax.dynamic'), function() {
            var scrolled = jQuery(window).scrollTop() - jQuery(this).offset().top;
            jQuery(this).find('.row').css('background-position', '50% ' + (-(scrolled * 0.5)) + 'px');
        });

    }

});
// Funcke urcuje pozici menu, pokud je zapnuto ze ma byt menu fixni.
function menuHeaderBars() {

    topBarHeight = jQuery('.page-top').outerHeight();
    if (jQuery('.row-menu-bar-fixed').length && !jQuery('.body-big-menu').length) {

        offset = jQuery(window).scrollTop();
        offsetTopBar = jQuery('#template-box').offset().top;
        if (offset < offsetMenuBar) {
            jQuery('.row-menu-bar-fixed').removeClass('row-menu-bar-fixed-on');
            jQuery('.row-menu-bar-fixed').css({
                top: 0 + 'px'
            });
        } else {
            jQuery('.row-menu-bar-fixed').addClass('row-menu-bar-fixed-on');
            if (jQuery('.topbar-fixed').length) {
                jQuery('.row-menu-bar-fixed').css({top: offsetTopBar + 'px'
                });
            } else {
                jQuery('.row-menu-bar-fixed').css({
                    top: offsetTopBar - topBarHeight + 'px'
                });
            }
        }
    } else {

        offset = jQuery(window).scrollTop();
        if (offset < topBarHeight) {
            if (jQuery('.topbar-fixed').length) {
                jQuery('.big-menu.row-menu-bar-fixed-on').css({
                    top: offsetTopBar + 'px'
                });
            } else {
                jQuery('.big-menu.row-menu-bar-fixed-on').css({
                    top: topBarHeight + 'px'
                });
            }
        } else {
            if (jQuery('.topbar-fixed').length) {
                jQuery('.big-menu.row-menu-bar-fixed-on').css({
                    top: offsetTopBar + 'px'
                });
            } else {
                jQuery('.big-menu.row-menu-bar-fixed-on').css({
                    top: 0 + 'px'
                });
            }
        }
    }
}

jQuery('.search .nav.nav-tabs li').click(function() {
    if (jQuery(this).hasClass('search-product')) {
        jQuery('.woo-sort-cat-form').show();
    } else {
        jQuery('.woo-sort-cat-form').hide();
    }
});
//WISHLIST - ajax
jQuery('body').on('added_to_wishlist', function() {

    var data = {'tmpl': 'wishlist', 'dir': ['header', 'top_bar']};
    jQuery.post(site_url + '/wp-admin/admin-ajax.php',
            {
                'action': 'get_template_part',
                'data': data
            },
    function(response) {
        if (response && response != '0') {
            jQuery('.wishlist-contents').html(response);
        }
    });
});
jQuery(window).resize(function($) {

//BACKGROUND BANNER
    backgroundBannerWidth();
    //fullscreen
    if (jQuery(window).width() < 1000) {
        left_offset = 15;
    } else if (jQuery(window).width() < 1030) {
        left_offset = 10;
    } else if (jQuery(window).width() < 1263) {
        left_offset = 20;
    } else {
        left_offset = 20;
        if (jQuery('body').hasClass('wide-theme')) {
            left_offset = 50;
        }
    }
    jQuery('.row-fullwidth-item').each(function(el) {
        if (jQuery(this).hasClass('el-slider')) {
            jQuery(this).find('.jaw_slider').css("left", -jQuery("#container").offset().left - left_offset);
            jQuery(this).find('.jaw_slider_row').css("left", jQuery(window).width() / 2 - 1225);
            jQuery(this).find('.bullet_row').css("left", jQuery(window).width() / 2);
        } else {
            jQuery(this).css("left", jQuery("#container").offset().left * (-1) - left_offset);
            jQuery(this).width(jQuery(window).width() + 50);
        }

    });
    //Jaw SLIDER pri resiznutí okna - otočení tabletu
    if (!first && jQuery(window).width() < 1000 && window_width >= 1263 && window_width > 0) {
        window_width = jQuery(window).width();
        jQuery('.jaw_slider_row').animate({left: '-=' + 215 + 'px'}, 500, 'easeInOutQuint');
    }
    if (!first && jQuery(window).width() >= 1263 && window_width < 1000 && window_width > 0) {
        window_width = jQuery(window).width();
        jQuery('.jaw_slider_row').animate({left: '+=' + 215 + 'px'}, 500, 'easeInOutQuint');
    }

    if (!first && jQuery(window).width() < 1000 && window_width >= 1000 && window_width > 0) {
        window_width = jQuery(window).width();
        jQuery('.jaw_slider_row').animate({left: '-=' + 111 + 'px'}, 500, 'easeInOutQuint');
    }
    if (!first && jQuery(window).width() >= 1000 && window_width < 1000 && window_width > 0) {
        window_width = jQuery(window).width();
        jQuery('.jaw_slider_row').animate({left: '+=' + 111 + 'px'}, 500, 'easeInOutQuint');
    }

    if (!first && jQuery(window).width() < 1263 && window_width >= 1263 && window_width > 0) {
        window_width = jQuery(window).width();
        jQuery('.jaw_slider_row').animate({left: '-=' + 104 + 'px'}, 500, 'easeInOutQuint');
    }
    if (!first && jQuery(window).width() >= 1263 && window_width < 1263 && window_width > 0) {
        window_width = jQuery(window).width();
        jQuery('.jaw_slider_row').animate({left: '+=' + 104 + 'px'}, 500, 'easeInOutQuint');
    }

    window_width = jQuery(window).width();
    //ISOTOPE-resize
    jQuery('.elements_iso').each(function(key, el) {
        jQuery('.carousel').find('.carousel-inner').removeClass('carousel-initialized'); // Safari fix
        if (isotope_init) {
            jQuery(el).isotope('reLayout', function() { // pri zmene velikosti okna reLayoutujeme vsechny isotopy
// a v callbacku (po preskladani) zmerime opet vysku vsech carouselu
                setTimeout(function() {



                    jQuery(el).parents('.carousel').each(function(key, element) {
                        var max_height_carousel = 0;
                        jQuery(element).find('.item').each(function(k, el) {
                            var el_height = jQuery(element).find('.carousel-caption').height();
                            if (max_height_carousel < el_height) {
                                max_height_carousel = el_height;
                            }

                        });
                        jQuery(element).find('.item').height(max_height_carousel);
                        jQuery(element).find('.carousel-inner').height(max_height_carousel);
                        jQuery('.carousel').find('.carousel-inner').addClass('carousel-initialized'); // Safari fix
                    });
                }, 500);
            });
        }
    });
    jQuery("#skyscrapper-left").css({
        "left": (jQuery('#container').offset().left - jQuery("#skyscrapper-left").width() - 15) + "px"
    });
    jQuery("#skyscrapper-right").css({
        "right": (jQuery('#container').offset().left - jQuery("#skyscrapper-right").width() - 15) + "px"
    });
    //Velikost videa
    jQuery('.video').each(function() {
        jQuery(this).height(jQuery(this).width() / 1.78);
    });
});
//scrool animation 
(function($) {
    'use strict';
    $.fn.jawScroolAnimation = function(options) {
        var defaults = {
            animation: 'slide',
            animationSpeed: 1000,
            animationDirection: 'left',
            animationEasing: 'swing'
        };
        options = $.extend({}, defaults, options);
        return this.each(function(key, el) {
            $(el).contents().hide();
            var checkStartAnimation = function() {
                var bottom_of_window = $(window).scrollTop() + $(window).height();
                var bottom_of_object = $(el).offset().top;
                if (bottom_of_window > bottom_of_object) {
                    return true;
                }
                return false;
            };
            var jawAnimationHandler = function() {
                if (checkStartAnimation()) {
                    $(el).contents().show(options.animation, {
                        direction: options.animationDirection,
                        easing: options.animationEasing
                    }, options.animationSpeed, function() {
                        $(window).off("scroll", jawAnimationHandler);
                    });
                }
            };
            jawAnimationHandler();
            $(window).scroll(jawAnimationHandler);
        });
    };
})(jQuery);
//JAW-SLIDER
(function($) {

    'use_strict';
    /**      * JaW Slider
     * @param {type} options
     */
    $.fn.jawSlider = function(options) {

        var defaults = {
            animationSpeed: 1500,
            animationDelay: '3000',
            animationStep: 489,
            animationDirection: 'left'
        };
        options = $.extend({}, defaults, options);
        var $slider = this;
        var timeout;
        var click_active = true;
        var mouseout = true;
        var show_info = function(id) {
            $slider.find('.jaw_one_slide').eq(id).find('.jaw_content').animate({bottom: '-185px'}, options.animationSpeed);
            $slider.find('.jaw_one_slide').eq(id + 1).find('.jaw_content').animate({bottom: '0'}, options.animationSpeed);
            $slider.find('.jaw_one_slide').removeClass('prev active next');
            $slider.find('.jaw_one_slide').eq(1).addClass('prev');
            $slider.find('.jaw_one_slide').eq(2).addClass('active');
            $slider.find('.jaw_one_slide').eq(3).addClass('next');
            $slider.find('.bullet').eq(0).find('i').removeClass('icon-radio-unchecked');
            $slider.find('.bullet').eq(0).find('i').addClass('icon-circle2');
        };
        var slide = function(length, direction) {
            var i = 0;
            if (click_active) {
                click_active = false;
                if (length === undefined) {
                    length = 1;
                }

                if (direction === undefined) {
                    direction = options.animationDirection;
                }

                first = false;
                if (direction == 'left') {

                    for (i = 0; i < length; i++) {
                        $slider.find('.jaw_slider_row').append($slider.find('.jaw_one_slide').eq(i).clone());
                    }

                    $slider.find('.jaw_one_slide').find('.jaw_content').animate({bottom: '-185px'}, options.animationSpeed);
                    $slider.find('.jaw_slider_row').animate({left: '-=' + options.animationStep * length + 'px'}, options.animationSpeed, 'easeInOutQuint', function() {

                        clearTimeout(timeout);
                        $slider.find('.jaw_slider_row').css('left', '+=' + options.animationStep * length + 'px');
                        for (i = 0; i < length; i++) {
                            $slider.find('.jaw_one_slide').first().remove();
                        }
                        $slider.find('.jaw_one_slide').eq(2).find('.jaw_content').animate({bottom: '0'}, options.animationSpeed);
                        $slider.find('.jaw_one_slide').removeClass('prev active next');
                        $slider.find('.jaw_one_slide').eq(1).addClass('prev');
                        $slider.find('.jaw_one_slide').eq(2).addClass('active');
                        $slider.find('.jaw_one_slide').eq(3).addClass('next');
                        $slider.find('.bullet i').removeClass('icon-circle2');
                        $slider.find('.bullet i').addClass('icon-radio-unchecked');
                        $slider.find('.bullet').eq(Number($slider.find('.jaw_one_slide').eq(2).attr('data-sld'))).find('i').removeClass('icon-radio-unchecked');
                        $slider.find('.bullet').eq(Number($slider.find('.jaw_one_slide').eq(2).attr('data-sld'))).find('i').addClass('icon-circle2');
                        if (mouseout) {
                            timeout = setTimeout(slide, options.animationDelay);
                        }
                        jQuery('.row-fullwidth-item').find('.jaw_slider_row').css("left", jQuery(window).width() / 2 - 1225);
                        click_active = true;
                        //  });
                    });
                } else {

                    for (i = $slider.find('.jaw_one_slide').length - 1; i > $slider.find('.jaw_one_slide').length - 1 - length; i--) {
                        $slider.find('.jaw_slider_row').prepend($slider.find('.jaw_one_slide').eq(i).clone());
                    }

                    $slider.find('.jaw_one_slide').find('.jaw_content').animate({bottom: '-185px'}, options.animationSpeed);
                    $slider.find('.jaw_slider_row').css('left', '-=' + options.animationStep * length + 'px');
                    $slider.find('.jaw_slider_row').animate({left: '+=' + options.animationStep * length + 'px'}, options.animationSpeed, 'easeInOutQuint', function() {

                        clearTimeout(timeout);
                        for (i = 0; i < length; i++) {
                            $slider.find('.jaw_one_slide').last().remove();
                        }
                        $slider.find('.jaw_one_slide').eq(2).find('.jaw_content').animate({bottom: '0'}, options.animationSpeed);
                        $slider.find('.jaw_one_slide').removeClass('prev active next');
                        $slider.find('.jaw_one_slide').eq(1).addClass('prev');
                        $slider.find('.jaw_one_slide').eq(2).addClass('active');
                        $slider.find('.jaw_one_slide').eq(3).addClass('next');
                        $slider.find('.bullet i').removeClass('icon-circle2');
                        $slider.find('.bullet i').addClass('icon-radio-unchecked');
                        $slider.find('.bullet').eq(Number($slider.find('.jaw_one_slide').eq(2).attr('data-sld'))).find('i').removeClass('icon-radio-unchecked');
                        $slider.find('.bullet').eq(Number($slider.find('.jaw_one_slide').eq(2).attr('data-sld'))).find('i').addClass('icon-circle2');
                        if (mouseout) {
                            timeout = setTimeout(slide, options.animationDelay);
                        }
                        jQuery('.row-fullwidth-item').find('.jaw_slider_row').css("left", jQuery(window).width() / 2 - 1225);
                        click_active = true;
                    });
                }
            }
        };
        var init = function() {
            $slider.show();
            show_info(1);
            timeout = setTimeout(slide, options.animationDelay);
        };
        init();
        //po najeti zastavit animaci
        $slider.mouseenter(function() {
            clearTimeout(timeout);
            mouseout = false;
        });
        $slider.mouseleave(function() {
            mouseout = true;
            timeout = setTimeout(slide, options.animationDelay);
        });
        /********************************** UI **********************************/

        //odsazení navigacnich sipek
        $slider.find('.bullet_row').css('margin-left', -$slider.find('.bull').length * 10);
        //Kliknutí na navigační sipky
        $slider.find('.bull').on('click', function() {
            clearTimeout(timeout);
            if (jQuery(this).attr('data-sld') === undefined) {
                if (jQuery(this).attr('data-direction') == 'left') {
                    slide(1);
                } else {
                    slide(1, 'right');
                }
            } else {
                if (jQuery(this).attr('data-sld') != $slider.find('.jaw_one_slide').eq(2).attr('data-sld')) {
                    var cross_zero = 0;
                    if (jQuery(this).attr('data-sld') < $slider.find('.jaw_one_slide').eq(2).attr('data-sld')) {
                        cross_zero = 1;
                    }
                    var calltime = cross_zero * ($slider.find('.jaw_one_slide').length) - Number($slider.find('.jaw_one_slide').eq(2).attr('data-sld')) + Number(jQuery(this).attr('data-sld'));
                    slide(calltime);
                }
            }
        });
        //Kliknutí na OBRAZKY - pretočení nebo odkaz
        $slider.find('.jaw_one_slide').on('click', function() {

            if (jQuery(this).hasClass('prev')) {
                slide(1, 'right');
            } else if (jQuery(this).hasClass('next')) {
                slide(1, 'left');
            } else if (jQuery(this).hasClass('active')) {
                window.location.href = jQuery(this).attr('data-link');
            }
        });
    };
})(jQuery);





//PARALAX VIDEO
(function($, window) {


    $.fn.jawParalaxVideo = function(options) {
        var defaults = {
            mobile: false
        };
        options = $.extend({}, defaults, options);
        var $video = this;
        var position = function($element, mobile) {
            if (mobile) {
                $element.css('top', (-($element.height() - $element.parent().height()) / 2) + 'px');
            } else {
                var scrolled = ($element.parent().height() - $element.height()) / jQuery(window).height() * (jQuery(window).scrollTop() - $element.parent().offset().top - 700);
                $element.css('top', (-(scrolled * 0.5)) + 'px');
            }
        }




        $video.show();

        $.each($video, function(el) {
            position($(this), options.mobile);
        });

        // barvu pozadi nacist az po posunuti divu s videem aby tam nebyl videt ten skok
        $video.parent().css('background-color', $video.parent().attr('data-color'));
        $video.parent().css('background-image', 'url(\'' + $video.parent().attr('data-image') + '\')');
        //showuju pattern az po nastaveni pozice - ze stejnyho duvodu jako pozadi
        $video.parent().find('.block-pattern').show();

        if (options.mobile == 'mobile') { //pokud sem na telefonu tak video oddelam.
            $video.remove();
        }



        return(function(mobile) {
            $(window).scroll(function() {
                $.each($video, function(el) {
                    position($(this), mobile);
                });
            });
        })(options.mobile);

    }

})(jQuery, window);