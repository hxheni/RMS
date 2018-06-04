<?php
//checked
namespace core\people;

use core\database;

require_once 'database.php';
require_once 'people.php';
require_once 'dish.php';

class crudAdmin
{
    public $con;

    function __construct(){
        $this->con = new database();
    }

    public function retrieveMember($id)
    {
        $query = "Select * from `people` WHERE id =".$id;
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

    public function deleteMember($id)
    {
        $query = "DELETE FROM `people` WHERE id=".$id;
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        else echo "Member deleted successfully";
        return true;
    }

    public function getOrders(){
        $query = "Select * from `orders`";
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

    public function getDishes(){
        $query = "Select * from `dishes`";
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

    //ky funksion u shtua kur u be bashkimi i fileve
    public function getDishesType($type){
        $query = "Select * from `dishes` where category='$type'";
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

    public function addStaff($person){
        $pass = substr(md5($person->username),0,30);
        $query = "Insert into people(name,surname,username,password,phone,task, photo, salary) VALUES('$person->name','$person->surname','$person->username', '$pass', '$person->phone', '$person->task', '$person->photo', '$person->salary')";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "<script>alert('This worker was not inserted, try again!')</script>";
            //echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        return true;
    }

    public function updateStaff($id, $person){
        $query = "update people set name='$person->name', surname='$person->surname', username='$person->username', phone='$person->phone', task='$person->task', photo='$person->photo', salary='$person->salary' where id=$id";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        return true;
    }

    public function checkNotification($id){
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

    public function getEmployees(){
        $query = "Select * from `people`";
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

    public function getTables(){
        $query = "Select * from `tables`";
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

    public function getTransaction(){
        $query = "Select * from `transaction`";
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            echo "Some error occurred in taking transaction". \mysqli_error($this->con->connect());
            exit();
        }

        $rows = array();
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }

    public function getProductName($id){
        $query = "Select `name` from `products` where `id`=".$id;
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Product not found";
        }
        $dishName = "";
        while($row = $result->fetch_assoc()){
            $dishName = $row['name'];
        }
        return $dishName;
    }

    public function getMeasurement($id){
        $query = "Select `measurement` from `products` where `id`=".$id;
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Product not found";
        }
        $dishName = "";
        while($row = $result->fetch_assoc()){
            $dishName = $row['measurement'];
        }
        return $dishName;
    }

    public function addProductsToDish($dishId, $productId, $quantity){
        $query = "INSERT INTO `d_pr`(`dishId`, `productId`, `quantity`) VALUES ($dishId, $productId ,$quantity)";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "An error occured in inserting the products to dish";
            return false;
        }
        return true;
    }

    public function getProductId($name){
        $query = "Select `id` from `products` where `name`='$name'";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Product id not found";
        }
        $productName="";
        while($row = $result->fetch_assoc()){
            $productName = $row['id'];
        }
        return $productName;
    }

    public function getDishId($name){
        $query = "Select `id` from `dishes` where `name`='$name'";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Dish not found";
        }
        $dishName = "";
        while($row = $result->fetch_assoc()){
            $dishName = $row['id'];
        }
        return $dishName;
    }

    public function updatePeoplePass($id, $pass){
        $query = "update people set password='$pass' where id=$id";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        return true;
    }

    public function updatePeoplePhone($id, $phone){
        $query = "update people set phone='$phone' where id=$id";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        return true;
    }

    public function updatePeopleCategory($id, $category){
        $query = "update people set task='$category' where id=$id";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        return true;
    }

    public function updatePeopleSalary($id, $sal){
        $query = "update people set salary=$sal where id=$id";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        return true;
    }


    public function deleteTable($id)
    {
        $query = "DELETE FROM `tables` WHERE tableNumber=".$id;
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        return true;
    }

    public function deleteNotification($id){
        $query = "Delete from notification where id=".$id;
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occured!";
            exit();
        }
    }

    public function addDish($dish){
        $query = "INSERT INTO `dishes`(`name`, `photo`, `description`, `price`, `category`) VALUES ('$dish->name','$dish->photo','$dish->description',$dish->price,'$dish->category')";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occured in inserting the dish";
            exit();
        }else{
            echo "<script>alert('The new dish added in the menu')</script>";
        }
    }

    public function updatePhotoOfDish($image, $name){
        $query = "update dishes set photo='$image' where name='$name'";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        return true;
    }
	
	//this function returns the quantity of a product in the database
    public function checkProductQuantity($id){
        $query = "Select * from products where id=$id";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occurred";
            exit();
        }
        $quantity = "";
        while($row = $result->fetch_assoc()){
            $quantity = $row['quantity'];
        }
        return $quantity;
    }


}