<?php
include '../session_check.php';
include '../conn.php';

$userId = $_SESSION['user_id']; // Get user ID from session

// Fetch bookings for the logged-in user
$sql = "
    SELECT b.id, b.payment_id, b.date, b.activate, p.package_name 
    FROM Booking b
    JOIN payments p ON b.payment_id = p.id
    WHERE p.user_id = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manzy-Agency</title>
        <link rel="stylesheet" href="../res/css/dashboard/index/styles.css">
        <link rel="stylesheet" href="../res/css/dashboard/default-activate/styles.css">
    </head>
    <header>
            <navbar class = "navbar">
                <div class = "logo">
                    <img src = "../res/img/logo.png" alt = "logo" class = "logo-img"></img>
                </div>
                <div class = "logo-name">
                    <a class = "logo-name-text" style ="text-decoration:none;" href = "index.php">Manzy Agency</a>
                </div>
                <div class = "center-container">
                    <a href = "discover.php" class = "center-text">Discover</a>
                    <a href = "trips.php" class = "center-text">Trips</a>
                    <a href = "reviews.php" class = "center-text">Review</a>
                    <a href = "requests.php" class = "center-text">More</a>
                </div>
                <div class = "login-container">
                    <a href = "profile.php" class = "login-btn"><?php echo htmlspecialchars($_SESSION['username']); ?></a>
                </div>
                <div class = "profile-logo">
                    <div class = "prifile-logo-section-fill"></div>
                </div>
            </navbar>
    </header>
    <body>
    <h1>Manage Your Bookings</h1>

    <form method="post" action="update_booking.php">
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Package Name</th>
                    <th>Date</th>
                    <th>Activate</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['package_name']); ?></td>
                    <td>
                        <input type="date" name="date[<?php echo htmlspecialchars($row['id']); ?>]" value="<?php echo htmlspecialchars($row['date']); ?>">
                    </td>
                    <td>
                        <select name="activate[<?php echo htmlspecialchars($row['id']); ?>]">
                            <option value="deactivate" <?php echo $row['activate'] == 'deactivate' ? 'selected' : ''; ?>>Deactivate</option>
                            <option value="activate" <?php echo $row['activate'] == 'activate' ? 'selected' : ''; ?>>Activate</option>
                        </select>
                    </td>
                    <td>
                        <button type="submit" name="submit" value="<?php echo htmlspecialchars($row['id']); ?>">Submit</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </form>

    <?php
    $stmt->close();
    $conn->close();
    ?>


    <!--<section class = "footer-like-section" style = "position:absolute; bottom:0px;">
        <div class = "footer-header">Explore someplace new with Hotels & Resorts</div>
        <button class = "hotels-btn">Hotels</button>
    </section>-->
</body>
</html>