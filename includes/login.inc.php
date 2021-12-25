<?php

if (isset($_POST['login-submit'])) {
    
    require 'dbh.inc.php';

    $mailuser = $_POST['mailuser'];
    $password = $_POST['password'];

    if (empty($mailuser) || empty($password)) {
        header("Location: ../index.php?error=emptyfields");
        exit();    
    } else {
        $sql = "SELECT * FROM users WHERE usnameUsers=? OR emailUsers=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();         
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $mailuser, $mailuser);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                if ($password !== $row['passwordUsers']) {
                    header("Location: ../index.php?error=wrongpassword");
                    exit();    
                } elseif ($password == $row['passwordUsers']) {
                    session_start();
                    $_SESSION['userId'] = $row['idUsers'];
                    $_SESSION['username'] = $row['usnameUsers'];
                    $_SESSION['userEmail'] = $row['emailUsers'];
                    $_SESSION['userFirst'] = $row['firstnameUsers'];
                    $_SESSION['userLast'] = $row['lastnameUsers'];
                    $_SESSION['userPassword'] = $row['passwordUsers'];

                    header("Location: ../pages/home.php?login=success");
                    exit();
                } else {
                    header("Location: ../index.php?error=wrongpassword");
                    exit(); 
                }
            } else {
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }
    }

} else {
    header("Location: ../index.php");
    exit();
}