<?php

session_start();
require "conection.php";

if (isset($_SESSION["admin"])) {

    $email = $_SESSION["admin"]["user_email"];

    $pageno;

?>



    <!DOCTYPE html>

    <html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>My Products | AYUNA.lk | Enriching Age</title>

        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="icon" href="resources/favicon.svg">
    </head>

    <body style="background-color: #E9EBEE;">

        <div class="container-fluid">
            <div class="row">

                <!-- header -->
                <?php require "cpanal_head.php"; ?>
                <!-- header -->

                <!-- body -->
                <div class="col-12">
                    <div class="row">

                        <!-- filter -->
                        <div class="col-11 col-lg-2 mx-3 my-3 border border-primary rounded">
                            <div class="row">
                                <div class="col-12 mt-3">
                                    <div class="row">

                                        <div class="col-12">
                                            <label class="form-label fw-bold fs-3">Sort Products</label>
                                        </div>
                                        <div class="col-11">
                                            <div class="row">

                                                <div class="col-10">
                                                    <input type="text" placeholder="Search..." class="form-control" id="s" />
                                                </div>

                                                <div class="col-1 p-1">
                                                    <label class="form-label"><i class="bi bi-search fs-5"></i></label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <hr />
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-bold">Active Time</label>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r1" id="n">
                                                <label class="form-check-label" for="n">
                                                    Newest to oldest
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r1" id="o">
                                                <label class="form-check-label" for="o">
                                                    Oldest to newest
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">By Price</label>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r2" id="h">
                                                <label class="form-check-label" for="h">
                                                    High to low
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r2" id="l">
                                                <label class="form-check-label" for="l">
                                                    Low to high
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">By Categoty</label>
                                        </div>

                                        <div class="col-12">
                                            <select id="cat" class=" form-select">
                                                <option value="0">Select Category</option>
                                                <?php
                                                $cat_rs = Database::search("SELECT * FROM `category`");
                                                $cat_num = $cat_rs->num_rows;

                                                for ($i = 0; $i < $cat_num; $i++) {
                                                    $cat_data = $cat_rs->fetch_assoc();

                                                ?>
                                                    <option value="<?php echo $cat_data["id"]; ?>"><?php echo $cat_data["category_name"]; ?></option>
                                                <?php
                                                }
                                                ?>

                                            </select>
                                        </div>

                                        <div class="col-12 text-center mt-3 mb-3">
                                            <div class="row g-2">
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <button class="btn btn-primary fw-bold" onclick="sort(0);">Sort</button>
                                                </div>
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <button class="btn btn-danger fw-bold" onclick="window.location.reload();">Clear</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- filter -->

                        <!-- product -->
                        <div class="col-12 col-lg-9 mt-3 mb-3 bg-white">
                            <div class=" col-9 mt-5 mb-0 ms-lg-3">
                                <div class="row">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="control_panel.php">Control Panel</a></li>
                                            <li class="breadcrumb-item active fw-bold" aria-current="page">My product</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                            <div class="row" id="sort">

                                <div class="offset-1 col-10 text-center">
                                    <div class="row justify-content-center">

                                        <?php

                                        if (isset($_GET["page"])) {
                                            $pageno = $_GET["page"];
                                        } else {
                                            $pageno = 1;
                                        }

                                        $product_rs = Database::search("SELECT * FROM `product`");
                                        $product_num = $product_rs->num_rows;

                                        $results_per_page = 6;
                                        $number_of_page = ceil($product_num / $results_per_page);

                                        $page_rs = ($pageno - 1) * $results_per_page;
                                        $select_rs = Database::search("SELECT * FROM `product` LIMIT " . $results_per_page . " OFFSET " . $page_rs . "");

                                        $select_num = $select_rs->num_rows;

                                        for ($i = 0; $i < $select_num; $i++) {
                                            $product_data = $select_rs->fetch_assoc();

                                        ?>

                                            <!-- card -->
                                            <div class=" col-12 col-lg-2 mt-2 mb-2 border border-1 shadow-lg bg-body-tertiary rounded mx-2" style="width: 18rem;">

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

                                        <?php
                                        }

                                        ?>



                                    </div>
                                </div>

                                <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3 mt-4">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination pagination-lg justify-content-center">
                                            <li class="page-item">
                                                <a class="page-link" href="
                                                <?php if ($pageno <= 1) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno - 1);
                                                } ?>
                                                
                                                " aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>


                                            <?php

                                            for ($y = 1; $y <= $number_of_page; $y++) {
                                                if ($y == $pageno) {
                                            ?>
                                                    <li class="page-item active">
                                                        <a class="page-link" href="<?php echo "?page=" . ($y); ?>"><?php echo $y; ?></a>
                                                    </li>
                                                <?php
                                                } else {
                                                ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="<?php echo "?page=" . ($y); ?>"><?php echo $y; ?></a>
                                                    </li>
                                            <?php
                                                }
                                            }

                                            ?>


                                            <li class="page-item">
                                                <a class="page-link" href="
                                                <?php if ($pageno >= $number_of_page) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno + 1);
                                                } ?>
                                                " aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>

                            </div>
                        </div>
                        <!-- product -->

                    </div>
                </div>
                <!-- body -->

            </div>
        </div>

        <script src="script.js"></script>
    </body>

    </html>
<?php
}
?>