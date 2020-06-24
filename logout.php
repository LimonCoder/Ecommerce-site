<?php
require_once ('includes/config.php');
session_start();

date_default_timezone_set("Asia/dhaka");


if (isset($_SESSION)){

    if (isset($_SESSION['key'])){
            $date = new DateTime('now');
            $logoutTime =  $date->format("Y-m-d g:i A");
            $updatequery = "UPDATE userlogs SET logoutTime= '$logoutTime' WHERE Userid = ".$_SESSION['CustomarId']." AND logskey = '".$_SESSION['key']."' ORDER BY id DESC LIMIT 1";
            $success = mysqli_query($con,$updatequery);
            if ($success){
                session_destroy();
                mysqli_close($con);
            }

    }else{
        session_destroy();
        mysqli_close($con);
    }



}
echo '<script>window.open("index.php","_self")</script>';

?>