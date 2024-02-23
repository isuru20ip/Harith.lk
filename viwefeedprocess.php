<?php 
session_start();
require "conection.php";

if (isset($_GET["id"])) {
    $fid = $_GET["id"];

    Database::search("UPDATE `feedback` SET `status` = '1' WHERE `id` = '".$fid."'");

    echo("1");
}

?>