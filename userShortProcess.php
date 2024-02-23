<?php
session_start();
require "conection.php";

if ($_SESSION["admin"]) {

    $text = $_POST["txt"];
    $time = $_POST["tim"];
    // $qty = $_POST["qty"];
    $status = $_POST["st"];

    $query = "SELECT * FROM `user`";

    if (!empty($text)) {
        $query .= " WHERE `email` = '" . $text . "' OR `contact_no` = '" . $text . "'";
    } else {


        if (!empty($status)) {
            if ($status == 2) {
                $query .= " WHERE `status` = '1'";
            } elseif ($status == 3) {
                $query .= " WHERE `status` = '2'";
            }
        }

        if (!empty($time)) {
            $line = 1;
            if ($time == 1) {
                $query .= " ORDER BY `join_date` DESC";
            } elseif ($time == 2) {
                $query .= " ORDER BY `join_date` ASC";
            }
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

        $user_rs = Database::search($query);
        $user_num = $user_rs->num_rows;

        $results_per_page = 2;

        $number_of_page = ceil($user_num / $results_per_page);

        $page_rs = ($pageno - 1) * $results_per_page;
        $select_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_rs . " ");

        $select_num = $select_rs->num_rows;

        for ($i = 0; $i < $select_num; $i++) {
            $user_data = $select_rs->fetch_assoc();

        ?>

            <!-- card -->
            <div class=" col-12 col-lg-2 mt-2 mb-2 border border-1 shadow-lg bg-body-tertiary rounded mx-2" style="width: 18rem;">

                <?php
                $img_rs = Database::search("SELECT * FROM `user_img` WHERE `user_email` = '" . $user_data["email"] . "'");
                $img_num = $img_rs->num_rows;
                $img_data = $img_rs->fetch_assoc();

                if ($img_num == 1) {
                ?>
                    <img src="<?php echo $img_data["path"]; ?>" class="card-img-top img-thumbnail mt-2 border-0" style="height: 300px;" />
                <?php
                } else {
                ?>
                    <img src="resources/user.svg" class="card-img-top img-thumbnail mt-2 border-0" style="height: 300px;" />
                <?php
                }
                ?>

                <div class="card-body p-3">

                    <div class=" col-12 text-center mt-3 p-1 border border-1 border-primary rounded-5 text-bg-info">
                        <span class=" fw-bold fs-5 text-dark p-1 "><?php echo $user_data["email"]; ?></span>
                    </div>

                    <div class=" col-12 text-start ms-4 mt-1">
                        <span class=" fw-bold text-decoration-none text-dark p-1 ">Phone- <?php echo $user_data["contact_no"]; ?></span>
                    </div>

                    <div class=" col-12 text-start ms-4 mt-1">
                        <span class=" fw-bold text-decoration-none text-dark p-1 ">Join Date- <?php echo $user_data["join_date"]; ?></span>
                    </div>

                    <div class=" col-12 text-center mt-1">

                        <?php
                        if ($user_data["status"] == 2) {
                        ?>
                            <span class=" fw-bold text-decoration-none text-danger fs-6 p-1 ">Blocked</span>
                        <?php
                        } else {
                        ?>
                            <span class=" fw-bold text-decoration-none text-success fs-6 p-1 ">Active</span>
                        <?php
                        }
                        ?>

                    </div>

                    <div class=" col-12 text-center mt-3">
                        <a href="singleuser.php?e=<?php echo urlencode($user_data['email']); ?>" class=" col-12 btn btn-outline-warning border-3 fw-bold text-black">View</a>
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
                <a class="page-link" <?php if ($pageno <= 1) {
                                            echo ("#");
                                        } else {
                                        ?> onclick="usort(<?php echo ($pageno - 1) ?>);" <?php
                                                                                        } ?> aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>


            <?php

            for ($y = 1; $y <= $number_of_page; $y++) {
                if ($y == $pageno) {
            ?>
                    <li class="page-item active">
                        <a class="page-link" onclick="usort(<?php echo ($y) ?>);"><?php echo $y; ?></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="page-item">
                        <a class="page-link" onclick="usort(<?php echo ($y) ?>);"><?php echo $y; ?></a>
                    </li>
            <?php
                }
            }

            ?>


            <li class="page-item">
                <a class="page-link" <?php if ($pageno >= $number_of_page) {
                                            echo ("#");
                                        } else {
                                        ?> onclick="usort(<?php echo ($pageno + 1) ?>);" <?php
                                                                                        } ?> aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>


<!-- product -->