<?php session_start();
require "conection.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Purchase History | AYUNA.lk | Enriching Age</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" href="resources/favicon.svg">
</head>

<body>

    <div class=" col-12 container-fluid">
        <div class=" row">

            <?php include "header.php";



            if (isset($_SESSION["user"])) {

                $email = $_SESSION["user"]["email"];
                $oid = $_GET["id"];
                $subtal = 0;
                $shipping = 0;
                $gtotal = 0;

            ?>

                <div class=" col-12 p-3 p-md-5 ">
                    <div class=" row">

                        <div class="col-12 bg-body-tertiary rounded border p-3 overflow-x-auto">

                            <?php

                            $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id` = '" . $oid . "'");
                            $invoice_num = $invoice_rs->num_rows;
                            $invoice_data = $invoice_rs->fetch_assoc();


                            ?>

                            <div class=" col-12 fw-bold">
                                <h2 class=" text-center">Purchase History</h2>
                                <span>Order ID : <?php echo $oid ?></span> <br />
                                <span><?php echo $invoice_data["date"] ?></span> <br />
                            </div>

                            <div class=" col-12">
                                <hr />
                            </div>

                            <?php

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

                            <div class=" col-12 mt-5">
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
                                            <td><?php echo $invoice_data_data["iqty"]; ?></td>
                                            <td>LKR : <?php echo $product_data["price"]; ?></td>
                                            <td>LKR : <?php echo $total; ?></td>
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
                                        <th width="140" class=" border-1 border-black">LKR : <?php echo $subtal; ?></th>
                                    </tr>

                                    <tr>
                                        <th colspan="1"></th>
                                        <th colspan="1"></th>
                                        <th colspan="1"></th>
                                        <th colspan="1"></th>
                                        <th class=" border-1 border-black">Delivary Fee</th>
                                        <th width="140" class=" border-1 border-black">LKR : <?php echo $shipping; ?></th>
                                    </tr>

                                    <tr>
                                        <th colspan="1"></th>
                                        <th colspan="1"></th>
                                        <th colspan="1"></th>
                                        <th colspan="1"></th>
                                        <th class=" border-1 border-black">Grand Total</th>
                                        <th width="140" class=" border-1 border-black">LKR: <?php echo $gtotal; ?></th>
                                    </tr>

                                </table>

                                <div class=" col-12 d-flex justify-content-end">
                                    <div class="row">

                                        <div class=" col-12 d-inline-flex">
                                            <div class="row g-2">

                                                <div class="col-12">
                                                    <div class="row">
                                                        <span class=" card text-center text-bg-warning rounded-pill p-1"> <a href="feedback.php?id=<?php echo $oid  ?>" style="text-decoration: none; color:black;">Go</a></span>
                                                    </div>

                                                </div>

                                                <div class="col-12">
                                                    <div class="row">
                                                        <span class=" card text-center text-bg-danger text-black rounded-pill p-1" style="cursor: pointer;" onclick="deleteHistory('<?php echo $oid ?>');"> delete</span>
                                                    </div>

                                                </div>


                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            <?php

            }

            ?>

            <?php include "footer.php"; ?>
        </div>
    </div>


</body>

</html>

<?php
