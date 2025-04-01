<?php
$page_name = 'about us';  
include('../pages/header.php');
?>
<body>
    <div class="containerv">
        <div class="he">
            <h2>Check our schedules each and every where</h2>
        </div>
        <div class="calendar">
            <div class="calendar-header">
                <button id="prev-month">◀ </button>
                <h2 id="current-month">March 2025</h2>
                <button id="next-month"> ▶</button>
            </div>
            <div class="calendar-grid" id="calendar-days"></div>
        </div>
    </div>

    <div id="schedule-modal">
        <div class="schedule-content">
            <h3 id="modal-date" style="text-align: center; color: var(--primary-color);"></h3>
            <div id="schedule-details"></div>
            <button onclick="closeModal()" style="
                display: block; 
                margin: 20px auto; 
                background-color: var(--accent-color); 
                color: white; 
                border: none; 
                padding: 10px 20px; 
                border-radius: 5px;">
                Close
            </button>
        </div>
    </div>
    <?php
    include('../pages/footer.php');  // Include footer.php
    ?>
    <script>
        const busSchedules = {};

        function generateBusSchedules(year) {
            const monthsWithSchedule = [3, 4]; // March and April for demonstration
            const morningRoutes = [
                {
                    route: "Lilongwe to Blantyre",
                    departure: "06:00 AM",
                    arrival: "12:00 PM"
                },
                {
                    route: "Mzuzu to Zomba",
                    departure: "08:00 AM", 
                    arrival: "02:00 PM"
                }
            ];

            const afternoonRoutes = [
                {
                    route: "Blantyre to Lilongwe",
                    departure: "12:00 PM",
                    arrival: "06:00 PM"
                },
                {
                    route: "Zomba to Mzuzu",
                    departure: "02:00 PM",
                    arrival: "08:00 PM"
                }
            ];

            monthsWithSchedule.forEach(month => {
                const daysInMonth = new Date(year, month, 0).getDate();
                const noServiceDays = daysInMonth === 31 ? 3 : (daysInMonth === 30 ? 2 : 0);
                
                const noBusDays = new Set();
                while(noBusDays.size < noServiceDays) {
                    noBusDays.add(Math.floor(Math.random() * daysInMonth) + 1);
                }

                for (let day = 1; day <= daysInMonth; day++) {
                    const formattedDate = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                    
                    if (noBusDays.has(day)) {
                        busSchedules[formattedDate] = {
                            notice: "Company Annual Meeting - Reduced Services. Please check with our local office for alternative arrangements."
                        };
                    } else {
                        busSchedules[formattedDate] = { 
                            routes: [...morningRoutes, ...afternoonRoutes] 
                        };
                    }
                }
            });
        }

        function generateCalendar(date) {
            const calendar = document.getElementById('calendar-days');
            const monthDisplay = document.getElementById('current-month');
            
            // Clear previous calendar
            calendar.innerHTML = '';
            
            // Set month display
            monthDisplay.textContent = date.toLocaleString('default', { month: 'long', year: 'numeric' });
            
            // Get first and last day of month
            const firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
            const lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
            
            // Add day names
            const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            dayNames.forEach(day => {
                const dayEl = document.createElement('div');
                dayEl.textContent = day;
                dayEl.classList.add('day-names');
                calendar.appendChild(dayEl);
            });
            
            // Add empty cells for days before first day
            for (let i = 0; i < firstDay.getDay(); i++) {
                calendar.appendChild(document.createElement('div'));
            }
            
            // Create day cells
            for (let day = 1; day <= lastDay.getDate(); day++) {
                const dayEl = document.createElement('div');
                dayEl.classList.add('calendar-day');
                dayEl.textContent = day;
                
                // Format date for checking schedules
                const formattedDate = `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                
                // Check if this date has a schedule or notice
                const daySchedule = busSchedules[formattedDate];
                if (daySchedule) {
                    if (daySchedule.routes) {
                        dayEl.classList.add('has-schedule');
                    } else if (daySchedule.notice) {
                        dayEl.classList.add('no-bus');
                    }
                }
                
                dayEl.addEventListener('click', () => showScheduleModal(formattedDate));
                
                calendar.appendChild(dayEl);
            }
        }

        function showScheduleModal(date) {
            const modal = document.getElementById('schedule-modal');
            const modalDate = document.getElementById('modal-date');
            const scheduleDetails = document.getElementById('schedule-details');
            
            // Format date for display
            const displayDate = new Date(date);
            modalDate.textContent = displayDate.toLocaleDateString('en-US', { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
            
            // Get schedules for this date
            const daySchedule = busSchedules[date];
            
            if (daySchedule) {
                if (daySchedule.routes) {
                    // Display routes
                    scheduleDetails.innerHTML = daySchedule.routes.map(schedule => `
                        <div class="route-info">
                            <h4>${schedule.route}</h4>
                            <p>Departure: ${schedule.departure}</p>
                            <p>Arrival: ${schedule.arrival}</p>
                        </div>
                    `).join('');
                } else if (daySchedule.notice) {
                    // Display notice
                    scheduleDetails.innerHTML = `
                        <div class="schedule-notice">
                            <h4>Important Notice</h4>
                            <p>${daySchedule.notice}</p>
                        </div>
                    `;
                }
            } else {
                scheduleDetails.innerHTML = '<p>No specific bus information available for this date.</p>';
            }
            
            modal.style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('schedule-modal').style.display = 'none';
        }

        // Navigation
        document.getElementById('prev-month').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            generateCalendar(currentDate);
        });

        document.getElementById('next-month').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            generateCalendar(currentDate);
        });

        // Generate schedules and initial calendar
        generateBusSchedules(2025);
        let currentDate = new Date();
        generateCalendar(currentDate);
    </script>
</body>
</html>