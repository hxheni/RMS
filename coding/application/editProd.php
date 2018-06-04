<?php
require_once 'session.php';
require_once 'crudProduct.php';

if(isset($_POST['product'])){
    $prod = new \core\products\CRUD();
    $result = $prod->getProducts();
    $i=0;


    foreach ($result as $value){
        //echo $value['id']." ".$_POST['salary'.$i];
        $success1 = $prod->updateQuantity($value['id'], $_POST['quantity'.$i]);
        $success2 = $prod->updatePrice($value['id'], $_POST['price'.$i]);
        if(!$success1 or !$success2) {$_SESSION['mistake'] = 1; header("Location:showUser.php");}
        $i++;
    }
    $_SESSION['prodEd'] = 1;
    //echo "<script>alert('Product changes saved!')</script>";
    header("Location:showUser.php");
}

?>