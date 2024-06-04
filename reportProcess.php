<?php

use function PHPSTORM_META\type;

session_start();
if (isset($_SESSION["admin"]) && isset($_GET["reportType"])) {
    require "conection.php";
    $type = $_GET["reportType"];
    $report = $_GET["report"];

    $today = date("Y-m-d");
    $thisMonth = date("Y-m");
    $thisyear = date("Y");

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Report</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="icon" href="resources/favicon.svg">
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f8f9fa;
            }

            .table thead th {
                background-color: #343a40;
                color: #fff;
            }

            .table tbody td {
                vertical-align: middle;
            }

            .table-bordered th,
            .table-bordered td {
                border: 1px solid #dee2e6;
            }

            .table thead th {
                border-bottom: 2px solid #dee2e6;
            }

            .highlight-row {
                background-color: #e9ecef;
            }

            .header-title {
                background-color: #007bff;
                color: white;
            }
        </style>
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12 p-5">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="6" class="fs-3 text-center header-title">
                                    <?php
                                    if ($report == 'SellesReportType') {
                                        if ($type == 's1') {
                                            echo ('Daily sales Report');
                                        } elseif ($type == 's2') {
                                            echo ('Monthly sales Report');
                                        } elseif ($type == 's3') {
                                            echo ('Annual sales Report');
                                        }
                                    } elseif ($report == 'ProductReportType') {
                                        echo ('Product Report');
                                    } elseif ($report = 'userReport') {
                                        if ($type == 'u1') {
                                            echo ('User details Report');
                                        } elseif ($type == 'u2') {
                                            echo ('User Activity Report');
                                        }
                                    }
                                    ?>
                                </th>
                            </tr>
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 20%;">
                                    <?php
                                    if ($report == 'SellesReportType') {
                                        echo ('Product ID');
                                    } elseif ($report == 'ProductReportType') {
                                        echo ('Product Name & Id');
                                    } elseif ($report = 'userReport') {
                                        if ($type == 'u1') {
                                            echo ("emal & phone");
                                        } elseif ($type == 'u2') {
                                            echo ("email");
                                        }
                                    }
                                    ?>
                                </th>

                                <th style="width: 20%;">
                                    <?php
                                    if ($report == 'SellesReportType') {
                                        echo ('Product Name');
                                    } elseif ($report == 'ProductReportType') {
                                        echo ('Category Name');
                                    } elseif ($report = 'userReport') {
                                        if ($type == 'u1') {
                                            echo ("Name");
                                        } elseif ($type == 'u2') {
                                            echo ("Purchased qty");
                                        }
                                    }
                                    ?>
                                </th>

                                <th style="width: 20%;">
                                    <?php
                                    if ($report == 'SellesReportType') {
                                        echo ('Unit Price');
                                    } elseif ($report == 'ProductReportType') {
                                        echo ('Unit Price');
                                    } elseif ($report = 'userReport') {
                                        if ($type == 'u1') {
                                            echo ("Address");
                                        } elseif ($type == 'u2') {
                                            echo ("income");
                                        }
                                    }
                                    ?>
                                </th>

                                <th style="width: 20%;">
                                    <?php
                                    if ($report == 'SellesReportType') {
                                        echo ('qty');
                                    } elseif ($report == 'ProductReportType') {
                                        echo ('Stock');
                                    } elseif ($report = 'userReport') {
                                        if ($type == 'u1') {
                                            echo ("Joined Date");
                                        } elseif ($type == 'u2') {
                                            echo ("fav Category");
                                        }
                                    }
                                    ?>
                                </th>

                                <th style="width: 20%;">
                                    <?php
                                    if ($report == 'SellesReportType') {
                                        echo ('Amount');
                                    } elseif ($report == 'ProductReportType') {
                                        echo ('Selles');
                                    } elseif ($report = 'userReport') {
                                        if ($type == 'u1') {
                                            echo ("Status");
                                        } elseif ($type == 'u2') {
                                            echo ("fav Product");
                                        }
                                    }
                                    ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($report == 'SellesReportType') {

                                if ($type == 's1') {
                                    $date = $today;
                                    $fomat = '%Y-%m-%d';
                                    
                                } elseif ($type == 's2') {
                                    $date = $thisMonth;
                                    $fomat = '%Y-%m';
                                } elseif ($type == 's3') {
                                    $date = $thisyear;
                                    $fomat = '%Y';
                                }

                                $Sell_rs = Database::search("SELECT
                                   invoice.product_id,
                                   product.title,
                                   product.price,
                                   SUM(invoice.iqty) AS total_qty,
                                   SUM(invoice.total) AS total_amount
                                    FROM
                                   `invoice`
                                    INNER JOIN
                                   `product` ON product.id = invoice.product_id
                                   WHERE invoice.status = '2' AND 
                                   DATE_FORMAT(invoice.date, '" . $fomat . "') = '" . $date . "'
                                    GROUP BY
                                   invoice.product_id, product.title, product.price;");

                                $total_income = 0;
                                $total_item_sells = 0;

                                $Sell_num = $Sell_rs->num_rows;
                                for ($i = 0; $i < $Sell_num; $i++) {
                                    $dailySell_data = $Sell_rs->fetch_assoc();

                                    $total_income = ($total_income + $dailySell_data["total_amount"]);
                                    $total_item_sells = ($total_item_sells + $dailySell_data["total_qty"]);
                            ?>
                                    <tr>
                                        <td><?php echo $i + 1 ?></td>
                                        <td><?php echo $dailySell_data["product_id"]; ?></td>
                                        <td><?php echo $dailySell_data["title"]; ?></td>
                                        <td>Rs: <?php echo (number_format($dailySell_data["price"]))  ?></td>
                                        <td><?php echo (number_format($dailySell_data["total_qty"])) ?></td>
                                        <td>Rs:<?php echo (number_format($dailySell_data["total_amount"])) ?></td>
                                    </tr>
                                <?php
                                }

                                ?>
                                <tr>

                                    <td colspan="4">Summary</td>
                                    <td>Items: <?php echo number_format($total_item_sells) ?> sold</td>
                                    <td>Rs: <?php echo number_format($total_income) ?> </td>
                                </tr>
                                <?php
                            } elseif ($report == 'ProductReportType') {
                                $query = 'SELECT * FROM `product`';
                                if ($type != 0) {
                                    $query .= "WHERE `category_id` = '" . $type . "'";
                                }
                                $productReport_rs = Database::search($query);
                                $productReport_num = $productReport_rs->num_rows;

                                if ($productReport_num == 0) {
                                ?>
                                    <tr>
                                        <td colspan="6" class=" fw-bold text-center fs-2">No Product Yet </td>
                                    </tr>
                                <?php
                                }

                                for ($i = 0; $i < $productReport_num; $i++) {
                                    $productReport_data = $productReport_rs->fetch_assoc();
                                    $ptsells = Database::search("SELECT SUM(`iqty`) AS tsell FROM `invoice` WHERE invoice.status = '2' AND invoice.product_id = " . $productReport_data["id"] . "");
                                    $ptsells_data = $ptsells->fetch_assoc();
                                    $pcat = Database::search("SELECT `category_name` FROM `category` WHERE `id` ='" . $productReport_data["category_id"] . "'");
                                    $pcat_data = $pcat->fetch_assoc();

                                ?>

                                    <tr>
                                        <td><?php echo $i + 1 ?></td>
                                        <td><?php echo $productReport_data["title"] ?> <br> (Pid : <?php echo $productReport_data["id"] ?>)</td>
                                        <td><?php echo $pcat_data["category_name"] ?></td>
                                        <td>Rs: <?php echo number_format($productReport_data["price"]) ?></td>
                                        <td>Items: <?php echo number_format($productReport_data["qty"]) ?></td>
                                        <td>Items: <?php echo number_format($ptsells_data["tsell"]) ?></td>
                                    </tr>

                                    <?php
                                }
                            } elseif ($report == 'userReport') {

                                $userD_rs = Database::search("SELECT * FROM `user`");
                                $userD_num = $userD_rs->num_rows;
                                for ($i = 0; $i < $userD_num; $i++) {
                                    $userD_data = $userD_rs->fetch_assoc();

                                    if ($type == 'u1') {
                                        $address = Database::search("SELECT address.line_1,address.line_2,city.city_name,district.district_name FROM `address`
                                            INNER JOIN `city` ON city.city_id = address.city_id
                                            INNER JOIN `district` ON district.district_id = city.district_id
                                            WHERE address.user_email = '" . $userD_data["email"] . "'");
                                        $address_data = $address->fetch_assoc();
                                        $address_num = $address->num_rows;

                                        $line1U = "No Address added";
                                        $line2U = "";
                                        $cityU = "";
                                        $districtU = "";

                                        if ($address_num >= 1) {
                                            $line1U = $address_data["line_1"];
                                            $line2U = $address_data["line_2"];
                                            $cityU = $address_data["city_name"];
                                            $districtU = $address_data["district_name"];
                                        }

                                    ?>
                                        <tr>
                                            <td><?php echo $i + 1 ?></td>
                                            <td> <?php echo $userD_data["email"]; ?><br><?php echo $userD_data["contact_no"]; ?></td>
                                            <td>
                                                <?php echo $userD_data["fname"]; ?>
                                                <?php echo $userD_data["lname"]; ?>
                                                <br>
                                                <?php
                                                if ($userD_data["user_type_id"] == 1) {

                                                ?>( <?php echo ("Admin") ?> )<?php
                                                                            } ?>
                                            </td>
                                            <td><?php echo $line1U ?> <?php echo $line2U ?> <br> <?php echo $cityU ?> <br> <?php echo $districtU ?></td>
                                            <td><?php echo $userD_data["join_date"]; ?></td>
                                            <td>
                                                <?php if ($userD_data["status"] == 1) {
                                                    echo ("Active");
                                                } else {
                                                    echo ("Inative");
                                                } ?>
                                            </td>
                                        </tr>
                                    <?php
                                    } elseif ($type == 'u2') {
                                        $uact_rs = Database::search("SELECT SUM(`iqty`) AS tqty , SUM(`total`) AS tp  FROM `invoice` WHERE invoice.status = '2' AND invoice.user_email = '" . $userD_data["email"] . "'");
                                        $uact_data = $uact_rs->fetch_assoc();

                                        $mp_rs = Database::search("SELECT product.title,category.category_name, product_id,SUM(`iqty`) AS tq FROM invoice
                                        INNER JOIN product ON invoice.product_id = product.id
                                        INNER JOIN category ON category.id = product.category_id
                                         WHERE invoice.user_email ='" . $userD_data["email"] . "' GROUP BY product_id ORDER BY `tq` DESC LIMIT 1");
                                        $mp_num = $mp_rs->num_rows;
                                        $mp_data = $mp_rs->fetch_assoc();
                                        $fcat = 'No Item Found';
                                        $fp = 'No Item Found';

                                        if ($mp_num >= 1) {
                                            $fcat = $mp_data["category_name"];
                                            $fp =  $mp_data["title"];
                                        }

                                    ?>
                                        <tr>
                                            <td><?php echo $i + 1 ?></td>
                                            <td> <?php echo $userD_data["email"]; ?></td>
                                            <td><?php echo number_format($uact_data["tqty"]) ?> Items</td>
                                            <td>Rs: <?php echo number_format( $uact_data["tp"]) ?></td>
                                            <td><?php echo $fcat ?></td>
                                            <td><?php echo $fp ?></td>
                                        </tr>
                            <?php
                                    }
                                }
                            }
                            ?>
                            <!-- <tr>
                                <td>test</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>$100</td>
                                <td>50</td>
                                <td>$5000</td>
                            </tr> -->
                            <tr class="highlight-row">
                                <td colspan="3">Generated Date: <?php echo $today ?></td>
                                <td colspan="3">Admin: <?php echo $_SESSION["admin"]["user_email"] ?></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </body>

    </html>

<?php

} else {
    echo ("Unauthorized Access");
}

?>