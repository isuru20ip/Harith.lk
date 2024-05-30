<?php
session_start();
require "conection.php";

if (isset($_SESSION["admin"])) {

?>
    <!DOCTYPE html>
    <html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Contral Panal | AYUNA.lk | Enriching Age</title>

        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="icon" href="resources/favicon.svg">

    </head>

    <body class="bg-dark">

        <div class=" container-fluid ">
            <div class="row">
                <?php //require "cpanal_head.php";
                ?>

                <!--main-->


                <div class=" col-12 p-3">
                    <div class=" row">

                        <div class=" col-12 col-lg-2 py-5">
                            <div class=" row g-3 mx-auto">

                                <div class=" col-12">
                                    <button class=" col-12 btn btn-dark p-3 border border-danger fw-bold" onclick="window.location ='myproduct.php'">My Product</button>
                                </div>

                                <div class=" col-12">
                                    <button class=" col-12 btn btn-dark p-3 border border-danger fw-bold" onclick="window.location ='add_product.php'">Add Product</button>
                                </div>

                                <div class=" col-12">
                                    <button class=" col-12 btn btn-dark p-3 border border-danger fw-bold" onclick="window.location ='feedbackviwe.php'">Feedback</button>
                                </div>

                                <div class=" col-12">
                                    <button class=" col-12 btn btn-dark p-3 border border-danger fw-bold" onclick="window.location ='usermanage.php'">User Manage</button>
                                </div>

                                <div class=" col-12">
                                    <button class=" col-12 btn btn-dark p-3 border border-danger fw-bold" onclick="window.location ='index.php'">Home</button>
                                </div>

                                <div class=" col-12">
                                    <button class=" col-12 btn btn-dark p-3 border border-danger fw-bold" onclick="alogout();">Logout</button>
                                </div>


                            </div>
                        </div>

                        <div class="col-12 col-lg-10 mt-5">
                            <div class="row">

                                <div class="text-white fw-bold mb-1 mt-3">
                                    <h2 class="fw-bold">Orders</h2>
                                </div>

                                <br />

                                <div class="col-12">
                                    <div class="row g-1">

                                        <?php
                                        $pending_c;
                                        $accepted_c;
                                        $delivered_c;
                                        $canceled_c;

                                        for ($i = 0; $i <= 3; $i++) {

                                            $order = Database::search("SELECT COUNT(*) FROM (SELECT DISTINCT `order_id` FROM `invoice` WHERE `status` = '" . $i . "') AS result ");

                                            switch ($i) {
                                                case '0':
                                                    $pending_c = $order->fetch_assoc();
                                                    break;
                                                case '1':
                                                    $accepted_c = $order->fetch_assoc();
                                                    break;
                                                case '2':
                                                    $delivered_c = $order->fetch_assoc();
                                                    break;
                                                case '3':
                                                    $canceled_c = $order->fetch_assoc();
                                                    break;
                                                default:
                                                    # code...
                                                    break;
                                            }
                                        }
                                        ?>

                                        <div class="col-6 col-lg-3 px-1">
                                            <div class="row g-1 ">
                                                <div class="col-12 bg-primary text-white text-center rounded" style="height: 100px;">
                                                    <br />
                                                    <?php
                                                    //  $pending_rs = Database::search("SELECT COUNT(*) FROM (SELECT DISTINCT `order_id` FROM `invoice` WHERE `status` = '0') AS result ");
                                                    //  $pending_c = $pending_rs->fetch_assoc();
                                                    ?>
                                                    <span class="fs-4 fw-bold"><a href="order.view.php?st=0" class=" text-white text-decoration-none"><?php echo $pending_c["COUNT(*)"] ?> Orders Pending </a></span>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="col-6 col-lg-3 px-1">
                                            <div class="row g-1">
                                                <div class="col-12 bg-success text-white text-center rounded" style="height: 100px;">
                                                    <br />
                                                    <?php
                                                    //  $accepted_rs = Database::search("SELECT COUNT(*) FROM (SELECT DISTINCT `order_id` FROM `invoice` WHERE `status` = '1') AS result ");
                                                    //  $accepted_c = $accepted_rs->fetch_assoc()
                                                    ?>
                                                    <span class="fs-4 fw-bold"><a href="order.view.php?st=1" class=" text-white text-decoration-none"><?php echo $accepted_c["COUNT(*)"] ?> Orders Accepted </a></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6 col-lg-3 px-1">
                                            <div class="row g-1">
                                                <div class="col-12 bg-secondary text-white text-center rounded" style="height: 100px;">
                                                    <br />
                                                    <?php
                                                    //  $delivered_rs = Database::search("SELECT COUNT(*) FROM (SELECT DISTINCT `order_id` FROM `invoice` WHERE `status` = '2') AS result ");
                                                    //  $delivered_c = $delivered_rs->fetch_assoc()
                                                    ?>
                                                    <span class="fs-4 fw-bold"><a href="order.view.php?st=2" class=" text-white text-decoration-none"><?php echo $delivered_c["COUNT(*)"] ?> Orders Delivered </a></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6 col-lg-3 px-1 shadow">
                                            <div class="row g-1">
                                                <div class="col-12 bg-danger text-white text-center rounded" style="height: 100px;">
                                                    <br />
                                                    <?php
                                                    //  $canceled_rs = Database::search("SELECT COUNT(*) FROM (SELECT DISTINCT `order_id` FROM `invoice` WHERE `status` = '3' ) AS result ");
                                                    //  $canceled_c = $canceled_rs->fetch_assoc()
                                                    ?>
                                                    <span class="fs-4 fw-bold"><a href="order.view.php?st=3" class=" text-white text-decoration-none"><?php echo $canceled_c["COUNT(*)"] ?> Orders Cancelled </a></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class=" col-12 my-3">

                                </div>

                                <!-- money -->
                                <div class="text-white fw-bold mb-1 mt-2">
                                    <h2 class="fw-bold">Transaction Status</h2>
                                </div>

                                <?php

                                $today = date("Y-m-d");
                                $thisMonth = date("m");
                                $thisyear = date("Y");
                                $last_month = date('m', strtotime("-1 month"));

                                $todayIncome = 0;
                                $todaySells = 0;

                                $monthlyIncome = 0;
                                $monthlySells = 0;

                                $lastMonthIncome = 0;
                                $lastMonthSells = 0;

                                $lostSellsThis = 0;
                                $lostIncomeThis = 0;

                                $lostSellsLast = 0;
                                $lostIncomeLast = 0;



                                $invoice = Database::search("SELECT * FROM `invoice`");
                                $invoice_num = $invoice->num_rows;
                                for ($i = 0; $i < $invoice_num; $i++) {
                                    $invoice_data = $invoice->fetch_assoc();

                                    $d = $invoice_data["date"];

                                    $splitToday = explode(" ", $d); //separate the date from time
                                    $intoday = $splitToday["0"]; //sold date

                                    $spliDate = explode("-", $d);
                                    $inMonth = $spliDate[1];

                                    if ($today == $intoday) {
                                        if ($invoice_data["status"] == 2) {
                                            $todayIncome = (($todayIncome) + ($invoice_data["total"]));
                                            $todaySells = (($todaySells) + ($invoice_data["iqty"]));
                                        }
                                    }
                                    if ($thisMonth == $inMonth) {
                                        if ($invoice_data["status"] == 2) {
                                            $monthlyIncome = (($monthlyIncome) + ($invoice_data["total"]));
                                            $monthlySells = (($monthlySells) + ($invoice_data["iqty"]));
                                        }

                                        if ($invoice_data["status"] == 3) {
                                            $lostIncomeThis = (($lostIncomeThis) + ($invoice_data["total"]));
                                            $lostSellsThis = (($lostSellsThis) + ($invoice_data["iqty"]));
                                        }
                                    }
                                    if ($last_month == $inMonth) {
                                        if ($invoice_data["status"] == 2) {
                                            $lastMonthIncome = (($lastMonthIncome) + ($invoice_data["total"]));
                                            $lastMonthSells = (($lastMonthSells) + ($invoice_data["iqty"]));
                                        }


                                        if ($invoice_data["status"] == 3) {
                                            $lostIncomeLast = (($lostIncomeLast) + ($invoice_data["total"]));
                                            $lostSellsLast = (($lostSellsLast) + ($invoice_data["iqty"]));
                                        }
                                    }
                                }
                                ?>

                                <!-- selles -->
                                <div class=" col-12">
                                    <div class="row">

                                        <table class="table table-bordered bg-primary border-white fs-4 fw-bold">
                                            <thead>
                                                <tr class=" bg-primary">
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Income and loss</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class=" bg-info">
                                                    <th scope="row">Today Selles</th>
                                                    <td><?php echo $todaySells  ?></td>
                                                    <td>Rs : <?php echo (number_format($todayIncome)); ?></td>
                                                </tr>
                                                <tr class=" bg-info">
                                                    <th scope="row">This Month Selles</th>
                                                    <td><?php echo $monthlySells ?></td>
                                                    <td>Rs : <?php echo (number_format($monthlyIncome)); ?></td>

                                                </tr>
                                                <tr class=" bg-info">
                                                    <th scope="row">Last Month Selles</th>
                                                    <td><?php echo $lastMonthSells ?></td>
                                                    <td>Rs : <?php echo (number_format($lastMonthIncome)) ?></td>
                                                </tr>

                                                <tr class=" bg-danger-subtle">
                                                    <th scope="row">Rejected Orders This Month</th>
                                                    <td><?php echo $lostSellsThis ?></td>
                                                    <td>(Rs: <?php echo (number_format($lostIncomeThis)) ?>)</td>
                                                </tr>

                                                <tr class=" bg-danger-subtle">
                                                    <th scope="row">Rejected Orders Last Month</th>
                                                    <td><?php echo $lostSellsLast ?></td>
                                                    <td>(Rs: <?php echo (number_format($lostIncomeLast)) ?>)</td>
                                                </tr>

                                                <tr class="border-white">
                                                    <th scope="row" colspan="3" class=" bg-black text-danger text-center">*Note : All sales are generated according to delivered orders.</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                                <!-- top-items -->
                                <div class="col-12">
                                    <div class="row ">

                                        <div class="text-white fw-bold mt-2 mb-3">
                                            <h2 class="fw-bold">Top Items</h2>
                                        </div>

                                        <div class="col-12 d-flex">
                                            <div class="row">

                                                <?php
                                                $top_user_mail = Database::search("SELECT `user_email`, SUM(`total`) AS `total` FROM `invoice` GROUP BY `user_email` ORDER BY `total` DESC ");
                                                $top_user_mail_data = $top_user_mail->fetch_assoc();
                                                $select_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $top_user_mail_data["user_email"] . "' ");
                                                $user_data = $select_rs->fetch_assoc();
                                                ?>

                                                <!-- card -->

                                                <div class=" col-12 col-lg-6 mb-2 border border-1 bg-body-tertiary rounded mx-1" style="width: 18rem;">

                                                    <?php
                                                    $img_rs = Database::search("SELECT * FROM `user_img` WHERE `user_email` = '" . $user_data["email"] . "'");
                                                    $img_num = $img_rs->num_rows;
                                                    $img_data = $img_rs->fetch_assoc();

                                                    if ($img_num == 1) {
                                                    ?>
                                                        <img src="<?php echo $img_data["path"]; ?>" class="card-img-top img-thumbnail mt-2 border-0" style="height: 300px;" />
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <img src="resources/user.svg" class="card-img-top img-thumbnail mt-2 border-0" style="height: 300px;" />
                                                    <?php
                                                    }
                                                    ?>
                                                    <div class="card-body p-3">

                                                        <div class="col-12 text-center mt-3 text-bg-info">
                                                            <span class=" fw-bold text-dark p-1 "><?php echo $user_data["email"]; ?></span>
                                                        </div>

                                                        <div class=" col-12 text-start ms-4 mt-1">
                                                            <span class=" fw-bold text-dark p-1">Phone- <?php echo $user_data["contact_no"]; ?></span>
                                                        </div>

                                                        <div class=" col-12 text-start ms-4 mt-1">
                                                            <span class=" fw-bold text-dark p-1 ">Join Date- <?php echo $user_data["join_date"]; ?></span>
                                                        </div>

                                                        <div class=" col-12 text-center mt-1">

                                                            <?php
                                                            if ($user_data["status"] == 2) {
                                                            ?>
                                                                <span class=" fw-bold text-decoration-none text-danger fs-6 p-1 ">Blocked</span>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <span class=" fw-bold text-decoration-none text-success fs-6 p-1 ">Active</span>
                                                            <?php
                                                            }
                                                            ?>

                                                        </div>
                                                        <div class=" col-12 text-center mt-3">
                                                            <a href="singleuser.php?e=<?php echo urlencode($user_data['email']); ?>" class=" col-12 btn btn-outline-warning border-3 fw-bold text-black">View</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php
                                                $product_rs = Database::search("SELECT `product_id`, SUM(`iqty`) AS `qty` FROM `invoice` GROUP BY `product_id` ORDER BY `qty` DESC");
                                                $top_rs = $product_rs->fetch_assoc();
                                                $select_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $top_rs['product_id'] . "'");
                                                $product_data = $select_rs->fetch_assoc();
                                                ?>

                                                <!-- card -->
                                                <div class="col-12 col-lg-6 mb-2 border border-1 bg-body-tertiary rounded " style="width: 18rem;">

                                                    <?php
                                                    $img_rs = Database::search("SELECT * FROM `p_img` WHERE `product_id` = '" . $product_data["id"] . "'");
                                                    $img_data = $img_rs->fetch_assoc();
                                                    ?>

                                                    <img src="<?php echo $img_data["p_path"]; ?>" class="card-img-top img-thumbnail mt-2 border-0" style="height: 300px;" />
                                                    <div class="card-body p-3">

                                                        <div class=" col-12 text-center mt-3">
                                                            <span class=" fw-bold text-decoration-none text-dark p-1 "><?php echo $product_data["title"]; ?></span>
                                                        </div>

                                                        <div class=" col-12 text-center">
                                                            <span class="card-text text-danger fw-bold">LKR.<?php echo $product_data["price"]; ?>.00</span> &nbsp; <span class="card-text text-danger fw-bold">(Qty:<?php echo $product_data["qty"]; ?>)</span><br />
                                                        </div>

                                                        <div class=" col-12 text-center mt-3">
                                                            <a href="#" class=" col-5 btn btn-outline-danger border-3 fw-bold" onclick="deleteProduct(<?php echo $product_data['id']; ?>)">Delate</a>
                                                            <a href="<?php echo "updateproduct.php?id=" . ($product_data["id"]); ?>" class="col-5 btn btn-outline-success border-3 fw-bold" onclick="sendId(<?php echo $product_data['id']; ?>);">Update</a>
                                                        </div>

                                                        <div class=" col-12 mt-3 text-center form-switch">
                                                            <input class="form-check-input" type="checkbox" role="switch" id="fd<?php echo $product_data["id"]; ?>" onchange="changeStatus(<?php echo $product_data['id']; ?>);" <?php if ($product_data["status_status_id"] == 2) { ?> checked <?php } ?> />
                                                            <?php
                                                            if ($product_data["status_status_id"] == 1) {
                                                            ?><label class="form-check-label fw-bold text-primary"> Active </label><?php
                                                                                                                                } else {
                                                                                                                                    ?><label class="form-check-label fw-bold text-danger"> Deactivate </label><?php
                                                                                                                                                                                                            }
                                                                                                                                                                                                                ?>

                                                        </div>

                                                    </div>
                                                </div>
                                                <!-- card -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Top-Product -->

                                <!-- reports -->

                                <div class=" col-12 my-5">
                                    <div class="row">

                                        <table class="table table-bordered bg-primary border-white fs-4 fw-bold" style="width: 100%;">
                                            <thead>
                                                <tr class=" bg-primary">
                                                    <th scope="col" style="width: 30%;">Reports</th>
                                                    <th scope="col" style="width: 30%;">Types</th>
                                                    <th scope="col" style="width: 20%;">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class=" bg-info">
                                                    <td scope="row">Selles Reports</td>
                                                    <td>
                                                        <select class="form-select fw-bold" aria-label="Default select example" id="SellesReportType">
                                                            <option value="s1" selected>Daily</option>
                                                            <option value="s2">Monthly</option>
                                                            <option value="s3">Anualiy</option>
                                                        </select>
                                                    </td>
                                                    <td><span class=" text-decoration-underline" style="cursor: pointer;" onclick="getReport('SellesReportType');">Print</span></td>
                                                </tr>

                                                <tr class=" bg-info">
                                                    <th scope="row">Product details Report</th>
                                                    <td>
                                                        <select class="form-select fw-bold" aria-label="Default select example" id="ProductReportType">
                                                            <option value="0" selected>All</option>
                                                            <?php
                                                            $cat_rs = Database::search("SELECT * FROM `category`");
                                                            $cat_num = $cat_rs->num_rows;
                                                            for ($i = 0; $i < $cat_num; $i++) {
                                                                $cat_data = $cat_rs->fetch_assoc();
                                                            ?>
                                                                <option value="<?php echo $cat_data["id"];  ?>"><?php echo $cat_data["category_name"];  ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td><span class=" text-decoration-underline" style="cursor: pointer;" onclick="getReport('ProductReportType');">Print</span></td>

                                                </tr>
                                                <tr class=" bg-info">
                                                    <th scope="row">User Reports</th>
                                                    <td>
                                                        <select class="form-select fw-bold" aria-label="Default select example" id="userReport">
                                                            <option value="u1" selected>User details</option>
                                                            <option value="u2">Purchase Report</option>
                                                        </select>
                                                    </td>
                                                    <td><span class=" text-decoration-underline" style="cursor: pointer;" onclick="getReport('userReport');">Print</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>



            </div>
            
            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>
    </body>

    </html>
<?php
} else {
?>
    <h1>Log Out Sucsess</h1>
<?php
}
?>