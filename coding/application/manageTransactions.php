<?php
require_once 'session.php';
require_once 'crudAccountant.php';
require_once 'crudAdmin.php';

if($login_session['task'] != 'accountant') header("Location:index.php");

$accountant = new \core\people\crudAccountant();

$result = $accountant->getTransactions();


?>
<html>
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
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   
	
    <script>

        function checkAmount() {
            var cnt = document.getElementById("amount").value;
            if(isNaN(cnt) || cnt < 1 || cnt > 10000){
                document.getElementById("amounterr").innerHTML = "Be careful! You need to enter a numerical value!";
                document.getElementById("amount").setAttribute('style', 'background-color: red').innerHTML;

            } else {
                document.getElementById("amounterr").innerHTML = "";
                document.getElementById("amount").setAttribute('style', 'background-color: green').innerHTML;

            }
        }

        function myFunction() {
            var input, filter, table, tr, td, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
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
                            <li class="with_ul"><a href="showUser.php">Go Back</a></li>
                            <li class="with_ul"><a href="#" onclick="document.getElementById('id02').style.display='block'">Create Transaction</a></li>
                            <li class="with_ul"><a href="#">Generate</a>
                            <ul>
                                <li><a href="examples/simple.php?id=all" target="_blank">All Transactions</a></li>
                                <li><a href="examples/simple.php?id=staff" target="_blank">Salaries</a></li>
                            </ul>
                            </li>
                        </ul>
                    </nav>
                    <div class="clear"></div>
                    <div id="id02" class="modal">

                        <form class="modal-content animate" method="post" action="makeTransaction.php" enctype="multipart/form-data">
                            <div class="imgcontainer">
                                <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
                            </div>

                            <div class="container" style='width:100%'>


                                <label for="name"><b>STATUS:</b></label><br><br>
                                <input type="radio" name="status" value="hyrje">HYRJE
                                <input type="radio" name="status" value="hyrje">DALJE<br><br><br>


                                <label for="surname"><b>AMOUNT</b></label>
                                <input type="text" name="amount" id="amount" onkeyup="checkAmount()" required><span id='amounterr'></span><br>

                                <label for="phone"><b>DESCRIPTION</b></label>
                                <input type="text" name="desc" required>

                                <button type="submit" name="submit">Create Transaction</button>
                            </div>

                            <div class="container" style="background-color:#f1f1f1; width:100%;">
                                <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="content page1">
        <div class="container_12">

            <div>
<?php
echo "<br><br><div class='table-responsive'><input type=\"text\" id=\"myInput\" onkeyup=\"myFunction()\" placeholder=\"Search for names..\" title=\"Type in a name\" >";
echo "<table class='table'><form action='examples/simple.php' method='post' target='_blank'>";
echo "<tr style='background-color: lightgoldenrodyellow' class='header'><th>Transaction Maker</th><th>Status</th><th>Amount</th><th>Description</th><th>Report</th>";
foreach ($result as $value){
    $result1=$accountant->retrieveMember($value['transmakerId']);
    echo "<tr><td>".$result1[0]['name']." ".$result1[0]['surname']." (".$result1[0]['task'].")</td><td>".$value['status']."</td><td>".$value['amount']."</td><td>".$value['description']."</td><td><input type='hidden' name='id' value='".$value['id']."'><a href='examples/simple.php?id=".$value['id']."'>Generate Report</a></td>";

    echo "</tr>";
}

echo "</table>";
?>
            </div>

            <div class="clear"></div>
            <div class="grid_12">
                <div class="hor_separator"></div>
            </div>
            <div class="clear"></div>
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
</html>