<?php

require_once 'session.php';
require_once 'crudAccountant.php';
require_once 'crudAdmin.php';
require_once 'validate.php';
if($login_session['task'] != 'accountant') header("Location:index.php");
$acc = new \core\people\crudAccountant();
$result = $acc->checkNotification($login_session['id']);




?>

<head>

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
                    <li><a href="#">My Profile</a>
                        <ul>
                            <li><a href="#" onclick="document.getElementById('id01').style.display='block'">Edit Profile</a></li>
                            <li><a href="logout.php">Log Out</a></li>
                        </ul></li>
                </ul>
            </nav>
            <div class="clear"></div>
            <div id="id01" class="modal">

                <form class="modal-content animate" method="post" enctype="multipart/form-data">
                    <div class="imgcontainer">
                        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                    </div>

                    <div class="container">
                        <div><img src="uploads/<?php echo $login_session['photo']?>" width="100px" height="100px"></div>

                        <label for="name"><b>First Name</b></label>
                        <input type="text" name="name" value="<?php echo $login_session['name']?>" id="name" onkeyup="checkName()" required><span id="nameerr"></span><br>

                        <label for="surname"><b>Last Name</b></label>
                        <input type="text" name="surname" value="<?php echo $login_session['surname']?>" id="surname" onkeyup="checkSurname()" required><span id="surnameerr"></span><br>

                        <label for="phone"><b>Phone Number</b></label>
                        <input type="text" name="phone" value="<?php echo $login_session['phone']?>" id="phone" onkeyup="checkPhone()" required><span id="phoneerr"></span><br>

                        <label for="task"><b>Job Position</b></label>
                        <h3></h3>
                        <input type="text" name="task" value="<?php echo $login_session['task']?>" required readonly>

                        <label for="salary"><b>Salary</b></label>
                        <input type="text" name="salary" value="<?php echo $login_session['salary']?> ALL" required readonly>

                        <label for="photo"><b>Photo</b></label><br>
                        <input type="file" name="fileToUpload" id="fileToUpload">

                        <button type="submit" name="submit">Save Changes</button>
                    </div>

                    <div class="container" style="background-color:#f1f1f1">
                        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                        <span class="psw">Change <a href="changePassword.php">password?</a></span>
                    </div>
                </form>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
    </header>

    <div class="content page1">
        <div class="container_12">

    <div>
        <?php
        if(count($result) == 0) echo "<br><br><a>There are no notifications at the moment.</a>";
        else {
            echo "<br><br><table id='notif' style=\"margin-left: 8%;\" class=\"w3-table-all\"><form action='checkRead.php' method='post'>";
            echo "<tr style='background-color: lightgoldenrodyellow'><td>Sender</td><td>Message</td><td>Read</td>";
            foreach ($result as $value) {
                $result1 = $acc->retrieveMember($value['senderId']);
                if ($value['status'] == "0") echo "<tr style='background-color: aquamarine'><td>" . $result1[0]['name'] . " " . $result1[0]['surname'] . " (" . $result1[0]['task'] . ")</td><td>" . $value['text'] . "</td><td><input type='hidden' name='id' value='" . $value['id'] . "'><input type='submit' value='Check'></td>";
                else echo "<tr><td>" . $result1[0]['name'] . " " . $result1[0]['surname'] . " (" . $result1[0]['task'] . ")</td><td>" . $value['text'] . "</td><td>✓</td>";

                echo "</tr>";
            }

            echo "</table>";
        }
        ?>
    </div>
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

<?php
$valid=new \core\user\validate();
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $phone = $_POST['phone'];
    $task = $_POST['task'];
    $salary = $_POST['salary'];
    $username = $name . "." . $surname;
    $photo = basename($_FILES["fileToUpload"]["name"]);
    if ($valid->checkName($name) && $valid->checkSurname($surname) && $valid->checkPhone($phone)) {
        $person = new \core\people\people($name, $surname, $username, $phone, $task, $photo, $salary);

        $adm = new \core\people\crudAdmin();
        $result = $adm->updatePerson($login_session['id'], $person);

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


        //echo $username;
    }
    else echo "<script>alert('You did not fill in the form according to the specific rules. Try again!')</script>";

}?>