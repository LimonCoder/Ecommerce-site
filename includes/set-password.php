<?php
include('config.php');
session_start();
$email = $_SESSION['ReseterEmail'];
$errors = array();

if (!empty($_POST['newpassword'])){

    if (strlen($_POST['newpassword']) >=6 ){
        $password = trim($_POST['newpassword']);
    }else{
        $errors['invalidpass'] = "*";
    }
}else{
    $errors['emptypass'] = "*";
}
if (!empty($_POST['confrimpassword'])){

    if ($password == trim($_POST['confrimpassword'])){
        $mainpassword = trim($_POST['confrimpassword']);
    }else{
        $errors['invalidmainpass'] = "*";
    }
}else{
    $errors['emptyconpass'] = "*";
}

if (count($errors) == 0) {

    $query = "UPDATE users SET password = '$mainpassword' WHERE email = '$email'";
    $success = mysqli_query($con,$query);
    if ($success){
        echo 1;
    }else{
        echo 0;
    }
}


?>