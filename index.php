<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main>
    <div class="sign-form">
        <h3>Log In</h3>
        <?php 
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "emptyfields") {
                    echo '<p class="signuperror">Fill in all fields!</p>';
                } elseif ($_GET['error'] == "wrongpassword") {
                    echo '<p class="signuperror">Wrong Password!</p>';
                } elseif ($_GET['error'] == "nouser") {
                    echo '<p class="signuperror">No User with that Username!</p>';
                }
            }
        ?>
        <form action="includes/login.inc.php" method="POST">
            <input type="text" name="mailuser" id="mailuser" placeholder='Email or Username'>
            <input type="password" name="password" id="password" placeholder='Password'>
            <button type="submit" name="login-submit" id="login">Log In</button>
        </form>
    </div>
    <div class="page-text">
        <h2>Welcome to My Website!</h2>
        <p>Connect with friends with this new amazing shit!!!</p>
    </div>
    <div class="sign-form">
        <h3>Sign Up</h3>
        <?php 
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "emptyfields") {
                    echo '<p class="signuperror">Fill in all fields!</p>';
                } elseif ($_GET['error'] == "invalidmailusername") {
                    echo '<p class="signuperror">Invalid Username and Email!</p>';
                } elseif ($_GET['error'] == "invalidmail") {
                    echo '<p class="signuperror">Invalid Email!</p>';
                } elseif ($_GET['error'] == "invalidusername") {
                    echo '<p class="signuperror">Invalid Username!</p>';
                } elseif ($_GET['error'] == "usertaken") {
                    echo '<p class="signuperror">Username is already taken!</p>';
                } 
            }
        ?>
        <form action="includes/signup.inc.php" method="POST">
            <input type="text" name="firstname" id="firstname" placeholder='First Name'>
            <input type="text" name="lastname" id="lastname" placeholder='Last Name'>
            <input type="text" name="username" id="username" placeholder='Username'>
            <input type="text" name="email" id="email" placeholder='Email'>
            <input type="password" name="password" id="password" placeholder='Password'>
            <button type="submit" name="signup-submit" id="signup">Sign Up</button>
        </form>
    </div>
</main>


</body>
</html>
