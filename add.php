<?php

include_once 'includes/db_connect.php';
include_once 'includes/fonction.php';
include_once 'includes/manager.php';

if(isset($_POST['submit_creation'])){
    $BigManager->addNewPlayerToDb($_POST['playerClassId'],$_POST['name']);
    header("Location: index.php");
    exit();
}
if(isset($_POST['submit_ship_creation'])){
    $BigManager->addNewShipToDb($_POST['shipId'],$_POST['name']);
    header("Location: index.php");
    exit();
}

if(isset($_POST['deletePlayer'])){
    $BigManager->removePlayerFromDb($_POST['name']);
    header("Location: index.php");
    exit();
}
if(isset($_POST['deleteShip'])){
    $BigManager->removeShipFromDb($_POST['name']);
    header("Location: index.php");
    exit();
}

?>