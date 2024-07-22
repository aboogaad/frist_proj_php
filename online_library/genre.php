<?php
    require('/xampp/htdocs/online_library/includes/config.php');
    require('/xampp/htdocs/online_library/includes/db.php');
    include('server.php');

    $genre = mysqli_real_escape_string($conn,$_GET['genre']);

    $query = "SELECT * FROM books WHERE genre =\"{$genre}\"";

    $result = mysqli_query($conn, $query);
    
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //var_dump($posts);

    mysqli_free_result($result);

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
        <input type="text" id="searchInput" placeholder="Search by book name">
        <div class="container">
            <h1><?php echo $genre?></h1>
            <?php foreach($books as $book) : ?>
                <div class="avalable-books" style=" padding : 12px;">
                    <img src="<?php echo htmlspecialchars($book['photo']);?>">
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


