<?php
//checked
namespace core\people;


use core\database;

require_once 'transaction.php';
require_once 'products.php';
require_once 'supplier.php';

class crudAccountant
{

    public $con;

    function __construct(){
        $this->con = new database();
    }

    public function retrieveMember($id)
    {
        $query = "Select * from people WHERE id =".$id;
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

    //get notifications which have the receiver id the same as this accountantId
    public function checkNotification($id){
        $query = "Select * from notification where receiverId=".$id." order by status asc";
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

    public function readNotif($id){
        $query="update notification set status=1 where id=".$id;
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            exit();
        }   else{
            return true;

        }
    }

    //this function returns the list of suppliers
    public function getSuppliers(){
        $query = "Select * from suppliers";
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

    public function getSupplier($id){
        $query = "Select * from suppliers where id=".$id;
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


    //this function edits the salary of the employee(people)
    //it takes as a parameter the employee id and the salary it changes into
    public function editSalary($id, $sal){
        $query = "Update people set salary=".$sal." where id=".$id;
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            exit();
        }else{
            return true;
        }
    }

    public function updateSalary($id, $month, $year){
        $query = "Insert into salary(staffId,month,year) values($id, '$month', $year)";
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            exit();
        }else{
            return true;
        }
    }

    public function getStaff()
    {
        $query = "Select * from people";
        $result = \mysqli_query($this->con->connect(), $query);
        if (!$result) {
            echo "Some error occurred " . \mysqli_error($this->con->connect());
            exit();
        }
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getProducts()
    {
        $query = "Select * from products";
        $result = \mysqli_query($this->con->connect(), $query);
        if (!$result) {
            echo "Some error occurred " . \mysqli_error($this->con->connect());
            exit();
        }
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
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

    public function checkSalary($id,$month,$year){
        $query = "Select * from salary where staffId = $id and month = '$month' and year = $year";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            return false;
        }
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        if(count($rows) >= 1) return true;
        else return false;

    }

    public function addProduct($product){
        $query = "Select * from products where name='$product->name'";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Error";
            return false;
        }
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        if(count($rows) >= 1) echo "<script>alert('This product already exists')</script>";
        else {
            $add = "insert into products(name,quantity,price,measurement,threshold) values('$product->name',$product->quantity,$product->price, '$product->measurement', $product->threshold)";
            $result = \mysqli_query($this->con->connect(), $add);
            if(!$result){
                echo "Couldn't add product";
                return false;
            } else return true;
        }
    }

    public function getTransactions(){
        $query = "Select * from transaction";
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

    public function getTransaction($id){
        $query = "Select * from transaction where id=$id";
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

    public function deleteProduct($id){
        $query = "delete from products where id=$id";
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            exit();
        }else{
            return true;
        }
    }

    public function deleteSupplier($id){
        $query = "delete from suppliers where id=$id";
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            exit();
        }else{
            return true;
        }
    }

    public function addSupplier($s, $photo){
        $query = "Insert into suppliers(name,phone,description,email,photo) VALUES('$s->name','$s->phone','$s->description', '$s->email', '$photo')";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        return true;

    }

    public function getTransactionsSalary(){
        $query = "Select * from transaction where description = 'rroga'";
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

    public function sendNotif($notif){
        $query = "INSERT INTO notification(senderId, receiverId, text, status) VALUES ('$notif->senderId','$notif->receiverId','$notif->text','$notif->status')";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        return true;
    }
    //get staff
    //crud products
    //contacts supplier with email
    //generate reports
    //add transaction

}