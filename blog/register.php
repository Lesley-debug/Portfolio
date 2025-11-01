<?php
session_start();
include '../includes/config.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Account created! You can login now.";
        header("Location: login.php");
        exit;
    } else {
        $message = "Error: " . $stmt->error;
    }
}
?>
    <style>
        /* ===== Authentication Page ===== */
.auth-page {
display: flex;
align-items: center;
justify-content: center;
min-height: 100vh;
background: linear-gradient(135deg, #f8e7d0 0%, #fff 100%);
font-family: 'Poppins', sans-serif;
padding: 20px;
}

/* ===== Login Box ===== */
.auth-box {
width: 100%;
max-width: 420px;
background: rgba(255, 255, 255, 0.75);
backdrop-filter: blur(12px);
border-radius: 16px;
padding: 40px 32px;
box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
border: 1px solid rgba(255, 255, 255, 0.5);
animation: fadeIn 0.8s ease;
}

/* ===== Header ===== */
.auth-box h2 {
text-align: center;
font-size: 1.7rem;
color: #6d4300;
margin-bottom: 10px;
letter-spacing: -0.5px;
}

.auth-box p {
text-align: center;
font-size: 0.95rem;
color: #777;
margin-bottom: 20px;
}

/* ===== Error Message ===== */
.auth-errors {
background: #fff2f2;
color: #d9534f;
border-left: 4px solid #d9534f;
padding: 10px 14px;
border-radius: 8px;
margin-bottom: 16px;
font-size: 0.95rem;
}

/* ===== Form Fields ===== */
.auth-form .form-group {
margin-bottom: 16px;
}

.auth-form label {
display: block;
font-weight: 600;
color: #333;
margin-bottom: 6px;
font-size: 0.95rem;
}

.auth-form input {
width: 100%;
padding: 12px 14px;
border-radius: 10px;
border: 1px solid #ddd;
background: #fff;
font-size: 1rem;
transition: all 0.2s ease;
}

.auth-form input:focus {
outline: none;
border-color: #6d4300;
box-shadow: 0 0 6px rgba(109, 67, 0, 0.2);
}

/* ===== Button ===== */
.btn-primary {
width: 100%;
padding: 12px 16px;
border-radius: 10px;
border: none;
background: #6d4300;
color: #fff;
font-weight: 600;
font-size: 1rem;
cursor: pointer;
transition: all 0.25s ease;
}

.btn-primary:hover {
background: #8a3e00;
transform: translateY(-2px);
}

/* ===== Links ===== */
.auth-links {
margin-top: 20px;
text-align: center;
font-size: 0.95rem;
color: #444;
}

.auth-links a {
color: #6d4300;
text-decoration: none;
font-weight: 600;
transition: color 0.2s ease;
}

.auth-links a:hover {
color: #8a3e00;
text-decoration: underline;
}

/* ===== Animation ===== */
@keyframes fadeIn {
from { opacity: 0; transform: translateY(15px); }
to { opacity: 1; transform: translateY(0); }
}

/* ===== Responsive ===== */
@media (max-width: 520px) {
.auth-box {
padding: 30px 22px;
border-radius: 12px;
}
.auth-box h2 {
font-size: 1.4rem;
}
}

/* ===== Dark Mode ===== */
@media (prefers-color-scheme: dark) {
.auth-page {
background: linear-gradient(135deg, #1f1b16 0%, #2a231a 100%);
}

.auth-box {
    background: rgba(35, 30, 25, 0.85);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.6);
}

.auth-box h2 {
    color: #f6d49a;
}

.auth-box p {
    color: #bbb;
}

.auth-form label {
    color: #eee;
}

.auth-form input {
    background: #2d2620;
    border: 1px solid #3a322a;
    color: #f2f2f2;
}

.auth-form input:focus {
    border-color: #f6d49a;
    box-shadow: 0 0 6px rgba(246, 212, 154, 0.25);
}

.btn-primary {
    background: #f6d49a;
    color: #2a231a;
}

.btn-primary:hover {
    background: #f5c673;
    transform: translateY(-2px);
}

.auth-links {
    color: #ccc;
}

.auth-links a {
    color: #f6d49a;
}

.auth-links a:hover {
    color: #ffdb9a;
}

.auth-errors {
    background: rgba(255, 90, 90, 0.12);
    color: #ff8c8c;
    border-left: 4px solid #ff8c8c;
}
}
    </style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lesley|Portfolio</title>
</head>
<body class="auth-page">
    <main class="auth-container">
        <div class="auth-box">
            <h2>Sign Up Here</h2>
            <?php if ($message): ?>
                <p class="auth-errors <?= strpos($message, '✅') !== false ? 'success' : '' ?>">
                    <?= htmlspecialchars($message) ?>
                </p>
            <?php endif; ?>

            <form method="POST" class="auth-form">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit" class="btn-primary">Sign Up</button>
            </form>

            <div class="auth-links">
                <p>Already have an account? <a href="login.php" class="auth-links">Login here</a></p>
            </div>
        </div>
    </main>
</body>
</html>