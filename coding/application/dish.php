<?php

namespace core\dish;


class dish
{

    public $id;
    public $name;
    public $photo;
    public $description;
    public $price;
    public $category;

    public function __construct($name, $photo, $description, $price, $category)
    {
        $this->name = $name;
        $this->photo = $photo;
        $this->description = $description;
        $this->price = $price;
        $this->category = $category;
    }


}