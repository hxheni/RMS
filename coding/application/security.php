<?php

namespace core\logic;


abstract class security
{
    abstract function checkName($name);
    abstract function checkSurname($surname);
    abstract function checkUsername($username);
    abstract function checkPass($pass);
    abstract function checkAmount($amount);
    abstract function checkPhone($phone);
    abstract function checkDescription($type);
    abstract function checkPrice($price);
}