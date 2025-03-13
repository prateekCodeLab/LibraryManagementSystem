<?php
// Include the database connection file
include 'db_connection.php';

// Example query to fetch all books
$sql = "SELECT * FROM books";
$result = $conn->query($sql);

// Check if records were found
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "Book Name: " . $row["book_name"] . "<br>";
        echo "Author Name: " . $row["author_name"] . "<br>";
        echo "Publish Year: " . $row["publish_year"] . "<br>";
        echo "Description: " . $row["book_description"] . "<br>";
        echo "<img src='" . $row["book_image"] . "' alt='" . $row["book_name"] . "' style='width:100px; height:auto;'><br><br>";
    }
} else {
    echo "No books found.";
}

// Close the connection
$conn->close();
?>
