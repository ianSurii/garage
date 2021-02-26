<?php
session_start();
define('servername','localhost');
define('username','root');
define('password','');
define('dbname','happyfarmer');
class db{
    function __construct(){
		$this->connection = new mysqli(servername, username,password,dbname);
		
		if ($this->connection->connect_error) die('Database error -> ' . $this->connection->connect_error);
		
	}
	
	function ret_obj(){
		return $this->connection;
	}


}
?>