<?php
    require('/xampp/htdocs/online_library/includes/config.php');
    require('/xampp/htdocs/online_library/includes/db.php');
    include('serveradmin.php');

    $query ="SELECT DISTINCT genre FROM books" ;

    $result = mysqli_query($conn, $query);

    $genrelist = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //var_dump($genrelist);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add New Book</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <script>
        function checkNewCategory() {
            var categorySelect = document.getElementById("category");
            var newCategoryInput = document.getElementById("new_category");

            if (categorySelect.value === "new") {
                newCategoryInput.style.display = "block";
            } else {
                newCategoryInput.style.display = "none";
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Add New Book</h1>
        <form id="addBookForm" action="submit_book.php" method="POST">
            <div>
                <label for="title">Title:</label><br />
                <input type="text" id="title" name="title" /><br /><br />
            </div>
            <div>
                <label for="author">Author:</label><br />
                <input type="text" id="author" name="author" /><br /><br />
            </div>
            <div>
                <label for="category">Category:</label><br />
                <select name="category" id="category" onchange="checkNewCategory()">
                    <option value="1" selected>Coding</option>
                    <option value="2">Cyber Security</option>
                    <option value="3">Biography</option>
                    <option value="4">Fantasy</option>
                    <option value="5">Comedy</option>
                    <option value="6">Romantic</option>
                    <option value="new">Add New Category</option>
                </select>

                <input type="text" name="new_category" id="new_category" placeholder="Enter new category">
                
                <br /><br />
            </div>
            <div>
                <label for="description">Description:</label><br />
                <textarea id="description" name="description" rows="4"></textarea><br /><br />
            </div>
            <div>
                <label for="photoLink">Photo Link:</label><br />
                <input type="text" id="photoLink" name="photoLink" /><br /><br />
                <label for="price">Price:</label><br />
                <input type="number" id="price" name="price" min="0" step="0.01" /><br /><br />
            </div>
            

            <button type="button" onclick="addBook()" >Add Book</button>
        </form>
    </div>
</body>
</html>