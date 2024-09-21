<?php
session_start();
include 'conn.php';  // Database connection

// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include Composer's autoload if you're using Composer
require 'vendor/autoload.php';  // Ensure this path is correct for your project

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    
    // Validate email field
    if (!empty($email)) {
        // Check if email exists in the database
        // You may want to add proper email verification here if necessary.
        $_SESSION['email'] = $email;
        
        // Generate a random 6-digit OTP
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;

        // Initialize PHPMailer
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'numa9914@gmail.com';               // SMTP username
            $mail->Password   = 'lciw mqjr bdfp ofyq';                        // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable SSL encryption
            $mail->Port       = 465;                                    // TCP port to connect to

            // Recipients
            $mail->setFrom('ManzyAgency@example.com', 'Manzy Agency');
            $mail->addAddress($email);                                  // Add the user's email address

            // Content
            $mail->isHTML(true);                                        // Set email format to HTML
            $mail->Subject = 'Your OTP for Password Reset';
            $mail->Body    = "<p>Your OTP for password reset is: <strong>$otp</strong></p>";
            $mail->AltBody = "Your OTP for password reset is: $otp";    // Plain text version

            // Send the email
            $mail->send();
            
            echo "<p style='color:green;'>OTP has been sent to your email: $email</p>";

            // Redirect to the OTP verification page
            header("Location: verify_otp2.php");
            exit();

        } catch (Exception $e) {
            echo "<p style='color:red;'>OTP could not be sent. Mailer Error: {$mail->ErrorInfo}</p>";
        }
    } else {
        echo "<p style='color:red;'>Please enter your email.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
    <h2 class="text-center mb-4">Forgot Password</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label for="email" class="form-label">Enter your email</label>
            <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email">
        </div>
        <button type="submit" class="btn btn-primary submit-btn">Send OTP</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
