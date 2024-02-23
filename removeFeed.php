<?php
require "conection.php";
session_start();

if (isset($_SESSION["admin"])) {
    $inid = $_GET["id"];

    $imgCeck = Database::search("SELECT * FROM `feed_img` WHERE `feedback_id`='" . $inid . "'");
    $imgnum = $imgCeck->num_rows;
    if ($imgnum >= 1) {
        Database::iud("DELETE FROM `feed_img` WHERE `feedback_id`='" . $inid . "'");
    }


    Database::iud("DELETE FROM `feedback` WHERE `id` = '" . $inid . "'");

    echo ("Done");
}
