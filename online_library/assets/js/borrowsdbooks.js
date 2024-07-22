document.addEventListener('DOMContentLoaded', function() {
    const storedBooksArray = JSON.parse(localStorage.getItem('bookborro'));
    if (storedBooksArray) {
        renderBookList(storedBooksArray);
    } else {
        console.log('No books found in local storage.');
    }
});

function renderBookList(books) {
    const bookListElement = document.querySelector(".borrowed"); // Use querySelector to get the first element with class "borrowed"
    
    if (!books || books.length === 0) {
        bookListElement.innerHTML = '<p>No books available.</p>';
    } else {
        let borbook = '';
        books.forEach((book, index) => {
            const category = getCategoryName(book.categoryId); // Assuming categoryId exists in each book object

            // Construct HTML for each book dynamically
            borbook += `
            <div>
                <div>
                    <img src="${book.photoLink}" alt="book image">
                </div>
                <p>book name : ${book.title}</p>
            </div>
            <br>
            `;
        });
        // Set the generated HTML to the book list element
        bookListElement.innerHTML = borbook;
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
