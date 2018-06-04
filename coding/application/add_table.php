<?php
session_start();
require "crudTable.php";
require "validate.php";

$crd = new \core\table\crudTable();
$valid = new \core\user\validate();

if(isset($_SESSION['adminId'])){

if(isset($_POST['save'])){
    $num = $_POST['tableNum'];
    $pass = $_POST['password'];
    $chair = $_POST['chairs'];
    $cnt = 0;

    if(empty($num)){
        echo "<script>alert('Please fill the table number field.')</script>";
        $cnt++;
    }else if(!is_numeric($num)){
        echo "<script>alert('You entered an incorrect table number.')</script>";
        $cnt++;
    }else if($num<1){
        echo "<script>alert('You should enter a positive number for the table.')</script>";
        $cnt++;
    }

    if(empty($chair)){
        echo "<script>alert('Please enter a number in the number of chairs field.')</script>";
    }else if(!is_numeric($chair)){
        echo "<script>alert('You entered an incorrect number of chairs')</script>";
        $cnt++;
    }else if($chair<1){
        echo "<script>alert('You should enter a positive number of chairs.')</script>";
        $cnt++;
    }

    if(!$valid->checkDescription('$pass')){
        echo "<script>alert('The password you entered could not be accepted, try again.')</script>";
        $cnt++;
    }
    if($cnt==0) {
        $result = $crd->addTable($num, $pass, $chair);
        if($result){
            echo "<script>alert('Table $num entered succesfully')</script>";
        }else{
            echo "<script>alert('Sorry, that table already exists and could not be entered.')</script>";
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
<div>
<a href="admin.php">Back</a>
    <form method="post" id="form">
        <table align="center">
            <tr><td colspan="2"><h1>Adding a new table</h1></td></tr>
            <tr>
                <td>Table number</td>
                <td><input type="number" step="1" name="tableNum"></td>
            </tr>
            <tr>
                <td>Table password</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td>Number of chairs</td>
                <td><input type="number" step="1" name="chairs"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Save table" name="save"></td>
            </tr>
        </table>
    </form>
</div>
<?php }else{
    echo "<script>alert('You are not allowed to enter this page')</script>";
}?>
</body>
</html>
