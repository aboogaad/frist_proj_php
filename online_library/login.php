<?php
    require('/xampp/htdocs/online_library/includes/config.php');
    require('/xampp/htdocs/online_library/includes/db.php');
    include('server.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="headerr">
        <h2>Login</h2>
    </div>
    <form action="login.php" method="post">
        <div class="input-group">
        <?php if (in_array(6, $errors)): ?>
                <div class="err">
                    username or password is wrong
                </div>
            <?php endif; ?>
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $username ;?>">
            <?php if (in_array(1, $errors)): ?>
                <div class="err">
                    user name is required
                </div>
            <?php endif; ?>
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password">
            <?php if (in_array(4, $errors)): ?>
                <div class="err">
                    password is required
                </div>
            <?php endif; ?>
        </div>
        <div class="input-group">
            <button type="submit" name="login" class="btn">login</button>
        </div>
        <p>
            not have account? <a href="signup.php">sign up</a>
        </p>
    </form>
</body>
</html>