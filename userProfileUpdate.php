<?php

session_start();
require "conection.php";

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

<body style="background-color: #E9EbEE;">
    <div class=" container-fluid">
        <div class=" row">
            <?php include "header.php"; ?>

            <?php
            if (isset($_SESSION["user"])) {
                $email = $_SESSION["user"]["email"]
            ?>

                <div class=" col-12 p-4 mb-2">
                    <div class=" row">
                        <!---->

                        <div class=" col-12 mt-3">
                            <div class=" row">

                                <div class=" col-12 text-center">

                                    <?php

                                    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`= '" . $email . "';");
                                    $user_data = $user_rs->fetch_assoc();
                                    $e = $user_data["email"];

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
                                        <img src="<?php echo $img_data["path"]; ?>" class=" img-thumbnail " style="height: 200px;width: 200px;" for="umg" id="i">
                                        <input type="file" id="uimg" hidden>
                                    <?php
                                    } else {
                                    ?>
                                        <img src="resources/user_img/d_pic.svg" class=" img-thumbnail " style="height: 160px;width: 160px;" for="umg"  id="i">
                                        <input type="file" id="uimg" hidden>
                                    <?php
                                    }

                                    ?>

                                </div>

                                <hr class=" my-2 border-2 border-black" />

                                <div class=" col-12 mt-2 p-4">
                                    <div class=" row">

                                        <div class=" col-12 col-lg-6 6 p-4 card">
                                            <div class=" row">

                                                <div class=" col-12">
                                                    <label class=" form-label fw-bold fs-5 "> User Information </label>
                                                    <hr class=" mb-0 mt-0" />
                                                </div>

                                                <div class=" col-12 col-lg-6 p-3 mt-1 ">
                                                    <label class=" col-12 form-label">First name</label>
                                                    <input id="fname" type="text" class=" form-control" value="<?php echo $user_data["fname"]; ?>"></input>
                                                    
                                                </div>

                                                <div class=" col-12 col-lg-6 p-3 mt-1 ">
                                                    <label class=" col-12 form-label">Last name</label>
                                                    <input id="lname" type="text" class=" form-control " value="<?php echo $user_data["lname"]; ?>"></input>
                                                </div>


                                                <div class=" col-12 col-lg-6 p-3 mt-1 ">
                                                    <label class=" col-12 form-label">Email</label>
                                                    <input id="email" type="email" class=" form-control " value="<?php echo $user_data["email"]; ?>" disabled></input>
                                                </div>


                                                <div class=" col-12 col-lg-6 p-3 mt-1 ">
                                                    <label class=" col-12 form-label">Phone</label>
                                                    <input id="phone" type="text" class=" form-control " value="<?php echo $user_data["contact_no"]; ?>"></input>
                                                </div>

                                                <div class=" input-group col-12 p-3 mt-1 mb-1 ">
                                                    <label class=" col-12 form-label">Password</label>
                                                    <input type="password" id="password" class="form-control rounded-2" value="<?php echo $user_data["password"]  ?>" disabled />&nbsp;
                                                    <span class="input-group-text btn border " id="eye" onclick="viweps();"><i class="bi bi-eye-slash-fill"></i></span>
                                                </div>

                                                <div class="col-12 col-lg-6">
                                                    <label class=" col-12 form-label btn btn-warning" for="uimg" onclick="changeProfilemage();">Add Profile Picture</label>
                                                </div>

                                                <div class="col-12 col-lg-6">
                                                    <a class=" col-12 form-label btn btn-secondary" href="passwordReset.php" >Update Password</a>
                                                </div>

                                            </div>
                                        </div>

                                        <div class=" col-12 col-lg-6 p-4 card ">
                                            <div class=" row">

                                                <div class=" col-12">
                                                    <label class=" form-label fw-bold fs-5 "> Shipping Information </label>
                                                    <hr class=" mb-0 mt-0" />
                                                </div>

                                                <?php


                                                if (!empty($address_data["line_1"])) {
                                                ?>
                                                    <div class=" col-12 col-lg-6 p-3 mt-1 ">
                                                        <label class=" col-12 form-label">Address Line-01</label>
                                                        <input id="line1" type="text" class=" form-control " value="<?php echo $address_data["line_1"] ?>"></input>
                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class=" col-12 col-lg-6 p-3 mt-1 ">
                                                        <label class=" col-12 form-label">Address Line-01</label>
                                                        <input id="line1" type="text" class=" form-control "></input>
                                                    </div>
                                                <?php

                                                }

                                                if (!empty($address_data["line_2"])) {
                                                ?>
                                                    <div class=" col-12 col-lg-6 p-3 mt-1 ">
                                                        <label class=" col-12 form-label">Address Line-01</label>
                                                        <input id="line2" type="text" class=" form-control " value="<?php echo $address_data["line_2"] ?>"></input>
                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class=" col-12 col-lg-6 p-3 mt-1 ">
                                                        <label class=" col-12 form-label">Address Line-01</label>
                                                        <input id="line2" type="text" class=" form-control "></input>
                                                    </div>
                                                <?php

                                                }

                                                $province_rs = Database::search("SELECT * FROM `province`");
                                                $district_rs = Database::search("SELECT * FROM `district`");
                                                $city_rs = Database::search("SELECT * FROM `city`");

                                                $province_num = $province_rs->num_rows;
                                                $district_num = $district_rs->num_rows;
                                                $city_num = $city_rs->num_rows;

                                                ?>

                                                <div class=" col-12 col-lg-6 col-lg-6 p-3 mt-1 ">
                                                    <label class=" col-12 form-label">Province</label>
                                                    <select class=" form-select" id="province" onchange="loaddistric();">
                                                        <option value="<?php  ?>">Select</option>

                                                        <?php
                                                        for ($p = 0; $p < $province_num; $p++) {
                                                            $province_data = $province_rs->fetch_assoc();

                                                        ?>
                                                            <option value="<?php echo $province_data["province_id"]; ?>" <?php

                                                                                                                            if (!empty($address_data["province_id"])) {

                                                                                                                                if ($province_data["province_id"] == $address_data["province_id"]) {

                                                                                                                            ?> selected <?php
                                                                                                                                    }
                                                                                                                                }   ?>>


                                                                <?php echo $province_data["province_name"]; ?>

                                                            </option>
                                                        <?php
                                                        }
                                                        ?>

                                                    </select>
                                                </div>


                                                <div class=" col-12 col-lg-6 col-lg-6 p-3 mt-1 ">
                                                    <label class=" col-12 form-label">District</label>
                                                    <select class=" form-select" id="district" onclick="loadcity();">
                                                        <option value="<?php  ?>">Select</option>

                                                        <?php
                                                        for ($d = 0; $d < $district_num; $d++) {
                                                            $district_data = $district_rs->fetch_assoc();

                                                        ?>
                                                            <option value="<?php echo $district_data["district_id"]; ?>" <?php

                                                                                                                            if (!empty($address_data["district_id"])) {

                                                                                                                                if ($district_data["district_id"] == $address_data["district_id"]) {

                                                                                                                            ?> selected <?php
                                                                                                                                    }
                                                                                                                                }   ?>>


                                                                <?php echo $district_data["district_name"]; ?>

                                                            </option>
                                                        <?php
                                                        }
                                                        ?>

                                                    </select>
                                                </div>

                                                <div class=" col-12 col-lg-6 col-lg-6 p-3 mt-1 ">
                                                    <label class=" col-12 form-label">City</label>
                                                    <select class=" form-select" id="city" >
                                                        <option value="<?php  ?>">Select</option>

                                                        <?php
                                                        for ($c = 0; $c < $city_num; $c++) {
                                                            $city_data = $city_rs->fetch_assoc();

                                                        ?>
                                                            <option value="<?php echo $city_data["city_id"]; ?>" <?php

                                                                                                                    if (!empty($address_data["city_id"])) {

                                                                                                                        if ($city_data["city_id"] == $address_data["city_id"]) {

                                                                                                                    ?> selected <?php
                                                                                                                                    }
                                                                                                                                }   ?>>


                                                                <?php echo $city_data["city_name"]; ?>

                                                            </option>
                                                        <?php
                                                        }
                                                        ?>

                                                    </select>
                                                </div>

                                                <?php

                                                if (!empty($address_data["postal_code"])) {
                                                ?>
                                                    <div class=" col-12 col-lg-6 p-3 mt-1 ">
                                                        <label class=" col-12 form-label">Postal Code</label>
                                                        <input id="pcode" type="text" class=" form-control " value="<?php echo $address_data["postal_code"]; ?>" ></input>
                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class=" col-12 col-lg-6 p-3 mt-1 ">
                                                        <label class=" col-12 form-label">Postal Code</label>
                                                        <input id="pcode" type="text" class=" form-control "></input>
                                                    </div>
                                                <?php
                                                }

                                                ?>

                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>



                            <button type="button" class=" col-12 btn btn-info mt-3 fw-bold" onclick="updateprofile();">Upadate Profile</button>

                        </div>
                        <!---->
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