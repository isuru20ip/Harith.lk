<?php 
session_start();
require "conection.php";

if (isset($_SESSION["admin"])) {
    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '".$pid."'");
    $product_data = $product_rs->fetch_assoc();

    Database::iud("DELETE FROM `p_img` WHERE `product_id` = '".$pid."'");
    Database::iud("DELETE FROM `invoice` WHERE `product_id` = '".$pid."' ");
    Database::iud("DELETE FROM `product` WHERE `id` = '".$pid."' ");

    echo("1");

}
?>