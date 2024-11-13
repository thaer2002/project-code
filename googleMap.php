<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEUdwvi58meB4FkdJpwQ7CfZfnA18Mcgc&callback=myMap"></script>
<script>
    var map;
    var geocoder;


    function initialize() {
        var cor = document.getElementById("add_map").value;

        if (cor.length != 0) {
            cor = cor.split(",");
            latv = parseFloat( cor[0]);
            lngv = parseFloat(cor[1]);
            zoomv = 14;
            document.getElementById('lat').value = latv;
            document.getElementById('lng').value = lngv;
        } else {
            latv = 32.040797;
            lngv = 35.781378;
            zoomv = 8;
            document.getElementById('lat').value = "";
            document.getElementById('lng').value = "";
        }

        var myOptions = {
            center: new google.maps.LatLng(latv, lngv),
            zoom: zoomv,
            mapTypeId: google.maps.MapTypeId.HYBRID

        };

        geocoder = new google.maps.Geocoder();
        var map = new google.maps.Map(document.getElementById("map_canvas"),
            myOptions);
        var uluru = {
            lat: latv,
            lng: lngv
        };

        placeMarker(uluru);
        google.maps.event.addListener(map, 'click', function(event) {

            placeMarker(event.latLng);
            document.getElementById('lat').value = event.latLng.lat();
            document.getElementById('lng').value = event.latLng.lng();

            document.getElementById('add_map').value = event.latLng.lat() + ", " + event.latLng.lng();
        });

        var marker;

        function placeMarker(location) {
            if (marker) {
                marker.setPosition(location);

            } else {
                marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }


        }

    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>