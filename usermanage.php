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

        <title>User Manage | AYUNA.lk | Enriching Age</title>

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
                                            <label class="form-label fw-bold fs-3">Sort User</label>
                                        </div>
                                        <div class="col-11">
                                            <div class="row">

                                                <div class="col-10">
                                                    <input type="text" placeholder="Email or Phone " class="form-control" id="s" />
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
                                            <label class="form-label fw-bold">Registerd Time</label>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r1" id="new" />
                                                <label class="form-check-label" for="new">
                                                    Newest to oldest
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r1" id="old" />
                                                <label class="form-check-label" for="old">
                                                    Oldest to newest
                                                </label>
                                            </div>
                                        </div>


                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">Status</label>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r3" id="all">
                                                <label class="form-check-label" for="all">
                                                    All
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r3" id="active">
                                                <label class="form-check-label" for="active">
                                                    Active
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r3" id="blocked" />
                                                <label class="form-check-label" for="blocked">
                                                    Blocked
                                                </label>
                                            </div>
                                        </div>


                                        <div class="col-12 text-center mt-3 mb-3">
                                            <div class="row g-2">
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <button class="btn btn-primary fw-bold" onclick="usort(0);">Sort</button>
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
                                            <li class="breadcrumb-item active fw-bold" aria-current="page">User Manage</li>
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

                                        $user_rs = Database::search("SELECT * FROM `user`");
                                        $user_num = $user_rs->num_rows;

                                        $results_per_page = 3;
                                        $number_of_page = ceil($user_num / $results_per_page);

                                        $page_rs = ($pageno - 1) * $results_per_page;
                                        $select_rs = Database::search("SELECT * FROM `user` ORDER BY `join_date` DESC LIMIT " . $results_per_page . " OFFSET " . $page_rs . " ");

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

                                                    <div class="col-12 text-center mt-3 text-bg-info">
                                                        <span class=" fw-bold text-dark p-1 "><?php echo $user_data["email"]; ?></span>
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