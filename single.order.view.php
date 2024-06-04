<?php session_start();
require "conection.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Orders | Haritha.lk | Enriching Age</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" href="resources/favicon.svg">
</head>

<body>

    <div class=" col-12 container-fluid">
        <div class=" row">

            <?php include "cpanal_head.php";



            if (isset($_SESSION["admin"])) {


                $oid = $_GET["id"];
                $subtal = 0;
                $shipping = 0;
                $gtotal = 0;

            ?>

                <div class=" col-12 p-lg-5">
                    <div class=" row">

                        

                        <div class=" col-12 p-3 shadow-lg bg-body-tertiary rounded border">

                            <?php

                            $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id` = '" . $oid . "'");
                            $invoice_num = $invoice_rs->num_rows;
                            $invoice_data = $invoice_rs->fetch_assoc();


                            ?>

                            <div class=" col-12 fw-bold">
                                <h2 class=" text-center">Orders</h2>
                                <span>Order ID : <?php echo $oid ?></span> <br />
                                <span><?php echo $invoice_data["date"] ?></span> <br />
                            </div>

                            <div class=" col-12">
                                <hr />
                            </div>

                            <?php
                            $email = $invoice_data["user_email"];
                            $user_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "'");
                            $user_data = $user_rs->fetch_assoc();

                            $city_rs = Database::search("SELECT * FROM `address` INNER JOIN `city` ON city.city_id = address.city_id WHERE `user_email` = '" . $email . "'");
                            $city_data = $city_rs->fetch_assoc();

                            ?>

                            <div class=" col-12 fw-bold">
                                <span><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></span> <br />
                                <span><?php echo $user_data["email"]; ?></span> <br />
                                <span><?php echo $user_data["contact_no"]; ?></span> <br />
                                <span><?php echo $city_data["line_1"] . " " . $city_data["line_2"]; ?></span> <br />
                                <span><?php echo $city_data["city_name"]; ?></span> <br />
                            </div>

                            <div class=" col-12 mt-5 overflow-x-scroll">
                                <table class=" table table-info table-striped ">
                                    <tr>
                                        <th class="opacity-2">#</th>
                                        <th>Description</th>
                                        <th>Product ID</th>
                                        <th>Qty</th>
                                        <th>Unit Price</th>
                                        <th width="140">Amount</th>
                                    </tr>

                                    <?php

                                    $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `invoice` ON invoice.product_id = product.id WHERE `order_id` = '" . $oid . "' ");

                                    $invoice_rs_data = Database::search("SELECT * FROM `invoice` WHERE `order_id` = '" . $oid . "'");


                                    for ($i = 0; $i < $invoice_num; $i++) {
                                        $product_data = $product_rs->fetch_assoc();
                                        $invoice_data_data = $invoice_rs_data->fetch_assoc();


                                        $qty = $invoice_data_data["iqty"];
                                        $price = $product_data["price"];
                                        $total = $qty * $price;

                                    ?>

                                        <tr>
                                            <td><?php echo $i + 1 ?></td>
                                            <td><?php echo $product_data["title"]; ?></td>
                                            <td><?php echo $product_data["product_id"]; ?></td>
                                            <td><?php echo number_format($invoice_data_data["iqty"]) ?></td>
                                            <td>LKR : <?php echo number_format($product_data["price"]) ?></td>
                                            <td>LKR : <?php echo number_format($total) ?></td>
                                        </tr>

                                    <?php


                                        $subtal = $subtal + ($product_data["price"] * $invoice_data_data["iqty"]);
                                        if ($shipping <= $product_data["delivery_fee"]) {
                                            $shipping = $product_data["delivery_fee"];
                                        }
                                        $gtotal = $subtal + $shipping;
                                    }

                                    ?>

                                    <tr>
                                        <th colspan="1"></th>
                                        <th colspan="1"></th>
                                        <th colspan="1"></th>
                                        <th colspan="1"></th>
                                        <th class=" border-1 border-black">Sub Total</th>
                                        <th width="140" class=" border-1 border-black">LKR : <?php echo number_format($subtal); ?></th>
                                    </tr>

                                    <tr>
                                        <th colspan="1"></th>
                                        <th colspan="1"></th>
                                        <th colspan="1"></th>
                                        <th colspan="1"></th>
                                        <th class=" border-1 border-black">Delivary Fee</th>
                                        <th width="140" class=" border-1 border-black">LKR : <?php echo number_format($shipping); ?></th>
                                    </tr>

                                    <tr>
                                        <th colspan="1"></th>
                                        <th colspan="1"></th>
                                        <th colspan="1"></th>
                                        <th colspan="1"></th>
                                        <th class=" border-1 border-black">Grand Total</th>
                                        <th width="140" class=" border-1 border-black">LKR: <?php echo number_format( $gtotal); ?></th>
                                    </tr>

                                </table>

                                <div class=" col-12">
                                    <div class=" row">

                                        <?php

                                        if ($invoice_data["status"] == 0) {
                                        ?>

                                            <div class=" col-12 col-lg-6">
                                                <button class="col-12 btn btn-success fw-bold fs-5" onclick="changeSt('<?php echo $oid ?>')">Accept Order</button>
                                            </div>

                                            <div class=" col-12 col-lg-6">
                                                <button class="col-12 btn btn-danger fw-bold fs-5" onclick="changeSt('<?php echo $oid ?>','3')">Cancel Order</button>
                                            </div>

                                        <?php
                                        } elseif ($invoice_data["status"] == 1) {
                                        ?>
                                            <div class=" col-12 col-lg-12">
                                                <button class="col-12 btn btn-primary fw-bold fs-5" onclick="changeSt('<?php echo $oid ?>')">delivered Order</button>
                                            </div>

                                            <div class=" col-12 col-lg-6">
                                                <!-- <input type="file" class=" col-12 form-control bg-warning fw-bold" id="dfile" /> -->
                                            </div>


                                        <?php
                                        }

                                        ?>




                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                <?php

            }

                ?>

                </div>
        </div>


        <script src="script.js"></script>
</body>

</html>

<?php
