<?php
    session_start();
    // database connection //
    $con = mysqli_connect("localhost","root","","product_details");
    if (!$con){
        die("Database connection faild");
    }


   if (isset($_POST['Add'])){



       if (isset($_SESSION['cart'])){

           $itemlist = array_column($_SESSION['cart'],"pid");
           if (!in_array($_GET['id'], $itemlist)){
              $id = count( $_SESSION['cart']);
              $item = array(
                  "pid" => $_POST['pid'],
                  "pname" => $_POST['pname'],
                  "pimage" => $_POST['pimage'],
                  "pprice" => $_POST['price'],
                  "quintity" => $_POST['quntity']
              );
               $_SESSION['cart'][$id] =   $item;

           }

       }else{
           $items = array(
               "pid" => $_POST['pid'],
               "pname" => $_POST['pname'],
               "pimage" => $_POST['pimage'],
               "pprice" => $_POST['price'],
               "quintity" => $_POST['quntity']
           );

           $_SESSION['cart'][0] =   $items;

       }






   }




?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shoppin-Cart</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/css/cart.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="assets/js/wow.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    
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
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="assets/img/slider1.jpg" alt="First slide" height="400">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="assets/img/slider2.jpg" alt="Second slide" height="400">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="assets/img/slider3.jpg" alt="Third slide" height="400">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="assets/img/slider4.jpg" alt="Fourth slide" height="400">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>



    <div class="container p-2">

        <h2 class="bg-success text-center p-2 text-white" style="font-family: 'Times New Roman'"> ADD T0 SHOPPING CART : </h2>
        <div class="row justify-content-center mt-5 ">

            <div class="owl-carousel owl-theme">
                <?php
                $query = "SELECT * FROM product ORDER BY id ASC";
                $results = mysqli_query($con, $query);
                if (mysqli_num_rows($results) > 0) {
                    while ($row = mysqli_fetch_array($results)) {
                        ?>
                        <div>
                        <div class="col-md-3 m-2 offset-2 p-2 wow fadeInDown" data-wow-duration="2s">
                            <div class="product">
                                <form action="index.php?id=<?= $row['id'] ?>" method="post">
                                    <img src="assets/img/<?= $row['image'] ?>" alt="iphone" class="img-responsive ml-5"
                                         height="250" width="200">
                                    <h5 class="text-center mt-2" style="font-family: SutonnyOMJ; font-weight: bold; color: #1d2124"><?= $row['pname'] ?></h5>
                                    <h6 class="text-center" style="font-weight: bold; color: #1d2124" ><?= $row['price'] ?>/=</h6>
                                    <input type="hidden" name="pid" value="<?= $row['id'] ?>">
                                    <input type="hidden" name="pimage" value="<?= $row['image'] ?>">
                                    <input type="hidden" name="pname" value="<?= $row['pname'] ?>">
                                    <input type="hidden" name="price" value="<?= $row['price'] ?>">
                                    <input type="hidden" class="form-control" name="quntity" value="1">
                                    <div class="rating rateit text-center">
                                        <i class="fa fa-star rate"></i>
                                        <i class="fa fa-star rate"></i>
                                        <i class="fa fa-star rate"></i>
                                        <i class="fa fa-star rate"></i>
                                        <i class="fa fa-star non-rate"></i>
                                        <span class="review">( 0 Reviews )</span>
                                        <button id="rateit-reset-2" data-role="none" class="rateit-reset" aria-label="reset rating" aria-controls="rateit-range-2" style="display: none;"></button><div id="rateit-range-2" class="rateit-range" tabindex="0" role="slider" aria-label="rating" aria-owns="rateit-reset-2" aria-valuemin="0" aria-valuemax="5" aria-valuenow="4" style="width: 80px; height: 16px;" aria-readonly="true"><div class="rateit-selected" style="height: 16px; width: 64px;"></div><div class="rateit-hover" style="height:16px"></div></div></div>
                                    <input type="submit" class="btn bg-primary text-center"
                                           style="margin-left: 45px;" name="Add" value="Add to Cart">

                                    <?php if (!isset( $_SESSION['CustomarName'])): ?>
                                        <a class="wishlist" href="add-wishlist.php?pid=<?= $row['id'] ?>"><i
                                                class="fa fa-heart"></i></a>
                                    <?php endif; ?>

                                    <?php
                                    if (isset($_SESSION['CustomarId'])) {
                                        $userId = $_SESSION['CustomarId'];
                                        $productId = $row['id'];
                                        $wishlistquery = "SELECT wishlists.wishlist FROM wishlists WHERE user_id =  $userId AND product_id =  $productId";
                                        $res = mysqli_query($con, $wishlistquery);
                                        $wish = mysqli_fetch_assoc($res);
                                        if ($wish['wishlist'] > 0) { ?>
                                            <a class="wishlistback" href="update-wishlist.php?pid=<?= $row['id'] ?>"><i
                                                        class="fa fa-heart"></i></a>

                                        <?php } else { ?>
                                            <a class="wishlist" href="add-wishlist.php?pid=<?= $row['id'] ?>"><i
                                                        class="fa fa-heart"></i></a>
                                        <?php }
                                    }

                                    ?>

                                </form>
                            </div>
                        </div>
                        </div>
                    <?php }
                }
                ?>
            </div>
        </div>


    </div>
    <script>
        $(document).ready(function(){
            $('.owl-carousel').owlCarousel({
                loop:true,
                margin:10,
                responsiveClass:true,
                responsive:{
                    0:{
                        items:1,
                        nav:true
                    },
                    600:{
                        items:3,
                        nav:false
                    },
                    1000:{
                        items:5,
                        nav:true,
                        loop:false
                    }
                }
            })
        });
    </script>
</body>
</html>

