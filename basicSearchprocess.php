<?php

require "conection.php";

$text = $_POST["text"];
$cat = $_POST["cat"];

if (!empty($text) || $cat != 0) {
    $query = "SELECT * FROM `product` ";

    if (empty($text) && ($cat) !== 0) {

        $query .= " WHERE `category_id` = '" . $cat . "'";
    } elseif (!empty($text) && ($cat) == 0) {

        $query .= "WHERE `title` LIKE '%" . $text . "%' ";
    } elseif (!empty($text) && ($cat) !== 0) {

        $query .= "WHERE `title` LIKE '%" . $text . "%' AND `category_id` = '" . $cat . "' ";
    }

    if ("0" !== $_POST["page"]) {
        $pageno = $_POST["page"];
    } else {
        $pageno = 1;
    }

    $product_rs = Database::search($query);
    $product_num = $product_rs->num_rows;

    $results_per_page = 6;
    $number_of_page = ceil($product_num / $results_per_page);

    $page_rs = ($pageno - 1) * $results_per_page;
    $select_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_rs . " ");

    $select_num = $select_rs->num_rows;

    if ($select_num >= 1) {
?>
        <div class=" row">
            <div class=" offset-lg-1 col-12 col-lg-10 text-center">
                <div class=" row">

                    <div class="offset-1 col-10 text-center">
                        <div class="row justify-content-center">

                            <?php

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

                                            <button class="col-10 btn btn-outline-light mt-3 border border-2 border-warning" onclick="addtowatchlist(<?php echo $product_data['id']; ?>);">
                                                                    <?php
                                                                    $wishRs = Database::search("SELECT * FROM `watchlist` WHERE watchlist.product_id = '" . $product_data["id"] . "' AND watchlist.user_email = '" . $_SESSION["user"]["email"] . "' ");
                                                                    $wishNum = $wishRs->num_rows;
                                                                    if ($wishNum == 1) {
                                                                    ?>
                                                                        <img src="resources/wish.svg" />
                                                                    <?php
                                                                    }else{
                                                                        ?>
                                                                        <img src="resources/watchlistEmptyView.svg" style="height: 30px;"/>
                                                                    <?php
                                                                    }
                                                                    ?>

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

                    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-lg justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" <?php if ($pageno <= 1) {
                                                                echo ("#");
                                                            } else {
                                                            ?> onclick="basicSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                                } ?> aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <?php

                                for ($x = 1; $x <= $number_of_page; $x++) {
                                    if ($x == $pageno) {
                                ?>
                                        <li class="page-item active">
                                            <a class="page-link" onclick="basicSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                                        </li>
                                    <?php
                                    } else {
                                    ?>
                                        <li class="page-item">
                                            <a class="page-link" onclick="basicSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                                        </li>
                                <?php
                                    }
                                }

                                ?>

                                <li class="page-item">
                                    <a class="page-link" <?php if ($pageno >= $number_of_page) {
                                                                echo ("#");
                                                            } else {
                                                            ?> onclick="basicSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                                } ?> aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>

            </div>

        </div>
    <?php
    } else {
    ?>
        <div class=" row">
            <div class=" offset-lg-1 col-12 col-lg-10 text-center card">
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
    ?>

<?php
} else {
    echo ("doNothing");
}
?>