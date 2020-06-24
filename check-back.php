<?php
require_once("includes/config.php");
$checkInsert = 0;
if (!isset($_SESSION)) {
    session_start();
}



if (!empty($_POST['optradio'])) {
    $payable = $_POST['optradio'];
} else {
    $emptypayable = 1;
}

if (!isset($emptypayable)) {

    if (isset($_SESSION['cart'])) {
        if (count($_SESSION['cart']) > 0) {
            foreach ($_SESSION['cart'] as $key => $value) {

                if (isset($value['pid'])) {
                    $custmorId = $_SESSION['CustomarId'];
                    $productName = $value['pname'];
                    $productImage = $value['pimage'];
                    $productPrice = $value['pprice'];
                    $quintity = $value['quintity'];
                    $totalprice = number_format($productPrice * $quintity, 2);


                    $query = "INSERT INTO checkout VALUES (NULL,$custmorId,'$productImage','$productName',$quintity,$productPrice,'$totalprice','$payable',0.00,NULL)";
                    $success = mysqli_query($con, $query);
                    if ($success) {
                        unset($_SESSION['cart'][$key]);
                        $checkInsert = 1;
                        echo $checkInsert;
                    } else {
                        echo $checkInsert;
                    }
                }
            }
        }
    }
}else{
    $emptypay = "Empty";
    echo $emptypay;
}


?>