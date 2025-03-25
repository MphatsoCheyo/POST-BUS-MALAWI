<?php
$page_name = 'bus trucking  page';  // Set the current page name
include('../pages/header.php');
?>
    <style>
        /* Map styling */
        .phone-input-container {
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
            text-align: center;
            margin-bottom: 20px;
        padding: 15px;
        border-left: 4px solid var(--secondary-color);
        background-color: var(--white);
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* Heading Style */
        .phone-input-container h3 {
            font-family: 'Arial', sans-serif;
            font-size: 18px;
            color: #333;
            margin-bottom: 15px;
            font-weight: 600;
        }

        /* Input Field Style */
        #phoneNumber {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            margin-bottom: 15px;
            transition: border-color 0.3s ease;
        }

        /* Input Field Focus Style */
        #phoneNumber:focus {
            border-color: #007bff;
            outline: none;
        }

        /* Button Style */
        #subscribeButton {
            padding: 12px 25px;
            font-size: 16px;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Button Hover Effect */
        #subscribeButton:hover {
            background-color: #0056b3;
        }

        /* Subscription Status Text */
        #subscriptionStatus {
            margin-top: 10px;
            font-size: 14px;
            color: #28a745;
        }

        /* Add an error status style (if needed) */
        #subscriptionStatus.error {
            color: #dc3545;
        }

        /* Small responsive styling */
        @media screen and (max-width: 480px) {
            .phone-input-container {
                padding: 15px;
            }

            #phoneNumber {
                font-size: 14px;
            }

            #subscribeButton {
                font-size: 14px;
            }
        }
    
    </style>
<body>

<div class="app-containe">
    <h2>Truck your Bus to know time arrival</h2>
    <div class="map-container">
        <div id="map"></div>
        </div>
        <!-- Phone Number Input Form -->
        <div class="phone-input-container">
            <h3>Enter Phone Number to Receive Notifications</h3>
            <input type="text" id="phoneNumber" placeholder="+265 xxxxxxxx" />
            <button id="subscribeButton">Subscribe to Updates</button>
            <p id="subscriptionStatus"></p>
        </div>
   

    <!-- Notification section -->
    <div id="notificationPanel"></div>
</div>
<?php
    include('../pages/footer.php');  // Include footer.php
    ?>


<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="../script/script.js"></script>
<script src="../script/java.js"></script>
<script>
    // Initialize the map
    const map = L.map('map').setView([-13.9890, 33.7741], 7); // Coordinates for Malawi (zoomed out to show more)

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
        route: "Blantyre - Lilongwe",
        location: [-15.786, 35.005],  // Example location for Blantyre
        nextStop: "Ntcheu",
        arrivalTime: "20 min",
        status: "on-time",
        direction: { lat: 0.001, lng: -0.001 }
    },
    {
        id: 3,
        route: "Lilongwe - Mzuzu",
        location: [-13.9660, 34.0010],  // Example location north of Lilongwe
        nextStop: "Mzimba",
        arrivalTime: "10 min",
        status: "delayed",
        delay: "5 min",
        reason: "Roadwork",
        direction: { lat: -0.0005, lng: 0.001 }
    }
];

// Bus markers and animation objects
const busMarkers = {};
const busAnimations = {};

// SMS API configuration - Africa's Talking with ACTUAL configured API key
const SMS_API = {
    apiUrl: "https://api.africastalking.com/version1/messaging",
    apiKey: "8d3fe1922c32c91a1e0f9f36c7d1c6a56d87f8f9c14f0d6d4da6dfb66987abc", // Use your real API key in production
    username: "postbusmalawi", // Use a real username
    senderId: "PostBus"
};

// Store tracked buses and user phone
let userPhoneNumber = '';
const trackedBuses = new Set();
// Track the last notification message for retry purposes
let lastNotificationMessage = '';

// Add markers for bus routes
busData.forEach(bus => {
    // Create a custom icon
    const busIcon = L.divIcon({
        className: 'bus-icon',
        html: `<div style="background-color: #0078D7; color: white; border-radius: 50%; width: 30px; height: 30px; display: flex; justify-content: center; align-items: center; font-weight: bold;">🚌</div>`,
        iconSize: [30, 30],
        iconAnchor: [15, 15]
    });

    // Create and add the marker
    const marker = L.marker(bus.location, { icon: busIcon }).addTo(map);
    
    // Create popup content with status badge
    const statusClass = bus.status === 'on-time' ? 'on-time' : 'delayed';
    const statusInfo = bus.status === 'on-time' ? 
        'On Time' : 
        `Delayed by ${bus.delay} (${bus.reason})`;
    
    const popupContent = `
        <div style="width: 200px;">
            <h3 style="margin: 0 0 5px 0;">${bus.route}</h3>
            <p><strong>Next Stop:</strong> ${bus.nextStop}</p>
            <p><strong>Arrival:</strong> ${bus.arrivalTime}</p>
            <p><strong>Status:</strong> <span class="status-badge ${statusClass}">${statusInfo}</span></p>
            <button onclick="trackBus(${bus.id})" style="width: 100%; padding: 8px; background-color: #4caf50; color: white; border: none; border-radius: 4px; cursor: pointer;">Track This Bus</button>
        </div>
    `;
    
    marker.bindPopup(popupContent);
    
    // Store the marker reference
    busMarkers[bus.id] = marker;
    
    // Start animating the bus
    startBusAnimation(bus.id, bus.direction);
});

// Function to animate bus movement
function startBusAnimation(busId, direction) {
    const bus = busData.find(b => b.id === busId);
    if (!bus) return;
    
    const marker = busMarkers[busId];
    if (!marker) return;
    
    busAnimations[busId] = setInterval(() => {
        // Get current position
        const currentPos = marker.getLatLng();
        
        // Calculate new position
        const newPos = [
            currentPos.lat + (Math.random() * 0.002 - 0.001) + direction.lat,
            currentPos.lng + (Math.random() * 0.002 - 0.001) + direction.lng
        ];
        
        // Update bus data and marker position
        bus.location = newPos;
        marker.setLatLng(newPos);
        
        // Update arrival time randomly sometimes
        if (Math.random() > 0.9) {
            const timeChange = Math.floor(Math.random() * 3) - 1;
            const currentTime = parseInt(bus.arrivalTime.split(' ')[0]);
            bus.arrivalTime = `${Math.max(1, currentTime + timeChange)} min`;
            
            // Recreate popup with updated info
            const statusClass = bus.status === 'on-time' ? 'on-time' : 'delayed';
            const statusInfo = bus.status === 'on-time' ? 
                'On Time' : 
                `Delayed by ${bus.delay} (${bus.reason})`;
            
            const updatedPopup = `
                <div style="width: 200px;">
                    <h3 style="margin: 0 0 5px 0;">${bus.route}</h3>
                    <p><strong>Next Stop:</strong> ${bus.nextStop}</p>
                    <p><strong>Arrival:</strong> ${bus.arrivalTime}</p>
                    <p><strong>Status:</strong> <span class="status-badge ${statusClass}">${statusInfo}</span></p>
                    <button onclick="trackBus(${bus.id})" style="width: 100%; padding: 8px; background-color: #4caf50; color: white; border: none; border-radius: 4px; cursor: pointer;">Track This Bus</button>
                </div>
            `;
            
            marker.bindPopup(updatedPopup);
            
            // If user is subscribed to this bus, notify of changes
            checkForNotifications(bus);
        }
    }, 2000);
}

// Track a specific bus
function trackBus(busId) {
    const phoneNumber = document.getElementById('phoneNumber').value;
    
    if (!phoneNumber) {
        alert("Please enter a phone number to track this bus.");
        return;
    }
    
    if (!validatePhoneNumber(phoneNumber)) {
        alert("Please enter a valid phone number in the format: +265XXXXXXXXX");
        return;
    }
    
    userPhoneNumber = formatPhoneNumber(phoneNumber);
    trackedBuses.add(busId);
    
    const bus = busData.find(b => b.id === busId);
    if (bus) {
        document.getElementById('subscriptionStatus').innerHTML = 
            `<span style="color: green;">You're tracking the ${bus.route} bus</span>`;
        
        // Send initial notification
        sendNotification(bus);
    }
}

// Validate phone number format (improved validation for Malawi numbers)
function validatePhoneNumber(phoneNumber) {
    // Remove spaces and check format
    const cleanedNumber = phoneNumber.replace(/\s+/g, '');
    
    // Check for several valid Malawi number formats
    // +265XXXXXXXXX, 265XXXXXXXXX, 0XXXXXXXXX (for local numbers)
    return /^(\+?265|0)\d{7,9}$/.test(cleanedNumber);
}

// Format phone number to international format
function formatPhoneNumber(phoneNumber) {
    // Remove all non-digit characters except +
    let cleaned = phoneNumber.replace(/[^\d+]/g, '');
    
    // Ensure it starts with +265
    if (cleaned.startsWith('265')) {
        cleaned = '+' + cleaned;
    } else if (cleaned.startsWith('0')) {
        // Convert local format (0XXXXXXXX) to international (+265XXXXXXXX)
        cleaned = '+265' + cleaned.substring(1);
    } else if (!cleaned.startsWith('+')) {
        cleaned = '+265' + cleaned;
    }
    
    return cleaned;
}

// Check for notification triggers
function checkForNotifications(bus) {
    if (trackedBuses.has(bus.id)) {
        const arrivalTime = parseInt(bus.arrivalTime.split(' ')[0]);
        
        // Send notification if bus is arriving soon (less than 5 minutes)
        if (arrivalTime <= 5) {
            sendNotification(bus, true);
        }
    }
}

// SIMPLIFIED SMS SENDING FUNCTION - Using mock for development, real SMS API for production
function sendSms(phoneNumber, message) {
    // Update UI to show SMS is being sent
    const notificationPanel = document.getElementById('notificationPanel');
    notificationPanel.innerHTML = `
        <div style="background-color: #e3f2fd; padding: 10px; border-left: 4px solid #2196f3; margin-bottom: 10px;">
            <h4 style="margin: 0 0 5px 0;">Sending SMS... <span class="loading"></span></h4>
            <p style="margin: 0;">${message}</p>
            <p style="margin: 5px 0 0 0; font-size: 12px; color: #666;">To: ${phoneNumber}</p>
        </div>
        ${notificationPanel.innerHTML}
    `;
    
    // Store the message for retry purposes
    lastNotificationMessage = message;
    
    // DEVELOPMENT MODE: Use this for testing without actual SMS costs
    const isDevelopmentMode = true; // Set to false in production
    
    if (isDevelopmentMode) {
        // Simulate successful SMS delivery after a short delay
        return new Promise((resolve) => {
            setTimeout(() => {
                resolve({
                    success: true,
                    data: { message: "SMS delivered successfully (MOCK)" }
                });
            }, 1500);
        });
    }
    
    // PRODUCTION MODE: Use actual SMS API
    // Prepare request data for Africa's Talking API
    const formData = new URLSearchParams();
    formData.append('username', SMS_API.username);
    formData.append('to', phoneNumber);
    formData.append('message', message);
    formData.append('from', SMS_API.senderId);
    
    // Make the API request
    return fetch(SMS_API.apiUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'apiKey': SMS_API.apiKey
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('SMS sent successfully:', data);
        return {
            success: true,
            data: data
        };
    })
    .catch(error => {
        console.error('Error sending SMS:', error);
        return {
            success: false,
            error: error.message
        };
    });
}

// Send notification
function sendNotification(bus, isUpdate = false) {
    const phoneNumber = userPhoneNumber;
    if (!phoneNumber) return;
    
    // Create notification message
    const messageType = isUpdate ? "UPDATE" : "INITIAL TRACKING";
    const message = `${messageType}: Your Post Bus from ${bus.route} is arriving at ${bus.nextStop} in ${bus.arrivalTime}.`;
    
    // Send SMS and handle the result
    sendSms(phoneNumber, message)
        .then(result => {
            if (result.success) {
                showNotificationSent(message, "SMS Gateway");
            } else {
                showNotificationError();
            }
        })
        .catch(error => {
            console.error("Error in SMS sending:", error);
            showNotificationError();
        });
}

// Show notification sent confirmation in UI
function showNotificationSent(message, provider) {
    const notificationPanel = document.getElementById('notificationPanel');
    
    // Remove any "sending" notifications first
    const cleanedPanelHTML = notificationPanel.innerHTML.replace(/<div style="background-color: #e3f2fd;.*?<\/div>/g, '');
    
    notificationPanel.innerHTML = `
        <div style="background-color: #e8f5e9; padding: 10px; border-left: 4px solid #4caf50; margin-bottom: 10px;">
            <h4 style="margin: 0 0 5px 0;">SMS Notification Sent Successfully via ${provider}:</h4>
            <p style="margin: 0;">${message}</p>
            <p style="margin: 5px 0 0 0; font-size: 12px; color: #666;">Sent to: ${userPhoneNumber}</p>
            <p style="margin: 5px 0 0 0; font-size: 12px; color: #666;">Time: ${new Date().toLocaleTimeString()}</p>
        </div>
        ${cleanedPanelHTML}
    `;
}

// Show notification error in UI
function showNotificationError() {
    const notificationPanel = document.getElementById('notificationPanel');
    
    // Remove any "sending" notifications first
    const cleanedPanelHTML = notificationPanel.innerHTML.replace(/<div style="background-color: #e3f2fd;.*?<\/div>/g, '');
    
    notificationPanel.innerHTML = `
        <div style="background-color: #ffebee; padding: 10px; border-left: 4px solid #f44336; margin-bottom: 10px;">
            <h4 style="margin: 0 0 5px 0;">SMS Notification Failed</h4>
            <p style="margin: 0;">There was a problem sending the SMS notification to ${userPhoneNumber}.</p>
            <p style="margin: 5px 0 0 0;">We'll try again on the next location update.</p>
            <button onclick="retryLastNotification()" style="margin-top: 10px; padding: 5px 10px; background-color: #f44336; color: white; border: none; border-radius: 4px; cursor: pointer;">
                Retry Now
            </button>
        </div>
        ${cleanedPanelHTML}
    `;
}

// Retry last failed notification
function retryLastNotification() {
    if (!userPhoneNumber || lastNotificationMessage === '') {
        alert("No previous notification to retry.");
        return;
    }
    
    // Use the stored last message
    sendSms(userPhoneNumber, lastNotificationMessage)
        .then(result => {
            if (result.success) {
                showNotificationSent(lastNotificationMessage, "SMS Gateway (Retry)");
            } else {
                showNotificationError();
            }
        })
        .catch(error => {
            console.error("Error in SMS retry:", error);
            showNotificationError();
        });
}

// Set up subscription button
document.getElementById('subscribeButton').addEventListener('click', function() {
    const phoneNumber = document.getElementById('phoneNumber').value;
    
    if (!phoneNumber) {
        alert("Please enter a phone number to receive notifications.");
        return;
    }
    
    if (!validatePhoneNumber(phoneNumber)) {
        alert("Please enter a valid phone number in the format: +265XXXXXXXXX");
        return;
    }
    
    userPhoneNumber = formatPhoneNumber(phoneNumber);
    document.getElementById('subscriptionStatus').innerHTML = 
        `<span style="color: green;">You've subscribed with ${userPhoneNumber}</span>`;
    
    // Send test SMS to confirm subscription
    const testMessage = "Thank you for subscribing to Post Bus Malawi tracker service. You will now receive updates on bus locations and arrivals.";
    
    // Send confirmation SMS
    sendSms(userPhoneNumber, testMessage)
        .then(result => {
            if (result.success) {
                showNotificationSent(testMessage, "SMS Gateway");
            } else {
                // Still show subscription confirmed even if SMS fails
                const notificationPanel = document.getElementById('notificationPanel');
                notificationPanel.innerHTML = `
                    <div style="background-color: #fff3e0; padding: 10px; border-left: 4px solid #ff9800; margin-bottom: 10px;">
                        <h4 style="margin: 0 0 5px 0;">Subscription Confirmed</h4>
                        <p style="margin: 0;">Your subscription was successful, but there may be issues with SMS delivery. 
                        We'll try to send notifications when you track a bus.</p>
                    </div>
                    ${notificationPanel.innerHTML}
                `;
            }
        })
        .catch(error => {
            console.error("Error in subscription SMS:", error);
            // Still show subscription confirmation
            const notificationPanel = document.getElementById('notificationPanel');
            notificationPanel.innerHTML = `
                <div style="background-color: #fff3e0; padding: 10px; border-left: 4px solid #ff9800; margin-bottom: 10px;">
                    <h4 style="margin: 0 0 5px 0;">Subscription Confirmed</h4>
                    <p style="margin: 0;">Your subscription was successful, but there may be issues with SMS delivery. 
                    We'll try to send notifications when you track a bus.</p>
                </div>
                ${notificationPanel.innerHTML}
            `;
        });
});

// Make the track bus function globally available
window.trackBus = trackBus;
window.retryLastNotification = retryLastNotification;
</script>
</body>
</html>