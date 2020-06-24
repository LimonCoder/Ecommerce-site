<?php
require_once ('includes/config.php');
if(!isset($_SESSION)){
    session_start();
}

date_default_timezone_set("asia/dhaka");

if (isset($_SESSION['CustomarId'])){ ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order History</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" >
    <link rel="stylesheet" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/cart.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="assets/js/wow.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" ></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js" ></script>
    <script src="assets/js/main.js"></script>



</head>
<body style="font-family: 'Times New Roman'">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="index.php">GO-BAZAR</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <?php
                        if(isset($_SESSION['CustomarName'])){ ?>
                            <li class="nav-item">
                                <a class="nav-link" >Wellcome !! <?=$_SESSION['CustomarName']?></span></a>
                            </li>
                        <?php       }
                        ?>

                        <li class="nav-item <?=($activepage == 'My-Account.php')?'active':''?>">
                            <a class="nav-link" href="#">My Account</span></a>
                        </li>
                        <li class="nav-item <?=($activepage == 'wishlists.php')?'active':''?>">
                            <a class="nav-link " href="wishlists.php">Wishlist <span class="badge badge-light">9</span>
                            </a>
                        </li>

                        <li class="nav-item <?=($activepage == 'my-cart.php')?'active':''?>">
                            <a class="nav-link " href="my-cart.php">Mycarts</a>
                        </li>
                        <li class="nav-item <?=($activepage == 'checkout.php')?'active':''?>">
                            <a class="nav-link " href="checkout.php">Checkout</a>
                        </li>
                        <li class="nav-item <?=($activepage == 'Track-Order.php')?'active':''?>">
                            <a class="nav-link " href="#">Track Order</a>
                        </li>
                        <?php
                        if (!isset($_SESSION['CustomarName'])){ ?>
                            <li class="nav-item <?= ($activepage == 'login.php') ? 'active' : '' ?>">
                                <a class="nav-link" href="login.php">Login</a>
                            </li>
                        <?php }else{ ?>
                            <li class="nav-item <?= ($activepage == 'logout.php') ? 'active' : '' ?>">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>
                        <?php     } ?>



                    </ul>


                    <div class="dropdown">
                        <button type="button" class="btn btn-info" data-toggle="dropdown">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger"><?=(isset($_SESSION['cart']))?count($_SESSION['cart']):'0'?></span>
                        </button>
                        <div class="dropdown-menu">
                            <div class="row total-header-section">
                                <div class="col-lg-6 col-sm-6 col-6">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger"><?=(isset($_SESSION['cart']))?count($_SESSION['cart']):'0'?></span>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                    <?php
                                    if (isset($_SESSION['cart'])) {
                                        $total = 0;
                                        foreach ($_SESSION['cart'] as $key => $value) {
                                            $total += $value['pprice'] * $value['quintity'];
                                        }
                                    }
                                    if (isset($total)){
                                        $_SESSION['totalcart'] = $total;
                                    }


                                    ?>
                                    <p>Total: <span class="text-info"><?=(isset($_SESSION['totalcart']))?$_SESSION['totalcart']:'0.00'?></span> Tk</p>
                                </div>
                            </div>
                            <?php

                            if (isset($_SESSION['cart'])){

                                foreach ($_SESSION['cart'] as $key => $value){ ?>
                                    <div class="row cart-detail" style="border-top: 1px solid black">
                                        <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                            <img src="assets/img/<?=$value['pimage']?>" width="30" height="10">
                                        </div>
                                        <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                            <p><?=$value['pname']?></p>
                                            <span class="price text-info"><?=$value['pprice']?></span> <span class="count"> Quantity:<?=$value['quintity']?></span>
                                        </div>
                                    </div>


                                <?php    }
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

    <h2 class="bg-success text-center p-2 text-white" style="font-family: 'Times New Roman'"> Checkout lists : </h2>
    <div class="row justify-content-center mt-5 ">
        <div class="col-md-12">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>Sl No.</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Quintity</th>
                    <th>Price</th>
                    <th>Shopping Charge</th>
                    <th>Total</th>
                    <th>Payment Method</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $slno = 0;
                    $CustmoarId = $_SESSION['CustomarId'];
                    $query = "SELECT * FROM checkout WHERE user_id = 18";
                    $res = mysqli_query($con,$query);
                    if (mysqli_num_rows($res) > 0){
                        while ($row = mysqli_fetch_array($res)){ ?>
                            <tr>
                                <td><?=++$slno?></td>
                                <td><img src="assets/img/<?=$row['pimage']?>"  class="img-responsive" height="50" width="50"></td>
                                <td><?=$row['pname']?></td>
                                <td><?=$row['quintity']?></td>
                                <td><?=$row['price']?></td>
                                <td><?=number_format($row['shoppingcarge'],2)?></td>
                                <td><?=$row['totalprice']?></td>
                                <td><?=$row['Paymentmethod']?></td>
                                <td><?php
                                    $date = new DateTime($row['Date']);
                                   echo  $date->format("Y-m-d, g:i A");
                                    ?></td>
                                <td>11,000</td>
                            </tr>
                <?php        }
                    }
                ?>
                </tbody>

            </table>
        </div>
    </div>


</div>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>

</body>
    </html>














<?php }else{
    echo "<script>window.open('login.php','_self')</script>";
}




?>


