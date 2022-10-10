<?php

function connexion(){
    $servername = "localhost";
    $username = "u983603541_Sakou";
    $password = "B87ce6a6a1e!";
    $dbname = "u983603541_BattleShip";
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