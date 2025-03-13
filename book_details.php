<?php
require 'db_connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM books WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        die("Book not found.");
    }
} else {
    die("Invalid book ID.");
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
<body>
    <div class="book-detail-container">
        <img src="<?php echo $book['book_image']; ?>" alt="<?php echo $book['book_name']; ?>">
        <div class="book-detail-content">
            <h2><?php echo $book['book_name']; ?></h2>
            <p><strong>Author:</strong> <?php echo $book['author_name']; ?></p>
            <p><strong>Publish Year:</strong> <?php echo $book['publish_year']; ?></p>
            <p><?php echo $book['book_description']; ?></p>
            <a href="index.php" class="btn-back">Back to Home</a>
        </div>
    </div>
</body>
</html>
