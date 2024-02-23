<?php

session_start();

if (isset($_SESSION["user"])) {
    if ($_SESSION["user"]["user_type_id"] == '1') {

?>

        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <title>Admin Log-in | AYUNA.lk |Enriching Age</title>
            <link rel="icon" href="resources/favicon.svg" />

            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="bootstrap.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

        </head>

        <body style="background-color: #e5e5e5;">

            <div class="container-fluid vh-100 mt-5">
                <div class="row">

                    <div class=" col-12 col-lg-6 offset-lg-3 d-flex justify-content-center card mt-5">
                        <div class=" row ">

                            <div class=" mt-5">
                                <div class=" row">

                                    <div class="p-5 d-flex justify-content-center bg-white h-100 card border-0">
                                        <div class=" row align-items-center g-3">

                                            <div class=" col-12 ">
                                                <h1 class=" fw-bold form-label fs-1">Admin Log-In</h1>
                                            </div>

                                            <div class=" col-12">
                                                <div class=" row">

                                                    <div class=" col-12 text-black fw-bold g-3">


                                                        <div class=" col-12 d-none" id="msgdiv">
                                                            <div class=" alert alert-danger" role="alert" id="msg">

                                                            </div>
                                                        </div>

                                                        <!-- Email input -->
                                                        <div class="form-outline mb-4">
                                                            <label class="form-label">Admin Name</label>
                                                            <input type="text" id="admin" class="form-control" />
                                                        </div>

                                                        <!-- Password input -->
                                                        <div class="form-outline mb-4">
                                                            <label class="form-label">Password</label>

                                                            <div class=" input-group">
                                                                <input type="password" id="password" class="form-control" />&nbsp;
                                                                <span class="input-group-text btn border " id="eye" onclick="viweps();"><i class="bi bi-eye-slash-fill"></i></span>
                                                            </div>

                                                        </div>

                                                        <!-- Submit button -->
                                                        <button type="submit" class=" col-12 btn btn-success btn-block" onclick="login_admin();">Log In</button>

                                                        <hr class=" border border-2 border-black my-3">
                                                        <div class=" col-12 text-center">
                                                            <a href="index.php" class=" text-decoration-none"> Go To Home the Page </a>
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
            </div>

            <script src="script.js"></script>
        </body>

        </html>


<?php

    } else {
        echo ("You are not a valid user");
    }
} else {
    echo ("Something Went Wrong,  try again");
}


?>