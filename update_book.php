<?php
// Enable Debugging
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// echo "Debugging Enabled <br>";

// Include Database Connection
require 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = intval($_POST['book_id']);
    $book_name = $_POST['book_name'];
    $author_name = $_POST['author_name'];
    $publish_year = intval($_POST['publish_year']);
    $book_description = $_POST['book_description'];

    // Fetch existing book image
    $sql = "SELECT book_image FROM books WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $stmt->bind_result($current_image);
    $stmt->fetch();
    $stmt->close();

    // echo "Current Image: " . $current_image . "<br>"; // Debugging Output

    $new_image_name = $current_image; // Default to current image

    // Handle Image Upload (if a new image is uploaded)
    if (isset($_FILES["book_image"]) && $_FILES["book_image"]["error"] == 0) {
        $target_dir = "uploads/";  // Folder must exist
        $new_image_name = time() . "_" . basename($_FILES["book_image"]["name"]); // Unique name
        $target_file = $target_dir . $new_image_name;

        //Ensure 'uploads' folder exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); //Create folder if it doesn't exist
        }

        if (move_uploaded_file($_FILES["book_image"]["tmp_name"], $target_file)) {
            // echo "✅ Image uploaded successfully: " . $new_image_name . "<br>";

            // Delete old image if it exists
            if (!empty($current_image) && file_exists($current_image)) {
                unlink($current_image);
                // echo "🗑 Old image deleted: " . $current_image . "<br>";
            }
        } else {
            // echo "❌ Image upload failed!<br>";
            // echo "Error: " . error_get_last()['message'] . "<br>";
            exit();
        }
    } else {
        // echo "⚠ No new image uploaded! Keeping old image: " . $current_image . "<br>";
    }

    // Ensure correct path is stored in database
    $final_image_path = "uploads/" . $new_image_name;

    // Debugging output before updating
    // echo "Query will update with Image Path: " . $final_image_path . "<br>";

    // Update book details in database
    $update_sql = "UPDATE books SET book_name=?, author_name=?, publish_year=?, book_description=?, book_image=? WHERE id=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssissi", $book_name, $author_name, $publish_year, $book_description, $final_image_path, $book_id);

    if ($stmt->execute()) {
        echo "✅ Book updated successfully! Redirecting...";
        echo "<script>setTimeout(function(){ window.location.href='index.php'; }, 2000);</script>";
    } else {
        // echo "❌ Error updating book: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "❌ Invalid request!";
}
?>
