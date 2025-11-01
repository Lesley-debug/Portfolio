<?php
include '../includes/config.php';
include '../includes/auth.php';

// Ensure only admin can access
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}


// Fetch logged in username
$username = isset($_SESSION['username']) ? ucfirst($_SESSION['username']) : "Admin";
?>

<!-- ===== ADMIN DASHBOARD HEADER ===== -->
<section class="admin-welcome">
    <div class="container">
        <h1>Welcome back, <span><?php echo htmlspecialchars($username); ?></span> 👋</h1>
        <p>Manage your projects, messages, and content below.</p>
    </div>
</section>

<!-- ===== DASHBOARD CARDS ===== -->
<div class="dashboard-cards">
    <a href="create.php" class="card">
        <h2>➕ Add Project</h2>
        <p>Create a new building project post.</p>
    </a>

    <a href="index.php" class="card">
        <h2>📂 Manage Projects</h2>
        <p>View, edit, or delete existing projects.</p>
    </a>

    <a href="messages.php" class="card">
        <h2>📩 Messages</h2>
        <p>Read messages from the contact form.</p>
    </a>

    <a href="logout.php" class="card logout-card">
        <h2>🚪 Logout</h2>
        <p>Sign out of your account safely.</p>
    </a>
</div>

<style>
    /* === Admin Dashboard Styles === */
body {
    background-color: #f4f6f8;
    font-family: 'Poppins', sans-serif;
    color: #333;
    margin: 0;
    padding: 0;
}

.dashboard-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 2rem;
    padding: 60px 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.card {
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    text-align: center;
    text-decoration: none;
    color: #333;
    transition: all 0.3s ease-in-out;
    border-top: 5px solid #0d6efd; /* Accent color (blue) */
}

.card h2 {
    margin-bottom: 10px;
    font-size: 1.4rem;
}

.card p {
    color: #666;
    font-size: 0.95rem;
}

.card:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    border-top-color: #0056b3;
}

/* Special color for logout card */
.logout-card {
    border-top-color: #dc3545;
}
.logout-card:hover {
    border-top-color: #a71d2a;
}

/* Responsive layout */
@media (max-width: 768px) {
    .dashboard-cards {
        grid-template-columns: 1fr;
        padding: 40px 15px;
    }
}

/* Optional: header spacing if fixed header is used */
/* === Admin Welcome Header === */
.admin-welcome {
    background: linear-gradient(135deg, #0d6efd, #007bff);
    color: white;
    text-align: center;
    padding: 60px 20px 40px;
    border-radius: 0 0 30px 30px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.admin-welcome h1 {
    font-size: 2rem;
    margin-bottom: 10px;
}

.admin-welcome h1 span {
    color: #ffe600;
    font-weight: 600;
}

.admin-welcome p {
    font-size: 1rem;
    opacity: 0.9;
}

</style>