<?php
    require('/xampp/htdocs/online_library/includes/config.php');
    require('/xampp/htdocs/online_library/includes/db.php');
    include('server.php');

    $searchTerm = "";
    if(isset($_POST['search'])){
        $searchTerm = mysqli_real_escape_string($conn,$_POST['trim']);
    }
    $query = "SELECT * FROM books WHERE title LIKE '%$searchTerm%'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die('Query error: ' . mysqli_error($conn));
    }
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>online libaray</title>
        <meta charset="UTF-8"/>
        <meta name="discrition" content="libaray you can borrow book"/>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php include('/xampp/htdocs/online_library/includes/navbr.php');?>
        <form action="availablebook.php" method="post">
            <input type="text" name="trim" placeholder="Search by book name" value="<?php echo $searchTerm ;?>">
            <button type="submit" name="search" class="btn btn-primary">Search</button>
        </form> 
        <div class="container">
            <h1>Available Books</h1>
            <?php foreach($books as $book) : ?>
                <div class="avalable-books" style=" padding : 12px;">
                    <img src="<?php echo $book['photo'];?>" alt="<?php echo $book['title'];?>">
                    <h2><?php echo $book['title'];?></h2>
                    <small>author : <?php echo $book['author'];?></small>
                    <p><?php echo $book['genre'];?></p>
                    <a class="btn btn-default" href="viewbook.php?id=<?php echo $book['book_id'];?>">read more</a>
                </div>
            <?php endforeach;?>
        </div>
        <?php include('/xampp/htdocs/online_library/includes/footer.php');?>
</body>
</html>