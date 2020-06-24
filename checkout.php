<?php
if (!isset($_SESSION)){
    session_start();
}
checkCart();
if (isset($_SESSION['CustomarId'])) {
    if (isset($_SESSION['cart'])) {
        if (count($_SESSION['cart']) > 0) {

            ?>
            <!doctype html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport"
                      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>Shoppin-Cart</title>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
                <link rel="stylesheet" href="assets/css/font-awesome.css">
                <link rel="stylesheet" href="assets/css/animate.css">
                <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
                <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
                <link rel="stylesheet" href="assets/css/cart.css">
                <!-- jQuery library -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <!-- Popper JS -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
                <!-- Latest compiled JavaScript -->
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
                <script src="assets/js/wow.js"></script>
                <script src="assets/js/owl.carousel.min.js"></script>
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <script src="assets/js/main.js"></script>
                <style>
                    .swal-title {
                        margin-bottom: 1px;
                        font-family: SutonnyOMJ;
                        font-size: 29px;
                    }
                </style>


            </head>
            <body style="font-family: 'Times New Roman'">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <a class="navbar-brand" href="index.php">GO-BAZAR</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                    <?php
                                    if (isset($_SESSION['CustomarName'])) { ?>
                                        <li class="nav-item">
                                            <a class="nav-link">Wellcome !! <?= $_SESSION['CustomarName'] ?></span></a>
                                        </li>
                                    <?php }
                                    ?>

                                    <li class="nav-item <?= ($activepage == 'My-Account.php') ? 'active' : '' ?>">
                                        <a class="nav-link" href="#">My Account</span></a>
                                    </li>
                                    <li class="nav-item <?= ($activepage == 'wishlists.php') ? 'active' : '' ?>">
                                        <a class="nav-link " href="wishlists.php">Wishlist <span
                                                    class="badge badge-light">9</span>
                                        </a>
                                    </li>

                                    <li class="nav-item <?= ($activepage == 'my-cart.php') ? 'active' : '' ?>">
                                        <a class="nav-link " href="my-cart.php">Mycarts</a>
                                    </li>
                                    <li class="nav-item <?= ($activepage == 'Checkout.php') ? 'active' : '' ?>">
                                        <a class="nav-link " href="#">Checkout</a>
                                    </li>
                                    <li class="nav-item <?= ($activepage == 'Track-Order.php') ? 'active' : '' ?>">
                                        <a class="nav-link " href="#">Track Order</a>
                                    </li>
                                    <?php
                                    if (!isset($_SESSION['CustomarName'])) { ?>
                                        <li class="nav-item <?= ($activepage == 'login.php') ? 'active' : '' ?>">
                                            <a class="nav-link" href="login.php">Login</a>
                                        </li>
                                    <?php } else { ?>
                                        <li class="nav-item <?= ($activepage == 'logout.php') ? 'active' : '' ?>">
                                            <a class="nav-link" href="logout.php">Logout</a>
                                        </li>
                                    <?php } ?>


                                </ul>


                                <div class="dropdown">
                                    <button type="button" class="btn btn-info" data-toggle="dropdown">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span
                                                class="badge badge-pill badge-danger"><?= (isset($_SESSION['cart'])) ? count($_SESSION['cart']) : '0' ?></span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <div class="row total-header-section">
                                            <div class="col-lg-6 col-sm-6 col-6">
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span
                                                        class="badge badge-pill badge-danger"><?= (isset($_SESSION['cart'])) ? count($_SESSION['cart']) : '0' ?></span>
                                            </div>
                                            <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                                <?php
                                                if (isset($_SESSION['cart'])) {
                                                    $total = 0;
                                                    foreach ($_SESSION['cart'] as $key => $value) {
                                                        $total += $value['pprice'] * $value['quintity'];
                                                    }
                                                }
                                                if (isset($total)) {
                                                    $_SESSION['totalcart'] = $total;
                                                }


                                                ?>
                                                <p>Total: <span
                                                            class="text-info"><?= (isset($_SESSION['totalcart'])) ? $_SESSION['totalcart'] : '0.00' ?></span>
                                                    Tk</p>
                                            </div>
                                        </div>
                                        <?php

                                        if (isset($_SESSION['cart'])) {

                                            foreach ($_SESSION['cart'] as $key => $value) { ?>
                                                <div class="row cart-detail" style="border-top: 1px solid black">
                                                    <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                                        <img src="assets/img/<?= $value['pimage'] ?>" width="30"
                                                             height="10">
                                                    </div>
                                                    <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                                        <p><?= $value['pname'] ?></p>
                                                        <span class="price text-info"><?= $value['pprice'] ?></span>
                                                        <span class="count"> Quantity:<?= $value['quintity'] ?></span>
                                                    </div>
                                                </div>


                                            <?php }
                                        }
                                        ?>

                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12 col-12 text-center">
                                                <a href="my-cart.php" class="btn btn-primary btn-block">My Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>


                </div>


            </div>

            <div class="container p-2">

                <h2 class="bg-success text-center p-2 text-white" style="font-family: 'Times New Roman'"> CHECKOUT
                    : </h2>
                <div class="row justify-content-center mt-5 ">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3>Choose Payment Method :</h3>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" id="checkoutfrom">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optradio" value="COD">COD
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optradio"
                                                   value="Internet Banking">Internet Banking
                                        </label>
                                    </div>
                                    <div class="form-check-inline disabled">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optradio"
                                                   value="Debit / Credit card">Debit / Credit card

                                        </label>
                                    </div>
                                    <div style="margin-top: 10px">
                                        <button type="submit" name="Submit" class="btn btn-primary">Submit</button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>

                </div>


            </div>

            <script>

                $(document).ready(function () {

                    $("#checkoutfrom").submit(function (event) {
                        event.preventDefault();
                        var val = $("#checkoutfrom").serializeArray();
                        $.ajax({
                            url: 'check-back.php',
                            type: 'post',
                            data: val,
                            success: function (res) {
                                console.log(res);
                                if (res == 1) {
                                    swal({
                                        title: "আপনার পণ্যগুলো সফলভাবে চেকআউট হয়েছে",
                                        icon: "success",
                                        buttons: false,
                                        timer: 2000
                                    });
                                    setTimeout(function () {
                                        window.open("my-cart.php", "_self");
                                    }, 2100);
                                }
                            }
                        })


                    });


                })

            </script>
            <?php
            if (isset($checkInsert)) {
                echo "<script> CheckoutSuccess(); </script>";
                unset($checkInsert);
            }
            ?>

            </body>
            </html>
            <?php
        } else {
            echo "<script>window.open('index.php','_self')</script>";
        }

    } else {
        echo "<script>window.open('index.php','_self')</script>";
    }

} else {
    echo "<script>window.open('login.php','_self')</script>";
}



function checkCart(){
    if (isset($_SESSION['cart'])){
        if (count($_SESSION['cart']) >0 ){
            foreach ($_SESSION['cart'] as $key => $value){
                if (!isset($value['pid'])){
                    unset($_SESSION['cart'][$key]);
                }
            }
        }
    }
}


?>