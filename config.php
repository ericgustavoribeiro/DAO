<?php

spl_autoload_register(function($nomeClasse){


	$filename = "class".DIRECTORY_SEPARATOR.$nomeClasse.".php";

	if(file_exists($filename)){
		require_once($filename);
	}

});

?>