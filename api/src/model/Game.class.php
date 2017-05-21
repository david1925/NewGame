<?php
    class Game {
     
        //PROPERTIES
        var $gameId;
        var $name;
        var $description;
        var $price;
        var $publicationDate;
        var $urlImage;
        var $rating;
        var $genderId;
        
        //CONSTRUCT
        function __construct($gameId, $name, $description, $price, $publicationDate, $urlImage, $rating, $genderId) {
            $this->gameId = $gameId;
            $this->name = $name;
            $this->description = $description;
            $this->price = $price;
            $this->publicationDate = $publicationDate;
            $this->urlImage = $urlImage;
            $this->rating = $rating;
            $this->genderId = $genderId;
        }

        //GETTERS        
        function getGameId() {return $this->gameId;}
        function getName() {return $this->name;}
        function getDescription() {return $this->description;}
        function getPrice() {return $this->price;}
        function getPublicationDate() {return $this->publicationDate;}
        function getUrlImage() {return $this->urlImage;}
        function getRating() {return $this->rating;}
        function getGenderId() {return $this->genderId;}

        //SETTERS
        function setGameId($gameId) {$this->gameId = $gameId;}
        function setName($name) {$this->name = $name;}
        function setDescription($description) {$this->description = $description;}
        function setPrice($price) {$this->price = $price;}
        function setPublicationDate($publicationDate) {$this->publicationDate = $publicationDate;}
        function setUrlImage($urlImage) {$this->urlImage = $urlImage;}
        function setRating($rating) {$this->rating = $rating;}
        function setGenderId($genderId) {$this->genderId = $genderId;}
    }
?>