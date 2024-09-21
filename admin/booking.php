<?php 
// Include admin authentication and database connection
include '../admin-check.php';
include '../conn.php';

// Insert data into payments table
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input
    $pay_id = $conn->real_escape_string($_POST['payment_id']);

    // Insert payment data
    // Insert or update the record
    $insertQuery = "INSERT INTO booking (payment_id) 
    VALUES ($pay_id)"; // You can also update the payment_date field

    if ($conn->query($insertQuery) === TRUE) {
        header('Location: success.html');
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
}

// Close the connection if it is still open
if ($conn && $conn->ping()) {
    $conn->close();
}
?>