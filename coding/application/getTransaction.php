<?php
session_start();

if(isset($_SESSION['adminId'])){
require "crudAdmin.php";

$crd = new \core\people\crudAdmin();

$result = $crd->getTransaction();

$display = "<div class='table-responsive'><table class='table'>";
$display.="<tr><td style='padding: 15px' valign='middle'>Transaction Maker</td>
    <td style='padding: 15px' valign='middle'>Status</td><td style='padding: 15px' valign='middle'>Amount</td>
    <td style='padding: 15px' valign='middle'>Description</td></tr>";
foreach($result as $row){
    $display.="<tr id='tr_t'>";
    $res = "";
    $tMakerName = "";
    if(is_numeric($row['transmakerId'])){
        $res = $crd->retrieveMember($row['transmakerId']);
        foreach ($res as $item){
            $tMakerName = $item['username'];
        }
    }else{
        $tMakerName = $row['transmakerId'];
    }
    $display.="<td style='padding: 15px' valign='middle'>".$tMakerName."</td>";

    $display.="<td style='padding: 15px' valign='middle'>".$row['status']."</td>";
    $display.="<td style='padding: 15px' valign='middle'>".$row['amount']."</td>";
    $display.="<td style='padding: 15px' valign='middle'>".$row['description']."</td>";
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
        td{
            text-align: center;
        }

        #tr_t:hover {
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

