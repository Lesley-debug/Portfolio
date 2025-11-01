<?php 
include '../includes/auth.php'; 
include '../includes/config.php';
?>

<div class="projects-admin">
    <h2>Manage Projects</h2>
    <a class="btn-add" href="dashboard.php">Back to Dashboard</a>
    <a class="btn-add" href="create.php">➕ Add New Project</a>

    <?php
    $sql = "SELECT * FROM blog_posts ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo "<table class='projects-table'>";
        echo "<tr><th>Title</th><th>Category</th><th>Image</th><th>Actions</th></tr>";
        while($row = $result->fetch_assoc()) {
            $imagePath = !empty($row['image']) ? '../uploads/' . htmlspecialchars($row['image']) : '../css/no-image.png';
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['title']) . "</td>";
            echo "<td>" . htmlspecialchars($row['category']) . "</td>";
            echo "<td><img src='$imagePath' alt='" . htmlspecialchars($row['title']) . "'></td>";
            echo "<td class='actions'>
                    <a class='edit' href='edit.php?id=" . $row['id'] . "'>✏ Edit</a> 
                    <a class='delete' href='delete.php?id=" . $row['id'] . "' onclick=\"return confirm('Delete this project?');\">🗑 Delete</a>
                    <a class='view' href='view.php?id=" . $row['id'] . "' target='_blank'>👁 View</a>
                  </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No projects found.</p>";
    }
    ?>
</div>

<style>
/* ===== Manage Projects Styles ===== */
.projects-admin {
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 20px;
    font-family: 'Poppins', sans-serif;
}

.projects-admin h2 {
    font-size: 2rem;
    color: #0d6efd;
    margin-bottom: 20px;
    text-align: center;
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

.projects-table {
    width: 100%;
    border-collapse: collapse;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.projects-table th, .projects-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.projects-table th {
    background-color: #0d6efd;
    color: white;
    font-weight: 600;
}

.projects-table tr:hover {
    background-color: #f1f5f9;
}

.projects-table img {
    max-width: 80px;
    border-radius: 8px;
}

.actions a {
    display: inline-block;
    margin-right: 8px;
    padding: 5px 10px;
    border-radius: 8px;
    text-decoration: none;
    color: white;
    font-size: 0.9rem;
    transition: all 0.2s;
}

.actions a.edit { background-color: #ffc107; }
.actions a.edit:hover { background-color: #e0a800; }

.actions a.delete { background-color: #dc3545; }
.actions a.delete:hover { background-color: #a71d2a; }

.actions a.view { background-color: #0d6efd; }
.actions a.view:hover { background-color: #0056b3; }

p {
    text-align: center;
    font-size: 1.1rem;
    margin-top: 30px;
    color: #555;
}
</style>
