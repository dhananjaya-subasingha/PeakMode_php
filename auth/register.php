<?php
include("../includes/db.php");

if(isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if($stmt->execute()) {
        echo "Registered successfully! <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<link rel="stylesheet" href="auth.css">

<div class="auth-page">
    <div class="auth-card">
        <h2 class="auth-title">Register</h2>

        <form method="POST">
            <input class="auth-input" name="username" placeholder="Username" required>
            <input class="auth-input" name="email" placeholder="Email" required>
            <input class="auth-input" name="password" type="password" placeholder="Password" required>
            <button class="auth-btn" name="register">Register</button>
        </form>

        <div class="auth-link">
            Already have an account? <a href="login.php">Login</a>
        </div>
    </div>
</div>