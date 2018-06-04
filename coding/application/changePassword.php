<?php
require_once 'session.php';
require_once 'crudAdmin.php';

$admin = new \core\people\crudAdmin();

if(isset($_POST['submit'])) {
    if (isset($_POST['old']) && isset($_POST['new1']) && isset($_POST['new2'])) {
        $old = $_POST['old'];
        $new1 = substr(md5($_POST['new1']),0,30);
        $new2 = substr(md5($_POST['new2']), 0, 30);
        if (substr(md5($old),0,30) == $login_session['password']) {
            if ($new1 == $new2){
                $result = $admin->updatePeoplePass($login_session['id'],$new1);
                if($result) {
                    echo "<script>alert('Your password has changed.')</script>";
                    header('Location: logout.php');
                }
                else echo "<script>alert('An error occurred. Try again later!')</script>";
            }
            else echo "<script>alert('New passwords mismatch!')</script>";

        }
        else echo "<script>alert('Wrong old password')</script>";
    }
    else echo "<script>alert('You have not filled the form completely')</script>";
}

?>

<head>
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

    <script type="text/javascript" src="js/jquery.js"></script>
    <script>

        $(window).load(function () {
            $('.slider')._TMS({
                show: 0,
                pauseOnHover: false,
                prevBu: '.prev',
                nextBu: '.next',
                playBu: false,
                duration: 800,
                preset: 'fade',
                pagination: true, //'.pagination',true,'<ul></ul>'
                pagNums: false,
                slideshow: 8000,
                numStatus: false,
                banners: false,
                waitBannerAnimation: false,
                progressBar: false
            })
        });
        $(window).load(function () {
            $('.carousel1').carouFredSel({
                auto: false,
                prev: '.prev',
                next: '.next',
                width: 960,
                items: {
                    visible: {
                        min: 1,
                        max: 4
                    },
                    height: 'auto',
                    width: 240,
                },
                responsive: false,
                scroll: 1,
                mousewheel: false,
                swipe: {
                    onMouse: false,
                    onTouch: false
                }
            });
        });
    </script>
</head>

<body style='background-color:lightblue'>
<div class="main">
    <header>
        <div class="container_12">
            <div class="grid_12">
                <h1><a href="#"><img src="images/logo.png" alt=""></a></h1>
                <div class="menu_block">
                    <nav>
                        <ul class="sf-menu">
                            <li class="with_ul"><a href='<?php echo $_SERVER['HTTP_REFERER']?>'>GO BACK</a></li>
                            <li class="with_ul"><a href="logout.php">LOG OUT</a></li>
                        </ul>
                    </nav>
                    <div class="clear"></div>
    </header>
    <div class="content page1">
        <div class="container_12">
            <form action="" method="post">
            <h2>Enter your current password</h2>
            <input type="text" name="old">
            <h2>Enter your new password in both fields.</h2>
            <input type="text" name="new1">
            <input type="text" name="new2">
            <input type="submit" name="submit" value="Confirm"></form>
        </div>

            <div class="clear"></div>
            <div class="grid_12">
                <div class="hor_separator"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="container_12">

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
