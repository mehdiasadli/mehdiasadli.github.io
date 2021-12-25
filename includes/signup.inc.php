<?php

if (isset($_POST['signup-submit'])) {
    require 'dbh.inc.php';

    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($username) || empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
        header("Location: ../index.php?error=emptyfields&usrnm=".$username."&mail=".$email."&fname=".$firstname."&lname=".$lastname);
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match('/^[a-zA-Z0-9]*$/', $username)) {
        header("Location: ../index.php?error=invalidmailusername&fname=".$firstname."&lname=".$lastname);
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../index.php?error=invalidmail&usrnm=".$username."&fname=".$firstname."&lname=".$lastname);
        exit();
    } elseif (!preg_match('/^[a-zA-Z0-9]*$/', $username)) {
        header("Location: ../index.php?error=invalidusername&mail=".$email."fname=".$firstname."&lname=".$lastname);
        exit();
    } else {

        $sql = "SELECT usnameUsers FROM users WHERE usnameUsers=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);

            if ($resultCheck > 0) {
                header("Location: ../index.php?error=usertaken&mail=".$email);
                exit();
            } else {
                $sql = "INSERT INTO users (firstnameUsers, lastnameUsers, usnameUsers, emailUsers, passwordUsers) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../index.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $username, $email, $password);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../index.php?signup=success");
                    exit();
                }      
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: ../index.php");
    exit();
}
