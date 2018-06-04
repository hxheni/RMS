<?php
session_start();
require "crudChef.php";

$crd = new \core\people\crudChef();

$result = $crd->seeNotification($_SESSION['chefId']);

$display1 = "<div class='table-responsive' style='width: 100%; font-size: 17px; text-align:center;'><br><br>";
$display1.= "<table class='table' style='width: 100%'><tr><td width='20%' style='padding: 15px;'>From</td>
    <td style='padding: 15px;'>Message</td><td width='30%'></td></tr>";

foreach ($result as $row){
    $id1 = $row['id'];
    $display1.="<tr id='tr_'><td style='padding: 15px;font-size: 20px;' width='20%'>".
        $crd->getMemberUsername($row['senderId']).
        "</td><td style='padding: 15px; font-size: 20px;' width='50%'>".
        $row['text']."</td><td valign='middle' width='30%'><a href='delete_notif.php?id=$id1'><button class='ghost'>Delete notification</button></a></td></tr>";
}
$display1.="</table>";
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        #tr_:hover {
            text-decoration: underline;
            padding: 10px;
            background: lightgray;
            color: white;
            margin: 0 0 5px 0;

            -webkit-transition: all 0.2s ease;
            -moz-transition: all 0.2s ease;
            -o-transition: all 0.2s ease;
        }
    </style>
</head>
<body>
<?php echo $display1; ?>
</body>
</html>
