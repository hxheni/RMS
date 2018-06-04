<?php
session_start();
require "crudAdmin.php";

if(isset($_SESSION['adminId'])){
$name = $surname = $username = $phone = $salary = "";
$nameErr = $surnameErr = $usernameErr = $phoneErr = $salaryErr = "";

if (isset($_POST['submit'])){

    $cnt = 0;

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //checks if names contains only letters
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        $cnt++;
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z]*$/", $name)) {
            $cnt++;
            $nameErr = "Only letters allowed";
        }
    }
    //validation for the surname
    if (empty($_POST["surname"])) {
        $cnt++;
        $surnameErr = "Surname is required";
    } else {
        $surname = test_input($_POST["surname"]);
        if (!preg_match("/^[a-zA-Z]*$/", $name)) {
            $cnt++;
            $surnameErr = "Only letters allowed";
        }
    }

    //validation for the phone
    if (empty($_POST["phone"])) {
        $cnt++;
        $phoneErr = "Phone is required";
    } else {
        $phone = test_input($_POST["phone"]);
        // check if phone only contains numbers
        if (!preg_match("/[0-9]/", $phone)) {
            $cnt++;
            $phoneErr = "Only numbers allowed";
        }
    }

    //validation for the salary
    if (empty($_POST["salary"])) {
        $cnt++;
        $salaryErr = "Salary is required";
    } else {
        $salary = test_input($_POST["salary"]);
    // check if salary only contains numbers
        if (!preg_match("/[0-9]/", $salary)) {
            $cnt++;
            $salaryErr = "Only numbers allowed";
        }
    }

    if($cnt==0) {
        //$name = $_POST['name'];
        //$surname = $_POST['surname'];
        $username = strtolower($name) . "." .strtolower($surname);
        //$phone = $_POST['phone'];
        $photo = $_FILES['photo'];
        $category = $_POST['category'];
        //$salary = $_POST['salary'];

        if(isset($_FILES['photo']) && $_FILES['photo']['size'] > 0) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["photo"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["photo"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                //echo "The image has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }


            $photo = $target_file;
        }else {
            $photo = "";
        }
        $person = new core\people\people(ucfirst($name), ucfirst($surname), $username, $phone, $category, $photo, $salary);

        $crd = new \core\people\crudAdmin();
        $crd->addStaff($person);

        echo "<script>alert('New employee $name $surname added.')</script>";

    }

}
?>

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
<body style="background-color: lightgoldenrodyellow">

<button><a href="admin.php">Back</a></button>
<form action="#" method="post" id="form" enctype="multipart/form-data">
    <table align="center">
        <tr>
            <td colspan="2">
                <h1>Add worker</h1>
            </td>
        </tr>
        <tr>
            <td>
                <label>Name</label>
            </td>
            <td>
                <input type="text" name="name">
            </td>
            <td><?php echo $nameErr; ?></td>
        </tr>
        <tr>
            <td>
                <label>Surname</label>
            </td>
            <td>
                <input type="text" name="surname">
            </td>
            <td>
                <?php echo $surnameErr; ?>
            </td>
        </tr>
        <tr>
            <td>
                <label>
                    Phone number
                </label>
            </td>
            <td>
                <input type="text" name="phone">
            </td>
            <td><?php echo $phoneErr; ?></td>
        </tr>

        <tr>
            <td>
                <label>Add picture</label>
            </td>
            <td>
                <input type="file" name="photo">
            </td>
        </tr>
        <tr>
            <td>
                <label>
                    Category
                </label>
            </td>
            <td>
                <select name="category" style="width: 100%; font-size: 17px">
                    <option>Admin</option>
                    <option>Chef</option>
                    <option>Accountant</option>
                    <option>Chef</option>
                    <option>Other</option>
                </select>
            </td>

        </tr>
        <tr>
            <td>
                <label>Salary</label>
            </td>
            <td>
                <input type="text" name="salary">
            </td>
            <td>
                <?php echo $salaryErr; ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button style="position: center" type="submit" name="submit">Submit</button>
            </td>
        </tr>
    </table>
</form>

<?php
}else{
    echo "<script>alert('You are not allowed to enter this page')</script>";
}
?>
</body>
</html>
