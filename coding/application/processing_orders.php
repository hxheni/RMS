<?php
session_start();
require "crudChef.php";

$crd = new \core\people\crudChef();

$orders = "";

$result = $crd->getProcessingOrders($_SESSION['chefId']);

echo "<div class='table-responsive' style='width: 100%; font-size: 17px; text-align: center'><br><br>";
echo "<table class='table' style='width: 100%'><tr><td style='padding: 20px'>Order Number</td><td style='padding: 20px'>List of dishes</td>";
echo "<td style='padding: 20px'>Finish Order</td></tr>";
foreach($result as $row){
    echo "<tr style=\"vertical-align:middle\"><td valign='middle' style='padding: 25px'>Order ".$row['id']."</td><td align='center'><table align='center'>";
    $res = $crd->viewOrder($row['id']);
    foreach ($res as $value){
        $res1 = $crd->getDish($value['dishId']);
        $dishname = "";
        foreach ($res1 as $value1){
            $dishname = $value1['name'];
        }
        echo "<tr><td align='center' style='padding: 7px'>$dishname</td></tr>";
    }
    echo "</table></td>";
    $oid = $row['id'];
    echo "<td valign=''><a href='confirm_order.php?id=$oid'><button class='ghost'>DONE</button></a></td></tr>";
}
echo "</table></div>";


?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>

</html>