<?php include '../session_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manzy-Agency</title>
        <link rel="stylesheet" href="../res/css/dashboard/profile/styles.css">
    </head>
    <body>
        <header>
            <navbar class = "navbar">
                <div class = "logo-container"></div>
                <div class = "logo-name-container">
                    <a class = "logo-name" href = "index.php">Manzy Agenzy</a>
                </div>
                <div class = "search-bar">
                    <div class = "search-icon-container"></div>
                    <div class = "input-field">
                        <input class = "search-input" placeholder = "Search">
                    </div>
                </div>
                <div class = "discover-btn">
                    <a class = "discover-class" href = "discover.php">Discover</a>
                </div>
                <div class = "discover-btn">
                    <a class = "discover-class" href = "trips.php">Trips</a>
                </div>
                <div class = "discover-btn">
                    <a class = "discover-class">Reviews</a>
                </div>
                <div class = "name-btn">
                    <a class = "discover-class">@<?php echo htmlspecialchars($_SESSION['username']); ?></a>
                </div>
                <div class = "profile-container">
                    
                </div>
            </navbar>
        </header>
        <main>
            <section class = "top-of-the-section">
                <div class ="hotel-section">
                    <a class = "names-section-on-top" href = "hotels.php"  style = "text-decoration:none; color:black;">Hotels</a>
                </div>
                <div class ="hotel-section">
                    <p class = "names-section-on-top">Rooms</p>
                </div>
                <div class ="hotel-section">
                    <p class = "names-section-on-top">Package</p>
                </div>
                <div class ="hotel-section hotel-section-big">
                    <p class = "names-section-on-top">Activities</p>
                </div>
                <div class ="hotel-section hotel-section-big">
                    <p class = "names-section-on-top">Contact Us</p>
                </div>
                <div class ="hotel-section hotel-section-big">
                    <p class = "names-section-on-top">About Us</p>
                </div>
            </section>
            <section class = "second-header-section">
                <div class = "profile-photo-section"></div>
                <div class = "profile-name-section-container">
                    <p class = "profile-name-section"><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                </div>
                <div class = "profile-username-section-container">
                    <p class = "profile-username-section">@<?php echo htmlspecialchars($_SESSION['username']); ?></p>
                </div>
                <div class = "secondary-headers-section-container">
                    <div class = "header-blocks-section-container">
                        <p class = "header-block-name">Trips</p>
                    </div>
                    <div class = "header-blocks-section-container">
                        <p class = "header-block-name">Hotels</p>
                    </div>
                    <div class = "header-blocks-section-container">
                        <p class = "header-block-name">Rooms</p>
                    </div>
                    <div class = "header-blocks-section-container">
                        <p class = "header-block-name">Activity</p>
                    </div>
                    <div class = "header-blocks-section-container">
                        <p class = "header-block-name">Package</p>
                    </div>
                    <div class = "secondary-headers-section-answer-container">
                        <div class = "header-blocks-section-container2">
                            <p class = "header-block-name">0</p>
                        </div>
                        <div class = "header-blocks-section-container2">
                            <p class = "header-block-name">0</p>
                        </div>
                        <div class = "header-blocks-section-container2">
                            <p class = "header-block-name">0</p>
                        </div>
                        <div class = "header-blocks-section-container2">
                            <p class = "header-block-name">0</p>
                        </div>
                        <div class = "header-blocks-section-container2">
                            <p class = "header-block-name">0</p>
                        </div>
                    </div>
                </div>
                <div class = "profile-loader"></div>
                <div class = "bottom-header-button-section-container">
                    <div class = "bottom-header-button">
                        <a class = "name-bottom-header">Activity Feed</a>
                    </div>
                    <div class = "bottom-header-button">
                        <a class = "name-bottom-header" href = "activate.php">Activate Trips</a>
                    </div>
                    <div class = "bottom-header-button">
                        <a class = "name-bottom-header">Booked Hotels</a>
                    </div>
                    <div class = "bottom-header-button">
                        <a class = "name-bottom-header">Booked Rooms</a>
                    </div>
                    <div class = "bottom-header-button">
                        <a class = "name-bottom-header" href = "show_booking.php">Your Bookings</a>
                    </div>
                </div>
            </section>
            <section class = "third-header-section-left-container">
                <div class = "intro-section-container">
                    <p class = "intro-section">Intro</p>
                </div>
                <div class = "secondary-section-container">
                    <div class = "left-container-svg"></div>
                    <div class = "left-container-details">
                        <p class = "left-details-section">Colombo, Sri Lanka</p>
                    </div>
                </div>
                <div class = "secondary-section-container">
                    <div class = "left-container-svg calender"></div>
                    <div class = "left-container-details ">
                        <p class = "left-details-section">Joined in August 2024</p>
                    </div>
                </div>
                <div class = "secondary-section-container">
                    <div class = "left-container-svg add"></div>
                    <div class = "left-container-details">
                        <p class = "left-details-section">Add Website</p>
                    </div>
                </div>
                <div class = "secondary-section-container">
                    <div class = "left-container-svg add"></div>
                    <div class = "left-container-details">
                        <p class = "left-details-section">Write some details about you</p>
                    </div>
                </div>
            </section>
            <section class = "weather-bar-section">
                <section class = "top-section-container-on-weather4">
                    <?php
                        // Your OpenWeather API Key
                        $apiKey = "c61ad36fccf665078fbcb4daff067985";

                        // City for which you want to get the weather
                        $city = "Sri lanka";
                        // Encode the city name for the URL
                        $encodedCity = urlencode($city);

                        // API endpoint with city and API key parameters
                        $apiUrl = "http://api.openweathermap.org/data/2.5/weather?q={$encodedCity}&appid={$apiKey}";

                        $response = file_get_contents($apiUrl);
                        $data = json_decode($response, true);

                        if ($data && $data['cod'] == 200) {
                            $iconCode = $data['weather'][0]['icon'];
                            $weatherDescription = $data['weather'][0]['description'];
                            $temperature = $data['main']['temp'];
                            $humidity = $data['main']['humidity'];
                            $windSpeed = $data['wind']['speed'];

                            // Construct the icon URL
                            $iconUrl = "http://openweathermap.org/img/wn/{$iconCode}@2x.png";
                        
                    ?>
                        <div class = "header-name-container">
                            <p class = "header-name">Trincomalee</p>
                        </div>
                        <div class = "weather-bar">
                            <div class = "weather-type-image">
                            <img src="<?php echo $iconUrl; ?>" alt="Weather icon" class="weather-icon">
                            </div>
                            <div class = "weather-type-name">
                                <p class = "weather-type-name-details"><?php echo $weatherDescription; ?></p>
                            </div>
                            <div class = "temperature-icon-container"></div>
                            <div class = "weather-type-name">
                                <p class = "weather-type-name-details"><?php echo $temperature; ?>K</p>
                            </div>
                            <div class = "humidity-icon-container"></div>
                            <div class = "weather-type-name">
                                <p class = "weather-type-name-details"><?php echo $humidity; ?>%</p>
                            </div>
                            <div class = "wind-icon-container"></div>
                            <div class = "weather-type-name">
                                <p class = "weather-type-name-details"><?php echo $windSpeed; ?>m/s</p>
                            </div>
                        </div>
                    <?php 
                        } else {
                            echo "<p>Error: Unable to fetch weather data.</p>";
                        }
                    ?>
                </section>
            </section>
        </main>
        <footer>

        </footer>
    </body>
</html>