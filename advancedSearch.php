<?php
session_start();
require "conection.php";
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Advanced Search | Haritha.lk | Enriching Age</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" href="resources/favicon.svg">
</head>

<body>


    <div class=" container-fluid abg">
        <div class=" row">
            <?php require "header.php"; ?>

            <div class=" col-12 ">
                <div class=" row">

                    <div class=" col-12 text-center text-bg-light border border-black rounded-bottom-5">
                        <label class=" fs-1 fw-bold ">ADVANCED SEARCH</label>
                    </div>

                    <div class=" col-12 col-lg-8 mt-3">
                        <div class=" row g-2">


                            <div class=" col-12 offset-lg-3 rounded-4 border border-black bg-secondary-subtle">
                                <div class=" row g-2">

                                    <div class=" col-12 col-lg-4 p-2 p-lg-3">
                                        <input type="text" class=" form-control" placeholder="Price From..." id="pf">
                                    </div>

                                    <div class=" col-12 col-lg-4 p-2 p-lg-3">
                                        <input type="text" class=" form-control" placeholder="Price to..." id="ft">
                                    </div>

                                    <div class=" col-12 col-lg-4 p-2 p-lg-3">
                                        <select id="cat" class=" form-select">
                                            <option value="0">Selcet Categoty</option>

                                            <?php
                                            $cat = Database::search("SELECT * FROM `category`");
                                            $cat_num = $cat->num_rows;

                                            for ($i = 0; $i < $cat_num; $i++) {
                                                $cat_data = $cat->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $cat_data["id"]; ?>"><?php echo $cat_data["category_name"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class=" col-12 my-2 p-2 p-lg-3">
                                        <div class=" input-group">
                                            <input type="text" class=" form-control" id="key" placeholder="Type keyword to search..." />
                                            <button class=" btn btn-primary" onclick="advancedSearch(0);">SEARCH</button>
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class=" col-12 offset-lg-3 rounded-4 border border-black bg-secondary-subtle ">
                                <div class=" row g-2">

                                    <div class=" col-12 col-lg-4 offset-lg-8 p-3">
                                        <select id="s" class=" form-select" onchange="advancedSearch(0);">
                                            <option value="0">SHORT BY</option>
                                            <option value="1">HIGH TO LOW</option>
                                            <option value="2">LOW TO HIGH</option>
                                            <option value="3">QTY LOW TO HIGH </option>
                                            <option value="4">QTY HIGH TO LOW</option>
                                        </select>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="offset-lg-2 col-12 col-lg-8 bg-body rounded mb-3 mt-4">
                        <div class="row">

                            <div class=" col-12 text-center">
                                <div class="row" id="view_area">

                                    <div class="offset-5 col-2 mt-5">
                                        <span class="fw-bold text-black-50"><i class="bi bi-search h1" style="font-size: 100px;"></i></span>
                                    </div>
                                    <div class="offset-3 col-6 mt-3 mb-5">
                                        <span class="h1 text-black-50 fw-bold">No Items Searched Yet...</span>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <?php require "footer.php"; ?>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>