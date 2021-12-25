<?php
session_start();
require('../includes/dbh.inc.php');

if (isset($_SESSION['username'])) {
    $sql = "SELECT usnameUsers, firstnameUsers, lastnameUsers FROM users WHERE idUsers =". $_SESSION['userId'];
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // echo "Hi ".$data[0]['firstnameUsers']." ".$data[0]['lastnameUsers']; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <nav>
        <ul class="flex">
            <li><a href="">Home</a></li>
            <li><a href="">About</a></li>
            <li><a href="">Contact</a></li>
            <li><a href="">Gallery</a></li>
        </ul>
        <div class="flex">
        <div class="profile-name">
        <?php 
            echo $data[0]['firstnameUsers']." ".$data[0]['lastnameUsers'];
        ?>
        </div>
        <form action="../includes/logout.inc.php" method="POST">
            <button type="submit" name="logout-submit">Log Out</button>
        </form>
        </div>
    </nav>
</body>
</html>