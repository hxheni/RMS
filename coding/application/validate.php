<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 26/01/2018
 * Time: 18:02
 */

namespace core\user;
require "security.php";

class validate extends \core\logic\security
{

    function checkName($name)
    {
        if (preg_match("/^[a-zA-Z]*$/",$name)) return true;
        return false;
    }

    function checkSurname($surname)
    {
        if (preg_match("/^[a-zA-Z]*$/",$surname)) return true;
        return false;
    }

    function checkUsername($username)
    {
        if (preg_match("/^[a-zA-Z]*.[a-zA-Z]*$/",$username)) return true;
        return false;
    }

    function checkPass($str)
    {
        return preg_match("/\w{8,16}/i",$str) && preg_match("/[A-Z]+/", $str) && preg_match("/[a-z]+/", $str) && preg_match("/[0-9]+/", $str);
    }

    function checkAmount($amount)
    {
        if(preg_match("/^[1-9]{1}[0-9]*$/", $amount)){
            if($amount<100000000)
                return true;
            else return false;
        }
        return false;
    }

    function checkPhone($phone)
    {
        if(preg_match("/^([+]|[0]{2})[3][5][5][6][679][0-9]{7}$/", $phone)){
            return true;
        }
        return false;
    }


    function checkDescription($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    function checkPrice($price)
    {
        if (ctype_digit($price)) return true;
        return false;
    }


    public function isEmpty($data, $field) {
        $msg = "";
        foreach ($field as $value){
            if(empty($data[$value])){
                $msg .= "$value is empty. ";
            }
        }
        return $msg;
    }
}