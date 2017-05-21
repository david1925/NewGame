<?php
    class Chat {
      
        //PROPERTIES
        var $chatId;
        var $text;
        var $dateTime;
        var $userSendId;
        var $userReceiveId;
        var $image;

        //CONSTRUCT
        function __construct($chatId, $text, $dateTime, $userSendId, $userReceiveId, $image) {
          $this->chatId = $chatId;
          $this->text = $text;
          $this->dateTime = $dateTime;
          $this->userSendId = $userSendId;
          $this->userReceiveId = $userReceiveId;
          $this->image = $image;
        }

        //GETTERS
        function getChatId() {return $this->chatId;}
        function getText() {return $this->text;}
        function getDateTime() {return $this->dateTime;}
        function getUserSendId() {return $this->userSendId;}
        function getUserReceiveId() {return $this->userReceiveId;}
        function getImage() {return $this->image;}

        //SETTERS
        function setChatId($chatId) {$this->chatId = $chatId;}
        function setText($text) {$this->text = $text;}
        function setDateTime($dateTime) {$this->dateTime = $dateTime;}
        function setUserSendId($userSendId) {$this->userSendId = $userSendId;}
        function setUserReceiveId($userReceiveId) {$this->userReceiveId = $userReceiveId;}
        function setImage($image) {$this->image = $image;}
    } 
?>