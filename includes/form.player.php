<?php

include_once 'db_connect.php';
include_once 'classes.php';
include_once 'manager.php';

?>

<form id="formPlayer" action="" method="POST">

    <div class="text_form">
    <p>
        <label>Nom du joueur : </label>
        <input id="playerNameForm" data-class="" type="text" name="name" placeholder="Insérez votre nom">
        <select onchange="updateName(this)" id="selectName">
            <option value="">Joueurs...</option>
                <?php
                    foreach($playerList as $player) {?> 
                        <option data-class="<?php echo $player['class']?>" value="<?php echo $player['name']?>"><?php echo $player['name'] ?></option>
                <?php } ?>
        </select>
    </p>
    <p>
        <label for="class">Choisissez votre classe :</label>
        <select name="playerClassId" id="class">
            <option hidden> --- </option>
            <?php
                foreach($classList as $class) {?> 
                    <option value="<?php echo $class['id'] ?>"><?php echo $class['name'] ?></option>
            <?php } ?>
        </select>
    </p>
    </div>
    <input type="submit" name="submit_creation" onclick=emptyfield() value="Enregistrer" class="add"></input>
    <input type="submit" name="deletePlayer" onclick=emptyfield() value="Supprimer" class="add"></input>
</form>




