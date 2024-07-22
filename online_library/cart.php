<?php
    require('/xampp/htdocs/online_library/includes/config.php');
    require('/xampp/htdocs/online_library/includes/db.php');
    include('server.php');

    $username = $_SESSION['username'];
    // description,price,photo,page,genre,author,title
    $query = "SELECT  b.book_id,description,price,photo,page,genre,author,title
    FROM users u ,carts c, books b 
    WHERE u.user_id = c.user_id AND b.book_id = c.book_id AND username='{$username}'";
    $result = mysqli_query($conn, $query);

    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //var_dump($books);

    mysqli_free_result($result);
    
?>


<html>
    <head>
        <title>online libaray</title>
        <meta charset="UTF-8"/>
        <meta name="discrition" content="libaray you can borrow book"/>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php include('/xampp/htdocs/online_library/includes/navbr.php');?>
        <div class="cart-books">
            <?php foreach ($books as $book) :?>
                <div class="book">
                    <img src="<?php echo $book['photo'];?>" alt="Book 1">
                    <div class="book-details">
                        <h3 class="book-name"> book name : <?php echo $book['title'];?> </h3>
                        <p class="book-price"> price :<?php echo $book['price'];?></p>
                    </div>
                </div>
                <div class="btn-remove">
                    <br>
                    <button>remove from cart</button>
                    <form action="cart.php" method="POST">
                        <input type="hidden" name="delete_id" value="<?php echo $book['book_id'];?>">
                        <input type="submit" name="deletecart" value="Delete" class="btn btn-danger">
                    </form>
                </div>
            <?php endforeach;?>
            <?php if ($books) : ?>
                <form action="cart.php" method="post" class="product_box">
                    <button type="submit" name="borrow" class="btn">borrowed</button>
                </form>
            <?php else : ?>
                <h2>you dont have book in cart</h2>
            <?php endif ?>
        </div>
        <?php include('/xampp/htdocs/online_library/includes/footer.php');?>
    </body>
</html>


