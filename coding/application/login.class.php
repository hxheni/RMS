<?php

namespace core\user;
use core\database;

require "database.php";

class login
{
    public $con;

    function __construct(){
        $this->con = new database();
    }

    function connect($username, $password){
        session_start();

        $query = "Select * from people where username = '$username' and password = '$password'";
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            echo "User not found ". \mysqli_error($this->con->connect());
            exit();
        }
        //$row = \mysqli_fetch_array($result, MYSQL_ASSOC);
        $numRows = \mysqli_num_rows($result);
		//echo "<script>alert('helloooooooo para num rows')</script>";
		
	
        if($numRows == 1){
			
            $resultArr = $result->fetch_assoc();
            $_SESSION['login_user'] = $resultArr['id'];

			
			echo "<script>alert('u futa')</script>";
            $_SESSION['login_user'] = $resultArr['id'];
			
			

            if ($resultArr['task'] == 'accountant') {
                $_SESSION['login_user'] = $resultArr['id'];
                header('Location:showUser.php');
				//echo "<script>alert('helloooooooo')</script>";
            }
            else if ($resultArr['task'] == 'waiter') {
                $_SESSION['login_user'] = $resultArr['id'];
                header('Location:showWaiter.php');
            }
            else if ($resultArr['task'] == 'admin') {
                $_SESSION['adminId'] = $resultArr['id'];
                header('Location: admin.php');
            }
            else if($resultArr['task']== 'chef'){
                $_SESSION['chefId'] = $resultArr['id'];
                header('Location: chef.php');
            }
        }
        else {echo "<script>alert('Wrong Credentials. Sign in again.')</script>";
        //echo $username + " " + $password;
            }
    }

    function connectTable($table, $password){
        session_start();

        $query = "Select * from tables where tableNumber = '$table' and password = '$password'";
        $result = \mysqli_query($this->con->connect(),$query);
        if(!$result){
            echo "User not found ". \mysqli_error($this->con->connect());
            exit();
        }
        //$row = \mysqli_fetch_array($result, MYSQL_ASSOC);
        $numRows = \mysqli_num_rows($result);
        if($numRows == 1){
			$resultArr = $result->fetch_assoc();
            //$resultArr = mysqli_fetch_array($result,MYSQL_ASSOC);
            $_SESSION['login_user'] = $resultArr['tableNumber'];

            header('Location:showTable.php');
        }
        else {echo "<script>alert('Wrong Credentials. Sign in again.')</script>";
            //echo $username + " " + $password;
        }
    }

}
?>