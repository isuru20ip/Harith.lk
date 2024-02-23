<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Register | Haritha.lk | Enriching Age</title>
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

                    <div class=" col-md-12 col-lg-6 rbg">
                        <div class=" row">

                            <div class="p-5 d-flex justify-content-center bg-white h-100 card border-0 ">
                                <div class=" row align-items-center g-3">

                                    <div class=" col-12">
                                        <h1 class=" fw-bold form-label fs-1">Register</h1>
                                    </div>

                                    <div class="col-12 text-black fw-bold">
                                        <div class=" row">

                                            <div class=" col-12 d-none" id="msgdiv">
                                                <div class=" alert alert-danger" id="msg" role="alert">

                                                </div>

                                            </div>

                                            <!-- First Name input -->
                                            <div class=" col-12 col-md-6 mb-4">
                                                <label class="form-label">First Name</label>
                                                <input type="text" id="fname" class="form-control" />
                                            </div>

                                            <!-- Last Name input -->
                                            <div class=" col-12 col-md-6 mb-4">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" id="lname" class="form-control" />
                                            </div>

                                            <!-- Email input -->
                                            <div class=" col-12 form-outline mb-4">
                                                <label class="form-label">Email address</label>
                                                <input type="email" id="email" class="form-control" />
                                            </div>

                                            <!-- Password input -->
                                            <div class=" col-12 form-outline mb-4">
                                                <label class="form-label">Password</label>

                                                <div class=" input-group">
                                                    <input type="password" id="password" class="form-control" />&nbsp;
                                                    <span class="input-group-text btn border" id="eye" onclick="viweps();"><i class="bi bi-eye-slash-fill"></i></span>
                                                </div>

                                            </div>


                                            <!-- Phone Number input -->
                                            <div class=" col-12 form-outline mb-4">
                                                <label class="form-label">Contact Number</label>
                                                <input type="text" id="mobile" class="form-control" />
                                            </div>

                                            <!-- Submit button -->
                                            <button type="submit" class=" col-12 btn btn-success btn-block" onclick="Register();">Register</button>

                                            <!-- 2 column grid layout for inline styling -->
                                            <div class=" col-12 mb-4 mt-3 text-center">

                                                <hr class=" border border-2 border-black my-1">

                                                <span class=" mt-3 ">Alredy have an Account</span>&nbsp;<a href="Log_in.php" class=" text-success">Log-in</a>

                                            </div>

                                        </div>
                                    </div>


                                </div>

                            </div>

                        </div>



                    </div>

                    <div class=" col-lg-6 d-none d-lg-block">
                        <img src="resources/sign-in_img.jpg" alt="Login image" class="w-100 vh-100" style="object-fit: cover;">
                    </div>

                </div>

            </div>




        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>