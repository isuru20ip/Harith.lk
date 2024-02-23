<?php
session_start();
require "conection.php";

if ($_SESSION["admin"]) {

    $search = $_POST["s"];
    $time = $_POST["t"];
    $price = $_POST["p"];
    $cat = $_POST["c"];

    $query = "SELECT * FROM `product`";

    if (!empty($search)) {
        $query .= " WHERE `title` LIKE '%" . $search . "%'";

        if ($cat != "0") {
            $query .= " AND `category_id` = '" . $cat . "'";
        }
    } else {
        if ($cat != "0") {
            $query .= " WHERE `category_id`='" . $cat . "'";
        }
    }



    if ($time !== "0") {

        if ($time == "1") {
            $query .= " ORDER BY `date_and_time` DESC";
        } else if ($time == "2") {
            $query .= " ORDER BY `date_and_time` ASC";
        }
    } else {

        if ($price == "1") {
            $query .= " ORDER BY `price` DESC";
        } else if ($price == "2") {
            $query .= " ORDER BY `price` ASC";
        }
    }
}

?>

<div class="offset-1 col-10 text-center">
    <div class="row justify-content-center">

        <?php

        if ("0" !== $_POST["page"]) {
            $pageno = $_POST["page"];
        } else {
            $pageno = 1;
        }

        $product_rs = Database::search($query);
        $product_num = $product_rs->num_rows;

        $results_per_page = 3;
        $number_of_page = ceil($product_num / $results_per_page);

        $page_rs = ($pageno - 1) * $results_per_page;
        $select_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_rs . " ");

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

<div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item">
                <a class="page-link" <?php if ($pageno <= 1) {
                                            echo ("#");
                                        } else {
                                        ?> onclick="sort(<?php echo ($pageno - 1) ?>);" <?php
                                                                                    } ?> aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php

            for ($x = 1; $x <= $number_of_page; $x++) {
                if ($x == $pageno) {
            ?>
                    <li class="page-item active">
                        <a class="page-link" onclick="sort(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="page-item">
                        <a class="page-link" onclick="sort(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                    </li>
            <?php
                }
            }

            ?>

            <li class="page-item">
                <a class="page-link" <?php if ($pageno >= $number_of_page) {
                                            echo ("#");
                                        } else {
                                        ?> onclick="sort(<?php echo ($pageno + 1) ?>);" <?php
                                                                                    } ?> aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>