<?php
    require('/xampp/htdocs/online_library/includes/config.php');
    require('/xampp/htdocs/online_library/includes/db.php');
    include('server.php');

    $id = mysqli_real_escape_string($conn,$_GET['id']);

    $query = "SELECT * FROM books WHERE book_id =".$id;

    $result = mysqli_query($conn, $query);

    $book = mysqli_fetch_assoc($result);



    //random book
    $query = "SELECT * FROM books WHERE genre =\"{$book['genre']}\" AND book_id != '$id' ORDER BY RAND() LIMIT 4" ;

    $result = mysqli_query($conn, $query);

    $rndmbooks = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //var_dump($rndmbooks);

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
        
            <div class="product_box">
                <div class="product_img"> 
                    <img src="<?php echo $book['photo'] ?>" alt="book image" width="50%"><br><br>
                </div>
                <div class="product_tag">
                    <h2><?php echo $book['title'] ?></h2>
                    <h4>price :<?php echo $book['price'] ?></h4>
                    <?php if($book['available_copies']>0): ?>
                        <form action="viewbook.php" method="post" class="product_box">
                            <input type="hidden" name="addcart_id" value="<?php echo $book['book_id'];?>">
                            <button type="submit" name="addcart" class="btn">Add to cart</button>
                        </form>
                    <?php endif ?>
                </div>
                <br>
            </div>
            <div class="description_box">
                <div class="description_card">
                    <h3>Book Details</h3>
                    <div class="description">
                        <h4>author:<?php echo $book['author'] ?></h4>
                        <h4>genre:<?php echo $book['genre'] ?></h4>
                        <h4>pages:<?php echo $book['page'] ?></h4>
                        <h4>avalible copy:<?php echo $book['available_copies'] ?></h4>
                        <p>description :<?php echo $book['description'] ?> </p>
                    </div>
                </div>
            </div>
        <h2>you might also like</h2>
        <?php foreach($rndmbooks as $bookk): ?>
            <div class="featuredbooks">
                <div class="featuredbooks_box">
                    <div class="featuredbooks_card">
                        <div class="featuredbooks_img">
                            <img src="<?php echo $bookk['photo'];?>" >
                        </div>
                        <div class="featuredbooks_tag">
                            <h2><?php echo $bookk['title'];?></h2>
                            <p class="writer"><?php echo $bookk['author'];?></p>
                            <div class="categories"><?php echo $bookk['genre'];?></div> 
                            <p class="bookprice"><?php echo $bookk['price'];?></p>
                            <a href="viewbook.php?id=<?php echo $bookk['book_id'];?>" class="f_btn">Learn More</a>
                        </div>
                    </div>
                </div>       
            </div>
        <?php endforeach;?>
        <?php include('/xampp/htdocs/online_library/includes/footer.php');?>
    </body>
</html>


