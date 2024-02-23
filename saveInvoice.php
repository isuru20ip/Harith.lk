<?php
session_start();
require "conection.php";

if (isset($_SESSION["user"])) {

    $orderId = $_GET["order_id"];
    $user = $_SESSION["user"]["email"];

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email` = '" . $user . "' AND `order_id` = '" . $orderId . "' ");
    $cart_num = $cart_rs->num_rows;

    for ($i = 0; $i < $cart_num; $i++) {
        $cart_data = $cart_rs->fetch_assoc();

        $qty = $cart_data["qty"];
        $pid = $cart_data["product_id"];

        $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $pid . "'");
        $product_data = $product_rs->fetch_assoc();

        $current_qty = $product_data["qty"];
        $new_qty = $current_qty - $qty;

        $amount = ($product_data["price"]*$qty);

        Database::iud("UPDATE `product` SET `qty`='" . $new_qty . "' WHERE `id`='" . $pid . "'");

        $qty_rs = Database::search("SELECT * FROM `product` WHERE `id` ='" . $pid . "' ");
        $qty_data = $qty_rs->fetch_assoc();

        if ($qty_data["qty"] < 1) {
            Database::iud("UPDATE `product` SET `status_status_id`='2' WHERE `id`='" . $pid . "'");
        }

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `invoice`(`order_id`,`date`,`total`,`iqty`,`status`,`product_id`,`user_email`) VALUES 
        ('" . $orderId . "','" . $date . "','" . $amount . "','" . $qty . "','0','" . $pid . "','" . $user . "')");



        // if ($cart_num == 1) {
        //     $item = $product_data["title"];
        // } else {
        //     $item = $cart_num . " Items";
        // }
    }

    Database::iud("DELETE FROM `cart` WHERE `order_id` = '".$orderId."'");

    echo ("A");
}
