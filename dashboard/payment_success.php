<?php
// Include your session check to ensure the user is logged in
include '../session_check.php'; 

// Include your database connection
include '../conn.php';

// Check if variables exist in the URL
$orderID = isset($_GET['orderID']) ? $_GET['orderID'] : null;
$packageId = isset($_GET['packageId']) ? $_GET['packageId'] : null;
$packageName = isset($_GET['packageName']) ? urldecode($_GET['packageName']) : null;
$district = isset($_GET['district']) ? urldecode($_GET['district']) : null;

// Get user details from the session
$userId = $_SESSION['user_id'];  // Assuming user_id is stored in session
$username = $_SESSION['username'];  // Assuming username is stored in session

// Check if all required variables are set
if ($orderID && $packageId && $packageName && $userId && $username) {
    // Prepare an SQL query to insert data into the payments table
    $query = "INSERT INTO payments (order_id, package_id, package_name, district, user_id, username)
              VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($query);

    // Bind the parameters
    $stmt->bind_param("sissis", $orderID, $packageId, $packageName, $district, $userId, $username);

    // Execute the query
    if ($stmt->execute()) {
        $paymentId = $stmt->insert_id; // Get the last inserted payment ID
        // Insert booking record
        $sqlBooking = "INSERT INTO Booking (payment_id) VALUES (?)";
        $stmtBooking = $conn->prepare($sqlBooking);
        $stmtBooking->bind_param('i', $paymentId);

        if ($stmtBooking->execute()) {
            header('Location: profile.php');
        } else {
            echo "<p>Error recording booking: " . htmlspecialchars($conn->error) . "</p>";
        }

    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Error: Missing required data for payment processing.";
}

// Close the database connection
$stmt->close();
$stmtBooking->close();
$conn->close();
?>