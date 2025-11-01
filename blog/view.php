<?php
session_start();
include '../includes/config.php';

// Validate post id
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);

// Fetch the post using MySQLi
$stmt = $conn->prepare("SELECT * FROM blog_posts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    // If post not found, go back to index
    header("Location: index.php");
    exit;
}

// Determine viewer: prefer logged-in user
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

// Handle new comment submission BEFORE any output (so header redirect works)
$comment_error = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment_submit'])) {
    $name = trim($_POST['name'] ?? '');
    $comment = trim($_POST['comment'] ?? '');

    if ($name !== '' && $comment !== '') {
        $ins = $conn->prepare("INSERT INTO comments (post_id, name, comment) VALUES (?, ?, ?)");
        $ins->bind_param("iss", $id, $name, $comment);
        $ins->execute();

        // Redirect to blog index with success flag
        header("Location: index.php?success=1");
        exit;
    } else {
        $comment_error = 'Please fill in all fields.';
    }
}

// Get total likes for this post
$likeQuery = $conn->prepare("SELECT COUNT(*) AS total_likes FROM likes WHERE post_id = ?");
$likeQuery->bind_param("i", $id);
$likeQuery->execute();
$likeResult = $likeQuery->get_result();
$likeData = $likeResult->fetch_assoc();
$totalLikes = $likeData['total_likes'] ?? 0;

// Get comments count early
$commentCountQuery = $conn->prepare("SELECT COUNT(*) as comment_count FROM comments WHERE post_id = ?");
$commentCountQuery->bind_param("i", $id);
$commentCountQuery->execute();
$commentCountResult = $commentCountQuery->get_result();
$commentCountData = $commentCountResult->fetch_assoc();
$totalComments = $commentCountData['comment_count'] ?? 0;

// Check if current viewer already liked this post
$liked = false;
if ($user_id) {
    $checkLike = $conn->prepare("SELECT id FROM likes WHERE post_id = ? AND user_id = ? LIMIT 1");
    if ($checkLike) {
        $checkLike->bind_param("ii", $id, $user_id);
        $checkLike->execute();
        $res = $checkLike->get_result();
        if ($res && $res->num_rows > 0) { $liked = true; }
    }
} else {
    $checkLike = $conn->prepare("SELECT id FROM likes WHERE post_id = ? AND visitor_id = ? LIMIT 1");
    if ($checkLike) {
        $checkLike->bind_param("is", $id, $visitor_id);
        $checkLike->execute();
        $res = $checkLike->get_result();
        if ($res && $res->num_rows > 0) { $liked = true; }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $post['title'] ? htmlspecialchars($post['title']) : 'Blog Post' ?></title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

        <style>
    body {
        font-family: 'Poppins', sans-serif;
        /* match main pages background */
        background: linear-gradient(to right, rgb(255,255,255), rgb(254,215,173));
        color: #333;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 50px auto;
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    .container h1 {
        text-align: center;
        margin-bottom: 15px;
        color: #0d6efd;
    }

    .meta {
        font-size: 0.9rem;
        color: #888;
        text-align: center;
        margin-bottom: 20px;
    }

    .container img {
        display: block;
        margin: 0 auto 20px;
        max-width: 100%;
        border-radius: 10px;
    }

    .container p {
        line-height: 1.7;
        color: #555;
    }

    hr {
        margin: 30px 0;
    }

    h2 {
        color: #0d6efd;
        margin-bottom: 15px;
    }

    /* Comment box */
    .comment-box {
        border: 1px solid #ddd;
        padding: 12px;
        margin-bottom: 10px;
        border-radius: 8px;
        background: #fafafa;
    }

    .comment-box strong {
        color: #333;
    }

    .comment-box small {
        color: #888;
    }

    /* Comment form */
    form {
        margin-top: 20px;
    }

    form input, form textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 1rem;
    }

    form button {
        background-color: #0d6efd;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: background 0.3s, transform 0.2s;
    }

    form button:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 30px;
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
    }

    .back-link:hover {
        text-decoration: underline;
    }
    </style>
    </head>
    <body>

  <nav>
        <div class="nav-container">
            <div class="logo" data-aos="zoom-in" data-aos-duration="1000">
                <span>Lesley Tabi</span>
            </div>
            <div class="links">
                <div class="link" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100"><a href="../index.php">Home</a></div>
                <div class="link" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200"><a href="../about.html">About</a></div>
                <div class="link" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400"><a href="../services.html">Services</a></div>
                <div class="link" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400"><a href="index.php">Blogs</a></div>
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
                <a href="index.php">Blogs</a>
                <a href="../contact.html">Contact</a>
                <i class="fa-solid fa-xmark cancel" onclick="cancel()"></i>
            </div>
        </div>
    </nav>

    <div class="container" data-aos="fade-up" data-aos-duration="1000">
        <!-- Post Section -->
        <h1><?= htmlspecialchars($post['title']) ?></h1>
        <div class="meta">Posted on <?= htmlspecialchars($post['created_at']) ?></div>

        <?php if (!empty($post['image'])): ?>
            <a href="../uploads/<?= htmlspecialchars($post['image']) ?>" target="_blank" class="post-image-link" title="Click to view full size">
                <img src="../uploads/<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>">
            </a>
        <?php endif; ?>


        <p><?= nl2br(htmlspecialchars($post['description'])) ?></p>

        <!-- Actions: likes & comments inline -->
        <div class="post-actions">
            <button class="like-btn has-tooltip" data-id="<?= $id ?>" data-liked="<?= $liked ? '1' : '0' ?>" data-tooltip="<?= $liked ? 'Unlike this post' : 'Like this post' ?>">
                <span class="like-icon"><?= $liked ? '💙' : '👍' ?></span>
                <span class="like-text"><?= $liked ? 'Unlike' : 'Like' ?></span>
                <span class="like-count" id="like-count-<?= $id ?>"> <?= $totalLikes ?></span>
            </button>
            <a href="#comments" class="comment-link has-tooltip" data-tooltip="View comments">
                 💬 <span class="comment-count"><?= $totalComments ?></span>
            </a>
        </div>

        <hr>

        <!-- ===== Comments Section ===== -->
        <h2>Comments</h2>

        <?php
        // Show success or error messages from the submission
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            echo '<div style="background-color:#d4edda;color:#155724;padding:10px;border-radius:5px;margin:10px 0;">✅ Your comment has been added successfully!</div>';
        }
        if (!empty($comment_error)) {
            echo '<div style="color:#a94442;background:#f2dede;padding:10px;border-radius:5px;margin:10px 0;">' . htmlspecialchars($comment_error) . '</div>';
        }

        // Fetch comments for this post
        $commentQuery = $conn->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY created_at DESC");
        $commentQuery->bind_param("i", $id);
        $commentQuery->execute();
        $comments = $commentQuery->get_result();

        if ($comments->num_rows > 0) {
            while ($c = $comments->fetch_assoc()) {
                echo "<div class='comment-box'>";
                echo "<strong>" . htmlspecialchars($c['name']) . "</strong> ";
                echo "<small>(" . htmlspecialchars($c['created_at']) . ")</small>";
                echo "<p>" . nl2br(htmlspecialchars($c['comment'])) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No comments yet. Be the first to comment!</p>";
        }
        ?>

        <!-- Comment Form -->
        <form method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" required>

            <label for="comment">Comment:</label>
            <textarea name="comment" rows="4" required></textarea>

            <button type="submit" name="comment_submit">Submit Comment</button>
        </form>

        <a class="back-link" href="index.php">← Back to Blog</a>
    </div>

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
    <script src="../js/nav.js"></script>
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init({ offset: 0, duration: 800 });
        </script>

        <footer>
            <p>© 2025 Lesley Tabi. All Rights Reserved.</p>
        </footer>


</body>
</html>
