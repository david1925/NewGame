<?php

require_once "../src/model/Game.class.php";
require_once "../src/model/User.class.php";
require_once "../src/model/persist/db.php";


class ChatDAO {
    //put your code here
    private $dbConnect;
    
    public function __construct() {
        $this->dbConnect = new db;
    }    
    
    public function getChat($User, $Friend) {
        $response = array($User->getUserId(),$Friend->getUserId(),$Friend->getUserId(),$User->getUserId());
        $sql = "SELECT Users_users_id_user_send, chats_text 
                FROM Chats 
                WHERE Users_users_id_user_send = ? AND Users_users_id_user_receive = ? 
                OR Users_users_id_user_send = ? AND Users_users_id_user_receive = ?
                ORDER BY chats_id_chat DESC
                LIMIT 15";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->fetchAll();
    }

    
    
}
