<?php

namespace core\table;

use core\database;

require_once 'database.php';

class crudTable
{
    public $con;

    function __construct(){
        $this->con = new database();
    }

    public function getTable($id)
    {
        $query = "Select * from `tables` WHERE tableNumber =".$id;
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            echo "Some error occurred". \mysqli_error($this->con->connect());
            exit();
        }

        $rows = array();
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }


    public function getOrders($id)
    {
        $query = "Select * from `orders` WHERE tableId =".$id;
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            exit();
        }

        $rows = array();
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }

    public function addTable($num, $password, $numChairs){
        $query = "INSERT INTO `tables`(`tableNumber`, `isAvailable`, `password`, `numChairs`) VALUES ($num,'yes', '$password',$numChairs)";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            return false;
        }
        return true;
    }

}