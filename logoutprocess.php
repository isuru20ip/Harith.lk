<?php

session_start();

 

if (isset($_SESSION["admin"])) {
    $_SESSION["admin"] = NULL;
    session_destroy();

    echo("done");

}elseif(isset($_SESSION["user"])) {
    $_SESSION["user"] = NULL;
    session_destroy();

    echo("done");
}
?>
