<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Find Nearest Outlet - Sola Chemicals</title>

        <!-- metadata -->
        <?php include '../components/metadata.html'; ?>
        <?php 
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        require_once $_SERVER['DOCUMENT_ROOT'].'/components/home-header.php'; 
        ?>
        
        <style>
            .outlet-container {
                padding: 20px;
                max-width: 1400px;
                margin: 100px auto 20px;
            }

            .outlet-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 20px;
                margin-top: 20px;
            }

            #map {
                height: 600px;
                width: 100%;
                border-radius: 10px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }

            .branch-list {
                height: 600px;
                overflow-y: auto;
                padding: 20px;
                background: #fff;
                border-radius: 10px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }

            .branch-card {
                padding: 15px;
                margin-bottom: 15px;
                border: 1px solid #e0e0e0;
                border-radius: 8px;
                background: #fff;
                transition: all 0.3s ease;
            }

            .branch-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            }

            .branch-name {
                font-size: 1.2rem;
                font-weight: 600;
                color: #333;
                margin-bottom: 10px;
            }

            .branch-details {
                color: #666;
                margin-bottom: 15px;
            }

            .branch-address {
                display: flex;
                align-items: start;
                gap: 10px;
                margin-bottom: 8px;
            }

            .branch-phone {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .call-button {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 8px 16px;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                text-decoration: none;
                transition: background-color 0.3s;
            }

            .call-button:hover {
                background-color: #45a049;
            }

            .search-container {
                margin-bottom: 20px;
            }

            .search-box {
                display: flex;
                gap: 10px;
                max-width: 600px;
                margin: 0 auto;
            }

            .search-tabs {
                display: flex;
                justify-content: center;
                gap: 10px;
                margin-bottom: 15px;
            }

            .search-tab {
                padding: 8px 16px;
                background-color: #f5f5f5;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: all 0.3s;
            }

            .search-tab.active {
                background-color: #007bff;
                color: white;
            }

            .search-input {
                flex: 1;
                padding: 12px;
                font-size: 16px;
                border: 1px solid #ddd;
                border-radius: 5px;
                outline: none;
            }

            .search-button {
                padding: 12px 24px;
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            .highlight {
                background-color: #fff3cd;
                padding: 2px;
                border-radius: 2px;
            }

            .branch-distance {
                margin-top: 8px;
                color: #666;
                font-size: 0.9rem;
            }

            @media (max-width: 768px) {
                .outlet-grid {
                    grid-template-columns: 1fr;
                }
                
                #map {
                    height: 400px;
                }

                .branch-list {
                    height: auto;
                    max-height: 500px;
                }
            }

            .nearby-branch {
                border: 2px solid #007bff;
                background-color: #f8f9ff;
            }

            .nearest-label {
                background-color: #28a745;
                color: white;
                padding: 2px 8px;
                border-radius: 12px;
                font-size: 0.8rem;
                margin-left: 10px;
            }

            .nearest-badge {
                background-color: #28a745;
                color: white;
                padding: 2px 8px;
                border-radius: 12px;
                font-size: 0.8rem;
                margin-left: 10px;
                display: inline-block;
            }

            .branch-distance {
                display: flex;
                align-items: center;
                gap: 5px;
                margin-top: 8px;
                color: #666;
                font-size: 0.9rem;
            }

            .branch-distance i {
                color: #007bff;
            }
        </style>
        <script src="https://cdn.jsdelivr.net/gh/somanchiu/Keyless-Google-Maps-API@v6.8/mapsJavaScriptAPI.js"></script>
        <script>
            let map, geocoder, marker, userLocationMarker;
            let searchMode = 'location'; // 'location' or 'branch'
            
            // Updated branch data with full details
            const branches = [
                {
                    lat: 6.9271,
                    lng: 79.8612,
                    name: 'Sola Chemical - Colombo Branch',
                    address: '123 Galle Road, Colombo 03',
                    phone: '+94 11 234 5678',
                    hours: 'Mon-Sat: 9:00 AM - 6:00 PM'
                },
                {
                    lat: 7.2906,
                    lng: 80.6348,
                    name: 'Sola Chemical - Kandy Branch',
                    address: '45 Peradeniya Road, Kandy',
                    phone: '+94 81 234 5678',
                    hours: 'Mon-Sat: 9:00 AM - 6:00 PM'
                },
                {
                    lat: 6.9273,
                    lng: 80.4736,
                    name: 'Sola Chemical - Galle Branch',
                    address: '78 Main Street, Galle',
                    phone: '+94 91 234 5678',
                    hours: 'Mon-Sat: 9:00 AM - 6:00 PM'
                },
                {
                    lat: 6.9940,
                    lng: 79.9766,
                    name: 'Sola Chemical - Negombo Branch',
                    address: '56 Beach Road, Negombo',
                    phone: '+94 31 234 5678',
                    hours: 'Mon-Sat: 9:00 AM - 6:00 PM'
                }
            ];

            function initMap() {
                geocoder = new google.maps.Geocoder();

                // Initialize the map with a default location (centered around Sri Lanka)
                map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 8,
                    center: { lat: 7.8731, lng: 80.7718 }, // Center of Sri Lanka
                    mapTypeControl: true,
                    streetViewControl: true,
                    fullscreenControl: true,
                    styles: [
                        {
                            featureType: "poi",
                            elementType: "labels",
                            stylers: [{ visibility: "off" }]
                        }
                    ]
                });

                // Display all branches immediately
                displayBranchList();

                // Add markers and info windows for all branches immediately
                branches.forEach(branch => {
                    const marker = new google.maps.Marker({
                        position: { lat: branch.lat, lng: branch.lng },
                        map: map,
                        title: branch.name,
                        icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
                    });

                    const infoWindow = new google.maps.InfoWindow({
                        content: `
                            <div style="padding: 10px;">
                                <h3 style="margin: 0 0 5px 0;">${branch.name}</h3>
                                <p style="margin: 5px 0;">${branch.address}</p>
                                <p style="margin: 5px 0;">${branch.phone}</p>
                                <p style="margin: 5px 0;">${branch.hours}</p>
                            </div>
                        `
                    });

                    marker.addListener('click', () => {
                        infoWindow.open(map, marker);
                    });
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

                            // Calculate and display distances to all branches
                            calculateDistances(userLocation);
                        },
                        function () {
                            handleGeolocationError(true);
                        }
                    );
                } else {
                    handleGeolocationError(false);
                }
            }

            function handleGeolocationError(browserHasGeolocation) {
                const center = { lat: 7.8731, lng: 80.7718 }; // Center of Sri Lanka
                map.setCenter(center);
                map.setZoom(8);
                
                // Display branch list without distances
                displayBranchList();
            }

            function calculateDistances(userLocation) {
                const service = new google.maps.DistanceMatrixService();
                const destinations = branches.map(branch => ({ lat: branch.lat, lng: branch.lng }));

                service.getDistanceMatrix(
                    {
                        origins: [userLocation],
                        destinations: destinations,
                        travelMode: google.maps.TravelMode.DRIVING,
                    },
                    (response, status) => {
                        if (status === 'OK') {
                            const distances = response.rows[0].elements;
                            branches.forEach((branch, index) => {
                                if (distances[index].status === 'OK') {
                                    branch.distance = distances[index].distance.text;
                                    branch.duration = distances[index].duration.text;
                                }
                            });
                            displayBranchList();
                        }
                    }
                );
            }

            function searchBranches(query) {
                const searchTerm = query.toLowerCase();
                return branches.map(branch => {
                    const searchableText = `${branch.name} ${branch.address}`.toLowerCase();
                    const matchScore = searchableText.includes(searchTerm) ? 1 : 0;
                    return { ...branch, matchScore };
                })
                .sort((a, b) => b.matchScore - a.matchScore);
            }

            function highlightText(text, searchTerm) {
                if (!searchTerm) return text;
                const regex = new RegExp(`(${searchTerm})`, 'gi');
                return text.replace(regex, '<span class="highlight">$1</span>');
            }

            function handleSearch() {
                const searchInput = document.getElementById("search-input").value;
                
                if (!searchInput) {
                    alert("Please enter a search term.");
                    return;
                }

                if (searchMode === 'location') {
                    searchLocation();
                } else {
                    // Branch search
                    const sortedBranches = searchBranches(searchInput);
                    displayBranchList(sortedBranches, searchInput);
                    
                    // If there are matches, center the map on the first matching branch
                    if (sortedBranches[0].matchScore > 0) {
                        map.setCenter({ lat: sortedBranches[0].lat, lng: sortedBranches[0].lng });
                        map.setZoom(12);
                    }
                }
            }

            function setSearchMode(mode) {
                searchMode = mode;
                const locationTab = document.getElementById('locationTab');
                const branchTab = document.getElementById('branchTab');
                const searchInput = document.getElementById('search-input');

                locationTab.classList.toggle('active', mode === 'location');
                branchTab.classList.toggle('active', mode === 'branch');

                searchInput.placeholder = mode === 'location' 
                    ? 'Enter your location to find nearest outlet'
                    : 'Search for branch name or address';

                // Clear previous search results
                if (marker) {
                    marker.setMap(null);
                }
                displayBranchList(branches);
            }

            function displayBranchList(branchesToDisplay = branches, searchTerm = '') {
                const branchListElement = document.getElementById('branch-list');
                branchListElement.innerHTML = '';

                branchesToDisplay.forEach(branch => {
                    const distanceInfo = branch.distance ? 
                        `<div class="branch-distance">${branch.distance} (${branch.duration} drive)</div>` : '';

                    const highlightedName = highlightText(branch.name, searchTerm);
                    const highlightedAddress = highlightText(branch.address, searchTerm);

                    branchListElement.innerHTML += `
                        <div class="branch-card">
                            <div class="branch-name">${highlightedName}</div>
                            <div class="branch-details">
                                <div class="branch-address">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    ${highlightedAddress}
                                </div>
                                <div class="branch-phone">
                                    <i class="bi bi-telephone-fill"></i>
                                    ${branch.phone}
                                </div>
                                ${distanceInfo}
                            </div>
                            <a href="tel:${branch.phone.replace(/\s+/g, '')}" class="call-button">
                                <i class="bi bi-telephone"></i>
                                Call Branch
                            </a>
                        </div>
                    `;
                });
            }

            // Add this new function for location search
            function searchLocation() {
                const address = document.getElementById("search-input").value;

                if (address) {
                    geocoder.geocode({ address: address }, function(results, status) {
                        if (status === "OK") {
                            const location = results[0].geometry.location;
                            
                            // Center the map on the searched location
                            map.setCenter(location);
                            map.setZoom(12);

                            // Update or create search marker
                            if (marker) {
                                marker.setMap(null);
                            }
                            marker = new google.maps.Marker({
                                position: location,
                                map: map,
                                title: 'Searched Location',
                                icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
                            });

                            // Draw radius circle around searched location (5km radius)
                            if (window.radiusCircle) {
                                window.radiusCircle.setMap(null);
                            }
                            window.radiusCircle = new google.maps.Circle({
                                map: map,
                                radius: 5000, // 5km radius
                                fillColor: '#007bff',
                                fillOpacity: 0.1,
                                strokeColor: '#007bff',
                                strokeOpacity: 0.8,
                                strokeWeight: 2,
                                center: location
                            });

                            // Calculate distances and find nearby branches
                            calculateDistances(location);
                        } else {
                            alert("Location search failed: " + status);
                        }
                    });
                } else {
                    alert("Please enter a location to search.");
                }
            }

            function calculateDistances(location) {
                const service = new google.maps.DistanceMatrixService();
                const destinations = branches.map(branch => ({ lat: branch.lat, lng: branch.lng }));

                service.getDistanceMatrix(
                    {
                        origins: [location],
                        destinations: destinations,
                        travelMode: google.maps.TravelMode.DRIVING,
                    },
                    (response, status) => {
                        if (status === 'OK') {
                            const distances = response.rows[0].elements;
                            
                            // Update branches with distance information
                            branches.forEach((branch, index) => {
                                if (distances[index].status === 'OK') {
                                    branch.distance = distances[index].distance.text;
                                    branch.duration = distances[index].duration.text;
                                    branch.distanceValue = distances[index].distance.value; // Distance in meters
                                }
                            });

                            // Sort branches by distance
                            const sortedBranches = [...branches].sort((a, b) => 
                                (a.distanceValue || Infinity) - (b.distanceValue || Infinity)
                            );

                            // Update markers appearance based on distance
                            updateBranchMarkers(sortedBranches, location);

                            // Display sorted branch list
                            displayBranchList(sortedBranches);
                        }
                    }
                );
            }

            function updateBranchMarkers(sortedBranches, searchLocation) {
                // Clear existing branch markers
                if (window.branchMarkers) {
                    window.branchMarkers.forEach(marker => marker.setMap(null));
                }
                window.branchMarkers = [];

                // Create new markers with different icons based on distance
                sortedBranches.forEach((branch, index) => {
                    const isNearby = branch.distanceValue <= 5000; // Within 5km
                    const markerIcon = isNearby ? 
                        'http://maps.google.com/mapfiles/ms/icons/red-dot.png' : 
                        'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png';

                    const marker = new google.maps.Marker({
                        position: { lat: branch.lat, lng: branch.lng },
                        map: map,
                        title: branch.name,
                        icon: markerIcon,
                        animation: isNearby ? google.maps.Animation.BOUNCE : null
                    });

                    const infoWindow = new google.maps.InfoWindow({
                        content: `
                            <div style="padding: 10px;">
                                <h3 style="margin: 0 0 5px 0;">${branch.name}</h3>
                                <p style="margin: 5px 0;">${branch.address}</p>
                                <p style="margin: 5px 0;">${branch.phone}</p>
                                <p style="margin: 5px 0;">${branch.hours}</p>
                                ${branch.distance ? `<p style="margin: 5px 0; color: #007bff;">Distance: ${branch.distance}</p>` : ''}
                                ${branch.duration ? `<p style="margin: 5px 0; color: #28a745;">Drive time: ${branch.duration}</p>` : ''}
                            </div>
                        `
                    });

                    marker.addListener('click', () => {
                        infoWindow.open(map, marker);
                    });

                    window.branchMarkers.push(marker);

                    // Automatically bounce and show info for the nearest branch
                    if (index === 0) {
                        setTimeout(() => {
                            infoWindow.open(map, marker);
                        }, 1000);
                    }
                });
            }

            function displayBranchList(branchesToDisplay = branches, searchTerm = '') {
                const branchListElement = document.getElementById('branch-list');
                branchListElement.innerHTML = '';

                branchesToDisplay.forEach((branch, index) => {
                    const distanceInfo = branch.distance ? 
                        `<div class="branch-distance">
                            <i class="bi bi-signpost-2"></i>
                            Distance: ${branch.distance} (${branch.duration} drive)
                            ${index === 0 ? '<span class="nearest-badge">Nearest Branch</span>' : ''}
                        </div>` : '';

                    const highlightedName = highlightText(branch.name, searchTerm);
                    const highlightedAddress = highlightText(branch.address, searchTerm);
                    const isNearby = branch.distanceValue <= 5000; // Within 5km

                    branchListElement.innerHTML += `
                        <div class="branch-card ${isNearby ? 'nearby-branch' : ''}">
                            <div class="branch-name">
                                ${highlightedName}
                                ${index === 0 ? '<span class="nearest-label">Nearest</span>' : ''}
                            </div>
                            <div class="branch-details">
                                <div class="branch-address">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    ${highlightedAddress}
                                </div>
                                <div class="branch-phone">
                                    <i class="bi bi-telephone-fill"></i>
                                    ${branch.phone}
                                </div>
                                ${distanceInfo}
                            </div>
                            <a href="tel:${branch.phone.replace(/\s+/g, '')}" class="call-button">
                                <i class="bi bi-telephone"></i>
                                Call Branch
                            </a>
                        </div>
                    `;
                });
            }
        </script>
    </head>
    <body onload="initMap()">
        <div class="outlet-container">
            <div class="search-container">
                <div class="search-tabs">
                    <button id="locationTab" class="search-tab active" onclick="setSearchMode('location')">
                        <i class="bi bi-geo-alt"></i> Search by Location
                    </button>
                    <button id="branchTab" class="search-tab" onclick="setSearchMode('branch')">
                        <i class="bi bi-building"></i> Search by Branch
                    </button>
                </div>
                <div class="search-box">
                    <input id="search-input" 
                           class="search-input" 
                           type="text" 
                           placeholder="Enter your location to find nearest outlet"
                           onkeypress="if(event.key === 'Enter') handleSearch()" />
                    <button class="search-button" onclick="handleSearch()">
                        <i class="bi bi-search"></i> Search
                    </button>
                </div>
            </div>

            <div class="outlet-grid">
                <div id="map"></div>
                <div id="branch-list" class="branch-list">
                    <!-- Branch cards will be dynamically inserted here -->
                </div>
            </div>
        </div>

        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/components/home-footer.php'; ?>
    </body>
</html>
