<?php
session_start();
require "conection.php";

if (isset($_SESSION["user"])) {
    $umail = $_SESSION["user"]["email"];
?>
    <!DOCTYPE html>
    <html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Wishlist | Haritha.lk | Enriching Age</title>

        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="icon" href="resources/favicon.svg">
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <?php include "header.php";

                ?>

                <div class="col-12">
                    <div class="row">

                        <div class="col-12 border border-1 border-primary rounded mb-2">
                            <div class="row">

                                <div class="col-12 text-center">
                                    <label class="form-label fs-1 fw-bolder">Wishlist</label>
                                </div>

                                <div class="col-12">
                                    <hr />
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="offset-lg-2 col-12 col-lg-6 mb-3">
                                            <input type="text" class="form-control" placeholder="Search in Watchlist..." id="text" />
                                        </div>
                                        <div class="col-12 col-lg-2 mb-3 d-grid">
                                            <button class=" btn btn-success" onclick="findlist(0);">Search</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr />
                                </div>


                                <div class=" col-12 p-5" style="background-color: #E9EbEE;">

                                    <div class=" col-12 card p-3 border border-2 border-black my-3">


                                        <!-- products -->
                                        <div class="col-12 mb-3 p-3">
                                            <div class="row ">

                                                <div class="col-12" id="view_area">
                                                    <div class="row justify-content-center gap-2" >

                                                        <?php

                                                        $product_rs = Database::search("SELECT * FROM `watchlist` 
                                                        INNER JOIN `product` ON product.id = watchlist.product_id 
                                                        INNER JOIN `user` ON user.email = watchlist.user_email WHERE watchlist.user_email = '".$umail."'");
                                                        $product_num = $product_rs->num_rows;

                                                        if ($product_num >= 1) {
                                                            for ($i = 0; $i < $product_num; $i++) {

                                                                $product_data = $product_rs->fetch_assoc();

                                                        ?>

                                                                <!-- <spin> -->
                                                                <div class=" col-12 col-lg-2 mt-2 mb-2 border border-1 shadow-lg bg-body-tertiary rounded" style="width: 18rem;">

                                                                    <?php

                                                                    $img_rs = Database::search("SELECT * FROM `p_img` WHERE `product_id`='" . $product_data["id"] . "'");
                                                                    $img_data = $img_rs->fetch_assoc();

                                                                    ?>

                                                                    <img src="<?php echo $img_data["p_path"] ?>" class="card-img-top img-thumbnail mt-2 border-0" style="height: 300px;" />

                                                                    <div class="card-body ms-0 m-0 ">

                                                                        <div class=" col-12 text-center mt-3">
                                                                            <a href="#" class=" col-5 btn btn-outline-warning border-3 fw-bold">Add</a>
                                                                            <a href="<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>" class="col-5 btn btn-outline-success border-3 fw-bold">Viwe</a>
                                                                        </div>

                                                                        <div class=" col-12 text-center mt-3">
                                                                            <span class=" fw-bold text-decoration-none text-dark p-1 "> <?php echo $product_data["title"]; ?> </span>
                                                                        </div>

                                                                        <div class=" col-12 text-center">
                                                                            <span class="card-text text-danger fw-bold">Rs.<?php echo $product_data["price"]; ?>.00</span><br />

                                                                            <button class="col-10 btn btn-outline-danger mt-3 border border-2 fw-bold" onclick="removetocart(<?php echo $product_data['id']; ?>);">
                                                                                REMOVE
                                                                            </button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <!-- <spin> -->

                                                            <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <!-- empty view -->
                                                            <div class="col-12 col-lg-9">
                                                                <div class="row">
                                                                    <div class="col-12 emptyView"></div>
                                                                    <div class="col-12 text-center">
                                                                        <label class="form-label fs-1 fw-bold">You have no items in your Wishlist yet.</label>
                                                                    </div>
                                                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                                                        <a href="index.php" class="btn btn-danger fs-3 fw-bold">Start Shopping</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- empty view -->

                                                            <!-- have products -->
                                                        <?php
                                                        }

                                                        ?>

                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        <!-- products -->

                                        <!-- Home -->
                                    </div>

                                    <?php




                                    ?>


                                </div>

                                <!-- have products -->
                            </div>
                        </div>
                    </div>
                </div>

                <?php include "footer.php"; ?>

            </div>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>

    <?php

    ?>
<?php
}
?>