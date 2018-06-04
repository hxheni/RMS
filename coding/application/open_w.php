<?php
session_start();
require "crudAdmin.php";
require "validate.php";

$crd = new \core\people\crudAdmin();
$valid = new \core\user\validate();
if(isset($_SESSION['adminId'])){
$name = $surname= $username = $password = $phone = $task = $photo = $salary = "";
if(isset($_GET['wid'])){
    $employee = $crd->retrieveMember($_GET['wid']);
    foreach ($employee as $value){
        $name = $value['name'];
        $surname = $value['surname'];
        $username = $value['username'];
        $password = $value['password'];
        $phone = $value['phone'];
        $task = $value['task'];
        $photo = "uploads/".$value['photo'];
        $salary = $value['salary'];
    }
}

if(isset($_POST['PassEdit'])){
    $p = $_POST['password1'];
    if($valid->checkPass($p)) {
        $crd->updatePeoplePass($_GET['wid'], substr(md5($p),0,30));
        $password = $p;
    }else{
        echo "<script>alert('The password was not accepted, please try again!')</script>";
    }
}

if(isset($_POST['PhoneEdit'])){
    if($valid->checkPhone($_POST['phoneNumber'])) {
        $crd->updatePeoplePhone($_GET['wid'], $_POST['phoneNumber']);
        $phone = $_POST['phoneNumber'];
    }else{
        echo "<script>alert('The phone number you entered was invalid!')</script>";
    }
}

if(isset($_POST['EditCategory'])){
    $crd->updatePeopleCategory($_GET['wid'], $_POST['category1']);
    $task = $_POST['category1'];
}

if(isset($_POST['SalaryEdit'])){
    if($valid->checkAmount($_POST['salary1'])) {
        $crd->updatePeopleSalary($_GET['wid'], $_POST['salary1']);
        $salary = $_POST['salary1'];
    }else{
        echo "<script>alert('You entered wrong credentials, try again!')</script>";
    }
}

if(isset($_POST['delete'])){
    $crd->deleteMember($_GET['wid']);
    header('Location:admin.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="images/favicon.ico">
    <link rel="shortcut icon" href="images/favicon.ico">
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
            background: #8dc880;
            color:#fff;
            border:none;
            position:relative;
            height:30px;
            width:200px;
            font-size:1.2em;
            padding:0 2em;
            cursor:pointer;
            transition:800ms ease all;
            outline:none;
        }
        button:hover{
            background:#fff;
            color: #8dc880;
        }
        button:before,button:after{
            content:'';
            position:absolute;
            top:0;
            right:0;
            height:2px;
            width:0;
            background: #8dc880;
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

        td{
            vert-align: bottom;
        }
    </style>

</head>
<body>
<div id="whole">
    <button><a href="admin.php">Back</a></button>

    <table align="center">
        <tr><td colspan="3"><h1>Worker Page</h1></td></tr>
        <tr>
            <td>Name</td>
            <td><?php echo $name; ?></td>
            <td rowspan="3"><img src="<?php echo $photo; ?>" width="150px" height="150px"> </td>
        </tr>
        <tr>
            <td>Surname</td>
            <td><?php echo $surname; ?></td>
        </tr>
        <tr>
            <td>Username</td>
            <td><?php echo $username; ?></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><?php echo $password;?></td>
            <td><button onclick="document.getElementById('id01').style.display='block'">Edit</button></td>
        </tr>
        <tr>
            <td>Phone number</td>
            <td><?php echo $phone; ?></td>
            <td><button onclick="document.getElementById('id02').style.display='block'">Edit</button></td>
        </tr>
        <tr>
            <td>Category</td>
            <td><?php echo $task; ?></td>
            <td><button onclick="document.getElementById('id03').style.display='block'">Edit</button></td>
        </tr>
        <tr>
            <td>Salary</td>
            <td><?php echo $salary; ?></td>
            <td><button onclick="document.getElementById('id04').style.display='block'">Edit</button></td>
        </tr>
        <tr>
            <td colspan="2"><button onclick="document.getElementById('id05').style.display='block'">Delete worker</button></td>
        </tr>
    </table>
</div>
<div id="id01" class="modal">

    <form class="modal-content animate" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div>

        <div class="container">

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter New Password" name="password1" required>

            <button type="submit" name="PassEdit">Confirm Edit</button>
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

            <label for="psw"><b>Phone number</b></label>
            <input type="text" placeholder="Enter New Phone Number" name="phoneNumber" required>

            <button type="submit" name="PhoneEdit">Confirm Edit</button>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
        </div>
    </form>
</div>


<div id="id03" class="modal">

    <form class="modal-content animate" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div>

        <div class="container">

            <label for="psw" style="font-size: 20px"><b>Category</b></label>
            <br>
            <select style="width: 100%; font-size: 25px;" name="category1">
                <option value="admin">Admin</option>
                <option value="accountant">Accountant</option>
                <option value="chef">Chef</option>
                <option value="waiter">Waiter</option>
                <option value="other">Other</option>
            </select>
            <button type="submit" name="EditCategory">Confirm Selected Category</button>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id03').style.display='none'" class="cancelbtn">Cancel</button>
        </div>
    </form>
</div>

<div id="id04" class="modal">

    <form class="modal-content animate" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('id04').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div>

        <div class="container">

            <label for="psw"><b>Salary</b></label>
            <input type="text" placeholder="Enter New Salary" name="salary1" required>

            <button type="submit" name="SalaryEdit">Confirm Edit</button>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id04').style.display='none'" class="cancelbtn">Cancel</button>
        </div>
    </form>
</div>


<div id="id05" class="modal">

    <form class="modal-content animate" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('id05').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div>

        <div class="container">

            <label for="psw"><b>Are you sure you want to delete this worker?</b></label>
            <button type="submit" name="delete">Delete</button>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id05').style.display='none'" class="cancelbtn">Cancel</button>
        </div>
    </form>
</div>
<?php }else{
    echo "<script>alert('You are not allowed to enter this page.')</script>";
}?>
</body>
</html>
