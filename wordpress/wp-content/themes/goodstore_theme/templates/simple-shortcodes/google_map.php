<?php global $jaw_data; ?>

<?php

ob_start();
wp_register_script('g_maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDQawavpg46SmVMRFtdPl1YKzSDQc0UI6U&sensor=false', array('jquery'), false, true);
wp_enqueue_script('g_maps');

echo '<div class="row">';
echo '<div class="col-lg-'.jaw_template_get_var('box_size').'">';
echo '
        <div id="google_map_' . jaw_template_get_var('id') . '" class="google_map" style="' . jaw_template_get_var('width') . jaw_template_get_var('height') . '"></div>';
echo '</div>';
echo '</div>';
echo ' <script type="text/javascript">
        jQuery(window).load(function() {
                var location = new google.maps.LatLng(' . jaw_template_get_var('latitude') . ', ' . jaw_template_get_var('longitude') . ');
                var mapOptions = {
                  center: location,
                  zoom: ' . jaw_template_get_var('zoom') . ',
                  panControl: ' . jaw_template_get_var('controls') . ',
                  zoomControl: ' . jaw_template_get_var('controls') . ',
                  zoomControlOptions: {
                      style: google.maps.ZoomControlStyle.SMALL,
                      position: google.maps.ControlPosition.TOP_LEFT
                  },

                   mapTypeControl: ' . jaw_template_get_var('controls') . ',
                   mapTypeControlOptions: {
                      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
                      position: google.maps.ControlPosition.TOP_RIGHT

                   },
                   scaleControl: false,
                   streetViewControl: false,
                   overviewMapControl: false,
                   draggable: ' . jaw_template_get_var('dragable') . ',
                   disableDoubleClickZoom: ' . jaw_template_get_var('disabledoubleclickzoom') . ',
                   scrollwheel: ' . jaw_template_get_var('scrollwheel') . ',
                   mapTypeId: google.maps.MapTypeId.' . jaw_template_get_var('maptype') . '
                };
                





                var map = new google.maps.Map(document.getElementById("google_map_' . jaw_template_get_var('id') . '"), mapOptions);';

if (jaw_template_get_var('marker')) {
    echo '
                        var contentString = ' . json_encode(jaw_template_get_var('description')) . ';

                        var infowindow = new google.maps.InfoWindow({
                            content: contentString
                        });
                        var marker = new google.maps.Marker({   
                                                                position: location,
                                                                map: map
                                                          });';

    if (jaw_template_get_var('description', '') != '') {
        if (jaw_template_get_var('description_open', 'start') == 'start') {
            echo 'infowindow.open(map,marker);';
        }
        echo ' 
                                google.maps.event.addListener(marker, "click", function() {
                                                        infowindow.open(map,marker);
                                    });';
    }
}


echo '});
                </script>';

echo ob_get_clean();
