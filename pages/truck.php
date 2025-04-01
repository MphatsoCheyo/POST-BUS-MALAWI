<?php
$page_name = 'about us';  
include('../pages/header.php');
?>
       
    </style>
</head>
<body>
    <div class="containertruck">
        <div class="headerrr">
            <h1>Real-Time Bus Tracking</h1>
        </div>

        <section id="activeRoutes" class="section">
            <!-- Bus routes will be dynamically inserted here -->
        </section>

        <section class="section">
            <h2 class="text-xl font-semibold mb-4">Bus Locations</h2>
            <div id="map"></div>
        </section>

        <section id="notificationSection" class="section hidden">
            <h2 class="text-xl font-semibold mb-4">Get Bus Notifications</h2>
            <input type="email" id="emailInput" placeholder="Enter your email" class="input-field">
            <input type="text" id="routeNotifyInput" class="input-field" readonly>
            <button onclick="subscribeEmail()" class="subscribe-btn">Subscribe for Updates</button>
        </section>
    </div>

    <div id="toast" class="toast"></div>
    <?php include('../pages/footer.php'); 
    ?>

    <script>
        const busRoutes = [
            { id: 'PBM-101', route: 'Lilongwe - Blantyre', path: [[-13.9833, 33.7833], [-15.7861, 35.0058]], cities: ['Lilongwe', 'Blantyre'] },
            { id: 'PBM-102', route: 'Lilongwe - Mzuzu', path: [[-13.9833, 33.7833], [-11.4500, 34.0167]], cities: ['Lilongwe', 'Mzuzu'] },
            { id: 'PBM-103', route: 'Lilongwe - Zomba', path: [[-13.9833, 33.7833], [-15.3851, 35.3185]], cities: ['Lilongwe', 'Zomba'] },
            { id: 'PBM-201', route: 'Blantyre - Mzuzu', path: [[-15.7861, 35.0058], [-11.4500, 34.0167]], cities: ['Blantyre', 'Mzuzu'] },
            { id: 'PBM-202', route: 'Blantyre - Mangochi', path: [[-15.7861, 35.0058], [-14.4789, 35.2645]], cities: ['Blantyre', 'Mangochi'] },
            { id: 'PBM-301', route: 'Mzuzu - Mangochi', path: [[-11.4500, 34.0167], [-14.4789, 35.2645]], cities: ['Mzuzu', 'Mangochi'] },
            { id: 'PBM-302', route: 'Mzuzu - Zomba', path: [[-11.4500, 34.0167], [-15.3851, 35.3185]], cities: ['Mzuzu', 'Zomba'] },
            { id: 'PBM-401', route: 'Zomba - Mangochi', path: [[-15.3851, 35.3185], [-14.4789, 35.2645]], cities: ['Zomba', 'Mangochi'] }
        ];

        let map;
        let currentlyTrackedBus = null;

        function initMap() {
            map = L.map('map').setView([-13.9500, 33.8000], 7);
            
            try {
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
            } catch (e) {
                console.error("Error loading map tiles:", e);
                document.getElementById('map').innerHTML = '<p class="text-red-500">Error loading map. Please check your internet connection.</p>';
            }
            
            updateMap(busRoutes);
        }

        function renderBusRoutes() {
            const routesContainer = document.getElementById('activeRoutes');
            routesContainer.innerHTML = '';
            
            busRoutes.forEach(bus => {
                const routeElement = document.createElement('div');
                routeElement.className = `section ${currentlyTrackedBus && currentlyTrackedBus.id === bus.id ? 'bus-status-tracked' : ''}`;
                routeElement.innerHTML = `
                    <h3 class="font-bold">${bus.route}</h3>
                    <p>Route ID: ${bus.id}</p>
                    <button class="track-btn" onclick="trackBus('${bus.id}')">Track This Bus</button>
                `;
                routesContainer.appendChild(routeElement);
            });
        }

        function trackBus(busId) {
            const bus = busRoutes.find(b => b.id === busId);
            if (!bus) return;

            currentlyTrackedBus = bus;
            
            document.getElementById('notificationSection').classList.remove('hidden');
            document.getElementById('routeNotifyInput').value = bus.route;
            document.getElementById('emailInput').value = '';
            
            updateMap([bus]);
            
            document.getElementById('notificationSection').scrollIntoView({ behavior: 'smooth' });
            
            showToast(`Now tracking ${bus.route}. Enter your email to get notifications.`);

            renderBusRoutes();
        }

        function updateMap(routes = busRoutes) {
            if (!map) return;
            
            map.eachLayer(layer => {
                if (layer instanceof L.Marker || layer instanceof L.Polyline) {
                    map.removeLayer(layer);
                }
            });
            
            if (routes.length === 0) return;
            
            const bounds = new L.LatLngBounds();
            
            routes.forEach(bus => {
                const markerStart = L.marker(bus.path[0]).addTo(map)
                    .bindPopup(`<b>${bus.route}</b><br>Start: ${bus.cities[0]}`);
                const markerEnd = L.marker(bus.path[1]).addTo(map)
                    .bindPopup(`<b>${bus.route}</b><br>End: ${bus.cities[1]}`);
                
                const lineColor = (currentlyTrackedBus && currentlyTrackedBus.id === bus.id) ? 'blue' : 'green';
                
                L.polyline(bus.path, { 
                    color: lineColor,
                    weight: 5,
                    opacity: 0.7
                }).addTo(map).bindPopup(`<b>${bus.route}</b>`);
                
                bounds.extend(bus.path[0]);
                bounds.extend(bus.path[1]);
            });
            
            map.fitBounds(bounds);
        }

        function subscribeEmail() {
            const email = document.getElementById('emailInput').value.trim();
            const route = document.getElementById('routeNotifyInput').value;

            if (!email) {
                showToast('Please enter a valid email address');
                return;
            }

            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                showToast('Please enter a valid email address');
                return;
            }

            if (!currentlyTrackedBus) {
                showToast('No bus is currently being tracked');
                return;
            }

            // Fetch request to PHP script
            fetch('send_notification.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    email: email,
                    bus_route: route,
                    bus_id: currentlyTrackedBus.id
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(`Success! You'll receive notifications for ${route} at ${email}`);
                    document.getElementById('emailInput').value = '';
                    document.getElementById('notificationSection').classList.add('hidden');
                } else {
                    showToast(data.message || 'Failed to subscribe. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('An error occurred while processing your request');
            });
        }

        function showToast(message) {
            const toast = document.getElementById('toast');
            toast.textContent = message;
            toast.style.display = 'block';
            setTimeout(() => {
                toast.style.display = 'none';
            }, 3000);
        }

        document.addEventListener('DOMContentLoaded', () => {
            initMap();
            renderBusRoutes();
        });
    </script>
</body>
</html>