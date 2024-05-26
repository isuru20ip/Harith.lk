<?php
require "conection.php";

$text = $_POST["t"];
$category = $_POST["c"];
$from = $_POST["pf"];
$to = $_POST["pt"];
$sort = $_POST["s"];

if (!empty($text) || $category != 0 || !empty($from) || !empty($to)) {

    $query = "SELECT * FROM `product`";
    $status = 0;

    if (!empty($text)) {
        $query .= " WHERE `title` LIKE '%" . $text . "%'";
        $status = 1;
    }

    if ($category != 0) {
        if ($status == 0) {
            $query .= " WHERE `category_id` = '" . $category . "'";
            $status = 1;
        } elseif ($status == 1) {
            $query .= " AND `category_id` = '" . $category . "'";
        }
    }

    if (!empty($from) && empty($to)) {
        if ($status == 0) {
            $query .= " WHERE `price` >= '" . $from . "'";
            $status = 1;
        } elseif ($status = 1) {
            $query .= " AND  `price` >= '" . $from . "'";
        }
    }

    if (empty($from) && !empty($to)) {
        if ($status == 0) {
            $query .= " WHERE `price` <= '" . $to . "'";
            $status = 1;
        } elseif ($status = 1) {
            $query .= " AND  `price` <= '" . $to . "'";
        }
    }

    if (!empty($from) && !empty($to)) {
        if ($status == 0) {
            $query .= " WHERE `price` <= '" . $to . "' AND `price` >= '" . $from . "'";
            $status = 1;
        } elseif ($status = 1) {
            $query .= " AND `price` <= '" . $to . "' AND `price` >= '" . $from . "'";
        }
    }

    if ($sort == 1) {
        $query .= " ORDER BY `price` DESC";
    }

    if ($sort == 2) {
        $query .= " ORDER BY `price` ASC";
    }

    if ($sort == 3) {
        $query .= " ORDER BY `qty` ASC";
    }

    if ($sort == 4) {
        $query .= " ORDER BY `qty` DESC";
    }

    if ($sort == 5) {
        $query .= " ORDER BY `date_and_time` DESC";
    }

    if ($sort == 6) {
        $query .= " ORDER BY `date_and_time` ASC";
    }

?>
    <!-- products -->
    <div class="col-12 mb-3 p-3">
        <div class="row ">

            <div class="col-12" id="view_area">
                <div class="row justify-content-center gap-2">

                    <?php

                    if ("0" !== $_POST["page"]) {
                        $pageno = $_POST["page"];
                    } else {
                        $pageno = 1;
                    }

                    try {
                        $product_rs = Database::search($query);
                    } catch (\Throwable $th) {
                    ?>
                        <div class=" row">
                            <div class=" col-12  text-center card">
                                <div class=" row">

                                    <div class="offset-1 col-10 text-center p-5">
                                        <div class="row justify-content-center">

                                            <h1 class=" fw-bold fs-1">An Error Occupied</h1>
                                            <a href="index.php" class=" fw-bold">Try Again</a>

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                        <?php
                        die;
                    }
                    $product_num = $product_rs->num_rows;

                    $results_per_page = 6;
                    $number_of_page = ceil($product_num / $results_per_page);

                    $page_rs = ($pageno - 1) * $results_per_page;
                    $select_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_rs . " ");
                    $select_num = $select_rs->num_rows;

                    if ($select_num >= 1) {

                        for ($i = 0; $i < $select_num; $i++) {
                            $product_data = $select_rs->fetch_assoc();

                            $img_rs = Database::search("SELECT * FROM `p_img` WHERE `product_id` = '" . $product_data["id"] . "'");
                            $img_data = $img_rs->fetch_assoc();

                        ?>

                            <!-- card -->
                            <!-- <spin> -->
                            <div class=" col-12 col-lg-2 mt-2 mb-2 border border-1 shadow-lg bg-body-tertiary rounded" style="width: 18rem;">

                                <img src="<?php echo $img_data["p_path"] ?>" class="card-img-top img-thumbnail mt-2 border-0" style="height: 300px;" />

                                <div class="card-body ms-0 m-0 ">

                                    <div class=" col-12 text-center mt-3">
                                        <a href="#" class=" col-5 btn btn-outline-danger border-3 fw-bold" onclick="addtocart(<?php echo $product_data['id']; ?>);">Add</a>
                                        <a href="<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>" class="col-5 btn btn-outline-success border-3 fw-bold">Viwe</a>
                                    </div>

                                    <div class=" col-12 text-center mt-3">
                                        <span class=" fw-bold text-decoration-none text-dark p-1 "> <?php echo $product_data["title"]; ?> </span>
                                    </div>

                                    <div class=" col-12 text-center">
                                        <span class="card-text text-danger fw-bold">Rs.<?php echo $product_data["price"]; ?>.00</span><br />

                                        <button class="col-10 btn btn-outline-light mt-3 border border-2 border-warning mb-4" onclick="addtowatchlist(<?php echo $product_data['id']; ?>);">
                                            <img src="resources/wish.svg" />
                                        </button>
                                    </div>

                                </div>
                            </div>
                            <!-- <spin> -->
                            <!-- card -->

                        <?php
                        }
                        ?>

                </div>

            </div>

        </div>
    </div>
    <!-- products -->

    </div>
    </div>

    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-lg justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if ($pageno <= 1) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="advancedSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                    } ?> aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php

                        for ($x = 1; $x <= $number_of_page; $x++) {
                            if ($x == $pageno) {
                ?>
                        <li class="page-item active">
                            <a class="page-link" onclick="advancedSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                        </li>
                    <?php
                            } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link" onclick="advancedSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                        </li>
                <?php
                            }
                        }

                ?>

                <li class="page-item">
                    <a class="page-link" <?php if ($pageno >= $number_of_page) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="advancedSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                    } ?> aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

<?php


                    } else {
?>
    <div class=" row">
        <div class=" col-12  text-center card">
            <div class=" row">

                <div class="offset-1 col-10 text-center p-5">
                    <div class="row justify-content-center">

                        <h1 class=" fw-bold fs-1">No Item Found</h1>
                        <a href="index.php" class=" fw-bold">browse items</a>

                    </div>
                </div>

            </div>

        </div>

    </div>
<?php
                    }
                } else {
                    echo ("doNothing");
                }

?>