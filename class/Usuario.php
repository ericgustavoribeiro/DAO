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

			//$row = 	$results[0];

			$this->setData($results[0]);

			/*
			// new DateTime();	formata a data
			$this->setIdusuario($row['id_user']);
			$this->setLogin($row['login']);
			$this->setSenha($row['senha']);
			*/
		}

	}


	public static function getList(){
		
		$sql = new Sql();

		return $sql->select("SELECT * FROM usuarios ORDER BY login");

	}

	public static function search($login){
		$sql = new Sql();

		return $sql->select("SELECT * FROM usuarios WHERE login LIKE :LOGIN", array(
			":LOGIN"=>"%".$login."%"	
		));
	}

	public function login($login, $senha){
			$sql = new Sql();

		$results = $sql->select("SELECT * FROM usuarios WHERE login = :LOGIN and senha = :SENHA", array(
			":LOGIN"=>$login,
			":SENHA"=>$senha
		));

		//Fazem a mesma funçao, comapram se 
		//if(issent($results[0])){o array é nulo 
		if(count($results) > 0){

			//$row = 	$results[0];
			$this->setData($results[0]);

			/*
			// new DateTime();	formata a data
			$this->setIdusuario($row['id_user']);
			$this->setLogin($row['login']);
			$this->setSenha($row['senha']);
			*/
		}else{
			throw new Exception("LOGIN/SENHA INVALIDOS !");
			
		}
	}


	public function setData($data){

			$this->setIdusuario($data['id_user']);
			$this->setLogin($data['login']);
			$this->setSenha($data['senha']);

	}

	public function insert(){
		$sql = new Sql();
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(
			":LOGIN"=>$this->getLogin(),
			":SENHA"=>$this->getSenha()
		));

		if(count($results) > 0){
			$this->setData($results[0]);
		}

	}


	public function update($login, $senha){

		$this->setLogin($login);
		$this->setSenha($senha);

		$sql = new Sql();
		
		$sql->query("UPDATE usuarios SET login = :LOGIN, senha = :SENHA WHERE id_user = :ID", array(
			":LOGIN"=>$this->getLogin(),
			":SENHA"=>$this->getSenha(),
			":ID"=>$this->getIdusuario()
		));

	}

	public function delete(){
		$sql = new Sql();

		$sql->query("DELETE FROM usuarios WHERE id_user = :ID", array(
		
			":ID"=>$this->getIdusuario()
		));

		$this->setIdusuario(null);
		$this->setLogin(null);
		$this->setSenha(null);
	}

	public function __construct($login = "", $senha = ""){
			
			$this->setLogin($login);
			$this->setSenha($senha);
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