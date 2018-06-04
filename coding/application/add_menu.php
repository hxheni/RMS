<?php
session_start();
require "crudAdmin.php";
require "crudChef.php";
require "validate.php";
if(isset($_SESSION['adminId'])||isset($_SESSION['chefId'])){
//list of input variables
$input1DishName = "";
$input2Price = "";

$crd = new \core\people\crudAdmin();

//kjo eshte per listen e produkteve
$products_list = "";
$res = $crd->getProducts();
foreach ($res as $row){

    $products_list.="<option value='".$row['id']."'>".$row['name']."/".$row['measurement']."</option>";
}

//ketu ka nje problem me produktet qe kane dy emra si psh 'olive oil'
$selected_list="";
if(isset($_POST['addedProducts'])){
    $selected_list= $_POST['addedProducts'];
}
if(isset($_POST['addingButton'])){
    $productName = $crd->getProductName($_POST['products']);
    $productMeasurement = $crd->getMeasurement($_POST['products']);
    $quantity = $_POST['quantity'];
    if($quantity<=0){
        echo "<script>alert('The quantity should be bigger than 0')</script>";
    }else {
        $selected_list .= "\n" . $productName . " " . $quantity . " " . $productMeasurement;
        $input1DishName = $_POST['dish_name'];
        $input2Price = $_POST['price'];
    }

}

if(isset($_POST['submit'])){
    $val = new \core\user\validate();
    $cnt = 0;
    if(empty($_POST['dish_name'])){
        echo "<script>alert('Please enter a name for the dish')</script>";
        $cnt++;
    }

    if(empty($_POST['price'])){
        echo "<script>alert('Enter a value for the price')</script>";
        $cnt++;
    }

    if(!is_numeric($_POST['price'])){
        echo "<script>alert('The price you entered was not suitable!')</script>";
        $cnt++;
    }

    if($cnt==0){

        $dish = new \core\dish\dish($val->checkDescription($_POST['dish_name']), "new", $val->checkDescription($_POST['description']),
            $_POST['price'], $_POST['category']);
        $crd->addDish($dish);
        //this is the list of products that are in the dish
        $dish_list = $_POST['addedProducts'];

        $dish_list = preg_replace('/\s\s+/', ' ', $dish_list);
        $pieces = explode(" ", $dish_list);
        $int = count($pieces);
        for ($i = 1; $i < $int; $i += 3) {
            if ($int - $i >= 3) {
                $name = $pieces[$i];
                $j = $i + 1;
                if (!is_numeric($pieces[$j])) {
                    $name .= " " . $pieces[$j];
                    $i = $i + 1;
                }
                if ($j == $i)
                    $j = $j + 1;
                $productId = $crd->getProductId($name);
                $dishId = $crd->getDishId($_POST['dish_name']);
                $quantity = $pieces[$j];
                //look if the next number contains more than one name
                //echo $dishId . " " . $productId . " " . $quantity . "\n";
                $res = $crd->addProductsToDish($dishId, $productId, $quantity);
            }
        }

        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            $target_dir = "uploads/";
            $photoname = basename($_FILES["image"]["name"]);
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                //echo "The image has been uploaded.";
            } else {
                echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
            }

            $crd->updatePhotoOfDish($photoname, $_POST['dish_name']);
            //echo $target_file;
            $image = $target_file;
        }

        $selected_list="";
    }
}
//checks where to return, to the admin page or to the chef page since this page is being used by both admin and chef
$button = "";
if(isset($_SESSION['adminId'])){
    $button = "<button><a href='admin.php'>Back</a></button>";
}else{
    $button = "<button><a href='chef.php'>Back</a></button>";
}
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/form.css">
    <style>


        button{
            background: #cece5b;
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
            color: #cece5b;
        }
        button:before,button:after{
            content:'';
            position:absolute;
            top:0;
            right:0;
            height:2px;
            width:0;
            background: #cece5b;
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
<?php echo $button ?>
<h1 style="text-align: center">Adding new item</h1>
<div style="width: 100%; align-items: center">
    <form method="post" id="form" style="align-content: center" enctype="multipart/form-data">
    <table align="center">
            <tr>
                <td>
                    <label>Name</label>
                </td>
                <td>
                    <input type="text" name="dish_name" placeholder="Enter name of the dish" value="<?php echo $input1DishName;?>">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>List of products</h3>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <textarea name="addedProducts" readonly>
                        <?php echo $selected_list;
                        ?>
                    </textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <select name="products" id="products">
                        <?php echo $products_list; ?>
                    </select>
                </td>
                <td style="border: black">
                    <label style="font-size: 20px; width: 120px">Quantity</label>
                    <input type="number" min="0" step="0.001" name="quantity" size="6" maxlength="6" value="0" style="width: 100px">
                    <button name="addingButton" style="margin-left: 20px; font-size: 20px">Add</button>
                </td>
            </tr>

            <tr>
                <td>
                    <label>
                        Price
                    </label>
                </td>
                <td>
                    <input type="text" name="price" value="<?php echo $input2Price;?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Category</label>
                </td>
                <td>
                    <select name="category" style="font-size: 20px">
                        <option value="dishes">Dishes</option>
                        <option value="pasta">Pasta</option>
                        <option value="pizza">Pizza</option>
                        <option value="desert">Desert</option>
                        <option value="drink">Drink</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label>
                        Photo
                    </label>
                </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
            <tr>
                <td>
                    <label>
                        Description
                    </label>
                </td>
                <td>
                    <textarea name="description"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" name="submit" value="Save">
                </td>
            </tr>

        </table>
    </form>
</div>


</body>
</html>
<?php }else{
    echo "<script>alert('You are not allowed to enter this page')</script>";
}?>