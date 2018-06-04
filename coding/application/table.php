<?php
namespace core\table;
use core\orders\orders;
use core\database;

require_once 'database.php';

require_once 'orders.php';

class table
{



    public $con;

    function __construct()
    {
        $this->con = new database();
    }



    public function createOrder($tbId){
        $query="Insert into orders(tableId,isReady,amount,description,status,paid) values($tbId,0,0,0,0)";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        return true;
    }

    public function addToOrder($dishid, $am, $id){
        for($i=0; $i<sizeof($dishid); $i++){
            $query = "INSERT INTO or_dish(orderId, dishId, amount) VALUES ('$id', '$dishid[i]', '$am[i]')";
            $result = \mysqli_query($this->con->connect(), $query);
            if(!$result){
                echo "Some error occurred ". \mysqli_error($this->con->connect());
                return false;
            }
        }
        return true;
    }

    //create order qe merr nje integer tableId
    //add to order qe ka nje array dishes dhe nje array amount
    //add description per me shume specaaa (string request, tableId)
    //

}