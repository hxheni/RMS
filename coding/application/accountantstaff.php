<?php
require_once 'session.php';
require_once 'crudAccountant.php';

$accountant = new \core\people\crudAccountant();

$result = $accountant->getStaff();
$str="";

$i=0;

echo "<div class='table-responsive'><table class='table'>";
echo "<tr style='background-color: lightgoldenrodyellow'><td>ID</td><td>Name</td><td>Surname</td><td>Task</td><td>Salary</td>";
echo "<form method='post' action='submitSalary.php'>";
foreach ($result as $value){
    echo "<tr><td>".$value['id']."</td><td>".$value['name']."</td><td>".$value['surname']."</td><td>".$value['task']."</td>";
    if($accountant->checkSalary($value['id'], date('M'), date('Y'))) echo "<td><input type='hidden' name='salary".$value['id']."' value=''>Salary updated for this month</td>";
    else {echo "<td><input type='text' id='salary".$value['id']."' name='salary".$value['id']."' placeholder='Enter salary of this employee: ".$value['salary']."' onkeyup=\"checkSalary(".$value['id'].")\"><span id='errsalary".$value['id']."' ></span></p></td>";}
    echo "</tr>";
    $i++;
}
echo "<tr><td colspan='5' align='right'><button name='subSal' value='Submit Salaries'>Submit Salaries</button></td></tr></form>";
echo "</table></div>";

?>


<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <title>Restaurant Management System</title>
    <meta charset="utf-8">
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
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  


    <style>


        button{
            background:#1AAB8A;
            color:#fff;
            border:none;
            position:relative;
            height:60px;
            font-size:1.6em;
            padding:0 2em;
            cursor:pointer;
            transition:800ms ease all;
            outline:none;
        }
        button:hover{
            background:#fff;
            color:#1AAB8A;
        }
        button:before,button:after{
            content:'';
            position:absolute;
            top:0;
            right:0;
            height:2px;
            width:0;
            background: #1aab8a;
            transition:400ms ease all;
        }
        button:after{
            right:inherit;
            top:inherit;
            left:0;
            bottom:0;
        }
        button:hover:before,button:hover:after{
            width:100%;
            transition:800ms ease all;
        }

    </style>
</head>
</html>




