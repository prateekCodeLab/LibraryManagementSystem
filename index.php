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
                        <a href="book_details.php?id=<?php echo $row['id']; ?>" class="book">
                            <img src="<?php echo htmlspecialchars($row['book_image']); ?>" alt="<?php echo htmlspecialchars($row['book_name']); ?>" class="book-image">
                            <h3><?php echo htmlspecialchars($row['book_name']); ?></h3>
                            <p><?php echo htmlspecialchars($row['author_name']); ?></p>
                        </a>
                        <?php
                    }
                } else {
                    echo "<p>No books available.</p>";
                }
                ?>
            </div>
        </div>
    </main>

    <script src="script.js"></script> <!-- Ensure JavaScript is linked -->
</body>
</html>
