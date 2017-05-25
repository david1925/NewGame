<?php

require_once "../src/model/Game.class.php";
require_once "../src/model/User.class.php";
require_once "../src/model/Forum.class.php";
require_once "../src/model/Topic.class.php";
require_once "../src/model/Replie.class.php";
require_once "../src/model/persist/db.php";


class ForumDAO {
    //put your code here
    private $dbConnect;
    
    public function __construct() {
        $this->dbConnect = new db;
    }    
    
    public function getForums() {
        $response = array();
        $sql = "SELECT Games.games_id_game,Games.games_name FROM Games
                INNER JOIN Forums ON Forums.Games_games_id_game=Games.games_id_game";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->fetchAll();
    }

    public function getTopicFromForum($Forum) {
        print_r($Forum);
        $response = array($Forum->getForumId());
        $sql = "SELECT COUNT(*) AS Topics FROM Games
            INNER JOIN Forums ON Forums.Games_games_id_game = Games.games_id_game
            INNER JOIN Topics ON Topics.Forums_forums_id_forum = Forums.forums_id_forum
            WHERE Games.games_id_game=?";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->fetchAll();
    }


    public function getTopicsFromGame($Game) {
        $response = array($Game->getGameId());
        $sql = "SELECT Games.games_name,Topics.topics_id_topic,Topics.topics_title,Forums.forums_id_forum FROM Games
                INNER JOIN Forums ON Forums.Games_games_id_game = Games.games_id_game
                INNER JOIN Topics ON Topics.Forums_forums_id_forum = Forums.forums_id_forum
                WHERE Games.games_id_game=?";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->fetchAll();
    }
    

    public function getTopicsMessagesFromGame($Game) {
        $response = array($Game->getGameId());
        $sql = "SELECT Games.games_name,Topics.topics_title,Replies.replies_text,Users.users_id_user,Users.users_username,date_format(Replies.replies_created_date,'%H:%i %d/%m') as 'replies_datetime',Topics.topics_id_topic FROM Games
            INNER JOIN Forums ON Forums.Games_games_id_game=Games.games_id_game
            INNER JOIN Topics ON Topics.Forums_forums_id_forum=Forums.forums_id_forum
            INNER JOIN Replies ON Replies.Topics_topics_id_topic=Topics.topics_id_topic
            INNER JOIN Users ON Users.users_id_user = Replies.Users_users_id_user
            WHERE Topics.topics_id_topic=?";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->fetchAll();
    }
    

    public function addTopic($Topic) {
        $response = array($Topic->getTitle(),$Topic->getText(),$Topic->getForumId(),$Topic->getUserId());
        $sql = "INSERT INTO Topics (topics_title,topics_text,Forums_forums_id_forum,Users_users_id_user) VALUES (?,?,?,?)";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->rowCount();
    }

    public function addTopicMessage($Replie) {
        $response = array($Replie->getText(),$Replie->getTopicId(),$Replie->getForumId(),$Replie->getUserId());
        $sql = "INSERT INTO Replies (replies_text,Topics_topics_id_topic,Topics_Forums_forums_id_forum,Users_users_id_user) VALUES (?,?,?,?)";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->rowCount();
    }
}
?>