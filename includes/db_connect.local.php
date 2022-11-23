<?php

function connexion(){
    $servername = "sql8.freesqldatabase.com";
    $username = "sql8580199";
    $password = "D4BzEHaBPu";
    $dbname = "sql8580199";
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
