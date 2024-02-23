<?php 
session_start();
require "conection.php";

if (isset($_SESSION["user"])) {
    if (isset($_GET["qty"])) {

        $qty = intval($_GET["qty"]);
        $pid = $_GET["pid"];
        $user = $_SESSION["user"]["email"];

         Database::iud("UPDATE `cart` SET `qty`='".$qty."' WHERE `product_id`='" . $pid . "' AND `user_email`='" . $user . "'");
         echo("1");
    }
}

?>