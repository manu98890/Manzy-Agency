<?php
// Start session
session_start();

// Include the database connection file
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $username = trim($_POST['username']);  // Changed variable name to $username
    $password = trim($_POST['password']);

    // Validate username and password fields
    if (empty($username) || empty($password)) {
        echo "<p style='color:red;'>Username and Password are required.</p>";
    } else {
        // Use prepared statement to avoid SQL injection
        $stmt = $conn->prepare("SELECT id, password FROM staff WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch user data
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];


            // Verify password
            if (password_verify($password, $hashed_password)) {
                // Set session variables
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $username;
                $_SESSION['logged_in'] = true;

                echo 'done';

                // Redirect to the dashboard
                header("Location: staff/index.php");
                exit();
            } else {
                echo "<p style='color:red;'>Invalid password.</p>";
            }
        } else {
            echo "<p style='color:red;'>No account found with that username.</p>";
        }

        // Close the prepared statement and database connection
        $stmt->close();
        $conn->close();
    }
}
?>
