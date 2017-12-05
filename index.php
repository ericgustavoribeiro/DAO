<?php

require_once("config.php");

//$sql = new Sql();


//$usuarios = $sql->select("SELECT * FROM usuarios");

//echo json_encode($usuarios);

//$user = new Usuario();
//$user->loadById(1);
//echo $user;


//$usuarios = Usuario::getList();
//echo json_encode($usuarios);

//$usuarios = Usuario::search("e");
//echo json_encode($usuarios);


$user = new Usuario();
$user->loadById(7);
$user->update("JOAO", "sas");


echo $user;

//$user->setLogin("Bb");
//$user->setSenha("12");

//$user->insert();

//echo $user;

//$user->login("Eric G", "1234");
//echo $user;
?>