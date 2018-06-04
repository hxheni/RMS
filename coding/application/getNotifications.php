<?php
session_start();

require "crudAdmin.php";

$crd = new \core\people\crudAdmin();

$result = $crd->checkNotification($_SESSION['adminId']);

$display = "<div class='table-responsive'>";
$display = "<table class='table' border='1px' width='90%' style='
        font-size: 20px;
        margin: 25px;'>";
$display.="</td><td>Sender</td><td>Message</td></tr>";
foreach($result as $row){
    $res = $crd->retrieveMember($row['senderId']);
    $name = "";
    foreach($res as $item) {
        $name = $item['username'];
    }
    $id= $row['id'];
    $display.="<tr id='tr_'><td valign='middle'>".$name.
        "</td><td valign='middle'>".$row['text']."</td><td><a href='delete_notif.php?id=$id'><button class='ghost'>Delete</button></a></td></tr>";
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
            padding: 10px;
            text-align: center;
        }

        #tr_:hover {
            text-decoration: none;
            padding: 10px;
            background: #538b1e;
            color: white;
            text-align: center;
            margin: 0 0 5px 0;

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

</body>
</html>