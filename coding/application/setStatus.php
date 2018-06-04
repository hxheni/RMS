<?php
include 'session.php';
include_once 'crudWaiter.php';

$waiter = new \core\people\crudWaiter();

$result = $waiter->setTableStatus($_POST['id'], $_POST['method']);
if($result) {echo "<script>alert('Status Changed')</script>";
header("Location: showWaiter.php");
}

?>