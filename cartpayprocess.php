<?php

session_start();
require "conection.php";

if (isset($_SESSION["user"])) {

    $user = $_SESSION["user"]["email"];
    $address_rs = Database::search("SELECT * FROM `address` INNER JOIN `city` ON city.city_id = address.city_id WHERE `user_email` = '" . $user . "'");
    $address_num = $address_rs->num_rows;

    if ($address_num == 1) {
        $address_data = $address_rs->fetch_assoc();

        $total = 0;
        $shipping = 0;
        $subtal = 0;
        $order_id = uniqid();
        $array;
        $title;


        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email` = '" . $user . "' AND `order_id` = 'NULL'");
        $cart_num = $cart_rs->num_rows;

        for ($i = 0; $i < $cart_num; $i++) {

            $cart_data = $cart_rs->fetch_assoc();
            $pid = $cart_data["product_id"];

            $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $pid . "'");
            $product_data = $product_rs->fetch_assoc();

            $subtal = $subtal + ($product_data["price"] * $cart_data["qty"]);
            if ($shipping <= $product_data["delivery_fee"]) {
                $shipping = $product_data["delivery_fee"];
            }
            $total = $subtal + $shipping;

            if ($cart_num == 1) {
                $item = $product_data["title"];
            }else{
                $item = $cart_num . " Items";
            }
        }

        $address = $address_data["line_1"] . "," . $address_data["line_2"];
        $city_name = $address_data["city_name"];
       
        $amount = $total;

        $fname = $_SESSION["user"]["fname"];
        $lname = $_SESSION["user"]["lname"];
        $email = $_SESSION["user"]["email"];
        $mobile = $_SESSION["user"]["contact_no"];
        $uaddress = $address;
        $city = $city_name;

        $merchant_id = ".....";
        $merchant_secret = "..........";
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
        $array["umail"] = $user;
        $array["mobile"] = $mobile;
        $array["address"] = $uaddress;
        $array["city"] = $city;
        $array["hash"] = $hash;

        echo json_encode($array);

    } else {
        echo ("NO_ADDERSS");
    }
}
