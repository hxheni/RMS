<?php

require_once 'session.php';
require_once 'crudAccountant.php';
require_once 'crudChef.php';

if(isset($_POST['subSal'])){
$accountant = new \core\people\crudAccountant();
$result = $accountant->getStaff();
$admin = new \core\people\crudChef();
$i=0;


    foreach ($result as $value){
        //echo $value['id']." ".$_POST['salary'.$i];
        if($_POST['salary'.$value['id']] != ''){
        $success = $accountant->editSalary($value['id'], $_POST['salary'.$value['id']]);
        $update = $accountant->updateSalary($value['id'], date('M'), date('Y'));
            $t = new \core\transaction\transaction($_POST['salary' . $value['id']], $login_session['id'], 'dalje', 'rroga');
            $okay = $accountant->addTransaction($t);
            if($okay){
                $tr = new \core\notification\notification($value['id'], $login_session['id'], "Rroga e ketij muaji u fut me sukses.");
                $confirm = $admin->sendNotif($tr);
            }

        }

    }

    $_SESSION['staffEd'] = 1;
    header("Location:showUser.php");
}

?>