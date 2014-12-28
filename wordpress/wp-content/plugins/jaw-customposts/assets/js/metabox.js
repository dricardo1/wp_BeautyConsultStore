var custom_post_admin = angular.module('customPostAdmin', ['jaw.gallerypicker', 'jaw.simplemediapicker']);


var customPostAdmin = function($scope) {

    $scope.edit = $scope.edit || new Object();

    $scope.init_edit = function(id, std) {
 
        if ($scope.edit[id] == undefined) {
            $scope.edit[id] = std;
        }

    }

    $scope.json_decode = function(json_str) {

        var decode = json_str.replace(/\'/ig, '\"');
        var ret = '';
        if (decode != '') {
            ret = JSON.parse(decode);
        }
        return(ret);

    }

}

jQuery(document).ready(function() {

    angular.bootstrap(jQuery('#jaw_portfolio_meta_box'), ['customPostAdmin']);
    angular.bootstrap(jQuery('#jaw_team_meta_box'), ['customPostAdmin']);
    angular.bootstrap(jQuery('#jaw_testimonial_meta_box'), ['customPostAdmin']);
    angular.bootstrap(jQuery('#test'), ['customPostAdmin']);


    var portfolio_metabox = function() {
        switch(jQuery('#portfolio_type').val()){
            case 'image': jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(1).show();
                          jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(2).hide();
                          jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(3).hide();
                          jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(4).hide();
                          jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(5).hide();
                          jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(6).hide();
                          break;
            case 'gallery': jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(1).hide();
                            jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(2).show();
                            jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(3).hide();
                            jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(4).hide();
                            jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(5).hide();
                            jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(6).hide();
                            break;
            case 'video': jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(1).show();
                          jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(2).hide();
                          jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(3).show();
                          jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(4).hide();
                          jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(5).hide();
                          jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(6).hide();
                          break;
            case 'link': jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(1).show();
                         jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(2).hide();
                         jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(3).hide();
                         jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(4).show();
                         jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(5).show();
                         jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(6).hide();
                          break; 
            case 'audio': jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(1).show();
                          jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(2).hide();
                          jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(3).hide();
                          jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(4).hide();
                          jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(5).hide();
                          jQuery('#jaw_portfolio_meta_box').find('.form-table tr').eq(6).show();
                          break;   
        }
        
    };
    portfolio_metabox();
    jQuery('#portfolio_type').change(portfolio_metabox);


});

