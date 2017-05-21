<?php
    class Gender {
    
        //PROPERTIES
        var $genderId;
        var $name;
        
        //CONSTRUCT
        function __construct($genderId, $name) {
            $this->genderId = $genderId;
            $this->name = $name;
        }

        //GETTERS
        function getGenderId() {return $this->genderId;}
        function getName() {return $this->name;}

        //SETTERS
        function setGenderId($genderId) {$this->genderId = $genderId;}
        function setName($name) {$this->name = $name;}    
    }
?>