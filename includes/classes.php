<?php 

include_once 'db_connect.php';
include_once 'player.class.php';

class Captain extends Player {
    private $healthGrowth = 15;
    private $strengthGrowth = 5;

    public function getHealthGrowth() {
        return $this->healthGrowth;
    }
    public function getStrengthGrowth() {
        return $this->strengthGrowth;
    }

    public function setHealthGrowth($healthGrowth) {
        $this -> healthGrowth = htmlspecialchars($healthGrowth);
    }
    public function setStrengthGrowth($strengthGrowth) {
        $this -> strengthGrowth = htmlspecialchars($strengthGrowth);
    }
}
class Gunner extends Player {
    private $healthGrowth = 10;
    private $strengthGrowth = 3;

    public function getHealthGrowth() {
        return $this->healthGrowth;
    }
    public function getStrengthGrowth() {
        return $this->strengthGrowth;
    }

    public function setHealthGrowth($healthGrowth) {
        $this -> healthGrowth = htmlspecialchars($healthGrowth);
    }
    public function setStrengthGrowth($strengthGrowth) {
        $this -> strengthGrowth = htmlspecialchars($strengthGrowth);
    }
}
class Canonneer extends Player {
    private $healthGrowth = 25;
    private $strengthGrowth = 2;

    public function getHealthGrowth() {
        return $this->healthGrowth;
    }
    public function getStrengthGrowth() {
        return $this->strengthGrowth;
    }

    public function setHealthGrowth($healthGrowth) {
        $this -> healthGrowth = htmlspecialchars($healthGrowth);
    }
    public function setStrengthGrowth($strengthGrowth) {
        $this -> strengthGrowth = htmlspecialchars($strengthGrowth);
    }
}
class Peon extends Player {
    private $healthGrowth = 2;
    private $strengthGrowth = 1;

    public function getHealthGrowth() {
        return $this->healthGrowth;
    }
    public function getStrengthGrowth() {
        return $this->strengthGrowth;
    }

    public function setHealthGrowth($healthGrowth) {
        $this -> healthGrowth = htmlspecialchars($healthGrowth);
    }
    public function setStrengthGrowth($strengthGrowth) {
        $this -> strengthGrowth = htmlspecialchars($strengthGrowth);
    }
}
class Manager {
    private $db;
    public function __construct(PDO $bdd) {
        $this->setDb($bdd);
    }
    public function getDb() {
        return $this->db;
    }
    public function setDb($db) {
        return $this->db = $db;
    }

    public function getFightList() {
        $fights = $this->getDb()->query('SELECT * FROM fights ORDER BY date DESC');
        $fightList = $fights->fetchAll(PDO::FETCH_ASSOC);
        return $fightList;
    }
    
    public function getClassList() {
        $class = $this->getDb()->query('SELECT * FROM class');
        $classList = $class->fetchAll(PDO::FETCH_ASSOC);
        return $classList;
    }

    public function getPlayerList() {
        $players = $this->getDb()->query('SELECT * FROM players ORDER BY name ASC');
        $playerList = $players->fetchAll(PDO::FETCH_ASSOC);
        return $playerList;
    }

    public function getShipList() {
        $ships = $this->getDb()->query('SELECT * FROM ships');
        $shipList = $ships->fetchAll(PDO::FETCH_ASSOC);
        return $shipList;
    }

    public function getShipSpritesList() {
        $shipSprites = $this->getDb()->query('SELECT * FROM ship_sprites ORDER BY id DESC');
        $shipSpritesList = $shipSprites->fetchAll(PDO::FETCH_ASSOC);
        return $shipSpritesList;
    }

    public function addNewPlayerToDb(int $classId, string $name) {
        $verifClass=$this->getDb()->prepare('SELECT * FROM class WHERE id=:id');
        $verifClass->execute([
            'id'=>$classId
        ]);
        $chosenClass= $verifClass->fetch(PDO::FETCH_ASSOC);
        if(!empty($chosenClass)){
            if(empty(checkDupePlayerInDb($name))){
                $req=$this->getDb()->prepare('INSERT INTO players (name , class, lvl) VALUES ( :name , :class, :lvl )');
                $req->execute([
                    'name'=>$name,
                    'class'=>$chosenClass['name'],
                    'lvl'=>1
                ]);
            } else {
                $req=$this->getDb()->prepare('UPDATE players SET class= :class WHERE name=:name');
                $req->execute([
                    'class'=>$chosenClass['name'],
                    'name'=>$name
                ]);
            }
        }
    }

    public function removePlayerFromDb(string $name){
        $req=$this->getDb()->prepare('DELETE FROM players WHERE name = :name');
        $req->execute([
            'name'=>$name
        ]);
    }

    public function addNewShipToDb(int $shipId, string $name) {
        $verifShip=$this->getDb()->prepare('SELECT * FROM ship_sprites WHERE id=:id');
        $verifShip->execute([
            'id'=>$shipId
        ]);
        $chosenShip= $verifShip->fetch(PDO::FETCH_ASSOC);
        if(!empty($chosenShip)){
            if(empty(checkDupeShipInDb($name))){
                $req=$this->getDb()->prepare('INSERT INTO ships (name , path) VALUES ( :name , :path)');
                $req->execute([
                    'name'=>$name,
                    'path'=>$chosenShip['path']
                ]);
            } else {
                $req=$this->getDb()->prepare('UPDATE ships SET path= :path WHERE name=:name');
                $req->execute([
                    'name'=>$name,
                    'path'=>$chosenShip['path']
                ]);
            }
        }
    }

    public function removeShipFromDb(string $name){
        $req=$this->getDb()->prepare('DELETE FROM ships WHERE name = :name');
        $req->execute([
            'name'=>$name
        ]);
    }

    public function recordFightInDb($turnCount, $team1, $team2, $winner) {
        $now = new \Datetime('Europe/Berlin');
        $request = $this->getDb()->prepare("INSERT INTO fights(turn_count, team1, team2, winner, date) VALUES (:turn_count, :team1,:team2,:winner,:date)");
        $request->execute([
            'turn_count' => $turnCount,
            'team1' => $team1,
            'team2' => $team2,
            'winner' => $winner,
            'date' => $now->format('Y-m-d H:i:s')

        ]);
    }

    public function getStats(string $className) {
        $req=$this->getDb()->prepare('SELECT hp,hpGrowth,strength,strengthGrowth FROM class WHERE name=:name');
        $req->execute([
            'name'=>$className
        ]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function createPlayer($class, string $name, int $health, int $healthGrowth, int $strength, int $strengthGrowth, int $lvl) {
        $newPlayer = new $class($name, $health+$healthGrowth*($lvl-1), $health+$healthGrowth*($lvl-1), $strength+$strengthGrowth*($lvl-1), $lvl);
        return $newPlayer;
    }
    
    public function addLvlToPlayer(Player $player) {
        $req=$this->getDb()->prepare('UPDATE players SET lvl= :lvl WHERE name= :name');
        $req->execute([
            'name'=>$player->getFirstname(),
            'lvl'=>($player->getLevel())+1
        ]);
    }

    public function fixLvlOfPlayer(Player $player) {
        $req=$this->getDb()->prepare('UPDATE players SET lvl= :lvl WHERE name= :name');
        $req->execute([
            'name'=>$player->getFirstname(),
            'lvl'=>$player->getLevel()
        ]);
    }
    
}
?>