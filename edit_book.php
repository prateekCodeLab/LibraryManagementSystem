<?php
require 'db_connection.php';

if (isset($_GET['id'])) {
    $book_id = intval($_GET['id']);
    
    $sql = "SELECT * FROM books WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        die("Book not found!");
    }
    $stmt->close();
} else {
    die("Invalid request!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <!-- Edit Book Modal -->
    <div id="editBookModal" class="modal" style="display: block;">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Edit Book Details</h2>
            <form action="update_book.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">

                <label>Book Name:</label>
                <input type="text" name="book_name" value="<?php echo htmlspecialchars($book['book_name']); ?>" required>

                <label>Author Name:</label>
                <input type="text" name="author_name" value="<?php echo htmlspecialchars($book['author_name']); ?>" required>

                <label>Publish Year:</label>
                <input type="number" name="publish_year" value="<?php echo htmlspecialchars($book['publish_year']); ?>" required>

                <label>Book Description:</label>
                <textarea name="book_description" required><?php echo htmlspecialchars($book['book_description']); ?></textarea>

                <label>Current Image:</label>
                <img src="<?php echo htmlspecialchars($book['book_image']); ?>" width="150px">

                <label>Change Image (Optional):</label>
                <input type="file" name="book_image" accept="image/*">

                <button type="submit">Update Book</button>
            </form>
        </div>
    </div>

    <script>
    function closeModal() {
        window.location.href = "index.php";
    }
    </script>
</body>
</html>
