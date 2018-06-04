<?php

require 'sessionTable.php';
require_once 'crudAdmin.php';
require_once 'crudChef.php';
require_once 'validate.php';

$p = new \core\people\crudAdmin();
$result = $p->getDishes();
$price = 0;

$valid = new \core\user\validate();



if(isset($_POST['send'])){
    $quantities= $_POST['quantities']."<br>";
    $ids= $_POST['ids'];
    $descr = $valid->checkDescription($_POST['desc']);
    $total = $_POST['price'];

    $id = explode(" ", $ids );
    $amount = explode(" ", $quantities);

    //print_r($id);
    //print_r($amount);

    $chef = new \core\people\crudChef();
    $con = $chef->checkPreviousOrder($login_session['tableNumber']);
    if ($con) {
        $result = $chef->createOrder($login_session['tableNumber'], $total);
        $order = $chef->fetchOrder($login_session['tableNumber']);
        $orderId = $order['id'];
        $_SESSION['orderId'] = $orderId;

        $add = $chef->addToOrder($id, $amount, $orderId, $total);
        $add1 = $chef->addDescription($descr, $orderId);
        if ($add) {
            echo "<script>alert('Success')</script>";
            header("Location:successfulOrder.php");
        }
        //echo $login_session['tableNumber'];
    }
    else {
        //echo "<script>alert('There is already a sent order')</script>";
        //sleep(5);
        //header("Location: showTable.php", true, 303);
        $order = $chef->fetchOrder($login_session['tableNumber']);
        $orderId = $order['id'];
        $_SESSION['orderId'] = $orderId;
        $oPrice = $order['amount'] + $total;
        $add = $chef->addToOrder($id, $amount, $orderId, $oPrice);
        $add1 = $chef->addDescription($descr, $orderId);
        if ($add) {
            echo "<script>alert('Success')</script>";
            //header("Location:successfulOrder.php");
        }
    }

}
?>

<html>
<head>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<div class="main">
    <header>
        <div class="container_12">
            <div class="grid_12">
                <div class="menu_block"style=" width: 100%;">
                    <h1 >Welcome Table <?php echo $login_session['tableNumber'];?></h1>
                    <nav>
                        <ul class="sf-menu">
                            <li class="with_ul"><a href="showTable.php">GO BACK</a></li>
                        </ul>
                    </nav>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </header>
    <div class="content page1">
        <div class="container_12">

            <div id="txtHint">
                <?php
                if($login_session['isAvailable'] == 'no') {
                    if (isset($_POST['subOrder'])) {
                        echo "<div class='table-responsive'><br><br>";
                        echo "<form method='post'><table class='table' border='1'><tr><th>Name</th><th>Description</th><th>Amount</th><th>Price</th></tr>";

                        $ids = "";
                        $quantities = "";
                        foreach ($result as $value) {
                            if (isset($_POST['quantity' . $value['id']]) && isset($_POST['name' . $value['id']]) && $_POST['quantity' . $value['id']] != 0) {
                                $price += $value['price'] * $_POST['quantity' . $value['id']];
                                echo "<tr><td>" . $_POST['name' . $value['id']] . "</td><td>" . $value['description'] . "</td><td>" . $_POST['quantity' . $value['id']] . "</td><td>$" . $value['price'] * $_POST['quantity' . $value['id']] . "</td>";
                                $ids .= $value['id'] . " ";
                                $quantities .= $_POST['quantity' . $value['id']] . " ";
                            }
                        }
                        echo "<tr><td  colspan='2'>EXTRA DESCRIPTION: </td><td colspan='2'><textarea name='desc'>" . $_POST['more'] . "</textarea></td></tr>";
                        echo "<tr><td colspan='4'>TOTAL AMOUNT: $ $price </td></tr></table>";
                        echo "<input type='hidden' name='ids' value='$ids'>";
                        echo "<input type='hidden' name='quantities' value='$quantities'>";
                        echo "<input type='hidden' name='price' value='$price'>";
                        echo "<input type='submit' value='SEND ORDER' name='send'></form>";
                    }
                }

                else echo "<script>alert('Table is not busy.')</script>";
                ?>
            </div>

            <div class="clear"></div>
            <div class="grid_12">
                <div class="hor_separator"></div>
            </div>
            <div class="clear"></div>
        </div>

    </div>
    <footer>
        <div class="container_12">
            <div class="grid_12"> RMS &copy; 2018 | <a href="#">Privacy Policy</a> | </div>
            <div class="clear"></div>
        </div>
    </footer>
</div>
</body>
</html>
