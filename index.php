<?php
require 'db_connection.php';

// Count only available books (books that are NOT in borrowed_books OR have been returned)
$query = "SELECT COUNT(*) AS total_books FROM books 
          WHERE id NOT IN (SELECT book_id FROM borrowed_books WHERE return_date IS NULL)";
$result = $conn->query($query);
$total_books = ($result) ? $result->fetch_assoc()['total_books'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body style="background-image: url('image/background.jpg');">
    <header>
        <h1>IndiLibrary LMS</h1>
        <input type="text" id="searchBox" placeholder="Search for books">
        <button id="addBookBtn">Add New Book</button>
    </header>

    <!-- Total Books Count + Borrow & Return Buttons -->
    <div class="dashboard">
        <a href="borrow_book.php" class="borrow-btn">Borrow Book</a>
        <div class="book-count">
            <h2>Total Books Available: <?php echo $total_books; ?></h2>
        </div>
        <a href="return_book.php" class="return-btn">Return Book</a>
    </div>

    <main>
        <div class="content-box">
            <div class="book-list" id="bookList">
                <?php
                // Fetch books from the database
                $sql = "SELECT id, book_name, author_name, book_image FROM books";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="book">
                            <a href="book_details.php?id=<?php echo $row['id']; ?>" class="book-link">
                                <img src="<?php echo htmlspecialchars($row['book_image']); ?>" alt="<?php echo htmlspecialchars($row['book_name']); ?>" class="book-image">
                                <h3><?php echo htmlspecialchars($row['book_name']); ?></h3>
                                <p><?php echo htmlspecialchars($row['author_name']); ?></p>
                            </a>
                            <div class="book-actions">
                                <a href="edit_book.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
                                <form action="delete_book.php" method="POST" class="delete-form">
                                    <input type="hidden" name="book_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this book?');">Delete</button>
                                </form>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No books available.</p>";
                }
                ?>
            </div>
        </div>
    </main>

    <!-- Modal Form for Adding New Book -->
    <div id="addBookModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add a New Book</h2>
            <form action="add_book.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="book_name" placeholder="Book Name" required>
                <input type="text" name="author_name" placeholder="Author Name" required>
                <input type="number" name="publish_year" placeholder="Publish Year" required>
                <textarea name="book_description" placeholder="Book Description" required></textarea>
                <input type="file" name="book_image" accept="image/*" required>
                <button type="submit">Add Book</button>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
