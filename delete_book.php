<?php
require 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = intval($_POST['book_id']);

    // Check if book exists
    $check_sql = "SELECT book_image FROM books WHERE id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $stmt->bind_result($book_image);
    $stmt->fetch();
    $stmt->close();

    if ($book_image) {
        // Delete book from database
        $sql = "DELETE FROM books WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $book_id);

        if ($stmt->execute()) {
            // Delete book image file if exists
            $image_path = "image/" . $book_image;
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            echo "<script>alert('Book deleted successfully!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Error deleting book!'); window.history.back();</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Book not found!'); window.history.back();</script>";
    }
}
?>
