<?php
include_once 'includes/classes.php';
include_once 'includes/fonction.php';
include_once 'includes/db_connect.php';
include_once 'includes/manager.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=stylesheet href="assets/css/index.css" type="text/css"/>
    <title>History</title>
</head>
<body>
    <div class="container">
        <h1 class="htitle">HISTORIQUE :</h1>
        <div id="history">
            
        <?php
            foreach($history as $fight) { ?>
            <h1 class="hcenter"><?php echo sprintf('<span class="team1">%s</span> <span class="vs">VS</span> <span class="team2">%s</span>',$fight['team1'],$fight['team2']);?></h1>
            <div id="oui">
                <span class="hwinner">
                    <p><?php echo 'Winner : '. $fight['winner'] ?></p>
                </span>
                <span class="hdate">
                    <p><?php echo 'Date : '.$fight['date'] ?></p>
                </span>
            </div>
        <?php } ?>
        </div>
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
    </div>
</body>
</html>