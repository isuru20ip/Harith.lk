<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Log-in | Haritha.lk |Enriching Age</title>
    <link rel="icon" href="resources/favicon.svg" />

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body>

    <div class="container-fluid vh-100">
        <div class="row">

            <div class=" col-12">
                <div class=" row align-items-center">

                    <div class=" col-md-12 col-lg-6">

                        <div class=" p-4 p-md-5 d-flex justify-content-center bg-white h-100 card border-0">
                            <div class=" row align-items-center g-3">

                                <div class=" col-12">
                                    <h1 class=" fw-bold form-label fs-1">Log-In</h1>
                                </div>

                                <div class=" d-md-none my-0">
                                    <hr>
                                </div>

                                <div class=" col-12">
                                    <div class=" row">

                                        <?php
                                        $email = "";
                                        $password = "";


                                        if (isset($_COOKIE["email"])) {
                                            $email = $_COOKIE["email"];
                                        }

                                        if (isset($_COOKIE["password"])) {
                                            $password = $_COOKIE["password"];
                                        }

                                        ?>

                                        <div class=" col-12 text-black fw-bold g-3">


                                            <div class=" col-12 d-none" id="msgdiv">
                                                <div class=" alert alert-danger" role="alert" id="msg">

                                                </div>
                                            </div>

                                            <!-- Email input -->
                                            <div class="form-outline mb-4">
                                                <label class="form-label">Email address</label>
                                                <input type="email" id="email" class="form-control" value="<?php echo $email ?>" />
                                            </div>

                                            <!-- Password input -->
                                            <div class="form-outline mb-4">
                                                <label class="form-label">Password</label>

                                                <div class=" input-group">
                                                    <input type="password" id="password" class="form-control" value="<?php echo $password ?>" />&nbsp;
                                                    <span class="input-group-text btn border " id="eye" onclick="viweps();"><i class="bi bi-eye-slash-fill"></i></span>
                                                </div>

                                            </div>

                                            <!-- Submit button -->
                                            <button type="submit" class=" col-12 btn btn-success btn-block" onclick="login();">Log In</button>

                                            <!-- 2 column grid layout for inline styling -->
                                            <div class=" col-12 mb-4 mt-3">
                                                <div class=" row">

                                                    <!-- Checkbox -->
                                                    <div class=" col form-check ms-2">
                                                        <input class="form-check-input" type="checkbox" id="rememberme" />
                                                        <label class="form-check-label"> Remember me </label>
                                                    </div>

                                                    <div class=" col d-flex justify-content-end">
                                                        <!-- Simple link -->
                                                        <a href="fogot_password.php" class=" text-success">Forgot password?</a>
                                                    </div>

                                                </div>


                                                <hr class=" border border-2 border-black my-3">

                                                <div class=" col-12 text-center mt-3 ">
                                                    <!-- Simple link -->
                                                    <span>New to Here</span>&nbsp;<a href="Register.php" class=" text-success">Create an Account</a>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>

                        </div>

                    </div>

                    <div class=" col-lg-6 d-none d-lg-block">
                        <img src="resources/sign-in_img.jpg" class="w-100 vh-100" style="object-fit: cover;">
                    </div>

                </div>

            </div>




        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>