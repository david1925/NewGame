<?php

require_once "../src/model/User.class.php";
require_once "../src/model/persist/db.php";


class UserDAO {
    private $dbConnect;
    
    public function __construct() {
        $this->dbConnect = new db;
    }    

    public function getAll() {
        $response = array();
        $sql = "SELECT * FROM Users ORDER BY Users.users_username";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->fetchAll();
    }

    public function getUser($user="") {
        $response = array($user->getUserId());
        $sql = "SELECT * FROM Users WHERE Users.users_id_user = ?";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->fetchAll();
    }

    public function checkLogin($user) {
        $response = array(
            $user->getUsername(), 
            $user->getPassword()
        );
        
        $sql = "SELECT Users.users_address,
                       Users.users_email,
                       Users.users_firstname,
                       Users.users_id_user,
                       Users.users_image,
                       Users.users_language,
                       Users.users_lastname,
                       Users.users_name,
                       Users.users_phone,
                       Users.users_public_profile,
                       Users.users_status,
                       Users.users_summary,
                       Users.users_username 
                FROM Users 
                WHERE Users.users_username = ? AND Users.users_password = md5(?) AND Users.users_status=1";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->fetchAll();
    }

    public function updateUserStatus($User) {
        $response = array($User->getUserId());
        $sql = "UPDATE Users SET Users.users_status=1 WHERE Users.users_id_user=?";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->rowCount();
    }
}

?>