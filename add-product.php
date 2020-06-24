<?php
include_once ('includes/config.php');

if (!isset($_SESSION)){
    session_start();
}
$sessionSeccess = 0;

$pid = $_POST['pid'];

$query = "SELECT * FROM `product` WHERE id = $pid";

$res = mysqli_query($con,$query);

$row = mysqli_fetch_array($res);

$item = array(
    "pid" => $row['id'],
    "pname" => $row['pname'],
    "pimage" => $row['image'],
    "pprice" => $row['price'],
    "quintity" => 1
);

if (isset($_SESSION['cart'])){
    $id = array_column($_SESSION['cart'], 'pid');
    if (!in_array( $item['pid'],$id)){
       $count = count($_SESSION['cart']);
       $_SESSION['cart'][$count] = $item;
        $sessionSeccess = 1;

    }else{
        echo  $sessionSeccess;
    }

}else{
    $_SESSION['cart'][0] = $item;
    $sessionSeccess = 1;
}

if($sessionSeccess == 1){
    $CumoterId = $_SESSION['CustomarId'];

    $deletequery = "UPDATE wishlists SET wishlist = 0  WHERE user_id = $CumoterId AND product_id = $pid";
    $results = mysqli_query($con,$deletequery);
    if ($results){
        echo 1;
    }
}





?>