<?php
require_once ('../includes/config.php');

if (isset($_POST['name'])){
    $name = $_POST['name'];

    $query = "SELECT users.email FROM users WHERE name = '$name'";
    $res = mysqli_query($con,$query);
    while($row = mysqli_fetch_array($res)){
        $arr[] = $row['email'];
    }

    echo json_encode($arr);



}


?>


