<?php
// Database connection details
$servername = "localhost"; // Database server (usually localhost)
$db_username = "root";     // Database username
$db_password = "";          // Database password
$dbname = "manzy";  // Name of the database

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
