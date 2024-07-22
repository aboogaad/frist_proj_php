<?php

    $query = "SELECT * FROM books ORDER BY RAND() LIMIT 4;";

    $result = mysqli_query($conn, $query);

    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //var_dump($books);

    mysqli_free_result($result);
    ?>

<h1 style="text-align:center">Featured Books</h1>
<?php foreach($books as $book): ?>
    <div class="featuredbooks">
        <div class="featuredbooks_box">
            <div class="featuredbooks_card">
                <div class="featuredbooks_img">
                    <img src="<?php echo $book['photo'];?>" >
                </div>
                <div class="featuredbooks_tag">
                    <h2><?php echo $book['title'];?></h2>
                    <p class="writer"><?php echo $book['author'];?></p>
                    <div class="categories"><?php echo $book['genre'];?></div> 
                    <p class="bookprice"><?php echo $book['price'];?></p>
                    <a href="viewbook.php?id=<?php echo $book['book_id'];?>" class="f_btn">Learn More</a>
                </div>
            </div>
        </div>       
    </div>
<?php endforeach;?>