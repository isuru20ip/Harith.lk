<?php

include "conection.php";

if (isset($_GET["d"])) {

    $id = $_GET["d"];Database::iud("UPDATE `invoice` SET `status` = '5' WHERE `order_id` = '" . $id . "'");
    
    echo ("Done");
}
