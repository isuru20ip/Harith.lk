<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
</head>

<body>

    <div class=" col-12 bg-success">
        <div class=" row mt-1 mb-1">


            <div class=" col-12 col-lg-4  text-sm-center text-lg-start align-self-start my-lg-3">

                <?php

                if (isset($_SESSION["user"])) {

                ?>

                    <span class=" fw-bold text-white ms-lg-5"> Hi, <?php echo $_SESSION["user"]["fname"] ?> </span>
                    <span class=" text-warning" onclick="logout();" style="cursor: pointer;"> | Log Out</span>


                <?php

                } else {

                ?>
                    <h5 class="ms-5 "> <a href="index.php" class=" text-white text-decoration-none fw-bold">Home</a> </h5>
                <?php

                }
                ?>
            </div>

            <div class=" col-12 col-lg-4 align-self-center text-center text-white fs-2 fw-bold">
                <span> Haritha.lk</span>
            </div>


            <div class=" col-12 col-lg-4 align-self-end my-3 text-center">


                <span class="ms-3 "> <a href="index.php" class=" text-white text-decoration-none fw-bold">Home</a> </span>

                <?php
                if (isset($_SESSION["user"])) {
                ?>
                    <span class="ms-3 "> <a href="index.php" class=" text-white text-decoration-none fw-bold">Home</a> </span>
                    <span class="ms-3 "> <a href="wishlist.php" class=" text-white text-decoration-none fw-bold">Wishlist</a> </span>
                    <span class="ms-3 "> <a href="userProfile.php" class=" text-white text-decoration-none fw-bold">Account</a> </span>
                    <span class=" ms-3" onclick="window.location = 'cart.php'  "> <img src="resources/cartico.svg" style="height: 25px; cursor: pointer;"></span>
                <?php
                } else {
                ?>

                    <h5 class="ms-3 "> <a href="Log_in.php" class=" text-white text-decoration-none fw-bold">LogIn</a> </h5>

                <?php
                } ?>




            </div>




        </div>

    </div>


    <script src="script.js"></script>
</body>

</html>