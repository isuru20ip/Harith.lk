<?php
session_start();
require "conection.php";
$qid = $_GET["id"];


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

            <?php require "header.php";
            if (isset($_SESSION["user"])) {
            ?>

                <div class=" col-12 p-3 p-md-5 pt-3">
                    <div class=" row">

                        <div class=" col-12 col-lg-6 offset-lg-3 card p-3 shadow shadow-lg">

                            <div class=" col-12 text-center fw-bold fs-2">
                                <label class=" form-label">feedback</label>
                            </div>

                            <div class=" col-12">

                                <select class=" form-select fw-bold" id="pid">
                                    <option value="0">Select Product</option>
                                    <?php
                                    $prs = Database::search("SELECT DISTINCT `product_id`,`title` FROM `invoice` INNER JOIN `product` ON product.id = invoice.product_id WHERE `order_id` = '" . $qid . "' ");

                                    $p_num = $prs->num_rows;
                                    for ($i = 0; $i < $p_num; $i++) {
                                        $p_data = $prs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $p_data["product_id"]; ?>"><?php echo $p_data["title"]; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>

                            </div>

                            <div class=" col-12 mt-4">
                                <form>
                                    <div class="form-group">
                                        <label for="text" class=" fw-bold mb-2">Write your feedback here</label>
                                        <textarea class="form-control" id="text" rows="10" placeholder="your feedback......."></textarea>
                                    </div>
                                </form>
                            </div>

                            <div class=" col-12 mt-3">

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1" class=" fw-bold mb-2">Image</label>
                                </div>

                                <!-- <div class=" row"> -->
                                <div class=" col-12 d-flex justify-content-center">

                                    <label for="pimg">
                                        <img src="resources/up.png" class="img-fluid" style="width: 250px; cursor: pointer;" id="i0" onclick="changeProductImage();" />
                                    </label>

                                    <input type="file" id="pimg" hidden>
                                </div>

                            </div>

                            <div class="col-12 text-end">
                                <label class="form-label fw-bold btn btn-warning mt-2" onclick="sendfeedback();">Send Feedback</label>
                            </div>

                        </div>

                    </div>

                </div>

            <?php
            } else {
            ?>
                <div class=" col-12 text-center p-5 m-5">

                    <a class=" btn btn-success col-3 text-decoration-none" href="Log_in.php">
                        <h1 class=" text-warning"> Login or Register</h1>
                    </a>
                </div>
            <?php
            }
            require "footer.php";
            ?>

        </div>
    </div>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>