<?php
include_once 'includes/classes.php';
include_once 'includes/fonction.php';
include_once 'includes/db_connect.php';
include_once 'includes/manager.php';

$squads = [];
$squad1 = [];
$squad2 = [];

//Récup et decode le json du POST
$squads = json_decode($_POST['teams'],true);

$stats = [];
foreach($classList as $class) {
    $stats[] = ['class'=>$class['name'], 'totalHP'=>$class['hp']];
}

//Teams creation with BigManager
foreach($squads['team1'] as $team1Member) {
    $classStats=$BigManager->getStats($team1Member[1]);
    $squad1[] = $BigManager->createPlayer($team1Member[1],$team1Member[0],$classStats['hp'],$classStats['hpGrowth'],$classStats['strength'],$classStats['strengthGrowth'],$team1Member[2]);
}
foreach($squads['team2'] as $team2Member) {
    $classStats=$BigManager->getStats($team2Member[1]);
    $squad2[] = $BigManager->createPlayer($team2Member[1],$team2Member[0],$classStats['hp'],$classStats['hpGrowth'],$classStats['strength'],$classStats['strengthGrowth'],$team2Member[2]);
}

//Assigne les teams, avec le nom
$teams[] = ['name'=>$_POST['team1'], 'ship'=>$_POST['ship1'], 'team'=>$squad1];
$teams[] = ['name'=>$_POST['team2'], 'ship'=>$_POST['ship2'], 'team'=>$squad2];

$fight = [];
$turn = 1;
$coinflip = random_int(0,1); /* Who goes first? */
while (count($teams[0]['team'])*count($teams[1]['team'])>0) {                   //Ends the game when a team is out
    if ($turn%2==0) {
        $A = 1 - $coinflip;
        $B = $coinflip;
    } else {
        $A = $coinflip;
        $B = 1 - $coinflip;
    }

    $Shooter= $teams[$B]['team'][rand(0,count($teams[$B]['team'])-1)];          //Random shooter from assaulter team
    $Shooted= $teams[$A]['team'][rand(0,count($teams[$A]['team'])-1)];          //Random shooted

    $isCrit = $Shooter->hit($Shooted);

    $fight[] = displayTurnArray($turn, $Shooter, $Shooted, $isCrit);

    if ($Shooted->isDead()) {                                                   //Removes dead player from the team
        unset($teams[$A]['team'][array_search($Shooted, $teams[$A]['team'])]);
        $teams[$A]['team'] = array_values($teams[$A]['team']);
    }
    $turn+=1;
}

if (count($teams[1]['team'])==0) {  
    $winner = $teams[0]['name'];                                          //Victory!
} else {
    $winner = $teams[1]['name'];
}

$endResults = [$teams[0]['name'],$teams[1]['name'],'totalTurn'=>$turn-1 ,'winner'=>$winner];
$fight[] = $endResults;

if ($endResults['winner'] == $endResults[0]) {
    foreach($squad1 as $player) {
        $BigManager->addLvlToPlayer($player);
    }
    foreach($squad2 as $player) {
        $BigManager->fixLvlOfPlayer($player);
    }
} else {
    foreach($squad2 as $player) {
        $BigManager->addLvlToPlayer($player);
    }
    foreach($squad1 as $player) {
        $BigManager->fixLvlOfPlayer($player);
    }
}

$BigManager->recordFightInDb($endResults['totalTurn'],$endResults[0],$endResults[1],$endResults['winner']);

$fp = fopen('./assets/json/results.json', 'w');
fwrite($fp, json_encode($fight,JSON_UNESCAPED_UNICODE));
fclose($fp);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=stylesheet href="assets/css/fight.css" type="text/css"/>
    <script src="./assets/js/script.js" defer></script>
    <title>SimplonBattleShips</title>
</head>
<body>
    <section id="battle-area">
        
    <div id = "animationLeft" class="">
        <div id="avatarLeft" class=""></div>
    </div>
    <div id = "animationRight" class="">
        <div id="avatarRight" class=""></div>
    </div>
    
    <div id="bardLeft" class="hidden"></div>
    <div id="bardRight" class="hidden"></div>

    <div id="leftShip" data-win="" data-ship="<?php echo $_POST['ship1'] ?>" data-team="<?php echo count($squads['team1']) ?>">
        <div id="leftShipChar1" class="hidden" data-hp="<?php echo $squad1[0]->getMaxHealth() ?>"  data-name="<?php echo $squads['team1'][0][0] ?>" data-sprite="<?php echo $squads['team1'][0][1] ?>">
            <div class="hpBarContainer">
                <div id="leftRemainingHp1" data-hp="" class="remainingHpBar" style="width: 100%;"></div>
            </div>
            <div class="hpBarText">
                <p></p>
            </div>
            <p class="characterName"></p>
            <p class="dmgTaken hidden dmgLeft">55</p>
        </div>

        <div id="leftShipChar2" class="hidden" data-hp="<?php if(count($squads['team1'])>=2) {echo $squad1[1]->getMaxHealth();} ?>"  data-name="<?php echo $squads['team1'][1][0] ?>" data-sprite="<?php echo $squads['team1'][1][1] ?>">
            <div class="hpBarContainer">
                <div id="leftRemainingHp2" data-hp="" class="remainingHpBar" style="width: 100%;"></div>
            </div>
            <div class="hpBarText">
                <p></p>
            </div>
            <p class="characterName"></p>
            <p class="dmgTaken hidden dmgLeft"></p>
        </div>

        <div id="leftShipChar3" class="hidden" data-hp="<?php if(count($squads['team1'])>=3) {echo $squad1[2]->getMaxHealth();} ?>"  data-name="<?php echo $squads['team1'][2][0] ?>" data-sprite="<?php echo $squads['team1'][2][1] ?>">
            <div class="hpBarContainer">
                <div id="leftRemainingHp3" data-hp="" class="remainingHpBar" style="width: 100%;"></div>
            </div>
            <div class="hpBarText">
                <p></p>
            </div>
            <p class="characterName"></p>
            <p class="dmgTaken hidden dmgLeft"></p>
        </div>

        <div id="leftShipChar4" class="hidden" data-hp="<?php if(count($squads['team1'])>=4) {echo $squad1[3]->getMaxHealth();} ?>"  data-name="<?php echo $squads['team1'][3][0] ?>" data-sprite="<?php echo $squads['team1'][3][1] ?>">
            <div class="hpBarContainer">
                <div id="leftRemainingHp4" data-hp="" class="remainingHpBar" style="width: 100%;"></div>
            </div>
            <div class="hpBarText">
                <p></p>
            </div>
            <p class="characterName"></p>
            <p class="dmgTaken hidden dmgLeft"></p>
        </div>

        <div id="leftShipChar5" class="hidden" data-hp="<?php if(count($squads['team1'])==5) {echo $squad1[4]->getMaxHealth();} ?>"  data-name="<?php echo $squads['team1'][4][0] ?>" data-sprite="<?php echo $squads['team1'][4][1] ?>">
            <div class="hpBarContainer">
                <div id="leftRemainingHp5" data-hp="" class="remainingHpBar" style="width: 100%;"></div>
            </div>
            <div class="hpBarText">
                <p></p>
            </div>
            <p class="characterName"></p>
            <p class="dmgTaken hidden dmgLeft"></p>
        </div>

    </div>

    <form id="saveResults" action="" method="POST">
        <input id="turnCount" type="hidden" name="turnCount" value="">
        <input id="team1" type="hidden" name="team1" value="">
        <input id="team2" type="hidden" name="team2" value="">
        <input id="winner" type="hidden" name="winner" value="">
        <input type="button" onclick="window.location.reload()" id="reloadGame" class="hidden" value="Rematch"></input>
    </form>

    <input id="QuickBtn" type="button" onclick="quickMode()" value="Quick Mode"></input>
    <input id="douille" type="hidden" value=""></input>
    <input type="button" onclick="fetchDataDelay()" id="goMatch" value="GO !"></input>
    
    <a id="disparou" href="dragndrop.php" class="hidden">
        <div id="backButton">
            <div class="backBtn">
            <span class="line tLine"></span>
            <span class="line mLine"></span>
            <span class="label">Back</span>
            <span class="line bLine"></span>
            </div>
        </div>
    </a>

    <div id="rightShip" data-ship="<?php echo $_POST['ship2'] ?>" data-team="<?php echo count($squads['team2']) ?>">
        <div id="rightShipChar1" class="hidden" data-hp="<?php echo $squad2[0]->getMaxHealth() ?>"  data-name="<?php echo $squads['team2'][0][0] ?>" data-sprite="<?php echo $squads['team2'][0][1] ?>">
            <div class="hpBarContainer">
                <div id="rightRemainingHp1" data-hp="" class="remainingHpBar" style="width: 100%;"></div>
            </div>
            <div class="hpBarText rightCrewText">
                <p></p>
            </div>
            <p class="characterName rightCrewText"></p>
            <p class="dmgTaken hidden rightCrewText dmgRight">55</p>
        </div>

        <div id="rightShipChar2" class="hidden" data-hp="<?php if(count($squads['team2'])>=2) {echo $squad2[1]->getMaxHealth();} ?>"  data-name="<?php echo $squads['team2'][1][0] ?>" data-sprite="<?php echo $squads['team2'][1][1] ?>">
            <div class="hpBarContainer">
                <div id="rightRemainingHp2" data-hp="" class="remainingHpBar" style="width: 100%;"></div>
            </div>
            <div class="hpBarText rightCrewText">
                <p></p>
            </div>
            <p class="characterName rightCrewText"></p>
            <p class="dmgTaken hidden rightCrewText dmgRight"></p>
        </div>

        <div id="rightShipChar3" class="hidden" data-hp="<?php if(count($squads['team2'])>=3) {echo $squad2[2]->getMaxHealth();} ?>"  data-name="<?php echo $squads['team2'][2][0] ?>" data-sprite="<?php echo $squads['team2'][2][1] ?>">
            <div class="hpBarContainer">
                <div id="rightRemainingHp3" data-hp="" class="remainingHpBar" style="width: 100%;"></div>
            </div>
            <div class="hpBarText rightCrewText">
                <p></p>
            </div>
            <p class="characterName rightCrewText"></p>
            <p class="dmgTaken hidden rightCrewText dmgRight"></p>
        </div>

        <div id="rightShipChar4" class="hidden" data-hp="<?php if(count($squads['team2'])>=4) {echo $squad2[3]->getMaxHealth();} ?>"  data-name="<?php echo $squads['team2'][3][0] ?>" data-sprite="<?php echo $squads['team2'][3][1] ?>">
            <div class="hpBarContainer">
                <div id="rightRemainingHp4" data-hp="" class="remainingHpBar" style="width: 100%;"></div>
            </div>
            <div class="hpBarText rightCrewText">
                <p></p>
            </div>
            <p class="characterName rightCrewText"></p>
            <p class="dmgTaken hidden rightCrewText dmgRight"></p>
        </div>

        <div id="rightShipChar5" class="hidden" data-hp="<?php if(count($squads['team2'])==5) {echo $squad2[4]->getMaxHealth();} ?>"  data-name="<?php echo $squads['team2'][4][0] ?>" data-sprite="<?php echo $squads['team2'][4][1] ?>">
            <div class="hpBarContainer">
                <div id="rightRemainingHp5" data-hp="" class="remainingHpBar" style="width: 100%;"></div>
            </div>
            <div class="hpBarText rightCrewText">
                <p></p>
            </div>
            <p class="characterName rightCrewText"></p>
            <p class="dmgTaken hidden rightCrewText dmgRight"></p>
        </div>

    </div>
    
    </section>
    <section id="logs-area">

    </section>

<script>
let delay = 1400;

let Captain = 'Captain';
let Gunner = 'Gunner';
let Canonneer = 'Canonneer';
let Peon = 'Peon';
let winnerBard;

let leftShip = document.getElementById('leftShip');
let leftPlayerNumber = leftShip.dataset.team;
let rightShip = document.getElementById('rightShip');
let rightPlayerNumber = rightShip.dataset.team;
let logs = document.getElementById('logs-area');

let leftShip1 = document.getElementById('leftShipChar1');
let leftShip2 = document.getElementById('leftShipChar2');
let leftShip3 = document.getElementById('leftShipChar3');
let leftShip4 = document.getElementById('leftShipChar4');
let leftShip5 = document.getElementById('leftShipChar5');
let rightShip1 = document.getElementById('rightShipChar1');
let rightShip2 = document.getElementById('rightShipChar2');
let rightShip3 = document.getElementById('rightShipChar3');
let rightShip4 = document.getElementById('rightShipChar4');
let rightShip5 = document.getElementById('rightShipChar5');

//"SoundDesign"
let Death = new Audio('./assets/sound/Death.mp3');
let winTheme = new Audio('./assets/sound/ffvii_win.mp3');
let SeaAndSeaGulls = new Audio('./assets/sound/seaandgulls.mp3');
SeaAndSeaGulls.volume = 0.02;
SeaAndSeaGulls.play();

//Teams pour les changements de sprites
let teams = [];
teams.push(
    ['leftShipChar1',leftShip1.dataset.name,leftShip1.dataset.sprite,false,'left'],
    ['leftShipChar2',leftShip2.dataset.name,leftShip2.dataset.sprite,false,'left'],
    ['leftShipChar3',leftShip3.dataset.name,leftShip3.dataset.sprite,false,'left'],
    ['leftShipChar4',leftShip4.dataset.name,leftShip4.dataset.sprite,false,'left'],
    ['leftShipChar5',leftShip5.dataset.name,leftShip5.dataset.sprite,false,'left'],
    ['rightShipChar1',rightShip1.dataset.name,rightShip1.dataset.sprite,false,'right'],
    ['rightShipChar2',rightShip2.dataset.name,rightShip2.dataset.sprite,false,'right'],
    ['rightShipChar3',rightShip3.dataset.name,rightShip3.dataset.sprite,false,'right'],
    ['rightShipChar4',rightShip4.dataset.name,rightShip4.dataset.sprite,false,'right'],
    ['rightShipChar5',rightShip5.dataset.name,rightShip5.dataset.sprite,false,'right']
    );

//Sprites des bateaux
leftShip.style.backgroundImage = `url(./assets/img/${leftShip.dataset.ship}`;
rightShip.style.backgroundImage = `url(./assets/img/${rightShip.dataset.ship}`;

//Affiche les sprites selon le nombre de joueurs
for(y=0;y<leftPlayerNumber;y++) {
    let fittingHp = leftShip.children[y].dataset.hp;
    let fittingName = leftShip.children[y].dataset.name;
    leftShip.children[y].classList.toggle('hidden');
    leftShip.children[y].dataset.hp = fittingHp;
    leftShip.children[y].children[0].children[0].dataset.hp = fittingHp;
    leftShip.children[y].children[1].children[0].innerHTML = `${fittingHp}`;
    // leftShip.children[y].children[1].children[1].innerHTML = ` / ${fittingHp}`;
    leftShip.children[y].children[2].innerHTML = fittingName;
}
for(y=0;y<rightPlayerNumber;y++) {
    let fittingHp = rightShip.children[y].dataset.hp;
    let fittingName = rightShip.children[y].dataset.name;
    rightShip.children[y].classList.toggle('hidden');
    rightShip.children[y].dataset.hp = fittingHp;
    rightShip.children[y].children[0].children[0].dataset.hp = fittingHp
    rightShip.children[y].children[1].children[0].innerHTML = `${fittingHp}`;
    // rightShip.children[y].children[1].children[1].innerHTML = ` / ${fittingHp}`;
    rightShip.children[y].children[2].innerHTML = fittingName;
}

for (element of teams) {
    document.getElementById(element[0]).style.background = `url(assets/img/Sprites/${element[2]}Idle.gif) no-repeat`;
    document.getElementById(element[0]).style.backgroundSize = 'cover';
}

function displayTurn(turn,hit,status) {
    logs.innerHTML += `<div><p class="turn-counter">Tour ${turn} </p>${hit}<br>${status}</div>`;
}

function displayVictory(winner) {
    logs.innerHTML += `<p class="victory">Victoire de ${winner} !</p>`;
}

function attack(attacker, attacked, dead, crit, remainingHp,dmg) {
    const shooter = teams.find(element => element[1]==attacker);
    const shooted = teams.find(element => element[1]==attacked); 
    const shootedMaxHp = document.getElementById(shooted[0]).dataset.hp;

    if (crit){
        if (shooter[4]=='left') {
            let critBackgroundLeft = document.getElementById("animationLeft");
            let critAvatarLeft = document.getElementById("avatarLeft");

            document.getElementById("avatarLeft").style.background = `url(assets/img/Crit/${shooter[2]}.png) no-repeat`;

            critBackgroundLeft.classList.toggle("critLeft");
            critAvatarLeft.classList.toggle("avatarLeft");

            setTimeout(function(){
                critBackgroundLeft.classList.toggle("critLeft");
                critAvatarLeft.classList.toggle("avatarLeft");
                }, delay - 10);
        } else {
            let critBackgroundRight = document.getElementById("animationRight");
            let critAvatarRight = document.getElementById("avatarRight");

            document.getElementById("avatarRight").style.background = `url(assets/img/Crit/${shooter[2]}.png) no-repeat`;

            critBackgroundRight.classList.toggle("critRight");
            critAvatarRight.classList.toggle("avatarRight");

            setTimeout(function(){
                critBackgroundRight.classList.toggle("critRight");
                critAvatarRight.classList.toggle("avatarRight");
                }, delay - 10);
        }
    }
    if (!dead) {
        document.getElementById(shooter[0]).style.background = `url(assets/img/Sprites/${shooter[2]}Attack.gif) no-repeat`;
        document.getElementById(shooter[0]).style.backgroundSize = 'cover';
        document.getElementById(shooted[0]).style.background = `url(assets/img/Sprites/${shooted[2]}Hit.gif) no-repeat`;
        document.getElementById(shooted[0]).style.backgroundSize = 'cover';
        setTimeout(function(){
        document.getElementById(shooter[0]).style.background = `url(assets/img/Sprites/${shooter[2]}Idle.gif) no-repeat`;
        document.getElementById(shooter[0]).style.backgroundSize = 'cover';
        document.getElementById(shooted[0]).style.background = `url(assets/img/Sprites/${shooted[2]}Idle.gif) no-repeat`;
        document.getElementById(shooted[0]).style.backgroundSize = 'cover';
        }, delay-100);
    } else {
        Death.volume = 0.3;
        Death.play();
        document.getElementById(shooter[0]).style.background = `url(assets/img/Sprites/${shooter[2]}Attack.gif) no-repeat`;
        document.getElementById(shooter[0]).style.backgroundSize = 'cover';
        document.getElementById(shooted[0]).style.background = `url(assets/img/Sprites/${shooted[2]}Death.gif) no-repeat`;
        document.getElementById(shooted[0]).style.backgroundSize = 'cover';
        shooted[3]=true;
        setTimeout(function(){
        document.getElementById(shooter[0]).style.background = `url(assets/img/Sprites/${shooter[2]}Idle.gif) no-repeat`;
        document.getElementById(shooter[0]).style.backgroundSize = 'cover';
        document.getElementById(shooted[0]).style.background = `url(assets/img/Sprites/${shooted[2]}Dead.gif) no-repeat`;
        document.getElementById(shooted[0]).style.backgroundSize = 'cover';
        }, delay-20);
    }
    let attackSound = new Audio(`./assets/sound/${shooter[2]}.mp3`);
    attackSound.volume = 0.1;
    attackSound.play();
    document.getElementById(shooted[0]).children[3].classList.toggle('hidden');
    document.getElementById(shooted[0]).children[3].innerHTML = dmg;
    setTimeout(function(){document.getElementById(shooted[0]).children[3].classList.toggle('hidden');}, delay-100);
    document.getElementById(shooted[0]).children[1].children[0].innerHTML = remainingHp;
    document.getElementById(shooted[0]).children[0].children[0].style.width = `${(remainingHp/shootedMaxHp).toFixed(2)*100}%`;
    console.log(shooter);
    console.log(shooted);
}

function victory(array) {
    for (element of array) {
        if (!element[3]) {
            document.getElementById(element[0]).style.background = `url(assets/img/Sprites/${element[2]}Win.gif) no-repeat`;
            document.getElementById(element[0]).style.backgroundSize = 'cover';
        } else {
            document.getElementById(element[0]).style.background = `url(assets/img/Sprites/${element[2]}Dead.gif) no-repeat`;
            document.getElementById(element[0]).style.backgroundSize = 'cover';
        }
        
    }
}

function quickMode() {
    delay = 300;
    fetchDataDelay();
}

function fetchDataDelay() {
    let fight;
    document.getElementById('goMatch').classList.toggle('hidden');
    document.getElementById('QuickBtn').classList.toggle('hidden');
    fetch('./assets/json/results.json')
        .then(response => {
            if (!response.ok) {
                throw Error('ERROR');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            for (let i = 0; i < data.length-1; i++) {
                (function(i) {
                    setTimeout(function() { 
                        displayTurn(data[i].tour,data[i].hit,data[i].playerStatus);
                        attack(data[i].attacker,data[i].attacked,data[i].deathblow,data[i].crit,data[i].remainingHP,data[i].dmgDealt);
                    }, delay * i);
                })(i);
            }
            document.getElementById('turnCount').value = data[data.length-1].totalTurn;
            document.getElementById('team1').value = data[data.length-1][0];
            document.getElementById('team2').value = data[data.length-1][1];
            document.getElementById('winner').value = data[data.length-1].winner;
            if (data[data.length-1][0] == data[data.length-1].winner) {
                winnerBard = document.getElementById('bardLeft');
            } else {
                winnerBard = document.getElementById('bardRight');
            }
            setTimeout(function() {
                displayVictory(data[data.length-1].winner);
                SeaAndSeaGulls.pause();
                winTheme.volume = 0.2;
                winTheme.play();
                winnerBard.classList.toggle('hidden');
                console.log('FIN');
                console.log(teams);
                victory(teams);
                document.getElementById('reloadGame').classList.toggle('hidden');
                document.getElementById('disparou').classList.toggle('hidden')
            },(data.length-1)*delay);
        })
        .catch(error => {
            console.log(error);
        });
}

document.querySelector('#reloadGame').addEventListener("click", function(event) {
  event.preventDefault();}, 
  false);
</script>
</body>

</html>