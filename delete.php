<?php
session_start();
include("includes/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
    exit();
}

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$conn->query("DELETE FROM activities WHERE id='$id' AND user_id='$user_id'");

header("Location: activity_tracker.php");
?>