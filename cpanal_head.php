

<body>

    <div class=" col-12 bg-primary">
        <div class=" row">

            <div class="col-12 col-lg-4">
                <div class="row">

                    <div class="col-12 col-lg-4 mt-1 mb-1 text-center">
                        <?php
                        $pimg_rs = Database::search("SELECT * FROM `user_img` WHERE `user_email` = '" . $_SESSION["admin"]["user_email"] . "'");
                        $pimg_num = $pimg_rs->num_rows;
                        $pimg_data = $pimg_rs->fetch_assoc();

                        if ($pimg_num == '1') {
                        ?>
                            <img src="<?php echo $pimg_data["path"]; ?>" width="90px" height="90px" class="rounded-circle" />
                        <?php
                        } else {
                        ?>
                            <img src="resources/user.svg" width="90px" height="90px" class="rounded-circle" />
                        <?php
                        }
                        ?>
                    </div>

                    <div class="col-12 col-lg-8">
                        <div class="row text-center text-lg-start">
                            <div class="col-12 mt-0 mt-lg-4">
                                <span class="text-white fw-bold"><?php echo $_SESSION["admin"]["admin_name"]; ?></span>
                            </div>
                            <div class="col-12">
                                <span class="text-black-50 fw-bold"><?php echo $_SESSION["admin"]["user_email"] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8">
                <div class="row">
                    <div class="col-12 col-lg-10 mt-2 my-lg-4">
                        <h1 class="offset-sm-3 offset-lg-1 text-white fw-bold">Admin control panel</h1>
                    </div>
                    <div class="col-12 col-lg-2 mx-2 mb-2 my-lg-4 mx-lg-0 d-grid">
                        <a class="btn btn-dark fw-bold" href="control_panel.php">Contral Panal</a>
                    </div>
                </div>
            </div>

        </div>

    </div>



    <script src="script.js"></script>
</body>

</html>