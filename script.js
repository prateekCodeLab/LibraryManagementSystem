// Search Functionality
document.addEventListener("DOMContentLoaded", function() {
    let searchBox = document.getElementById("searchBox");
    let books = document.querySelectorAll(".book");
    let bookList = document.getElementById("bookList");

    searchBox.addEventListener("keyup", function () {
        let filter = searchBox.value.toLowerCase().trim();
        let isAnyBookVisible = false;

        books.forEach(function (book) {
            let title = book.querySelector("h3").textContent.toLowerCase();
            let author = book.querySelector("p").textContent.toLowerCase();

            if (title.includes(filter) || author.includes(filter)) {
                book.style.display = "block"; // Show the book
                isAnyBookVisible = true;
            } else {
                book.style.display = "none"; // Hide the book
            }
        });

        // Handle "No books found" message
        let noBooksMessage = document.getElementById("noBooksMessage");

        if (!isAnyBookVisible) {
            if (!noBooksMessage) {
                noBooksMessage = document.createElement("p");
                noBooksMessage.id = "noBooksMessage";
                noBooksMessage.style.textAlign = "center";
                noBooksMessage.style.fontSize = "1.2em";
                noBooksMessage.style.color = "#666";
                noBooksMessage.textContent = "No books found.";
                bookList.appendChild(noBooksMessage);
            }
        } else {
            if (noBooksMessage) {
                noBooksMessage.remove();
            }
        }
    });
});

// Go to Book Details Page
function goToBookDetail(bookId) {
    window.location.href = `book_details.php?id=${bookId}`;
}
