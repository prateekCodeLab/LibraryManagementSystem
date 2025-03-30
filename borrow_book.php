<?php
require 'db_connection.php';

$user_id = 1; // Temporary user ID

if (isset($_POST['borrow'])) {
    $book_id = $_POST['book_id'];

    // Insert into borrowed_books table
    $query = "INSERT INTO borrowed_books (book_id, user_id) VALUES ('$book_id', '$user_id')";
    $conn->query($query);

    echo "<script>alert('Book borrowed successfully!'); window.location.href='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Borrow a Book</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <div class="container">
        <h2>📚 Borrow a Book</h2>
        <form method="post">
            <label>Select Book:</label>
            <select name="book_id">
                <?php
                $books = $conn->query("SELECT * FROM books WHERE id NOT IN 
                                      (SELECT book_id FROM borrowed_books WHERE return_date IS NULL)");
                while ($row = $books->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['book_name']}</option>";
                }
                ?>
            </select>
            <button type="submit" name="borrow">✅ Borrow</button>
        </form>

        <a href="index.php" class="back-btn">⬅ Back to Home</a>
    </div>
</body>
</html>
