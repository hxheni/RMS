<?php
namespace core\transaction;


class transaction
{

    public $amount;
    public $transmakerId;
    //status means if the money enters the system or goes our of the system
    public $status;
    public $description;

    function __construct($a, $t, $s, $d)
    {
        $this->amount = $a;
        $this->transmakerId = $t;
        $this->status = $s;
        $this->description = $d;
    }


}