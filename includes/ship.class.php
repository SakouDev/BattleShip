<?php 
    class Ship {
         //attributes
         private $name;
         private $size;
 
         //constructors
         public function __construct($name, $size) {
             $this -> setName($name);
             $this -> setSize($size);
         }
 
         //getters
         public function getName() {
             return $this->name;
         }
         public function getSize(){
             return $this->size;
         }
 
         //setters
         public function setName($name) {
             $this -> name = htmlspecialchars($name);
         }
         public function setSize($size) {
             $this -> size = htmlspecialchars($size);
         }
 
         //methods

    }

?>