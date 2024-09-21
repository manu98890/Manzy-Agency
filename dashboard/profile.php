<?php include '../session_check.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manzy Agency - Profile</title>
    <link rel="stylesheet" href="../res/css/dashboard/profile/styles.css">
    <style>
        /* General reset and body styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f8fc;
            color: #333;
        }

        /* Header section styling */
        header {
            background-color: #ffffff;
            padding: 20px 50px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .logo-container img {
            width: 50px;
        }

        .navbar .logo-name {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-decoration: none;
        }

        .navbar .search-bar {
            display: flex;
            align-items: center;
            background-color: #f1f3f5;
            border-radius: 30px;
            padding: 5px 20px;
        }

        .navbar .search-bar input {
            border: none;
            outline: none;
            background-color: transparent;
            padding: 10px;
            font-size: 16px;
            width: 200px;
        }

        .navbar .discover-btn a,
        .navbar .name-btn a {
            font-size: 16px;
            margin: 0 15px;
            color: #555;
            text-decoration: none;
            padding: 10px;
        }

        .navbar .name-btn a {
            font-weight: bold;
        }

        .navbar .name-btn a:hover {
            color: #007BFF;
        }

        /* Main container styling */
        main {
            display: flex;
            justify-content: space-between;
            padding: 50px;
        }

        /* Sidebar styling */
        .sidebar {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            width: 250px;
        }

        .sidebar a {
            text-decoration: none;
            color: #333;
            font-size: 18px;
            padding: 15px 0;
            display: block;
            margin-bottom: 15px;
            transition: color 0.2s;
        }

        .sidebar a:hover {
            color: #007BFF;
        }

        /* Profile content styling */
        .profile-container {
            flex: 1;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .profile-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .profile-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background-color: #e0e0e0;
            background-image: url('../res/img/dashboard/profile.jpg');
            background-size: cover;
        }

        .profile-details {
            flex: 1;
            padding-left: 20px;
        }

        .profile-name {
            font-size: 26px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .profile-username {
            font-size: 18px;
            color: #777;
            margin-bottom: 20px;
        }

        .profile-bio {
            font-size: 16px;
            color: #555;
        }

        .edit-profile-btn {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
        }

        .edit-profile-btn:hover {
            background-color: #0056b3;
        }

        /* Stats section styling */
        .stats-container {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            border-top: 1px solid #f0f0f0;
            padding-top: 20px;
        }

        .stat-block {
            text-align: center;
            flex: 1;
        }

        .stat-title {
            font-size: 18px;
            color: #555;
        }

        .stat-value {
            font-size: 22px;
            font-weight: bold;
            color: #333;
        }

        /* Weather section styling */
        .weather-widget {
            margin-top: 40px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .weather-widget img {
            width: 60px;
        }

        .weather-info {
            flex: 1;
            padding-left: 20px;
        }

        .weather-info p {
            font-size: 18px;
            color: #555;
        }

        .weather-info .temp {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

    </style>
</head>

<body>

    <header>
        <div class="navbar">
            <div class="logo-container">
                <img src="../res/img/logo.png" alt="Logo">
            </div>
            <a class="logo-name" href="index.php">Manzy Agency</a>
            <div class="search-bar">
                <input type="text" placeholder="Search">
            </div>
            <div class="name-btn">
                <a>@<?php echo htmlspecialchars($_SESSION['username']); ?></a>
            </div>
        </div>
    </header>

    <main>
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <a href="trips.php">Trips</a>
            <a href="hotels.php">Hotels</a>
            <a href="show_booking.php">Booked</a>
            <a href="activate.php">Activate</a>
            <a href="profile.php">Profile Settings</a>
            <a href="../index.html">Logout</a>
        </aside>

        <!-- Profile Container -->
        <section class="profile-container">
            <div class="profile-header">
                <div class="profile-photo"></div>
                <div class="profile-details">
                    <p class="profile-name"><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                    <p class="profile-username">@<?php echo htmlspecialchars($_SESSION['username']); ?></p>
                    <p class="profile-bio">Welcome to Manzy Agency! Explore and book your next adventure.</p>
                </div>
                <a href="edit_profile.php" class="edit-profile-btn">Edit Profile</a>
            </div>

            <!-- Profile Stats -->
            <div class="stats-container">
                <div class="stat-block">
                    <p class="stat-title">Trips</p>
                    <p class="stat-value">1</p>
                </div>
                <div class="stat-block">
                    <p class="stat-title">Hotels</p>
                    <p class="stat-value">2</p>
                </div>
                <div class="stat-block">
                    <p class="stat-title">Rooms</p>
                    <p class="stat-value">1</p>
                </div>
                <div class="stat-block">
                    <p class="stat-title">Activities</p>
                    <p class="stat-value">1</p>
                </div>
            </div>

            <!-- Weather Widget -->
            <div class="weather-widget">
                <img src="http://openweathermap.org/img/wn/01d@2x.png" alt="Weather Icon">
                <div class="weather-info">
                    <p>Weather in Colombo</p>
                    <p class="temp">28°C</p>
                </div>
            </div>
        </section>
    </main>

</body>

</html>
