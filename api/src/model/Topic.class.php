<?php
    class Topic {
      
        //PROPERTIES
        private $topicId;
        private $title;
        private $text;
        private $createdDate;
        private $forumId;
        private $userId;

        //CONSTRUCT
        function __construct($topicId, $title, $text, $createdDate, $forumId, $userId) {
          $this->topicId = $topicId;
          $this->title = $title;
          $this->text = $text;
          $this->createdDate = $createdDate;
          $this->forumId = $forumId;
          $this->userId = $userId;
        }

        //GETTERS
        function getTopicId() {return $this->topicId;}
        function getTitle() {return $this->title;}
        function getText() {return $this->text;}
        function getCreatedDate() {return $this->createdDate;}
        function getForumId() {return $this->forumId;}
        function getUserId() {return $this->userId;}

        //SETTERS
        function setTopicId($topicId) {$this->topicId = $topicId;}
        function setTitle($title) {$this->title = $title;}
        function setText($text) {$this->text = $text;}
        function setCreatedDate($createdDate) {$this->createdDate = $createdDate;}
        function setForumId($forumId) {$this->forumId = $forumId;}
        function setUserId($userId) {$this->userId = $userId;}
    }
?>