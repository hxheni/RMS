<?php
include_once 'session.php';
include_once 'crudWaiter.php';
include_once 'crudAccountant.php';

$waiter = new \core\people\crudWaiter();
$acc = new \core\people\crudAccountant();

if(isset($_POST['method']) && isset($_POST['id'])){
    if($_POST['method'] == 'accept'){
        $result = $waiter->acceptOrder($_POST['id'], $login_session['id']);
        if($result) header("Location:showWaiter.php");
    }
    else if($_POST['method'] == 'confirm'){
        $result = $waiter->confirmPayment($_POST['id']);
        if($result) {
            $amount = $_POST['amount'];
            $t = new \core\transaction\transaction($amount, $login_session['id'], "hyrje", "porosi");
            $confirm = $acc->addTransaction($t);
            if ($confirm) header("Location:showWaiter.php");

        }
    }
}

?>