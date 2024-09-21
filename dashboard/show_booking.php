<?php
session_start();
include '../conn.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Get the user ID from session
$user_id = $_SESSION['user_id'];

// Fetch hotel bookings for the logged-in user
$hotelBookingsQuery = "SELECT rb.id, h.name, h.description, h.img, rb.roomSize, rb.rooms, rb.days, rb.price, rb.hotel_id
                       FROM roomsBooking rb
                       JOIN Hotels h ON rb.hotel_id = h.id
                       WHERE rb.userid = ?";
$stmt = $conn->prepare($hotelBookingsQuery);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$hotelBookingsResult = $stmt->get_result();

// Fetch package bookings for the logged-in user along with the associated attractions
$packageBookingsQuery = "SELECT p.id, p.package_name, p.district, p.payment_date, tp.image, tp.total_cost, tp.duration, tp.id as package_id
                         FROM payments p
                         JOIN travel_packages tp ON p.package_id = tp.id
                         WHERE p.user_id = ?";
$stmt2 = $conn->prepare($packageBookingsQuery);
$stmt2->bind_param("i", $user_id);
$stmt2->execute();
$packageBookingsResult = $stmt2->get_result();

// Fetch package attractions for each booked package by connecting payments with package_attractions
$attractionsQuery = "SELECT pa.package_id, pa.attraction_name, pa.attraction_cost
                     FROM package_attractions pa
                     JOIN payments p ON pa.package_id = p.package_id
                     WHERE p.user_id = ?";
$stmt3 = $conn->prepare($attractionsQuery);
$stmt3->bind_param("i", $user_id);
$stmt3->execute();
$attractionsResult = $stmt3->get_result();

// Store attractions in an associative array by package_id
$packageAttractions = [];
while ($attraction = $attractionsResult->fetch_assoc()) {
    $packageAttractions[$attraction['package_id']][] = $attraction;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Booked Packages</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Manzy Agency</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="discover.php">Discover</a></li>
                    <li class="nav-item"><a class="nav-link" href="trips.php">Trips</a></li>
                    <li class="nav-item"><a class="nav-link" href="reviews.php">Review</a></li>
                    <li class="nav-item"><a class="nav-link" href="requests.php">Requests</a></li>
                </ul>
                <span class="navbar-text">
                    <a href="profile.php" class="btn btn-outline-light"><?php echo htmlspecialchars($_SESSION['username']); ?></a>
                </span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <!-- Booked Rooms Section -->
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">Booked Rooms</h1>
                <?php if ($hotelBookingsResult->num_rows > 0): ?>
                    <div class="row">
                        <?php while ($booking = $hotelBookingsResult->fetch_assoc()): ?>
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <img src="..\res\img\dashboard\hotels\<?php echo htmlspecialchars($booking['img']); ?>" class="card-img-top" alt="Hotel Image">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($booking['name']); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($booking['description']); ?></p>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Room Size: <?php echo htmlspecialchars($booking['roomSize']); ?></li>
                                            <li class="list-group-item">Rooms: <?php echo htmlspecialchars($booking['rooms']); ?></li>
                                            <li class="list-group-item">Days: <?php echo htmlspecialchars($booking['days']); ?></li>
                                            <li class="list-group-item">Total Price: RS. <?php echo htmlspecialchars($booking['price']); ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning" role="alert">
                        You have no booked rooms.
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Booked Packages Section -->
        <div class="row mt-5">
            <div class="col-12">
                <h1 class="mb-4">Booked Packages</h1>
                <?php if ($packageBookingsResult->num_rows > 0): ?>
                    <div class="row">
                        <?php while ($package = $packageBookingsResult->fetch_assoc()): ?>
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <img src="..\res\img\dashboard\places\<?php echo htmlspecialchars($package['image']); ?>" class="card-img-top" alt="Package Image" style = "height:300px;">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($package['package_name']); ?></h5>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">District: <?php echo htmlspecialchars($package['district']); ?></li>
                                            <li class="list-group-item">Duration: <?php echo htmlspecialchars($package['duration']); ?></li>
                                            <li class="list-group-item">Total Cost: RS. <?php echo htmlspecialchars($package['total_cost']); ?></li>
                                            <li class="list-group-item">Booked On: <?php echo htmlspecialchars($package['payment_date']); ?></li>
                                        </ul>

                                        <!-- Display Package Attractions -->
                                        <?php if (isset($packageAttractions[$package['package_id']])): ?>
                                            <div class="mt-3">
                                                <h6>Attractions:</h6>
                                                <ul class="list-group list-group-flush">
                                                    <?php foreach ($packageAttractions[$package['package_id']] as $attraction): ?>
                                                        <li class="list-group-item">
                                                            <?php echo htmlspecialchars($attraction['attraction_name']); ?> - RS. <?php echo htmlspecialchars($attraction['attraction_cost']); ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning" role="alert">
                        You have no booked packages.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class = "container card">
        <div class="jumbotron">
            <h1 class="display-4">Share Your Experience!</h1>
            <p class="lead">We value your feedback! Help us improve by sharing your travel experiences with others. Let us know how you enjoyed your trip, the places you visited, and the services you received. Your reviews inspire fellow travelers and help us enhance our offerings.</p>
            <hr class="my-4">
            <p>Whether it was a memorable attraction or a cozy hotel stay, your thoughts matter. Take a moment to leave a review and contribute to our community of travel enthusiasts!</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="review.php" role="button">Add Review</a>
            </p>
        </div>
    </div>

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
