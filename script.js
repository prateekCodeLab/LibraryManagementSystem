// Search Functionality
document.addEventListener("DOMContentLoaded", function() {
document.getElementById("searchBox").addEventListener("keyup", function () {
    let filter = this.value.toLowerCase().trim(); // Get the search query
    let books = document.querySelectorAll("book"); // Get all book cards
    console.log(books);
    let isAnyBookVisible = false;

    books.forEach(function (book) {
        let title = book.querySelector("h3").textContent.toLowerCase(); // Book title
        let author = book.querySelector("p").textContent.toLowerCase(); // Author name

        // Check if the title or author matches the search query
        if (title.includes(filter) || author.includes(filter)) {
            book.style.display = "block"; // Show the book
            isAnyBookVisible = true;
        } else {
            book.style.display = "none"; // Hide the book
        }
    });

    // Show a "No books found" message if no books are visible
    let bookList = document.getElementById("bookList");
    if (!isAnyBookVisible) {
        bookList.innerHTML = `<p style="text-align: center; font-size: 1.2em; color: #666;">No books found.</p>`;
    } else {
        // Restore original content if books are found
        books.forEach(function (book) {
            book.style.display = "block";
        });
    }
})});



// Go to Book Details Page
function goToBookDetail(bookId) {
    window.location.href = `book_details.php?id=${bookId}`;
}
