<?php
require 'session.php';
require_once 'crudAccountant.php';

$acc = new \core\people\crudAccountant();

if(isset($_GET['id'])){
    $result = $acc->deleteSupplier($_GET['id']);
    if($result) header("Location: suppliers.php");
}
