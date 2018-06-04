<?php
require_once 'sessionTable.php';
require_once 'crudAdmin.php';
require "crudChef.php";

$adm = new \core\people\crudAdmin();
$chef = new \core\people\crudChef();


//$type = mysqli_real_escape_string($con, $_GET['type']);
if($_GET['type'] == 'all') $result = $adm->getDishes();
else $result=$adm->getDishesType($_GET['type']);

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
            top: 70%;
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
    <h2>Menu</h2>
    <a href="#" class="prev"></a><a href="#" class="next"></a>
    <ul class="carousel1">
        <?php
        $i=0;
        foreach ($result as $value){
        //here we get the id of the dish and then get the products that this dish have
            //this function gets the ids of all products that are in a dish and their amounts in a dish
            $res = $chef->viewProducts($value['id']);

            $cnt = 0;
            foreach ($res as $val){
                //each $val is record in the table d_pr

                //$qnt is the quantity of the product in the database
                $qnt = $adm->checkProductQuantity($val['productId']);

                //this loop checks if the quantity of the products in the database is smaller than the quantity of it in the dish
                if($qnt<$val['quantity']){
                    $cnt++;
                }

            }
            if($cnt==0){

            ?>
            <li>
                <div class="container1" style="padding: 10px"><img src='uploads/<?php echo $value['photo'];?>' alt="" ><button id="<?php echo $i?>" class="btn" onclick="showHint2('<?php echo $value['id']?>', '<?php echo $i?>')">ADD</button><?php echo $i++?>
                    <div class="col1 upp"> <a href="#"><?php echo $value['name']?></a></div>
                    <span><?php echo $value['description']?></span>
                    <div class="price"><?php echo $value['price']?> $</div>
                </div>
            </li>
        <?php }} ?>
    </ul>
</div>
</body>