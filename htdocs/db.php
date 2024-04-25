<?php
// Database configuration settings
$host = 'localhost';   
$username = 'root'; 
$password = 'root'; 
$dbname = 'airdb';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
