<?php
session_start();
require "conection.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT product.title,product.description,product.price,product.id,product.delivery_fee,product.qty,status.status_name AS sname,category.category_name AS cname FROM product
        INNER JOIN category ON  category.id = product.category_id
        INNER JOIN status ON status.status_id = product.status_status_id
        WHERE product.id = '" . $pid . "'");

    $product_num = $product_rs->num_rows;

    if ($product_num == '1') {
        $product_data = $product_rs->fetch_assoc();

?>

        <!DOCTYPE html>

        <html>

        <head>

            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <title> <?php echo $product_data["title"]; ?> | | Haritha.lk | Enriching Age</title>

            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="bootstrap.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
            <link rel="icon" href="resources/favicon.svg">

        </head>

        <body>

            <div class="container-fluid">
                <div class="row">

                    <?php require "header.php"; ?>

                    <!-- content -->

                    <div class="col-12 p-3">

                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <?php
                                    $pimg_rs = Database::search("SELECT * FROM `p_img` WHERE `product_id` = '" . $pid . "'");
                                    $pimg_data = $pimg_rs->fetch_assoc();
                                    ?>
                                    <img src="<?php echo $pimg_data["p_path"]; ?>" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="row g-2">

                                            <div class="col-12 p-3 mb-0 pb-0">

                                                <?php
                                                $price = $product_data["price"];
                                                $new_price = ((110 / 100) * $price)
                                                ?>

                                                <h1 class=" m-3"><?php echo $product_data["title"]; ?></h1>
                                                <p class=" ms-3 mt-3 mb-0 fs-5 text-decoration-line-through text-black-50">LKR:<?php echo $new_price ?>.00</p>
                                                <h3 class=" ms-3 mt-0 mb-3 text-danger">LKR: <?php echo $product_data["price"] ?>.00</h3>
                                                <span class=" ms-3 p-1 rounded-1 text-bg-success "><?php echo $product_data["qty"]; ?> Available</span>


                                                <div class="col-12 m-3 p-3 border border-1 rounded-2">
                                                    <p><?php echo $product_data["description"]; ?></p>
                                                </div>

                                            </div>

                                            <div class=" col-12">
                                                <div class="row">
                                                    <div class="col-4 col-md-1 offset-md-3">
                                                        <div class="row g-1">
                                                            <h3 class=" border-1 bg-warning text-center" onclick="qty_dec();"> - </i></h3>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-md-2">
                                                        <div class="row g-1">
                                                            <input type="text" class=" text-center border-1 bg-body-secondary p-1" pattern="[0-9]" value="1" id="qty_play" disabled />
                                                        </div>
                                                    </div>
                                                    <div class=" col-4 col-md-1">
                                                        <div class="row g-1">
                                                            <h3 class="border-1 bg-success text-center" onclick="qty_inc(<?php echo $product_data['qty']; ?>);"> + </i></h3>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>

                                            <div class="col-12 p-3">
                                                <div class=" row">
                                                    <?php
                                                    if (isset($_SESSION["user"])) {
                                                    ?>
                                                        <div class=" col-12 col-md-4">
                                                            <div class="row g-1">
                                                                <button type="submit" id="payhere-payment" class=" btn btn-danger mb-2" onclick="addtocart2(<?php echo $product_data['id']; ?>);">Buy Now</button>
                                                            </div>
                                                        </div>

                                                        <div class=" col-12 col-md-4">
                                                            <div class="row g-1">
                                                                <button class=" btn btn-dark mb-2" onclick="addtocart(<?php echo $product_data['id']; ?>);">add to cart </button>
                                                            </div>
                                                        </div>

                                                        <div class=" col-12 col-md-4">
                                                            <div class="row g-1">
                                                                <button class=" btn btn-warning" onclick="addtowatchlist(<?php echo $product_data['id']; ?>);"> watchlist</button>
                                                            </div>
                                                        </div>

                                                    <?php
                                                    } else {
                                                    ?>
                                                        <a href="Log_in.php" class="p-2 bg-success rounded-2 border border-0 text-black text-center text-decoration-none">Log in</a>
                                                    <?php
                                                    }
                                                    ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=" card d-none">
                            <div class="row d-none">

                                <div class="col-12 col-lg-6 border border-4 border-black bg-white">

                                </div>

                                <!--s-->



                            </div>

                        </div>
                    </div>


                    <?php include "footer.php"; ?>

                    <script src="bootstrap.bundle.js"></script>
                    <script src="script.js"></script>
                    <!-- <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script> -->
        </body>

        </html>

<?php
    } else {
        echo ("Some thing went wrong");
    }
} else {
    echo ("Some thing went wrong");
}


?>