<?php
require 'db_connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        echo "<p style='color: red; text-align: center;'>Book not found.</p>";
        exit();
    }
} else {
    echo "<p style='color: red; text-align: center;'>Invalid book ID.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body style="background-image: url('image/background.jpg');">
    <div class="book-detail-container">
        <img src="<?php echo htmlspecialchars($book['book_image']); ?>" alt="<?php echo htmlspecialchars($book['book_name']); ?>">
        <div class="book-detail-content">
            <h2><?php echo htmlspecialchars($book['book_name']); ?></h2>
            <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author_name']); ?></p>
            <p><strong>Publish Year:</strong> <?php echo htmlspecialchars($book['publish_year']); ?></p>
            <p><?php echo htmlspecialchars($book['book_description']); ?></p>
            <a href="index.php" class="btn-back">Back to Home</a>
        </div>
    </div>
</body>
</html>
