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
                <?php require "cpanal_head.php";
                ?>

                <!--main-->


                <div class=" col-12">
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
                                    <button class=" col-12 btn btn-dark p-3 border border-danger fw-bold" onclick="window.location ='message.php'">Message</button>
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

                                <br />

                                <div class="col-12 bg-white p-2 rounded-3 mb-5">
                                    <div class="row g-2">

                                        <div class="col-4 px-1">
                                            <div class="row g-0">
                                                <div class="col-12 bg-primary text-white text-center rounded rounded-bottom-0">
                                                    <label class="fs-4 fw-bold">Description</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-4 px-1">
                                            <div class="row">
                                                <div class="col-12 bg-primary text-white text-center">
                                                    <label class="fs-4 fw-bold">Quantity</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4 px-1">
                                            <div class="row g-0">
                                                <div class="col-12 bg-primary text-white text-center rounded rounded-bottom-0">
                                                    <label class="fs-4 fw-bold">Income and loss</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Today -->
                                        <div class="col-4 px-1">
                                            <div class="row g-0">
                                                <div class="col-12 bg-green text-black">
                                                    <label class="fs-5 fw-bold p-2">Today Selles</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4 px-1">
                                            <div class="row g-0">
                                                <div class="col-12 text-black bg-green">
                                                    <label class="fs-5 fw-bold p-2"><?php echo $todaySells  ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4 px-1">
                                            <div class="row g-0">
                                                <div class="col-12 bg-green text-black">
                                                    <label class="fs-5 fw-bold p-2">Rs : <?php echo (number_format($todayIncome)); ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- this month -->

                                        <div class="col-4 px-1">
                                            <div class="row g-0">
                                                <div class="col-12 bg-green text-black">
                                                    <label class="fs-5 fw-bold p-2">This Month Selles</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4 px-1">
                                            <div class="row g-0">
                                                <div class="col-12 bg-green text-black">
                                                    <label class="fs-5 fw-bold p-2"><?php echo $monthlySells ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4 px-1">
                                            <div class="row g-0">
                                                <div class="col-12 bg-green text-black">
                                                    <label class="fs-5 fw-bold p-2">Rs : <?php echo (number_format($monthlyIncome)); ?></label>
                                                </div>
                                            </div>
                                        </div>



                                        <!-- last month sell -->
                                        <div class="col-4 px-1">
                                            <div class="row g-0">
                                                <div class="col-12 bg-green text-black">
                                                    <label class="fs-5 fw-bold p-2">Last Month Selles</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-4 px-1">
                                            <div class="row g-0">
                                                <div class="col-12 bg-green text-black">
                                                    <label class="fs-5 fw-bold p-2"><?php echo $lastMonthSells ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4 px-1">
                                            <div class="row g-0">
                                                <div class="col-12 bg-green text-black">
                                                    <label class="fs-5 fw-bold p-2">Rs : <?php echo (number_format($lastMonthIncome)) ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- This Month Lost -->
                                        <div class="col-4 px-1 ">
                                            <div class="row g-0">
                                                <div class="col-12 text-black bg-lessred">
                                                    <label class="fs-5 fw-bold p-2">Rejected Orders This Month</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4 px-1">
                                            <div class="row g-0">
                                                <div class="col-12 text-black bg-lessred">
                                                    <label class="fs-5 fw-bold p-2"><?php echo $lostSellsThis ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4 px-1">
                                            <div class="row g-0">
                                                <div class="col-12 text-black bg-lessred">
                                                    <label class="fs-5 fw-bold p-2">(Rs: <?php echo (number_format($lostIncomeThis)) ?>)</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Last Month Lost -->
                                        <div class="col-4 px-1">
                                            <div class="row g-0">
                                                <div class="col-12 text-black bg-lessred">
                                                    <label class="fs-5 fw-bold p-2">Rejected Orders Last Month</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4 px-1">
                                            <div class="row g-0">
                                                <div class="col-12 text-black bg-lessred">
                                                    <label class="fs-5 fw-bold p-2"><?php echo $lostSellsLast ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-4 px-1">
                                            <div class="row g-0">
                                                <div class="col-12 text-black bg-lessred">
                                                    <label class="fs-5 fw-bold p-2">(Rs: <?php echo (number_format($lostIncomeLast)) ?>)</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- break -->
                                        <div class="col-12 px-1">
                                            <div class="row g-0">
                                                <div class="col-12 bg-black text-black text-center">
                                                    <span class=" text-danger fw-bolder small"> *Note : All sales are generated according to delivered orders.</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>



                        <div class="col-12 col-lg-9 d-flex justify-content-center d-none">
                            <div class=" row align-items-center">



                                <div class=" col-12">
                                    <div class=" row gx-3">

                                        <div class=" col-12 text-black text-center fw-bold fs-3 px-2 py-0 bg-body-tertiary rounded-3 rounded-bottom-0 ">
                                            <label class=" form-label">Status</label>
                                        </div>

                                        <div class=" col-12 text-black text-center  fs-5 p-2 pb-0 pt-0 bg-light rounded-3 rounded-top-0">
                                            <table class="table">

                                                <thead>
                                                    <tr>
                                                        <th scope="col">Title</th>
                                                        <th scope="col">Description</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td>Most Selling Item</td>
                                                        <?php
                                                        $most_item = Database::search("SELECT product.title,product_id, COUNT(product_id) AS total_orders
                                                            FROM invoice INNER JOIN product ON product.id = invoice.product_id
                                                            GROUP BY product_id
                                                            ORDER BY total_orders DESC
                                                            LIMIT 1");
                                                        $most_item_data = $most_item->fetch_assoc();
                                                        ?>
                                                        <td><?php echo $most_item_data["title"] ?></td>

                                                    </tr>

                                                    <tr>
                                                        <td>Top User</td>
                                                        <?php
                                                        $top_user_rs = Database::search("SELECT `user_email`, COUNT(`user_email`) AS top_user FROM `invoice` GROUP BY user_email ORDER BY top_user DESC LIMIT 1;");
                                                        $top_user_data = $top_user_rs->fetch_assoc()
                                                        ?>
                                                        <td><?php echo $top_user_data["user_email"];  ?></td>

                                                    </tr>

                                                    <tr>
                                                        <td>Selles</td>
                                                        <?php
                                                        $sell_rs = Database::search("SELECT SUM(`iqty`) AS sell FROM `invoice`
                                                            WHERE MONTH(`date`) = 02 AND YEAR(`date`) = 2024;
                                                            
                                                            ");
                                                        $sell_data = $sell_rs->fetch_assoc()
                                                        ?>
                                                        <td><?php echo $sell_data["sell"] ?></td>

                                                    </tr>

                                                    <tr>
                                                        <td>Monthly Income</td>
                                                        <?php

                                                        $year = date("Y");
                                                        $month = date("m");

                                                        $income_rs = Database::search("SELECT SUM(`total`) AS income
                                                            FROM `invoice`
                                                            WHERE MONTH(`date`) = $month AND YEAR(`date`) = $year ");
                                                        $income_data = $income_rs->fetch_assoc()
                                                        ?>
                                                        <td><?php echo "Rs: " . $income_data["income"] ?></td>

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



            </div>

    </body>

    </html>
<?php
} else {
?>
    <h1>Log Out Sucsess</h1>
<?php
}
?>