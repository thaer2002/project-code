<script>
                var customLabel = {
                    A: {
                        label: 'L'

                    },

                };

                function initMap(latv=31.51299585745468, lngv=36.079101562, zoomv=8) {
                    latv=parseFloat(latv);
                    lngv=parseFloat(lngv);
                    var map = new google.maps.Map(document.getElementById('map'), {
                        center: new google.maps.LatLng(latv, lngv),
                        zoom: zoomv,
                        mapTypeId: google.maps.MapTypeId.HYBRID
                    });
                    var infoWindow = new google.maps.InfoWindow;
                    // Change this depending on the name of your PHP or XML file
                    downloadUrl('https://storage.googleapis.com/mapsdevsite/json/mapmarkers2.xml', function(data) {
                        var xml = data.responseXML;
                        var markers = document.documentElement.getElementsByTagName('marker');
                        Array.prototype.forEach.call(markers, function(markerElem) {
                            var id = markerElem.getAttribute('id');
                            var name = markerElem.getAttribute('name');
                            var address = markerElem.getAttribute('address');
                            var type = markerElem.getAttribute('type');
                            var point = new google.maps.LatLng(
                                parseFloat(markerElem.getAttribute('lat')),
                                parseFloat(markerElem.getAttribute('lng')));

                            var infowincontent = document.createElement('div');

                            var strong = document.createElement('strong');
                            strong.textContent = name
                            infowincontent.appendChild(strong);
                            infowincontent.appendChild(document.createElement('br'));

                            var text = document.createElement('text');
                            text.textContent = address
                            infowincontent.appendChild(text);

                            infowincontent.appendChild(document.createElement('br'));
                            infowincontent.appendChild(document.createElement('br'));
                            var more = document.createElement('a');
                            more.textContent = "Read More"
                            more.href = "locationDetails.php?id=" + id
                            more.target = "_blank"
                            infowincontent.appendChild(more);
                            var icon = customLabel[type] || {};
                            var marker = new google.maps.Marker({
                                map: map,
                                position: point,
                                label: icon.label
                            });
                            marker.addListener('click', function() {
                                infoWindow.setContent(infowincontent);
                                infoWindow.open(map, marker);
                            });
                        });
                    });
                }

                function downloadUrl(url, callback) {
                    var request = window.ActiveXObject ?
                        new ActiveXObject('Microsoft.XMLHTTP') :
                        new XMLHttpRequest;

                    request.onreadystatechange = function() {
                        if (request.readyState == 4) {
                            request.onreadystatechange = doNothing;
                            callback(request, request.status);
                        }
                    };

                    request.open('GET', url, true);
                    request.send(null);
                }

                function doNothing() {}
            </script>
            <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEUdwvi58meB4FkdJpwQ7CfZfnA18Mcgc&loading=async&callback=initMap">
            </script>