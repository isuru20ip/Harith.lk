<?php

session_start();
require "conection.php";

if (isset($_SESSION["user"])) {

    if ($_GET["id"]) {

        $email = $_SESSION["user"]["email"];
        $pid = $_GET["id"];

        $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email` = '" . $email . "'  ");
        $watchlist_num = $watchlist_rs->num_rows;

        if ($watchlist_num >= 1) {

            Database::iud("DELETE FROM `watchlist` WHERE `product_id` = '" . $pid . "' AND `user_email` = '" . $email . "'   ");
            echo ("1");
        }
    }
}
