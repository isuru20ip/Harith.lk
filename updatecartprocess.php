<?php
session_start();
require "conection.php";

if (isset($_SESSION["user"])) {
    if (isset($_GET["order_id"])) {
        $order_id =$_GET["order_id"];
        $email = $_SESSION["user"]["email"];

        Database::iud("UPDATE `cart` SET `order_id` = '".$order_id."' WHERE `user_email` = '".$email."' ");
        echo("Done");
    }
}

?>