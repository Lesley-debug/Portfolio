<?php
include '../includes/auth.php';
include '../includes/config.php';

if (!isset($_GET['id'])) {
    echo "<div class='delete-container'><p>Invalid project ID.</p></div>";
    exit;
}

$id = $_GET['id'];

// Fetch project info
$sql = "SELECT * FROM blog_posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$project = $result->fetch_assoc();

if (!$project) {
    echo "<div class='delete-container'><p>Project not found.</p></div>";
    exit;
}

// Handle delete confirmation
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['confirm']) && $_POST['confirm'] === "yes") {
        $sql = "DELETE FROM blog_posts WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            header("Location: index.php?deleted=1");
            exit;
        } else {
            echo "<div class='delete-container'><p>Error deleting project: " . $stmt->error . "</p></div>";
        }
    } else {
        header("Location: index.php");
        exit;
    }
}
?>

<div class="delete-container">
    <div class="delete-card">
        <h2>🗑 Delete Project</h2>
        <p>Are you sure you want to delete this project?</p>
        <h3><?php echo htmlspecialchars($project['title']); ?></h3>

        <?php if (!empty($project['image'])): ?>
            <img src="../uploads/<?php echo htmlspecialchars($project['image']); ?>" alt="Project Image">
        <?php endif; ?>

        <form method="POST">
            <div class="delete-buttons">
                <button type="submit" name="confirm" value="yes" class="btn-delete">Yes, Delete</button>
                <button type="submit" name="confirm" value="no" class="btn-cancel">Cancel</button>
            </div>
        </form>
    </div>
</div>

<style>
    /* ======== DELETE CONFIRMATION PAGE ======== */
.delete-container {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 60px 20px;
    min-height: 100vh;
    background: linear-gradient(135deg, #5ce489 0%, #868b88 50%, #dba47d 100%);
    color: #fff;
}

.delete-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 30px;
    border-radius: 20px;
    text-align: center;
    width: 100%;
    max-width: 600px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.25);
}

.delete-card h2 {
    color: #fff;
    margin-bottom: 10px;
}

.delete-card p {
    font-size: 1rem;
    color: #f8f8f8;
    margin-bottom: 20px;
}

.delete-card h3 {
    font-size: 1.3rem;
    color: #ffe8e8;
    margin-bottom: 20px;
}

.delete-card img {
    width: 100%;
    max-height: 300px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 25px;
}

.delete-buttons {
    display: flex;
    justify-content: center;
    gap: 15px;
}

.btn-delete, .btn-cancel {
    padding: 10px 25px;
    font-size: 1rem;
    border-radius: 25px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-delete {
    background-color: #ff4b4b;
    color: #fff;
}

.btn-delete:hover {
    background-color: #d63b3b;
}

.btn-cancel {
    background-color: #fff;
    color: #333;
}

.btn-cancel:hover {
    background-color: #444;
    color: #fff;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .delete-card {
        padding: 20px;
    }
    .delete-buttons {
        flex-direction: column;
    }
    .btn-delete, .btn-cancel {
        width: 100%;
    }
}
    
</style>