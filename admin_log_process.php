<?php 


session_start();
require "conection.php";

$admin = $_POST["admin"];
$password = $_POST["password"];


if (empty($admin)) {
    echo ("Please enter your Admin Name");
} elseif (strlen($admin) > 45) {
    echo ("Name must have less than 45 Charactres.");
} elseif (empty($password)) {
    echo ("Please enter your password");
} elseif (strlen($password) < 5 || strlen($password) > 20) {
    echo ("password should be between 20 and 5 characters");
} else {

    $email = $_SESSION["user"]["email"];


    $user_rs = Database::search("SELECT * FROM `admin` WHERE `admin_name` = '".$admin."' AND `password` = '".$password."' ");
    $user_count = $user_rs->num_rows;

    if ($user_count == 1) {

        $user_data = $user_rs->fetch_assoc();

        if ($email == $user_data["user_email"]) {

           echo("ok");
           $_SESSION["admin"] = $user_data;

        }

    }else{
        echo("invalid Admin Name or Password");
    }

    
}


?>