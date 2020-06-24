<?php


class database
{
    private $hostname = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "product_details";
    public $sql;

    function __construct()
    {
        $con = new mysqli($this->hostname,$this->user,$this->password,$this->dbname);

        if ($con->connect_errno){
            die("database connection faild");
        }else{
            $this->sql =  $con;
        }
    }

}