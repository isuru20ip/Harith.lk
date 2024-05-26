<?php

require "conection.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$password = $_POST["password"];
$mobile = $_POST["mobile"];

if (empty($fname)) {
    echo ("Please enter your first name");
} elseif (is_numeric($fname)) {
    echo ("first name must have only letters.");
} elseif (strlen($fname) > 45) {
    echo ("first name must have less than 45 Charactres.");
} elseif (empty($lname)) {
    echo ("Please enter your last name");
} elseif (strlen($lname) > 45) {
    echo ("last name must have less than 45 Charactres.");
} elseif (empty($email)) {
    echo ("Please enter your email");
} elseif (strlen($email) > 100) {
    echo ("email must have less than 100 Charactres.");
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("invalid email");
} elseif (empty($password)) {
    echo ("Please enter your password");
} elseif (strlen($password) < 5 || strlen($password) > 20) {
    echo ("password should be between 20 and 5 characters");
} elseif (empty($mobile)) {
    echo ("Please enter your contact number");
} elseif (strlen($mobile) !== 10) {
    echo ("invalid Phone Number");
} elseif (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $mobile)) {
    echo ("invalid mobile number");
} else {

    try {
        $user_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "' OR `contact_no` = '" . $mobile . "' ");

        $user_count = $user_rs->num_rows;

        if ($user_count == 0) {
    
            $d = new DateTime();
            $time_zone = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($time_zone);
            $date = $d->format("Y-m-d ");

            Database::iud("INSERT INTO `user` (`fname`,`lname`,`email`,`password`,`contact_no`,`join_date`,`status`,`user_type_id`) 
            VALUES ('" . $fname . "','" . $lname . "','" . $email . "','" . $password . "','" . $mobile . "','" . $date . "','1','2') ");
    
            echo ("good");
        } else {
            echo ("bad");
        }


    } catch (\Throwable $th) {
        echo ('error occurs <a href="Register.php">Try Again</a>');
    }

}
