<?php
session_start();
include("includes/db.php");

$name = $email = $message = "";
$success = $error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    if(!empty($name) && !empty($email) && !empty($message)){
        $sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";
        if($conn->query($sql)){
            $success = "Message sent successfully!";
        } else {
            $error = "Database error: " . $conn->error;
        }
    } else {
        $error = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - PeakMode</title>
    <link rel="stylesheet" href="auth/auth.css">
</head>
<body class="auth-page">

<div class="auth-card">
    <h2 class="auth-title">Contact Us</h2>

    <?php if($success) echo "<p style='color:lightgreen;'>$success</p>"; ?>
    <?php if($error) echo "<p style='color:#ff6b6b;'>$error</p>"; ?>

    <form action="" method="POST" class="auth-form">
        <label class="auth-label">Name</label>
        <input type="text" name="name" class="auth-input" required>

        <label class="auth-label">Email</label>
        <input type="email" name="email" class="auth-input" required>

        <label class="auth-label">Message</label>
        <textarea name="message" class="auth-input" rows="5" required></textarea>

        <button type="submit" class="auth-btn">Send Message</button>
    </form>
</div>

</body>
</html>