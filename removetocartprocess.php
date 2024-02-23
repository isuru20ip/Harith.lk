<?php
session_start();
require "conection.php";

if (isset($_SESSION["user"])) {
    if (isset($_GET["id"])) {

        $pid = $_GET["id"];
        $user = $_SESSION["user"]["email"];

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_id`='" . $pid . "' AND `user_email`='" . $user . "'");
        $cart_num = $cart_rs->num_rows;

        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
        $product_data = $product_rs->fetch_assoc();

        if ($cart_num == 1) {

            Database::iud("DELETE FROM `cart` WHERE `product_id`='" . $pid . "' AND `user_email`='" . $user . "'");
            echo ("1");
        } else {

            echo ("something went wrong");
        }
    }
}
