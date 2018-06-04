<?php
//checked
namespace core\people;
use core\database;

require_once 'database.php';

class crudWaiter
{
    public $con;

    function __construct(){
        $this->con = new database();
    }

    public function getTables(){
        $query = "Select * from tables";
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

    public function setTableStatus($tb, $state){
        $query = "update tables set isAvailable='$state' where tableNumber = $tb";
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            return false;
        }
        else return true;
    }

    public function addTransaction($t){
        $query = "Insert into transaction(transmakerId,amount,status,description) VALUES('$t->transmakerId','$t->amount','$t->status', '$t->description')";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        return true;

    }

    //this function returns all the orders which have a chef id which means that are cooked
    public function getConfirmedOrders(){
        $query = "Select * from orders where isReady = 1 order by paid asc";
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

    public function confirmPayment($id){
        $query = "update orders set paid=1 where id = $id";
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            return false;
        }
        else return true;
    }

    public function acceptOrder($id, $waiterId){
        $query = "update orders set waiterId = $waiterId where id = $id";
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            return false;
        }
        else return true;
    }

    public function getOrder($id){
        $query = "Select * from orders where id=$id";
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            exit();
        }

        $rows = array();
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows[0];

    }

    public function getOrderContent($id){
        $query = "Select * from or_dish where orderId=$id";
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

}