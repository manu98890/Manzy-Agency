<!--<?php include '../session_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manzy-Agency</title>
        <link rel="stylesheet" href="../res/css/dashboard/index/styles.css">
        <link rel="stylesheet" href="../res/css/dashboard/shedule/styles.css">
    </head>
    <header>
            <navbar class = "navbar">
                <div class = "logo">
                    <img src = "../res/img/logo.png" alt = "logo" class = "logo-img"></img>
                </div>
                <div class = "logo-name">
                    <p class = "logo-name-text">Manzy Agency</p>
                </div>
                <div class = "center-container">
                    <a href = "discover.php" class = "center-text">Discover</a>
                    <a href = "trips.php" class = "center-text">Trips</a>
                    <a href = "#" class = "center-text">Review</a>
                    <a href = "#" class = "center-text">More</a>
                </div>
                <div class = "login-container">
                    <a href = "profile.php" class = "login-btn"><?php echo htmlspecialchars($_SESSION['username']); ?></a>
                </div>
                <div class = "profile-logo">
                    <div class = "prifile-logo-section-fill"></div>
                </div>
            </navbar>
    </header>
    <body>
        <div class = "header-imagee-container"></div>
        <div 
    </body>
</html>-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sri Lanka 7 Days Tour Package</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add custom styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../res/css/dashboard/shedule/styles.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="#"><img src="logo.png" alt="Logo"></a>
            </div>
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="#">Tours</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Blog</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Banner -->
    <section class="hero" style="background-image: url('sri-lanka-tour.jpg');">
        <div class="hero-content">
            <h1>Sri Lanka Tour Package - 7 Days</h1>
            <p>Discover the beauty of Sri Lanka with our exclusive 7-day tour package</p>
            <a href="#booking" class="btn btn-primary">Book Now</a>
        </div>
    </section>

    <!-- Tour Details Section -->
    <section class="tour-details">
        <div class="container">
            <div class="details">
                <h2>Tour Highlights</h2>
                <ul>
                    <li>Duration: 7 Days / 6 Nights</li>
                    <li>Price: $1200 per person</li>
                    <li>Explore Kandy, Ella, and Sigiriya</li>
                    <li>Stay in 4-star hotels</li>
                </ul>
                <a href="#itinerary" class="btn btn-secondary">View Itinerary</a>
            </div>
            <div class="details-image">
                <img src="kandy.jpg" alt="Kandy">
            </div>
        </div>
    </section>

    <!-- Itinerary Section -->
    <section id="itinerary" class="itinerary">
        <div class="container">
            <h2>Day-by-Day Itinerary</h2>

            <div class="day">
                <h3>Day 1: Arrival in Colombo</h3>
                <p>Arrive at Bandaranaike International Airport and transfer to your hotel in Colombo.</p>
            </div>

            <div class="day">
                <h3>Day 2: Colombo to Kandy</h3>
                <p>Explore Colombo before heading to the beautiful hill city of Kandy.</p>
            </div>

            <div class="day">
                <h3>Day 3: Kandy to Ella</h3>
                <p>Take the scenic train ride to Ella, one of the most beautiful journeys in the world.</p>
            </div>

            <div class="day">
                <h3>Day 4: Ella Adventure</h3>
                <p>Enjoy hiking and exploring the stunning landscapes of Ella.</p>
            </div>

            <div class="day">
                <h3>Day 5: Sigiriya Rock Fortress</h3>
                <p>Visit the iconic Sigiriya Rock Fortress and marvel at the ancient architecture.</p>
            </div>

            <div class="day">
                <h3>Day 6: Safari at Yala National Park</h3>
                <p>Embark on a wildlife safari at Yala National Park, home to leopards and elephants.</p>
            </div>

            <div class="day">
                <h3>Day 7: Departure</h3>
                <p>Transfer to the airport for your departure flight.</p>
            </div>
        </div>
    </section>

    <!-- Image Gallery Section -->
    <section class="gallery">
        <h2>Tour Gallery</h2>
        <div class="image-slider">
            <img src="image1.jpg" alt="Tour Image 1">
            <img src="image2.jpg" alt="Tour Image 2">
            <img src="image3.jpg" alt="Tour Image 3">
        </div>
    </section>

    <!-- Reviews Section -->
    <section class="reviews">
        <h2>Customer Reviews</h2>
        <div class="review">
            <p>"This tour was fantastic! We saw so much of Sri Lanka, and the guide was amazing."</p>
            <span>- John Doe</span>
        </div>
        <div class="review">
            <p>"Great experience! The itinerary was well planned and the hotels were excellent."</p>
            <span>- Sarah Jane</span>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq">
        <h2>Frequently Asked Questions</h2>
        <div class="faq-item">
            <h3>What is included in the tour package?</h3>
            <p>The package includes accommodation, breakfast, transportation, and guided tours.</p>
        </div>
        <div class="faq-item">
            <h3>Can I customize the itinerary?</h3>
            <p>Yes, we offer customizable options to suit your preferences.</p>
        </div>
    </section>

    <!-- Booking CTA Section -->
    <section id="booking" class="booking">
        <div class="container">
            <h2>Ready to Book?</h2>
            <a href="#" class="btn btn-primary">Book Now</a>
            <a href="#" class="btn btn-secondary">Contact Us</a>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Your Travel Company. All rights reserved.</p>
    </footer>
</body>
</html>
