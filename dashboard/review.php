<?php 
include '../session_check.php'; 
include '../conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize the input to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $package_name = mysqli_real_escape_string($conn, $_POST['package_name']);
    $review = mysqli_real_escape_string($conn, $_POST['message']);
    $rating = (int)$_POST['rating'];  // Retrieve and cast the rating to an integer

    $insertQuery = "INSERT INTO review (package_name, review, email, rating) 
            VALUES ('$package_name', '$review', '$email', '$rating')";

    if ($conn->query($insertQuery) === TRUE) {
        echo '
            <div class="alert alert-success" role="alert">
                Review Added Successfully!
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
    <title>Review Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../res/css/dashboard/review/styles.css">

    <!-- Custom CSS for Star Rating -->
    <style>
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
        }

        .rating input {
            display: none;
        }

        .rating label {
            position: relative;
            width: 1em;
            font-size: 2rem;
            color: #FFD700;
            cursor: pointer;
        }

        .rating label::before {
            content: "\2605"; /* Unicode star */
            position: absolute;
            opacity: 0;
        }

        .rating label:hover:before,
        .rating label:hover ~ label:before,
        .rating input:checked ~ label:before {
            opacity: 1;
        }
    </style>
</head>
<body>
    <div class="contact-clean">
        <form method="post" action="">
            <h2 class="text-center">Your Valuable Review</h2>
            <div class="form-group">
                <input class="form-control is-invalid" type="email" name="email" placeholder="Enter Your Email" required>
                <small class="form-text text-danger">Please enter a correct email address.</small>
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="package_name" placeholder="Enter Package Name" required>
            </div>
            <div class="form-group">
                <textarea class="form-control" rows="6" name="message" placeholder="Your Review" required></textarea>
            </div>

            <!-- Star Rating Section -->
            <div class="form-group text-center">
                <label for="rating">Rate this package:</label>
                <div class="rating">
                    <input type="radio" name="rating" id="star5" value="5" required><label for="star5" title="5 stars"></label>
                    <input type="radio" name="rating" id="star4" value="4"><label for="star4" title="4 stars"></label>
                    <input type="radio" name="rating" id="star3" value="3"><label for="star3" title="3 stars"></label>
                    <input type="radio" name="rating" id="star2" value="2"><label for="star2" title="2 stars"></label>
                    <input type="radio" name="rating" id="star1" value="1"><label for="star1" title="1 star"></label>
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
