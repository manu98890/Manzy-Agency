<?php

include '../session_check.php';  // Check session
include '../conn.php';  // Include the database connection

// Check if the user is logged in and session contains user_id
if (!isset($_SESSION['user_id'])) {
    die("User not logged in. Please log in first.");
}

// Get user ID from the session
$user_id = $_SESSION['user_id'];

// Query to fetch the email of the logged-in user
$sql = "SELECT email FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the email from the result
    $row = $result->fetch_assoc();
    $email = $row['email'];
} else {
    die("No email found for this user.");
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = trim($_POST['message']);  // Sanitize message input
    $user_id = $_SESSION['user_id'];  // Get user ID from session
    $emails = $email;  // Use email fetched from earlier

    // Validate message input
    if (!empty($message)) {
        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO request (email, user_id, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $emails, $user_id, $message);  // "sis" means string, int, string

        // Execute the query
        if ($stmt->execute()) {
            $success_message = "Your message has been sent successfully!";
        } else {
            $error_message = "There was an error submitting your message. Please try again.";
        }

        // Close the statement and connection
        $stmt->close();
    } else {
        $error_message = "Please enter a message.";
    }
}

// Close the database connection after all operations
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Admin</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f4f4f9;
        }
        .contact-form {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            margin: 50px 0;
        }
        .contact-header {
            text-align: center;
            margin-bottom: 40px;
        }
        .contact-header h1 {
            font-size: 40px;
            font-weight: bold;
            color: #007bff;
        }
        .contact-header p {
            font-size: 18px;
            color: #666;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- Contact Form -->
            <div class="contact-form">
                <div class="contact-header">
                    <h1>Contact Admin</h1>
                    <p>We are here to help you. Feel free to leave a message.</p>
                </div>

                <!-- Display Success or Error Message -->
                <?php if (isset($success_message)): ?>
                    <div class="alert alert-success">
                        <?php echo $success_message; ?>
                    </div>
                <?php elseif (isset($error_message)): ?>
                    <div class="alert alert-danger">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>

                <!-- Contact Form -->
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($email); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
