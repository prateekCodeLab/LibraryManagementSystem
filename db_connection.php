<?php
// Database configuration
$host = "localhost"; // Hostname (usually localhost for XAMPP)
$username = "root";  // Default username for XAMPP
$password = "";      // Default password for XAMPP (empty by default)
$dbname = "library_db"; // Name of your database

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Database connected successfully!";
?>
