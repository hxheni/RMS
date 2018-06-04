<?php
session_start();
require "crudChef.php";

$crd = new \core\people\crudChef();

$crd->confirmOrder($_GET['id']);
header('Location: chef.php');
?>