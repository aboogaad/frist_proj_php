<?php
    require('/xampp/htdocs/online_library/includes/config.php');
    require('/xampp/htdocs/online_library/includes/db.php');
    include('server.php');
    $username = $_SESSION['username'];

    $query = "SELECT photo,title,b.book_id
    FROM users u ,borrows c, books b 
    WHERE u.user_id = c.user_id AND b.book_id = c.book_id AND username='{$username}'";
    $result = mysqli_query($conn, $query);

    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //var_dump($books);

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
        <?php if($books) :?>
            <h1 class="borrowed-books">Borrowed Books</h1>
            <?php foreach($books as $book) :?>
                <div class="borrowed-book">
                    <div class="book">
                        <div>
                            <img src="<?php echo $book['photo'];?>" alt="book image">
                        </div>
                        <p>book name : <?php echo $book['title'];?></p>
                    </div>
                    <form action="borrowed.php" method="POST">
                        <input type="hidden" name="delete_id" value="<?php echo $book['book_id'];?>">
                        <input type="submit" name="deleteborrow" value="Delete" class="btn btn-danger">
                    </form>
                    <br>
                </div>
            <?php endforeach;?>
        <?php else :?>
            <h1>you dont have borrowed book</h1>
        <?php endif;?>
        <?php include('/xampp/htdocs/online_library/includes/footer.php');?>
    </body>
</html>