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
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<a href='book_details.php?id=" . $row["id"] . "' class='book'>";
                        echo "<img src='" . $row["book_image"] . "' alt='" . $row["book_name"] . "' class='book-image'>";
                        echo "<h3>" . $row["book_name"] . "</h3>";
                        echo "<p>" . $row["author_name"] . "</p>";
                        echo "</a>";
                    }
                } else {
                    echo "<p>No books available.</p>";
                }
                ?>
            </div>
        </div>
    </main>
</body>
<script type="text/javascript" src="script.js"></script>
</html>
