<?php

require "conection.php";

$product_id = $_GET["p"];

$product_rs = Database::search(" SELECT * FROM `product` WHERE `id` = '".$product_id."' ");

if ($product_rs -> num_rows == 1) {

    $product_data = $product_rs -> fetch_assoc();
    $status = $product_data["status_status_id"];

    if ($status == 1 ) {
       Database::iud(" UPDATE `product` SET `status_status_id` = '2' WHERE `id` = '".$product_id."' ");
       echo("ok");
    }elseif($status == 2){
        Database::iud(" UPDATE `product` SET `status_status_id` = '1' WHERE `id` = '".$product_id."' ");
        echo("ok");
    }

}else{
    echo("Something Went Wrong. Try again later");
}
 ?>