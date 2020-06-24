<?php
require_once ('includes/config.php');
if(!isset($_SESSION)){
    session_start();
}

$redirect = false;

if (isset($_GET['id']) && isset($_GET['email'])) {
    $key = $_GET['id'];
    $email = $_GET['email'];
    $query = "SELECT * FROM users WHERE  email = '$email'";
    $res = mysqli_fetch_array(mysqli_query($con, $query));
    $Verifed_key = $res['vKey'];
    if ($key == $Verifed_key) {
        $updatequrey = "UPDATE users SET is_active = 1 WHERE email = '$email'";
        $success = mysqli_query($con, $updatequrey);
        $redirect = true;

        
    }

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Validation Email</title>
</head>
<body>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <?php

        if ($redirect){
            echo "<script>loginSuccess();</script>";
        }

    ?>


    <script>

        function loginSuccess() {
            swal({
                title: "Your Email Validation Successfully",
                icon: "success",
                buttons: false,
                timer: 2000
            });
            setTimeout(function () {
                window.open("login.php","_self");
            },2000);
        }

    </script>
</body>


</html>