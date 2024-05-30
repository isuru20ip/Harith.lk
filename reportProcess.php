<?php
session_start();
if (isset($_SESSION["admin"])) {

    require "conection.php";

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Report</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
                                <th colspan="6" class="fs-3 text-center header-title">Title Report</th>
                            </tr>
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 20%;">Product Name</th>
                                <th style="width: 15%;">Product ID</th>
                                <th style="width: 20%;">Unit Price</th>
                                <th style="width: 20%;">Sold QTY</th>
                                <th style="width: 20%;">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>$100</td>
                                <td>50</td>
                                <td>$5000</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>$150</td>
                                <td>30</td>
                                <td>$4500</td>
                            </tr>
                            <tr class="highlight-row">
                                <td colspan="3">Generated Date: ********</td>
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