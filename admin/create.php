<?php
include '../includes/config.php';
include '../includes/auth.php';

// Ensure only admin can access
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$title = $category = $description = '';
$success = ''; // ✅ Define $success here

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);
    $imagePath = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $fileName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $imagePath = $fileName; // store only filename
        }
    }

    if ($title && $category && $description) {
        $stmt = $conn->prepare("INSERT INTO blog_posts (title, category, description, image, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssss", $title, $category, $description, $imagePath);
        $stmt->execute();

        $success = "Blog post created successfully!";
        $title = $category = $description = '';
    } else {
        $success = "Please fill in all fields.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create Post</title>
<link rel="stylesheet" href="../css/style.css">
<style>
/* ===== Create Post Page Styles ===== */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f4f6f8;
    margin: 0;
    padding: 0;
    color: #333;
}

.container {
    max-width: 700px;
    margin: 50px auto;
    background: #fff;
    padding: 40px 30px;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.container h1 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 2rem;
    color: #0d6efd;
}

.div{
    display: inline-block;
    margin-top: 25px;
    margin-left: 15px;
}

.btn-add {
    display: inline-block;
    margin-bottom: 20px;
    padding: 10px 20px;
    background-color: #0d6efd;
    color: white;
    text-decoration: none;
    border-radius: 10px;
    font-weight: 600;
    transition: background 0.3s, transform 0.2s;
}

.btn-add:hover {
    background-color: #0056b3;
    transform: translateY(-2px);
}

form label {
    display: block;
    margin-top: 15px;
    font-weight: 500;
}

form input[type="text"],
form select,
form textarea,
form input[type="file"] {
    width: 100%;
    padding: 12px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.3s;
}

form input[type="text"]:focus,
form select:focus,
form textarea:focus {
    border-color: #0d6efd;
    outline: none;
}

form textarea {
    resize: vertical;
}

button {
    display: block;
    width: 100%;
    padding: 12px;
    margin-top: 25px;
    background-color: #0d6efd;
    border: none;
    color: #fff;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 10px;
    cursor: pointer;
    transition: background 0.3s, transform 0.2s;
}

button:hover {
    background-color: #0056b3;
    transform: translateY(-3px);
}

.success-msg {
    background-color: #d4edda;
    color: #155724;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 15px;
    text-align: center;
}

.error-msg {
    background-color: #f8d7da;
    color: #721c24;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 15px;
    text-align: center;
}
</style>
</head>
<body>
    <div class="div">
        <a class="btn-add" href="dashboard.php">Back to Dashboard</a>
    </div>
<div class="container">
  <h1>Create New Blog Post</h1>
  <?php if ($success): ?>
    <p class="<?= strpos($success,'successfully') !== false ? 'success-msg' : 'error-msg' ?>">
      <?= htmlspecialchars($success) ?>
    </p>
  <?php endif; ?>
  <form method="post" enctype="multipart/form-data">
    <label>Title:</label>
    <input type="text" name="title" value="<?= htmlspecialchars($title) ?>" required>

    <label>Category:</label>
    <select name="category" required>
      <option value="">-- Select Category --</option>
      <option value="Technology">Technology</option>
      <option value="Design">Design</option>
      <option value="Education">Education</option>
      <option value="Lifestyle">Lifestyle</option>
    </select>

    <label>Description:</label>
    <textarea name="description" rows="8" required><?= htmlspecialchars($description) ?></textarea>

    <label>Upload Image:</label>
    <input type="file" name="image" accept="image/*">

    <button type="submit">Create Post</button>
  </form>
</div>
</body>
</html>
