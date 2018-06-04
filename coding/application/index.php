<?php

require 'login.class.php';
require_once 'validate.php';
require_once 'crudChef.php';

$chef = new \core\people\crudChef();

$result =$chef->getDishes();


$login = new \core\user\login();
$validate = new \core\user\validate();
$db = new \core\database();
$con = $db->connect();
$emailErr = $passErr = $total = "";
//user obj
if(isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $message = $validate->isEmpty($_POST, array('email', 'password'));
    $checkEmail = $validate->checkUsername($email);
    //$checkPassword = $validate->checkPass($password);

    if ($message != "") {
        $total = "*Sorry, blank fields are required to be filled.";
    } else {
        if (!$checkEmail) $emailErr = "Wrong username format";
        //if (!$checkPassword)  $passErr = 'Password is not in the right format.';
        if ($checkEmail) {
            $login->connect($_POST['email'],substr(md5($_POST['password']),0,30));
        }
        //
    }
}
if(isset($_POST['submitTable'])) {
    $email = mysqli_real_escape_string($con,$_POST['tablenum']);
    $password = mysqli_real_escape_string($con,$_POST['password']);

    //$message = $validate->isEmpty($_POST, array('email', 'password'));
    //$checkEmail = $validate->checkEmail($email);
    //$checkPassword = $validate->checkPass($password);

    //if ($message != "") {
    //$total = "*Sorry, blank fields are required to be filled.";
    //}
    //else {
    //if (!$checkEmail) $emailErr = "Wrong email format";
    //if (!$checkPassword)  $passErr = 'Password is not in the right format.';
    //if ($checkEmail && $checkPassword) {
    $login->connectTable($_POST['tablenum'], $_POST['password']);
    //}
    //
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
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
    <script>
        $(window).load(function () {
            $('.slider')._TMS({
                show: 0,
                pauseOnHover: false,
                prevBu: '.prev',
                nextBu: '.next',
                playBu: false,
                duration: 800,
                preset: 'fade',
                pagination: true, //'.pagination',true,'<ul></ul>'
                pagNums: false,
                slideshow: 8000,
                numStatus: false,
                banners: false,
                waitBannerAnimation: false,
                progressBar: false
            })
        });
        $(window).load(function () {
            $('.carousel1').carouFredSel({
                auto: false,
                prev: '.prev',
                next: '.next',
                width: 960,
                items: {
                    visible: {
                        min: 1,
                        max: 4
                    },
                    height: 'auto',
                    width: 240,
                },
                responsive: false,
                scroll: 1,
                mousewheel: false,
                swipe: {
                    onMouse: false,
                    onTouch: false
                }
            });
        });
    </script>
</head>
<body style='background-color:lightblue'>
<div class="main">
    <header>
        <div class="container_12">
            <div class="grid_12">

                <h1><a href="index.php"><img src="images/logo.png" alt=""></a></h1>
                <div class="menu_block">
                    <nav>
                        <ul class="sf-menu">
                            <li class="current"><a href="index.php">Home</a></li>
                         
                            <li><a href="#dish">Menu</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <span style="color: red; font-size: 10pt;"><?php echo $total;?></span>
                            <span style="color: red; font-size: 10pt;"><?php echo $emailErr;?></span>
                            <span style="color: red; font-size: 10pt;"><?php echo $passErr;?></span>
                            <li class="with_ul"><a href="#" style="width: 150px">Log In</a>
                                <ul>
                                    <li><a href="#" onclick="document.getElementById('id01').style.display='block'">Login As User</a></li>
                                    <li><a href="#" onclick="document.getElementById('id02').style.display='block'">Login As Table</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <div class="clear"></div>
                    <div id="id01" class="modal">

                        <form class="modal-content animate" method="post">
                            <div class="imgcontainer">
                                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                            </div>

                            <div class="container">
                                <label for="uname"><b>Username</b></label>
                                <input type="text" placeholder="Enter Username" name="email" required>

                                <label for="psw"><b>Password</b></label>
                                <input type="password" placeholder="Enter Password" name="password" required>

                                <button type="submit" name="submit" style='background-color:lightblue'>Login</button>
                            </div>

                            <div class="container" style="background-color:#f1f1f1">
                                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <div id="id02" class="modal">

                        <form class="modal-content animate" method="post">
                            <div class="imgcontainer">
                                <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
                            </div>

                            <div class="container">
                                <label for="uname"><b>Table Number</b></label>
                                <input type="text" placeholder="Enter table number" name="tablenum" required>

                                <label for="psw"><b>Table Password</b></label>
                                <input type="password" placeholder="Enter Password" name="password" required>

                                <button type="submit" name="submitTable" style='background-color:lightblue'>Login</button>
                            </div>

                            <div class="container" style="background-color:#f1f1f1">
                                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </header>
    <div class="slider-relative">
        <div class="slider-block">
            <div class="slider">
                <ul class="items">
                    <li><img src="images/1.jpg" alt=""></li>
                    <li><img src="images/2.jpg" alt=""></li>
                    <li class="mb0"><img src="images/3.jpg" alt=""></li>
                </ul>
            </div>
        </div>
    </div>
<div class="content page1">
        <div class="container_12">
            <div class="car_wrap">
                <h2 id="dish">Best dishes of our restaurant</h2>
                <a href="#" class="prev"></a><a href="#" class="next"></a>
                <ul class="carousel1">
                    <?php
                    foreach ($result as $value){
                    ?>
                    <li>
                        <div><img src="uploads/<?php echo $value['photo']?>" alt="" width="209px" height="131px">
                            <div class="col1 upp"> <a href="#"><?php echo $value['name']?></a></div>
                            <span><?php echo $value['description']?></span>
                            <div class="price"><?php echo $value['price']?> <b>$</b></div>
                        </div>
                    </li>
                    <?php }?>
                </ul>
            </div>

            <div class="clear"></div>
            <div class="grid_12">
                <div class="hor_separator"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<footer>
    <div class="container_12">
        <div class="grid_12"> RMS &copy; 2018 | <a href="#">Privacy Policy</a> | </div>
        <div class="clear"></div>
    </div>
</footer>
</body>
</html>
