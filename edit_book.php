<?php
require 'db_connection.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['id'])) {
    $book_id = $_GET['id'];
    $query = "SELECT * FROM books WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();

    if (!$book) {
        echo "Book not found!";
        exit();
    }
} else {
    echo "Invalid book ID!";
    exit();
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
    <div class="edit-container">
        <h2>✏️ Edit Book</h2>
        <form action="update_book.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">

            <label>Book Name</label>
            <input type="text" name="book_name" value="<?php echo htmlspecialchars($book['book_name']); ?>" required>

            <label>Author Name</label>
            <input type="text" name="author_name" value="<?php echo htmlspecialchars($book['author_name']); ?>" required>

            <label>Publish Year</label>
            <input type="number" name="publish_year" value="<?php echo htmlspecialchars($book['publish_year']); ?>" required>

            <label>Current Cover</label><br>
            <img src="<?php echo htmlspecialchars($book['book_image']); ?>" alt="Book Cover" width="100"><br>

            <label>Upload New Cover</label>
            <input type="file" name="book_image" accept="image/*">

            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>
