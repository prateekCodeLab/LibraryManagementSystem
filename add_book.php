<?php

// Check for error
error_reporting(E_ALL);
ini_set('display_errors',1);

require 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_name = $_POST['book_name'];
    $author_name = $_POST['author_name'];
    $publish_year = intval($_POST['publish_year']); // Ensure it's an integer
    $book_description = $_POST['book_description'];

    // File upload validation
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $file = $_FILES["book_image"];
    $allowed_types = ['image/jpeg', 'image/png'];
    $max_file_size = 2 * 1024 * 1024; // 2MB

    if ($file['error'] == 0) {
        if (in_array($file['type'], $allowed_types) && $file['size'] <= $max_file_size) {
            $target_file = $target_dir . basename($file["name"]);
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                $sql = "INSERT INTO books (book_name, author_name, publish_year, book_description, book_image) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssiss", $book_name, $author_name, $publish_year, $book_description, $target_file);

                if ($stmt->execute()) {
                    echo "<script>alert('Book added successfully!'); window.location.href='index.php';</script>";
                } else {
                    echo "<script>alert('Database error: " . addslashes($conn->error) . "');</script>";
                }
                $stmt->close();
            } else {
                echo "<script>alert('File upload failed! Please check folder permissions.');</script>";
            }
        } else {
            echo "<script>alert('Invalid file type or file too large! Only JPG/PNG under 2MB allowed.');</script>";
        }
    } else {
        echo "<script>alert('File upload error! Code: " . $file['error'] . "');</script>";
    }
}
?>
