<?php
include '../conn.php';
include '../session_check.php';


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch reviews from the database
$sql = "SELECT * FROM review";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Reviews</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        /* Banner Section */
        .review-banner {
            background-image: url('https://example.com/banner.jpg'); /* Replace with actual banner image */
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            color: #fff;
            text-align: center;
            position: relative;
        }
        .review-banner::after {
            content: "";
            background: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }
        .review-banner h1 {
            font-size: 60px;
            font-weight: bold;
            margin-bottom: 20px;
            z-index: 2;
            position: relative;
        }
        .review-banner p {
            font-size: 24px;
            z-index: 2;
            position: relative;
        }
        .review-banner .btn {
            z-index: 2;
            position: relative;
        }

        /* Review Cards Section */
        .review-container {
            padding: 50px 0;
            background-color: #f4f4f9;
        }
        .review-container h2 {
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 50px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .review-card {
            background-color: #fff;
            border: none;
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            transition: all 0.3s ease-in-out;
        }
        .review-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }
        .review-card .card-body {
            padding: 30px;
        }
        .review-card h5 {
            font-weight: bold;
            color: #007bff;
        }
        .review-card h6 {
            color: #888;
            margin-bottom: 20px;
        }
        .review-card p {
            font-size: 18px;
            line-height: 1.6;
        }
        .no-reviews {
            text-align: center;
            font-size: 20px;
            color: #555;
            padding: 30px 0;
        }
    </style>
</head>
<body>

    <!-- Review Banner Section -->
    <section class="review-banner">
        <div class="container">
            <h1>Customer Reviews</h1>
            <p>See what others have to say about our amazing packages!</p>
            <a href="review.php" class="btn btn-lg btn-outline-light">Submit Your Review</a>
        </div>
    </section>

    <!-- Review Section -->
    <section class="review-container">
        <div class="container">
            <h2>What Our Customers Say</h2>

            <div class="row">
                <?php if ($result->num_rows > 0): ?>
                    <!-- Loop through each review from the database -->
                    <?php while($row = $result->fetch_assoc()): ?>
                        <!-- Review Card -->
                        <div class="col-md-4">
                            <div class="card review-card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($row['package_name']); ?></h5>
                                    <h6 class="card-subtitle mb-2">By: <?php echo htmlspecialchars($row['email']); ?></h6>
                                    <p class="card-text">"<?php echo htmlspecialchars($row['review']); ?>"</p>
                                    <p>Rating: <d style = "color:rgba(245, 223, 18, 0.844);"><?php echo htmlspecialchars( str_repeat('★', $row['rating']) . str_repeat('☆', 5 - $row['rating'])) ?></d> </p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12">
                        <p class="no-reviews">No reviews yet. Be the first to leave a review!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Close the MySQL connection -->
    <?php $conn->close(); ?>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
