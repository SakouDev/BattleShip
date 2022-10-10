<?php 
    include_once 'includes/manager.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=stylesheet href="assets/css/index.css" type="text/css"/>
    <script src="./assets/js/script.js" defer></script>
    <title>SimplonBattleShips</title>
</head>
<body>
<div class="container">


    <div id="boxPlayer">
        <div class="up">
            <div id="form">
                <h3>Formulaire d'inscription:</h3>
            <?php
                include 'includes/form.player.php'
            ?>
            </div>
        </div>
        <div class="down">
            <h3>Détails des classes disponibles:</h3>

            <?php
                foreach($classList as $class) {?> 
                    <p><?php echo $class['name'].' ➟ Vie : '.$class['hp'].' / Attaque : '.$class['strength'] ?></p>
            <?php } ?>
        </div>
    </div>
    <div id="boxShip">
        <div class="up">
            <div id="form">
                <h3>Formulaire navire:</h3>
            <?php
                include 'includes/form.ship.php'
            ?>
            </div>
        </div>
        <div class="down">
            <h3>Bateaux disponibles:</h3>
            <form id="preview">
                <?php
                    foreach($shipSpriteList as $shipSprite) {?> 
                        <input class="carousel" type="radio" name="fancy" autofocus id="<?php echo $shipSprite['id'] ?>" />   
                <?php } ?>
                <?php
                    foreach($shipSpriteList as $shipSprite) {?>
                <label class="labels" style="<?php echo 'background-image: url(./assets/img/'.$shipSprite['path_hori'].')' ?>;background-size: contain;background-repeat: no-repeat;background-position: center;" for="<?php echo $shipSprite['id'] ?>"></label>
                <?php } ?>
	        </form>   
        </div>
    </div>

    <a href="dragndrop.php"><button id="btn_index">GO</button></a>
        <span class="btncontainer">
        <a href="history.php">
            <input class="slide-hover-left" type="button" value="Historique" ></input>
        </a>
    </span>
</div>


</body>

<script>
let selectName = document.getElementById('selectName');
let playerName = document.getElementById('playerNameForm');
let playerClassId = document.getElementById('class');
let spriteId = document.getElementById('classSprite');

let selectShipName = document.getElementById('selectShipName');
let shipName = document.getElementById('shipNameForm');


let formPlayer = document.getElementById('formPlayer');
let formShip = document.getElementById('formShip');

//Sécurité anti champs vides
function emptyfield() {
    let x = playerName.value;
    if (x == "") {
        alert("RENSEIGNER UN NOM DE JOUEUR!");
        return false;
    };
    formPlayer.action = "add.php";

}
function emptyShipfield() {
    let x = shipName.value;
    if (x == "") {
        alert("RENSEIGNER UN NOM DE NAVIRE!");
        return false;
    };
    formShip.action = "add.php";
}

function updateName(event) {
    let selectedClass = event.options[event.selectedIndex].dataset.class;
    playerName.value = event.options[event.selectedIndex].value;
    playerName.dataset.class = selectedClass;
    for(let i=0;i<playerClassId.options.length;i++){
        if (playerClassId.options[i].innerText == selectedClass){
            playerClassId.options[i].selected = true;
            return
        }
    }
}

function updateShipName(event) {
    let selectedSprite = event.options[event.selectedIndex].dataset.path;
    shipName.value = event.options[event.selectedIndex].value;
    shipName.dataset.path = selectedSprite;
    for(let i=0;i<spriteId.options.length;i++){
        if (spriteId.options[i].dataset.path == selectedSprite){
            spriteId.options[i].selected = true;
            return
        }
    }
}

</script>
</html>