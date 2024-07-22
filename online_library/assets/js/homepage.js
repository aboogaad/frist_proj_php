function logout() {
    localStorage.removeItem("name");
    localStorage.removeItem("role");
}
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("logout").addEventListener("click", logout);
});
let boga = localStorage.getItem("name")
const acc_admin = `<nav>
<div  class="logo">
    <img src="../imgs/icon.png" alt="logo">
</div>
<div class="mainnav">
    <a href="#">Home</a>
    <a href="#categories">Categories</a>
    <a href="edit.html">edit books</a>
    <a href="addbook.html">add book</a>
</div>
<div class="reg">
    <a href="homepage.html" id="logout">logOut</a>
    <a href="profile.html">${boga}</a>
</div>
</nav>`;
const acc_user = `<nav>
<div  class="logo">
    <img src="../imgs/icon.png" alt="logo">
</div>
<div class="mainnav">
    <a href="#">Home</a>
    <a href="#categories">Categories</a>
    <a href="availableBookList.html">Available books</a>
    <a href="borrowedbooks.html">borrowed books</a>
    <a href="cart.html">cart</a>
</div>
<div class="reg">
    <a href="homepage.html" id="logout">logOut</a>
    <a href="profile.html">${boga}</a>
</div>
</nav>`
const acc = `<nav>
<div  class="logo">
    <img src="../imgs/icon.png" alt="logo">
</div>
<div class="mainnav">
    <a href="#">Home</a>
    <a href="#categories">Categories</a>
    <a href="availableBookList.html">Available books</a>
</div>
<div class="reg">
    <a href="login.html">Login</a>
    <a href="signup.html">Register</a>
</div>
</nav>`
const header = document.getElementById("header");

if (localStorage.getItem("role") === "admin") {
    header.innerHTML = acc_admin;
}
else if (localStorage.getItem("role") === "user") {
    header.innerHTML = acc_user;
}
else{
    header.innerHTML = acc;
}