<?php
include '../conn.php';
include '../admin-check.php';
require_once __DIR__ . '../../vendor/autoload.php'; // MPDF autoload file


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 1. Total users
$totalUsersQuery = "SELECT COUNT(*) AS total_users FROM users";
$totalUsersResult = $conn->query($totalUsersQuery);
$totalUsers = $totalUsersResult->fetch_assoc()['total_users'];

// 2. Total bookings
$totalBookingsQuery = "SELECT COUNT(*) AS total_bookings FROM booking WHERE activate = 'activate'";
$totalBookingsResult = $conn->query($totalBookingsQuery);
$totalBookings = $totalBookingsResult->fetch_assoc()['total_bookings'];

// 3. Total payments collected
$totalPaymentsQuery = "SELECT SUM(payment_amount) AS total_payments FROM booking_payments";
$totalPaymentsResult = $conn->query($totalPaymentsQuery);
$totalPayments = $totalPaymentsResult->fetch_assoc()['total_payments'];

// 4. Most popular packages
$popularPackagesQuery = "
    SELECT package_name, COUNT(*) AS total_bookings
    FROM payments
    GROUP BY package_name
    ORDER BY total_bookings DESC
    LIMIT 5
";
$popularPackagesResult = $conn->query($popularPackagesQuery);

// 5. Hotel bookings
$hotelBookingsQuery = "
    SELECT h.name, COUNT(rb.id) AS total_rooms_booked, SUM(rb.price) AS total_earnings
    FROM roomsBooking rb
    JOIN Hotels h ON rb.hotel_id = h.id
    GROUP BY h.name
";
$hotelBookingsResult = $conn->query($hotelBookingsQuery);

// 6. User reviews
$userReviewsQuery = "SELECT email, package_name, review FROM review";
$userReviewsResult = $conn->query($userReviewsQuery);

// 7. Recent requests
$requestsQuery = "SELECT r.email, r.message, u.username 
                  FROM request r
                  JOIN users u ON r.user_id = u.id
                  ORDER BY r.id DESC LIMIT 10";
$requestsResult = $conn->query($requestsQuery);

// Start HTML output buffering
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h1 class="text-center mb-4">Admin Report</h1>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text fs-2"><?= $totalUsers ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Bookings</h5>
                    <p class="card-text fs-2"><?= $totalBookings ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Payments Collected</h5>
                    <p class="card-text fs-2">$<?= number_format($totalPayments, 2) ?></p>
                </div>
            </div>
        </div>
    </div>

    <h3 class="text-center my-4">Most Popular Packages</h3>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Package Name</th>
                <th>Total Bookings</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $popularPackagesResult->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['package_name'] ?></td>
                    <td><?= $row['total_bookings'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h3 class="text-center my-4">Hotel Bookings</h3>
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Hotel Name</th>
                <th>Total Rooms Booked</th>
                <th>Total Earnings ($)</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $hotelBookingsResult->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['total_rooms_booked'] ?></td>
                    <td><?= number_format($row['total_earnings'], 2) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h3 class="text-center my-4">User Reviews</h3>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Email</th>
                <th>Package Name</th>
                <th>Review</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $userReviewsResult->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['package_name'] ?></td>
                    <td><?= $row['review'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h3 class="text-center my-4">Recent Requests</h3>
    <table class="table table-hover table-bordered">
        <thead class="table-light">
            <tr>
                <th>Email</th>
                <th>Username</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $requestsResult->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['username'] ?></td>
                    <td><?= $row['message'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php
$html = ob_get_clean(); // Capture the HTML content

// Create an instance of MPDF and generate the PDF
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);

// Set the file name and force download
$mpdf->Output('admin_report.pdf', \Mpdf\Output\Destination::DOWNLOAD);

$conn->close();
?>
