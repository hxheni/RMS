<?php
require "session.php";
require_once "crudAccountant.php";

$acc = new \core\people\crudAccountant();

$status=$_POST['status'];
$amount=$_POST['amount'];
$desc=$_POST['desc'];

$tr = new \core\transaction\transaction($amount, $login_session['id'], $status, $desc);

$result = $acc->addTransaction($tr);
if($result) $_SESSION['transaction'] = 1;
else echo "You didn't fill in the form according to the specified rules. Go <a href='showUser.php'>back</a> and try again";

if ($result) header("Location: showUser.php");
?>