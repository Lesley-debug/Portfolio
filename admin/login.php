<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>
<link rel="stylesheet" href="../css/style.css">
<style>
/* ===== Admin Login Page Styles ===== */
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #0d6efd, #007bff);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0;
    color: #333;
}

.login-container {
    background: #fff;
    padding: 40px 30px;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

.login-container h2 {
    margin-bottom: 25px;
    color: #0d6efd;
    font-size: 2rem;
}

form label {
    display: block;
    margin-top: 15px;
    font-weight: 500;
    text-align: left;
}

form input[type="text"],
form input[type="password"] {
    width: 100%;
    padding: 12px;
    margin-top: 5px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 1rem;
    transition: border-color 0.3s;
}

form input[type="text"]:focus,
form input[type="password"]:focus {
    border-color: #0d6efd;
    outline: none;
}

button {
    width: 100%;
    padding: 12px;
    margin-top: 25px;
    border: none;
    background-color: #0d6efd;
    color: white;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 10px;
    cursor: pointer;
    transition: background 0.3s, transform 0.2s;
}

button:hover {
    background-color: #0056b3;
    transform: translateY(-2px);
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

    <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        include '../includes/config.php';

        // If already logged in, go to dashboard
        if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
            header("Location: dashboard.php");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            $sql = "SELECT * FROM users WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();

                if (password_verify($password, $user['password'])) {
                    // ✅ Set full admin session
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = $user['role'] ?? 'admin'; // Default admin if column not found
                    $_SESSION['admin_logged_in'] = true;

                    header("Location: dashboard.php");
                    exit();
                } else {
                    $error = "Invalid username or password!";
                }
            } else {
                $error = "Invalid username or password!";
            }
        }
    ?>



<div class="login-container">
    <h2>Admin Login</h2>
    <?php if(isset($error)): ?>
        <div class="error-msg"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</div>
</body>
</html>
