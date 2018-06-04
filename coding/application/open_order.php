<?php
session_start();
require "crudChef.php";
require "crudAdmin.php";

$crd = new \core\people\crudChef();
$crd1 = new \core\people\crudAdmin();
if($crd->checkForStatus($_GET['id'])==0){

if(isset($_SESSION['chefId']) && is_numeric($_GET['id'])){
    $str = $crd->getOrderIsReady($_GET['id']);
    if($str == "NOTOK"){
        echo "This order cannot be processed anymore!";
    }else{

$arr = array();
$cnt = 0;

$all = "<form method='post' id='form'><table border='1px' style='font-size: 25px; margin: auto;'>
        <tr><td style='padding: 25px;'>Menu item</td><td style='padding: 25px;'>Products</td></tr>";

if(isset($_GET['id'])){
    $res = $crd->viewOrder($_GET['id']);
    foreach ($res as $value){
        $dishname = "";
        $amount = $value['amount'];
        $re1 = $crd->getDish($value['dishId']);
        foreach ($re1 as $s){
            $dishname = $s['name'];
        }
        $all.="<tr><td style='padding: 25px;'>".$dishname." x <b>".$amount."</b></td>";
        $all.="<td style='padding: 25px;'><table>";
        $res2 = $crd->viewProducts($value['dishId']);
        foreach ($res2 as $row){
            $name = "input".$cnt;
            $all.="<tr><td style='padding: 10px;'>".$crd->getProduct($row['productId'])."</td><td style='padding: 10px;'>".$row['quantity'].
                "</td><td style='padding: 10px;'>".$crd->getProductMeasurement($row['productId'])."</td>
                <td><input type='checkbox' style='width: 20px; height: 20px' name='$name' checked></td>";
                $cnt++;
                $all.="</tr>";

                $name7 = $crd->getProduct($row['productId']);
                $quantity = $crd->getProductQuantity($row['productId']);
                $threshold = $crd->getProductThreshold($row['productId']);
                $message = "The product with name = $name7 is running out";
                $notif = new \core\notification\notification(9, $_SESSION['chefId'], $message);
                if($quantity<$threshold){
                    $crd->sendNotif($notif);
                }


        }
        $all.="</table></tr>";
    }
    $all.="<tr><td align='center'><input name='prepare' style='background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;' type='submit' value='Start preparing this order'></td>
    <td><input type='submit' name='editOrder' value='Add new items' style='background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;'></td></tr>";
    $all.="</table>";
    $all.="</form>";
}

if(isset($_POST['prepare']) || isset($_POST['editOrder'])){
    if($crd->checkForStatus($_GET['id'])==1){
        echo "<script>alert('Sorry, another chef just started preparing this order')</script>";
        header('Location:chef.php');
    }
    $crd->takeOrder($_GET['id'], $_SESSION['chefId']);

    //if()
    for($i=0;$i<$cnt;$i++){
        $name2 = "input".$i;
        if(isset($_POST[$name2])){
            //this means we have to take out of the database the product with this array index
            $arr[$i] = 1;
        }else{
            $arr[$i] = 0;
        }
    }
}

$val = 0;
if(isset($_POST['prepare']) || isset($_POST['editOrder'])){
    $result = $crd->viewOrder($_GET['id']);
    foreach($result as $value){
        //here we get the id-s of the dishes in the order
        $dishId = $value['dishId'];
        $amount = $value['amount'];
        //here we see the products that contain each dish
        $result2 = $crd->viewProducts($dishId);
        foreach ($result2 as $row){
            //here we see if the checkbox for that item is checked
            //if it is checked it is removed from the database, else it is not removed
            if($arr[$val]==1) {
                //here we subtract the quantities of the products from the table
                for($num=0;$num<$amount;$num++) {
                    $crd->removeProduct($row['productId'], $row['quantity']);
                    //this checks for the product quantity
                    //if the quantity is smaller that 0 there is an alert that says
                    //'Not all products are found in the database for the moment, this order may take a while or send a notification to the accountant
                    $qnt = $crd1->checkProductQuantity($row['productId']);
                    if($qnt<0){
                        echo "<script>alert('The products in this order are not all in the database, so this order may take a while')</script>";
                    }
                }
            }
            $val++;
        }
    }

    echo "<script>alert('Products removed from the database!')</script>";
    if(isset($_POST['editOrder'])){
        $_SESSION['orderId']  = $_GET['id'];
        header('Location: add_to_order.php');
    }else {
        header('Location: chef.php');
    }
}



?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="images/favicon.ico">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/login.css">

</head>
<body>
<a href="chef.php">Back</a>
<?php echo $all; ?>
</body>
<?php }}else{
    echo "You have no rights to enter this page";
}
//this one is if the order is selected before by another chef
}else{
    echo "<script>alert('Sorry another chef just accessed this order so you can\'t take it again')</script>";
    header('Location: chef.php');
}?>
</html>