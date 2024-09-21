<?php
session_start();

// Check if the OTP form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_otp = trim($_POST['otp']);

    echo $entered_otp;

    // Check if the entered OTP matches the session OTP
    if ($entered_otp == $_SESSION['otp']) {
        echo "<p style='color:green;'>OTP verified successfully! You are now logged in.</p>";

        $_SESSION['otp_verified'] = true;
        // Redirect to dashboard or homepage
        header('Location: change_password.php');
        exit();
    } else {
        echo "<p style='color:red;'>Invalid OTP. Please try again.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f7f7f7;
        }
        .otp-container {
            max-width: 400px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .otp-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        .otp-input {
            font-size: 18px;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ced4da;
            text-align: center;
            letter-spacing: 5px;
        }
        .submit-btn {
            background-color: #007bff;
            color: white;
            font-size: 18px;
            font-weight: bold;
            border-radius: 8px;
            padding: 10px;
            width: 100%;
        }
        .submit-btn:hover {
            background-color: #0056b3;
        }
        .resend-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="otp-container">
    <h2 class="otp-title">OTP Verification</h2>

    <form method="post" action = "">
        <div class="mb-3">
            <label for="otp" class="form-label">Enter OTP sent to your email:</label>
            <input type="text" class="form-control otp-input" id="otp" name="otp" maxlength="6" required placeholder="******">
        </div>
        <button type="submit" class="btn submit-btn">Verify OTP</button>

        <a href="#" class="resend-link">Resend OTP</a>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
