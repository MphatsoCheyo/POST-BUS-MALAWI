<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Bus Malawi Tracker</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .app-container {
        flex-direction: column;
        height: 100vh;
    }

    /* Center the map */
    .map-container {
        display: flex;
        flex: 1;
        justify-content: center;
        align-items: center;
        position: relative;
        background-color: #e5e5e5;
    }

    #map {
        width: 60%; /* Adjust map width */
        height: 90vh;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Bus info panel */
    .bus-info-panel {
        margin-top: 80;
        position: absolute;
        top: 20px;
        right: 20px;
        background: white;
        padding: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-height: 400px;
        overflow-y: auto;
        width: 40%;
        border-radius: 8px;
        z-index: 10;
    }

    .panel-handle {
        cursor: pointer;
        background-color: #ddd;
        width: 30px;
        height: 5px;
        margin-bottom: 10px;
        border-radius: 10px;
    }

    .bus-cards-container {
        max-height: 80vh;
        overflow-y: auto;
    }

    .bus-card {
        border: 1px solid #ccc;
        padding: 12px;
        margin: 8px 0;
        cursor: pointer;
        background-color: #fff;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .bus-card:hover {
        background-color: #f5f5f5;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .bus-card.delayed {
        border-color: #f44336;
    }

    .status-ontime {
        color: green;
        font-weight: bold;
    }

    .status-delayed {
        color: #f44336;
        font-weight: bold;
    }

    /* Notification section */
    .notification-toast {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #333;
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        display: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .toast-icon {
        margin-right: 10px;
    }

    /* Notifications overlay */
    .notification-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        z-index: 9999;
        display: none;
        justify-content: center;
        align-items: center;
    }

    .notification-panel {
        background: white;
        padding: 20px;
        width: 350px;
        margin: 50px auto;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .notification-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .close-btn {
        cursor: pointer;
        background: none;
        border: none;
        font-size: 20px;
        color: #f44336;
    }

    /* Permission Dialog */
    .permission-dialog {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
    }

    .permission-container {
        background: white;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        max-width: 320px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .permission-icon {
        font-size: 40px;
        color: #4caf50;
        margin-bottom: 10px;
    }

    .permission-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .permission-message {
        font-size: 16px;
        color: #555;
        margin-bottom: 20px;
    }

    .permission-button {
        padding: 12px 20px;
        border: none;
        margin: 5px;
        cursor: pointer;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .permission-cancel {
        background-color: #f44336;
        color: white;
    }

    .permission-allow {
        background-color: #4caf50;
        color: white;
    }

    /* Button hover effects */
    .permission-button:hover {
        transform: scale(1.05);
    }

</style>

</head>
<body>

    <div class="app-container">
        <div class="map-container">
            <div id="map"></div>

            <div class="bus-info-panel">
                <div class="panel-handle">⇓</div>
                <div class="bus-cards-container" id="busCards">
                    <!-- Bus cards will be added dynamically -->
                </div>
            </div>
        </div>
        <div class="phone-input-container">
        <h3>Enter Phone Number to Receive Notifications</h3>
        <input type="text" id="phoneNumber" placeholder="Enter phone number" />
        <button onclick="submitPhoneNumber()">Submit</button>
    </div>


        <!-- Notification section placed below the map -->
        <div class="notification-container" id="notificationContainer">
            <div class="notification-overlay" id="notificationOverlay">
                <div class="notification-panel">
                    <div class="notification-header">
                        <div class="notification-title">Notifications</div>
                        <button class="close-btn" id="closeNotifications">✕</button>
                    </div>
                    <div class="notification-list" id="notificationList">
                        <!-- Notifications will be added dynamically -->
                    </div>
                </div>
            </div>

            <div class="notification-toast" id="notificationToast">
                <span class="toast-icon">🔔</span>
                <span id="toastMessage"></span>
            </div>

            <div class="permission-dialog" id="permissionDialog">
                <div class="permission-container">
                    <div class="permission-icon">🔔</div>
                    <div class="permission-title">Enable Notifications</div>
                    <div class="permission-message">Get real-time alerts for bus delays, route changes, and important updates.</div>
                    <div class="permission-buttons">
                        <button class="permission-button permission-cancel" id="permissionCancel">Not Now</button>
                        <button class="permission-button permission-allow" id="permissionAllow">Allow</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Initialize the map
        const map = L.map('map').setView([-13.9890, 33.7741], 13); // Coordinates for Malawi (Lilongwe)

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Sample Post Bus Malawi route data
        const busData = [
            {
                id: 1,
                route: "Lilongwe - Blantyre",
                location: [-13.9890, 33.7741],  // Example location for Lilongwe
                nextStop: "Chiwembe",
                arrivalTime: "15 min",
                status: "on-time",
                direction: { lat: 0.001, lng: 0.001 }
            },
            {
                id: 2,
                route: "Lilongwe - Mzuzu",
                location: [-13.9660, 34.0010],  // Example location for Mzuzu
                nextStop: "Mzimba",
                arrivalTime: "10 min",
                status: "delayed",
                delay: "5 min",
                reason: "Roadwork",
                direction: { lat: -0.0005, lng: 0.001 }
            }
        ];

        // Sample notifications
        const notifications = [
            {
                id: 1,
                time: "10:23 AM",
                message: "Bus from Lilongwe to Blantyre is delayed by 5 minutes due to roadworks.",
                read: false
            },
            {
                id: 2,
                time: "9:45 AM",
                message: "Bus from Lilongwe to Mzuzu has a detour near Chiwembe due to construction.",
                read: false
            }
        ];

        // Bus markers
        const busMarkers = {};

        // Create custom bus markers
        function createBusMarker(bus) {
            const markerDiv = document.createElement('div');
            markerDiv.className = `bus-marker ${bus.status === 'delayed' ? 'delayed' : ''}`;
            markerDiv.textContent = bus.route;

            const icon = L.divIcon({
                html: markerDiv,
                className: 'bus-marker-container'
            });

            const marker = L.marker(bus.location, { icon: icon });

            marker.on('click', () => {
                highlightBusCard(bus.id);
            });

            return marker;
        }

        // Add buses to the map
        function addBusesToMap() {
            busData.forEach(bus => {
                const marker = createBusMarker(bus);
                marker.addTo(map);
                busMarkers[bus.id] = marker;
            });
        }

        // Create bus info cards
        function createBusCards() {
            const busCardsContainer = document.getElementById('busCards');
            busCardsContainer.innerHTML = '';

            busData.forEach(bus => {
                const card = document.createElement('div');
                card.className = `bus-card ${bus.status === 'delayed' ? 'delayed' : ''}`;
                card.id = `bus-card-${bus.id}`;

                const statusText = bus.status === 'delayed'
                    ? `Delayed (${bus.delay})`
                    : 'On Time';
                const statusClass = bus.status === 'delayed'
                    ? 'status-delayed'
                    : 'status-ontime';

                card.innerHTML = `
                    <div class="bus-header">
                        <div class="bus-route">${bus.route}</div>
                        <div class="bus-status ${statusClass}">${statusText}</div>
                    </div>
                    <div class="bus-details">
                        <div class="bus-detail-item">
                            <div class="detail-label">Next Stop</div>
                            <div class="detail-value">${bus.nextStop}</div>
                        </div>
                        <div class="bus-detail-item">
                            <div class="detail-label">Arriving</div>
                            <div class="detail-value">${bus.arrivalTime}</div>
                        </div>
                    </div>
                    ${bus.status === 'delayed' ? `
                    <div class="bus-details" style="margin-top: 8px;">
                        <div class="bus-detail-item" style="width: 100%;">
                            <div class="detail-label">Reason</div>
                            <div class="detail-value">${bus.reason}</div>
                        </div>
                    </div>
                    ` : ''}
                `;

                card.addEventListener('click', () => {
                    map.setView(bus.location, 15);
                    highlightBusMarker(bus.id);
                });

                busCardsContainer.appendChild(card);
            });
        }

        // Highlight bus card
        function highlightBusCard(busId) {
            document.querySelectorAll('.bus-card').forEach(card => {
                card.style.boxShadow = '0 2px 5px rgba(0,0,0,0.05)';
            });

            const selectedCard = document.getElementById(`bus-card-${busId}`);
            if (selectedCard) {
                selectedCard.style.boxShadow = '0 0 0 2px #1a73e8, 0 2px 5px rgba(0,0,0,0.1)';
                selectedCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        }

        // Highlight bus marker
        function highlightBusMarker(busId) {
            Object.values(busMarkers).forEach(marker => {
                const markerElement = marker.getElement();
                if (markerElement) {
                    markerElement.querySelector('.bus-marker').style.transform = 'scale(1)';
                    markerElement.querySelector('.bus-marker').style.zIndex = '1';
                }
            });

            const selectedMarker = busMarkers[busId];
            if (selectedMarker) {
                const markerElement = selectedMarker.getElement();
                if (markerElement) {
                    markerElement.querySelector('.bus-marker').style.transform = 'scale(1.2)';
                    markerElement.querySelector('.bus-marker').style.zIndex = '1000';
                }
            }
        }

        // Create notification items
        function createNotificationItems() {
            const notificationList = document.getElementById('notificationList');
            notificationList.innerHTML = '';

            notifications.forEach(notification => {
                const item = document.createElement('div');
                item.className = 'notification-item';
                item.innerHTML = `
                    <div class="notification-time">${notification.time}</div>
                    <div class="notification-message">${notification.message}</div>
                `;

                notificationList.appendChild(item);
            });
        }

        // Toggle the visibility of the notification overlay
        document.getElementById('closeNotifications').addEventListener('click', () => {
            document.getElementById('notificationOverlay').style.display = 'none';
        });

        // Simulate displaying notifications after 3 seconds
        setTimeout(() => {
            document.getElementById('notificationOverlay').style.display = 'block';
        }, 3000);

        // Initialize the page
        function init() {
            addBusesToMap();
            createBusCards();
            createNotificationItems();
        }

        init();
    </script>
</body>
</html>
