
jQuery(document).ready(function($) {

    /** Aquagraphite Slider MOD */

    //Hide (Collapse) the toggle containers on load
    $(".slide_body").hide();

    //Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
    $(".tab_edit_button").live('click', function() {
        $(this).parent().toggleClass("active").next().slideToggle("fast");
        return false; //Prevent the browser jump to the link anchor
    });

    // Update slide title upon typing		
    function update_slider_title(e) {
        var element = e;
        if (this.timer) {
            clearTimeout(element.timer);
        }
        this.timer = setTimeout(function() {
            $(element).parent().prev().find('strong').text(element.value);
        }, 100);
        return true;
    }

    $('.of-slider-title').live('keyup', function() {
        update_slider_title(this);
    });


    //Remove individual slide
    $('.tab_delete_button').live('click', function() {
        // event.preventDefault();
        var agree = confirm("Are you sure you wish to delete this slide?");
        if (agree) {
            var $trash = $(this).parents('li');
            //$trash.slideUp('slow', function(){ $trash.remove(); }); //chrome + confirm bug made slideUp not working...
            $trash.animate({
                opacity: 0.25,
                height: 0
            }, 500, function() {
                $(this).remove();
            });
            return false; //Prevent the browser jump to the link anchor
        } else {
            return false;
        }
    });



    var _TBwindow = $('#TB_window');
    _TBwindow.css('margin-left', 'auto');


    //Add new slide
    $(".tab_add_button").live('click', function() {
        var slidesContainer = $(this).prev();
        var sliderId = slidesContainer.attr('id');
        var sliderInt = $('#' + sliderId).attr('rel');

        var numArr = $('#' + sliderId + ' li').find('.order').map(function() {
            var str = this.id;
            str = str.replace(/\D/g, '');
            str = parseFloat(str);
            return str;
        }).get();

        var maxNum = Math.max.apply(Math, numArr);
        if (maxNum < 1) {
            maxNum = 0;
        }
        var newNum = maxNum + 1;

        var newSlide = '<li class="temphide"><div class="slide_header"><strong>Slide ' + newNum + '</strong>' +
                '<input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '">' +
                '<a class="tab_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Title</label><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value="">' +
                '<label>Description (optional)</label><textarea class="slide of-input" name="' + sliderId + '[' + newNum + '][description]" id="' + sliderId + '_' + newNum + '_slide_description" cols="8" rows="8"></textarea><a class="tab_delete_button" href="#">Delete</a><div class="clear"></div></div></li>';

        slidesContainer.append(newSlide);
        $('.temphide').fadeIn('fast', function() {
            $(this).removeClass('temphide');
        });


        return false; //prevent jumps, as always..
    });



    //hides warning if js is enabled			
    $('#js-warning').hide();


});