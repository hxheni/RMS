<?php
require_once 'session.php';
require_once 'crudAccountant.php';

$accountant = new \core\people\crudAccountant();
$result = $accountant->getStaff();
$str="";
$str1="";
$i=0;

echo "<table id='customers' style=\"margin-left: 8%;\">";
echo "<tr style='background-color: lightgoldenrodyellow'><td>ID</td><td>Name</td><td>Surname</td><td>Task</td><td>Salary</td>";
echo "<form method='post' action='submitSalary.php'>";
foreach ($result as $value){
    echo "<tr><td>".$value['id']."</td><td>".$value['name']."</td><td>".$value['surname']."</td><td>".$value['task']."</td><td><input type='text' name='salary".$i."' value='".$value['salary']."'></td>";
    echo "</tr>";
    $i++;
}
echo "<tr><td colspan='5' align='right'><input type='submit' name='subSal' value='Submit Salaries'></td></tr></form>";
echo "</table>";
?>