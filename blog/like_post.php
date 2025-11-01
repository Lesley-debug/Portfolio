<?php
session_start();
include '../includes/config.php';

if (isset($_POST['post_id'])) {
    $post_id = intval($_POST['post_id']);

    // Prefer logged-in user id, fallback to visitor cookie
    $user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : null;

    if (!$user_id) {
        if (!isset($_COOKIE['visitor_id'])) {
            $visitor_id = bin2hex(random_bytes(16));
            setcookie('visitor_id', $visitor_id, time() + (10 * 365 * 24 * 60 * 60), '/'); // 10 years
            $_COOKIE['visitor_id'] = $visitor_id;
        } else {
            $visitor_id = $_COOKIE['visitor_id'];
        }
    }

    // Ensure likes table has user_id and visitor_id columns + unique indexes (best-effort)
    $colCheckUser = $conn->query("SHOW COLUMNS FROM likes LIKE 'user_id'");
    if ($colCheckUser && $colCheckUser->num_rows === 0) {
        $conn->query("ALTER TABLE likes ADD COLUMN user_id INT NULL");
        $conn->query("ALTER TABLE likes ADD INDEX idx_post_user (post_id, user_id)");
    }
    $colCheckVisitor = $conn->query("SHOW COLUMNS FROM likes LIKE 'visitor_id'");
    if ($colCheckVisitor && $colCheckVisitor->num_rows === 0) {
        $conn->query("ALTER TABLE likes ADD COLUMN visitor_id VARCHAR(128) NULL");
        $conn->query("ALTER TABLE likes ADD INDEX idx_post_visitor (post_id, visitor_id)");
    }

    // Build check/insert/delete logic depending on whether user is logged in
    if ($user_id) {
        // Check if this user already liked this post
        $checkStmt = $conn->prepare("SELECT id FROM likes WHERE post_id = ? AND user_id = ? LIMIT 1");
        $checkStmt->bind_param("ii", $post_id, $user_id);
        $checkStmt->execute();
        $checkRes = $checkStmt->get_result();

        if ($checkRes && $checkRes->num_rows > 0) {
            $row = $checkRes->fetch_assoc();
            $delStmt = $conn->prepare("DELETE FROM likes WHERE id = ?");
            $delStmt->bind_param("i", $row['id']);
            $delStmt->execute();
            $status = 'unliked';
        } else {
            $stmt = $conn->prepare("INSERT INTO likes (post_id, user_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $post_id, $user_id);
            $stmt->execute();
            $status = 'liked';
        }
    } else {
        // Check if this visitor already liked this post
        $checkStmt = $conn->prepare("SELECT id FROM likes WHERE post_id = ? AND visitor_id = ? LIMIT 1");
        $checkStmt->bind_param("is", $post_id, $visitor_id);
        $checkStmt->execute();
        $checkRes = $checkStmt->get_result();

        if ($checkRes && $checkRes->num_rows > 0) {
            $row = $checkRes->fetch_assoc();
            $delStmt = $conn->prepare("DELETE FROM likes WHERE id = ?");
            $delStmt->bind_param("i", $row['id']);
            $delStmt->execute();
            $status = 'unliked';
        } else {
            $stmt = $conn->prepare("INSERT INTO likes (post_id, visitor_id) VALUES (?, ?)");
            $stmt->bind_param("is", $post_id, $visitor_id);
            $stmt->execute();
            $status = 'liked';
        }
    }

    // Count total likes
    $countStmt = $conn->prepare("SELECT COUNT(*) AS total_likes FROM likes WHERE post_id = ?");
    $countStmt->bind_param("i", $post_id);
    $countStmt->execute();
    $result = $countStmt->get_result();
    $data = $result->fetch_assoc();

    header('Content-Type: application/json');
    echo json_encode(['total_likes' => (int)$data['total_likes'], 'status' => $status]);
}
?>
