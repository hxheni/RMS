<?php
session_start();

require "crudAdmin.php";

$crd = new \core\people\crudAdmin();

$result = $crd->getEmployees();
$display = "<div class='table-responsive'>";
$display = "<table class='table' width='90%' style='font-size: 20px;'>";
$display.="<tr><td>Name</td><td>Surname</td><td>Username</td><td>Photo</td><td><a href=\"add_worker.php\" class='ghost'>Add worker</a></td></tr>";
foreach($result as $row){
    $display.="<tr id='tr_w' valign='middle'>";
    $display.="<td valign='middle'>".$row['name']."</td>";
    $display.="<td valign='middle'>".$row['surname']."</td>";
    $display.="<td valign='middle'>".$row['username']."</td>";
    $photo = "uploads/".$row['photo'];
    $display.="<td valign='middle' style='padding: 10px'><img src='$photo' width='100px' height='100px'></td>";
    //check again this part, the id should not be visible
    $display.="<td valign='middle'>"."<a href='open_w.php?wid=".$row['id']."' class='ghost'>Open Profile</a>"."</td>";
    $display.="</tr>";
}
$display.="</table></div>";
?>
<html>
<head>
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
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        td{
            padding: 10px;
            text-align: center;
        }

        #tr_w:hover {
            text-decoration: none;
            padding: 10px;
            background: lightgray;
            color: white;
            text-align: center;
            margin: 0 0 20px 0;

            -webkit-transition: all 0.2s ease;
            -moz-transition: all 0.2s ease;
            -o-transition: all 0.2s ease;
        }
    </style>
    <script>
        function loadWorker(id) {
            var link = "open_w?wid="+id
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("main").innerHTML =
                        this.responseText;
                }
            };
            xhttp.open("GET", link, true);
            xhttp.send();
        }
    </script>
</head>
<body>
<div style="margin: 20px">
<?php
    echo $display;
?>
</div>

</body>
</html>

