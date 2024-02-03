<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "online_courses"; 

// Create a connection
$conn = new mysqli($serverName, $userName, $password, $dbName);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
