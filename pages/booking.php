<?php
$page_name = 'booking';  // Set the current page name
include('../pages/header.php');
?>
</head>
<body>
<div class="ap">
<h2>Book Your Journey</h2>
        <div class="booking-form">
            <h2>Select your route, date, and time</h2>
            
            <div class="selection-status">
                <p id="selectionText">Click on the map to select your departure and destination locations.</p>
            </div>

    <div class="route-container">
        <!-- Map Section -->
        <div class="route-map">
            <div class="map-placeholder" id="map"></div>
        </div>

        <!-- Form Section -->
        <form id="bookingform" method="POST" action="submite-booking.php">
    <div class="form-group">
        <label for="departure">Departure Location</label>
        <select id="departure" name="departure">
            <option value="">Select departure</option>
            <option value="lilongwe">Lilongwe</option>
            <option value="blantyre">Blantyre</option>
            <option value="mzuzu">Mzuzu</option>
            <option value="zomba">Zomba</option>
            <option value="mangochi">Mangochi</option>
        </select>
    </div>

    <div class="form-group">
        <label for="destination">Destination</label>
        <select id="destination" name="destination">
            <option value="">Select destination</option>
            <option value="lilongwe">Lilongwe</option>
            <option value="blantyre">Blantyre</option>
            <option value="mzuzu">Mzuzu</option>
            <option value="zomba">Zomba</option>
            <option value="mangochi">Mangochi</option>
        </select>
    </div>

    <div class="form-group">
        <label for="travel-date">Travel Date</label>
        <input type="date" id="travel-date" name="travel_date">
    </div>
    
    <div class="form-group">
        <label for="travel-time">Departure Time</label>
        <select id="travel-time" name="travel_time">
            <option value="">Select time</option>
            <option value="06:00">06:00 AM</option>
            <option value="08:00">08:00 AM</option>
            <option value="10:00">10:00 AM</option>
            <option value="12:00">12:00 PM</option>
            <option value="14:00">02:00 PM</option>
            <option value="18:00">06:00 PM</option>
        </select>
    </div>
</form>
    </div>
    <button class="button" onclick="showPage()">Continue to Seat Selection</button>
</div>
</div>
<?php
include('../pages/footer.php');  // Include footer.php
?>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="../script/java.js"></script>
<script src="../script/script.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Initialize the map
    var map = L.map('map').setView([-13.9626, 33.7741], 6); // Centered on Malawi

    // Load OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Define locations
    const routes = {
        lilongwe: [-13.9626, 33.7741],
        blantyre: [-15.7861, 35.0058],
        mzuzu: [-11.459, 34.0209],
        zomba: [-15.3854, 35.3186],
        mangochi: [-14.4789, 35.2645]
    };

    let currentRoute = null; // To store the drawn route

    document.getElementById("departure").addEventListener("change", updateMap);
    document.getElementById("destination").addEventListener("change", updateMap);

    // Create a variable to store selected departure and destination
    let selectedDeparture = null;
    let selectedDestination = null;

    function updateMap() {
        let departure = document.getElementById("departure").value;
        let destination = document.getElementById("destination").value;

        if (departure && destination) {
            let depCoords = routes[departure];
            let destCoords = routes[destination];

            if (currentRoute) {
                map.removeLayer(currentRoute); // Remove previous route
            }

            currentRoute = L.polyline([depCoords, destCoords], { color: 'blue', weight: 5 }).addTo(map);
            map.fitBounds(currentRoute.getBounds());
        }
    }

    // Map click event listener to select departure and destination
    map.on('click', function(e) {
        let clickedLatLng = e.latlng;
        let closestLocation = getClosestLocation(clickedLatLng);

        // If departure is not selected, set it as the departure location
        if (!selectedDeparture) {
            selectedDeparture = closestLocation;
            document.getElementById("departure").value = closestLocation;
        } else if (!selectedDestination) {
            selectedDestination = closestLocation;
            document.getElementById("destination").value = closestLocation;
        }

        // Update the map route after selecting both locations
        if (selectedDeparture && selectedDestination) {
            let depCoords = routes[selectedDeparture];
            let destCoords = routes[selectedDestination];

            if (currentRoute) {
                map.removeLayer(currentRoute); // Remove previous route
            }

            currentRoute = L.polyline([depCoords, destCoords], { color: 'blue', weight: 5 }).addTo(map);
            map.fitBounds(currentRoute.getBounds());
        }
    });

    // Function to find the closest location based on the clicked coordinates
    function getClosestLocation(clickedLatLng) {
        let closest = null;
        let minDistance = Infinity;

        for (let location in routes) {
            let locCoords = routes[location];
            let distance = map.distance(clickedLatLng, locCoords);

            if (distance < minDistance) {
                minDistance = distance;
                closest = location;
            }
        }

        return closest;
    }

    // Fix form submission listener
    document.getElementById("bookingform").addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent default form submission

        let formData = new FormData(this);

        fetch("submite_booking.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json()) // Expecting a JSON response
        .then(data => {
            if (data.success) {
                window.location.href = "sit.php"; // Redirect to seat selection
            } else {
                console.log(data.message);
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });
    });

    // Fix "Continue" button functionality
    document.querySelector(".button").addEventListener("click", function () {
        document.getElementById("bookingform").submit(); // Submit the form
    });
});
</script>

</body>
</html>
