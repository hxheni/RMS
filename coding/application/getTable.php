<?php
require_once 'session.php';
require_once 'crudWaiter.php';
require_once 'crudAdmin.php';

$adm = new \core\people\crudAdmin();
$waiter = new \core\people\crudWaiter();


//$type = mysqli_real_escape_string($con, $_GET['type']);
$result = $waiter->getTables();


?>


<!DOCTYPE html>
<html lang="en">
<head>
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

    <style>
        .container1 {
            position: relative;
            width: 100%;
            max-width: 400px;
        }

        .container1 img {
            width: 100%;
            height: auto;
        }

        .container1 .btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            background-color: lightsteelblue;
            color: white;
            font-size: 16px;
            padding: 12px 24px;
            border: none;
            cursor: pointer;
            border-radius: 20px;
            text-align: center;
        }

        .container1 .btn:hover {
            background-color: lightskyblue;
        }
    </style>

</head>

<body>
<div class="car_wrap">
    <h2>TABLES:</h2>
    <a href="#" class="prev"></a><a href="#" class="next"></a>
    <ul class="carousel1">
        <?php

        foreach ($result as $value){

            ?>
            <li>
                <div class="container1"><img src="<?php if($value['isAvailable'] == 'yes') echo "images/available.png"; else echo "images/busy.png"?>" alt="">
                    <div class="col1 upp"> <a href="#">Table <?php echo $value['tableNumber']?></a></div>
                    <span>Number of chairs: <?php echo $value['numChairs']?></span>
                    <?php if($value['isAvailable'] == 'yes') echo "<form action='setStatus.php' method='post'><input type='hidden' name='id' value='".$value['tableNumber']."'><input type='hidden' name='method' value='no'><button type='submit'>SET BUSY</button></form>"; else echo "<form action='setStatus.php' method='post'><input type='hidden' name='id' value='".$value['tableNumber']."'><input type='hidden' name='method' value='yes'><button type='submit'>SET AVAILABLE</button></form>"?>
                </div>
            </li>
        <?php } ?>
    </ul>
    <div id="process"></div>
</div>
</body>

