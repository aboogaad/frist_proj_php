<?php
    require('/xampp/htdocs/online_library/includes/config.php');
    require('/xampp/htdocs/online_library/includes/db.php');
    include('server.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sign up</title>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="headerr">
            <h2>Sign up</h2>
        </div>
        <form action="signup.php" method="post">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" value="<?php echo $username ;?>">
                <?php if (in_array(1, $errors)): ?>
                    <div class="err">
                        username is required
                    </div>
                <?php elseif (in_array(9, $errors)): ?>
                    <div class="err">
                        username already exits
                    </div>
                <?php endif; ?>
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="text" name="email" value="<?php echo $email ;?>">
                <?php if (in_array(2, $errors)): ?>
                    <div class="err">
                        email is required 
                    </div>
                <?php elseif (in_array(3, $errors)): ?>
                    <div class="err">
                        email is not valid 
                    </div>
                <?php elseif (in_array(8, $errors)): ?>
                    <div class="err">
                        email already exists
                    </div>
                <?php endif; ?>
            </div>
            <div class="input-group">
                <label>password</label>
                <input type="password" name="password_1">
                <?php if (in_array(4, $errors)): ?>
                    <div class="err">
                        password is required
                    </div>
                <?php elseif (in_array(7, $errors)): ?>
                    <div class="err">
                        password it must at least 6 char
                    </div>
                <?php elseif (in_array(5, $errors)): ?>
                    <div class="err">
                        passwoed not match
                    </div>
                <?php endif; ?>
            </div>
            <div class="input-group">
                <label>Confirm password</label>
                <input type="password" name="password_2">
                
            </div>
            <div class="input-group">
                <button type="submit" name="register" class="btn">signup</button>
            </div>
            <p>
            have account? <a href="login.php">sign in</a>
            </p>
        </form>
    </body>
</html>

<!-- <div class="input-group">
                <label for="username">username </label><br>
                <input type="text" name="user" id="username"  required placeholder="username"><br/><br>
            </div>
            <div class="input-group">
                <label for="email">email</label><br>
                <input type="email" name="email " id="email"  required placeholder="email" ><br /><br>
            </div>    
            <div class="input-group">
                <label for="password">Password </label><br>
                <input type="password" name="pass" id="password"  required placeholder="*********" minlength="6" maxlength="12" ><br /><br>
            </div>
            <div class="input-group">
                <label for="confpassword">confirm password</label><br>
                <input type="password" name="confpass" id="confpassword" required placeholder="confirm password"/><br /><br>
            </div> -->