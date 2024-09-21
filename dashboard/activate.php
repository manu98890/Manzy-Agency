<?php include '../session_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manzy-Agency</title>
        <link rel="stylesheet" href="../res/css/dashboard/index/styles.css">
        <link rel="stylesheet" href="../res/css/dashboard/activate/styles.css">
    </head>
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
    <body>
        <main>
            <section class = "default-cards">
                <div class = "image-container"></div>
                <a class = "default-activation" href = "default-activate.php">Default Activation</a>
            </section>
            <section class = "default-cards card2">
                <div class = "image-container"></div>
                <a class = "default-activation">Custom Activation</a>
            </section>
        </main>
    </body>
</html>