<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile App Slideshow</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f2f5;
        }
        .mobile-container {
            width: 80%;
            height: 812px;
            background-color: white;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            overflow: hidden;
            position: relative;
        }
        .slideshow-container {
            width: 100%;
            height: 100%;
            position: relative;
        }
        .slide {
            width: 100%;
            height: 100%;
            /* position: absolute; */
            top: 0;
            left: 0;
            opacity: 0;
            transition: opacity 0.8s ease-in-out;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            text-align: center;
        }
        .slide.active {
            opacity: 1;
        }
        .slide-image {
            width: 80%;
            height: 250px;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            margin-bottom: 30px;
        }
        .slide-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }
        .slide-description {
            font-size: 16px;
            color: #666;
            max-width: 300px;
            line-height: 1.6;
        }
        .navigation {
            position: absolute;
            bottom: 40px;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .dot {
            width: 10px;
            height: 10px;
            background-color: #ddd;
            border-radius: 50%;
            margin: 0 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .dot.active {
            background-color: #007aff;
            width: 16px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="mobile-container">
        <div class="slideshow-container" id="slideshowContainer">
            <div class="slide active" data-slide="0">
                <div class="slide-image" style="background-image: url('1.jpeg');"></div>
                <h2 class="slide-title">Welcome to Our App</h2>
                <p class="slide-description">Discover amazing features and seamless experience in one powerful app.</p>
            </div>
            <div class="slide" data-slide="1">
                <div class="slide-image" style="background-image: url('2.jpeg');"></div>
                <h2 class="slide-title">Easy Navigation</h2>
                <p class="slide-description">Intuitive interface designed to make your journey smooth and enjoyable.</p>
            </div>
            <div class="slide" data-slide="2">
                <div class="slide-image" style="background-image: url('3.jpeg');"></div>
                <h2 class="slide-title">Powerful Tools</h2>
                <p class="slide-description">Access cutting-edge tools that transform the way you work and play.</p>
            </div>
            <div class="slide" data-slide="3">
                <div class="slide-image" style="background-image: url('4.jpeg');"></div>
                <h2 class="slide-title">Get Started</h2>
                <p class="slide-description">Join thousands of users and elevate your digital experience today!</p>
            </div>
        </div>

        <div class="navigation">
            <div class="dot active" data-slide="0"></div>
            <div class="dot" data-slide="1"></div>
            <div class="dot" data-slide="2"></div>
            <div class="dot" data-slide="3"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const slides = document.querySelectorAll('.slide');
            const dots = document.querySelectorAll('.dot');
            let currentSlide = 0;
            let slideInterval;

            function changeSlide(newSlide) {
                // Remove active class from current slide and dot
                slides[currentSlide].classList.remove('active');
                dots[currentSlide].classList.remove('active');

                // Set new current slide
                currentSlide = newSlide;

                // Add active class to new slide and dot
                slides[currentSlide].classList.add('active');
                dots[currentSlide].classList.add('active');
            }

            function nextSlide() {
                let newSlide = (currentSlide + 1) % slides.length;
                changeSlide(newSlide);
            }

            // Automatic slideshow
            function startSlideshow() {
                slideInterval = setInterval(nextSlide, 3000);
            }

            // Stop slideshow on user interaction
            function stopSlideshow() {
                clearInterval(slideInterval);
            }

            // Add click event to dots
            dots.forEach(dot => {
                dot.addEventListener('click', () => {
                    stopSlideshow();
                    const slideIndex = parseInt(dot.getAttribute('data-slide'));
                    changeSlide(slideIndex);
                    startSlideshow();
                });
            });

            // Start the slideshow
            startSlideshow();
        });
    </script>
</body>
</html>