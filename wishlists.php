<?php
require_once ('includes/config.php');
if (!isset($_SESSION)){
    session_start();
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
    <link rel="stylesheet" href="assets/css/cart.css">
    <link rel="stylesheet" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="assets/js/wow.js"></script>
    <script src="assets/js/main.js"></script>

    <style>
        .addScroll {
            height: 300px;
            overflow-x: hidden;
            overflow-y: auto;
        }
        .fa.fa-star {
            color: #a4a410;
        }

         .swal-title{
             margin-bottom: 1px;
             font-family: SutonnyOMJ;
             font-size: 29px;
         }
        .swal-text {
            font-size: 26px;
            position: relative;
            float: none;
            line-height: normal;
            vertical-align: top;
            text-align: left;
            display: inline-block;
            margin: 0;
            padding: 0px 10px;
            color: rgba(0,0,0,.64);
            max-width: calc(100% - 20px);
            overflow-wrap: break-word;
            box-sizing: border-box;
            font-family: SutonnyOMJ;
        }
        .swal-footer {
            text-align: right;
            padding-top: 13px;
            margin-top: 13px;
            padding: 13px 16px;
            border-radius: inherit;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            text-align: center;
            font-family: SutonnyOMJ;
        }



    </style>
</head>
<body style="font-family: 'Times New Roman' ">
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
                            <a class="nav-link " href="wishlists.php">Wishlists</a>
                        </li>

                        <li class="nav-item <?=($activepage == 'my-cart.php')?'active':''?>">
                            <a class="nav-link " href="my-cart.php">Mycarts</a>
                        </li>
                        <li class="nav-item <?=($activepage == 'Checkout.php')?'active':''?>">
                            <a class="nav-link " href="#">Checkout</a>
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

    <h2 class="bg-success text-center p-2 text-white" style="font-family: 'Times New Roman'"> MY WISHLISTS : </h2>
    <div class="row justify-content-center mt-5 ">
        <div class="col-md-10">
            <div class="table-responsive">
                <table class="table" style="font-family: SutonnyOMJ,'Times New Roman'">
                    <tbody>
                    <?php
                    if (isset($_SESSION['CustomarId'])){
                    $userId = $_SESSION['CustomarId'];
                    $query = "SELECT users.*, product.*,wishlists.product_id FROM wishlists
                                JOIN users ON wishlists.user_id = users.id
                                JOIN product ON wishlists.product_id = product.id WHERE user_id = $userId AND wishlist = 1";
                    $res = mysqli_query($con,$query);
                    if (mysqli_num_rows($res)>0){
                        while ($row = mysqli_fetch_array($res)){ ?>
                            <tr id="pruduct<?=$row['id']?>">
                                <td class="col-md-2"><img src="assets/img/<?=$row['image']?>" alt="<?=$row['pname']?>" width="60" height="100"></td>
                                <td class="col-md-6">
                                    <div class="product-name"><a href="product-details.php?pid=1"><h3><?=$row['pname']?></h3></a></div>

                                    <div class="rating rateit">
                                        <i class="fa fa-star rate"></i>
                                        <i class="fa fa-star rate"></i>
                                        <i class="fa fa-star rate"></i>
                                        <i class="fa fa-star rate"></i>
                                        <i class="fa fa-star non-rate"></i>
                                        <span class="review">( 0 Reviews )</span>
                                        <button id="rateit-reset-2" data-role="none" class="rateit-reset" aria-label="reset rating" aria-controls="rateit-range-2" style="display: none;"></button><div id="rateit-range-2" class="rateit-range" tabindex="0" role="slider" aria-label="rating" aria-owns="rateit-reset-2" aria-valuemin="0" aria-valuemax="5" aria-valuenow="4" style="width: 80px; height: 16px;" aria-readonly="true"><div class="rateit-selected" style="height: 16px; width: 64px;"></div><div class="rateit-hover" style="height:16px"></div></div></div>
                                    <div class="price" style="color: #5d965d; font-family: 'Times New Roman'; font-size: 20px; font-weight: bold"  >Rs.
                                        <?=$row['price']?>
                                        <span><del>$900.00</del></span>
                                    </div>
                                </td>
                                <td class="col-md-2">
                                    <a href="javascript:void(0)" onclick="addproduct(<?=$row['product_id']?>,<?=$row['id']?>)" class="btn-upper btn btn-primary">Add to cart</a>
                                </td>
                                <td class="col-md-2 close-btn">
                                    <a href="javascript:void(0)" onclick="deleteproduct(<?=$row['id']?>)" class="deleteid"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        <?php     }
                    }else{ ?>
                      <tr>
                          <td colspan="5" align="center" style="color: red">No Record Found</td>
                      </tr>
                 <?php   }

                        }
                    ?>


                    </tbody>
                </table>
            </div>
        </div>

    </div>


</div>

<script>
    function deleteproduct(value){
        var id = value;
        $(document).ready(function () {
           $.ajax({
               url:'delete-wishlists.php',
               type:'POST',
               data:{pid: id},
               beforeSend:function () {

               },
               success:function (res) {
                   if (res == 1){
                       $("#pruduct"+id).hide();
                   }

               }
           })
        })
    }
    function addproduct(value,id) {
        var productId = value;
        var Mid = id;

        $(document).ready(function () {
            $.ajax({
                url:'add-product.php',
                type:'POST',
                data:{pid: productId},
                beforeSend:function () {

                },
                success:function (res) {
                    if (res == 1){
                        swal({
                            title: "পণ্যটি কার্ট এ যোগ হয়েছে",
                            icon: "success",
                            buttons: false,
                            timer: 2000
                        });

                        $("#pruduct"+Mid).hide();
                        setTimeout(function () {
                            window.open("wishlists.php","_self");
                        },2100);
                    }
                    if(res == 0){
                        swal({
                            title: "আপনার প্রোডাক্টটি আগে কার্ড এ যুক্ত করা হয়েছে",
                            text:"দয়া করে চেক করে দেখুন",
                            button: "ওকে"
                        });
                    }

                }
            })
        })

    }
</script>

</body>
</html>
