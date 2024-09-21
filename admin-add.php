<?php
// Include your database connection file
include 'conn.php';

// Hash the plain text password 'admin'
$plain_password = 'admin';
$hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

// Prepare the SQL statement to insert the username and hashed password
$stmt = $conn->prepare("INSERT INTO admin (usernames, password) VALUES (?, ?)");
$username = 'admin';  // You can change this to any username
$stmt->bind_param("ss", $username, $hashed_password);

// Execute the query
if ($stmt->execute()) {
    echo "Admin user inserted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>