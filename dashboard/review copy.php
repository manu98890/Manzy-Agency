<?php 

include '../session_check.php'; 
include '../conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize the input to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $package_name = mysqli_real_escape_string($conn, $_POST['package_name']);
    $review = mysqli_real_escape_string($conn, $_POST['message']);


    $insertQuery = "INSERT INTO review (package_name, review, email) 
            VALUES ('$package_name', '$review', '$email')";

    if ($conn->query($insertQuery) === TRUE) {

        echo '
            <div class="alert alert-success" role="alert">
                Review Added Successful!
            </div>';
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../res/css/dashboard/review/styles.css">
</head>

<body>
    <div class="contact-clean">
        <form method="post" action = "">
            <h2 class="text-center">Your Valueble Review</h2>
            <div class="form-group"><input class="form-control is-invalid" type="email" name="email" placeholder="Enter Your Email"><small class="form-text text-danger">Please enter a correct email address.</small></div>
            <div class="form-group"><input class="form-control " type="text" name="package_name" placeholder="Enter Package Name"></div>
            <div class="form-group"><textarea class="form-control" rows="14" name="message" placeholder="Your Review"></textarea></div>
            <div class="form-group"><button class="btn btn-primary" type="submit">send </button></div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>