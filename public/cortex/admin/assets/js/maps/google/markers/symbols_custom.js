/* ------------------------------------------------------------------------------
*
*  # Custom marker symbols
*
*  Specific JS code additions for maps_google_markers.html page
*
*  Version: 1.0
*  Latest update: Aug 1, 2015
*
* ---------------------------------------------------------------------------- */

$(function() {

    // The following example creates complex markers to indicate beaches near
    // Sydney, NSW, Australia. Note that the anchor is set to
    // (0,32) to correspond to the base of the flagpole.


    // Map settings
    function initialize(beaches) {

        // Optinos
        var mapOptions = {
            zoom: 11,
            center: new google.maps.LatLng(-33.9, 151.2)
        }

        // Apply options
        var map = new google.maps.Map($('.map-symbol-custom')[0], mapOptions);

        // Set markers
        setMarkers(map, beaches);
    }


    // Set markers
    function setMarkers(map, locations) {

        // Add markers to the map

        // Marker sizes are expressed as a Size of X,Y
        // where the origin of the image (0,0) is located
        // in the top left of the image.

        // Origins, anchor positions and coordinates of the marker
        // increase in the X direction to the right and in
        // the Y direction down.
        var image = {
            url: 'assets/images/ui/map_marker.png',

            // This marker is 20 pixels wide by 32 pixels tall.
            size: new google.maps.Size(20, 32),

            // The origin for this image is 0,0.
            origin: new google.maps.Point(0,0),

            // The anchor for this image is the base of the flagpole at 0,32.
            anchor: new google.maps.Point(0, 32)
        };


        // Shapes define the clickable region of the icon.
        // The type defines an HTML &lt;area&gt; element 'poly' which
        // traces out a polygon as a series of X,Y points. The final
        // coordinate closes the poly by connecting to the first
        // coordinate.
        var shape = {
            coords: [1, 1, 1, 20, 18, 20, 18 , 1],
            type: 'poly'
        };
        for (var i = 0; i < locations.length; i++) {
            var beach = locations[i];
            var myLatLng = new google.maps.LatLng(beach[1], beach[2]);
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                icon: image,
                shape: shape,
                title: beach[0],
                zIndex: beach[3]
            });
        }
    }
});
