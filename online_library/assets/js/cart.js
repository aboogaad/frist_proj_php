
document.addEventListener('DOMContentLoaded', function() {
    const storedBooksArray = JSON.parse(localStorage.getItem('bookscart'));
    if (storedBooksArray) {
        renderBookList(storedBooksArray);
    } else {
        console.log('No books found in local storage.');
    }
});
function renderBookList(books) {
    const bookListElement = document.getElementById('bookList');
    if (!books || books.length === 0) {
        bookListElement.innerHTML = '<p>No books available.</p>';
    } else {
        const cartbook = `
<div class="book">
    <img src="${book.photoLink}" alt="Book 1">
    <div class="book-details">
        <h3 class="book-name"> book name : ${book.title} </h3>
        <p class="book-price"> price : ${book.price}</p>
    </div>
</div>
<input type="number"  min="1"  value="1" width="1"  >
<div>
    <br>
    <button>remove from cart</button>
</div>
`;
        bookListElement.innerHTML = cartbook;
    }
}
function getCategoryName(categoryId) {
    switch (categoryId) {
        case '1':
            return 'Coding';
        case '2':
            return 'Cyber Security';
        case '3':
            return 'Biography';
        case '4':
            return 'Fantasy';
        case '5':
            return 'Comedy';
        case '6':
            return 'Romantic';
        default:
            return 'Unknown';
    }
}

function renderBookList(books) {
    const bookListElement = document.getElementById('bookList');
    
    if (!books || books.length === 0) {
        bookListElement.innerHTML = '<p>No books available.</p>';
    } else {
        let cartbook = '';
        books.forEach((book, index) => {
            const category = getCategoryName(book.categoryId); // Assuming categoryId exists in each book object

            // Construct HTML for each book dynamically
            cartbook += `
                <div class="book">
                    <img src="${book.photoLink}" alt="${book.title}">
                    <div class="book-details">
                        <h3 class="book-name"> Book Name: ${book.title} </h3>
                        <p class="book-price"> Price: ${book.price}</p>
                        <p class="book-category"> Category: ${category}</p>
                    </div>
                </div>
                <input type="number" min="1" value="1" width="1">
                <div>
                    <br>
                    <button onclick="bookrm('${book.title}')">Remove from cart</button>
                </div>
            `;
        });

        // Set the generated HTML to the book list element
        bookListElement.innerHTML = cartbook;
    }
}
function bookrm(title) {
    localStorage.setItem("removebook", title);
    location.reload();
}
let bookscart = JSON.parse(localStorage.getItem("bookscart"));

function findBook(bookName, booksArray) {
    for (let i = 0; i < booksArray.length; i++) {
        if (booksArray[i].title === bookName) {
            return i; 
        }
    }
}
const bookNameToSearch = localStorage.getItem("removebook");
const index = findBook(bookNameToSearch, bookscart);
const found = bookscart[index];
if (bookscart && bookscart[index]) {
    bookscart.splice(index, 1);
    localStorage.setItem("bookscart", JSON.stringify(bookscart));
    
}
function bookbored() {
    let bookscartt = JSON.parse(localStorage.getItem("bookscart"));
    localStorage.setItem("bookborro", JSON.stringify(bookscartt));
}
