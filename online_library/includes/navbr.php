<?php
    $acc_admin = '<nav>
    <div  class="logo">
        <img src="imgs/books.png" alt="logo">
    </div>
    <div class="mainnav">
        <a href="homepage.php">Home</a>
        <a href="availablebook.php">books</a>
        <a href="addbook.php">add book</a>
    </div>
    <div class="reg">
        <a href="homepage.php?logout=\'1\'" style="color: red;">log out</a>
        <a href="profile.php">boga</a>
    </div>
    </nav>';
    $acc_user = '<nav>
    <div  class="logo">
        <img src="imgs/books.png" alt="logo">
    </div>
    <div class="mainnav">
        <a href="homepage.php">Home</a>
        <a href="availableBook.php">Available books</a>
        <a href="borrowed.php">borrowed books</a>
        <a href="cart.php">cart</a>
    </div>
    <div class="reg">
        <a href="homepage.php?logout=\'1\'" style="color: red;">log out</a>
        <a href="profile.php">${boga}</a>
    </div>
    </nav>';
    $acc = '<nav>
    <div  class="logo">
        <img src="imgs/books.png" alt="logo">
    </div>
    <div class="mainnav">
        <a href="homepage.php">Home</a>
        <a href="availableBook.php">Available books</a>
    </div>
    <div class="reg">
        <a href="login.php">Login</a>
        <a href="signup.php">Register</a>
    </div>
    </nav>';
    $user_role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
    if ($user_role === 'admin') {
        $navigation = $acc_admin;
    } elseif ($user_role === 'user') {
        // Example of dynamically replacing a placeholder ${boga} with user-specific content
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'User Profile';
        $acc_user_with_username = str_replace('${boga}', $username, $acc_user);
        $navigation = $acc_user_with_username;
    } else {
        $navigation = $acc;
    }
    echo $navigation;
