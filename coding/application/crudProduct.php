<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 18/05/2018
 * Time: 08:46
 */
//checked
namespace core\products;


use core\database;

require_once 'database.php';
require_once 'products.php';

class CRUD
{

    public $con;

    function __construct()
    {
        $this->con = new database();
    }

    function addProduct($product){
        $query = "Insert into products(name,quantity,price,measurement,threshold) VALUES('$product->name','$product->quantity', '$product->price', '$product->measurement', '$product->threshold')";
        $result = \mysqli_query($this->con->connect(), $query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        return true;
    }

    function getProducts()
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

    public function retrieve($query){
        // connection obj , query
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

    public function updateQuantity($id,$quantity)
    {
        $query = "update products set quantity = $quantity where id = $id";
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        return true;
    }

    public function updatePrice($id,$price)
    {
        $query = "update products set price = $price where id = '$id'";
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        return true;
    }

    public function updateName($id,$name)
    {
        $query = "update products set name = '$name' where id = $id";
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        return true;
    }

    function deleteProduct($id){
        $query = "DELETE FROM products WHERE id=".$id;
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            echo "Some error occurred ". \mysqli_error($this->con->connect());
            return false;
        }
        else echo "Product deleted successfully";
        return true;
    }
}