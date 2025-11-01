<?php //include 'includes/auth.php'; ?>
<?php  
include '../includes/config.php';
include '../includes/auth.php';

// Fetch project by ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM blog_posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $project = $result->fetch_assoc();

    if (!$project) {
        echo "<div class='project-view-container'><p>Project not found.</p></div>";
        exit;
    }
} else {
    echo "<div class='project-view-container'><p>Invalid project ID.</p></div>";
    //include 'includes/footer.php';
    exit;
}
?>

<div class="project-view-container">
    <div class="project-view-card">
        <?php if (!empty($project['image'])): ?>
            <div class="project-view-image">
                <img src="../uploads/<?php echo htmlspecialchars($project['image']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
            </div>
        <?php endif; ?>

        <div class="project-view-content">
            <h1><?php echo htmlspecialchars($project['title']); ?></h1>
            <p class="category">🏗 Category: <?php echo htmlspecialchars($project['category']); ?></p>
            <p class="description"><?php echo nl2br(htmlspecialchars($project['description'])); ?></p>

            <div class="view-actions">
                <a href="index.php" class="btn-back">← Back to Projects</a>
            </div>
        </div>
    </div>
</div>

<style>
    /* ======== PROJECT VIEW PAGE ======== */
.project-view-container {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 60px 20px;
    background: linear-gradient(135deg, #5ce489 0%, #868b88 50%, #dba47d 100%);
    min-height: 100vh;
    color: #fff;
}

.project-view-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 30px;
    border-radius: 20px;
    width: 100%;
    max-width: 800px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    text-align: center;
}

.project-view-image img {
    width: 100%;
    max-height: 400px;
    object-fit: cover;
    border-radius: 15px;
    margin-bottom: 20px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
}

.project-view-content h1 {
    font-size: 2rem;
    margin-bottom: 10px;
    color: #fff;
}

.project-view-content .category {
    font-size: 1rem;
    color: #e0f7df;
    margin-bottom: 15px;
    font-style: italic;
}

.project-view-content .description {
    font-size: 1rem;
    color: #fff;
    line-height: 1.6;
    margin-bottom: 25px;
    text-align: justify;
}

.view-actions {
    display: flex;
    justify-content: center;
    gap: 15px;
}

.btn-back, .btn-edit {
    background: #fff;
    color: #333;
    padding: 10px 20px;
    border-radius: 25px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-back:hover {
    background: #333;
    color: #fff;
}

.btn-edit {
    background: #5ce489;
}

.btn-edit:hover {
    background: #4ac77b;
    color: #fff;
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .project-view-card {
        padding: 20px;
    }
    .project-view-content h1 {
        font-size: 1.5rem;
    }
    .project-view-content .description {
        font-size: 0.95rem;
    }
}

</style>