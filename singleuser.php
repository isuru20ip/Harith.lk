<?php
session_start();
require "conection.php";

if (isset($_SESSION['admin'])) {
?>
    <!DOCTYPE html>
    <html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>UserProfile | AYUNA.lk | Enriching Age</title>

        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="icon" href="resources/favicon.svg">
    </head>

    <body style="background-color: #E9EbEE;">

        <div class=" container-fluid">
            <div class=" row">

                <?php
                if (isset($_GET["e"])) {
                    $email = $_GET["e"];

                    require "cpanal_head.php";
                ?>

                    <div class=" col-10 mt-5 mb-0 ms-lg-3">
                        <div class="row">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="control_panel.php">Control Panel</a></li>
                                    <li class="breadcrumb-item"><a href="usermanage.php">User Manage</a></li>
                                    <li class="breadcrumb-item active fw-bold" aria-current="page">User [<?php echo $email; ?>]</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <div class="col-12 col-lg-10 offset-lg-1 card mb-5 mt-2 border-black">
                        <div class=" row">

                            <div class="col-12 col-lg-4 mt-3 d-flex justify-content-center  border-end ">

                                <div class="row align-items-center">
                                    <div class="col">
                                        <?php

                                        $user_rs = Database::search("SELECT * FROM `user` WHERE `email`= '" . $email . "';");
                                        $user_data = $user_rs->fetch_assoc();
                                        $e = $user_data["email"];

                                        $address_rs = Database::search("SELECT * FROM `address` 
                                    INNER JOIN city ON city.city_id = address.city_id 
                                    INNER JOIN district ON district.district_id = city.district_id
                                    INNER JOIN province ON province.province_id = district.province_id WHERE `user_email` = '$email'");
                                        $address_data = $address_rs->fetch_assoc();

                                        $img_rs = Database::search("SELECT * FROM `user_img` WHERE `user_email` = '" . $email . "'");
                                        $img_data = $img_rs->fetch_assoc();

                                        if (!empty($img_data["path"])) {
                                        ?>
                                            <img src="<?php echo $img_data["path"]; ?>" class=" rounded-3" style="height: 300px; width: 300px;" for="umg" id="i">
                                            <input type="file" id="uimg" hidden>
                                        <?php
                                        } else {
                                        ?>
                                            <img src="resources/user_img/d_pic.svg" class="" style="height: 250px;width: 250px;" for="umg" id="i">
                                            <input type="file" id="uimg" hidden>
                                        <?php
                                        }

                                        ?>

                                    </div>
                                </div>


                            </div>

                            <div class=" col-12 col-lg-4 mt-3 border-end">
                                <div class=" row g-1">

                                    <div class=" col-12">
                                        <label class=" form-label fw-bold fs-5 "> User Information </label>
                                        <hr class=" mb-0 mt-0" />
                                    </div>

                                    <div class=" col-12">
                                        <label class=" col-12 form-label">First name</label>
                                        <input id="fname" type="text" class=" form-control " value="<?php echo $user_data["fname"]; ?>" disabled></input>
                                    </div>

                                    <div class=" col-12">
                                        <label class=" col-12 form-label">Last name</label>
                                        <input id="lname" type="text" class=" form-control " value="<?php echo $user_data["lname"]; ?>" disabled></input>
                                    </div>


                                    <div class=" col-12">
                                        <label class=" col-12 form-label">Email</label>
                                        <input id="email" type="email" class=" form-control " value="<?php echo $user_data["email"]; ?>" disabled></input>
                                    </div>

                                    <div class=" input-group col-12">
                                        <label class=" col-12 form-label">Password</label>
                                        <input type="password" id="password" class="form-control rounded-2" value="<?php echo $user_data["password"]  ?>" disabled />&nbsp;
                                        <span class="input-group-text btn border " id="eye" onclick="viweps();"><i class="bi bi-eye-slash-fill"></i></span>
                                    </div>

                                    <div class=" col-12">
                                        <label class=" col-12 form-label">Phone</label>
                                        <input id="phone" type="text" class=" form-control " value="<?php echo $user_data["contact_no"]; ?>" disabled></input>
                                    </div>

                                </div>
                            </div>

                            <div class=" col-12 col-lg-4 mt-3">
                                <div class=" row g-1">

                                    <div class=" col-12">
                                        <label class=" form-label fw-bold fs-5 "> Shipping Information </label>
                                        <hr class=" mb-0 mt-0" />
                                    </div>

                                    <?php


                                    if (!empty($address_data["line_1"])) {
                                    ?>
                                        <div class=" col-12">
                                            <label class=" col-12 form-label">Address Line-01</label>
                                            <input id="line1" type="text" class=" form-control " value="<?php echo $address_data["line_1"] ?>" disabled></input>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class=" col-12">
                                            <label class=" col-12 form-label">Address Line-01</label>
                                            <input id="line1" type="text" class=" form-control " value="Empty" disabled></input>
                                        </div>
                                    <?php

                                    }

                                    if (!empty($address_data["line_2"])) {
                                    ?>
                                        <div class=" col-12">
                                            <label class=" col-12 form-label">Address Line-02</label>
                                            <input id="line2" type="text" class=" form-control " value="<?php echo $address_data["line_2"] ?>" disabled></input>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class=" col-12">
                                            <label class=" col-12 form-label">Address Line-02</label>
                                            <input id="line2" type="text" class=" form-control " value="Empty" disabled></input>
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

                                    <div class=" col-12 col-lg-6">
                                        <label class=" col-12 form-label">Province</label>
                                        <select class=" form-select" id="province" onchange="loaddistric();" disabled>
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


                                    <div class=" col-12 col-lg-6">
                                        <label class=" col-12 form-label">District</label>
                                        <select class=" form-select" id="district" onclick="loadcity();" disabled>
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

                                    <div class=" col-12 col-lg-6">
                                        <label class=" col-12 form-label">City</label>
                                        <select class=" form-select" id="city" disabled>
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
                                        <div class=" col-12 col-lg-6">
                                            <label class=" col-12 form-label">Postal Code</label>
                                            <input id="pcode" type="text" class=" form-control " value="<?php echo $address_data["postal_code"]; ?>" disabled></input>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class=" col-12 col-lg-6">
                                            <label class=" col-12 form-label">Postal Code</label>
                                            <input id="pcode" type="text" class=" form-control " value="Empty" disabled></input>
                                        </div>
                                    <?php
                                    }

                                    ?>

                                    <div class=" col-12 mt-4">

                                        <input class=" form-control mt-2" disabled></input>
                                    </div>

                                </div>

                            </div>

                            <div class=" col-12 mt-3 mb-3">
                                <div class=" row">

                                    <hr>

                                    <div class="form-switch">
                                        <label class=" form-label fw-bold fs-5 text-start"> User Status : </label>

                                        <?php
                                        if ($user_data["status"] == 2) {
                                        ?><label class="form-check-label fw-bold text-danger fs-5"> Blocked User </label><?php
                                                                                                                        } else {
                                                                                                                            ?><label class="form-check-label fw-bold text-success fs-5"> Active User </label><?php
                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                ?>
                                        <input class="form-check-input fs-3 ms-4" type="checkbox" role="switch" id="fd<?php echo $user_data["email"]; ?>" onchange="changeUserStatus('<?php echo htmlspecialchars($user_data['email'], ENT_QUOTES); ?>');" <?php if ($user_data["status"] == 2) { ?> checked <?php } ?> />

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                <?php
                } else {
                    echo ("gg");
                }
                ?>
            </div>
        </div>
        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

    </html>
<?php
}
?>