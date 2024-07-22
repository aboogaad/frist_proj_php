<?php
    require('/xampp/htdocs/online_library/includes/config.php');
    require('/xampp/htdocs/online_library/includes/db.php');
    include('server.php');

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
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        function checkNewCategory() {
            var categorySelect = document.querySelector("select[name='category']");
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
    <?php include('/xampp/htdocs/online_library/includes/navbr.php');?>
    <div class="container">
        <h1>Add New Book</h1>
        <form action="addbook.php" method="POST">
                <?php if (in_array(99, $errors)): ?>
                    <div class="err">
                        please field all thing
                    </div>
                <?php endif; ?>
            <div>
                <label >Title:</label><br />
                <input type="text" name="title" value="<?php echo $title ;?>"/><br /><br />
            </div>
            <div>
                <label >Author:</label><br />
                <input type="text" name="author" value="<?php echo $author ;?>"/><br /><br />
            </div>
            <div>
                <label for="category">Category:</label><br />
                <select name="category" onchange="checkNewCategory()">
                    <?php foreach($genrelist as $genre) : ?>
                        <option value="<?php echo htmlspecialchars($genre['genre']); ?>"><?php echo htmlspecialchars($genre['genre']); ?></option>
                    <?php endforeach ?>
                    <option value="new" >Add New Category</option>
                </select>
                <input style="display: none;" type="text" name="new_category" id="new_category" placeholder="Enter new category">
                <br /><br />
            </div>
            <div>
                <label>Description:</label><br />
                <textarea name="description" rows="4" value="<?php echo $description ;?>"></textarea><br /><br />
            </div>
            <div>
                <label>pages:</label><br />
                <input type="number" name="pages" value="<?php echo $pages ;?>"/><br /><br />
                <label>Photo Link:</label><br />
                <input type="text" name="photoLink" value="<?php echo $photoLink ;?>"/><br /><br />
                <label>Price:</label><br />
                <input type="number" name="price" min="0" step="0.01" value="<?php echo $price ;?>"/><br /><br />
                <label>copies:</label><br />
                <input type="number" name="copies" min="1" step="0.01" value="<?php echo $copies ;?>"/><br /><br />
            </div>
            <button type="submit" name="addbook" class="btn" >Add Book</button>
        </form>
    </div>
    <?php include('/xampp/htdocs/online_library/includes/footer.php');?>
</body>
</html>