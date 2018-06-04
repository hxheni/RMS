<?php
require 'session.php';
require_once 'crudWaiter.php';

$waiter = new \core\people\crudWaiter();
$result = $waiter->getConfirmedOrders();
echo "<div class='table-responsive'><br><br>";
echo "<table class='table'><tr><td>Order Number</td><td>Table Number</td><td>Accept</td><td>Payment</td><td>Print Receipt</td></tr>";
foreach($result as $value){
    echo "<tr><td>Order ".$value['id']."</td><td>Table ".$value['tableId']."</td>";
    if($value['waiterId'] == 0) {echo "<td><form method='post' action='manageOrder.php'><input type='hidden' name='method' value='accept'><input type='hidden' name='id' value='".$value['id']."'><button type='submit'>OK</button></form></td>";}
    else echo "<td>Accepted!</td>";
    if($value['paid'] == 0) echo "<td><form method='post' action='manageOrder.php'><input type='hidden' name='method' value='confirm'><input type='hidden' name='id' value='".$value['id']."'><input type='hidden' name='amount' value='".$value['amount']."'><button type='submit'>".$value['amount']." $</button></form></td>";
    else echo "<td>Paid!</td>";
    echo "<td><form method='post' action='examples/print.php' target='_blank'><input type='hidden' name='orderId' value='".$value['id']."'><button>Print</button></form></td></tr>";
}
echo "</table></div>";

?>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>

    </script>

</head>
<body>

<div id="process"></div>
