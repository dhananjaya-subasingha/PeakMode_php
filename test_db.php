<?php
include("includes/db.php");

// Simple query to test connection
$result = $conn->query("SHOW TABLES");

if($result){
    echo "Database connection works!<br>";
    echo "Tables in database:<br>";
    while($row = $result->fetch_assoc()){
        print_r($row);
        echo "<br>";
    }
} else {
    echo "Database connection failed: " . $conn->error;
}
?>