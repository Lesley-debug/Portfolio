<?php 
include '../includes/auth.php';
include '../includes/config.php';

// Get project by ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM blog_posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $project = $result->fetch_assoc();

    if (!$project) {
        echo "<p>Project not found.</p>";
        exit;
    }
} else {
    echo "<p>Invalid project ID.</p>";
    exit;
}

// Update project
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $image = $project['image'];

    // Handle new image upload
    if (!empty($_FILES['image']['name'])) {
        $image = time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/" . $image);
    }

    $update_sql = "UPDATE blog_posts SET title=?, description=?, category=?, image=? WHERE id=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssssi", $title, $description, $category, $image, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }
}
?>

<div class="project-form-container">
    <h2>Edit Project</h2>
    <form method="POST" enctype="multipart/form-data" class="project-form">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($project['title']); ?>" required>

        <label for="description">Description</label>
        <textarea name="description" id="description" required><?php echo htmlspecialchars($project['description']); ?></textarea>

        <label for="category">Category</label>
        <input type="text" name="category" id="category" value="<?php echo htmlspecialchars($project['category']); ?>">

        <label for="image">Image</label>
        <input type="file" name="image" id="image" accept="image/*" onchange="previewImage(event)">
        <div class="image-preview">
            <?php if (!empty($project['image'])): ?>
                <img id="preview" src="../uploads/<?php echo $project['image']; ?>" alt="Current Image">
            <?php else: ?>
                <img id="preview" src="#" alt="Image Preview" style="display: none;">
            <?php endif; ?>
        </div>

        <button type="submit" class="btn-submit">💾 Update Project</button>
    </form>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    preview.src = URL.createObjectURL(event.target.files[0]);
    preview.style.display = 'block';
}
</script>

<style>
    /* ===== Edit Project Page Styles ===== */
body {
  font-family: 'Poppins', sans-serif;
  background: #f4f7fc;
  color: #333;
  margin: 0;
  padding: 40px 0;
}

.project-form-container {
  background: #fff;
  max-width: 700px;
  margin: auto;
  padding: 40px;
  border-radius: 15px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.project-form-container h2 {
  text-align: center;
  color: #0d6efd;
  font-size: 1.8rem;
  margin-bottom: 30px;
  border-bottom: 2px solid #0d6efd;
  display: inline-block;
  padding-bottom: 5px;
}

.project-form {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.project-form label {
  font-weight: 600;
  color: #333;
}

.project-form input[type="text"],
.project-form input[type="file"],
.project-form textarea {
  width: 100%;
  padding: 12px 14px;
  border: 1px solid #ccc;
  border-radius: 10px;
  font-size: 1rem;
  transition: all 0.3s ease;
  background: #fafafa;
}

.project-form input[type="text"]:focus,
.project-form textarea:focus {
  border-color: #0d6efd;
  background: #fff;
  outline: none;
}

.project-form textarea {
  min-height: 150px;
  resize: vertical;
}

.image-preview {
  text-align: center;
}

.image-preview img {
  max-width: 100%;
  height: auto;
  border-radius: 12px;
  margin-top: 10px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.btn-submit {
  background: #0d6efd;
  color: #fff;
  border: none;
  padding: 14px;
  font-size: 1.1rem;
  border-radius: 10px;
  cursor: pointer;
  transition: all 0.3s ease;
  font-weight: 600;
}

.btn-submit:hover {
  background: #0056b3;
  transform: translateY(-2px);
}

@media (max-width: 600px) {
  .project-form-container {
    padding: 25px;
  }

  .project-form-container h2 {
    font-size: 1.5rem;
  }
}

</style>
