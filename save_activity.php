<?php
session_start();
include("includes/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$date = $_POST['date'];
$type = $_POST['type'];
$duration = $_POST['duration'];
$steps = $_POST['steps'];
$calories = $_POST['calories'];

$stmt = $conn->prepare("
    INSERT INTO activities (user_id, date, type, duration, steps, calories)
    VALUES (?, ?, ?, ?, ?, ?)
");

$stmt->bind_param("issiii", $user_id, $date, $type, $duration, $steps, $calories);

if($stmt->execute()){
    header("Location: activity_tracker.php");
} else {
    echo "Error: " . $stmt->error;
}
?>