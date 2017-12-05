<?php

class Usuario{


	private $idusuario;
	private $login;
	private $senha;
//	private $idusuario;

	public function getIdusuario(){
		return $this->idusuario;
	}

	public function setIdusuario($id){
		$this->idusuario = $id;
	}

	public function getLogin(){
		return $this->login;
	}

	public function setLogin($login){
		$this->login = $login;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}

	public function loadById($id){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM usuarios WHERE id_user = :ID", array(
			":ID"=>$id
		));

		//Fazem a mesma funçao, comapram se 
		//if(issent($results[0])){o array é nulo 
		if(count($results) > 0){

			$row = 	$results[0];

			// new DateTime();	formata a data
			$this->setIdusuario($row['id_user']);
			$this->setLogin($row['login']);
			$this->setSenha($row['senha']);

		}

	}

	public function __toString(){

		return json_encode(array(
			"id_user"=>$this->getIdusuario(),
			"login"=>$this->getLogin(),
			"senha"=>$this->getSenha()//->format("d/m/Y H:i:s")

		));	
	}

}

?>