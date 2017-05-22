<?php
    class Forum {
      
        //PROPERTIES
        var $forumId;
        var $title;
        var $createdDate;
        var $gameId;

        //CONSTRUCT
        function __construct($forumId, $title, $createdDate, $gameId) {
          $this->forumId = $forumId;
          $this->title = $title;
          $this->createdDate = $createdDate;
          $this->gameId = $gameId;
        }

        //GETTERS
        function getForumId() {return $this->forumId;}
        function getTitle() {return $this->title;}
        function getCreatedDate() {return $this->createdDate;}
        function getGameId() {return $this->gameId;}

        //SETTERS
        function setForumId($forumId) {$this->forumId = $forumId;}
        function setTitle($title) {$this->title = $title;}
        function setCreatedDate($createdDate) {$this->createdDate = $createdDate;}
        function setGameId($gameId) {$this->gameId = $gameId;}
    }
?>