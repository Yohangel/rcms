<?php

class connection {

	private $host = "localhost"; 
	private $user = "root"; 
	private $password = ""; 
	private $db = "rcms"; 

	public function start(){ 
	    try {
			$dbConnection = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->password);
			$dbConnection->exec("set names utf8");
			$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $dbConnection;
		}
		
		catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}
	}
}

?>