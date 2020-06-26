<?php
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New-Password</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Latest Font Awosome CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



    <style>
        .form-gap {
            padding-top: 133px;
        }
        .resetbutton {
            margin-left: 11px;
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
<body>
<div class="form-gap"></div>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <h3><i class="fa fa-key fa-4x"></i></h3>
                        <h2 class="text-center">Set Password</h2>

                        <div class="panel-body">

                            <form id="newset-form" role="form"  class="form" method="post">

                                <div class="form-group">
                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input id="newpassword" name="newpassword"  placeholder="New Password :" class="form-control"  type="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input id="confrimpassword" name="confrimpassword" placeholder="Confrim Password :" class="form-control"  type="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name="submit" id="newpassword" class="btn btn-lg btn-success " value="Submit" type="submit">
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
        $("#newset-form").submit(function (event) {
            event.preventDefault();
            var values =  $("#newset-form").serializeArray();
            $.ajax({
                url:'includes/set-password.php',
                type:'post',
                data:values,
                success:function (res) {
                    console.log(res);
                    if(res == 1){
                        swal({
                            title:"আপনার পার্স্ওয়াডটি সফলভাবে সেট হয়েছে",
                            icon: "success",
                            buttons: false,
                            timer: 2000
                        });
                        setTimeout(function () {
                            window.open("login.php","_self");
                        },2000);
                    }

                }
            })

        })
    })

</script>

</body>
</html>
