<?php include '../session_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manzy-Agency</title>
        <link rel="stylesheet" href="../res/css/dashboard/index/styles.css">
        <link rel="stylesheet" href="../res/css/dashboard/hotels/styles.css">
    </head>
    <body>
        <header>
            <navbar class = "navbar">
                <div class = "logo">
                    <img src = "../res/img/logo.png" alt = "logo" class = "logo-img"></img>
                </div>
                <div class = "logo-name">
                    <a class = "logo-name-text" href = "index.php">Manzy Agency</a>
                </div>
                <div class = "center-container">
                    <a href = "discover.php" class = "center-text">Discover</a>
                    <a href = "trips.php" class = "center-text">Trips</a>
                    <a href = "review.php" class = "center-text">Review</a>
                    <a href = "requests.php" class = "center-text">Requests</a>
                </div>
                <div class = "login-container">
                    <a href = "profile.php" class = "login-btn"><?php echo htmlspecialchars($_SESSION['username']); ?></a>
                </div>
                <div class = "profile-logo">
                    <div class = "prifile-logo-section-fill"></div>
                </div>
            </navbar>
        </header>
        <main>
            <section class = "top-header-section-container"></section>
            <section>
                <div class = "second-section-header2">
                    <h2 class = "main-header2">Go on an award-winning adventure</h2>
                    <h3 class = "seconder-header">2024’s Travelers’ Choice Awards Best of the Best Things To Do</h3>
                    <div class  = "second-section-container">
                        <div class = "small-banner1" onclick="window.location='trips.php'" style ="cursor: pointer;">
                            <h3 class = "image-name text-border" >Nine Arch</h3>
                        </div>
                        <div class = "small-banner2" onclick="window.location='trips.php'" style ="cursor: pointer;">
                            <h3 class = "image-name text-border">Sigiriya</h3>
                        </div>
                        <div class = "small-banner3" onclick="window.location='trips.php'" style = "cursor: pointer;">
                            <h3 class = "image-name text-border">Nilaweli</h3>
                        </div>
                        <div class = "small-banner4" onclick="window.location='trips.php'" style = "cursor: pointer;">
                            <h3 class = "image-name text-border">Trinco</h3>
                        </div>
                    </div>
                </div>
            </section> 
            <section class = "footer-like-section">
                <div class = "footer-header">Explore someplace new with Hotels & Resorts</div>
                <button class = "hotels-btn">Hotels</button>
            </section>
            <!-- Hotel Cards Section -->
            <section class="hotels-section-container">
                <div class="hotel-card-container">
                    <?php
                    include '../conn.php';

                    // Fetch hotel data
                    $sql = "SELECT id ,name, description, img, price FROM Hotels";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="hotel-card">
                                        <img src="../res/img/dashboard/hotels/' . $row["img"] . '" class="" />
                                        <div class="rectangle-border">' . $row["name"] . '</div>
                                        <div class="price-section-container">
                                            <div class="price-tag"></div>
                                            <div class="price">$' . $row["price"] . '</div>
                                        </div>
                                        <form action="booking.php" method="POST">
                                            <input type="hidden" name="id" value="' . $row["id"] . '">
                                            <button class="checkout-btn">Book Now</button>
                                        </form>
                                    </div>';
                        }
                    } else {
                        echo "No hotels available.";
                    }
                    $conn->close();
                    ?>
                </div>
            </section>
        </main>
    </body>
</html>