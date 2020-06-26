<?php
include ('../Classess/database.php');
include ('../Classess/SendEmail.php');

if (isset($_POST['key'])){


    $obj = new SendEmail("tonmoyhasan283957@gmail.com");
    $key = $obj->ForgetKeyMatch($_POST['key']);
    echo $key;
}







?>