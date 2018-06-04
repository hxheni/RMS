<?php
//require_once 'sessionTable.php';
//require_once 'crudChef.php';

$chef = new \core\people\crudChef();

if(isset($_POST['change'])){
    $counter = $_POST['cnt'];
    $total=0;
    for($i=0;$i<$counter;$i++){
        $dishId = $_POST['dish'.$i];
        $am = $_POST['amount'.$i];
        $price = $_POST['price'.$i];
        $result = $chef->updateOrder($_SESSION['orderId'], $dishId, $am);
        $total += $price*$am;
    }

    $update = $chef->updatePrice($_SESSION['orderId'], $total);
    if($update) echo "<script>alert('Success, your new order is $total ALL')</script>";

}


$result=$chef->viewOrder($_SESSION['orderId']);
echo "";

echo "<form class=\"modal-content animate\" method='post'><div class=\"imgcontainer\"><h2>Your order:</h2>
                                <span onclick=\"document.getElementById('id01').style.display='none'\" class=\"close\" title=\"Close Modal\">&times;</span>
                            </div><div class=\"container\"><table><thead><td>Dish Name</td><td>Amount</td></thead>";
$cnt=0;
foreach ($result as $value){
    $dish = $chef->getDish($value['dishId']);
    echo "<tr><td><input type='hidden' name='price".$cnt."' value='".$dish[0]['price']."'><input type='hidden' name='dish".$cnt."' value='".$value['dishId']."'>".$dish[0]['name']."</td><td><input type='number' name='amount".$cnt."' min='0' value='".$value['amount']."'></td></tr>";
    $cnt++;
}

echo "</table><input type='hidden' name='cnt' value='".$cnt."'><input type='submit' name='change' value='Save Changes'></div><div class=\"container\" style=\"background-color:#f1f1f1\">
                                <button type=\"button\" onclick=\"document.getElementById('id01').style.display='none'\" class=\"cancelbtn\">Cancel</button>
              
                            </div></form>";

?>