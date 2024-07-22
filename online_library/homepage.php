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
        <title>online libaray</title>
        <meta charset="UTF-8"/>
        <meta name="discrition" content="libaray you can borrow book"/>
        <title>Navigation Bar</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php include('/xampp/htdocs/online_library/includes/navbr.php');?>
        <main>
            <section class="intro">
                <h2>Welcome to Boga Online Library</h2>
                <p>Your gateway to a world of books and knowledge.</p>
            </section>
            <section id="categories">
                <h2>Categories</h2>
                <div class="category-list">
                    <?php foreach ($genrelist as $genre):?>
                        <div class="category-item"><a class="genre" href="genre.php?genre=<?php echo $genre['genre'];?>"><?php echo $genre['genre']?></a></div>
                    <?php endforeach; ?>
                </div>
            </section>
        </main>
        <?php include('/xampp/htdocs/online_library/includes/randombook.php');?>
        
        <?php include('/xampp/htdocs/online_library/includes/footer.php');?>
    </body>
    <script src="../js/homepage.js"></script>
</html>

