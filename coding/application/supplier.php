<?php

namespace core\supplier;


class supplier
{
    public $name;
    public $phone;
    public $description;
    public $email;

    function __construct($name, $phone, $desc, $email)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->description = $desc;
        $this->email = $email;
    }
}