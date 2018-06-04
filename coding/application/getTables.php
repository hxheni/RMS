<?php
session_start();

require "crudAdmin.php";
require "crudTable.php";
if(isset($_SESSION['adminId'])){

$crd = new \core\people\crudAdmin();

$result = $crd->getTables();
$cnt = 0;
$display = "<table width='100%'><tr>";

foreach($result as $row){
    $avail = $row['isAvailable'];
    $photo_src = "";
    if($avail=="yes"){
        $avail = "It is available";
        $photo_src = "images/available.png";
    }else{
        $avail = "It is not available";
        $photo_src = "images/busy.png";
    }
    if($cnt==0){
        $display.="<td valign='middle'><a href='add_table.php'><h1 style='font-size: 35px'>Click to </h1><h1 style='font-size: 35px'>add Table</h1></a></td>";
        $cnt++;
    }
    $display.="<td><a href='open_table.php?tid=".$row['tableNumber']."'><div class='tableDiv'>
        <img src='$photo_src' width='100px' height='100px'>
        <p style='color: black;'>Table ".$row['tableNumber']."</p>
        <p style='color: black;' id='table".$row['tableNumber']."'>".$avail."</p>
        <p style='color: black;'>Password is \"".$row['password']."\"</p>
        <p style='color: black;'>Number of chairs: <b>".$row['numChairs']."</b></p></div></a></td>";
    $cnt++;
    if(($cnt)%3==0){
        $display.="</tr><tr>";
    }
}
$display.="</tr></table>";
?>
<html>
<head>

    <link rel="icon" href="images/favicon.ico">
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/slider.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="js/login.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/jquery-migrate-1.1.1.js"></script>
    <script src="js/superfish.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/sForm.js"></script>
    <script src="js/jquery.carouFredSel-6.1.0-packed.js"></script>
    <script src="js/tms-0.4.1.js"></script>

    <style>
        td{
            padding: 10px;
            text-align: center;
        }

        .tableDiv{
            width: 100%;
            height: 100%;
        }

        :hover.tableDiv{
            background-color: lightgray;
        }
    </style>


</head>
<body>
<?php
echo $display;
?>
<?php }else{
    echo "<script>alert('You are not allowed to enter this page')</script>";
} ?>
</body>
</html>