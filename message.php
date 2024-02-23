<?php
session_start();
require "conection.php";
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home | AYUNA.lk | Enriching Age</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" href="resources/favicon.svg">
</head>

<body>


    <div class=" container-fluid">
        <div class=" row">
            <?php require "cpanal_head.php"; ?>

            <div class=" col-12">
                <div class=" row">

                <div class=" col-12 text-center mt-3">
                    <label class=" form-label fw-bold fs-3">Chat Box</label>
                </div>

                <div class=" col-12 border border-2 rounded-3">

                </div>

                </div>

            </div>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>