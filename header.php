<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-success border border-black">
        <div class="container-fluid mx-lg-5">
            <a class="navbar-brand fs-2 text-white fw-bold" href="index.php">Haritha.lk</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php
                    if (isset($_SESSION["user"])) {
                    ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-bold text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Hi, <?php echo $_SESSION["user"]["fname"] ?> 
                            </a>
                            <ul class="dropdown-menu">
                                <li onclick="logout();"><a class="dropdown-item fw-bold text-danger" href="#">Logout</a></li>
                            </ul>
                        </li>
                    <?php
                    }
                    ?>
                </ul>

                <form class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <?php
                            if (isset($_SESSION["user"])) {
                            ?>
                                <a href="wishlist.php" class="nav-link active text-white fw-bold" aria-current="page">Wishlist</a>
                            <?php
                            } else {
                            ?>
                                <a href="Log_in.php" class="nav-link active text-white fw-bold" aria-current="page">Wishlist</a>
                            <?php
                            }
                            ?>
                        </li>

                        <li class="nav-item">
                            <?php
                            if (isset($_SESSION["user"])) {
                            ?>
                                <a href="userProfile.php" class="nav-link active text-white fw-bold" aria-current="page">Account</a>
                            <?php
                            } else {
                            ?>
                                <a href="Log_in.php" class="nav-link active text-white fw-bold" aria-current="page" style="cursor:pointer;">Account</a>
                            <?php
                            }
                            ?>
                        </li>
                        <li class="nav-item">
                            <?php
                            if (isset($_SESSION["user"])) {
                            ?>
                                <a href="cart.php" class="nav-link active text-white fw-bold" aria-current="page"><img src="resources/cartico.svg" style="height: 25px; cursor: pointer;"></a>
                            <?php
                            } else {
                            ?>
                                <a href="Log_in.php" class="nav-link active text-white fw-bold" aria-current="page" style="cursor:pointer;"><img src="resources/cartico.svg" style="height: 25px; cursor: pointer;"></a>
                            <?php
                            }
                            ?>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </nav>
    <script src="script.js"></script>
</body>

</html>