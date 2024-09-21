<?php 
include '../session_check.php'; 
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
    // Convert to USD by dividing by 300
    $lkr = (float)$totalCost / 300;

    $usdAmount = number_format($lkr, 2, '.', '');

    // SQL query to get attractions
    $query = "SELECT attraction_name FROM package_attractions WHERE package_id = $id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Query Error: ' . mysqli_error($conn));
    }
} else {
    header('Location: trips.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manzy Agency - Checkout</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../res/css/dashboard/checkout/styles.css">

        <!-- Load PayPal SDK -->
        <script src="https://www.paypal.com/sdk/js?client-id=AR4aE2TlqMuLg7lwQo1btafUOHVmmx8GYQxfER-BtlTdM26f-HBNLo6UoMDHCjAz6rxqp8bIK09z3ZRe&currency=USD"></script>
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="../res/img/logo.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                    Manzy Agency
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="discover.php">Discover</a></li>
                        <li class="nav-item"><a class="nav-link" href="trips.php">Trips</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Review</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">More</a></li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="profile.php"><?php echo htmlspecialchars($_SESSION['username']); ?></a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main content -->
        <div class="container my-5">
            <div class="row">
                <div class="col-md-6">
                    <!-- Image Section -->
                    <div class="card">
                        <img src="../res/img/dashboard/places/<?php echo htmlspecialchars($image); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($packageName); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Package Details Section -->
                    <h2><?php echo htmlspecialchars($packageName); ?></h2>
                    <p><strong>District:</strong> <?php echo htmlspecialchars($district); ?></p>
                    <p><strong>Duration:</strong> <?php echo htmlspecialchars($duration); ?> days</p>
                    <p><strong>Total Cost:</strong> Rs. <?php echo htmlspecialchars($totalCost); ?></p>
                    
                    <!-- Attractions List -->
                    <h4>Attractions</h4>
                    <div class="row">
                        <?php 
                        $totalRows = mysqli_num_rows($result);
                        $half = ceil($totalRows / 2); // Divide items equally between two columns
                        $counter = 0;
                        echo '<div class="col-md-6">';
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($counter == $half) {
                                echo '</div><div class="col-md-6">'; // Move to the next column
                            }
                            echo '<p>' . htmlspecialchars($row['attraction_name']) . '</p>';
                            $counter++;
                        }
                        echo '</div>';
                        ?>
                    </div>
                </div>
            </div>

            <!-- Weather Section -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <h4>Weather in <?php echo htmlspecialchars($district); ?></h4>
                    <?php
                    $apiKey = "c61ad36fccf665078fbcb4daff067985";
                    $encodedCity = urlencode($district);
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
                        <div class="d-flex align-items-center">
                            <img src="<?php echo $iconUrl; ?>" alt="Weather icon" class="me-3" style="width: 50px;">
                            <div>
                                <p class="mb-0"><strong><?php echo ucfirst($weatherDescription); ?></strong></p>
                                <p class="mb-0">Temperature: <?php echo round($temperature - 273.15); ?>°C</p>
                                <p class="mb-0">Humidity: <?php echo $humidity; ?>%</p>
                                <p class="mb-0">Wind: <?php echo $windSpeed; ?> m/s</p>
                            </div>
                        </div>
                    <?php 
                    } else {
                        echo "<p>Unable to fetch weather data.</p>";
                    }
                    ?>
                </div>
            </div>

            <!-- PayPal Section -->
            <div class="row mt-4">
                <div class="col-md-12 text-center">
                    <h4>Pay Now (<?php echo $usdAmount; ?> USD)</h4>
                    <div id="paypal-button-container"></div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS and PayPal SDK -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
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
                        alert('Transaction completed by ' + details.payer.name.given_name);
                        var packageId = '<?php echo $packageId; ?>';
                        var packageName = encodeURIComponent('<?php echo $packageName; ?>');
                        var district = encodeURIComponent('<?php echo $district; ?>');

                        // Redirect after payment success
                        window.location.href = 'payment_success.php?orderID=' + data.orderID + '&packageId=' + packageId + '&packageName=' + packageName + '&district=' + district;
                    });
                },
                onCancel: function(data) {
                    alert('Payment canceled.');
                },
                onError: function(err) {
                    console.error('PayPal Checkout Error:', err);
                }
            }).render('#paypal-button-container');
        </script>
    </body>
</html>
