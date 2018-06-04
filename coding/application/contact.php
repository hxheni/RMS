<?php

require_once 'session.php';
require_once 'crudAccountant.php';
require_once 'crudProduct.php';
require_once 'crudAdmin.php';

if($login_session['task'] != 'accountant') header("Location:index.php");

$acc = new \core\people\crudAccountant();
$prod = new \core\products\CRUD();
?>
<html>
<head>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
            height:40px;
            width: 250px;
            font-size:1.4em;
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
<body style="background-color: lightblue">
<div class="main">
    <header>
<div class="container_12">
    <div class="grid_12">
        <div class="menu_block"style=" width: 100%;">
            <h1 >Welcome <?php echo $login_session['name']." ". $login_session['surname']. "."?></h1>
            <nav>
                <ul class="sf-menu">
                    <li class="with_ul"><a href="showUser.php">GO BACK</a></li>
                    <li><a href='#'>My Profile</a>
                        <ul>
                            <li><a href="logout.php">Log Out</a></li>
                        </ul></li>
                </ul>
            </nav>
            <div class="clear"></div>
            <div class="clear"></div>
        </div>
    </div>
</div>
    </header>

    <div class="content page1">
        <div class="container_12">
    <div>
        <?php
        $email ="";

        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $result = $acc->getSupplier($id);
			echo "<br><br><div class='table-responsive'><table class='table'>";

            echo "<tr><td><p><strong>Name:</strong> ".$result[0]['name']."</p></td></tr>";
            echo "<tr><td><p><strong>Phone:</strong> ".$result[0]['phone']."</p></td></tr>";
            echo "<tr><td><p><strong>Description:</strong> ".$result[0]['description']."</p></td></tr>";
            echo "<tr><td><p><strong>Email:</strong> ".$result[0]['email']."</p></td></tr></table></div>";
            echo "<img src='logos/".$result[0]['photo']."' width='200px' height='200px' style='border-radius:50%'> ";

            $email = $result[0]['email'];
        }

        ?>

    </div>
        </div>
    </div>

    <div class="content page1">
        <div class="container_12">
<div>
    <?php
        $result=$prod->getProducts();
    echo "<br><br><div class='table-responsive'><form action='makeRequest.php' method='post'><table id='products' style=\"margin-left: 8%;\" class='table'><form action='' method='post'>";
    echo "<thead style='background-color: lightgoldenrodyellow' align='center'><td colspan='3'>Product List</td></thead>";
    echo "<tr style='background-color: lightgoldenrodyellow'><td>Name</td><td>Quantity</td><td>Price ($)</td>";
    foreach ($result as $value){
        echo "<tr><td>".$value['name']."</td><td><input type='number' min='0' step='1' placeholder='".$value['quantity']." ".$value['measurement']." remaining' name='quantity".$value['id']."'></td><td>".$value['price']."</td>";

        echo "</tr>";
    }

    echo "</table>";

    echo "<p>For any other requests, such as furnitures or kitchen gadgets, write them down here:</p>";
    echo "<textarea placeholder='...' name='description' rows='10' cols='60'></textarea><br>";
    echo "<input type='hidden' name='email' value='".$email."'><button name='subReq' value='Submit Request' onclick=\"return confirm('Do you want to proceed?')\">Submit Request</button></form></div>"


    ?>
</div>
        </div>
    </div>
</div>
<footer>
    <div class="container_12">
        <div class="grid_12"><a href="#" style="color:black"> RMS &copy; 2018 | Privacy Policy</a> | </div>
        <div class="clear"></div>
    </div>
</footer>
</body>
</html>