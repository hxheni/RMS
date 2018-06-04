<?php

require_once 'session.php';
require_once 'crudAccountant.php';
require_once 'crudAdmin.php';
require_once 'crudChef.php';


$crd = new \core\people\crudChef();
if(isset($_POST['sendNotif'])){
    $receiverId = $crd->getMemberIdByUsername($_POST['receiver']);
    $notif = new \core\notification\notification($receiverId, $login_session['id'], $_POST['descr']);
    $crd->sendNotif($notif);

}

$crud = new \core\people\crudAdmin();

$staff = $crud->getEmployees();

if(isset($_SESSION['adminId'])){
?>

    <html>
    <head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
            function loadWorkers() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "getWorkers.php", true);
                xhttp.send();
            }

            function loadTables() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "getTables.php", true);
                xhttp.send();
            }

            function loadProducts() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "getProducts.php", true);
                xhttp.send();
            }

            function loadOrders() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "getOrders.php", true);
                xhttp.send();
            }

            function loadTransaction() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "getTransaction.php", true);
                xhttp.send();
            }

            function loadNotifications() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "getNotifications.php", true);
                xhttp.send();
            }

            //adjusting the width of the left_menu div and main

        </script>
    </head>
    <body style="background-color: lightblue">
    <div class="main">
        <header>
            <div class="container_12">
                <div class="grid_12">
                    <div class="menu_block" style=" width: 100%;">
                        <h1 >Welcome <?php echo $login_session['name']." ". $login_session['surname']. "."?></h1>
                        <nav>
                            <ul class="sf-menu">
                                <li class="with_ul"><a href="add_menu.php" target="_blank">Add on Menu</a></li>
                                <li class="with_ul"><a onclick="loadNotifications()">Notifications</a>
								<ul>
									<li><a onclick="document.getElementById('id02').style.display='block'">Send Message</a></li>
								</ul></li>
                                <li class="with_ul"><a onclick="loadWorkers()">Staff</a></li>
                                <li class="with_ul"><a onclick="loadTables()">Tables</a></li>
                                <li class="with_ul"><a onclick="loadProducts()">Products</a></li>
                                <li class="with_ul"><a onclick="loadOrders()">Orders</a></li>
                                <li class="with_ul"><a onclick="loadTransaction()">Transactions</a></li>
                                <li class="with_ul"><a href="logout.php">Log Out</a></li>
                            </ul>
                        </nav>
                        <div class="clear"></div>
                        <div class="clear"></div>
						
						<div id="id02" class="modal">

                        <form class="modal-content animate" method="post" action="">
                            <div class="imgcontainer">
                                <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
                            </div>

                            <div class="container" style='background: rgba(255,255,255,0.4); width:100%'>

                                <label for="name"><b>Who will you send the notification to?</b></label>
                                <select name="receiver">
                                    <?php
                                        foreach($staff as $value){
                                            echo "<option value='".$value['username']."'>".$value['username']."</option>";
                                        }
                                    ?>

                                </select><br>

                                <label for="surname"><b>Description</b></label>
                                <textarea placeholder="Enter your message here ..." name='descr' ></textarea><br>

                                <button type="submit" name="sendNotif">SEND</button>
                            </div>

                            <div class="container" style="background-color:#f1f1f1; width:100%; background: rgba(255,255,255,0.4);">
                                <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
                            </div>
                        </form>
                    </div>
						
                    </div>
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

        </div>




        <div id="show" style="background-color: whitesmoke"></div>
    </div>
    <footer>
        <div class="container_12">
            <div class="grid_12"> RMS &copy; 2018 | <a href="#">Privacy Policy</a> | </div>
            <div class="clear"></div>
        </div>
    </footer>
    <?php }
    else{
    echo "<script>alert('You are not allowed to enter this page!')</script>";
    }?>
    </body>
    </html>

