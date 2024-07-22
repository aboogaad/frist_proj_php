function addBook() {
    const title = document.getElementById('title').value.trim();
    const author = document.getElementById('author').value.trim();
    const description = document.getElementById('description').value.trim();
    const category = document.getElementById('category').value;
    const photoLink = document.getElementById('photoLink').value.trim();
    const price = document.getElementById('price').value.trim();


    if (title === '' || author === '' || description === '' || photoLink === '') {
        alert('Please fill out all required fields.');
        return;
    }

    // Create an object to represent a book
    const bookData = {
        title: title,
        author: author,
        description: description,
        category: category,
        photoLink: photoLink,
        price: price
    };

    // Retrieve existing booksArray from local storage or create a new one
    let booksArray = JSON.parse(localStorage.getItem('booksArray')) || [];

    // Push the new book data object into the array
    booksArray.push(bookData);

    // Store the updated booksArray in local storage
    localStorage.setItem('booksArray', JSON.stringify(booksArray));

    // Clear the form fields
    document.getElementById('addBookForm').reset();

    console.log('Book added:', bookData);
}