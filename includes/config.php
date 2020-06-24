<?php
    define("hostname","localhost");
    define("username","root");
    define("password","");
    define("dbname","product_details");

    $con = mysqli_connect(hostname,username,password,dbname);
    if (!$con){
        die("Database connection faild");
    }
?>