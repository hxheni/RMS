<?php

namespace core;

class database
{
    public $servername= "localhost";
    public $username = "agugu15";
    public $password = "ag516del";
    public $dbname="cen17_agugu15";
    public $connection;

    function __construct(){
        $this->connect();
    }

    function connect(){
        $this->connection =
            new \mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if($this->connection->connect_error){
            //some errror occurred
            die("Connection failed ".$this->connection->connect_error);
        }
        return $this->connection;
    }

    function disconnect(){
        \mysqli_close($this->connection);
        echo "Disconnected";
    }

}