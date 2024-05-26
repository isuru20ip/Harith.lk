<?php

session_start();
require "conection.php";

if (isset($_SESSION["user"])) {

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $pw = $_POST["password"];

    $line1 = $_POST["line1"];
    $line2 = $_POST["line2"];
    $province = $_POST["province"];
    $distric = $_POST["district"];
    $city = $_POST["city"];
    $pcode = $_POST["pcode"];


    if (empty($fname)) {
        echo ("Please enter your first name");
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
    } elseif (empty($pw)) {
        echo ("Please enter your password");
    } elseif (strlen($pw) < 5 || strlen($pw) > 20) {
        echo ("password should be between 20 and 5 characters");
    } elseif (empty($phone)) {
        echo ("Please enter your contact number");
    } elseif (strlen($phone) !== 10) {
        echo ("invalid Phone Number");
    } elseif (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $phone)) {
        echo ("invalid mobile number");
    } elseif (empty($line1)) {
        echo ("Please enter your address Line 1");
    } elseif (strlen($line1) > 60) {
        echo ("address Line 1 must have less than 45 Charactres.");
    } elseif (empty($line2)) {
        echo ("Please enter your address Line 2");
    } elseif (strlen($line2) > 60) {
        echo ("address Line 2 must have less than 45 Charactres.");
    } elseif (empty($city)) {
        echo ("Please select your city");
    } elseif (empty($pcode)) {
        echo ("Please enter your Postal Code");
    } elseif (strlen($pcode) > 5 || strlen($pcode) < 5) {
        echo ("Postal Code must have less than 6 Charactres.");
    } else {

        try {


            // <--Update Address-->
            $adders_rs = Database::search("SELECT * FROM `address` WHERE `user_email` = '" . $email . "';");
            $adders_num = $adders_rs->num_rows;

            if ($adders_num == '1') {
                Database::iud("UPDATE `address` SET `line_1` = '" . $line1 . "', `line_2` = '" . $line2 . "', `postal_code` = '" . $pcode . "', `city_id` = '" . $city . "' WHERE `user_email` = '" . $email . "' ");
            } else {
                Database::iud("INSERT INTO `address` (`line_1`,`line_2`,`postal_code`,`city_id`,`user_email`) VALUE ('" . $line1 . "','" . $line2 . "','" . $pcode . "','" . $city . "','" . $email . "')");
            }

            //    <-- Update Img -->
            $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

            if (isset($_FILES["pm"])) {

                $img = $_FILES["pm"]; // image
                $fil_type = $img["type"]; // image type

                if (in_array($fil_type, $allowed_image_extentions)) {

                    $new_file_type;

                    if ($fil_type == "image/jpg") {
                        $new_file_type = ".jpg";
                    } elseif ($fil_type == "image/jpeg") {
                        $new_file_type = ".jpeg";
                    } elseif ($fil_type == "image/png") {
                        $new_file_type == ".png";
                    } elseif ($fil_type == "image/svg+xml") {
                        $new_file_type == ".svg";
                    }

                    $file_name = "resources//user_img//" . $lname . "_" . $phone . "_" . uniqid() . $new_file_type;
                    move_uploaded_file($img["tmp_name"], $file_name);


                    $image_rs = Database::search("SELECT * FROM `user_img` WHERE `user_email`='" . $email . "'");
                    $image_num = $image_rs->num_rows;

                    if ($image_num == 1) {
                        Database::iud("UPDATE `user_img` SET `path`='" . $file_name . "' WHERE `user_email`='" . $email . "'");
                    } else {
                        Database::iud("INSERT INTO `user_img` (`path`,`user_email`) VALUES('" . $file_name . "' ,'" . $email . "')");
                    }
                } else {
                    echo ("Fill type does not allowed to uplord");
                }
            }

            //    <--Update User-->
            $user_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "'");
            $user_num = $user_rs->num_rows;

            if ($user_num == 1) {
                Database::iud("UPDATE `user` SET `fname` = '" . $fname . "', `lname` = '" . $lname . "', `password` = '" . $pw . "', `contact_no`='" . $phone . "' WHERE `email` = '" . $email . "'");
                echo ("Done");
            } else {
                echo ("You are not valid user ");
            }
        } catch (\Throwable $th) {
            echo('Some thing went wrong Please Try again');
        }
    }
}
