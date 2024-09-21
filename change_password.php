<?php
session_start();
include 'conn.php';

// Check if OTP was verified
if (!isset($_SESSION['otp_verified']) || !$_SESSION['otp_verified']) {
    header('Location: forgot_password.php');
    exit();
}

// Step 2: Change Password
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Check if passwords match
    if ($new_password === $confirm_password) {
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Update the password in the database
        $email = $_SESSION['email'];
        $sql = "UPDATE users SET password='$hashed_password' WHERE email='$email'";
        $conn->query($sql);

        echo "<p style='color:green;'>Password has been changed successfully!</p>";

        // Clear session and redirect to login
        session_unset();
        session_destroy();
        header('Location: login.html');
        exit();
    } else {
        echo "<p style='color:red;'>Passwords do not match.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 400px;
            margin: 100px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .submit-btn {
            width: 100%;
            font-size: 18px;
            padding: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Change Password</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label for="new_password" class="form-label">New Password</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required placeholder="Enter new password">
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required placeholder="Confirm new password">
        </div>
        <button type="submit" class="btn btn-primary submit-btn">Change Password</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
