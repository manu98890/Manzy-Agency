<?php 
include '../session_check.php'; 
include '../conn.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manzy Agency Trips</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../res/css/dashboard/index/styles.css">
        <link rel="stylesheet" href="../res/css/dashboard/trips/styles.css">
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="../res/img/logo.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                    Manzy Agency
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="discover.php">Discover</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="trips.php">Trips</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="review.php">Review</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="requests.php">Requests</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php"><?php echo htmlspecialchars($_SESSION['username']); ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main content -->
        <div class="container my-5">
            <div class="row">
            <?php
                // Assume you have already connected to your database

                // Fetch travel package data from the database
                $query = "
                    SELECT 
                        p.id AS package_id, 
                        p.package_name, 
                        MAX(p.total_cost) AS total_cost, 
                        MAX(p.duration) AS duration, 
                        MAX(p.weather) AS weather, 
                        MAX(p.image) AS image, 
                        pl.district
                    FROM 
                        travel_packages p
                    JOIN 
                        package_attractions pa ON p.id = pa.package_id
                    JOIN 
                        places pl ON pa.places_id = pl.id
                    GROUP BY 
                        pl.district;
                ";

                mysqli_query($conn, "SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
                // Execute the query
                $result = mysqli_query($conn, $query);

                // Loop through the results and generate the HTML
                while ($row = mysqli_fetch_assoc($result)) {
                    // Extract data
                    $packageName = $row['package_name'];
                    $totalCost = number_format($row['total_cost'], 2); // Formatting the cost with 2 decimal points
                    $duration = $row['duration'];
                    $image = $row['image'];
                    $district = $row['district'];
                    $packageId = $row['package_id'];

                    // Weather API call
                    $apiKey = "c61ad36fccf665078fbcb4daff067985";
                    $encodedCity = urlencode($district);
                    $apiUrl = "http://api.openweathermap.org/data/2.5/weather?q={$encodedCity}&appid={$apiKey}";
                    $response = file_get_contents($apiUrl);
                    $data = json_decode($response, true);

                    if ($data && $data['cod'] == 200) {
                        $iconCode = $data['weather'][0]['icon'];
                        $iconUrl = "http://openweathermap.org/img/wn/{$iconCode}@2x.png";
                    } else {
                        $iconUrl = ""; // Fallback if the weather data cannot be fetched
                    }

                    echo '
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <img src="../res/img/dashboard/places/' . $image . '" class="card-img-top" alt="' . $packageName . '" style = "height:300px;">
                            <div class="card-body">
                                <h5 class="card-title">' . $packageName . '</h5>
                                <p class="card-text">District: ' . $district . '</p>
                                <p class="card-text">Duration: ' . $duration . ' days</p>
                                <p class="card-text">Cost: Rs. ' . $totalCost . '</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <img src="' . $iconUrl . '" alt="Weather icon" class="weather-icon">
                                    <form action="checkout.php" method="POST">
                                        <input type="hidden" name="package_id" value="' . $packageId . '">
                                        <input type="hidden" name="package_name" value="' . $packageName . '">
                                        <input type="hidden" name="total_cost" value="' . $totalCost . '">
                                        <input type="hidden" name="duration" value="' . $duration . '">
                                        <input type="hidden" name="image" value="' . $image . '">
                                        <input type="hidden" name="district" value="' . $district . '">
                                        <button class="btn btn-primary" type="submit">Checkout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>';
                }

                mysqli_close($conn);
            ?>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    </body>
</html>
