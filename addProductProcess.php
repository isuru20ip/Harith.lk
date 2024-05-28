<?php

session_start();
require "conection.php";

$email = $_SESSION["admin"]["user_email"];

$pname = $_POST["pname"];
$price = $_POST["price"];
$qty = $_POST["qty"];
$dfee = $_POST["dfee"];
$category = $_POST["cat"];
$des = $_POST["des"];

if (empty($pname)) {
    echo ("please enter the product name");
} else if (strlen($pname) >= 50) {
    echo ("product name should have less than 50 characters");
} else if (empty($price)) {
    echo ("please enter the product price");
} elseif (!is_numeric($price)) {
    echo ("Invalid value for product price");
} elseif (empty($qty)) {
    echo ("please enter the qty of product");
} elseif (!is_numeric($qty)) {
    echo ("Invalid value for product qty");
} elseif (empty($dfee)) {
    echo ("please enter the product delivery fee");
} elseif (!is_numeric($dfee)) {
    echo ("Invalid value for product delivery fee");
} elseif ($category == 0) {
    echo ("please select the product category");
} elseif (empty($des)) {
    echo ("enter the product description");
} else {

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    try {

        Database::iud("INSERT INTO `product` (`title`,`description`,`date_and_time`,`price`,`delivery_fee`,`qty`,`category_id`,`status_status_id`) VALUES ('" . $pname . "','" . $des . "','" . $date . "','" . $price . "','" . $dfee . "','" . $qty . "','" . $category . "','1') ");

        $product_id = Database::$connection->insert_id;
        $length = sizeof($_FILES);

        if ($length <= 3 && $length > 0) {

            $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

            for ($i = 0; $i < $length; $i++) {

                if (isset($_FILES["pim" . $i])) {

                    $image_file = $_FILES["pim" . $i];
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

                        $file_name = "resources//product//" . $pname . uniqid() . $new_img_extention;
                        move_uploaded_file($image_file["tmp_name"], $file_name);

                        Database::iud("INSERT INTO `p_img`(`p_path`,`product_id`) VALUES ('" . $file_name . "','" . $product_id . "');");
                    } else {
                        echo ("Not an allowed image type");
                    }
                }
            }
            echo ("sucsess");
        } else {
            echo ("Invalid Image Count");
        }
    } catch (\Throwable $th) {
        echo ("An Error occurs, Try Again");
    }
}
