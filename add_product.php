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
        <div class=" container-fluid ">
            <div class=" row">
            <?php require "cpanal_head.php"; ?>
                <div class=" col-12 bg-secondary-subtle ">
                    <div class=" row">

                        <div class=" col-12">
                            <div class=" row">

                                <div class=" col-12 text-center">
                                    <h3 class="fw-bold p-2 rounded-2 "> Add Product</h3>
                                </div>

                            </div>
                        </div>

                        <div class=" col-12 col-lg-6 border border-1 border-black rounded-3 bg-white">
                            <!-- <div class=" row"> -->

                            <div class=" col-12 p-3">
                                <label class=" form-label fw-bold "> Product Name</label>
                                <input type="text" class=" form-control border border-1 border-black" id="pname"/>
                            </div>

                            <div class=" col-12 p-3">
                                <label class=" form-label fw-bold "> Price </label>
                                <input type="text" class=" form-control border border-1 border-black" id="price"/>
                            </div>

                            <div class=" col-12 p-3">
                                <label class=" form-label fw-bold "> Qty </label>
                                <input type="number" class=" form-control border border-1 border-black" min="1" id="qty"/>
                            </div>

                            <div class=" col-12 p-3">
                                <label class=" form-label fw-bold "> Delivery Fee </label>
                                <input type="text" class=" form-control border border-1 border-black" id="dfee"/>
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
                        <div class=" col-12 col-lg-6 border border-1 border-black rounded-3 bg-white">

                            <div class="col-12 text-center bg-secondary-subtle rounded-2">
                                <label class="form-label fw-bold fs-4">Product Description</label>
                            </div>
                            <div class="col-12">
                                <textarea cols="30" rows="19" class=" form-control" id="desc"></textarea>
                            </div>
                        </div>

                        <!-- <div class=" row"> -->
                        <div class=" col-12 border border-1 border-black rounded-3">

                            <div class="col-12 text-center">
                                <label class="form-label fw-bold fs-4">Product Images</label>
                            </div>
                        </div>

                        <!-- <div class=" row"> -->
                        <div class=" col-12 border border-1 border-black rounded-3">

                            <div class="col-12">

                                <div class=" offset-md-3 col-12 col-lg-6 p-3">
                                    <div class="row">

                                        <div class=" col-12 col-lg-4 border border-primary rounded">
                                            <img src="resources/up.png" class="img-fluid" style="width: 250px;" id="i0">
                                        </div>
                                        <div class=" col-12 col-lg-4 border border-primary rounded">
                                            <img src="resources/up.png" class="img-fluid" style="width: 250px;" id="i1">
                                        </div>
                                        <div class=" col-12 col-lg-4 border border-primary rounded">
                                            <img src="resources/up.png" class="img-fluid" style="width: 250px;" id="i2">
                                        </div>

                                        <input type="file" id="pimg" multiple hidden>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- <div class=" row"> -->
                        <div class="col-12 text-center">
                            <label class=" col-12 col-lg-4 form-label fs-5 fw-bold btn btn-info mt-2" for="pimg" onclick="changeProductImage();">Uploard Images</label>
                        </div>

                        <div class=" col-12 mt-4">
                            <button class=" col-12 btn btn-success mb-4 " onclick="addproduct();"> Add Product </button>
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