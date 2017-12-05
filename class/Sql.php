<?php

class Sql extends PDO{

	private $conn;


	public function __construct(){

	$this->conn = new PDO("mysql:dbname=bdphp7;host=localhost", "root", ""); 

	}


	private function setParams($statment, $parameters = array()){

		foreach ($parameters as $key => $value) {
			
			$statment->bindParam($key, $value);

		}

	}


	private function setParam($statment, $key, $value){

		$statment->bindParam($key, $value);
	}

	public function query($rowQuery, $params = array()){
		
		$stmt = $this->conn->prepare($rowQuery);
		
		$this->setParams($stmt, $params);
		
		$stmt->execute();

		return $stmt;

	}


	public function select($rowQuery, $params = array()):array{
		
		$stmt = $this->query($rowQuery);
		
		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}



}


?>