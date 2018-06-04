<?php
session_start();
require 'crudChef.php';
if(isset($_SESSION['orderId'])){
    $crd = new \core\people\crudChef();
    $id = $_SESSION['orderId'];

    $add = "<form method='post' id='form'>";
    $add.="<table align='center'><tr><td><h1>Adding a new item in the menu</h1></td></tr>";
    $add.="<tr><td><label>Enter new product in the order</label></td>";
    $add.="<td><select name='products' style='width: 100%'>";
    $res = $crd->getProducts();
    foreach ($res as $row){
        $add.="<option value='".$row['id']."'>".$row['name']."/".$row['measurement']."</option>";
    }
    $add.="</select></td>";
    $add.="<tr><td><label>Quantity</label></td>";
    $add.="<td><input type='number' name='quantity' step=0.01 min='0'></td>";
    $res1 = $crd->getOrderById($_SESSION['orderId']);
    $amount = "";
    foreach ($res1 as $val){
        $amount = $val['amount'];
    }
    $add.="<tr><td>Update order cost</td><td><input type='text' name='update' placeholder='$amount'></td></tr>";
    $add.="<tr><td colspan='2'><input type='submit' value='Add this product' name='add_this_product'></td></tr>";
    $add.="</table>";

    if(isset($_POST['add_this_product'])){
        $crd->removeProduct($_POST['products'], $_POST['quantity']);
        $crd->updatePrice($_SESSION['orderId'], $_POST['update']);
        echo "<script>alert('Product added in the menu')</script>";
    }

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Order</title>
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
<?php
echo "<a href='open_order.php?id=$id'>Back</a>";
?>
<?php echo $add?>


<?php } else{
    echo "You cannot enter this page!";
}
?>
</body>
</html>
