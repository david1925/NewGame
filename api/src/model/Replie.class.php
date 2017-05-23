<?php
    class Replie {
      
        //PROPERTIES
        private $repliedId;
        private $text;
        private $createdDate;
        private $topicId;
        private $forumId;
        private $userId;

        //CONSTRUCT
        function __construct($repliedId, $text, $createdDate, $topicId, $forumId, $userId) {
          $this->repliedId = $repliedId;
          $this->text = $text;
          $this->createdDate = $createdDate;
          $this->topicId = $topicId;
          $this->forumId = $forumId;
          $this->userId = $userId;
        }

        //GETTERS
        function getReplieId() {return $this->repliedId;}
        function getText() {return $this->text;}
        function getCreatedDate() {return $this->createdDate;}
        function getTopicId() {return $this->topicId;}
        function getForumId() {return $this->forumId;}
        function getUserId() {return $this->userId;}

        //SETTERS
        function setReplieId($repliedId) {$this->repliedId = $repliedId;}        
        function setText($text) {$this->text = $text;}
        function setCreatedDate($createdDate) {$this->createdDate = $createdDate;}
        function setTopicId($topicId) {$this->topicId = $topicId;}
        function setForumId($forumId) {$this->forumId = $forumId;}
        function setUserId($userId) {$this->userId = $userId;}
    }
?>