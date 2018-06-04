<?php

require 'session.php';
require 'crudChef.php';

$id = $_GET['id'];

$chef = new \core\people\crudChef();

$result = $chef->getDish($id);
?>

<input type="text" name="name<?php echo $id?>" value="<?php echo $result[0]['name']?>" readonly>
<input type="number" value="1" step="1" name="quantity<?php echo $id?>" min="0" style="float: right"><br><br><br>
