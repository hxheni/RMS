<?php

namespace core\orders;

class orders
{
     public $tableId;
     public $chefId;
     public $waiterId;
     public $amount;
     public $description;
     public $status;
     public $paid;

     public function __construct($tableId)
     {
         $this->tableId = $tableId;
         $this->amount = 0;
         $this->chefId=0;
         $this->waiterId=0;
         $this->description="";
         $this->status=NULL;
         $this->paid=0;
     }


}