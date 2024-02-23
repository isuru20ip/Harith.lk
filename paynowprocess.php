<?php

session_start();
require "conection.php";

if (isset($_SESSION["user"])) {

    $pid = $_GET["id"];
    $qty = $_GET["qty"];
    $umail = $_SESSION["user"]["email"];

    $array;

    $order_id = uniqid();

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $pid . "'");
    $product_data = $product_rs->fetch_assoc();

    $city_rs = Database::search("SELECT * FROM `address` INNER JOIN `city` ON city.city_id=address.city_id WHERE `user_email` ='$umail' ");
    $city_num = $city_rs->num_rows;

    if ($city_num == '1') {

        $city_data = $city_rs->fetch_assoc();

        $address = $city_data["line_1"] . "," . $city_data["line_2"];
        $city_name = $city_data["city_name"];
        $item = $product_data["title"];
        $amount = (int)($product_data["price"] * (int)$qty) + (int)$product_data["delivery_fee"];

        $fname = $_SESSION["user"]["fname"];
        $lname = $_SESSION["user"]["lname"];
        $email = $_SESSION["user"]["email"];
        $mobile = $_SESSION["user"]["contact_no"];
        $uaddress = $address;
        $city = $city_name;

        $merchant_id = "1224007";
        $merchant_secret = "MTYwOTQ0MDg4NDIwMDU4MjM2NTQ5NzU5MzU3MTAzNDA0NDQwOTc=";
        $currency = "LKR";

        $hash = strtoupper(
            md5(
                $merchant_id .
                    $order_id .
                    number_format($amount, 2, '.', '') .
                    $currency .
                    strtoupper(md5($merchant_secret))
            )
        );

        $array["id"] = $order_id;
        $array["item"] = $item;
        $array["amount"] = $amount;
        $array["fname"] = $fname;
        $array["lname"] = $lname;
        $array["umail"] = $umail;
        $array["mobile"] = $mobile;
        $array["address"] = $uaddress;
        $array["city"] = $city;
        $array["hash"] = $hash;

        echo json_encode($array);
    } else {
        echo ("Adress_Empty");
    }
}
