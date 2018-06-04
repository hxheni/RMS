<?php

require 'sessionTable.php';
require_once 'crudAdmin.php';
require_once 'crudChef.php';

$adm = new \core\people\crudAdmin();

if($login_session['isAvailable'] == 'yes') $_SESSION['orderId'] = NULL;
echo "<script>alert(".$login_session['isAvailable'].")</script>";

$str="";

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

    <script>

        function showHint(str) {

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "showDish.php?type="+str, true);
            xmlhttp.send();
        }

        function showHint2(str,i) {

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("order").innerHTML += this.responseText;
                    document.getElementById(""+i).setAttribute("disabled",true);
                }
            }
            xmlhttp.open("GET", "getDishInfo.php?id="+str, true);
            xmlhttp.send();
        }
    </script>
</head>
<body onload="showHint('all')" style="background-color: lightblue">
<div class="main">
    <header>
        <div class="container_12">
            <div class="grid_12">
                <h1><a href="showTable.php"><img src="images/logo.png" alt=""></a></h1>
                <div class="menu_block">
                    <nav>
                        <ul class="sf-menu">
                            <li class="with_ul"><a href="#" onclick="showHint('all')">MENU</a>
                                <ul>
                                    <li><a href="#" onclick="showHint('dishes')">DISHES</a></li>
                                    <li><a href="#" onclick="showHint('pizza')">PIZZA</a></li>
                                    <li><a href="#" onclick="showHint('pasta')">PASTA</a></li>
                                    <li><a href="#" onclick="showHint('desert')">DESSERT</a></li>
                                    <li><a href="#" onclick="showHint('drink')">DRINK</a></li>
                                </ul>
                            </li>
                            <li><a>STATUS:<?php if ($login_session['isAvailable'] == 'no') echo "BUSY"; else echo "AVAILABLE"?></a></li>
                            <?php
                            $chef = new \core\people\crudChef();
                            if (isset($_SESSION['orderId'])){
                                $str = $chef->getOrder($_SESSION['orderId']);
                                ?>
                                <li><a href="">ORDER <?php echo $_SESSION['orderId']." ".$str;?></a></li>
                            <?php }
                            ?>
                            <?php
                            if($str == 'SENT'){
                            ?>
                            <li><a href="#" onclick="document.getElementById('id01').style.display='block'">VIEW ORDER</a></li>
                            <?php }
                            ?>
                        </ul>
                    </nav>
                    <div class="clear"></div>
                    <div class="clear"></div>

                    <div id="id01" class="modal">
                        <?php
                        include 'viewOrder.php';
                        ?>
                    </div>
                </div>


                <div class="clear"></div>
            </div>
        </div>
    </header>

    <div class="content page1">
        <div class="container_12">

            <div id="txtHint"></div>

            <div class="clear"></div>
            <div class="grid_12">
                <div class="hor_separator"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="container_12">

            <div>
                <form method="post" action="confirmRequest.php" target="_blank">
                    <div id="order">
                        <h2>Your order list:</h2>
                    </div>
                    <div class="clear"></div>
                    <div class="grid_12">
                        <div class="hor_separator"></div>
                    </div>
                    <div class="clear"></div>
                    <br>
                    <textarea name="more" placeholder="Enter extra information about your order..." rows="5" cols="60"></textarea>
                    <button type="submit" name="subOrder">Confirm Order</button>
                </form>
            </div>
        </div>
    </div>
</div>
<footer>
    <div class="container_12">
        <div class="grid_12"> RMS &copy; 2018 | <a href="#">Privacy Policy</a> | </div>
        <div class="grid_12"> Follow us on | <a href="http://facebook.com">Facebook</a> | </div>
        <div class="clear"></div>
    </div>
</footer>
</body>
</html>

}