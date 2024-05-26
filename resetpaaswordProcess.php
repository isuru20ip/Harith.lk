<?php

require "conection.php";

$email = $_POST["email"];
$newps = $_POST["np"];
$rnewps = $_POST["rnp"];
$vcode = $_POST["vcode"];

if (empty($email)) {
    echo ("Please enter your email");
} elseif (strlen($email) > 100) {
    echo ("email must have less than 100 Charactres.");
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("invalid email");
} elseif (empty($newps)) {
    echo ("Please enter your password");
} elseif (strlen($newps) < 5 || strlen($newps) > 20) {
    echo ("password should be between 20 and 5 characters");
} elseif ($newps != $rnewps) {
    echo ("Password dose not match");
} elseif (empty($vcode)) {
    echo ("Please enter your verification code.");
} else {

    try {
        $user = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' AND `verification_code`='" . $vcode . "' ");
        $user_count = $user->num_rows;

        if ($user_count == 1) {

            Database::iud("UPDATE `user` SET `password` = '" . $newps . "' WHERE `email`='" . $email . "' AND `verification_code`='" . $vcode . "' ");
            Database::iud("UPDATE `user` SET `verification_code` = NULL WHERE `email`='" . $email . "' AND `verification_code`='" . $vcode . "' ");
            setcookie("email", "", -1);
            setcookie("password", "", -1);

            echo ("Success");
        } else {
            echo ("The verification code does not match.");
        }
    } catch (\Throwable $th) {
        echo ('error occurs <a href="fogot_password.php">Try Again</a>');
    }
}
