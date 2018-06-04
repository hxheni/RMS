<?php

namespace core\products;


class products
{

    public $name;
    public $quantity;
    public $price;
    public $measurement;
    public $threshold;

    public function __construct($name, $q, $p, $m, $t)
    {
        $this->name = $name;
        $this->quantity = $q;
        $this->price = $p;
        $this->measurement = $m;
        $this->threshold = $t;
    }
}