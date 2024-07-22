<?php
    session_start();
    $username = "";
    $email = "";
    $errors = array();
    //sign up
    //code erorr :
    //1=>username reqiuer
    //2=>email require
    //3=>email not valid
    //4=>password require
    //5=>password not match
    //6=>user or pass is wrong
    //7=>password short
    //8=>email is exit
    //0=>user is exit
    if(isset($_POST['register'])){
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $password_1 = mysqli_real_escape_string($conn,$_POST['password_1']);
        $password_2 = mysqli_real_escape_string($conn,$_POST['password_2']);
        
        if(empty($username)){
            array_push($errors,"1");
        } else {
            $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->bind_param("s", $username); 
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                array_push($errors, "9"); 
            }
        }
        if(empty($email)){
            array_push($errors,"2");
        } else {
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email); 
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                array_push($errors, "8");
            }
        }
        if (filter_var($email , FILTER_VALIDATE_EMAIL) === false) {
            array_push($errors,"3");
        }
        if(empty($password_1)){
            array_push($errors,"4");
        }
        elseif (strlen($password_1) < 6) {
            array_push($errors,"7");
        }
        if($password_1 != $password_2){
            array_push($errors,"5");
        }
        if (count($errors) == 0) {
            $password = md5($password_1);
            $sql = "INSERT INTO users (username,email,password) VALUES ('$username','$email','$password')";
            mysqli_query($conn,$sql);
            header('location:login.php');
        }

    }
    //login
    if (isset($_POST['login'])) {
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        
        if(empty($username)){
            array_push($errors,"1");
        }
        
        if(empty($password)){
            array_push($errors,"4");
        }
        if (count($errors) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            
            $result = mysqli_query($conn,$query);
            if (mysqli_num_rows($result) == 1) {
                $query = "SELECT role, user_id FROM users WHERE username='$username'";
                $result_2 = mysqli_query($conn,$query);
                $row = mysqli_fetch_assoc($result_2);
                $role = $row['role'];
                $user_id = $row['user_id'];
                $_SESSION['user_id'] = $user_id;
                $_SESSION['role'] = $role;
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "you are now logged in";
                header('location:homepage.php');
            }else{
                array_push($errors,"6");
            }
        }
    }
    //log out
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        unset($_SESSION['role']);
        unset($_SESSION['user_id']);
        header('location: homepage.php');
    }
    // add to cart
    if (isset($_POST['addcart'])) {
        if ($_SESSION['role'] === "user") {
            $book_id = mysqli_real_escape_string($conn, $_POST['addcart_id']);
            //remove copy from book
            $query = "SELECT * FROM books WHERE book_id =".$book_id;
            $result = mysqli_query($conn, $query);
            $book = mysqli_fetch_assoc($result);
            $copies = $book['available_copies'] - 1;
            
            $query = "UPDATE books SET
            available_copies = $copies
            WHERE book_id = {$book_id} ";

            mysqli_query($conn,$query);
            //add to cart
            
            $user_id = $_SESSION['user_id'];
            $sql = "INSERT INTO carts (user_id,book_id) VALUES ($user_id , $book_id)";
            mysqli_query($conn,$sql);
            header('location:homepage.php');
        }else{
            header('location: login.php');
        }
    }
    // delete from cart
    if (isset($_POST['deletecart'])) {
        $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

        $query = "SELECT * FROM books WHERE book_id =".$delete_id;
        $result = mysqli_query($conn, $query);
        $book = mysqli_fetch_assoc($result);
        var_dump($book);
        $copies = (int)$book['available_copies'] ;
        $copies++;
            
        $query = "UPDATE books SET
        available_copies = '$copies'
        WHERE book_id = {$delete_id} ";

        mysqli_query($conn,$query);


        $query = "DELETE FROM carts WHERE book_id = ".$delete_id;

        if (mysqli_query($conn,$query)) {
            header('Location:cart.php');
        }else{
            echo 'error'. mysqli_error($conn);
        }
    }

    //borrow
    if (isset($_POST['borrow'])) {
        $user_id = $_SESSION['user_id'];
        $query = " INSERT INTO borrows (user_id, book_id)
            SELECT user_id, book_id
            FROM carts
            WHERE user_id = {$user_id};";
        mysqli_query($conn,$query);
        $query = "DELETE FROM carts
            WHERE user_id = {$user_id};";
        mysqli_query($conn,$query);
        header('location:homepage.php');
    }
    // delete from borrow
    if (isset($_POST['deleteborrow'])) {
        $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

        $query = "DELETE FROM borrows WHERE book_id = ".$delete_id;

        if (mysqli_query($conn,$query)) {
            header('Location:borrowed.php');
        }else{
            echo 'error'. mysqli_error($conn);
        }
    }
?>
