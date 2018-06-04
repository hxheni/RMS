<?php
session_start();

require "crudAdmin.php";
if(isset($_SESSION['adminId'])){

$crd = new \core\people\crudAdmin();

$result = $crd->getOrders();

$display = "<div class='table-responsive'><table class='table' width='90%' style='font-size: 20px; margin: 10px' align='center'>";
$display.="<tr><td style='padding: 15px' valign='middle'>Table Num</td><td style='padding: 15px' valign='middle'>Chef</td>
    <td style='padding: 15px' valign='middle'>Waiter</td><td style='padding: 15px' valign='middle'>Amount</td></tr>";
foreach($result as $row){
    if($row['paid']==1) {
        $display .= "<tr id='tr_'>";
        $display .= "<td style='padding: 15px' valign='middle'>" . $row['tableId'] . "</td>";
        $res = $crd->retrieveMember($row['chefId']);
        $chef = "";
        foreach($res as $item) {
            $chef = $item['username'];
        }

        $display .= "<td style='padding: 15px' valign='middle'>" . $chef . "</td>";
        $res = $crd->retrieveMember($row['waiterId']);
        $waiter = "";
        foreach ($res as $item){
            $waiter = $item['username'];
        }
        $display .= "<td style='padding: 15px' valign='middle'>" . $waiter. "</td>";
        $display .= "<td style='padding: 15px' valign='middle'>" . $row['amount'] . "</td>";
        $display .= "</tr>";
    }
}
$display.="</table></div>";
?>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        #tr_:hover {
            text-decoration: underline;
            padding: 10px;
            background: lightgray;
            color: white;
            text-align: center;
            margin: 0 0 20px 0;

            -webkit-transition: all 0.2s ease;
            -moz-transition: all 0.2s ease;
            -o-transition: all 0.2s ease;
        }
    </style>
</head>
<body>
<?php
echo $display;
?>
<?php }else{
    echo "<script>alert('You are not allowed to enter this page')</script>";
}?>

</body>
</html>
