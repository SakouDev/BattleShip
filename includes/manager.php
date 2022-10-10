<?php

include 'db_connect.php';
include_once 'classes.php';

$connect = connexion();

$BigManager = new Manager($connect);
$classList = $BigManager->getClassList();
$playerList = $BigManager->getPlayerList();
$shipList = $BigManager->getShipList();
$shipSpriteList = $BigManager->getShipSpritesList();
$history = $BigManager->getFightList();
?>