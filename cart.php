<?php
session_start();
require "conection.php";
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cart | Haritha.lk | Enriching Age</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" href="resources/favicon.svg">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php require "header.php";

            if (isset($_SESSION["user"])) {

                $user = $_SESSION["user"]["email"];

                $total = 0;
                $subtal = 0;
                $shipping = 0;

            ?>
                <div class="col-12 border border-1 border-primary">
                    <div class="row">

                        <div class="col-12">
                            <label class="form-label fs-1 fw-bold">Cart <i class="bi bi-cart4 fs-1 text-success"></i></label>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>

                        <?php
                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email` = '" . $user . "' AND `order_id` = 'NULL'");
                        $cart_num = $cart_rs->num_rows;

                        if ($cart_num >= 1) {

                            for ($i = 0; $i < $cart_num; $i++) {
                                $cart_data = $cart_rs->fetch_assoc();
                                $pid = $cart_data["product_id"];

                        ?>
                                <!-- products -->

                                <div class="col-12 col-lg-9">
                                    <div class="row g-0">

                                        <div class="card mb-3 mx-0 col-12">
                                            <div class="row g-0">

                                                <?php
                                                $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $pid . "'");
                                                $product_data = $product_rs->fetch_assoc();

                                                $subtal = $subtal + ($product_data["price"] * $cart_data["qty"]);
                                                if ($shipping <= $product_data["delivery_fee"]) {
                                                    $shipping = $product_data["delivery_fee"];
                                                }

                                                $total = $subtal + $shipping;

                                                ?>
                                                <div class="col-md-4 d-flex justify-content-center">
                                                    <div class="row align-content-center">
                                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $product_data["description"]; ?>" title="Product Description">
                                                            <?php
                                                            $img_rs = Database::search("SELECT * FROM `p_img` WHERE `product_id` = '" . $product_data["id"] . "'");
                                                            $img_data = $img_rs->fetch_assoc();
                                                            ?>
                                                            <img src="<?php echo $img_data["p_path"]; ?>" class="img-thumbnail border-0" style="max-width: 200px;">
                                                        </span>
                                                    </div>

                                                </div>
                                                <div class="col-md-5">
                                                    <div class="card-body">

                                                        <h3 class="card-title"><?php echo $product_data["title"]; ?></h3>

                                                        <span class="fw-bold text-black-50 fs-5">Price :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-5">Rs. <?php echo $product_data["price"]; ?> .00</span>
                                                        <br>
                                                        <span class="fw-bold text-black-50 fs-5">Quantity: <?php echo $product_data["qty"] ?> items in Stock</span>&nbsp;
                                                        <br />

                                                        <div class=" col-12 mt-3">
                                                            <div class="row">

                                                                <div class=" col-3">
                                                                    <div class="row g-1">
                                                                        <button class="fw-bold" onclick="cart_qty_dec(<?php echo $i; ?>,<?php echo $product_data['id']; ?>)"> - </i></button>
                                                                    </div>
                                                                </div>

                                                                <div class=" col-6">
                                                                    <div class="row g-1">
                                                                        <input type="text" class="text-center border-black fw-bold" pattern="[0-9]" value="<?php echo $cart_data["qty"]; ?>" id="qty_play<?php echo $i ?>" disabled />
                                                                    </div>
                                                                </div>

                                                                <div class="col-3">
                                                                    <div class="row g-1">
                                                                        <button class="fw-bold" onclick="cart_qty_inc(<?php echo $product_data['qty']; ?>, <?php echo $i; ?>,<?php echo $product_data['id']; ?>)"> + </i></button>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <br />
                                                        <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-5">Rs.<?php echo $product_data["delivery_fee"]; ?>.00</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class=" card-body d-flex justify-content-end">
                                                        <button class="btn btn-danger mb-2" onclick="removecart(<?php echo $product_data['id']; ?>);"><i class="bi bi-trash3"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- products -->
                            <?php
                            }
                            ?>


                            <!-- summary -->
                            <div class="col-12 col-lg-3">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label fs-3 fw-bold">Summary</label>
                                    </div>

                                    <div class="col-12">
                                        <hr />
                                    </div>

                                    <div class="col-6 mb-3">
                                        <span class="fs-6 fw-bold">items(<?php echo $cart_num; ?>)</span>
                                    </div>

                                    <div class="col-6 text-end mb-3">
                                        <span class="fs-6 fw-bold">Rs.<?php echo $subtal; ?>.00</span>
                                    </div>

                                    <div class="col-6">
                                        <span class="fs-6 fw-bold">Shipping</span>
                                    </div>

                                    <div class="col-6 text-end">
                                        <span class="fs-6 fw-bold">Rs.<?php echo $shipping; ?>.00</span>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <hr />
                                    </div>

                                    <div class="col-6 mt-2">
                                        <span class="fs-4 fw-bold">Total</span>
                                    </div>

                                    <div class="col-6 mt-2 text-end">
                                        <span class="fs-4 fw-bold">Rs.<?php echo $total; ?>.00</span>
                                    </div>

                                    <div class="col-12 mt-3 mb-3 d-grid">
                                        <button class="btn btn-primary fs-5 fw-bold" onclick="paycart();">Place Order</button>
                                    </div>

                                </div>
                            </div>
                            <!-- summary -->
                        <?php
                        } else {
                        ?>
                            <!-- Empty View -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 emptyCart"></div>
                                    <div class="col-12 text-center mb-2">
                                        <label class="form-label fs-1 fw-bold">
                                            Cart empty. Let's Shopping.
                                        </label>
                                    </div>
                                    <div class="offset-lg-4 col-12 col-lg-4 mb-4 d-grid">
                                        <a href="index.php" class="btn btn-success text-warning fs-3 fw-bold">
                                            Start Shopping
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Empty View -->
                        <?php
                        }
                        ?>


                        <!-- coment -->


                    </div>
                </div>

            <?php } else {
            ?>
                <div class=" col-12 text-center p-5 m-5">

                    <a class=" btn btn-success col-3 text-decoration-none" href="Log_in.php">
                        <h1 class=" text-warning"> Login or Register</h1>
                    </a>
                </div>
            <?php
            }
            require "footer.php"; ?>

        </div>
    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
</body>

</html>