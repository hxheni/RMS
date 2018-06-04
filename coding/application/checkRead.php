<?php
require 'session.php';
require_once 'crudAccountant.php';

$acc = new \core\people\crudAccountant();

$result=$acc->readNotif($_POST['id']);
if($result) header("Location:viewNotifications.php");
?>