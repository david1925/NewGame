<?php
    class Review {
      
        //PROPERTIES
        private $reviewId;
        private $text;
        private $rating;
        private $gameId;
        private $userId;
        private $dateTime;        

        //CONSTRUCT
        function __construct($reviewId, $text, $rating, $gameId, $userId, $dateTime) {
          $this->reviewId = $reviewId;
          $this->text = $text;
          $this->rating = $rating;
          $this->gameId = $gameId;
          $this->userId = $userId;
          $this->dateTime = $dateTime;
        }

        //GETTERS
        function getReviewId() {return $this->reviewId;}
        function getText() {return $this->text;}
        function getRating() {return $this->rating;}
        function getGameId() {return $this->gameId;}
        function getUserId() {return $this->userId;}
        function getDateTime() {return $this->dateTime;}

        //SETTERS
        function setReviewId($reviewId) {$this->reviewId = $reviewId;}
        function setText($text) {$this->text = $text;}
        function setRating($rating) {$this->rating = $rating;}
        function setGameId($gameId) {$this->gameId = $gameId;}
        function setUserId($userId) {$this->userId = $userId;}
        function setDateTime($dateTime) {$this->dateTime = $dateTime;}
    }
?>