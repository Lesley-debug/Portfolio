<?php
session_start();
include '../includes/config.php';

$message = '';
$token = $_GET['token'] ?? '';

if (!$token) {
    die("Invalid token.");
}

// Check token validity
$stmt = $conn->prepare("SELECT * FROM users WHERE reset_token=? AND reset_expires > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die("Token expired or invalid.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET password=?, reset_token=NULL, reset_expires=NULL WHERE reset_token=?");
    $stmt->bind_param("ss", $password, $token);
    if ($stmt->execute()) {
        $message = "Password reset successful! <a href='login.php'>Login</a>";
    } else {
        $message = "Error: " . $stmt->error;
    }
}
?>

<body id="body">
    <div class="reset-password-container">
        <h2>Reset Password</h2>

        <?php if($message): ?>
            <p class="message <?= strpos($message,'successful') !== false ? 'success' : '' ?>"><?= $message ?></p>
        <?php endif; ?>

        <?php if(!strpos($message,'successful')): ?>
        <form method="POST" class="reset-password-form">
            <div class="input-group">
                <span class="input-icon">🔒</span>
                <input type="password" name="password" placeholder="Enter new password" required>
            </div>

            <button type="submit">Reset Password</button>
        </form>
        <?php endif; ?>

        <p><a href="login.php">Back to Login</a></p>
    </div>
</body>


<style>
/* ====== RESET PASSWORD PAGE ====== */
.reset-password-container {
    max-width: 420px;
    margin: 80px auto;
    background: linear-gradient(135deg, #5ce489 0%, #868b88 50%, #dba47d 100%);
    padding: 40px 35px;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.15);
    font-family: 'Poppins', sans-serif;
}

.reset-password-container h2 {
    text-align: center;
    color: #333;
    margin-bottom: 30px;
}

/* Input group with icon */
.input-group {
    position: relative;
    margin-bottom: 20px;
}

.input-group .input-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #007BFF;
    font-weight: bold;
}

.input-group input[type="password"] {
    width: 100%;
    padding: 12px 12px 12px 35px;
    border: 1px solid #ccc;
    border-radius: 8px;
    outline: none;
    transition: border-color 0.2s ease;
}

.input-group input:focus {
    border-color: #007BFF;
}

/* Button styling */
.reset-password-container button {
    width: 100%;
    padding: 12px;
    background-color: #007BFF;
    border: none;
    border-radius: 8px;
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
}

.reset-password-container button:hover {
    background-color: #0056b3;
    transform: translateY(-2px);
}

/* Messages */
.reset-password-container .message {
    color: red;
    text-align: center;
    margin-bottom: 15px;
}

.reset-password-container .message.success {
    color: green;
}

/* Back link */
.reset-password-container p {
    text-align: center;
    font-size: 14px;
    margin-top: 15px;
}

.reset-password-container p a {
    color: #ff0c0c;
    text-decoration: none;
    font-size: 16px;
    font-weight: 500;
}

.reset-password-container p a:hover {
    text-decoration: underline;
}

/* ====== RESET PASSWORD PAGE ====== */
body {
    font-family: 'Poppins', sans-serif;
}

/* Light mode */
.reset-password-container {
    max-width: 420px;
    margin: 80px auto;
    background: linear-gradient(135deg, #5ce489 0%, #868b88 50%, #dba47d 100%);
    padding: 40px 35px;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.15);
}

.reset-password-container h2 {
    text-align: center;
    color: #333;
    margin-bottom: 30px;
}

.input-group .input-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #007BFF;
    font-weight: bold;
}

.input-group input[type="password"] {
    width: 100%;
    padding: 12px 12px 12px 35px;
    border: 1px solid #ccc;
    border-radius: 8px;
    outline: none;
    transition: border-color 0.2s ease;
}

.input-group input:focus {
    border-color: #007BFF;
}

.reset-password-container button {
    width: 100%;
    padding: 12px;
    background-color: #007BFF;
    border: none;
    border-radius: 8px;
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
}

.reset-password-container button:hover {
    background-color: #0056b3;
    transform: translateY(-2px);
}

.reset-password-container .message {
    color: red;
    text-align: center;
    margin-bottom: 15px;
}

.reset-password-container .message.success {
    color: green;
}

.reset-password-container p {
    text-align: center;
    font-size: 14px;
    margin-top: 15px;
}

.reset-password-container p a {
    color: #ff0c0c;
    text-decoration: none;
    font-size: 16px;
    font-weight: 500;
}

.reset-password-container p a:hover {
    text-decoration: underline;
}

/* ===== Dark Mode ===== */
body.dark-mode {
    background-color: #1f1b16;
}

body.dark-mode .reset-password-container {
    background: rgba(35,30,25,0.85);
    box-shadow: 0 6px 18px rgba(0,0,0,0.6);
}

body.dark-mode .reset-password-container h2 {
    color: #f6d49a;
}

body.dark-mode .input-group .input-icon {
    color: #f6d49a;
}

body.dark-mode .input-group input[type="password"] {
    background: #2d2620;
    border: 1px solid #3a322a;
    color: #f2f2f2;
}

body.dark-mode .input-group input:focus {
    border-color: #f6d49a;
    box-shadow: 0 0 6px rgba(246,212,154,0.25);
}

body.dark-mode .reset-password-container button {
    background-color: #f6d49a;
    color: #2a231a;
}

body.dark-mode .reset-password-container button:hover {
    background-color: #f5c673;
}

body.dark-mode .reset-password-container .message {
    color: #ff8c8c;
}

body.dark-mode .reset-password-container .message.success {
    color: #80ff98;
}

body.dark-mode .reset-password-container p a {
    color: #f6d49a;
}

</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        document.body.classList.add('dark-mode');
    }
});
</script>

