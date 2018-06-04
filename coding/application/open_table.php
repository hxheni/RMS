<?php
session_start();
require "crudTable.php";
require "crudAdmin.php";
if(isset($_SESSION['adminId'])){

$crd = new \core\table\crudTable();
$crd1 = new \core\people\crudAdmin();

$tableNum = $password = $chairs = $orders = $ava = $img = "";

if(isset($_GET['tid'])){
    $res = $crd->getTable($_GET['tid']);
    if($res!="" || $res!=null) {
        foreach ($res as $value) {
            $tableNum = $value['tableNumber'];
            $password = $value['password'];
            $chairs = $value['numChairs'];
            $ava  = $value['isAvailable'];
        }

        if($ava == 'yes'){
            $img = "images/available.png";
        }else{
            $img = "images/busy.png";
        }

        $res2 = $crd->getOrders($_GET['tid']);
        $orders .= "<table><tr><td style='padding: 10px'>Chef</td><td style='padding: 10px'>Amount</td><td style='padding: 10px'>Description</td></tr>";
        foreach ($res2 as $value) {
            $res3 = $crd1->retrieveMember($value['chefId']);
            $name = "";
            foreach ($res3 as $val){
                $name = $val['username'];
            }
            $orders .= "<tr><td style='padding: 10px'>" . $name . "</td><td style='padding: 10px'>\$" . $value['amount'] . "</td><td style='padding: 10px'>" . $value['description'] . "</td></tr>";
        }
        $orders .= "</table>";
    }else{
        $orders = "There are no orders for this table!";
    }
}

if(isset($_POST['delete'])){
    $crd1->deleteTable($_GET['tid']);
    header('Location: admin.php');
}


?>
<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="css/login.css">


</head>
<body>
<div class="container">
<a href="admin.php">Back</a>
<table align="center">
    <tr><td colspan="2"><h1>Table <?php echo $tableNum; ?></h1></td></tr>
    <tr><td colspan="2" align="center"><img src="<?php echo $img; ?>" width="100px" height="100px"></td></tr>
    <tr>
        <td>
            Table password
        </td>
        <td>
            <?php echo $password; ?>
        </td>
    </tr>
    <tr>
        <td>
            Number of chairs
        </td>
        <td>
            <?php echo $chairs;?>
        </td>
    </tr>
    <tr><td colspan="2"><button onclick="document.getElementById('id01').style.display = 'block'">Delete</button></td></tr>
    <tr><td colspan="2"><button onclick="document.getElementById('id02').style.display = 'block'">Display Orders</button></td></tr>
</table>



<div id="id01" class="modal">

    <form class="modal-content animate" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div>

        <div class="container">

            <label for="psw"><b>Are you sure you want to delete this table?</b></label>
            <button type="submit" name="delete">Delete</button>
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


            <div id="or">
                <br>
                <?php echo $orders; ?>
            </div>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
        </div>
    </form>
</div>
</div>
<?php } else{
    echo "<script>alert('You are not allowed to enter this page.')</script>";
    echo "<a href='index.php'>Back</a>";
}?>
</body>
</html>
