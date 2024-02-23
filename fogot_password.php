<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Account Recovery | AYUNA.lk | Enriching Age</title>
    <link rel="icon" href="resources/favicon.svg" />

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body class=" bg-success">

    <div class=" container-fluid p-lg-5">
        <div class=" row">

            <div class=" col-12 mt-5">
                <div class=" row justify-content-center px-lg-5 ">
                    <div class=" col-12 col-lg-6">

                        <div class=" card shadow rounded ">
                            <div class=" card-header fw-bold fs-4">Account Recovery</div>

                            <div class=" card-body">

                                <div class=" col-12 p-3 ">

                                    <div class=" col-12 d-none" id="msgdiv">
                                        <div class=" alert alert-danger" role="alert" id="msg">

                                        </div>
                                    </div>

                                    <div class=" col-12 mb-3">
                                        <label class="form-label fw-bold">Email Address</label>
                                        <input type="email" id="email" class="form-control" />
                                    </div>

                                    <div class=" col-12 mb-3">
                                        <button class=" btn btn-success col-12 text-center fw-bold " id="vc" onclick="vcode();"> Get Verification Code </button>
                                    </div>

                                    <div class=" col-12 mb-3">
                                        <label class="form-label fw-bold">New Password</label>

                                        <div class=" input-group">
                                            <input type="password" id="np" class="form-control" />&nbsp;
                                            <span class="input-group-text btn border " id="eye" onclick="viwefps();"><i class="bi bi-eye-slash-fill"></i></span>
                                        </div>

                                    </div>

                                    <div class=" col-12 mb-3">
                                        <label class="form-label fw-bold">Retype password</label>

                                        <div class=" input-group">
                                            <input type="password" id="rnp" class="form-control" />&nbsp;
                                            <span class="input-group-text btn border " id="reye" onclick="viwefrps();"><i class="bi bi-eye-slash-fill"></i></span>
                                        </div>
                                    </div>

                                    <div class=" col-12 mb-3">
                                        <label class="form-label fw-bold">Verification Code</label>
                                        <input type="text" id="vcode" class="form-control" />
                                    </div>

                                    <div class=" col-12 mb-0">
                                        <button class=" btn btn-success col-12 text-center fw-bold" id="sbtn" onclick="resetPs();"> Submit </button>
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