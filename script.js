// Search Functionality
document.getElementById("searchBox").addEventListener("keyup", function() {
    let filter = this.value.toLowerCase();
    let books = document.querySelectorAll(".book");

    books.forEach(function(book) {
        let title = book.querySelector("h3").innerHTML.toLowerCase();
        if (title.includes(filter)) {
            book.style.display = "block";
        }
        else {
            book.style.display = "none";
        }
    });
});

// Go to Book Details Page
function goToBookDetail(title, author, description, image) {
    window.location.href = `book-detail.html?title=${encodeURIComponent(title)}&author=${encodeURIComponent(author)}&description=${encodeURIComponent(description)}&image=${encodeURIComponent(image)}`;
}