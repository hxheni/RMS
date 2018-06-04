<?php
session_start();
require_once 'database.php';
//check if user is logged in
//retrieve all info of that user

$db = new \core\database();
$db->connect();

$user_check = $_SESSION['login_user'];
$query = "Select * from tables WHERE tableNumber ='" .$user_check."'";
$sql = mysqli_query($db->connection, $query);
//$login_session = mysqli_fetch_array($sql, MYSQL_ASSOC);
$login_session = $sql->fetch_assoc();

if(!isset($_SESSION['login_user'])){
    header("Location:index.php");
}
?>