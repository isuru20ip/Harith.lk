<?php

session_start();
require "conection.php";

$pid = $_SESSION["p"]["id"];

$pname = $_POST["pname"];
// $price = $_POST["price"];
$qty = $_POST["qty"];
$dfee = $_POST["dfee"];
// $category = $_POST["cat"];
$des = $_POST["des"];

if (empty($pname)) {
    echo ("please enter the product name");
} else if (strlen($pname) >= 50) {
    echo ("product name should have less than 50 characters");
} elseif (empty($qty)) {
    echo ("please enter the qty of product");
} elseif (!is_numeric($qty)) {
    echo ("Invalid value for product qty");
} elseif (empty($dfee)) {
    echo ("please enter the product delivery fee");
} elseif (!is_numeric($dfee)) {
    echo ("Invalid value for product delivery fee");
} elseif (empty($des)) {
    echo ("enter the product description");
} else {

    if ($qty >= 1) {

        Database::iud("UPDATE `product` SET `title` = '" . $pname . "', `description` = '" . $des . "' , `delivery_fee` = '" . $dfee . "' ,`qty` = '" . $qty . "', `status_status_id` = '1' WHERE `id` = '" . $pid . "'");
    } else {

        Database::iud("UPDATE `product` SET `title` = '" . $pname . "', `description` = '" . $des . "' , `delivery_fee` = '" . $dfee . "' ,`qty` = '" . $qty . "' WHERE `id` = '" . $pid . "'");
    }

    Database::iud("UPDATE `product` SET `title` = '" . $pname . "', `description` = '" . $des . "' , `delivery_fee` = '" . $dfee . "' ,`qty` = '" . $qty . "' WHERE `id` = '" . $pid . "'");

    $product_id = Database::$connection->insert_id;

    if (isset($_FILES["pim"])) {

        $length = sizeof($_FILES);

        if ($length == 1) {

            $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

            $image_file = $_FILES["pim"];
            $file_extention = $image_file["type"];

            if (in_array($file_extention, $allowed_image_extentions)) {

                $new_img_extention;

                if ($file_extention == "image/jpg") {
                    $new_img_extention = ".jpg";
                } else if ($file_extention == "image/jpeg") {
                    $new_img_extention = ".jpeg";
                } else if ($file_extention == "image/png") {
                    $new_img_extention = ".png";
                } else if ($file_extention == "image/svg+xml") {
                    $new_img_extention = ".svg";
                }

                $file_name = "resources//user_img//" . $pname . uniqid() . $new_img_extention;
                move_uploaded_file($image_file["tmp_name"], $file_name);

                Database::iud("UPDATE `p_img` SET `p_path` = '" . $file_name . "' WHERE `product_id` = '" . $pid . "' ");

                echo ("1");
            } else {
                echo ("Not an allowed image type");
            }
        } else {
            echo ("Invalid Image Count");
        }
    }
    echo ("2");
}
