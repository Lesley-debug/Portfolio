<?php
session_start();

// Automatically detect correct login path based on current directory
if (basename(dirname(__FILE__)) === 'includes') {
    // If auth.php is inside /includes/
    $loginPath = '../admin/login.php';
} else {
    // If used inside /admin/
    $loginPath = 'login.php';
}

// Check if user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: $loginPath");
    exit();
}

// Include database connection if needed
require_once __DIR__ . '/../includes/config.php';
?>
