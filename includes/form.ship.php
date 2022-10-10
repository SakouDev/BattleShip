<?php

include_once 'db_connect.php';
include_once 'classes.php';
include_once 'manager.php';

?>

<form id="formShip" action="" method="POST">

    <div class="text_form">
    <p>
        <label>Nom du navire : </label>
        <input id="shipNameForm" data-path="" type="text" name="name" placeholder="Insérez votre nom">
        <select onchange="updateShipName(this)" id="selectShipName" >
            <option value="">Navires...</option>
            <?php
                foreach($shipList as $ship) { ?>
                    <option data-path="<?php echo $ship['path']?>" value="<?php echo $ship['name'] ?>"><?php echo $ship['name'] ?></option>
            <?php } ?>
        </select>
    </p>
    <p>
        <label for="class">Choisissez votre image :</label>
        <select name="shipId" id="classSprite">
            <option hidden> --- </option>
            <?php
                foreach($shipSpriteList as $shipSprite) {?> 
                    <option data-pathhori="<?php echo $shipSprite['path_hori'] ?>" data-path="<?php echo $shipSprite['path'] ?>" value="<?php echo $shipSprite['id'] ?>"><?php echo $shipSprite['name'] ?></option>
            <?php } ?>
        </select>
    </p>
    </div>
    <input type="submit" name="submit_ship_creation" onclick=emptyShipfield() value="Enregistrer" class="add"></input>
    <input type="submit" name="deleteShip" onclick=emptyShipfield() value="Supprimer" class="add"></input>
</form>
