<?php

require_once 'session.php';
require_once 'crudAccountant.php';
require_once 'crudAdmin.php';
require_once 'validate.php';
require_once 'crudChef.php';

if($login_session['task'] != 'accountant') header("Location:index.php");

$accountant = new \core\people\crudAccountant();

if(isset($_SESSION['prodEd']) && $_SESSION['prodEd'] == 1) {echo "<script>alert('Processed!')</script>"; $_SESSION['prodEd'] = 0;}
if(isset($_SESSION['staffEd']) && $_SESSION['staffEd'] == 1) {echo "<script>alert('Salaries changes saved!')</script>"; $_SESSION['staffEd'] = 0;}
if(isset($_SESSION['transaction']) && $_SESSION['transaction'] == 1) {echo "<script>alert('Transaction created successfully')</script>"; $_SESSION['transaction'] = 0;}
if(isset($_SESSION['mistake']) && $_SESSION['mistake'] == 1) {echo "<script>alert('One of the prices entered is not a numeric value! Try again')</script>"; $_SESSION['mistake'] = 0;}


$crd = new \core\people\crudChef();
if(isset($_POST['sendNotif'])){
    $receiverId = $crd->getMemberIdByUsername($_POST['receiver']);
    $notif = new \core\notification\notification($receiverId, $login_session['id'], $_POST['descr']);
    $crd->sendNotif($notif);

}

$admin = new \core\people\crudAdmin();
$staff = $admin->getEmployees();

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











    <script>
        function checkName() {
            var cnt = document.getElementById("name").value;
            if(!/^[A-Za-z ]+$/.test(cnt)){
                document.getElementById("nameerr").innerHTML = "Be careful! You should enter letters only.";
                document.getElementById("name").setAttribute('style', 'background-color: red').innerHTML;

            } else {
                document.getElementById("nameerr").innerHTML = "";
                document.getElementById("name").setAttribute('style', 'background-color: green').innerHTML;

            }
        }

        function checkSurname() {
            var cnt = document.getElementById("surname").value;
            if(!/^[A-Za-z ]+$/.test(cnt)){
                document.getElementById("surnameerr").innerHTML = "Be careful! You should enter letters only.";
                document.getElementById("surname").setAttribute('style', 'background-color: red').innerHTML;

            } else {
                document.getElementById("surnameerr").innerHTML = "";
                document.getElementById("surname").setAttribute('style', 'background-color: green').innerHTML;

            }
        }

        function checkPhone() {
            var cnt = document.getElementById("phone").value;
            if(!/^([+]|[0]{2})[3][5][5][6][679][0-9]{7}$/.test(cnt)){
                document.getElementById("phoneerr").innerHTML = "Enter your phone number in the correct format";
                document.getElementById("phone").setAttribute('style', 'background-color: red').innerHTML;

            } else {
                document.getElementById("phoneerr").innerHTML = "";
                document.getElementById("phone").setAttribute('style', 'background-color: green').innerHTML;

            }
        }

        function checkSalary(i) {
            var cnt = document.getElementById("salary"+i).value;
            if(isNaN(cnt) || cnt < 1 || cnt > 10000){
                document.getElementById("errsalary"+i).innerHTML = "Be careful! You need to enter a numerical value!";
                document.getElementById("salary"+i).setAttribute('style', 'background-color: red').innerHTML;

            } else {
                document.getElementById("errsalary"+i).innerHTML = "";
                document.getElementById("salary"+i).setAttribute('style', 'background-color: green').innerHTML;

            }
        }

        function checkAmount() {
            var cnt = document.getElementById("amount").value;
            if(isNaN(cnt) || cnt < 1 || cnt > 10000){
                document.getElementById("amounterr").innerHTML = "Be careful! You need to enter a numerical value!";
                document.getElementById("amount").setAttribute('style', 'background-color: red').innerHTML;

            } else {
                document.getElementById("amounterr").innerHTML = "";
                document.getElementById("amount").setAttribute('style', 'background-color: green').innerHTML;

            }
        }

        function checkPrice() {
            var cnt = document.getElementById("price").value;
            if(isNaN(cnt) || cnt < 1 || cnt > 100){
                document.getElementById("priceerr").innerHTML = "Be careful! You need to enter a numerical value between 1 and 100!";
                document.getElementById("price").setAttribute('style', 'background-color: red').innerHTML;

            } else {
                document.getElementById("priceerr").innerHTML = "";
                document.getElementById("price").setAttribute('style', 'background-color: green').innerHTML;

            }
        }

        function myFunction() {
            var input, filter, table, tr, td, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

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
    function showHint() {

        document.getElementById('prod').style.display='block';
        document.getElementById('acc').style.display='none';
    }

    function showHint1() {

        document.getElementById('acc').style.display='block';
        document.getElementById('prod').style.display='none';
    }
</script>
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
            <li class="with_ul"><a href="suppliers.php" target="_blank">Suppliers</a></li>
            <li class="with_ul"><a href="viewNotifications.php">Notifications</a>
            <ul><li><a onclick="document.getElementById('id04').style.display='block'">Send notification</a></li></ul></li>
            <li class="with_ul"><a href="#" onclick="document.getElementById('id02').style.display='block'">Create Transaction</a></li>
            <li class="with_ul"><a href="manageTransactions.php">Manage Transactions</a></li>
            <li><a href="#">My Profile</a>
                <ul>
                    <li><a href="#" onclick="document.getElementById('id01').style.display='block'">Edit Profile</a></li>
                    <li><a href="logout.php">Log Out</a></li>
                </ul></li>
        </ul>
    </nav>
    <div class="clear"></div>
    <div id="id01" class="modal" style='overflow:scroll'>

        <form class="modal-content animate" method="post" action="" enctype="multipart/form-data">
            <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            </div>

            <div class="container" style='width:100%'>
                <div><img src="uploads/<?php echo $login_session['photo']?>" width="100px" height="100px"></div>

                <label for="name"><b>First Name</b></label>
                <input type="text" name="name" value="<?php echo $login_session['name']?>" id="name" onkeyup="checkName()" size='16' required><span id="nameerr"></span><br>

                <label for="surname"><b>Last Name</b></label>
                <input type="text" name="surname" value="<?php echo $login_session['surname']?>" id="surname" onkeyup="checkSurname()" size='16' required><span id="surnameerr"></span><br>

                <label for="phone"><b>Phone Number</b></label>
                <input type="text" name="phone" value="<?php echo $login_session['phone']?>" id="phone" onkeyup="checkPhone()" size='16' required><span id="phoneerr"></span><br>

                <label for="task"><b>Job Position</b></label>
                <h3></h3>
                <input type="text" name="task" value="<?php echo $login_session['task']?>"  size='16' required readonly>

                <label for="salary"><b>Salary</b></label>
                <input type="text" name="salary" value="<?php echo $login_session['salary']?> ALL"  size='16' required readonly>

                <label for="photo"><b>Photo</b></label><br>
                <input type="file" name="fileToUpload" id="fileToUpload">

                <button type="submit" name="submit" width='100px'>Save Changes</button>
            </div>

            <div class="container" style="background-color:#f1f1f1; width:100%">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                <span class="psw">Change <a href="changePassword.php">password?</a></span>
            </div>
        </form>
    </div>

    <div id="id02" class="modal">

        <form class="modal-content animate" method="post" action="makeTransaction.php" enctype="multipart/form-data">
            <div class="imgcontainer">
                <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
            </div>

            <div class="container" style='width:100%'>


                <label for="name"><b>STATUS:</b></label><br><br>
                <input type="radio" name="status" value="hyrje">HYRJE
                <input type="radio" name="status" value="hyrje">DALJE<br><br><br>


                <label for="surname"><b>AMOUNT</b></label>
                <input type="text" name="amount" id="amount" onkeyup="checkAmount()" required><span id='amounterr'></span><br>

                <label for="phone"><b>DESCRIPTION</b></label>
                <input type="text" name="desc" required>

                <button type="submit" name="submit">Create Transaction</button>
            </div>

            <div class="container" style="background-color:#f1f1f1; width:100%">
                <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
            </div>
        </form>
    </div>

    <div id="id03" class="modal">

        <form class="modal-content animate" method="post" action="" enctype="multipart/form-data">
            <div class="imgcontainer">
                <span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Modal">&times;</span>
            </div>

            <div class="container" style='width:100%'>

                <label for="name"><b>NAME:</b></label>
                <input type="text" name="prodname" required>

                <label for="surname"><b>PRICE:</b></label>
                <input type="text" name="prodprice" id="price" onkeyup="checkPrice()" required><span id='priceerr'></span><br>

                <label for="phone"><b>MEASUREMENT:</b></label><br><br>
                <input type="radio" name="measure" value="kg">kg
                <input type="radio" name="measure" value="L">L
                <input type="radio" name="measure" value="can/bottle">can/bottle
                <input type="radio" name="measure" value="piece">piece<br><br>

                <label for="phone"><b>THRESHOLD:</b></label>

                <input type="number" min="0" step="1" name="thrs" required>

                <button type="submit" name="addprod">Confirm</button>
            </div>

            <div class="container" style="background-color:#f1f1f1; width:100%">
                <button type="button" onclick="document.getElementById('id03').style.display='none'" class="cancelbtn">Cancel</button>
            </div>
        </form>
    </div>

    <div id="id04" class="modal">

        <form class="modal-content animate" method="post" action="">
            <div class="imgcontainer">
                <span onclick="document.getElementById('id04').style.display='none'" class="close" title="Close Modal">&times;</span>
            </div>

            <div class="container" style='width:100%'>

                <label for="name"><b>Who will you send the notification to?</b></label>
                <select name="receiver">
                    <?php
                    foreach($staff as $value){
                        echo "<option value='".$value['username']."'>".$value['username']."</option>";
                    }
                    ?>

                </select><br><br><br>

                <label for="surname"><b>Description</b></label>
                <textarea placeholder="Enter your message here ..." name='descr' ></textarea><br>

                <button type="submit" name="sendNotif">SEND</button>
            </div>

            <div class="container" style="background-color:#f1f1f1; width:100%">
                <button type="button" onclick="document.getElementById('id04').style.display='none'" class="cancelbtn">Cancel</button>
            </div>
        </form>
    </div>
    <div class="clear"></div>
    </div>
</div>
</div>

        <div class="container_12">
            <ul>
                <button onclick="showHint1()">Staff</button>
                <button onclick="showHint()">Products</button>
            </ul>
        </div>
    </header>



    <div class="content page1" style="display: none" id="acc">
        <div class="container_12">

            <div id="txtHint"><?php include "accountantstaff.php";?></div>

            <div class="clear"></div>
            <div class="grid_12">
                <div class="hor_separator"></div>
            </div>
            <div class="clear"></div>
        </div>

    </div>

    <div class="content page1" style="display: none" id="prod">
        <div class="container_12">

            <div id="txtHint"><?php include_once "accountantproduct.php";?></div>

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

</body>
</html>

<?php
$valid = new \core\user\validate();
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $phone = $_POST['phone'];
    $task = $_POST['task'];
    $salary = $_POST['salary'];
    $username = strtolower($name) . "." . strtolower($surname);
    $photo = basename($_FILES["fileToUpload"]["name"]);

    if ($valid->checkName($name) && $valid->checkSurname($surname) && $valid->checkPhone($phone)) {
        $person = new \core\people\people($name, $surname, $username, $phone, $task, $photo, $salary);

        $adm = new \core\people\crudAdmin();
        $result = $adm->updateStaff($login_session['id'], $person);

        if (basename($_FILES["fileToUpload"]["name"]) !== "") {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

            //echo unlink("uploads/$_POST[username].JPG");

            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $imgErr .= "File is not an image. ";
                $uploadOk = 0;
            }

// Check if file already exists
            if (file_exists($target_file)) {
                //echo unlink(($target_file));
                //echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
// Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                $imgErr .= "Sorry, your file is too large. ";
                $uploadOk = 0;
            }
// Allow certain file formats
            if ($imageFileType == "jpg" || $imageFileType == "JPG") {
                $uploadOk = 1;
            } else {
                $imgErr .= " Sorry, only JPG and JPEG files are allowed. ";
                $uploadOk = 0;
            }
// Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $imgErr .= "Sorry, your file was not uploaded. ";
// if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    //echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
                } else {
                    $imgErr .= "Sorry, there was an error uploading your file.";
                }
            }
        }

        echo "<script>alert('" . $photo . "')</script>";
        $result1 = $adm->setPhoto($login_session['id'], $photo);

        if ($result && $result1) header("Location: showUser.php");

        //echo $username;
    }
    else echo "<script>alert('You did not fill in the form according to the specific rules. Try again!')</script>";
}


if(isset($_POST['addprod'])){
    $name = $_POST['prodname'];
    $price = $_POST['prodprice'];
    $measure = $_POST['measure'];
    $threshold = $_POST['thrs'];

    $product = new \core\products\products($name, 0, $price, $measure, $threshold);
    $result = $accountant->addProduct($product);
    if($result) echo "<script>alert('Success inserting a product')</script>";
}


?>