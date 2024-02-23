<?php
session_start();
require "conection.php";

if (isset($_SESSION["admin"])) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Order View | Haritha.lk | Enriching Age</title>

        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="icon" href="resources/favicon.svg">
    </head>

    <body class=" bg-black">

        <div class=" container-fluid bg-black">
            <div class=" row">

                <?php require "cpanal_head.php";
                $st = $_GET["st"];
                ?>

                <div class=" col-12 p-5 pt-2">
                    <div class=" row">

                        <div class="row">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class=""><a href="control_panel.php">Control Panel </a></li>
                                    <li class=" ms-1 text-white" aria-current="page"> \ Pending Order</li>
                                </ol>
                            </nav>
                        </div>

                        <div class=" col-12 border border-1 border-black rounded-top-3 border-bottom-0">
                            <div class=" row">

                                <div class=" col-12 text-center text-bg-primary rounded-3 rounded-bottom-0 text-black p-2 pb-1">
                                    <label class=" form-label fw-bold fs-3 ">

                                        <?php
                                        if ($st == 0) {
                                        ?>Pending<?php
                                            } elseif ($st == 1) {
                                                ?>accepted<?php
                                                } elseif ($st == 2) {
                                                    ?>delivered<?php
                                                } elseif ($st == 3) {
                                                    ?>canceled<?php
                                                }
                                                    ?>
                                         Order
                                    </label>

                                </div>

                            </div>

                        </div>

                        <div class=" col-12 border border-1 border-black rounded-bottom-3 p-3 bg-body-secondary">
                            <div class=" row">

                                <div class="col-12">
                                    <div class=" col-12 card p-3">
                                        <div class=" row">

                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Order ID</th>
                                                        <th scope="col">User</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Actions</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    <?php


                                                    if (isset($_GET["page"])) {
                                                        $pageno = $_GET["page"];
                                                    } else {
                                                        $pageno = 1;
                                                    }

                                                    $order_rs = Database::search("SELECT DISTINCT `order_id` FROM `invoice` WHERE `status` = '" . $st . "' ");
                                                    $order_num = $order_rs->num_rows;


                                                    $results_per_page = 5;
                                                    $number_of_page = ceil($order_num / $results_per_page);

                                                    $page_rs = ($pageno - 1) * $results_per_page;

                                                    $select_rs = Database::search("SELECT DISTINCT `order_id`, `user_email`, `date` FROM `invoice` WHERE `status` = '" . $st . "' ORDER BY `date` LIMIT " . $results_per_page . " OFFSET " . $page_rs . "");

                                                    $select_num = $select_rs->num_rows;

                                                    for ($i = 0; $i < $select_num; $i++) {
                                                        $order_data = $select_rs->fetch_assoc();

                                                        $date = date("Y-m-d", strtotime($order_data["date"]));

                                                    ?>
                                                        <tr>
                                                            <th scope="row"><?php echo $i + 1 ?></th>
                                                            <td><?php echo $order_data["order_id"]; ?></td>
                                                            <td><?php echo $order_data["user_email"]; ?></td>
                                                            <td><?php echo $date ?></td>
                                                            <td> <a href='single.order.view.php?id=<?php echo $order_data["order_id"]; ?>' class="fw-bold">View</a></td>

                                                        </tr>
                                                    <?php
                                                    }

                                                    ?>

                                                </tbody>
                                            </table>

                                            <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center">
                                                <nav aria-label="Page navigation example">
                                                    <ul class="pagination pagination-lg justify-content-center">
                                                        <li class="page-item">
                                                            <a class="page-link" href="
                                                <?php if ($pageno <= 1) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno - 1) . "&st=" . $st;
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
                                                                    <a class="page-link" href="<?php echo "?page=" . ($y) . "&st=" . $st; ?>"><?php echo $y; ?></a>
                                                                </li>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <li class="page-item">
                                                                    <a class="page-link" href="<?php echo "?page=" . ($y) . "&st=" . $st;; ?>"><?php echo $y; ?></a>
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
                                                    echo "?page=" . ($pageno + 1) . "&st=" . $st;
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
                                </div>

                            </div>

                        </div>


                    </div>

                </div>

            </div>

        </div>
        <script src="script.js"></script>
    </body>

    </html>

<?php
}
?>