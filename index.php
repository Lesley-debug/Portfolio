<?php
session_start();
$isAdminLoggedIn = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <title>Lesley Portfolio</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>
    <nav>
        <div class="nav-container">
            <div class="logo" data-aos="zoom-in" data-aos-duration="1000">
                <span>Lesley Tabi</span>
            </div>
            <div class="links">
                <div class="link" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100"><a href="index.php">Home</a></div>
                <div class="link" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200"><a href="about.html">About</a></div>
                <div class="link" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400"><a href="services.html">Services</a></div>
                <div class="link" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500"><a href="blog/index.php">Blogs</a></div>
                <div class="link contact-btn" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600"><a href="contact.html">Contact Us</a></div>
            </div>
            <i class="fa-solid fa-bars hamburg" onclick="hamburg()"></i>
        </div>
        <div class="dropdown">
            <div class="links">
                <a href="index.php">Home</a>
                <a href="about.html">About</a>
                <a href="services.html">Services</a>
                <a href="blog/index.php">Blogs</a>
                <a href="contact.html">Contact</a>
                <i class="fa-solid fa-xmark cancel" onclick="cancel()"></i>
            </div>
        </div>
    </nav>
        <section>
            <div class="main-container">
                <div class="about-image" data-aos="fade-right" data-aos-duration="1200">
                <img src="images/lesleyshort.png" alt="Lesley Tabi" style="width: 350px;">
            </div>
                <div class="content">
                    <h1 data-aos="fade-left" data-aos-duration="1000" data-aos-delay="800">Hey I'm <span>Lesley Tabi</span></h1>
                    <div class="typewriter" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="900">I'm a <span></span></div>
                    <p data-aos="flip-up" data-aos-duration="1000" data-aos-delay="1000"><p>
          Hi, I'm <strong>Lesley Tabi</strong> — a passionate backend developer,
          graphics designer, and video editor who loves building powerful digital experiences.
        </p>

        <p>
          As a backend developer, I create secure and efficient web applications
          using <strong>PHP</strong> (Laravel, OOP, MVC), <strong>MySQL</strong>,
          and <strong>API integration</strong>. My focus is on writing clean and scalable code
          that enhances user experiences.
        </p>

        <p>
          My creativity extends to <strong>graphic design</strong> and
          <strong>video editing</strong> — I enjoy turning ideas into visuals that communicate,
          inspire, and engage.
        </p></p>
                    <div class="social-links" data-aos="flip-down" data-aos-duration="1000" data-aos-delay="1200">
                        <a href="https://github.com/Lesley-debug" ><i class="fa-brands fa-github"></i></a>
                        <a href="https://www.facebook.com/profile.php?id=100063757374130"><i class="fa-brands fa-facebook"></i></a>
                        <a href="https://www.linkedin.com/in/esang-lesley-a0b1a1267?trk=contact-info"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="https://x.com/esanglesley1"><i class="fa-brands fa-x-twitter"></i></a>
                    </div>
                    <div class="btn" data-aos="zoom-out-left" data-aos-duration="1000" data-aos-delay="1300">
                        <button>Download CV</button>
                    </div>
                </div>
            </div>
        </section>

        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
          AOS.init({offset:0});
        </script>
        <script src="js/nav.js"></script>

        <!-- FOOTER -->
        <footer>
            <p>© 2025 Lesley Tabi. All Rights Reserved.</p>
        </footer>

       <script>
            // Secret name sequence
            const secretName = "lesley"; // all lowercase
            let typed = "";

            // Admin login state from PHP
            const isLoggedIn = <?php echo json_encode($isAdminLoggedIn); ?>;

            document.addEventListener('keydown', function(e) {
                typed += e.key.toLowerCase(); // convert key to lowercase

                if (typed.endsWith(secretName)) {
                    if (isLoggedIn) {
                        window.location.href = 'admin/dashboard.php';
                    } else {
                        window.location.href = 'admin/login.php';
                    }
                    typed = ""; // reset after trigger
                }

                // Limit typed string length
                if (typed.length > secretName.length) {
                    typed = typed.slice(-secretName.length);
                }
            });
        </script>

</body>
</html>