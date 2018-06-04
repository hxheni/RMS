<?php

require 'session.php';
require_once 'crudAdmin.php';

if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $surname=$_POST['surname'];
    $phone=$_POST['phone'];
    $task=$_POST['task'];
    $salary=$_POST['salary'];
    $username=$name.".".$surname;
    $photo = basename($_FILES["fileToUpload"]["name"]);

    $person=new \core\people\people($name, $surname, $username, $phone, $task, $photo, $salary);

    $adm = new \core\people\crudAdmin();
    $result = $adm->updatePerson($login_session['id'], $person);

    if (basename($_FILES["fileToUpload"]["name"]) !== "") {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

        //echo unlink("uploads/$_POST[username].JPG");

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $imgErr .= "File is not an image. ";
            $uploadOk = 0;
        }

// Check if file already exists
        if (file_exists($target_file)) {
            //echo unlink(($target_file));
            //echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
// Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $imgErr .= "Sorry, your file is too large. ";
            $uploadOk = 0;
        }
// Allow certain file formats
        if ($imageFileType == "jpg" || $imageFileType == "JPG") {
            $uploadOk = 1;
        } else {
            $imgErr .= " Sorry, only JPG and JPEG files are allowed. ";
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $imgErr .= "Sorry, your file was not uploaded. ";
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                //echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
            } else {
                $imgErr .= "Sorry, there was an error uploading your file.";
            }
        }
    }

    $result1 = $adm->setPhoto($login_session['id'], $photo);

    if($result && $result1) header("Location: showUser.php");

    //echo $username;
}


?>