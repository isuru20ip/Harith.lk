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

        <title>Feedbackviwe | AYUNA.lk | Enriching Age</title>

        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="icon" href="resources/favicon.svg">
    </head>

    <body class="bg-success-subtle">

        <div class=" container-fluid">
            <div class=" row">

                <?php require "cpanal_head.php"; ?>

                <div class=" col-12 p-2 p-lg-5">


                    <div class="row">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="control_panel.php">Control Panel</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Feedback viwe</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="col-12 overflow-x-auto ">
                        <label class=" form-label fw-bold fs-3 "></label>

                        <table class="table table-bordered border-black fw-bolder">
                            <thead>
                                <tr>
                                    <th scope="col" class=" fs-3 text-center" colspan="4">Feedback Viwe</th>
                                </tr>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Date</th>
                                    <th class=" text-end" scope="col">Viwe</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php

                                if (isset($_GET["page"])) {
                                    $pageno = $_GET["page"];
                                } else {
                                    $pageno = 1;
                                }

                                $feed_rs = Database::search("SELECT * FROM `feedback`");
                                $feed_num = $feed_rs->num_rows;

                                $results_per_page = 10;
                                $number_of_page = ceil($feed_num / $results_per_page);

                                $page_rs = ($pageno - 1) * $results_per_page;

                                $select_rs = Database::search("SELECT * FROM `feedback` ORDER BY `date` DESC LIMIT " . $results_per_page . " OFFSET " . $page_rs . "");

                                $select_num = $select_rs->num_rows;

                                for ($i = 0; $i < $select_num; $i++) {
                                    $feed_data = $select_rs->fetch_assoc();

                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $i + 1 ?></th>
                                        <td><?php echo $feed_data["user_email"]; ?></td>
                                        <td><?php echo $feed_data["date"]; ?></td>
                                        <?php

                                        if ($feed_data["status"] == 1) {
                                        ?>
                                            <td class=" text-end"> <span class=" btn btn-secondary" onclick="viewfeed(<?php echo $feed_data['id'] ?>);">GO</span></td>



                                        <?php
                                        } else {
                                        ?>
                                            <td class=" text-end"> <span class=" btn btn-success" onclick="viewfeed(<?php echo $feed_data['id'] ?>);">GO</span></td>
                                        <?php
                                        }
                                        ?>

                                    </tr>
                                <?php
                                }

                                ?>

                            </tbody>
                        </table>

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

            </div>

        </div>
        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

    </html>

<?php
}
?>