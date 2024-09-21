<?php include '../session_check.php'; 
    include '../conn.php';
    // Check if the form data is received
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the data from the form
        $packageId = $_POST['package_id'];
        $packageName = $_POST['package_name'];
        $totalCost = $_POST['total_cost'];
        $duration = $_POST['duration'];
        $image = $_POST['image'];
        $district = $_POST['district'];

        $id = (int)$packageId;
        
        $totalCost = str_replace(',', '', $totalCost);  // Converts '11,400.00' to '11400.00'
        // Step 2: Convert to USD by dividing by 300
        $lkr = (float)$totalCost / 300;

        $usdAmount = number_format($lkr, 2, '.', '');


        // Correct SQL query
        $query = "SELECT attraction_name FROM package_attractions WHERE package_id = $id";

        $result = mysqli_query($conn, $query);

        // Check for errors in the query
        if (!$result) {
            die('Query Error: ' . mysqli_error($conn));
        }

        // Fetch the results and display them (Example)

        // Now you can use this data as needed on the next page
        /*echo "<h1>Selected Package: $packageName</h1>";
        echo "<p>Package ID: $packageId</p>";
        echo "<p>Duration: $duration</p>";
        echo "<p>Total Cost: Rs. $totalCost</p>";*/
    }else{
        header ('Location: trips.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manzy-Agency trips</title>
        <link rel="stylesheet" href="../res/css/dashboard/index/styles.css">
        <link rel="stylesheet" href="../res/css/dashboard/checkout/styles.css">

        <!-- Load PayPal SDK -->
        <script src="https://www.paypal.com/sdk/js?client-id=AR4aE2TlqMuLg7lwQo1btafUOHVmmx8GYQxfER-BtlTdM26f-HBNLo6UoMDHCjAz6rxqp8bIK09z3ZRe&currency=USD"></script>
    </head>
    <body>
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
        <main>
            <section class = "main-section-container">
                <div class="left-image-container" style="background-image:url('../res/img/dashboard/places/<?php echo htmlspecialchars($image); ?>')"></div>
                <div class = "header-section-container"><?php echo htmlspecialchars($packageName); ?></div>
                <div class="data-section-container">
                    <div class="column">
                        <?php 
                            $totalRows = mysqli_num_rows($result);
                            $half = ceil($totalRows / 2); // Divide items equally between two columns

                            $counter = 0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($counter == $half) {
                                    echo '</div><div class="column">'; // Move to the next column
                                }
                        ?>
                                <div class="data-section"><?php echo htmlspecialchars($row['attraction_name']); ?></div>
                        <?php
                                $counter++;
                            }
                        ?>
                    </div>
                </div>
                <div class = "calender-logo-section"></div>
                <div class = "days-expecting-section">
                <?php echo htmlspecialchars($duration); ?>
                </div>
                <div class = "price-logo-section"></div>
                <div class = "price-expecting-section">
                <?php echo htmlspecialchars($totalCost); ?>
                </div>
                <section class = "top-section-container-on-weather4">
                <?php
                    // Your OpenWeather API Key
                    $apiKey = "c61ad36fccf665078fbcb4daff067985";

                    // City for which you want to get the weather
                    //$city = "Trincomalee";
                    // Encode the city name for the URL
                    $encodedCity = urlencode($district);

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
            <div  class = "submit-container" id="paypal-button-container"></div>
            </section>
        </main>
        <script>
                paypal.Buttons({
                    createOrder: function(data, actions) {
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    value: '<?php echo $usdAmount; ?>' // Set the total cost here
                                }
                            }]
                        });
                    },
                    onApprove: function(data, actions) {
                        return actions.order.capture().then(function(details) {
                            // Redirect or perform another action on successful payment
                            alert('Transaction completed by ' + details.payer.name.given_name);
                            // Ensure these variables are correctly passed
                            var packageId = '<?php echo $packageId; ?>';
                            var packageName = encodeURIComponent('<?php echo $packageName; ?>'); // Encode for URL
                            var district = encodeURIComponent('<?php echo $district; ?>'); 

                            // Redirect with orderID and packageId, packageName
                            window.location.href = 'payment_success.php?orderID=' + data.orderID + '&packageId=' + packageId + '&packageName=' + packageName + '&district='+district;
                        });
                    },
                    onCancel: function (data) {
                        alert('Payment canceled.');
                    },
                    onError: function (err) {
                        console.error('PayPal Checkout Error:', err);
                    }
                }).render('#paypal-button-container');
            </script>
    </body>
</html>