<?php 
    class Player {
        //attributes
        private $first_name;
        private $health;
        private $maxHealth;
        private $strength;
        private $crit = 2;
        private $level;

        public function __construct(string $firstname,int $health, int $maxHealth, int $strength,int $level) {
            $this -> setFirstname($firstname);
            $this -> setHealth($health);
            $this -> setMaxHealth($maxHealth);
            $this -> setStrength($strength);
            $this -> setLevel($level);
        }

        //getters
        public function getFirstname() {
            return $this->first_name;
        }
        public function getHealth(){
            return $this->health;
        }
        public function getStrength(){
            return $this->strength;
        }
        public function getCrit(){
            return $this->crit;
        }
        public function getLevel(){
            return $this->level;
        }
        public function getMaxHealth(){
            return $this->maxHealth;
        }

        public function rekt() {
            return $this->strength*$this->crit;
        }

        //setters
        public function setFirstname($firstname) {
            $this -> first_name = htmlspecialchars($firstname);
        }
        public function setHealth($health) {
            $this -> health = htmlspecialchars($health);
        }
        public function setStrength($strength) {
            $this -> strength = htmlspecialchars($strength);
        }
        public function setLevel($level) {
            $this -> level = htmlspecialchars($level);
        }
        public function setMaxHealth($maxHealth) {
            $this -> maxHealth = htmlspecialchars($maxHealth);
        }

        //methods

        public function hit($target) {
            $crit=rand(0,7);
            if($crit==7) {
                $target->setHealth($target->getHealth()-$this->rekt());
                return true;
            }
            $target->setHealth($target->getHealth()-$this->strength);
            return false; 
        }

        public function isDead() {
            return $this->getHealth()<=0;
        }
    }
?>