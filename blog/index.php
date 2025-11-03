<?php
session_start();
// Make sure session is started
include '../includes/config.php';

$is_logged_in = isset($_SESSION['user_id']);
$username = $_SESSION['username'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle ?? "Lesley Portfolio" ?></title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <style>
        .logout-btn {
        color: #fff;
        background: #e74c3c;
        padding: 8px 14px;
        border-radius: 6px;
        transition: background 0.3s;
        text-decoration: none;
    }

    .logout-btn:hover {
        background: #c0392b;
    }

    </style>
</head>
<body>
  <nav>
        <div class="nav-container">
            <div class="logo" data-aos="zoom-in" data-aos-duration="1000">
                <span>Lesley Designs</span>
            </div>
            <div class="links">
                <div class="link" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100"><a href="../index.php">Home</a></div>
                <div class="link" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200"><a href="../about.html">About</a></div>
                <div class="link" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400"><a href="../services.html">Services</a></div>
                <div class="link" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400"><a href="../blog/index.php">Blogs</a></div>
                <div class="link contact-btn" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600"><a href="../contact.html">Contact Us</a></div>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="link" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="700">
                        <a href="logout.php" class="logout-btn">Logout (<?= htmlspecialchars($_SESSION['username']) ?>)</a>
                    </div>
                <?php else: ?>
                    <div class="link" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="700">
                        <a href="login.php">Login</a>
                    </div>
                <?php endif; ?>
            </div>

            <i class="fa-solid fa-bars hamburg" onclick="hamburg()"></i>
        </div>
        <div class="dropdown">
            <div class="links">
                <a href="../index.php">Home</a>
                <a href="../about.html">About</a>
                <a href="../services.html">Services</a>
                <a href="../blog/index.php">Blogs</a>
                <a href="../contact.html">Contact</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="logout.php" class="logout-btn">Logout (<?= htmlspecialchars($_SESSION['username']) ?>)</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                <?php endif; ?>

                <i class="fa-solid fa-xmark cancel" onclick="cancel()"></i>
            </div>
        </div>
    </nav>


    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include '../includes/config.php';
    // include '../includes/auth.php';
    //include '../includes/header.php';

    // Determine current viewer: prefer logged-in user ID, else use visitor ID from cookie
    //session_start();
    $user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : null;
    if (!$user_id) {
        if (!isset($_COOKIE['visitor_id'])) {
            $visitor_id = bin2hex(random_bytes(16));
            setcookie('visitor_id', $visitor_id, time() + (10 * 365 * 24 * 60 * 60), '/');
            $_COOKIE['visitor_id'] = $visitor_id;
        } else {
            $visitor_id = $_COOKIE['visitor_id'];
        }
    }

    // Check if user is logged in
    $is_logged_in = isset($_SESSION['user_id']);

    // Fetch projects (limit to 3 if not logged in)
    $sql = $is_logged_in
        ? "SELECT * FROM blog_posts ORDER BY created_at DESC"
        : "SELECT * FROM blog_posts ORDER BY created_at DESC LIMIT 3";

    $result = $conn->query($sql);
    ?>

    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>

    ```
    <div style="background-color:#d4edda;color:#155724;padding:10px;border-radius:5px;margin:20px auto;max-width:800px;">
        ✅ Your comment has been added successfully!
    </div>
    ```

    <?php endif; ?>

    <!-- ===== MAIN CONTENT ===== -->

    <main>
        <section class="homepage-intro">
            <h1>Welcome to My Blog Site</h1>
            <h2>View All Projects</h2>

    ```
        <div class="projects-grid">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                // Get total comments for this post
                $commentCountQuery = $conn->prepare("SELECT COUNT(*) AS total_comments FROM comments WHERE post_id = ?");
                $commentCountQuery->bind_param("i", $row['id']);
                $commentCountQuery->execute();
                $commentCountResult = $commentCountQuery->get_result();
                $commentData = $commentCountResult->fetch_assoc();
                $totalComments = $commentData['total_comments'];

                // Get total likes for this post
                $likeQuery = $conn->prepare("SELECT COUNT(*) AS total_likes FROM likes WHERE post_id = ?");
                $likeQuery->bind_param("i", $row['id']);
                $likeQuery->execute();
                $likeResult = $likeQuery->get_result();
                $likeData = $likeResult->fetch_assoc();
                $totalLikes = $likeData['total_likes'];
                // Check if current viewer already liked this post
                $liked = false;
                if ($user_id) {
                    $checkLike = $conn->prepare("SELECT id FROM likes WHERE post_id = ? AND user_id = ? LIMIT 1");
                    if ($checkLike) {
                        $checkLike->bind_param("ii", $row['id'], $user_id);
                        $checkLike->execute();
                        $res = $checkLike->get_result();
                        if ($res && $res->num_rows > 0) $liked = true;
                    }
                } else {
                    $checkLike = $conn->prepare("SELECT id FROM likes WHERE post_id = ? AND visitor_id = ? LIMIT 1");
                    if ($checkLike) {
                        $checkLike->bind_param("is", $row['id'], $visitor_id);
                        $checkLike->execute();
                        $res = $checkLike->get_result();
                        if ($res && $res->num_rows > 0) $liked = true;
                    }
                }
        ?>
                <div class="project-card" data-aos="fade-up" data-aos-duration="900">
                    <?php if (!empty($row['image'])): ?>
                        <div class="project-image">
                            <a href="view.php?id=<?= $row['id'] ?>" class="image-link">
                                <img src="../uploads/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="project-info">
                        <h3>
                            <a href="view.php?id=<?= $row['id'] ?>"><?= htmlspecialchars($row['title']) ?></a>
                        </h3>
                        <p><?= htmlspecialchars(substr($row['description'], 0, 150)) ?>...</p>

                        <!-- Actions: likes & comments inline -->
                        <div class="post-actions">
                            <button class="like-btn has-tooltip" data-id="<?= $row['id'] ?>" data-liked="<?= $liked ? '1' : '0' ?>" data-tooltip="<?= $liked ? 'Unlike this post' : 'Like this post' ?>">
                                <span class="like-icon"><?= $liked ? '💙' : '👍' ?></span>
                                <span class="like-text"><?= $liked ? 'Unlike' : 'Like' ?></span>
                                <span class="like-count" id="like-count-<?= $row['id'] ?>"> <?= $totalLikes ?></span>
                            </button>

                            <a href="view.php?id=<?= $row['id'] ?>" class="comment-link has-tooltip" data-tooltip="View comments">
                                💬 <span class="comment-count"><?= $totalComments ?></span>
                            </a>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<p>No projects found.</p>";
        }
        ?>
        </div>
    </section>
    ```

    </main>

    </div>

    <style>
    /* ===== Blog Projects Page ===== */
    body {
        font-family: 'Poppins', sans-serif;
        /* match main pages background */
        background: linear-gradient(to right, rgb(255,255,255), rgb(254,215,173));
        margin: 0;
        padding: 0;
        color: #333;
    }

    .homepage-intro {
        max-width: 1200px;
        margin: 50px auto 20px auto;
        padding: 0 20px;
        text-align: center;
    }

    .homepage-intro h1 {
        font-size: 2.5rem;
        color: #0d6efd;
        margin-bottom: 10px;
    }

    .homepage-intro h2 {
        font-size: 1.8rem;
        margin-bottom: 40px;
        color: #333;
    }

    /* Projects grid */
    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        padding-bottom: 50px;
    }

    /* Individual project card */
    .project-card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .project-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .project-image img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        display: block;
        transition: transform 0.3s ease;
    }
    
    .project-image .image-link {
        display: block;
        overflow: hidden;
        cursor: pointer;
    }

    .project-image .image-link:hover img {
        transform: scale(1.05);
    }

    .project-info {
        padding: 20px;
    }

    .project-info h3 {
        margin: 0 0 10px 0;
        font-size: 1.4rem;
        color: #0d6efd;
    }

    .project-info h3 a {
        text-decoration: none;
        color: inherit;
        transition: color 0.2s;
    }

    .project-info h3 a:hover {
        color: #0056b3;
    }

    .project-info p {
        color: #555;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    /* Actions (like/comment) */
    .post-actions .like-btn {
        display:inline-flex;
        align-items:center;
        gap:8px;
        font-weight:600;
        padding:6px 12px;
        border-radius:6px;
        border: none;
    }
    .post-actions .comment-link { color:#555; }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .homepage-intro h1 {
            font-size: 2rem;
        }

        .homepage-intro h2 {
            font-size: 1.5rem;
        }

        .project-image img {
            height: 180px;
        }
    }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    $(document).ready(function() {
        $('.like-btn').click(function() {
            var btn = $(this);
            var postId = btn.data('id');
            // optimistic disable
            btn.prop('disabled', true);
            $.ajax({
                url: 'like_post.php',
                method: 'POST',
                dataType: 'json',
                data: { post_id: postId },
            }).done(function(response) {
                if (!response || typeof response.total_likes === 'undefined') return;
                // update count
                $('#like-count-' + postId).text(' ' + response.total_likes);
                // toggle button state using data attribute and CSS classes (no inline styles)
                if (response.status === 'liked') {
                    btn.attr('data-liked', '1');
                    btn.find('.like-icon').text('💙');
                    btn.find('.like-text').text('Unlike');
                    btn.attr('data-tooltip', 'Unlike this post');
                    btn.addClass('like-animate');
                } else {
                    btn.attr('data-liked', '0');
                    btn.find('.like-icon').text('👍');
                    btn.find('.like-text').text('Like');
                    btn.attr('data-tooltip', 'Like this post');
                    btn.addClass('like-animate');
                }
                setTimeout(function(){ btn.removeClass('like-animate'); }, 350);
            }).fail(function() {
                // noop
            }).always(function() {
                btn.prop('disabled', false);
            });
        });
    });
    </script>
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init({ offset: 0, duration: 800 });
        </script>
        <script src="../js/nav.js"></script>
    <footer>
        <p>© 2025 Lesley Tabi. All Rights Reserved.</p>
    </footer>

</body>
</html>
