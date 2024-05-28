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

        <title>product-add | AYUNA.lk | Enriching Age</title>

        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="icon" href="resources/favicon.svg">
    </head>

    <body>
        <div class=" container-fluid bg-success-subtle">
            <div class=" row">

                <?php require "cpanal_head.php"; ?>

                <div class=" col-10 mt-5 mb-0 ms-lg-3">
                    <div class="row">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="control_panel.php">Control Panel</a></li>
                                <li class="breadcrumb-item active fw-bold" aria-current="page">Add Product</li>
                            </ol>
                        </nav>
                    </div>
                </div>


                <div class="col-12 col-lg-10 offset-lg-1 card mb-5 mt-0 shadow shadow-lg border-black">
                    <div class=" row">

                        <div class=" col-12 text-center">
                            <h3 class="fw-bold p-2"> Add Product</h3>
                        </div>

                        <div class="col-12 col-lg-6 border-black border-end border-top border-bottom">
                            <!-- <div class=" row"> -->

                            <div class=" col-12 p-3">
                                <label class=" form-label fw-bold "> Product Name</label>
                                <input type="text" class=" form-control border border-1 border-black" id="pname" />
                            </div>

                            <div class=" col-12 p-3">
                                <label class=" form-label fw-bold "> Price </label>
                                <input type="text" class=" form-control border border-1 border-black" id="price" />
                            </div>

                            <div class=" col-12 p-3">
                                <label class=" form-label fw-bold "> Qty </label>
                                <input type="number" class=" form-control border border-1 border-black" min="1" id="qty" />
                            </div>

                            <div class=" col-12 p-3">
                                <label class=" form-label fw-bold "> Delivery Fee </label>
                                <input type="text" class=" form-control border border-1 border-black" id="dfee" />
                            </div>

                            <div class=" col-12 p-3">
                                <label class=" form-label fw-bold"> Product Category </label>

                                <div class="col-12">
                                    <select id="pcat" class=" form-select border border-1 border-black text-black">
                                        <option value="4">Select Category</option>

                                        <?php
                                        $cat_rs = Database::search("SELECT * FROM `category`");
                                        $cat_num = $cat_rs->num_rows;

                                        for ($i = 0; $i < $cat_num; $i++) {
                                            $cat_data = $cat_rs->fetch_assoc();

                                        ?>
                                            <option value="<?php echo $cat_data["id"]; ?>"><?php echo $cat_data["category_name"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                        </div>

                        <!-- <div class=" row"> -->
                        <div class="col-12 col-lg-6 p-3 border-top border-bottom border-black">
                            <label class="form-label fw-bold fs-4 ">Product Description</label>
                            <div class="col-12 pb-3">
                                <textarea cols="30" rows="19" class=" form-control" id="desc"></textarea>
                            </div>
                        </div>

                        <!-- <div class=" row"> -->
                        <div class=" col-12 p-3">

                            <label class="form-label fw-bold fs-4">Product Images</label>

                            <!-- <div class=" row"> -->
                            <div class=" col-12 border border-black d-flex justify-content-center">
                                <div class=" row">
                                    <div class=" col border">
                                        <label for="pimg"><img src="resources/up.png" style="width: 250px; height: 250px; cursor:pointer" id="i0" onclick="changeProductImage();"></label>
                                    </div>
                                    <div class=" col border">
                                        <label for="pimg"><img src="resources/up.png" style="width: 250px; height: 250px; cursor:pointer" id="i1" onclick="changeProductImage();"></label>
                                    </div>
                                    <div class=" col border">
                                        <label for="pimg"><img src="resources/up.png" style="width: 250px; height: 250px; cursor:pointer" id="i2" onclick="changeProductImage();"></label>
                                    </div>
                                </div>

                                <input type="file" id="pimg" multiple hidden>
                            </div>

                        </div>

                        <div class=" col-12 d-flex justify-content-end mb-3">
                            <button class="btn btn-success" onclick="addproduct();"> Add Product </button>
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
} else {
    # code...
}



?>