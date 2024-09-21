<?php include '../session_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manzy-Agency</title>
        <link rel="stylesheet" href="../res/css/dashboard/index/styles.css">
        <link rel="stylesheet" href="../res/css/dashboard/discover/styles.css">
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
        <main>
            <section class = "left-section-container"></section>
            <section class = "top-section-container-on-weather">
                <?php
                    // Your OpenWeather API Key
                    $apiKey = "c61ad36fccf665078fbcb4daff067985";

                    // City for which you want to get the weather
                    $city = "Galle";

                    // API endpoint with city and API key parameters
                    $apiUrl = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}";

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
                        <p class = "header-name">Galle</p>
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
            <section class = "top-section-container-on-weather2">
                <?php
                    // Your OpenWeather API Key
                    $apiKey = "c61ad36fccf665078fbcb4daff067985";

                    // City for which you want to get the weather
                    $city = "Nuwara Eliya";
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
                        <p class = "header-name">Nuwara Eliya</p>
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
            <section class = "top-section-container-on-weather3">
                <?php
                    // Your OpenWeather API Key
                    $apiKey = "c61ad36fccf665078fbcb4daff067985";

                    // City for which you want to get the weather
                    $city = "Anuradhapura";
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
                        <p class = "header-name">Anuradhapuraya</p>
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
            <section class = "top-section-container-on-weather4">
                <?php
                    // Your OpenWeather API Key
                    $apiKey = "c61ad36fccf665078fbcb4daff067985";

                    // City for which you want to get the weather
                    $city = "Trincomalee";
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
        </main>
    </body>
</html>