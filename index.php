<?php
require 'db_connection.php';
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
    <main>
        <div class="content-box">
            <h2>Available Books</h2>
            <div class="book-list" id="bookList">
                <?php
                // Fetch books from the database
                $sql = "SELECT id, book_name, author_name, book_image FROM books";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="book">
                            <!-- Book Details Clickable -->
                            <a href="book_details.php?id=<?php echo $row['id']; ?>" class="book-link">
                            <img src="<?php echo htmlspecialchars($row['book_image']); ?>" alt="<?php echo htmlspecialchars($row['book_name']); ?>" class="book-image">
                            <h3><?php echo htmlspecialchars($row['book_name']); ?></h3>
                            <p><?php echo htmlspecialchars($row['author_name']); ?></p>
                            </a>

                            <!-- Edit Button -->
                            <div class="book-actions">
                                <a href="edit_book.php?id=<?php echo $row['id']; ?>" class="edit-btn" style="width: auto; padding: 8px 10px;">Edit</a>

                                <!-- Delete Button -->
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

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        document.getElementById("addBookModal").style.display = "none";
    });
</script>

    <script src="script.js"></script> <!-- Ensure JavaScript is linked -->
</body>
</html>
