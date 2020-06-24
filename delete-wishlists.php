<?php
include ('includes/config.php');

$success = 0;

if (!isset($_SESSION)){
    session_start();
}



$productId = $_POST['pid'];
$CumoterId = $_SESSION['CustomarId'];

$deletequery = "UPDATE wishlists SET wishlist = 0  WHERE user_id = $CumoterId AND product_id = $productId";

$results = mysqli_query($con,$deletequery);

if ($results){
    $success = 1;
    echo $success;
}else{
    echo $success;
}


?>