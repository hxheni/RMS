<?php
session_start();

require "crudAdmin.php";

if(isset($_SESSION['adminId'])){
$crd = new \core\people\crudAdmin();

$result = $crd->getProducts();

$display = "<div class='table-responsive'><br><br><table class='table' width='90%' style='font-size: 20px' align='center'>";
$display.="<tr><td style='padding: 15px;' valign='middle'>Name</td><td style='padding: 15px;' valign='middle'>Quantity</td>
    <td style='padding: 15px;' valign='middle'>Price</td><td style='padding: 15px;' valign='middle'>Measurement</td></tr>";
foreach($result as $row){
    $display.="<tr id='tr_p'>";
    $display.="<td style='padding: 15px;' valign='middle'>".$row['name']."</td>";
    $display.="<td style='padding: 15px;' valign='middle'>".$row['quantity']."</td>";
    $display.="<td style='padding: 15px;' valign='middle'>".$row['price']."</td>";
    $display.="<td style='padding: 15px;' valign='middle'>".$row['measurement']."</td>";
    $display.="</tr>";
}
$display.="</table></div>";
?>
<html>
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        #tr_p:hover {
            text-decoration: none;
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
    echo "<script>alert('You are not allowed to enter this page.')</script>";
    echo "<a href='index.php'>Back</a>";
}?>

</body>
</html>

