<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_name = $_POST["book_name"];
    $author_name = $_POST["author_name"];
    $publish_year = $_POST["publish_year"];

    $query = "INSERT INTO books (book_name, author_name, publish_year, status) VALUES (?, ?, ?, 'available')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $book_name, $author_name, $publish_year);

    if ($stmt->execute()) {
        echo "<script>alert('Book Added Successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error Adding Book!');</script>";
    }
}
?>

<!-- Add New Book Modal -->
<div class="modal fade" id="addBookModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Book</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="add_book.php">
                    <div class="form-group">
                        <label>Book Name</label>
                        <input type="text" name="book_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Author Name</label>
                        <input type="text" name="author_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Publish Year</label>
                        <input type="number" name="publish_year" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Book</button>
                </form>
            </div>
        </div>
    </div>
</div>
