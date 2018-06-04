<?php
//require 'session.php';
require_once 'crudAccountant.php';

$accountant = new \core\people\crudAccountant();
$str1="";

$result = $accountant->getProducts();
$j=0;
//echo "<br>&nbsp;&nbsp;&nbsp;<button onclick=\"document.getElementById('id03').style.display='block'\">Add new Product</button>";
echo "<input type=\"text\" id=\"myInput\" onkeyup=\"myFunction()\" placeholder=\"Search for names..\" title=\"Type in a name\" >";
echo "<div class='table-responsive'><table class='table'>";
echo "<tr style='background-color: lightgoldenrodyellow'><th>ID</th><th>Name</th><th>Quantity</th><th>Price</th><th>Delete Product</th>";
echo "<form method='post' action='editProd.php'>";
foreach ($result as $value){
	if($value['quantity'] <= $value['threshold']){
    echo "<tr style='background-color:salmon'><td>".$value['id']."</td><td>".$value['name']."</td><td><input type='number' name='quantity".$j."' value='".$value['quantity']."'></td><td><input type='text' size='5' name='price".$j."' value='".$value['price']."'></td><td><a href='deleteProduct.php?id=".$value['id']."'>Delete Product</a></td>";
    echo "</tr>";
	}
	else {
		echo "<tr><td>".$value['id']."</td><td>".$value['name']."</td><td><input type='number' name='quantity".$j."' value='".$value['quantity']."'></td><td><input type='text' size='5' name='price".$j."' value='".$value['price']."'></td><td><a href='deleteProduct.php?id=".$value['id']."'>Delete Product</a></td>";
    echo "</tr>";
	}
    $j++;
}
echo "<tr><td colspan='5' align='right'><button name='product' value='Save changes' onclick=\"return confirm('You are about to update the changes made. Are you sure you want to proceed?')\">Save Changes</button></td></tr></form>";
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

