// =================================================================
document.addEventListener('DOMContentLoaded', function() {
    const storedBooksArray = JSON.parse(localStorage.getItem('booksArray'));

    if (storedBooksArray) {
        renderBookList(storedBooksArray);
    } else {
        console.log('No books found in local storage.');
    }

    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', handleSearch);
});

function handleSearch() {
    const searchTerm = this.value.trim().toLowerCase();
    const bookListElement = document.getElementById('bookList');
    const storedBooksArray = JSON.parse(localStorage.getItem('booksArray'));

    if (!storedBooksArray) {
        bookListElement.innerHTML = '<p>No books found in local storage.</p>';
        return;
    }

    const filteredBooks = storedBooksArray.filter(book => {
        return book.title.toLowerCase().includes(searchTerm);
    });

    if (filteredBooks.length === 0) {
        bookListElement.innerHTML = '<p>No matching books found.</p>';
    } else {
        renderBookList(filteredBooks);
    }
}

function generateBookHTML(book) {
    return `
        <div class="Availablebooks_box">
            <div class="Availablebooks_card">
                <div class="Availablebooks_img">
                    <img src="${book.photoLink}" alt="${book.title}">
                </div>
                <div class="Availablebooks_tag">
                    <h2>${book.title}</h2>
                    <p class="writer"><span class="key">Author:</span> <span class="value">${book.author}</span></p>
                    
                    <p><span class="key">Category:</span> <span class="value">${getCategoryName(book.category)}</span></p>
                    <p class="bookprice"><span class="key">Price:</span> <span class="value">$${book.price}</span></p>
                    <a href="#"  onclick="bookdelet('${book.title}')">delete book</a>
                </div>
            </div>
        </div>
    `;
}

function renderBookList(books) {
    const bookListElement = document.getElementById('bookList');
    if (!books || books.length === 0) {
        bookListElement.innerHTML = '<p>No books available.</p>';
    } else {
        const booksHTML = books.map(generateBookHTML).join('');
        bookListElement.innerHTML = booksHTML;
    }
}

function bookdelet(title) {
    localStorage.setItem("deletbook", title);
    location.reload();
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
/*===========deletebook=================*/
let booksArray = JSON.parse(localStorage.getItem("booksArray"));

function findBook(bookName, booksArray) {
    for (let i = 0; i < booksArray.length; i++) {
        if (booksArray[i].title === bookName) {
            return i; 
        }
    }
}
const bookNameToSearch = localStorage.getItem("deletbook");
const index = findBook(bookNameToSearch, booksArray);
const found = booksArray[index];
if (booksArray && booksArray[index]) {
    booksArray.splice(index, 1);
    localStorage.setItem("booksArray", JSON.stringify(booksArray));
    
}
// function bookbored() {
//     let bookarr = JSON.parse(localStorage.getItem("booksArray"));
//     localStorage.setItem("bookborro", JSON.stringify(bookarr));
// }
