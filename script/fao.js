
document.addEventListener("DOMContentLoaded", function() {
    // Initialize the map
    const map = L.map('map').setView([-13.9631, 33.7741], 6); // Centered on Malawi

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Bus Route Markers
    const routes = [
        { name: "Lilongwe - Blantyre", coords: [-13.9631, 33.7741], desc: "Main intercity route." },
        { name: "Mzuzu - Lilongwe", coords: [-11.4500, 34.0194], desc: "Scenic northern route." },
        { name: "Blantyre - Zomba", coords: [-15.7861, 35.0058], desc: "Short route." },
        { name: "Lilongwe - Mangochi", coords: [-14.4781, 35.2637], desc: "Lake-side route." },
        { name: "Mzuzu - Blantyre", coords: [-16.0678, 34.8458], desc: "Long-distance route." }
    ];

    // Add markers for each route
    routes.forEach(route => {
        L.marker(route.coords)
            .addTo(map)
            .bindPopup(`<b>${route.name}</b><br>${route.desc}`);
    });
});
    // JavaScript for FAQ toggling
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle FAQ answers
        const faqQuestions = document.querySelectorAll('.faq-question');
        faqQuestions.forEach(question => {
            question.addEventListener('click', function() {
                const answerId = this.getAttribute('data-toggle');
                const answer = document.getElementById(answerId);
                
                this.classList.toggle('active');
                this.querySelector('.toggle-icon').classList.toggle('active');
                answer.classList.toggle('active');
            });
        });

        // Quick links filtering
        const quickLinks = document.querySelectorAll('.quick-link');
        quickLinks.forEach(link => {
            link.addEventListener('click', function() {
                const category = this.getAttribute('data-category');
                
                // Remove active class from all links
                quickLinks.forEach(link => link.classList.remove('active'));
                
                // Add active class to clicked link
                this.classList.add('active');
                
                // Show all items if 'all' category is selected
                if (category === 'all') {
                    document.querySelectorAll('.faq-container').forEach(container => {
                        container.parentElement.style.display = 'block';
                    });
                } else {
                    // Hide all sections first
                    document.querySelectorAll('.faq-section').forEach(section => {
                        section.style.display = 'none';
                    });
                    
                    // Show only the sections with matching category
                    document.querySelectorAll(`.faq-container[data-category="${category}"]`).forEach(container => {
                        container.parentElement.style.display = 'block';
                    });
                }
            });
        });

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const searchBtn = document.getElementById('searchBtn');
        
        searchBtn.addEventListener('click', performSearch);
        searchInput.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });
        
        function performSearch() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            
            if (searchTerm === '') {
                // Reset all highlights
                document.querySelectorAll('.highlight').forEach(el => {
                    el.classList.remove('highlight');
                });
                
                // Show all sections
                document.querySelectorAll('.faq-section').forEach(section => {
                    section.style.display = 'block';
                });
                
                return;
            }
            
            // Show all sections
            document.querySelectorAll('.faq-section').forEach(section => {
                section.style.display = 'block';
            });
            
            // Reset all highlights
            document.querySelectorAll('.highlight').forEach(el => {
                el.classList.remove('highlight');
            });
            
            let foundResults = false;
            
            // Search through questions and answers
            document.querySelectorAll('.faq-item').forEach(item => {
                const question = item.querySelector('.faq-question').textContent.toLowerCase();
                const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
                
                if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                    foundResults = true;
                    
                    // Highlight matching text in question
                    const questionEl = item.querySelector('.faq-question');
                    questionEl.innerHTML = questionEl.innerHTML.replace(
                        new RegExp(searchTerm, 'gi'),
                        match => `<span class="highlight">${match}</span>`
                    );
                    
                    // Highlight matching text in answer
                    const answerEl = item.querySelector('.faq-answer');
                    answerEl.innerHTML = answerEl.innerHTML.replace(
                        new RegExp(searchTerm, 'gi'),
                        match => `<span class="highlight">${match}</span>`
                    );
                    
                    // Open the answer
                    item.querySelector('.faq-question').classList.add('active');
                    item.querySelector('.toggle-icon').classList.add('active');
                    item.querySelector('.faq-answer').classList.add('active');
                }
            });
            
            if (!foundResults) {
                alert('No results found for "' + searchTerm + '"');
            }
        }

        // Side menu functionality
        const menuBtn = document.getElementById('menuBtn');
        const menuClose = document.getElementById('menuClose');
        const sideMenu = document.getElementById('sideMenu');
        const overlay = document.getElementById('overlay');
        
        menuBtn.addEventListener('click', function() {
            sideMenu.classList.add('active');
            overlay.classList.add('active');
        });
        
        menuClose.addEventListener('click', function() {
            sideMenu.classList.remove('active');
            overlay.classList.remove('active');
        });
        
        overlay.addEventListener('click', function() {
            sideMenu.classList.remove('active');
            overlay.classList.remove('active');
        });

        // Back to top button
        const backToTop = document.getElementById('backToTop');
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTop.classList.add('active');
            } else {
                backToTop.classList.remove('active');
            }
        });
        
        backToTop.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });