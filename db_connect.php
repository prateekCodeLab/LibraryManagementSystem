<?php
$servername = "localhost"; // Hostname
$username = "root"; // Username
$password = ""; // Password
$database = "library_db"; // Database Name


// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Uncomment the below line to check if the connection is successful
//echo "Database Connected successfully";
?>