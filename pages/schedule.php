<?php
$page_name = 'bus schedule page';  // Set the current page name
include('../pages/header.php');
?>
    
    <div class="containe">
        <h2>POST COACH Timetables & Fares</h2>
        
        <div class="route-selector">
            <button onclick="showRoute('blantyre-mzuzu')">Blantyre to Mzuzu</button>
            <button onclick="showRoute('mzuzu-blantyre')">Mzuzu to Blantyre</button>
            <button onclick="showRoute('mzuzu-karonga')">Mzuzu to Karonga</button>
            <button onclick="showRoute('karonga-mzuzu')">Karonga to Mzuzu</button>
            <button onclick="showRoute('lilongwe-blantyre')">Lilongwe to Blantyre</button>
        </div>

        <div id="routes">
            <div id="blantyre-mzuzu" class="route-section">
                <h2>From Blantyre to Mzuzu via Lilongwe</h2>
                <table>
                    <tr>
                        <th>Route Stops</th>
                        <th>Booking Deadline</th>
                        <th>Departure Time</th>
                        <th>Fare (MK)</th>
                    </tr>
                    <tr><td>Zalewa</td><td>18:00</td><td>18:30</td><td>5,000</td></tr>
                    <tr><td>Chingeni</td><td>18:00</td><td>18:30</td><td>7,000</td></tr>
                    <tr><td>Ntcheu</td><td>18:00</td><td>18:30</td><td>8,000</td></tr>
                    <tr><td>Dedza</td><td>18:00</td><td>18:30</td><td>12,000</td></tr>
                    <tr><td>Lilongwe</td><td>18:00</td><td>18:30</td><td>14,000</td></tr>
                    <tr><td>Kasungu</td><td>18:00</td><td>18:30</td><td>20,000</td></tr>
                    <tr><td>Jenda</td><td>18:00</td><td>18:30</td><td>22,000</td></tr>
                    <tr><td>Mzimba</td><td>18:00</td><td>18:30</td><td>23,000</td></tr>
                    <tr><td>Mzuzu</td><td>18:00</td><td>18:30</td><td>25,000</td></tr>
                </table>
            </div>

            <div id="mzuzu-blantyre" class="route-section" style="display:none;">
                <h2>From Mzuzu to Blantyre via Lilongwe</h2>
                <table>
                    <tr>
                        <th>Route Stops</th>
                        <th>Booking Deadline</th>
                        <th>Departure Time</th>
                        <th>Fare (MK)</th>
                    </tr>
                    <tr><td>Mzimba</td><td>18:00</td><td>18:30</td><td>7,000</td></tr>
                    <tr><td>Jenda</td><td>18:00</td><td>18:30</td><td>10,000</td></tr>
                    <tr><td>Kasungu</td><td>18:00</td><td>18:30</td><td>13,000</td></tr>
                    <tr><td>Lilongwe</td><td>18:00</td><td>18:30</td><td>15,000</td></tr>
                    <tr><td>Dedza</td><td>18:00</td><td>18:30</td><td>17,000</td></tr>
                    <tr><td>Ntcheu</td><td>18:00</td><td>18:30</td><td>18,000</td></tr>
                    <tr><td>Chingeni</td><td>18:00</td><td>18:30</td><td>20,000</td></tr>
                    <tr><td>Zalewa</td><td>18:00</td><td>18:30</td><td>23,000</td></tr>
                    <tr><td>Blantyre</td><td>18:00</td><td>18:30</td><td>25,000</td></tr>
                </table>
            </div>

            <div id="mzuzu-karonga" class="route-section" style="display:none;">
                <h2>From Mzuzu to Karonga</h2>
                <table>
                    <tr>
                        <th>Route Stops</th>
                        <th>Booking Deadline</th>
                        <th>Departure Time</th>
                        <th>Fare (MK)</th>
                    </tr>
                    <tr><td>Ekwendeni</td><td>5:30</td><td>6:00</td><td>2,000</td></tr>
                    <tr><td>Bwengu</td><td>5:30</td><td>6:00</td><td>4,000</td></tr>
                    <tr><td>Phwezi</td><td>5:30</td><td>6:00</td><td>5,000</td></tr>
                    <tr><td>Chiweta</td><td>5:30</td><td>6:00</td><td>6,000</td></tr>
                    <tr><td>Chitimba</td><td>5:30</td><td>6:00</td><td>7,500</td></tr>
                    <tr><td>Uliwa</td><td>5:30</td><td>6:00</td><td>8,000</td></tr>
                    <tr><td>Karonga</td><td>5:30</td><td>6:00</td><td>9,000</td></tr>
                </table>
            </div>

            <div id="karonga-mzuzu" class="route-section" style="display:none;">
                <h2>From Karonga to Mzuzu</h2>
                <table>
                    <tr>
                        <th>Route Stops</th>
                        <th>Booking Deadline</th>
                        <th>Departure Time</th>
                        <th>Fare (MK)</th>
                    </tr>
                    <tr><td>Uliwa</td><td>12:30</td><td>13:00</td><td>2,000</td></tr>
                    <tr><td>Chitimba</td><td>12:30</td><td>13:00</td><td>4,000</td></tr>
                    <tr><td>Chiweta</td><td>12:30</td><td>13:00</td><td>4,500</td></tr>
                    <tr><td>Phwezi</td><td>12:30</td><td>13:00</td><td>8,000</td></tr>
                    <tr><td>Bwengu</td><td>12:30</td><td>13:00</td><td>8,500</td></tr>
                    <tr><td>Ekwendeni</td><td>12:30</td><td>13:00</td><td>9,000</td></tr>
                    <tr><td>Mzuzu</td><td>12:30</td><td>13:00</td><td>9,000</td></tr>
                </table>
            </div>

            <div id="lilongwe-blantyre" class="route-section" style="display:none;">
                <h2>From Lilongwe to Blantyre</h2>
                <table>
                    <tr>
                        <th>Route Stops</th>
                        <th>Booking Deadline</th>
                        <th>Departure Time</th>
                        <th>Fare (MK)</th>
                    </tr>
                    <tr><td>Dedza</td><td>23:00</td><td>23:30</td><td>Included</td></tr>
                    <tr><td>Ntcheu</td><td>23:00</td><td>23:30</td><td>Included</td></tr>
                    <tr><td>Chingeni</td><td>23:00</td><td>23:30</td><td>Included</td></tr>
                    <tr><td>Zalewa</td><td>23:00</td><td>23:30</td><td>Included</td></tr>
                    <tr><td>Blantyre</td><td>23:00</td><td>23:30</td><td>Included</td></tr>
                </table>
            </div>
        </div>

        <div class="section contacts">
            <div class="contact-info">
                <h3>Lilongwe Office</h3>
                <p>Location: Area 3, Post Office, Lilongwe</p>
                <p>Phone: +265 (0) 994 168 157</p>
            </div>
            <div class="contact-info">
                <h3>Blantyre Office</h3>
                <p>Location: Chichiri Post Office, Along Chichiri Ginnery Corner, Blantyre</p>
                <p>Phone: +265 (0) 994 168 158</p>
            </div>
            <div class="contact-info">
                <h3>Mzuzu Office</h3>
                <p>Location: Mzuzu Post Office, Near Kanjedza Drive, Mzuzu</p>
                <p>Phone: +265 (0) 994 168 154</p>
            </div>
        </div>

        <p style="text-align:center; color:#888;">Schedules and Fares as of April 2023</p>
    </div>
    <?php
    include('../pages/footer.php');  // Include footer.php
    ?>
    
    <script src="../script/java.js"></script>
    <script src="../script/script.js"></script>
    <script>
        function showRoute(routeId) {
            // Hide all route sections
            const routeSections = document.querySelectorAll('.route-section');
            routeSections.forEach(section => {
                section.style.display = 'none';
            });

            // Deactivate all buttons
            const buttons = document.querySelectorAll('.route-selector button');
            buttons.forEach(button => {
                button.classList.remove('active');
            });

            // Show selected route section
            const selectedRoute = document.getElementById(routeId);
            selectedRoute.style.display = 'block';

            // Activate selected button
            const selectedButton = document.querySelector(`button[onclick="showRoute('${routeId}')"]`);
            selectedButton.classList.add('active');
        }

        // Set default route on page load
        document.addEventListener('DOMContentLoaded', () => {
            showRoute('blantyre-mzuzu');
        });
    </script>
</body>
</html>