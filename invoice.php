<?php session_start();
require "conection.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Invoice | AYUNA.lk | Enriching Age</title>

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

                <div class=" col-12 p-3 p-lg-5 ">
                    <div class=" row">

                        <div class="col-12 bg-body-tertiary rounded border border-black p-3">

                            <div class="col-12 btn-toolbar justify-content-end">
                                <button class="btn btn-dark me-2"><i class="bi bi-printer-fill" onclick="printInvoice();"></i> Print</button>
                                <button class="btn btn-danger me-2"><i class="bi bi-filetype-pdf"></i> Export as PDF</button>
                            </div>

                            <div class=" col-12">
                                <hr />
                            </div>

                            <?php

                            $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id` = '" . $oid . "'");
                            $invoice_num = $invoice_rs->num_rows;
                            $invoice_data = $invoice_rs->fetch_assoc();


                            ?>

                            <div id="page">
                                <div class=" col-12 fw-bold">
                                    <h2>INVOICE</h2>
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

                                <div class=" col-12 mt-5  overflow-x-auto">
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
                                                <td><?php echo number_format($invoice_data_data["iqty"]); ?></td>
                                                <td>LKR : <?php echo number_format($product_data["price"]); ?></td>
                                                <td>LKR : <?php echo number_format($total); ?></td>
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
                                            <th width="140" class=" border-1 border-black">LKR: <?php echo number_format($gtotal); ?></th>
                                        </tr>

                                    </table>
                                </div>

                                <div class=" col-12 p-2 fs-2 text-success fw-bold">
                                    <span>Thank You!</span>
                                </div>

                                <div class="col-12 mt-3 mb-3 border-0 border-start border-5 border-danger rounded " style="background-color: #ffe7e7;">
                                    <div class="row">
                                        <div class="col-12 mt-3 mb-3">
                                            <label class="form-label fs-5 fw-bold">NOTICE : </label>
                                            <br />
                                            <label class="form-label fs-6">Purchased items can return befor 7 days of Delivery.</label>
                                        </div>
                                    </div>
                                </div>

                                <div class=" col-12 fw-bold text-end">
                                    <div class=" col-12">
                                        <h3 class=" mb-2 text-decoration-underline">
                                        Haritha.lk

                                        </h3>
                                        <span>No-45/B, Colombo 7, Sri Lanka</span> <br />
                                        <span>Haritha@gmail.com</span> <br />
                                        <span>+94112 875 2365</span> <br />
                                    </div>

                                </div>

                                <div class=" col-12">
                                    <hr />
                                </div>

                                <div class="col-12">
                                    <hr class="border border-1 border-primary" />
                                </div>

                                <div class="col-12 text-center mb-3">
                                    <label class="form-label fs-5 text-black-50 fw-bold">
                                        Invoice was created on a computer and is valid without the Signature and Seal.
                                    </label>
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

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>

<?php
