<?php include '../session_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manzy-Agency</title>
        <link rel="stylesheet" href="../res/css/dashboard/index/styles.css">
    </head>
    <body>
        <header>
            <navbar class = "navbar">
                <div class = "logo">
                    <img src = "../res/img/logo.png" alt = "logo" class = "logo-img"></img>
                </div>
                <div class = "logo-name">
                    <p class = "logo-name-text">Manzy Agency</p>
                </div>
                <div class = "center-container">
                    <a href = "discover.php" class = "center-text">Discover</a>
                    <a href = "trips.php" class = "center-text">Trips</a>
                    <a href = "show_review.php" class = "center-text">Review</a>
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
            <div class = "main-slogan">
                <h1>Where To?</h1>
            </div>

            <div class = "center-search">
                <div class = "one-search">
                    <img src = "../res/img/search1.svg" class = "svg-icon" alt = "search all">
                    <h4>Search all</h4>
                </div>
                <div class = "one-search">
                    <img src = "../res/img/hotels.svg" class = "svg-icon" alt = "search all">
                    <h4>Hotels</h4>
                </div>
                <div class = "one-search">
                    <img src = "../res/img/activity.svg" class = "svg-icon" alt = "search all">
                    <h4>Activity</h4>
                </div>
                <div class = "one-search">
                    <img src = "../res/img/rooms.svg" class = "svg-icon" alt = "search all">
                    <h4>Rooms</h4>
                </div>
            </div>
            <div class = "searchbar">
                <img src = "../res/img/search.svg" class = "svg-icon" alt = "search all">
                <input type = "text" placeholder = "places to go, things to do, hotels,...."></input>
                <button class = "search-btn" type = "button" id = "search">Search</button>
            </div>
            <div class = "image-banner">
                <div class = "banner-text-container">
                    <h1 class = "trip-planner">Quick and easy trip planner</h1>
                </div>
                <div class = "banner-sub-container">
                    <h3 class = "trip-planner">Pick a vibe and explore the top destinations in Sri Lanka</h3>
                </div>
                <div class ="sub-image-banner" style = "cursor:pointer" onclick="location.href='trips.php';">
                </div>
                <div class ="sub-image-banner2" style = "cursor:pointer" onclick="location.href='trips.php';">
                </div>
            </div>
            <section>
                <div class = "second-section-header">
                    <h2 class = "main-header2">Go on an award-winning adventure</h2>
                    <h3 class = "seconder-header">2024’s Travelers’ Choice Awards Best of the Best Things To Do</h3>
                    <div class  = "second-section-container">
                        <div class = "small-banner1" style = "cursor:pointer" onclick="location.href='trips.php';">
                            <h3 class = "image-name text-border">Nine Arch</h3>
                        </div>
                        <div class = "small-banner2" style = "cursor:pointer" onclick="location.href='trips.php';">
                            <h3 class = "image-name text-border">Sigiriya</h3>
                        </div>
                        <div class = "small-banner3" style = "cursor:pointer" onclick="location.href='trips.php';">
                            <h3 class = "image-name text-border">Nilaweli</h3>
                        </div>
                        <div class = "small-banner4" style = "cursor:pointer" onclick="location.href='trips.php';">
                            <h3 class = "image-name text-border">Trinco</h3>
                        </div>
                    </div>
                </div>
            </section> 
            <section class="third-section">
                <div class = "third-section-header" >
                    <h3 class = "main-header2">Top Experience on Manzy Agency</h3>
                </div>
                <div class  = "third-section-container" style = "cursor:pointer" onclick="location.href='trips.php';">
                    <div class = "small-banner-with-logo bg1">
                        <h3 class = "image-name text-border">Hikkaduwa Beach</h3>
                    </div>
                    <div class = "small-banner-with-logo bg2" style = "cursor:pointer" onclick="location.href='trips.php';">
                        <h3 class = "image-name text-border">Sinharaja Forest</h3>
                    </div>
                    <div class = "small-banner-with-logo bg3" style = "cursor:pointer" onclick="location.href='trips.php';">
                        <h3 class = "image-name text-border">Anuradhapuraya</h3>
                    </div>
                    <div class = "small-banner-with-logo bg4" style = "cursor:pointer" onclick="location.href='trips.php';">
                        <h3 class = "image-name text-border">Galle</h3>
                    </div>
                </div>
            </section>
            <section class = "fouth-banner">
                <div class = "lotus-tower"></div>
                <div class ="fouth-headers">
                    <h3 class = "main-fouth">Where Wanderlust Meets Planning</h3>
                    <h4 class = "main-fouth-sub">Tailored Itineraries for Your Next Great Escape</h4>
                </div>
                <div class = "lines"></div>
                <div class = "sml-logo"></div>
            </section>
            <section class = "fifth-banner">
                <div class = "fifth-main-header">
                    <h3>Hotels Near You</h3>
                </div>
                <div class = "fifth-sub-header">
                    <h4>We think you'd enjoy these hotel for a quick trip out of town.</h4>
                </div>
                <div class = "small-fifth-cards background1">
                    <div class ="logo-tag-fifth"></div>
                    <div class = "fifth-card-name" style = "cursor:pointer" onclick="location.href='hotels.php';">
                        <h4>Queens Hotel</h4>
                    </div>
                </div>
                <div class = "small-fifth-cards background2">
                    <div class ="logo-tag-fifth"></div>
                    <div class = "fifth-card-name" style = "cursor:pointer" onclick="location.href='hotels.php';">
                        <h4>Grand Hyatt Hotel</h4>
                    </div>
                </div>
            </section>
            <section class = "sixth-banner-section">
                <div class = "text-area-section">
                    <h4>Travelers' Choice Awards Best of the Best</h4>
                </div>
                <div class = "align-center">
                    <div class = "main-card-of-sixth-section"></div>
                    <div class = "half-top-circle"></div>
                    <div class = "half-top-circle2"></div>
                    <div class = "logo-on-sixth"></div>
                </div>
            </section>
        </main>
        <script type="module">
            import Typebot from 'https://cdn.jsdelivr.net/npm/@typebot.io/js@0.3/dist/web.js'

            Typebot.initBubble({
                typebot: "customer-support-eq9xqy3",
                theme: {
                button: { backgroundColor: "#0042DA" },
                chatWindow: { backgroundColor: "#fff" },
                },
            });
            </script>
        <footer>
            <div style = "display:block;"><div class = "footer-line-section"></div></div>
            <div class ="footer-logo"></div>
            <div class = "brand-name">
                <h3>Manzy Agency</h3>
            </div>
        </footer>
    </body>
</html>