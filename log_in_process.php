<?php
session_start();
require "conection.php";

$email = $_POST["email"];
$password = $_POST["password"];
$rm = $_POST["rememberme"];

if (empty($email)) {
    echo ("Please enter your email");
} elseif (strlen($email) > 100) {
    echo ("email must have less than 100 Charactres.");
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("invalid email");
} elseif (empty($password)) {
    echo ("Please enter your password");
} elseif (strlen($password) < 5 || strlen($password) > 20) {
    echo ("password should be between 20 and 5 characters");
} else {
    try {
        $user_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "' AND `password` = '" . $password . "'");
    } catch (\Throwable $th) {
        echo('error occurs <a href="Log_in.php">Try Again</a>');
        die;
    }
    $user_count = $user_rs->num_rows;
    if ($user_count == 1) {
        $d = $user_rs->fetch_assoc();
        if ($d["status"] == 2) {
            echo("Your Account has been Blocked");
        } else {
            $_SESSION["user"] = $d;

            if ($_SESSION["user"]["user_type_id"] == '1') {
                echo ("admin");
            } elseif ($_SESSION["user"]["user_type_id"] == '2') {
                echo ("costomer");
            } else {
                echo ("bad");
            }
            if ($rm == "true") {
                setcookie("email", $email, time() + 60 * 60 * 24 * 365);
                setcookie("password", $password, time() + 60 * 60 * 24 * 365);
            } else {
                setcookie("email", "", -1);
                setcookie("password", "", -1);
            }
        }
    } else {
        echo ("invalid Email Address or Password");
    }
}
