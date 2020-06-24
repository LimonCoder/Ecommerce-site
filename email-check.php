<?php
require_once('includes/config.php');
$data = 0;
$email = $_POST['email'];
$query = "SELECT * FROM users WHERE email = '$email'";

$res = mysqli_query($con,$query);
$row = mysqli_num_rows($res);
if ($row > 0){
    $data = 1;
    echo $data;
}else{
    echo $data;
}



?>