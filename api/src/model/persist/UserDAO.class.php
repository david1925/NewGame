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
        
        $sql = "SELECT Users.users_address, Users.users_email, Users.users_firstname, Users.users_id_user,
                       Users.users_image, Users.users_language, Users.users_lastname, Users.users_name, Users.users_phone, 
                       Users.users_public_profile, Users.users_status, Users.users_summary, Users.users_username 
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

    public function getUserGames($User) {
        $response = array($User->getUserId());
        $sql = "SELECT Games.games_id_game, 
                       Games.games_name,
                       Games.games_description,
                       Games.games_price,
                       Games.games_publication_date,
                       Games.games_url_image,
                       Games.games_rating,
                       Genders_genders_id_gender
                FROM Users
                INNER JOIN Libraries ON Libraries.Users_users_id_user = Users.users_id_user
                INNER JOIN Games_Libraries ON Games_Libraries.Libraries_libraries_id_library = Libraries.libraries_id_library
                INNER JOIN Games ON Games.games_id_game=Games_libraries.Games_games_id_game
                WHERE Users.users_id_user = ?";    
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->fetchAll(PDO::FETCH_ASSOC);    
    }

    public function sendFriendshipSolicitation($User) {
        $response = array($User->getUsername());
        $sql = "SELECT Users.users_id_user,Users.users_username FROM Users WHERE Users.users_username=?";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertFriendshipSolicitation($User, $User2) {
        $response = array($User->getUsername(),$User2->getUsername());
        $sql = "INSERT INTO Friendship_Solicitations (Friendship_Solicitations.Users_users_id_send,Friendship_Solicitations.Users_users_id_receive,Friendship_Solicitations.friendship_solicitations_status) VALUES (?,?,0);";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->rowCount();
    }

    public function friendshipSolicitationPending($User) {
        $response = array($User->getUserId());
        $sql = "SELECT Users.users_username,Users.users_id_user FROM Friendship_Solicitations
                INNER JOIN Users ON Users.users_id_user=Friendship_Solicitations.Users_users_id_send
                INNER JOIN Users u ON u.users_id_user=Friendship_Solicitations.Users_users_id_receive
                WHERE Friendship_Solicitations.Users_users_id_receive=? AND Friendship_Solicitations.friendship_solicitations_status=0;";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateFriendshipSolicitation($User, $User2) {
        $response = array($User->getUserId(),$User2->getUserId());
        var_dump($response);
        $sql = "UPDATE Friendship_Solicitations
                SET Friendship_Solicitations.friendship_solicitations_status=1
                WHERE Friendship_Solicitations.Users_users_id_send=? AND Friendship_Solicitations.Users_users_id_receive=?;";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->rowCount();
    }
    public function deleteFriendshipSolicitation($User, $User2) {
        $response = array($User->getUserId(),$User2->getUserId());
        var_dump($response);
        $sql = "DELETE FROM Friendship_Solicitations WHERE Friendship_Solicitations.Users_users_id_send=? AND Friendship_Solicitations.Users_users_id_receive=?;";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->rowCount();
    }

    public function getPublicProfile($User) {
        $response = array($User->getUserId());
        $sql = "SELECT Users.users_public_profile FROM Users WHERE Users.users_id_user=?;";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertUserWallMessage($User, $User2, $message) {
        $response = array($User->getUserId(),$message,$User2->getUserId());
        $sql = "INSERT INTO Messages (walls_walls_id_wall,messages_text,Users_users_id_user) VALUES(?,?,?);";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->rowCount();
    }

}

?>