<?php

function connexion() {
    $servername = "127.0.0.1";
    $username   = "battleship_user";
    $password   = "SuperMotDePasse123!";
    $dbname     = "battleship";

    try{
    	$db = new PDO(
    		'mysql:host='.$servername.';dbname='.$dbname.';charset=UTF8',
    		$username,
      		$password
    	);
    	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      	return $db;
    }
    catch(Exception $e){
      die('Erreur:'.$e->getMessage());
    }
}

?>
