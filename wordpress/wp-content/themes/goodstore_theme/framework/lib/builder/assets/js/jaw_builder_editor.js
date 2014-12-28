angular.module('jawEditor', ['ui.bootstrap', 'ui.sortable', 'colorpicker.module', 'jaw.gallerypicker', 'jaw.simplemediapicker']);


actual_edit = {};
var jaw_revo_editor = function($scope, $timeout) {

    $timeout(function() {
        multiselect();
    });
    $scope.radioModel = 'Middle';
    $scope.checkModel = {
        left: false,
        middle: true,
        right: false
    };
    $scope.edit = $scope.edit || {};
    $scope.options = $scope.options || {};
    //init_edit();

    $scope.add_edit = function(item) {
        if ($scope.edit[item] === undefined) {
            $scope.edit[item] = [];
        }
        if (debug) {
            console.log('add_edit -> $scope.edit[item]: ' + $scope.edit[item]);
        }
        $scope.edit[item].push(jQuery.extend({}, {}));
    };

    //DELETE 
    $scope.del_edit = function(object, ide) {
        $scope.edit[object].splice(ide, 1);
    };


    if (actual_edit !== null && actual_edit !== undefined) {
        $scope.edit = jQuery.extend(true, {}, actual_edit);
        if (debug) {
            console.log('Celková init -> edit: ');
            console.log($scope.edit);
        }
    }

    //INIT object
    $scope.init_object = function(item) {
        if ($scope.edit[item] === undefined || ($scope.edit[item].length <= 0)) {
            $scope.add_edit(item);
        }
        if (debug) {
            console.log('init_object -> item: ' + item);
        }
    };

    $scope.getColor = function(color) {
        return {
            background: color
        };
    };

    $scope.init_edit = function(id, std) {
        if (debug) {
            console.log('init_edit -> id: ' + id);
            console.log('init_edit -> edit[id]: ' + $scope.edit[id]);
            console.log('init_edit -> std: ' + std);
        }
        if ($scope.edit[id] === undefined) {
            $scope.edit[id] = std;
        }

    };


};

var editor_dialog = function($scope, $timeout, dialog) {

    jawBuilder.controller('GreetingCtrl', ['$scope', '$timeout', jaw_revo_editor($scope, $timeout)]);
    $scope.bookmarks = [];
    $timeout(function() {
        jQuery('html,body').css('cursor', 'default');
        if (jQuery('.content > .section.sub_all').length > 0) {
            jQuery.each(jQuery('.content > .section.sub_all'), function($entity) {
                $scope.bookmarks.push(jQuery(this).find('h3').html());
            });
        }
        jQuery('.jaw-editor-area').each(function() {
            init_wp_editor(jQuery(this).attr("id"));
            var ed_id = jQuery(this).attr("id");
            var editor_visual = '.tinymce-tabs .visual.' + ed_id;
            var editor_html = '.tinymce-tabs .html.' + ed_id;
            jQuery(editor_visual).addClass('active');
            jQuery(editor_html).removeClass('active');
            jQuery(editor_visual).click(function() {
                activateTinyMCETab('visual', editor_visual, editor_html, ed_id);
            });
            jQuery(editor_html).click(function() {
                activateTinyMCETab('html', editor_visual, editor_html, ed_id);
            });
        });
        jQuery('#editor_container').height(jQuery('#jaw-builder-popup').height() - 60);
        open_editor = false;
    });
    $scope.$watch('bookmarks', function() {
        setTimeout(function() {
            $scope.switch_mark(0);
        }, 100);
    });
    //Switch bookmarks
    $scope.switch_mark = function(i) {
        jQuery('.content > .section.sub_all').hide();
        jQuery('.editor_bookmarks li').removeClass('active');
        jQuery('.content > .section.sub_all').eq(i).show();
        jQuery('.editor_bookmarks li').eq(i).addClass('active');
    };

//  SAVE
    $scope.save_editor = function() {
        jQuery('.jaw-editor-area').each(function() {
            if (jaw_editor_open && window.tinyMCE.get(jQuery(this).attr('id')) !== undefined) {
                $scope.edit[jQuery(this).attr('id')] = window.tinyMCE.get(jQuery(this).attr('id')).getContent();
                cancel_wp_editor(jQuery(this).attr('id'));
            }
        });
        dialog.close($scope.edit);
        open_editor = false;
    };

//  CANCEL
    $scope.cancel_editor = function() {
        jQuery('.jaw-editor-area').each(function() {
            cancel_wp_editor(jQuery(this).attr('id'));
        });
        open_editor = false;
        dialog.close();
    };
};

var wpautop = true;
var jaw_editor_open = false;
function init_wp_editor(elementId) {
     window.tinyMCE.settings.wpautop = false;  
     //window.tinyMCE.execCommand("mceAddControl", false, elementId);
     window.tinyMCE.execCommand("mceAddEditor", false, elementId);
     tinyMCE.settings.wpautop = wpautop;    
     wpActiveEditor = elementId;
     jaw_editor_open = true;
}
function cancel_wp_editor(elementId) {

     window.tinyMCE.settings.wpautop = false;
     window.tinyMCE.execCommand("mceRemoveEditor", true, elementId);
     //window.tinyMCE.execCommand("mceAddEditor", true, elementId);
     jaw_editor_open = false;
}

jQuery(window).scroll(function() {
    if (jaw_editor_open === true) {
        jQuery('.mce-container.mce-panel.mce-floatpanel').hide();
        jQuery('.mce-btn').removeClass('mce-active');
        jQuery('.mce-btn').attr('aria-expanded', false);
    }
});

function activateTinyMCETab(selectedTab, visualTab, htmlTab, elementId) {
    if (selectedTab == 'visual') {
        init_wp_editor(elementId);
        jQuery(visualTab).addClass('active');
        jQuery(htmlTab).removeClass('active');
        jQuery('.jaw_add_media').show();
    }
    if (selectedTab == 'html') {
        cancel_wp_editor(elementId);
        jQuery(visualTab).removeClass('active');
        jQuery(htmlTab).addClass('active');
        jQuery('.jaw_add_media').hide();
    }
}


