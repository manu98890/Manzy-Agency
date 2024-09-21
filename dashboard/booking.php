<?php 

include '../session_check.php'; 
include '../conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize the input to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    echo $id;

    $district = "galle";


    // Prepare the SQL query
    $query = "SELECT name, description, img, price FROM Hotels WHERE id = $id";
    
    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check for errors in the query
    if (!$result) {
        die('Query Error: ' . mysqli_error($conn));
    } else {
        // Fetch the data if the query is successful
        $hotel = mysqli_fetch_assoc($result);

        if ($hotel) {
            // Output or use the fetched data
            /*echo 'Hotel Name: ' . htmlspecialchars($hotel['name']) . '<br>';
            echo 'Description: ' . htmlspecialchars($hotel['description']) . '<br>';
            echo 'Image: <img src="../res/img/dashboard/hotels/' . htmlspecialchars($hotel['img']) . '" alt="Hotel Image"><br>';
            echo 'Price: $' . htmlspecialchars($hotel['price']);*/
        } else {
            echo 'No hotel found with this ID.';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manzy-Agency</title>
        <link rel="stylesheet" href="../res/css/dashboard/index/styles.css">
        <link rel="stylesheet" href="../res/css/dashboard/booking/styles.css">
        <link rel="stylesheet" href="../res/css/dashboard/checkout/styles.css"><!--aes-->
        <script src="https://www.paypal.com/sdk/js?client-id=AQVZYcw-ZHsNjpoYuXWwmx4fDsdGclOsBHe8ssBOF0P8J549XPkJMS5Wt-ZCj2K_i6Thgdf9O9n7edBn&currency=USD"></script>
        <script>
            // JavaScript function to calculate the price based on room size and days
            function calculatePrice(basePrice) {
                let roomSize = document.getElementById('room-size').value;
                let days = document.getElementById('days').value;

                // Room size factor (small = 1, medium = 1.5, large = 2)
                let roomSizeFactor;
                switch (roomSize) {
                    case 'small':
                        roomSizeFactor = 1;
                        break;
                    case '2': // medium
                        roomSizeFactor = 1.5;
                        break;
                    case '3': // large
                        roomSizeFactor = 2;
                        break;
                }

                // Calculate total price
                let totalPrice = basePrice * roomSizeFactor * days;

                // Update the price display
                document.getElementById('price-display').innerHTML = 'RS.' + totalPrice.toFixed(2);

                // Return the total price for PayPal transaction
                return totalPrice;
            }

            // Initialize PayPal Button after the price is calculated
            function initPayPalButton(basePrice) {
                paypal.Buttons({
                    createOrder: function(data, actions) {
                        // Calculate the total price
                        let totalPrice = calculatePrice(basePrice);
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    value: (totalPrice / 270).toFixed(2) // Assuming conversion from RS to USD
                                }
                            }]
                        });
                    },
                    onApprove: function(data, actions) {
                        // Finalize the transaction and capture the details
                        return actions.order.capture().then(function(details) {
                            // Capture the transaction details
                            const transactionId = details.id;
                            const payerName = details.payer.name.given_name;
                            const paymentAmount = details.purchase_units[0].amount.value;
                            const hotel_id = "<?php echo htmlspecialchars($id); ?>";
                            const roomSize = document.getElementById('room-size').value;
                            const days = document.getElementById('days').value;
                            console.log(hotel_id);

                            console.log("Transaction ID:", transactionId);
                            console.log("Payment Amount:", paymentAmount);
                            console.log("Hotel ID:", hotel_id);

                            // Prepare data for redirection
                            const params = new URLSearchParams({
                                transaction_id: transactionId,
                                payment_amount: paymentAmount,
                                hotel_id: hotel_id,  // This should be defined in your page
                                payment_status: 'completed',
                                room_size: roomSize,
                                days: days
                            }).toString();

                            // Redirect to insert_payment.php with the transaction data
                            window.location.href = "insert_payment.php?" + params;
                        });
                    },
                    onError: function(err) {
                        console.log(err);
                        document.getElementById('error-message').innerHTML = "Something went wrong during the transaction.";
                    }
                }).render('#paypal-button-container');
            }
        </script>
    </head>
    <body onload="initPayPalButton(<?php echo $hotel['price']; ?>)">
        <header>
            <navbar class = "navbar">
                <div class = "logo">
                    <img src = "../res/img/logo.png" alt = "logo" class = "logo-img"></img>
                </div>
                <div class = "logo-name">
                    <a class = "logo-name-text" href = "index.php" style = "text-decoration: none;">Manzy Agency</a>
                </div>
                <div class = "center-container">
                    <a href = "discover.php" class = "center-text">Discover</a>
                    <a href = "trips.php" class = "center-text">Trips</a>
                    <a href = "reviews.php" class = "center-text">Review</a>
                    <a href = "requests.php" class = "center-text">More</a>
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
            <section class = "main-container">
                <div class="left-image-containers" style="background-image: url('<?php echo '../res/img/dashboard/hotels/' . htmlspecialchars($hotel['img']); ?>');">
                </div>
                <div class = "header-name"><?php echo'' . htmlspecialchars($hotel['name']); ?></div>
                <div class = "description-section"><?php echo'' . htmlspecialchars($hotel['description']); ?></div>
                <div class = "room-size-container"></div>
                <select class = "room-size-selector" id="room-size" onchange="calculatePrice(<?php echo $hotel['price']; ?>)">
                    <option value="small">small</option>
                    <option value="2">medium</option>
                    <option value="3">large</option>
                </select>
                <div class = "days-image"></div>
                <select class = "days-selector" id="days" onchange="calculatePrice(<?php echo $hotel['price']; ?>)">
                    <option value="1">1 day</option>
                    <option value="2">2 day</option>
                    <option value="3">3 day</option>
                    <option value="4">4 day</option>
                    <option value="5">5 day</option>
                    <option value="6">6 day</option>
                    <option value="7">7 day</option>
                </select>
                <div class = "price-section"></div>
                <div class ="price-tag-display"><span id="price-display">RS.<?php echo htmlspecialchars($hotel['price']); ?></span></div>
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
                <!-- PayPal Button Container -->
                <div class = "submit-container-on-paypal" id="paypal-button-container"></div>
            </section>
        </main>
    </body>
</html>