<?php
session_start();
require "conection.php";

if (isset($_SESSION["admin"])) {
    $email = $_POST["email"];

    $st_rs = Database::search("SELECT * FROM `user` WHERE `email` ='" . $email . "'");
    $st_data = $st_rs->fetch_assoc();

    if ($st_data["status"] == 1) {
        Database::search("UPDATE `user` SET `status` = '2' WHERE `email` = '" . $email . "'");
    } elseif ($st_data["status"] == 2) {
        Database::search("UPDATE `user` SET `status` = '1' WHERE `email` = '" . $email . "'");
    }

    echo("OK");
}
