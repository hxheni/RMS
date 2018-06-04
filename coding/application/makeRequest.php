<?php
require_once 'session.php';
require_once 'crudAccountant.php';
require_once 'crudProduct.php';
require_once 'phpmailer/PHPMailerAutoload.php';
require_once 'notification.php';

if($login_session['task'] != 'accountant') header("Location:index.php");

$acc = new \core\people\crudAccountant();

if(isset($_POST['subReq'])) {

    $prod = new \core\products\CRUD();

    $result = $prod->getProducts();
    $str = "Here are the requests for this month: ";
    $tot = 0;

    foreach ($result as $value) {
        if ($_POST['quantity' . $value['id']] != "") {
            $tot += $value['price'] * $_POST['quantity' . $value['id']];
            $str .= $value['name'] . " - " . $_POST['quantity' . $value['id']] . " " . $value['measurement'] . ". ";
        }
    }

    if ($_POST['description'] != "") $str .= $_POST['description'];
    $str .= " With a total cost of $ " . $tot . " plus extra charges for any item, which is not a food product.";
}

if(isset($_POST['send'])){
    $fields=array(
        'name'=>$_POST['name'],
        'email'=>$_POST['email'],
        'message'=>$_POST['message']);

    $tot = $_POST['tot'];
    if($tot != 0){
        $t = new \core\transaction\transaction($tot, $login_session['id'], "dalje", "porosi ushqime");
        $result = $acc->addTransaction($t);
        $notif = new \core\notification\notification($login_session['id'],$login_session['id'], "Porosi nga ".$fields['email'].". Check as read after products are received.");
        $result1 = $acc->sendNotif($notif);
    }
$m=new PHPMailer;
$m->isSMTP();
$m->SMTPAuth=true;
$m->Host='smtp.gmail.com';
$m->Username='medicalcentertest18@gmail.com';
$m->Password='Test12345';
$m->SMTPSecure='ssl';
$m->Port=465;
$m->isHTML();
$m->Subject='Porosi';
$m->Body='From:RMS (rms@gmail.com)<p>'.$fields['message'].'</p>';
$m->FromName='Contact';
$m->AddAddress('agugu15@epoka.edu.al','Andel Gugu');
if($m->send()){
    $_SESSION['email'] = 1; header("Location:suppliers.php");
}else {
    echo "<script>alert('Couldn't send email!')</script>";
}

}
?>
<html>
<head>
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>


        button{
            background: #ce636b;
            color:#fff;
            border:none;
            position:relative;
            height:50px;
            width: 180px;
            font-size:1.4em;
            padding:0 2em;
            cursor:pointer;
            transition:800ms ease all;
            outline:none;
        }
        button:hover{
            background:#fff;
            color:#ce636b;
        }
        button:before,button:after{
            content:'';
            position:absolute;
            top:0;
            right:0;
            height:2px;
            width:0;
            background: #ce636b;
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
</head>
<body style="background-color: lightgoldenrodyellow">

<div class="container_12">
    <div class="grid_12">
        <div class="menu_block"style=" width: 100%;">
            <h1 >Welcome <?php echo $login_session['name']." ". $login_session['surname']. "."?></h1>
            <nav>
                <ul class="sf-menu">
                    <li class="with_ul"><a href="suppliers.php">GO BACK</a></li>
                    <li><a href="#">My Profile</a>
                        <ul>
                            <li><a href="logout.php">Log Out</a></li>
                        </ul></li>
                </ul>
            </nav>
            <div class="clear"></div>
            <div class="clear"></div>
        </div>
    </div>
<h1 style="text-align:center; font-family:'Verdana', Geneva, sans-serif; font-size:30px;">SEND REQUEST</h1>
<form action="" method="post">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?php echo $login_session['name']." ".$login_session['surname'] ?>" readonly><br><br>
    <label>Email:</label><br>
    <input type="text" name="email" value="<?php echo $_POST['email'] ?>" readonly><br><br>
    <label>Message:</label><br>
    <textarea name="message" rows="10" cols="20"><?php echo $str;?></textarea><br><br>
    <input type="hidden" name="tot" value="<?php echo $tot?>">
    <button type="submit" onclick="return confirm('Are you sure you want to send this email?')" value="Send" name="send">Submit</button>

</form>
</body>
</html>