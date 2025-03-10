<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db_connect.php';

$sql = "SELECT * FROM books";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Book: " . $row["book_name"] . " - Author: " . $row["author_name"] . "<br>";
    }
}   else {
    echo "No books found in the database";
}

$conn->close();
?>