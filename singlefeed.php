<?php
session_start();
require "conection.php";
$fid = $_GET["id"];

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home | AYUNA.lk | Enriching Age</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" href="resources/favicon.svg">
</head>

<body>

    <div class=" container-fluid">
        <div class=" row">

            <?php require "cpanal_head.php"; ?>



            <div class=" col-12 p-5 pt-3">
                <div class=" row">

                    <div class="row">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="feedbackviwe.php">Feedback viwe</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Single Feedback viwe</li>
                            </ol>
                        </nav>
                    </div>

                    <div class=" col-12 p-3">

                        <?php
                        $feed_rs = Database::search("SELECT * FROM `feedback` INNER JOIN `product` ON product.id = feedback.product_id WHERE feedback.id = '" . $fid . "'");
                        $feed_data = $feed_rs->fetch_assoc();

                        $fimg_rs = Database::search("SELECT * FROM `feed_img` WHERE `feedback_id` = '" . $fid . "'");
                        $fimg_num = $fimg_rs->num_rows;
                        $fimg_data = $fimg_rs->fetch_assoc();
                        ?>

                        <div class="col border border-2 rounded-2">
                            <label class=" form-label fw-bold fs-5 ms-1"><?php echo $feed_data["title"] ?></label>
                        </div>

                        <div class=" col-12 mt-4">
                            <form>
                                <div class="form-group">
                                    <label for="text" class=" fw-bold mb-2">feedback box</label>
                                    <textarea class="form-control" id="text" rows="10" disabled><?php echo $feed_data["text"] ?></textarea>
                                </div>
                            </form>
                        </div>

                        <div class=" col-12 mt-3" style="height: 100px;">

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1" class=" fw-bold mb-2">Image</label>
                            </div>

                            <!-- <div class=" row"> -->
                            <div class=" col-12">

                                <div class="col-12">

                                    <div class="col-12">
                                        <div class="row">

                                            <div class=" col-12 border border-primary rounded d-flex align-items-center justify-content-center mb-4">
                                                <?php

                                                if ($fimg_num == 0) {
                                                ?>
                                                    <label class=" fw-bold fs-4">No Image Adeded</label>
                                                <?php
                                                } else {
                                                ?>
                                                    <img onclick="" src="<?php echo $fimg_data["path"]; ?>" class="img-fluid p-3" id="i" style="height: 500px;" />
                                                <?php
                                                }

                                                ?>

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

    </div>
    <script src="script.js"></script>
</body>

</html>

<?php

?>