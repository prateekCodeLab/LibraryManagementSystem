<?php
require 'db_connection.php';

$user_id = 1; // Temporary user ID

if (isset($_POST['return'])) {
    $book_id = $_POST['book_id'];

    // Mark book as returned
    $query = "UPDATE borrowed_books SET return_date = NOW() WHERE book_id = '$book_id' 
              AND user_id = '$user_id' AND return_date IS NULL";
    $conn->query($query);

    echo "<script>alert('Book returned successfully!'); window.location.href='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Return a Book</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <div class="container">
        <h2>🔄 Return a Book</h2>
        <form method="post">
            <label>Select Book:</label>
            <select name="book_id">
                <?php
                $books = $conn->query("SELECT books.id, books.book_name FROM books 
                                       INNER JOIN borrowed_books ON books.id = borrowed_books.book_id 
                                       WHERE borrowed_books.user_id = '$user_id' AND borrowed_books.return_date IS NULL");
                while ($row = $books->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['book_name']}</option>";
                }
                ?>
            </select>
            <button type="submit" name="return">✅ Return</button>
        </form>

        <a href="index.php" class="back-btn">⬅ Back to Home</a>
    </div>
</body>
</html>
