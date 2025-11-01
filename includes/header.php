<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle ?? "Lesley Portfolio" ?></title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>
  <nav>
        <div class="nav-container">
            <div class="logo" data-aos="zoom-in" data-aos-duration="1000">
                <span>Lesley</span>
            </div>
            <div class="links">
                <div class="link" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100"><a href="../index.php">Home</a></div>
                <div class="link" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200"><a href="../about.html">About</a></div>
                <div class="link" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400"><a href="../services.html">Services</a></div>
                <div class="link" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400"><a href="../blog/view.php">Blog</a></div>
                <div class="link contact-btn" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600"><a href="../contact.html">Contact Us</a></div>
                <?php
                    if (session_status() === PHP_SESSION_NONE) session_start();
                    if (isset($_SESSION['username'])) {
                        // show logout for logged-in users
                        echo '<div class="link" data-aos="fade-up" data-aos-duration="1000"><a href="../blog/logout.php">Logout (' . htmlspecialchars($_SESSION['username']) . ')</a></div>';
                    } else {
                        echo '<div class="link" data-aos="fade-up" data-aos-duration="1000"><a href="../blog/login.php">Login</a></div>';
                    }
                ?>
            </div>
            <i class="fa-solid fa-bars hamburg" onclick="showMenu()"></i>
        </div>
        <div class="dropdown">
            <div class="links">
                <a href="../index.php">Home</a>
                <a href="/about.html">About</a>
                <a href="/services.html">Services</a>
                <a href="/blog/index.php">Blogs</a>
                <a href="/contact.html">Contact</a>
                <i class="fa-solid fa-xmark cancel" onclick="hideMenu()"></i>
            </div>
        </div>
    </nav>
