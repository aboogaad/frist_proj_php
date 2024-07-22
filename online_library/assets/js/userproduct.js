const booksArray = JSON.parse(localStorage.getItem("booksArray"));

function findBook(bookName, booksArray) {
    for (let i = 0; i < booksArray.length; i++) {
        if (booksArray[i].title === bookName) {
            return i; 
        }
    }
}
const bookNameToSearch = localStorage.getItem("namebook");
const index = findBook(bookNameToSearch, booksArray);
const found = booksArray[index];
// ==============================
const bookuse = 
`<div class="product">
    <div class="product_box">
        <div class="product_img"> 
            <img src="${found.photoLink}" alt="book image" width="50%"><br><br>
        </div>
        <div class="product_tag">
            <h2>${found.title}</h2>
            <h4>${found.price} <sub><del>30.00</del></sub></h4>
            <h5>available</h5>
            <a href="#" class="cart" onclick="addBook()">Add To Cart</a>
        </div>
        <br>
    </div>
    <div class="description_box">
        <div class="description_card">
            <h3>Book Details</h3>
            <div class="description">
                <h4>author:${found.author}</h4>
                <p>${found.description} </p>
            </div>
        </div>
    </div>
</div>`
if(index !== -1) {
    header.innerHTML = bookuse;
}
// ==================================================
function addBook() {
    const bookData = {
        title: found.title,
        author: found.author,
        description: found.description,
        category: found.category,
        photoLink: found.photoLink,
        price: found.price
    };
    let bookscart = JSON.parse(localStorage.getItem('bookscart')) || [];
    bookscart.push(bookData);
    localStorage.setItem('bookscart', JSON.stringify(bookscart));
    alert("added");
}