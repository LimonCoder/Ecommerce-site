<?php
require_once ('includes/config.php');
if (!isset($_SESSION)){
    session_start();
}

if (isset( $_SESSION['CustomarName'])){
    $productId = $_GET['pid'];
    $customarId = $_SESSION['CustomarId'];

    $findquery = "SELECT * FROM wishlists WHERE user_id = $customarId AND product_id = $productId";

    $results = mysqli_query($con,$findquery);

    if (mysqli_num_rows($results) > 0){

        while ($row = mysqli_fetch_array($results)){

            if ($customarId == $row['user_id'] && $productId == $row['product_id'] ){
                $updatequery = "UPDATE wishlists SET wishlist = 1 WHERE user_id = $customarId AND product_id = $productId";
                $updatesucces = mysqli_query($con,$updatequery);
                if ($updatesucces){
                    echo '<script>window.open("wishlists.php","_self")</script>';
                }

            }
        }

    }else{
        $query = "INSERT INTO wishlists VALUES (NULL,$customarId,$productId,1,NULL)";
        $res = mysqli_query($con,$query);
        if ($res){
            echo '<script>window.open("wishlists.php","_self")</script>';
        }

    }



}else{
    echo '<script>window.open("login.php","_self")</script>';
}

?>