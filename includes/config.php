<?php
$host = "localhost";
$user = "root";     // change if needed
$pass = "";         // add password if needed
$db   = "myportfolio";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
