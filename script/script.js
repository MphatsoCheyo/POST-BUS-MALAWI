// Logout function
function logout() {
    // Confirm logout
    if (confirm('Are you sure you want to logout?')) {
        // In a real application, you would:
        // 1. Destroy server-side session
        // 2. Clear client-side session/local storage

        // Redirect to splash page
        window.location.href = 'splash.php'; // Assuming your splash screen is splash.php
    }
}

// Navigation drawer toggle
function toggleNav() {
    const navDrawer = document.getElementById('navDrawer');
    if (navDrawer) {
        navDrawer.classList.toggle('open');
    }
}

// Close nav drawer when clicking outside
document.addEventListener('click', function(event) {
    const navDrawer = document.getElementById('navDrawer');
    const hamburger = document.querySelector('.hamburger');
    
    if (navDrawer && hamburger && !navDrawer.contains(event.target) && !hamburger.contains(event.target) && navDrawer.classList.contains('open')) {
        navDrawer.classList.remove('open');
    }
});

// Location-based promotions
function getUserLocation() {
    const banners = document.querySelectorAll('.promo-banner[data-location]');
    
    const locations = ['Lilongwe', 'Blantyre', 'Mzuzu', 'Zomba'];
    const userLocation = locations[Math.floor(Math.random() * locations.length)];
    
    console.log('User detected in:', userLocation);
    
    banners.forEach(banner => {
        if (banner.dataset.location === userLocation) {
            banner.classList.add('active');
        }
    });
}

// Run on page load
document.addEventListener('DOMContentLoaded', function() {
    getUserLocation();
    
    // Set up dismissible banners
    const promoCtas = document.querySelectorAll('.promo-cta');
    promoCtas.forEach(cta => {
        cta.addEventListener('click', function() {
            alert('Taking you to the promotion details!');
        });
    });

    // Slider functionality
    const swimSlides = document.getElementById('swimSlides');
    const indicators = document.querySelectorAll('.swim-slide-indicator');
    if (swimSlides && indicators.length > 0) {
        let currentSlide = 0;
        const totalSlides = indicators.length;
        function changeSlide(newSlide) {
            swimSlides.style.transform = `translateX(-${newSlide * 100}%)`;
            indicators.forEach(indicator => indicator.classList.remove('active'));
            indicators[newSlide].classList.add('active');
            currentSlide = newSlide;
        }

        function nextSlide() {
            // Increment currentSlide by 1 and ensure it loops back to 0 after the last slide
            currentSlide = (currentSlide + 1) % totalSlides;
            
            // Change the slide by passing the new slide index
            changeSlide(currentSlide);
        }
        

        // Auto slide every 3 seconds
        setInterval(nextSlide, 3000);

        // Add click event to indicators
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => changeSlide(index));
        });
    }

    // Back to top button functionality
    const backToTopButton = document.getElementById('backToTop');
    if (backToTopButton) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTopButton.classList.add('visible');
            } else {
                backToTopButton.classList.remove('visible');
            }
        });
    }

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    
    const searchData = [
        { type: 'route', name: 'Lilongwe to Blantyre', url: 'booking.php?from=Lilongwe&to=Blantyre' },
        { type: 'route', name: 'Blantyre to Mzuzu', url: 'booking.php?from=Blantyre&to=Mzuzu' },
        { type: 'route', name: 'Zomba to Lilongwe', url: 'booking.php?from=Zomba&to=Lilongwe' },
        { type: 'route', name: 'Mzuzu to Blantyre', url: 'booking.php?from=Mzuzu&to=Blantyre' },
        { type: 'route', name: 'Lilongwe to Mzuzu', url: 'booking.php?from=Lilongwe&to=Mzuzu' },
        { type: 'route', name: 'Zomba to Salima', url: 'booking.php?from=Zomba&to=Salima' },
        { type: 'city', name: 'Lilongwe', url: 'city.php?name=Lilongwe' },
        { type: 'city', name: 'Blantyre', url: 'city.php?name=Blantyre' },
        { type: 'city', name: 'Mzuzu', url: 'city.php?name=Mzuzu' },
        { type: 'city', name: 'Zomba', url: 'city.php?name=Zomba' },
        { type: 'city', name: 'Salima', url: 'city.php?name=Salima' },
        { type: 'bus', name: 'Express Coach', url: 'bus.php?type=Express' },
        { type: 'bus', name: 'Premium Bus', url: 'bus.php?type=Premium' },
        { type: 'bus', name: 'Standard Coach', url: 'bus.php?type=Standard' },
        { type: 'bus', name: 'Executive Bus', url: 'bus.php?type=Executive' }
    ];

    if (searchInput) {
        searchInput.addEventListener('input', () => {
            const query = searchInput.value.toLowerCase().trim();
            
            if (query.length < 2) {
                searchResults.style.display = 'none';
                return;
            }
            
            const filteredResults = searchData.filter(item => item.name.toLowerCase().includes(query));
            
            searchResults.innerHTML = '';
            
            if (filteredResults.length === 0) {
                searchResults.innerHTML = '<div class="no-results">No results found</div>';
            } else {
                filteredResults.forEach(result => {
                    const resultItem = document.createElement('div');
                    resultItem.className = 'search-result-item';
                    
                    let icon = '';
                    if (result.type === 'route') {
                        icon = '<i class="fas fa-route"></i>';
                    } else if (result.type === 'city') {
                        icon = '<i class="fas fa-city"></i>';
                    } else if (result.type === 'bus') {
                        icon = '<i class="fas fa-bus"></i>';
                    }
                    
                    resultItem.innerHTML = `${icon} ${result.name}`;
                    
                    resultItem.addEventListener('click', () => {
                        window.location.href = result.url;
                    });
                    
                    searchResults.appendChild(resultItem);
                });
            }
            
            searchResults.style.display = 'block';
        });
    }

    // Hide search results when clicking outside
    document.addEventListener('click', (event) => {
        if (!searchInput.contains(event.target) && !searchResults.contains(event.target)) {
            searchResults.style.display = 'none';
        }
    });
});

// Wait until the DOM is fully loaded
document.addEventListener('DOMContentLoaded', () => {
    let currentSlide = 0; // Initial slide index
    const slides = document.querySelectorAll('.slide'); // Replace '.slide' with your actual slide class or selector
    
    // Only initialize slideshow if slides exist on the page
    if (slides && slides.length > 0) {
        const totalSlides = slides.length;

        // Function to change slide
        function changeSlide(index) {
            slides.forEach((slide, i) => {
                if (i === index) {
                    slide.style.display = 'block'; // Show the current slide
                } else {
                    slide.style.display = 'none'; // Hide all other slides
                }
            });
        }

        // Function to go to the next slide
        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides; // Loop back to the first slide
            changeSlide(currentSlide);
        }

        // Initial slide setup
        changeSlide(currentSlide);

        // Look for next button only if we have slides
        const nextButton = document.querySelector('.next-button'); // Replace '.next-button' with your button's selector
        if (nextButton) {
            nextButton.addEventListener('click', nextSlide);
        }
    }
});

// Function to navigate to seat selection page after validation
function showPage() {
    // Validate form fields
    const departure = document.getElementById("departure").value;
    const destination = document.getElementById("destination").value;
    const travelDate = document.getElementById("travel-date").value;
    const travelTime = document.getElementById("travel-time").value;
    
    if (!departure || !destination || !travelDate || !travelTime) {
        alert("Please complete all fields before continuing.");
        return;
    }
    
    if (departure === destination) {
        alert("Departure and destination cannot be the same.");
        return;
    }
    
    // Get form data and convert to JSON
    const formData = {
        departure: departure,
        destination: destination,
        travel_date: travelDate,
        travel_time: travelTime
    };
    
    // Submit the form via AJAX
    fetch("submite-booking.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        console.log("Response:", data);
        if (data.success) {
            // Store relevant data in localStorage
            localStorage.setItem('selectedRoute', departure + " to " + destination);
            localStorage.setItem('travelDate', new Date(travelDate).toLocaleDateString('en-US', {day: 'numeric', month: 'short', year: 'numeric'}));
            localStorage.setItem('departureTime', travelTime);
            
            // Calculate estimated arrival time
            const arrivalTime = calculateArrivalTime(travelTime);
            localStorage.setItem('arrivalTime', arrivalTime);
            
            // Redirect to seat selection page
            window.location.href = "seat.php?booking_code=" + data.booking_code;
        } else {
            alert("Error: " + data.message);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("An error occurred while processing your booking. Please try again.");
    });
}

// Helper function to calculate estimated arrival time
function calculateArrivalTime(departureTime) {
    // Parse the departure time
    const [hours, minutes] = departureTime.split(':').map(Number);
    
    // Add journey time (assuming 4 hours 15 minutes)
    let arrivalHours = hours + 4;
    let arrivalMinutes = minutes + 15;
    
    // Adjust if minutes overflow
    if (arrivalMinutes >= 60) {
        arrivalHours += 1;
        arrivalMinutes -= 60;
    }
    
    // Format with AM/PM
    const period = arrivalHours >= 12 ? 'PM' : 'AM';
    const formattedHours = arrivalHours > 12 ? arrivalHours - 12 : arrivalHours;
    
    // Return formatted time
    return `${formattedHours}:${arrivalMinutes.toString().padStart(2, '0')} ${period}`;
}
