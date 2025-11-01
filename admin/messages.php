<?php
include '../includes/config.php';
include '../includes/auth.php'; // Protect page

// Fetch messages from DB
$sql = "SELECT * FROM messages ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<?php include '../includes/header.php'; ?>

<div class="container">
    <a class="btn-add" href="dashboard.php">Back to Dashboard</a>
    <h1>📩 Contact Messages</h1>

    <?php if ($result->num_rows > 0): ?>
        <table class="messages-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo nl2br(htmlspecialchars($row['message'])); ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No messages yet.</p>
    <?php endif; ?>
</div>

<style>
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
</style>
