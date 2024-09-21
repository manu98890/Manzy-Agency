<?php
// Start session
session_start();

// Include PHPMailer files
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // If you installed using Composer

// Include the database connection file
include 'conn.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // Validate email and password fields
    if (empty($email) || empty($password)) {
        echo "<p style='color:red;'>Email and Password are required.</p>";
    } else {
        // Sanitize email and prevent SQL injection
        $email = $conn->real_escape_string($email);
        
        // Check if the user exists in the database
        $sql = "SELECT id, username, password FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Fetch user data
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];

            // Verify password
            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['logged_in'] = true;

                // Generate OTP
                $otp = rand(100000, 999999); // 6-digit random number
                $_SESSION['otp'] = $otp;
                $_SESSION['email'] = $email;

                // Send OTP via Email
                $mail = new PHPMailer(true);
                
                try {
                    // Server settings
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; 
                    $mail->SMTPAuth = true;
                    $mail->Username = 'numa9914@gmail.com'; // Your email address
                    $mail->Password = 'lciw mqjr bdfp ofyq'; // Your email password or app password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    // Recipients
                    $mail->setFrom('manzyagenzy@gmail.com', 'Manzy Agency');
                    $mail->addAddress($email); // The recipient's email

                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Your OTP Code';
                    $mail->Body = "Dear User,<br><br>Your OTP code is <strong>$otp</strong>.<br><br>Please enter this code to complete the login process.<br><br>Best regards,<br>Manzy Agenzy Team";

                    $mail->send();
                    echo "<p style='color:green;'>OTP has been sent to your email.</p>";

                    // Redirect to OTP verification page
                    header('Location: verify_otp.php');
                    exit();
                } catch (Exception $e) {
                    echo "<p style='color:red;'>OTP could not be sent. Mailer Error: {$mail->ErrorInfo}</p>";
                }
            } else {
                echo "<p style='color:red;'>Invalid password.</p>";
            }
        } else {
            echo "<p style='color:red;'>No account found with that email address.</p>";
        }

        // Close the database connection
        $conn->close();
    }
}
?>
