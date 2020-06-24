<?php
    require_once('includes/config.php');
    date_default_timezone_set("Asia/dhaka");
    if(!isset($_SESSION)){
        session_start();
    }


$emailPattern = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

    if (isset($_POST['login'])){

        if (preg_match($emailPattern, $_POST['email'])){
            $CustomerEmail = $_POST['email'];
        }else{
            $invalid_email = "Your Email in Invaild";
        }

        $password = trim($_POST['password']);
        if (isset($CustomerEmail)){
            $query = "SELECT * FROM users WHERE email = '$CustomerEmail'";
            $results = mysqli_query($con,$query);
            $row = mysqli_num_rows($results);
            if ($row == 1){

                $query2 = "SELECT * FROM users WHERE email = '$CustomerEmail'";
                $result = mysqli_query($con,$query2);
                $Userpassword = mysqli_fetch_array($results);
                if ($Userpassword['is_active'] == 1){
                    if ($Userpassword['password'] == $password){
                        $userip = $_SERVER['REMOTE_ADDR'];
                        $_SESSION['CustomarName'] = $Userpassword['name'];
                        $_SESSION['CustomarId'] = $Userpassword['id'];
                        $date = new DateTime('now');
                        $loginTime =  $date->format("Y-m-d g:i A");
                        $text = "abcdefghijklmnopqrstuvwzyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYX#$%!";
                        $_SESSION['key'] = substr(str_shuffle($text),0,8);
                        $browser = getBrowser();
                        mysqli_query($con,"INSERT INTO userlogs (Userid, userip, logskey,loginTime, Browser , status) VALUES (".$_SESSION['CustomarId'].", '$userip','".$_SESSION['key']."','$loginTime','$browser', 1)");
                        header("location: index.php");


                    }else{
                        $wrong_pass = 1;
                    }
                }else{
                    $pending_email = 1;
                }


            }else{
                $wrong_email = 1;

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
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="assets/css/cart.css">
    <link rel="stylesheet" href="assets/css/animate.css">



    <style>
        .addScroll {
            height: 300px;
            overflow-x: hidden;
            overflow-y: auto;
        }
        .loadimg {
            position: absolute;
            top: 30%;
            left: 29%;
            opacity: 0.5;
        }
    </style>
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


<div class="body-content outer-top-bd ">
    <div class="container">
        <h2 class="bg-success text-center p-2 text-white" style="font-family: 'Times New Roman'"> USER : </h2>
        <div class="sign-in-page inner-bottom-sm">
            <div class="row mt-4">
                <!-- Sign-in -->
                <div class="col-md-6 col-sm-6 sign-in">
                    <?php
                        if (isset($wrong_email)){ ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                Your Email Is Wrong
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                    <?php
                        unset($wrong_email);
                        }
                    if (isset($wrong_pass)){ ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            Your Password is Wrong
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                <?php
                        unset($wrong_pass);
                    }

                    if (isset($pending_email)){ ?>
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            Please Verifed Your Email.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
             <?php
                    unset($pending_email);
                    }
                    ?>


                    <h4 class="">SIGN IN</h4>
                    <p class="">Hello, Welcome to your account.</p>
                    <form action="" class="sign-in" method="post">
                        <span style="color:red;">
                        </span>
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Email Address </label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="<?=(isset($_POST['email']))?$_POST['email']:''?>" required>
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
                        </div>
                        <div class="radio outer-xs">
                            <a href="forgot-password.php" class="forgot-password pull-right">Forgot your Password?</a>
                        </div>
                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button" name="login">Login</button>
                    </form>
                </div>
                <!-- Sign-in -->

                <!-- create a new account -->

                <div class="col-md-6 col-sm-6 rightpart">
                    <div class="loadimg" style="display: none" >
                        <img src="assets/img/loading.gif" id="imge" alt="">
                    </div>
               `     <div class="createaccount">

                    <h4 class="checkout-subtitle">CREATE A NEW ACCOUNT</h4>
                    <p class="text title-tag-line">Create your own Shopping account.</p>
                    <form class="register-form" id="register">
                        <div class="form-group">
                            <label class="info-title" for="fullname">Full Name :

                            </label>
                            <span id="invalidname" style="font-size:12px; color: red"></span>
                            <input type="text" class="form-control" id="fullname" name="fullname" required>
                        </div>


                        <div class="form-group">
                            <label class="info-title" for="email">Email Address </label>
                            <input type="email" class="form-control" id="email" onchange="emailcheck(this.value)" name="email" required >
                            <span id="availability" style="font-size:12px; color: red"></span>
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="contactno">Contact No. </label>
                            <span id="invalidNumber" style="font-size:12px; color: red"></span>
                            <input type="text" class="form-control" id="contactno" name="contactno" maxlength="11" required >
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="password">Password. </label>
                            <span id="invalidPassword" style="font-size:12px; color: red"></span>
                            <input type="password" class="form-control" id="password" name="password"  required >
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="confirmpassword">Confirm Password. </label>
                            <span id="invalidConPassword" style="font-size:12px; color: red"></span>
                            <input type="password"  class="form-control " id="confirmpassword" name="confirmpassword" required >
                        </div>


                        <button type="submit" name="submit" class="btn-upper btn btn-primary" id="submit" >Sign Up</button>
                    </form>


                </div>
                </div>
                <!-- create a new account -->
            </div><!-- /.row -->
        </div>

    </div>
</div>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="assets/js/wow.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
<script>



    $(document).ready(function () {

        $("#register").submit(function (e) {
            e.preventDefault();
            var form = $("#register").serializeArray();
            $.ajax({
               url:'login-back.php',
                method:'post',
                data:form,
                dataType:'json',
                beforeSend:function () {
                    $(".loadimg").css("display","inline-block");
                    $("#submit").attr("disabled","true");
                },
                success:function (res) {
                   if (res == 1){
                       swal({
                           position: 'top-end',
                           title: "Success",
                           text: "Your Registartion Successfully",
                           icon: "success",
                           buttons: false,
                           timer: 2000
                       });
                   }
                   // if (res == 0){
                   //
                   // }

                    if(res.nameWord == "Your name must be at least two word"){
                        $("#invalidname").html(res.nameWord);
                    }else{
                        $("#invalidname").html("");
                    }

                    if(res.invalidNumber == "Your Mobile Number is Invaild"){
                        $("#invalidNumber").html(res.invalidNumber);
                    }else{
                        $("#invalidNumber").html("");
                    }

                    if(res.invalidPassword == "Your Password must be grether than 6"){
                        $("#invalidPassword").html(res.invalidPassword);
                    }else{
                        $("#invalidPassword").html("");
                    }

                    if(res.PasswordMatch == "Password Don't Match"){
                        $("#invalidConPassword").html(res.PasswordMatch);
                    }else{
                        $("#invalidConPassword").html("");
                    }


                    $(".loadimg").css("display","none");
                    $("#submit").removeAttr("disabled");
                }
            });
        });
    })

    function emailcheck(value) {
        $(document).ready(function () {
            $.ajax({
                url:'email-check.php',
                type:'post',
                data:{
                    email:value
                },
                success:function (res) {
                    if (res == 1){
                        $("#email").css("border-color","red");
                        $("#availability").text("Email Already Exixts");
                    }else{
                        $("#email").css("border-color","");
                        $("#availability").text("");
                    }

                }
            })
        })
    }
</script>
<?php
function getBrowser(){

    $browser="";

    if(strrpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("MSIE")))
    {
        $browser="Internet Explorer";
    }
    else if(strrpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("Presto")))
    {
        $browser="Opera Mini";
    }
    else if(strrpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("CHROME")))
    {
        $browser="Google Chrome";
    }
    else if(strrpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("SAFARI")))
    {
        $browser="Safari";
    }
    else if(strrpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("FIREFOX")))
    {
        $browser="Morzila Firebox";
    }
    else
    {
        $browser="OTHER";
    }
    return $browser;
}
?>