<?php
session_start();
require "conection.php";
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home | Haritha.lk | For Happy Life</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" href="resources/favicon.svg">
</head>

<body>


    <div class=" container-fluid">
        <div class=" row">

            <?php require "header.php"; ?>

            <hr class=" border border-3 border-black" />

            <div class="col-12 justify-content-center">
                <div class="row mb-3">

                    <div class="offset-4 offset-lg-1 col-4 col-lg-1 logo" style="height: 60px;"></div>

                    <div class="col-12 col-lg-6">

                        <div class="input-group mb-3 mt-md-3">
                            <input type="text" class="form-control border border-2 border-success" aria-label="Text input with dropdown button" id="text" />

                            <select class="form-select border border-2 border-success" style="max-width: 250px;" id="cat">
                                <option value="0">All Categories</option>

                                <?php

                                $clist_rs = Database::search("SELECT * FROM `category`");
                                $clist_num = $clist_rs->num_rows;

                                for ($y = 0; $y < $clist_num; $y++) {
                                    $clist_data = $clist_rs->fetch_assoc();

                                ?> <option value="<?php echo $clist_data["id"]; ?>"> <?php echo $clist_data["category_name"]; ?> </option> <?php
                                                                                                                                        }
                                                                                                                                            ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-lg-2 d-grid">
                        <button class="btn btn-success mt-3 mb-3" onclick="basicsearch(0);">Search</button>
                    </div>

                    <div class="col-12 col-lg-2 mt-2 mt-lg-4 text-center text-lg-start">
                        <a href="advancedSearch.php" class="text-decoration-none link-secondary fw-bold text-success">Advanced</a>
                    </div>

                </div>
            </div>

            <div class=" col-12 p-3" id="basicSearchResult">
                <div class=" row">

                    <!--carousel -->
                    <div id="carouselExampleCaptions" class=" offset-2 col-8 carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">

                            <div class="carousel-item active">
                                <img src="resources/cl_1.jpg" class="d-block w-100  poster-img-1">
                            </div>

                            <div class="carousel-item">
                                <img src="resources/cl_2.jpg" class="d-block w-100  poster-img-1">
                            </div>

                            <div class="carousel-item">
                                <img src="resources/cl_3.jpg" class="d-block w-100  poster-img-1">
                            </div>

                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <!--carousel -->

                    <!-- Home -->

                    <div class=" col-12 p-5" style="background-color: #E9EbEE;">

                        <?php

                        $cat_rs = Database::search("SELECT * FROM `category`");
                        $cat_num = $cat_rs->num_rows;

                        for ($x = 0; $x < $cat_num; $x++) {
                            $cat_data = $cat_rs->fetch_assoc();

                        ?>

                            <div class=" col-12 card p-3 border border-2 border-black my-3">
                                <!-- category names -->
                                <div class="col-12 p-2">
                                    <a class="text-decoration-none text-dark fs-3 fw-bold align-items-lg-end">
                                        <?php echo $cat_data["category_name"]; ?> &nbsp;
                                    </a>
                                    <?php
                                    $p_count_rs = Database::search("SELECT * FROM `product` WHERE `category_id` = '" . $cat_data["id"] . "'");
                                    $p_count = $p_count_rs->num_rows;


                                    ?>
                                    <a class="text-decoration-none fs-6 fw-bold text-success" onclick="viweall(<?php echo $cat_data['id'] ?>);" style="cursor: pointer;">View All Products (<?php echo $p_count ?>) </a>
                                </div>
                                <!-- category names -->

                                <!-- products -->
                                <div class="col-12 mb-3 p-3">
                                    <div class="row ">

                                        <div class="col-12 ">
                                            <div class="row justify-content-center gap-2">

                                                <?php

                                                $product_rs = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $cat_data['id'] . "' AND `status_status_id` ='1' ORDER BY `date_and_time` DESC LIMIT 4 OFFSET 0 ");
                                                $product_num = $product_rs->num_rows;

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

                                                            <!-- <div class=" col-12 text-center ">
                                                                <button class=" col-2 rounded-start-circle fw-bold fs-5" onclick="qty_dec();"> - </i></button>
                                                                <input type="text" class=" col-6 text-center border-black fw-bold fs-5" pattern="[0-9]" value="1" id="qty_play" disabled />
                                                                <button class=" col-2 fw-bold rounded-end-circle fs-5" onclick="qty_inc();"> + </i></button>
                                                            </div> -->

                                                            <div class=" col-12 text-center mt-3">
                                                                <a class=" col-5 btn btn-outline-danger border-3 fw-bold" onclick="addtocart(<?php echo $product_data['id']; ?>);">Add</a>
                                                                <a href="<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>" class="col-5 btn btn-outline-success border-3 fw-bold">View</a>
                                                            </div>

                                                            <div class=" col-12 text-center mt-3">
                                                                <span class=" fw-bold text-decoration-none text-dark p-1 "> <?php echo $product_data["title"]; ?> </span>
                                                            </div>

                                                            <div class=" col-12 text-center">
                                                                <span class="card-text text-danger fw-bold">Rs.<?php echo $product_data["price"]; ?>.00</span><br />

                                                                <button class="col-10 btn btn-outline-light mt-3 border border-2 border-warning" onclick="addtowatchlist(<?php echo $product_data['id']; ?>);">
                                                                    <img src="resources/wish.svg" />
                                                                </button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!-- <spin> -->

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


                        }

                        ?>


                    </div>
                </div>
            </div>
            <hr />
            <?php require "footer.php"; ?>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>