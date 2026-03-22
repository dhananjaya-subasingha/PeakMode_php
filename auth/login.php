<?php
session_start();
include("../includes/db.php");

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if($user && password_verify($password, $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        header("Location: ../activity_tracker.php");
        exit();
    } else {
        echo "Invalid login!";
    }

    $stmt->close();
}
?>

<link rel="stylesheet" href="auth.css">

<div class="auth-page">
    <div class="auth-card">
        <h2 class="auth-title">Login</h2>

        <form method="POST">
            <input class="auth-input" name="email" placeholder="Email" required>
            <input class="auth-input" name="password" type="password" placeholder="Password" required>
            <button class="auth-btn" name="login">Login</button>
        </form>

        <div class="auth-link">
            Don't have an account? <a href="register.php">Register</a>
        </div>
    </div>
</div>