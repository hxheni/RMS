<?php
session_start();
require "crudChef.php";
if(isset($_SESSION['chefId'])){
$crd = new \core\people\crudChef();

$result = $crd->getSentOrders();

echo "<div class='table-responsive' style='width: 100%; font-size: 17px; text-align: center'><br>Uncooked Orders<br>";
echo "<table class='table' style='width: 100%'><tr><td style='padding: 20px'>Order Number</td><td style='padding: 20px'>List of dishes</td>";
echo "<td style='padding: 20px'>Accept</td></tr>";
foreach($result as $row){
    echo "<tr><td valign='middle' style='padding: 25px'>Order ".$row['id']."</td><td valign='middle' align='center'><table align='center'>";
    $res = $crd->viewOrder($row['id']);
    foreach ($res as $value){
        $res1 = $crd->getDish($value['dishId']);
        $dishname = "";
        $amount = "";
        foreach ($res1 as $value1){
            $dishname = $value1['name'];
            $amount = $value['amount'];
        }
        echo "<tr><td align='center' style='padding: 7px'>$dishname</td><td>$amount</td></tr>";
    }
    echo "<tr><td align='center'>~~~~~~~</td></tr></table></td>";
    $oid = $row['id'];
    echo "<td valign='middle'><a href='open_order.php?id=$oid'><button class='ghost'>Accept this order</button></a></td></tr>";
    }
    echo "</table></div>";


?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<?php }else{
    echo "<script>alert('You are not allowed to enter this page')</script>";
}?>
</html>
