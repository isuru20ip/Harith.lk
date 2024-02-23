<?php
require "conection.php";

if (isset($_GET["oid"])) {

    $oid = $_GET["oid"];
    $ss = $_GET["st"];

    $data_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id` = '" . $oid . "';");
    $data = $data_rs->fetch_assoc();

    if ($data["status"] == 0 && $ss != 3) {
        Database::search("UPDATE `invoice` SET `status` = '1' WHERE `order_id` = '" . $oid . "'");

       // $array["id"] = "0";
        $array["email"] = $data["user_email"];
        $array["title"] = "You Order have been accepted | Haritha.lk";
        $array["msg"] = "dear customer, your order has been accepted. your package will be sent to the delivery process within 24 hours.";

        echo json_encode($array);

    } elseif ($data["status"] == 1 && $ss != 3) {
        Database::search("UPDATE `invoice` SET `status` = '2' WHERE `order_id` = '" . $oid . "'");

       // $array["id"] = "1";
        $array["email"] = $data["user_email"];
        $array["title"] = "You Order have been accepted | Haritha.lk";
        $array["msg"] = "your packages were sent to delivery. you will receive it within 5 working days";

        echo json_encode($array);

    } elseif ($data["status"] == 0 && $ss == 3) {

        Database::search("UPDATE `invoice` SET `status` = '3' WHERE `order_id` = '" . $oid . "'");

     //   $array["id"] = "3";
        $array["email"] = $data["user_email"];
        $array["title"] = "You Order have been accepted | Haritha.lk";
        $array["msg"] = "dear customer, we are informing you we cannot complete your order at this time and your money will be refunded. <br /> for more details : 0723436337";

        echo json_encode($array);
        
    }

} else {
    echo ("process incomplete");
}


