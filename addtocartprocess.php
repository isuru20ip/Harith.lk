<?php
session_start();
require "conection.php";

if (isset($_SESSION["user"])) {
    if (isset($_GET["id"])) {

        $pid = $_GET["id"];
        $user = $_SESSION["user"]["email"];

        if (isset($_GET["st"])) {

            $qty = $_GET["qty"];

            Database::iud("DELETE FROM `cart` WHERE `user_email` = '" . $user . "' ");

            Database::iud("INSERT INTO `cart` (`qty`, `user_email`, `product_id`,`order_id`) VALUES ('" . $qty . "', '" . $user . "', '" . $pid . "','NULL')");
            echo ("1");

        }else{

            $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_id`='" . $pid . "' AND `user_email`='" . $user . "' AND `order_id` = 'NULL'");
            $cart_num = $cart_rs->num_rows;

            if ($cart_num >= 1) {

                // Database::iud("UPDATE `cart` SET `qty`='1' WHERE `product_id`='" . $pid . "' AND `user_email`='" . $user . "'");
                echo ("You have already added this product");
            } else {

                Database::iud("INSERT INTO `cart` (`qty`, `user_email`, `product_id`,`order_id`) VALUES ('1', '" . $user . "', '" . $pid . "','NULL')");
                echo ("New Product added to the Cart");
            }

        }
        
    }
}else{
    echo("You must Loging first");
}
