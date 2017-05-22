<?php

require_once "../src/model/Game.class.php";
require_once "../src/model/User.class.php";
require_once "../src/model/Forum.class.php";
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
    
    
}
?>