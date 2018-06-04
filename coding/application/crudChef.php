<?php
//checked
namespace core\people;
use core\database;

require_once 'database.php';
require_once 'notification.php';

class crudChef
{
    public $con;

    function __construct(){
        $this->con = new database();
    }

    public function getSentOrders()
    {
        $query = "Select * from orders WHERE status = 0";
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

    public function getProcessingOrders($chefId){
        $query = "Select * from orders WHERE status = 1 and isReady=0 and chefId=$chefId";
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

    public function getDish($id){
        $query = "Select * from dishes WHERE id = $id";
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

    public function takeOrder($id, $chefId){
        $query = "update orders set status = 1 , chefId=$chefId where id = $id";
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            return false;
        }
        else return true;
    }

    public function sendNotif($notif){
        $query = "INSERT INTO notification(senderId, receiverId, text, status) VALUES ('$notif->senderId','$notif->receiverId','$notif->text','$notif->status')";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        return true;
    }

    public function confirmOrder($id){
        $query = "update orders set isReady = 1 where id = $id";
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            echo "bla";
            return false;
        }
        else return true;
    }
//keto te dyja duhen tek table
    public function createOrder($tbId,$price){
        $query="Insert into orders(tableId,isReady,amount,description,status,paid) values($tbId,0,$price,'',0,0)";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        return true;
    }

    public function checkPreviousOrder($tbId){
        $query="Select * from orders where tableId=$tbId and status=0";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        $rows = array();
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        if (count($rows)>=1) return false;
        else return true;
    }

    public function fetchOrder($tbId){
        $query="Select * from orders where tableId=$tbId and status=0";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        $rows = array();
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows[0];
    }

    public function getOrder($id){
        $str="";
        $query="Select * from orders where id = $id";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        $rows = array();
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        if($rows[0]['status'] == 0) $str="SENT";
        else {
            if ($rows[0]['isReady'] == 0) $str="BEING PROCESSED";
            else $str="COOKED";
        }
        return $str;
    }

    //shton dishes ne order
    public function addToOrder($dishid, $am, $id,$price){
        for($i=0; $i<sizeof($dishid)-1; $i++){
            $query = "INSERT INTO or_dish(orderId, dishId, amount) VALUES ('$id', '$dishid[$i]', '$am[$i]')";
            $result = \mysqli_query($this->con->connect(), $query);
            if(!$result){
                echo "Some error occurred ". \mysqli_error($this->con->connect());
                return false;
            }
        }
        $query1 = "update orders set amount = $price where id = $id";
        $result1 = \mysqli_query($this->con->connect(),$query1);
        if(!$result1){
            return false;
        }
        return true;
    }

    //shton description ne order
    public function addDescription($desc, $order){
        $query="update orders set description='$desc' where id=$order";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        return true;
    }


    //shton produktet ne nje dish
    public function addToDish($prodid, $am, $dishid){
        for($i=0; $i<sizeof($dishid); $i++){
            $query = "INSERT INTO d_pr(dishId, productId, quantity) VALUES ('$dishid', '$prodid[$i]', '$am[$i]')";
            $result = \mysqli_query($this->con->connect(), $query);
            if(!$result){
                echo "Some error occurred ". \mysqli_error($this->con->connect());
                return false;
            }
        }
        return true;
    }

    public function viewOrder($id){
        $query="Select * from or_dish where orderId = $id";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        $rows = array();
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }

    public function updateOrder($id,$dishid,$amount){
        if ($amount == 0){
            $deleteQuery = "delete from or_dish where orderId = $id and dishId = $dishid";
            $result = \mysqli_query($this->con->connect(), $deleteQuery);
            if($result) return true;
            else return false;
        }
        $query = "update or_dish set amount = $amount where orderId = $id and dishId = $dishid";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        return true;
    }

    public function updatePrice($orderId, $price){
        $query = "Update orders set amount = $price where id = $orderId";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        return true;

    }

    public function getDishes(){
        $query = "Select * from dishes";
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

    public function viewProducts($id){
        $query="Select * from d_pr where dishId = $id";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        $rows = array();
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }

    public function getProduct($id){
        $query = "Select * from products WHERE id = $id";
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            exit();
        }

        $productname = "";
        while($row = $result->fetch_assoc()){
            $productname = $row['name'];
        }
        return $productname;
    }

    public function getProductMeasurement($id){
        $query = "Select * from products WHERE id = $id";
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            exit();
        }

        $productM = "";
        while($row = $result->fetch_assoc()){
            $productM = $row['measurement'];
        }
        return $productM;
    }

    function removeProduct($id, $quantity){
        //first we get the quantity of the current product
        $query1 = "Select * from products where id=".$id;
        $result = \mysqli_query($this->con->connect(), $query1);
        if(!$result){
            echo "Could not get the quantity from the products";
            exit();
        }

        $quantityOld = "";
        while($row = $result->fetch_assoc()){
            $quantityOld = $row['quantity'];
        }

        $newQuantity = $quantityOld - $quantity;

        $query2 = "UPDATE `products` SET `quantity`=".$newQuantity." WHERE id=".$id;
        $result2 = \mysqli_query($this->con->connect(), $query2);
        if(!$result2){
            echo "Could not replace the new quantity with the new quantity";
        }

    }

    public function seeNotification($id){
        $query = "Select * from notification where receiverId=".$id;
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

    function getMemberUsername($id){
        $query = "Select * from people where id=".$id;
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occurred";
            exit();
        }
        $username = "";
        while($row = $result->fetch_assoc()){
            $username = $row['username'];
        }
        return $username;
    }

    //get id of the member from the username
    function getMemberIdByUsername($username){
        $query = "Select * from people where username='$username'";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occured in getting the id!";
            exit();
        }
        $id = "";
        while($row = $result->fetch_assoc()){
            $id = $row['id'];
        }
        return $id;
    }


    public function getOrderIsReady($id){
        $str="";
        $query="Select * from orders where id = $id";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        $rows = array();
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        //checks if the order is cooked or not, if it is cooked you cannot see the detailed order anymore
        if($rows[0]['isReady'] == 0) $str="OK";
        else {
            $str = "NOTOK";
        }
        return $str;
    }

    public function getProducts(){
        $query = "Select * from `products`";
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

    public function getOrderById($id){
        $query = "Select * from `orders` where id=$id";
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


    public function getProductQuantity($id){
        $query = "Select * from products WHERE id = $id";
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            exit();
        }

        $productquantity = "";
        while($row = $result->fetch_assoc()){
            $productquantity = $row['quantity'];
        }
        return $productquantity;
    }


    public function getProductThreshold($id){
        $query = "Select * from products WHERE id = $id";
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            exit();
        }

        $threshold = "";
        while($row = $result->fetch_assoc()){
            $threshold = $row['threshold'];
        }
        return $threshold;
    }
	
	//this function is used so no two chefs who have logged in at the same time can take the same order
    //When the chef prepares the order the other chef cannot get the order
    public function checkForStatus($id){
        $query = "Select * from orders where id=$id";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            exit();
        }
        $status = "";
        while($row = $result->fetch_assoc()){
            $status = $row['status'];
        }
        return $status;

    }
}