<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Near Outlet Check</title>

        <!-- metadata -->
        <?php include '../components/metadata.html'; ?>
        
        <style>
            #map {
                height: 500px;
                width: 100%;
            }
            .search-container {
                margin: 20px;
                text-align: center;
            }
            input[type="text"] {
                width: 80%;
                padding: 10px;
                font-size: 16px;
            }
            button {
                padding: 10px;
                font-size: 16px;
                cursor: pointer;
            }
        </style>
        <script src="https://cdn.jsdelivr.net/gh/somanchiu/Keyless-Google-Maps-API@v6.8/mapsJavaScriptAPI.js"></script>
        <script>
            let map, geocoder, marker, userLocationMarker;
            
            // Coordinates of Sola Chemical branches (example, update with actual data)
            const branches = [
                { lat: 6.9271, lng: 79.8612, name: 'Sola Chemical - Colombo Branch' }, // Example
                { lat: 7.2906, lng: 80.6348, name: 'Sola Chemical - Kandy Branch' },
                { lat: 6.9273, lng: 80.4736, name: 'Sola Chemical - Galle Branch' },
                { lat: 6.9940, lng: 79.9766, name: 'Sola Chemical - Negombo Branch' },
                // Add more branches as needed
            ];

            function initMap() {
                geocoder = new google.maps.Geocoder();

                // Initialize the map with a default location (centered around Sri Lanka)
                map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 10,
                });

                // Try to get the user's current location
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function (position) {
                            const userLocation = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude,
                            };

                            // Center the map on the user's location
                            map.setCenter(userLocation);
                            map.setZoom(12);

                            // Add a marker for the user's location
                            userLocationMarker = new google.maps.Marker({
                                position: userLocation,
                                map: map,
                                title: 'Your Location',
                                icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                            });

                            // Add markers for all Sola Chemical branches
                            branches.forEach(branch => {
                                new google.maps.Marker({
                                    position: { lat: branch.lat, lng: branch.lng },
                                    map: map,
                                    title: branch.name,
                                    icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
                                });
                            });
                        },
                        function () {
                            alert('Geolocation failed or is not supported by your browser.');
                        }
                    );
                } else {
                    alert("Geolocation is not supported by this browser.");
                }
            }

            function searchLocation() {
                const address = document.getElementById("search-input").value;

                if (address) {
                    geocoder.geocode({ address: address }, function(results, status) {
                        if (status === "OK") {
                            // Center the map on the location and place a marker
                            map.setCenter(results[0].geometry.location);
                            map.setZoom(12);

                            if (marker) {
                                marker.setMap(null); // Remove existing marker
                            }

                            marker = new google.maps.Marker({
                                position: results[0].geometry.location,
                                map: map,
                                title: results[0].formatted_address,
                            });
                        } else {
                            alert("Geocode was not successful for the following reason: " + status);
                        }
                    });
                } else {
                    alert("Please enter a location.");
                }
            }
        </script>
    </head>
    <body onload="initMap()">

        <div class="search-container">
            <input id="search-input" type="text" placeholder="Enter city or place" />
            <button onclick="searchLocation()">Search</button>
        </div>

        <div id="map"></div>

    </body>
</html>
