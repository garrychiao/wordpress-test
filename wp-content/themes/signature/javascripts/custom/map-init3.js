jQuery(document).ready(function($) {
        google.maps.event.addDomListener(window, 'load', mapinit);
                
        function mapinit() {

            $('.signature-map-wrap').each(function(){
                var land_color = $(this).data('land-color');
                var water_color = $(this).data('water-color');
                var containment = $(this).data('containment');
                var lattitude = $(this).data('lattitude');
                var longitude = $(this).data('longitude');
                var marker_image = $(this).data('marker-image');


                // Basic options for a simple Google Map
                // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
                var mapOptions = {
                    // How zoomed in you want the map to start at (always required)
                    zoom: 11,
                    scrollwheel: false,
                    // The latitude and longitude to center the map (always required)
                    center: new google.maps.LatLng(lattitude, longitude), // New York

                    // How you would like to style the map. 
                    // This is where you would paste any style found on Snazzy Maps.
                    //styles: [{"stylers":[{"visibility":"simplified"}]},{"stylers":[{"color":land_color}]},{"featureType":"water","stylers":[{"color":water_color},{"lightness":7}]},{"elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"lightness":25}]},{"featureType":"transit.station","elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]}]
                    styles: [{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"hue":"#ffb300"},{"saturation":"32"},{"lightness":"0"}]},{"featureType":"landscape.natural","elementType":"all","stylers":[{"visibility":"simplified"},{"hue":"#ffb800"},{"saturation":"54"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45},{"visibility":"on"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"hue":"#ffb800"},{"saturation":"29"},{"lightness":"64"},{"gamma":"1"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#ffda7b"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#ffda7b"}]},{"featureType":"road.highway","elementType":"labels.text.stroke","stylers":[{"color":"#ffda7b"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"transit","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"saturation":"-60"},{"color":"#d5cdb6"}]}]
                };

                // Get the HTML DOM element that will contain your map 
                // We are using a div with id="map" seen below in the <body>
                var mapElement = document.getElementById(containment);

                // Create the Google Map using our element and options defined above
                var map = new google.maps.Map(mapElement, mapOptions);
                
                var markerimage = marker_image;
                
                // Let's also add a marker while we're at it
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(lattitude, longitude),
                    map: map,
                    title: '',
                    icon: markerimage
                });
            });
            
        }

});