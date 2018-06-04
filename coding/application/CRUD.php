<?php

namespace core\logic;


interface CRUD
{
    public function retrieve($id);
    public function delete($id);

}