<?php
    include ('includes/active-page.php');
    session_start();

// product delete ...
if (isset($_GET['action'])){
    if ($_GET['action'] == 'delete'){
        $id = $_GET['id'];
        unset($_SESSION['cart'][$id]);
    }

}

$cardSucess = 0;
// Products Quninty Update ..................
if (isset($_POST['updatequintity'])){


    if (!in_array("0",$_POST['quintity']) && !negativeValue($_POST['quintity'])){
       $updatecart = array_combine($_POST['productid'],$_POST['quintity']);

        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $value) {

                foreach ($updatecart as $index => $val) {
                    if (isset($value['pid'])) {
                        if ($value['pid'] == $index) {
                            $_SESSION['cart'][$key]['quintity'] = $val;
                            $cardSucess = 1;

                        }
                    }
                }
            }
        }

    }


}



function negativeValue($array){
    if (isset($array)){
        foreach ($array as $value){
            if ($value < 0){
                return true;
                break;
            }
        }
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
    <link rel="stylesheet" href="assets/css/cart.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="assets/js/wow.js"></script>
    <script src="assets/js/main.js"></script>

    <style>
        .addScroll {
            height: 300px;
            overflow-x: hidden;
            overflow-y: auto;
        }
        .fa.fa-angle-right {
            font-size: 28px;
            color: white;
            margin-left: 12px;
            margin-top: -1px;
        }
        .qunity {
            width: 25%;
            border: 1px solid #dbd0d0;
            padding: 5px 3px;
            background: #919191;
        }
    </style>
</head>
<body style="font-family: 'Times New Roman,SutonnyOMJ';">
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
    <h2 class="bg-success text-center p-2 text-white" style="font-family: 'Times New Roman'"">SHOPPING DETAILS </h4>
    <div class="row">

        <div class="col-md-8 offset-2">
            <?php
                if ($cardSucess == 1){ ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <b>Success !</b> Your Cart Update Successfully
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
            <?php    }

                if ($cardSucess == 1){
                    $cardSucess = 0;
                }
            ?>


            <div class="table-responsive">
                <table class="table table-bordered" style="font-family: 'SutonnyOMJ'">
                    <thead>
                    <tr align="center">
                        <th width="15%" >পণ্যের নাম</th>
                        <th width="20%" >পণ্যের ছবি </th>
                        <th width="30%"> 	পরিমান</th>
                        <th width="20%"> 	মূল্য </th>
                        <th width="35%">সর্বমোট মূল্য</th>
                        <th width="30%"><i class="fa fa-trash-o"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    if (isset($_SESSION['cart'])) {

                        if (count($_SESSION['cart']) > 0) {
                            $totalprice = 0;
                            foreach ($_SESSION['cart'] as $key => $value) {

                                if (isset($value['pid'])){
                                ?>
                                <tr align="center">
                                    <td><?= $value['pname'] ?></td>
                                    <td><img src="assets/img/<?=$value['pimage']?>"  class="img-responsive" height="50" width="50"></td>
                                    <form action="" method="post" id="updateproduct">
                                    <td>
                                        <input type="hidden" name="productid[]" value="<?= $value['pid']?>">
                                        <script>
                                            checkbutton(<?= $value['pid']?>);
                                            function checkbutton(value) {
                                                var id = value;
                                                $(document).ready(function () {
                                                    var quinity = $("#alphabat"+id).val();

                                                    if (quinity == 1){
                                                        $("#minus"+id).attr('disabled', 'disabled');

                                                    }else{
                                                        $("#minus"+id).removeAttr("disabled");
                                                    }

                                                })
                                                
                                                
                                            }

                                        </script>

                                            <button class="btn btn-danger" onclick="event.preventDefault(); qunitityminus(<?=$value['pid']?>);" id="minus<?=$value['pid']?>" value="<?=$value['pid']?>"  ><i class="fa fa-minus"></i></button>
                                            <input class="qunity"  name="quintity[]"  value="<?= $value['quintity'] ?>" id="alphabat<?=$value['pid']?>" readonly>
                                            <button class="btn btn-warning" onclick="event.preventDefault(); quintityplus(<?=$value['pid']?>);" id="plus<?=$value['pid']?>" value="<?=$value['pid']?>" ><i class="fa fa-plus"></i></button>

                                    </td>

                                    <td><?=EngtoBng(number_format($value['pprice'],2)); ?> টাকা</td>
                                        <?php $price = $value['quintity'] * $value['pprice']; ?>
                                    <td><?=EngtoBng(number_format($price,2)); ?> টাকা</td>
                                    <td>
                                        <a href="my-cart.php?action=delete&id=<?= $key ?>" class="btn btn-danger">মুছে ফেলুন</a>
                                    </td>
                                </tr>
                                <?php
                                    $totalprice += $price;
                                }




                            }
                        }else{ ?>
                            <tr>
                                <td colspan="6" align="center" style="color: red">No Record Found</td>
                            </tr>
                        <?php }
                    }
                    ?>
                    <?php
                    if (isset($_SESSION['cart'])) {
                        if (count($_SESSION['cart']) > 0) { ?>
                            <tr>
                                <td colspan="6">
                                    <a href="index.php" class="btn btn-secondary">আবার বাজার করুন</a>
                                    <button  class="btn btn-warning float-right" name="updatequintity" style="cursor: pointer">কার্ট আপডেট করুন</button></td>
                                </form>
                            </tr>
                        <?php }
                    }
                    ?>
                    <tr>
                        <td colspan="6" align="right" style="font-family: SutonnyOMJ">
                            <h5 style="display: inline">মোট 	: ৳ </h5><span class="h5" style="font-weight: bold"><?=(isset($totalprice))?EngtoBng(strval(number_format($totalprice,2))):'০.০০' ?></span>
                        </td>

                    </tr>
                    <tr>
                        <td colspan="6" align="right" style="font-family: SutonnyOMJ">
                            <h5 style="display: inline">ছাড় 	: ৳ </h5><span style="font-weight: bold; font-size: 20px"><?= "০.০০" ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" align="right" style="font-family: SutonnyOMJ">
                            <h5 style="display: inline">সর্বমোট 	: ৳ </h5><span class="h5" style="font-weight: bold"><?=(isset($totalprice))?EngtoBng(strval(number_format($totalprice,2))):'০.০০' ?></span>
                        </td>

                    </tr>
                    <tr style="background-color: #f1c205; font-family: SutonnyOMJ;">
                        <?php if (isset($totalprice)) :?>
                        <?php if ($totalprice > 0) :?>
                        <td colspan="6" style="font-family: SutonnyOMJ; cursor: pointer" onclick="checkout()">
                            <h3 style="color: white; padding-top: 3px; font-size: 23px; float: left"> চেক আউট করুন</h3>
                            <span class="h5" style="font-weight: bold; color: white; float: right"><?=(isset($totalprice))?EngtoBng(strval(number_format($totalprice,2))):'০.০০' ?> টাকা <span><i  class="fa fa-angle-right" ></i></span></span>
                        </td>
                        <?php else: ?>
                        <td colspan="6" style="font-family: SutonnyOMJ; cursor: pointer" >
                            <h3 style="color: white; padding-top: 3px; font-size: 23px; float: left"> চেক আউট করুন</h3>
                            <span class="h5" style="font-weight: bold; color: white; float: right"><?=(isset($totalprice))?EngtoBng(strval(number_format($totalprice,2))):'০.০০' ?> টাকা <span><i  class="fa fa-angle-right" ></i></span></span>
                        </td>
                        <?php endif; ?>
                        <?php else: ?>
                        <td colspan="6" style="font-family: SutonnyOMJ; cursor: pointer" >
                            <h3 style="color: white; padding-top: 3px; font-size: 23px; float: left"> চেক আউট করুন</h3>
                            <span class="h5" style="font-weight: bold; color: white; float: right"><?=(isset($totalprice))?EngtoBng(strval(number_format($totalprice,2))):'০.০০' ?> টাকা <span><i  class="fa fa-angle-right" ></i></span></span>
                        </td>
                        <?php endif; ?>
                    </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<script>





    function checkout() {
        window.open("checkout.php","_self");
    }






    function quintityplus(value) {
        var val = value;
        $(document).ready(function () {
            var va = parseInt($("#alphabat"+val).val());
                var pre = (va + 1);
                if (pre > 1) {
                    $("#minus"+val).removeAttr("disabled");
                }


                $("#alphabat"+val).val(pre);



        })
    }

    function qunitityminus(value) {
        var val = value;

        var va = parseInt($("#alphabat" + val).val());
        var pre = (va - 1);
        if (pre == 1) {
            $("#minus"+val).attr('disabled', 'disabled');
        }
        $("#alphabat" + val).val(pre);

    }


</script>

</body>
</html>


<?php

function EngtoBng($str){


    $sarch_array = [1,2,3,4,5,6,7,8,9,0];
    $replace_array = ["১","২","৩","৪","৫","৬","৭","৮","৯","০"];

    $bangladigit = str_replace($sarch_array,$replace_array,$str);
    return $bangladigit;

}

?>

