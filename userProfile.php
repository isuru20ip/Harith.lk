<?php

session_start();
require "conection.php";

$subtal = 0;
$shipping = 0;
$gtotal = 0;
$pageno;
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>UserProfile | Haritha.lk | Enriching Age</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" href="resources/favicon.svg">
</head>

<body>
    <div class=" container-fluid">
        <div class=" row">
            <?php include "header.php"; ?>

            <?php
            if (isset($_SESSION["user"])) {
                $email = $_SESSION["user"]["email"];

            ?>

                <div class=" col-12 col-lg-6 p-md-4">
                    <div class=" row">
                        <!---->

                        <div class=" col-12 mt-3 p-3">
                            <div class=" row">

                                <div class=" col-12 text-center">

                                    <?php

                                    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`= '" . $email . "';");
                                    $user_data = $user_rs->fetch_assoc();

                                    $address_rs = Database::search("SELECT * FROM `address` 
                                        INNER JOIN city ON city.city_id = address.city_id 
                                        INNER JOIN district ON district.district_id = city.district_id
                                        INNER JOIN province ON province.province_id = district.province_id
                                        WHERE `user_email` = '$email'");
                                    $address_data = $address_rs->fetch_assoc();

                                    $img_rs = Database::search("SELECT * FROM `user_img` WHERE `user_email` = '" . $email . "'");
                                    $img_data = $img_rs->fetch_assoc();


                                    if (!empty($img_data["path"])) {
                                    ?>
                                        <img src="<?php echo $img_data["path"]; ?>" class=" img-thumbnail " style="height: 160px;width: 160px;" />
                                    <?php
                                    } else {
                                    ?>
                                        <img src="resources/user_img/d_pic.svg" class=" img-thumbnail " style="height: 160px;width: 160px;" />
                                    <?php
                                    }

                                    ?>

                                    <h2 class=" text-uppercase mt-3"> <?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></h2>
                                </div>
                            </div>

                            <div class=" col-12 mt-2 border rounded-2">
                                <div class=" row">


                                    <div class=" col-12 col-lg-6 p-3 mt-1 ">
                                        <label class=" col-12 form-label">Email</label>
                                        <input type="text" class=" form-control " value="<?php echo $user_data["email"]; ?>" disabled></input>
                                    </div>


                                    <div class=" col-12 col-lg-6 p-3 mt-1 ">
                                        <label class=" col-12 form-label">Phone</label>
                                        <input type="text" class=" form-control " value="<?php echo $user_data["contact_no"]; ?>" disabled></input>
                                    </div>

                                    <div class=" input-group col-12 p-3 mt-1 ">
                                        <label class=" col-12 form-label">Password</label>
                                        <input type="password" id="password" class="form-control rounded-2" value="<?php echo $user_data["password"]  ?>" disabled />&nbsp;
                                        <span class="input-group-text btn border " id="eye" onclick="viweps();"><i class="bi bi-eye-slash-fill"></i></span>
                                    </div>

                                    <?php

                                    $address_rs = Database::search("SELECT * FROM `address` INNER JOIN city ON city.city_id = address.city_id WHERE `user_email` = '" . $email . "'");
                                    $address_data = $address_rs->fetch_assoc();

                                    if (!empty($address_data["line_1"]) && !empty($address_data["line_2"])) {
                                    ?>
                                        <div class=" col-12 p-3 mt-1 ">
                                            <label class=" col-12 form-label">Address</label>
                                            <input type="text" class=" form-control " value="<?php echo $address_data["line_1"] . "," . $address_data["line_2"]; ?>" disabled></input>
                                        </div>
                                    <?php
                                    } elseif (!empty($address_data["line_1"]) && empty($address_data["line_2"])) {
                                    ?>
                                        <div class=" col-12 p-3 mt-1 ">
                                            <label class=" col-12 form-label">Address</label>
                                            <input type="text" class=" form-control " value="<?php echo $address_data["line_1"] . ", Add Line 02"; ?>" disabled></input>
                                        </div>
                                    <?php
                                    } elseif (empty($address_data["line_1"]) && !empty($address_data["line_2"])) {
                                    ?>
                                        <div class=" col-12 p-3 mt-1 ">
                                            <label class=" col-12 form-label">Address</label>
                                            <input type="text" class=" form-control " value="<?php echo "Add Line 01, " . $address_data["line_1"]; ?>" disabled></input>
                                        </div>
                                    <?php
                                    } elseif (empty($address_data["line_1"]) && empty($address_data["line_2"])) {
                                    ?>
                                        <div class=" col-12 p-3 mt-1 ">
                                            <label class=" col-12 form-label">Address</label>
                                            <input type="text" class=" form-control " value="Update Your Shipping Information" disabled></input>
                                        </div>
                                    <?php
                                    }

                                    if (!empty($address_data["city_name"])) {
                                    ?>
                                        <div class=" col-12 col-lg-6 p-3 mt-1 ">
                                            <label class=" col-12 form-label">City</label>
                                            <input type="text" class=" form-control " value="<?php echo $address_data["city_name"]; ?>" disabled></input>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class=" col-12 col-lg-6 p-3 mt-1 ">
                                            <label class=" col-12 form-label">City</label>
                                            <input type="text" class=" form-control " value="Update Your Shipping Information" disabled></input>
                                        </div>
                                    <?php
                                    }

                                    if (!empty($address_data["postal_code"])) {
                                    ?>
                                        <div class=" col-12 col-lg-6 p-3 mt-1 ">
                                            <label class=" col-12 form-label">Postal Code</label>
                                            <input type="text" class=" form-control " value="<?php echo $address_data["postal_code"]; ?>" disabled></input>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class=" col-12 col-lg-6 p-3 mt-1 ">
                                            <label class=" col-12 form-label">Postal Code</label>
                                            <input type="text" class=" form-control " value="Update Your Shipping Information" disabled></input>
                                        </div>
                                    <?php
                                    }



                                    ?>



                                </div>
                            </div>

                            <a href="userProfileUpdate.php" class=" col-12 btn btn-success mt-3 text-decoration-none">Upadate Profile</a>

                        </div>
                        <!---->
                    </div>
                </div>
                <!------------------------------------------------------------------------------------------->
                <div class=" col-12 col-lg-6 border">
                    <div class=" row">
                        <!---->

                        <div class=" form-label">
                            <h2 class=" col-12 text-center"> Punched History</h2>
                        </div>

                        <!--table-md-->
                        <div class=" col-12 mt-3 table-responsive">
                            <table class="table border ">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Qty</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>

                                <?php

                                if (isset($_GET["page"])) {
                                    $pageno = $_GET["page"];
                                    //  $limit = $limit + 1;
                                } else {
                                    $pageno = 1;
                                }

                                $hisory_rs = Database::search("SELECT DISTINCT `order_id` FROM `invoice` WHERE `user_email` = '" . $email . "' ");
                                $hisory_num = $hisory_rs->num_rows;

                                $results_per_page = 10;
                                $number_of_pages = ceil($hisory_num / $results_per_page);

                                $page_rs = ($pageno - 1) * $results_per_page;



                                $cart_rs = Database::search("SELECT `order_id`, `date`, `status`, COUNT(`product_id`) AS `item_count`
                                FROM `invoice`
                                WHERE `user_email` = '" . $email . "' GROUP BY `order_id`, `user_email`, `date`,`status` ORDER BY `date` DESC LIMIT " . $results_per_page . " OFFSET " . $page_rs . " ");



                                $cart_num = $cart_rs->num_rows;


                                for ($i = 0; $i < $cart_num; $i++) {
                                    $cart_data = $cart_rs->fetch_assoc();

                                ?>
                                    <tbody>
                                        <tr>
                                            <th><?php echo $cart_data["order_id"] ?></th>
                                            <td><?php echo date('Y-m-d', strtotime($cart_data["date"]))  ?></td>
                                            <td><?php echo $cart_data["item_count"] ?></td>
                                            <td>
                                                <span class=" text-center text-bg-info p-1 rounded"> <a href="p_history.php?id=<?php echo $cart_data["order_id"] ?>" style="text-decoration: none; color:black;">viwe</a></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                <?php
                                }

                                ?>



                            </table>
                        </div>

                        <div class=" d-flex justify-content-center">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="
                                    <?php
                                    if ($pageno <= 1) {
                                        echo ("#");
                                    } else {
                                        echo "?page=" . ($pageno - 1);
                                    }
                                    ?>
                                    " aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>

                                <li class="page-item"><a class="page-link" href="#"><?php echo $pageno ?> of <?php echo $number_of_pages ?></a></li>


                               

                                <li class="page-item">
                                    <a class="page-link" href="
                                    <?php
                                    if ($pageno >= $number_of_pages) {
                                        echo ("#");
                                    } else {
                                        echo "?page=" . ($pageno + 1);
                                    }
                                    ?>
                                    " aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>

                        </div>
                        <!--table-->

                    </div>
                </div>

            <?php
            } else {
            ?>
                <div class=" col-12 text-center p-5 m-5">

                    <a class=" btn btn-success col-3 text-decoration-none" href="Log_in.php">
                        <h1 class=" text-warning"> Login or Register</h1>
                    </a>
                </div>
            <?php
            }

            ?>

            <?php include "footer.php"; ?>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>