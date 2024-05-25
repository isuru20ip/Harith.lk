<?php
require "conection.php";
$cat = $_GET["cat"];
$catData = Database::search("SELECT `category_name` FROM `category` WHERE `id` = '".$cat."'");
$name = $catData->fetch_assoc();
?>

<div class=" col-12 ms-3 fw-bold fs-6 mt-0 mb-2" id="path">
    <span><a href="index.php" class=" text-decoration-none">Home</a></span> <!-- --> <span> > <?php echo $name["category_name"];  ?> </span>
</div>
<!-- products -->
<div class="col-12 mb-3 p-3 border border-black">
    <div class="row ">

        <div class="col-12" id="view_area">
            <div class="row justify-content-center gap-2">

                <?php
                $select_rs = Database::search("SELECT * FROM `product` WHERE `category_id` = '" . $cat . "' ");
                $select_num = $select_rs->num_rows;
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

                                <button class="col-10 btn btn-outline-light mt-3 border border-2 border-warning mb-4" onclick="addtowatchlist(<?php echo $product_data['id']; ?>);" >
                                    <img src="resources/wish.svg" />
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

    </div>
</div>
<!-- products -->

</div>
</div>