<?php
session_start();
include '../includes/config.php';

// Load PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php'; // Make sure PHPMailer is installed via Composer

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    // Check if the email exists in database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Generate token and expiry
        $token = bin2hex(random_bytes(50));
        $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // Update user record
        $stmt = $conn->prepare("UPDATE users SET reset_token=?, reset_expires=? WHERE email=?");
        $stmt->bind_param("sss", $token, $expires, $email);
        $stmt->execute();

        // Prepare reset link
        $resetLink = "http://localhost/PORT/blog/reset_password.php?token=" . $token;

        // Send email via PHPMailer
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';  // your SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'esanglesley@gmail.com'; // your email
            $mail->Password   = 'oewp xdyy vdyn hwuo';       // your email password or app password
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('esanglesley@gmail.com', 'Lesley Tabi');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body    = "Hi,<br><br>Click the link below to reset your password:<br>
                              <a href='$resetLink'>$resetLink</a><br><br>This link expires in 1 hour.";

            $mail->send();
            $message = "Check your email for the reset link!";
        } catch (Exception $e) {
            $message = "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $message = "Email not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lesley|Portfolio</title>
    <style>
/* ===== Forgot Password Page (Matches Login) ===== */
.forgot-page {
display: flex;
align-items: center;
justify-content: center;
min-height: 100vh;
background: linear-gradient(135deg, #f8e7d0 0%, #fff 100%);
font-family: 'Poppins', sans-serif;
padding: 20px;
}

/* Main container (same card style as login) */
.forgot-box {
width: 100%;
max-width: 420px;
background: rgba(255, 255, 255, 0.75);
backdrop-filter: blur(12px);
border-radius: 16px;
padding: 40px 32px;
box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
border: 1px solid rgba(255, 255, 255, 0.5);
animation: fadeIn 0.8s ease;
text-align: center;
}

/* Header */
.forgot-box h2 {
font-size: 1.6rem;
color: #6d4300;
margin-bottom: 10px;
letter-spacing: -0.5px;
}

/* Message */
.forgot-box .message {
font-size: 0.95rem;
margin-bottom: 15px;
color: #d9534f;
}
.forgot-box .message.success {
color: #28a745;
}

/* Form */
.forgot-password-form {
margin-top: 10px;
text-align: left;
}

.input-group {
  position: relative;
  display: flex;
  align-items: center;
  margin-bottom: 20px;
  width: 100%;
}

.input-group .input-icon {
  position: absolute;
  left: 14px;
  color: #6d4300;
  font-weight: 600;
  font-size: 1rem;
  pointer-events: none;
}

.input-group input[type="email"] {
  width: 100%;
  padding: 12px 14px 12px 38px; /* consistent left & right padding */
  border-radius: 10px;
  border: 1px solid #ddd;
  background: #fff;
  font-size: 1rem;
  box-sizing: border-box;
  transition: all 0.2s ease;
}

.input-group input:focus {
  outline: none;
  border-color: #6d4300;
  box-shadow: 0 0 6px rgba(109, 67, 0, 0.2);
}


.input-group .input-icon {
position: absolute;
left: 12px;
top: 50%;
transform: translateY(-50%);
color: #6d4300;
font-weight: 600;
}

.input-group input[type="email"] {
width: 100%;
padding: 12px 12px 12px 36px;
border-radius: 10px;
border: 1px solid #ddd;
background: #fff;
font-size: 1rem;
transition: all 0.2s ease;
}

.input-group input:focus {
outline: none;
border-color: #6d4300;
box-shadow: 0 0 6px rgba(109, 67, 0, 0.2);
}

/* Button */
.forgot-box button {
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

.forgot-box button:hover {
background: #8a3e00;
transform: translateY(-2px);
}

/* Back link */
.forgot-box p {
margin-top: 20px;
font-size: 0.95rem;
color: #444;
}

.forgot-box p a {
color: #6d4300;
text-decoration: none;
font-weight: 600;
transition: color 0.2s ease;
}

.forgot-box p a:hover {
color: #8a3e00;
text-decoration: underline;
}

/* Animation */
@keyframes fadeIn {
from { opacity: 0; transform: translateY(15px); }
to { opacity: 1; transform: translateY(0); }
}

/* Responsive */
@media (max-width: 520px) {
.forgot-box {
padding: 30px 22px;
border-radius: 12px;
}
.forgot-box h2 {
font-size: 1.4rem;
}
}

/* ===== Dark Mode (auto) ===== */
@media (prefers-color-scheme: dark) {
.forgot-page {
background: linear-gradient(135deg, #1f1b16 0%, #2a231a 100%);
}
.forgot-box {
    background: rgba(35, 30, 25, 0.85);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.6);
}

.forgot-box h2 {
    color: #f6d49a;
}

.forgot-box .message {
    color: #ff8c8c;
}
.forgot-box .message.success {
    color: #80ff98;
}

.input-group .input-icon {
    color: #f6d49a;
}

.input-group input[type="email"] {
    background: #2d2620;
    border: 1px solid #3a322a;
    color: #f2f2f2;
}

.input-group input:focus {
    border-color: #f6d49a;
    box-shadow: 0 0 6px rgba(246, 212, 154, 0.25);
}

.forgot-box button {
    background: #f6d49a;
    color: #2a231a;
}

.forgot-box button:hover {
    background: #f5c673;
}

.forgot-box p {
    color: #ccc;
}

.forgot-box p a {
    color: #f6d49a;
}

.forgot-box p a:hover {
    color: #ffdb9a;
}
}
</style>
</head>
<body class="forgot-page">
    <main class="forgot-box">
        <div class="forgot-password-container">
            <h2>Forgot Password</h2>

            <?php if($message): ?>
                <p class="message <?= strpos($message,'reset link') !== false ? 'success' : '' ?>"><?= $message ?></p>
            <?php endif; ?>

            <form method="POST" class="forgot-password-form">
                <div class="input-group">
                    <span class="input-icon">@</span>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>

                <button type="submit">Send Reset Link</button>
            </form>

            <p><a href="login.php">Back to Login</a></p>
        </div>
    </main>
    
</body>
</html>
