<?php
session_start();
require "crudAdmin.php";
if(isset($_GET['id'])){
    $crd= new \core\people\crudAdmin();
    $crd->deleteNotification($_GET['id']);
    header('Location:admin.php');
}