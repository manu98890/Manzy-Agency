<?php
include '../session_check.php'; 
include '../conn.php';

// Retrieve payment and transaction details from the URL parameters
if (isset($_GET['transaction_id']) && isset($_GET['payment_amount']) && isset($_GET['hotel_id'])) {
    $transactionId = $_GET['transaction_id'];
    $paymentAmount = $_GET['payment_amount'];
    $hotelId = $_GET['hotel_id'];
    $paymentStatus = $_GET['payment_status'];
    $room_size = mysqli_real_escape_string($conn, $_GET['room_size']);
    $days = mysqli_real_escape_string($conn, $_GET['days']);
    $user_id = $_SESSION['user_id'];

    // Query the hotel details from the database
    include '../conn.php';
    $query = "SELECT name, description, price FROM Hotels WHERE id = $hotelId";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Error: ' . mysqli_error($conn));
    }

    $hotel = mysqli_fetch_assoc($result);
    if (!$hotel) {
        die('No hotel found with this ID.');
    }

    $hotelName = $hotel['name'];
    $hotelPrice = $hotel['price'];


    $insertQuery = "INSERT INTO roomsbooking (hotel_id, rooms, roomSize, userid, price, days) 
            VALUES ($hotelId, 1, '$room_size', $user_id, $paymentAmount, '$days')";

    if ($conn->query($insertQuery) === TRUE) {

        echo '
            <div class="alert alert-success" role="alert">
                Rooms Added Successful!
            </div>';
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
} else {
    die('Error: Missing payment or transaction details.');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status</title>
    <link rel="stylesheet" href="../res/css/dashboard/index/styles.css"> <!-- Link to your stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .container {
            padding: 20px;
            text-align: center;
        }
        .message-box {
            border: 1px solid #ddd;
            padding: 30px;
            border-radius: 10px;
            margin-top: 20px;
        }
        .message-box._success {
            background-color: #e0ffe0;
            color: #2c662d;
        }
        .message-box._failed {
            background-color: #ffe0e0;
            color: #992222;
        }
        .message-box h2 {
            font-size: 24px;
            margin: 10px 0;
        }
        .message-box p {
            font-size: 16px;
        }
        .message-box i {
            font-size: 48px;
        }
        .download-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .download-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($paymentStatus === 'completed') { ?>
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="message-box _success">
                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                        <h2>Your payment was successful</h2>
                        <p>Thank you for your payment. We will<br> be in contact with more details shortly.</p>
                        <!-- Download Invoice Button -->
                        <a href="index.php" class="download-btn">Back To Home</a>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="message-box _failed">
                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                        <h2>Your payment failed</h2>
                        <p>Try again later.</p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>
