<?php
session_start();
require "conection.php";

if (isset($_SESSION["user"])) {

    $email = $_SESSION["user"]["email"];
    $pid = $_POST["pid"];
    $text = $_POST["text"];
    // $pimg = $_POST["pimg"];

    if ($pid == 0) {
        echo ("Please select the product");
    } elseif (empty($text)) {
        echo ("Write your feedback");
    } else {



        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        try {
            Database::search("INSERT INTO `feedback` (`text`,`user_email`,`product_id`,`date`) VALUES ('" . $text . "','" . $email . "','" . $pid . "','" . $date . "')");

            $fee_id = Database::$connection->insert_id;
    
            //    <-- Update Img -->
            $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
    
            if (isset($_FILES["pimg"])) {
    
                $img = $_FILES["pimg"];
                $fil_type = $img["type"];
    
                if (in_array($fil_type, $allowed_image_extentions)) {
    
                    $new_file_type;
    
                    if ($fil_type == "image/jpg") {
                        $new_file_type = ".jpg";
                    } elseif ($fil_type == "image/jpeg") {
                        $new_file_type = ".jpeg";
                    } elseif ($fil_type == "image/png") {
                        $new_file_type == ".png";
                    } elseif ($fil_type == "image/svg+xml") {
                        $new_file_type == ".svg";
                    }
                    $file_name = "resources//user_img//" . uniqid() .$new_file_type;
                    move_uploaded_file($img["tmp_name"], $file_name);
    
                    Database::iud("INSERT INTO `feed_img` (`path`,`feedback_id`) VALUES ('" . $file_name . "','" . $fee_id . "')");
                } else {
                    echo ("Fill type does not allowed to uplord");
                }
            }
            echo ("OK");
        } catch (\Throwable $th) {
           echo("An Error occurs, try Again");
        }
    }
}
