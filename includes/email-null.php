<?php
include ('../Classess/database.php');
include('../Classess/SendEmail.php');

session_start();

if ($_SESSION['ReseterEmail']){
    $email = $_SESSION['ReseterEmail'];

    $object = new SendEmail($email);
    $success = $object->NullSet();
    echo $success;

};

?>