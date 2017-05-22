<?php
    class User {

        //PROPERTIES
        var $userId;
        var $username;
        var $password;
        var $name;
        var $firstname;
        var $lastname;
        var $email;
        var $phone;
        var $image;
        var $summary;
        var $address;
        var $profile;
        var $provinceId;
        var $status;
        var $language;
        
        //CONSTRUCT
        function __construct($userId, $username, $password, $name, $firstname, $lastname, $email, $phone, $image, $summary, $address, $profile, $provinceId, $status, $language) {
            $this->userId = $userId;
            $this->username = $username;
            $this->password = $password;
            $this->name = $name;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->email = $email;
            $this->phone = $phone;
            $this->image = $image;
            $this->summary = $summary;
            $this->address = $address;
            $this->profile = $profile;
            $this->provinceId = $provinceId;
            $this->status = $status;
            $this->language = $language;
        }
        
        //GETTERS
        function getUserId() {return $this->userId;}
        function getUsername() {return $this->username;}
        function getPassword() {return $this->password;}
        function getName() {return $this->name;}
        function getFirstname() {return $this->firstname;}
        function getLastname() {return $this->lastname;}
        function getEmail() {return $this->email;}
        function getPhone() {return $this->phone;}
        function getImage() {return $this->image;}
        function getSummary() {return $this->summary;}
        function getAddress() {return $this->address;}
        function getProfile() {return $this->profile;}
        function getProvinceId() {return $this->provinceId;}
        function getStatus() {return $this->status;}
        function getLanguage() {return $this->language;}
        
        //SETTERS
        function setUserId($userId) {$this->userId = $userId;}
        function setUsername($username) {$this->username = $username;}
        function setPassword($password) {$this->password = $password;}
        function setName($name) {$this->name = $name;}
        function setFirstname($firstname) {$this->firstname = $firstname;}
        function setLastname($lastname) {$this->lastname = $lastname;}
        function setEmail($email) {$this->email = $email;}
        function setPhone($phone) {$this->phone = $phone;}
        function setImage($image) {$this->image = $image;}
        function setSummary($summary) {$this->summary = $summary;}
        function setAddress($address) {$this->address = $address;}
        function setProfile($profile) {$this->profile = $profile;}
        function setProvinceId($provinceId) {$this->provinceId = $provinceId;}
        function setStatus($status) {$this->status = $status;}
        function setLanguage($language) {$this->language = $language;}
    }
?>