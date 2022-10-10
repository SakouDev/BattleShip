<?php

include 'db_connect.php';
include_once 'classes.php';

function checkDupePlayerInDb($playerName){         
    $connect = connexion();         
    $requestdupe = $connect->prepare("SELECT * FROM players WHERE name= :name");         
    $requestdupe->execute([             
    'name' => $playerName,   
    ]);         
    return $requestdupe->fetchAll(PDO::FETCH_ASSOC);    
    }

function checkDupeShipInDb($shipName){         
    $connect = connexion();         
    $requestdupe = $connect->prepare("SELECT * FROM ships WHERE name= :name");         
    $requestdupe->execute([             
    'name' => $shipName,   
    ]);         
    return $requestdupe->fetchAll(PDO::FETCH_ASSOC);    
    }

function displayTurn(int $turn, $attacker, $attacked, bool $crit) {
    $turnStatement = sprintf('<p class="turn-counter">Tour %s </p>', $turn);
    if ($crit) {
        $firstStatement = sprintf('Coup critique! %s attaque %s pour %d de dégats.<br>',
            $attacker->getFirstname(),
            $attacked->getFirstname(),
            $attacker->rekt()
        );
    } else {
        $firstStatement = sprintf('%s attaque %s pour %d de dégats.<br>',
            $attacker->getFirstname(),
            $attacked->getFirstname(),
            $attacker->getStrength()
        );
    }
    if (!$attacked->isDead()) {
        $secondStatement = sprintf('%s a encore %d PV.',
            $attacked->getFirstname(),
            $attacked->getHealth()
        );
    } else {
        $secondStatement = sprintf('%s est out !',
            $attacked->getFirstname(),
        );
    }
    echo '<div>';
    echo $turnStatement;
    echo $firstStatement;
    echo $secondStatement;
    echo '</div>';
}

function displayTurnArray(int $turn, $attacker, $attacked, bool $crit) {
    $turnStatement = $turn;
    $remainingHp = 0;
    $dmgDealt = 0;
    if ($crit) {
        $firstStatement = sprintf('Coup critique! %s attaque %s pour %d de dégats.',
            $attacker->getFirstname(),
            $attacked->getFirstname(),
            $attacker->rekt()
        );
        $dmgDealt = $attacker->rekt();
    } else {
        $firstStatement = sprintf('%s attaque %s pour %d de dégats.',
            $attacker->getFirstname(),
            $attacked->getFirstname(),
            $attacker->getStrength()
        );
        $dmgDealt = $attacker->getStrength();
    }
    if (!$attacked->isDead()) {
        $secondStatement = sprintf('%s a encore %d PV.',
            $attacked->getFirstname(),
            $attacked->getHealth()
        );
        $remainingHp = $attacked->getHealth();
    } else {
        $secondStatement = sprintf('%s est out !',
            $attacked->getFirstname(),
        );
        $remainingHp = 0;
    }
    return ['tour'=>$turnStatement,'attacker'=>$attacker->getFirstname(),'attacked'=>$attacked->getFirstname(),'crit'=>$crit,'deathblow'=>$attacked->isDead(),'remainingHP'=>$remainingHp,'dmgDealt'=>$dmgDealt,'hit'=>$firstStatement,'playerStatus'=>$secondStatement];

}

?>