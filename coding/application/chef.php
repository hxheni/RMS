<?php
session_start();
require "crudChef.php";
require_once 'crudAdmin.php';

$admin = new \core\people\crudAdmin();
$staff = $admin->getEmployees();

$crd = new \core\people\crudChef();

if(isset($_SESSION['chefId'])){

    $name = $crd->getMemberUsername($_SESSION['chefId']);

if(isset($_POST['send'])){
    $receiverId = $crd->getMemberIdByUsername($_POST['username']);
    $notif = new \core\notification\notification($receiverId, $_SESSION['chefId'], $_POST['text']);
    $crd->sendNotif($notif);

}

$logout = "<form method='post'><button class=\"ghost\" name='logout'>Log out</button></form>";
if(isset($_POST['logout'])){
    session_destroy();
    header('Location:index.php');
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="icon" href="images/favicon.ico">
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="stylesheet" href="css/style.css">
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
        function loadUnOrders() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML =
                        this.responseText;
                }
            };
            xhttp.open("GET", "uncooked_orders.php", true);
            xhttp.send();
        }

        function loadProcOrders() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML =
                        this.responseText;
                }
            };
            xhttp.open("GET", "processing_orders.php", true);
            xhttp.send();

        }

        function loadNotifications() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML =
                        this.responseText;
                }
            };
            xhttp.open("GET", "see_notifications.php", true);
            xhttp.send();

        }
    </script>
</head>
<body onload="loadUnOrders()" style="background-color: lightblue">
    <div class="main">
        <header>
            <div class="container_12">
                <div class="grid_12">
                    <div class="menu_block" style=" width: 100%;">
                        <h1 >Welcome <?php echo $name;?></h1>
                        <nav>
                            <ul class="sf-menu">
                                <li class="with_ul"><a href="add_menu.php" target="_blank" style='font-size: 15px'>Add on Menu</a></li>
                                <li class="with_ul"><a onclick="loadUnOrders()" style='font-size: 15px'>Uncooked Orders</a></li>
                                <li class="with_ul"><a onclick="loadProcOrders()" style='font-size: 15px'>Processing Orders</a></li>
                                <li class="with_ul"><a onclick="loadNotifications()" style='font-size: 15px'>See notifications</a></li>
                                <li class="with_ul"><button onclick="document.getElementById('notification').style.display='block';" class="ghost" style='font-size: 15px'>Create notification</button></li>
                                <li class="with_ul"><?php echo $logout ?></li>
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

                <div id="txtHint"></div>

                <div class="clear"></div>
                <div class="grid_12">
                    <div class="hor_separator"></div>
                </div>
                <div class="clear"></div>
            </div>

        </div>
        <div id="notification" class="modal">

            <form class="modal-content animate" method="post">
                <div class="imgcontainer">
                    <span onclick="document.getElementById('notification').style.display='none'" class="close" title="Close Modal">&times;</span>
                </div>

                <div class="container" style='width:100%; background: rgba(255,255,255,0.4);'>
                    <label for="uname"><b>Who are you sending</b></label>
                    <select name="username">
                        <?php
                        foreach($staff as $value){
                            echo "<option value='".$value['username']."'>".$value['username']."</option>";
                        }
                        ?>

                    </select><br><br><br>

                    <label for="psw"><b>Message</b></label><br>
                    <input type="text" placeholder="Enter a text of a maximum length 120 characters..." name="text" required>

                    <button type="submit" name="send">Send</button>
                </div>

                <div class="container" style="background-color:#f1f1f1; width:100%;">
                    <button type="button" onclick="document.getElementById('notification').style.display='none'" class="cancelbtn">Cancel</button>
                </div>
            </form>
        </div>



        <div id="show" style="background-color: whitesmoke"></div>
    </div>
    <footer>
        <div class="container_12">
            <div class="grid_12"> RMS &copy; 2018 | <a href="#">Privacy Policy</a> | </div>
            <div class="clear"></div>
        </div>
    </footer>
</div>
<?php }else{
    echo "You have no rights to enter this page";
}?>
</body>
</html>
