<?php
require ('includes/PHPMailer/PHPMailerAutoload.php');
include ('Classess/database.php');
include('Classess/SendEmail.php');

session_start();

if(isset($_POST['Submit'])){

    if (!empty($_POST['email'])){
        $_SESSION['ReseterEmail']  = $_POST['email'];
    }else{
        $emptyemail = "Email empty";
    }

    if (isset($_SESSION['ReseterEmail'])){
        $object = new SendEmail($_SESSION['ReseterEmail']);
        if (!empty($_POST['resetername'])){
            $object->SetResetName($_POST['resetername']);
        }
        if ($object->Send()){
            echo "<script>window.open('forgetpassword-matching.php')</script>";
        }else{
            echo "Password faild";
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
    <title>Forgot-Password</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Latest Font Awosome CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>



    <style>
        .form-gap {
            padding-top: 133px;
        }
        .modal-dialog {
            position: relative;
            width: 558px;
            margin-top: 134px;
            left: 0%;
        }
    </style>
</head>
<body>
<div class="form-gap"></div>
<div class="container">
    <div class="row" id="modalreset"><div id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Reset Your Password</h4>
                    </div>
                    <div class="modal-body">
                        <p>How do you want to receive the code to reset your password ?</p>
                        <form action="" method="post" id="resetform">

                        </form>
                    </div>

                </div>
            </div>
        </div></div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <h3><i class="fa fa-lock fa-4x"></i></h3>
                        <h2 class="text-center">Forgot Password?</h2>
                        <p>You can reset your password here.</p>
                        <div class="panel-body">

                            <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input id="username"  placeholder="User Name :" class="form-control"  type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name="recover-submit" id="resetpassword" class="btn btn-lg btn-warning btn-block" value="Reset Password" type="submit">
                                </div>


                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<script>
    $(document).ready(function () {
        $("#register-form").submit(function (event) {
            event.preventDefault();
            var username = $("#username").val();

            $.ajax({
                url:'Classess/name-back.php',
                type:'post',
                data:{
                  name:username
                },
                dataType:'json',
                success:function (res) {
                    var tr = "";
                    var nametr = "";
                    $(res).each(function (index, value) {


                        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
                        //var address = document.getElementById[email].value;
                        if (reg.test(value) == true)
                        {
                            tr += `<div class="form-check">
                                    <input class="form-check-input" type="radio" name="email" id="exampleRadios2" value="${value}">
                                    <label class="form-check-label" for="exampleRadios2">
                                        ${value}
                                    </label>
                                </div>`;
                        }else{
                           nametr =`<input class="form-check-input" type="hidden" name="resetername"  value="${value}">`;
                        }





                    })
                    tr += `<div class="form-group ">
                                <input type="submit" class="btn btn-primary" name="Submit" value="Submit">
                            </div>`;

                    $("#resetform").html(tr + nametr);
                    $("#myModal").modal('show');


                }
            })

        })

        $("#myModal").modal('hide');


    })


</script>

</body>
</html>