<?php


namespace core\people;

class people
{

    public $name;
    public $surname;
    public $username;
    public $task;
    public $password;
    public $phone;
    public $photo;
    public $salary;

    function __construct($n, $surname, $username, $phone, $task, $photo, $salary){
        $this->name = $n;
        $this->surname = $surname;
        $this->username = $username;
        $this->task = $task;
        $this->phone = $phone;
        $this->photo = $photo;
        $this->salary = $salary;
    }



}