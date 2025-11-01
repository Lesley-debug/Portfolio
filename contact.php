<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myportfolio";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Collect and sanitize form data
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$message = trim($_POST['message']);

// Validate fields
if (empty($name) || empty($email) || empty($message)) {
    echo "<script>alert('All fields are required!'); window.location.href='contact.html';</script>";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email address!'); window.location.href='contact.html';</script>";
    exit;
}

// Save message to database
$stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);
$stmt->execute();
$stmt->close();

// Send email using PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'esanglesley@gmail.com'; // your Gmail
    $mail->Password = 'mjwbszzjaoxbmkfg';     // use Gmail App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Recipients
    $mail->setFrom('esanglesley@gmail.com', 'Lesley Designs');
    $mail->addReplyTo($email, $name);
    $mail->addAddress('esanglesley@gmail.com', 'Lesley Tabi');

    // Content
    $mail->isHTML(true);
    $mail->Subject = "New Message from Portfolio Contact Form";
    $mail->Body = "
        <h3>New Message Received</h3>
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Message:</strong><br>{$message}</p>
    ";

    $mail->send();
    header("Location: success.html");
    exit;

} catch (Exception $e) {
    echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}'); window.location.href='contact.html';</script>";
}

$conn->close();
?>
