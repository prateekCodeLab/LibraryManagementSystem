<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Library Management System</title>
    <link rel="stylesheet" href="CSS/style.css" />
  </head>
  <body style="background-image: url('image/background.jpg');">
    <header>
      <h1>IndiLibrary LMS</h1>
      <input type="text" id="searchBox" placeholder="Search for books" />
      <!-- <button id="searchButton">Search</button>  -->
    </header>

    <main>
      <div class="content-box">
        <h2>Available Books</h2>
        <div class="book-list" id="bookList">
          <div class="book" onclick="goToBookDetail('HTML CSS & JAVASCRIP', 'Paul McFedries', 'A thorough and helpful reference for aspiring website builders Looking to start an exciting new career in front-end web building and design? Or maybe you just want to develop a new skill and create websites for fun. Whatever your reasons, it’s never been easier to start learning how to build websites from scratch than with help from HTML, CSS, & JavaScript All-in-One For Dummies. This book has the essentials you need to wrap your head around the key ingredients of website design and creation. You will learn to build attractive, useful, and easy-to-navigate websites by combining HTML, CSS, and JavaScript into fun and practical creations. Using the 6 books compiled within this comprehensive collection, you’ll discover how to make static and dynamic websites, complete with intuitive layouts and cool animations.', 'image/book1.jpeg')">
            <img src="image/book1.jpeg" alt="Book 1" />
            <h3>HTML CSS & JAVASCRIP</h3>
            <p>Paul McFedries</p>
          </div>
          <div class="book" onclick="goToBookDetail('Excel Data Analysis', 'Paul McFedries', 'A thorough and helpful reference for aspiring website builders Looking to start an exciting new career in front-end web building and design? Or maybe you just want to develop a new skill and create websites for fun. Whatever your reasons, it’s never been easier to start learning how to build websites from scratch than with help from HTML, CSS, & JavaScript All-in-One For Dummies.', 'image/book2.jpeg')">
            <img src="image/book2.jpeg" alt="Book 2" />
            <h3>Excel Data Analysis</h3>
            <p>Paul McFedries</p>
          </div>
          <div class="book" onclick="goToBookDetail('Java Essentials', 'Paul McFedries', 'A thorough and helpful reference for aspiring website builders Looking to start an exciting new career in front-end web building and design? Or maybe you just want to develop a new skill and create websites for fun. Whatever your reasons, it’s never been easier to start learning how to build websites from scratch than with help from HTML, CSS, & JavaScript All-in-One For Dummies.', 'image/book3.jpeg')">
            <img src="image/book3.jpeg" alt="Book 3" />
            <h3>Java <br />Essentials</h3>
            <p>Paul McFedries</p>
          </div>
          <div class="book" onclick="goToBookDetail('Go Web Programming', 'Sau Sheong Chang', 'A thorough and helpful reference for aspiring website builders Looking to start an exciting new career in front-end web building and design? Or maybe you just want to develop a new skill and create websites for fun. Whatever your reasons, it’s never been easier to start learning how to build websites from scratch than with help from HTML, CSS, & JavaScript All-in-One For Dummies.', 'image/book4.jpeg')">
            <img src="image/book4.jpeg" alt="Book 4" />
            <h3>Go Web Programming</h3>
            <p>Sau Sheong Chang</p>
          </div>
        </div>
      </div>
    </main>

    <script src="script.js"></script>

  </body>
</html>
