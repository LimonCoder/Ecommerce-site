
<?php
session_start();
if (isset($_SESSION['ReseterEmail'])):
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
    <script src="https://cdn.jsdelivr.net/npm/p5@1.0.0/lib/p5.js"></script>



    <style>
        .form-gap {
            padding-top: 133px;
        }
        .resetbutton {
            margin-left: 11px;
        }
        #timer {
            padding: 10px 7px;
            font-size: 16px;
            font-weight: bold;
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
                            <h2 class="text-center">Varification Code !</h2>
                            <p style="font-weight: bold">Plese check your email </p>
                            <div class="panel-body">

                                <form id="reset-form" role="form" autocomplete="off" class="form" method="post">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input id="username"  placeholder="Varification Code here :" class="form-control"  type="text">
                                        </div>
                                    </div>
                                    <div class="form-group resetbutton">
                                        <input name="recover-submit" id="resetpassword" class="btn btn-lg btn-warning " value="Reset Password" type="submit">
                                        <button class="btn btn-warning" id="timer"  >2.00</button>
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
    var limit = 10;

    function setup() {
        noCanvas();
        $("#timer").html(timelimit(limit));

        function timelimit(se) {
            var minute = Math.floor(se / 60);
            var second = se % 60;
            return nf(minute, 2) + ":" + nf(second, 2);

        }
        $("#timer").click(function (event) {
            event.preventDefault();
        })

        function conuter() {
            var cl = --limit;
            if(timelimit(cl) == "00:00"){

                clearInterval(myvar);
                $("#timer").html(timelimit(cl));
                $.ajax({
                    url:'includes/email-null.php',
                    type:'post',
                    success:function (res) {
                        if (res == 1){
                            $("#resetpassword").attr("disabled","disabled");
                        }
                    }
                })

            }else{
                $("#timer").html(timelimit(cl));
            }


        }

        var myvar =  setInterval(conuter, 1000);


    }

    $(document).ready(function () {
        $("#reset-form").submit(function (event) {
            event.preventDefault();
        })
    })

</script>
</body>
</html>
<?php else: ?>
    <script>window.open('forgot-password.php','_self')</script>
<?php endif;    ?>