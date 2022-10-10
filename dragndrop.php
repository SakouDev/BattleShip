<?php

include './includes/db_connect.php';
include './includes/classes.php';
include_once './includes/manager.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=stylesheet href="assets/css/dragndrop.css" type="text/css"/>
    <script src="./assets/js/script.js" defer></script>
    <title>SimplonBattleShipsTestDrag&Drop</title>
</head>
<body>

<div class="container">

    <div id="squad1" class="squad" ondrop="drop(event, this)" ondragover="allowDrop(event)">
        <div class="squad_header">
            <h1><input class="squadname" id="name_squad1" type="text" name="name" placeholder="Squad 1"></h1>
            <p>
                <label for="class">Choisissez votre navire :</label>
                <select name="ship" id="selectShip1" onchange="updateShip1(this)">
                    <option hidden > --- </option>
                <?php
                    foreach($shipList as $ship) { ?>
                        <option data-path="<?php echo $ship['path']?>" value="<?php echo $ship['name'] ?>"><?php echo $ship['name'] ?></option>
                <?php } ?>
                </select>
            </p>
        </div>
    </div>

    <div class="squad" ondrop="drop(event, this)" ondragover="allowDrop(event)">
        <h1 id="players">Liste de joueurs :</h1>

        <?php
            foreach($playerList as $challenger) { ?>
        <div name="<?php echo $challenger['name'] ?>" data-name="<?php echo $challenger['name'] ?>" data-class="<?php echo $challenger['class'] ?>" data-lvl="<?php echo $challenger['lvl'] ?>" id="<?php echo $challenger['id'] ?>" class="challenger" draggable="true" ondragstart="drag(event)" ondrop="return false" ondragover="return false">
            <h1><?php echo $challenger['name'] ?></h1>
            <div class="data">
                <span><?php echo $challenger['class'] ?></span>
            </div>
            <div class="data">
                <span> <?php echo 'Level: '.$challenger['lvl'] ?> </span>
            </div>
        </div>

        <?php } ?>

    </div>

    <div id="squad2" class="squad" ondrop="drop(event, this)" ondragover="allowDrop(event)">
        <div class="squad_header">
            <h1><input class="squadname" id="name_squad2" type="text" name="name" placeholder="Squad 2"></h1>
            <p>
                <label for="class">Choisissez votre navire :</label>
                <select name="ship" id="selectShip2" onchange="updateShip2(this)">
                    <option hidden > --- </option>
                <?php
                    foreach($shipList as $ship) { ?>
                        <option data-path="<?php echo $ship['path']?>" value="<?php echo $ship['name'] ?>"><?php echo $ship['name'] ?></option>
                <?php } ?>
                </select>
            </p>
        </div>
    </div>

</div>

<form id="formAction" action="" method="POST">
    <input id="teamFinal" type="hidden" name="teams" value="">
    <input id="teamName1" type="hidden" name="team1" value="">
    <input id="ship1" type="hidden" name="ship1" value="">
    <input id="teamName2" type="hidden" name="team2" value="">
    <input id="ship2" type="hidden" name="ship2" value="">
    <div class="btncontainer">
		<div>
            <input class="slide-hover-left" name="" type="submit" onclick="startGame(this)" value="Start Game!" ></input>
		</div>
    </div>
</form>

<!-- <a href="index.php"><input type="button" id="backIndex" value="Retour"></input></a> -->
<a href="index.php">
    <div id="backButton">
            <div class="backBtn">
            <span class="line tLine"></span>
            <span class="line mLine"></span>
            <span class="label">Back</span>
            <span class="line bLine"></span>
        </div>
    </div>
</a>

</body>

<script>
let selectShip1 = document.getElementById('selectShip1');
let shipChoice1;
let selectShip2 = document.getElementById('selectShip2');
let shipChoice2;
let squad1 = document.getElementById('squad1');
let squad2 = document.getElementById('squad2');
let name1 = document.getElementById('name_squad1');
let name2 = document.getElementById('name_squad2');
let teamName1 = document.getElementById('teamName1');
let teamName2 = document.getElementById('teamName2');

let formAction = document.getElementById('formAction');
let teamFinal = document.getElementById('teamFinal');
let btn = document.getElementById('btn');

let team1 = [];
let team2 = [];

console.log(squad1);

function updateShip1(event) {
    shipChoice1 = event.options[event.selectedIndex].dataset.path
    console.log(shipChoice1);
    console.log(squad1);
    console.log(squad1.childNodes);
}
function updateShip2(event) {
    shipChoice2 = event.options[event.selectedIndex].dataset.path;
    console.log(shipChoice2);
}
function startGame(e){ 
    // if (shipChoice1==undefined){
    //     alert('Choisir un navire pour la Squad1!')
    //     e.preventDefault();
    //     return
    // }
    // if (shipChoice2==undefined){
    //     alert('Choisir un navire pour la Squad2!')
    //     e.preventDefault();
    //     return
    // }
    let squad1list = squad1.childNodes;                     //Récup les nodes des joueurs placés en drag'n'drop dans les teams
    let squad2list = squad2.childNodes;
    console.log(squad1.childNodes);
    let squad1PlayerNumber = squad1list.length-3;           //Nodes useless qui trainent
    let squad2PlayerNumber = squad2list.length-3;
    let teams = {};
    if(squad1PlayerNumber*squad2PlayerNumber==0){           
        alert('Il faut au moins un joueur dans chaque équipe!');
        return
    }
    
    //Récupère les données des joueurs du drag'n'drop
    for(i=0;i<squad1PlayerNumber;i++) {                     
        team1.push([squad1.lastChild.dataset.name,squad1.lastChild.dataset.class,squad1.lastChild.dataset.lvl]);
        squad1.removeChild(squad1.lastChild);
    }
    for(i=0;i<squad2PlayerNumber;i++) {
        team2.push([squad2.lastChild.dataset.name,squad2.lastChild.dataset.class,squad2.lastChild.dataset.lvl]);
        squad2.removeChild(squad2.lastChild);
    }
    
    //Prépare le json à envoyer en POST
    teams.team1 = team1;
    teams.team2 = team2;
    let json = JSON.stringify(teams)
    
    teamName1.value = name1.value;
    teamName2.value = name2.value;

    //Choix des bâteaux des deux équipes

    //Sprite navire par défaut si champs laissés vides
    if (shipChoice1==undefined){
        shipChoice1='Classique.png';
    }
    if (shipChoice2==undefined){
        shipChoice2='Classique.png';
    }
    ship1.value = shipChoice1;
    ship2.value = shipChoice2;

    //Nom par défaut si champs laissés vides
    if(teamName1.value=='') {
        teamName1.value = 'Team1';
    }
    if(teamName2.value=='') {
        teamName2.value = 'Team2';
    }
    teamFinal.value = json;

    formAction.action = "fight.php";
        
        //Essai en GET crade et pas secure: "pas opti mais ça marche"
        // btn.href = `fight.php?triche=${json}`;
        // formAction.action = `fight.php?team1=${name1.value}&team2=${name2.value}&triche=${json}`;
    
}


function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    let origin;
    origin = ev.target.parentElement;
    ev.dataTransfer.setData("text", ev.target.id);
    //   setTimeout(() => {
        //         ev.target.classList.add('hide_drop');
        //     }, 0);
    }
    
    function drop(ev, el) {
        ev.preventDefault();
        if (ev.target.childNodes.length==8) {
            let data = ev.dataTransfer.getData("text");
            origin.appendChild(document.getElementById(data));
        } else { 
            let data = ev.dataTransfer.getData("text");
            el.appendChild(document.getElementById(data));
        }
    }
    

    // let name1value = '';                                 Placeholder pour les noms des teams
    // let name2value = '';
    // name1.onblur = () => {
    //     name1value = name1.value;
    //     name1.placeholder = name1value;
    // }
    // name2.onblur = () => {
    //     name2value = name2.value;
    //     name2.placeholder = name2value;
    // }

</script>
</html>