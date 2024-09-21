<?php include '../session_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manzy-Agency | Weather Dashboard</title>
        <link rel="stylesheet" href="../res/css/dashboard/index/styles.css">
        <link rel="stylesheet" href="../res/css/dashboard/discover/styles.css">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
                margin: 0;
                padding: 0;
                overflow-x: hidden;
            }
            

            main {
                padding: 50px 20px;
                display: flex;
                justify-content: space-around;
                flex-wrap: wrap;
            }
            .weather-card {
                background: rgba(255, 255, 255, 0.9);
                border-radius: 20px;
                width: 300px;
                padding: 20px;
                margin: 20px;
                text-align: center;
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease-in-out;
            }
            .weather-card:hover {
                transform: scale(1.05);
            }
            .header-name {
                font-size: 22px;
                font-weight: bold;
                color: #333;
                margin-bottom: 20px;
                text-transform: uppercase;
            }
            .weather-icon {
                width: 80px;
                height: 80px;
                margin-bottom: 15px;
            }
            .weather-type-name {
                font-size: 18px;
                font-weight: 500;
                color: #555;
            }
            .weather-details {
                display: flex;
                justify-content: space-around;
                margin-top: 20px;
            }
            .weather-detail {
                text-align: center;
            }
            .weather-detail-value {
                font-size: 24px;
                font-weight: bold;
                color: #333;
            }
            .weather-detail-label {
                font-size: 16px;
                color: #888;
                margin-top: 5px;
            }
            .weather-detail-icon {
                font-size: 28px;
                color: #00aaff;
                margin-bottom: 10px;
            }
            /* Animation */
            @keyframes glow {
                0% { box-shadow: 0 0 10px #ffcc00; }
                50% { box-shadow: 0 0 20px #ffcc00; }
                100% { box-shadow: 0 0 10px #ffcc00; }
            }
            .weather-card:hover {
                animation: glow 1.5s infinite ease-in-out;
            }
        </style>
    </head>
    <body>
    <header>
            <navbar class = "navbar">
                <div class = "logo">
                    <img src = "../res/img/logo.png" alt = "logo" class = "logo-img"></img>
                </div>
                <div class = "logo-name">
                    <a class = "logo-name-text" href = "index.php" style = "text-decoration:none;">Manzy Agency</a>
                </div>
                <div class = "center-container">
                    <a href = "discover.php" class = "center-text">Discover</a>
                    <a href = "trips.php" class = "center-text">Trips</a>
                    <a href = "review.php" class = "center-text">Review</a>
                    <a href = "requests.php" class = "center-text">Request</a>
                </div>
                <div class = "login-container">
                    <a href = "profile.php" class = "login-btn"><?php echo htmlspecialchars($_SESSION['username']); ?></a>
                </div>
                <div class = "profile-logo">
                    <div class = "prifile-logo-section-fill"></div>
                </div>
            </navbar>
    </header>

        <main>
            <?php
            $cities = [
                "Ampara", "Anuradhapura", "Badulla", "Batticaloa", "Colombo", "Galle", 
                "Gampaha", "Hambantota", "Jaffna", "Kalutara", "Kandy", "Kegalle", 
                "Kilinochchi", "Kurunegala", "Mannar", "Matale", "Matara", "Monaragala"
                , "Nuwara Eliya", "Polonnaruwa", "Puttalam", "Ratnapura", 
                "Trincomalee", "Vavuniya"
            ];
            $apiKey = "c61ad36fccf665078fbcb4daff067985";

            foreach ($cities as $city) {
                $encodedCity = urlencode($city);
                $apiUrl = "http://api.openweathermap.org/data/2.5/weather?q={$encodedCity}&appid={$apiKey}";
                $response = file_get_contents($apiUrl);
                $data = json_decode($response, true);

                if ($data && $data['cod'] == 200) {
                    $iconCode = $data['weather'][0]['icon'];
                    $weatherDescription = ucfirst($data['weather'][0]['description']);
                    $temperature = round($data['main']['temp'] - 273.15); // Convert from Kelvin to Celsius
                    $humidity = $data['main']['humidity'];
                    $windSpeed = $data['wind']['speed'];
                    $iconUrl = "http://openweathermap.org/img/wn/{$iconCode}@2x.png";
            ?>
            <section class="weather-card">
                <p class="header-name"><?php echo htmlspecialchars($city); ?></p>
                <img src="<?php echo $iconUrl; ?>" alt="Weather icon" class="weather-icon">
                <p class="weather-type-name"><?php echo $weatherDescription; ?></p>

                <div class="weather-details">
                    <div class="weather-detail">
                        <div class="weather-detail-icon">&#x1F321;</div>
                        <p class="weather-detail-value"><?php echo $temperature; ?>°C</p>
                        <p class="weather-detail-label">Temperature</p>
                    </div>
                    <div class="weather-detail">
                        <div class="weather-detail-icon">&#x1F4A7;</div>
                        <p class="weather-detail-value"><?php echo $humidity; ?>%</p>
                        <p class="weather-detail-label">Humidity</p>
                    </div>
                    <div class="weather-detail">
                        <div class="weather-detail-icon">&#x1F32C;</div>
                        <p class="weather-detail-value"><?php echo $windSpeed; ?> m/s</p>
                        <p class="weather-detail-label">Wind</p>
                    </div>
                </div>
            </section>
            <?php 
                } else {
                    echo "<p>Error: Unable to fetch weather data for {$city}.</p>";
                }
            } 
            ?>
        </main>
    </body>
</html>
