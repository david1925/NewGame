<?php

require_once "../src/model/Game.class.php";
//require_once "../src/model/Review.class.php";
require_once "../src/model/persist/db.php";


class GameDAO {
    //put your code here
    private $dbConnect;
    
    public function __construct() {
        $this->dbConnect = new db;
    }    
    
    public function getImage($Game) {
        $response = array($Game->getGameId());
        $sql = "SELECT Games.games_url_image,Games.games_name FROM Users
                                INNER JOIN Libraries ON Libraries.Users_users_id_user=Users.users_id_user
                                INNER JOIN Games_Libraries ON Games_Libraries.Libraries_libraries_id_library=Libraries.libraries_id_library
                                INNER JOIN Games ON Games.games_id_game = Games_Libraries.Games_games_id_game
                                WHERE Users.users_id_user=? ORDER BY Games.games_name";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getShop() {
        $response = array();
        $sql = "SELECT Games.games_id_game, Games.games_name, Games.games_price, Games.games_url_image, Games.games_rating, Games.Genders_genders_id_gender FROM Games ORDER BY Games.games_name";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll() {
        $response = array();
        $sql = "SELECT Games.games_id_game,Games.games_url_image,Games.games_name,Games.games_price,Games.games_rating FROM Games ORDER BY Games.games_name";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->fetchAll(PDO::FETCH_ASSOC);
    }    


    public function getFeatured() {
        $response = array();
        $sql = "SELECT Games.games_id_game,Games.games_url_image,Games.games_name,Games.games_description FROM Games ORDER BY Games.games_rating DESC LIMIT 4";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPublicationDate() {
        $response = array();
        $sql = "SELECT Games.games_id_game,Games.games_url_image,Games.games_name,Games.games_description FROM Games ORDER BY Games.games_publication_date DESC LIMIT 4";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->fetchAll(PDO::FETCH_ASSOC);
    }     


    public function getGame($Game) {
        $response = array($Game->getGameId());
        $sql = "SELECT Games.games_id_game,Games.games_name,Games.games_description,Games.games_price,Games.games_publication_date,Games.games_url_image,
            Reviews.reviews_text,Reviews.reviews_rating,date_format(Reviews.reviews_datetime,'%H:%i %d/%m') as 'review_datetime', Users.users_id_user,
            Users.users_username,Game_Requirements.games_requirements_os_min,Game_Requirements.games_requirements_processor_min,
            Game_Requirements.games_requirements_memory_min,Game_Requirements.games_requirements_hd_min,
            Game_Requirements.games_requirements_video_card_min,Game_Requirements.games_requirements_directx_min,
            Game_Requirements.games_requirements_os_rec,Game_Requirements.games_requirements_processor_rec,
            Game_Requirements.games_requirements_memory_rec,Game_Requirements.games_requirements_hd_rec,
            Game_Requirements.games_requirements_video_card_rec,Game_Requirements.games_requirements_directx_rec
            FROM Games 
            LEFT JOIN Reviews ON Reviews.Games_games_id_game=Games.games_id_game
            LEFT JOIN Users ON Users.users_id_user=Reviews.Users_users_id_user
            INNER JOIN Genders ON Genders.genders_id_gender=Games.Genders_genders_id_gender
            INNER JOIN Game_Requirements ON Game_Requirements.Games_games_id_game=Games.games_id_game
            WHERE Games.games_id_game=?";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->fetchAll(PDO::FETCH_ASSOC);
    }


    public function addReview($Review) {
        $response = array($Review->getText(),$Review->getRating(),$Review->getGameId(),$Review->getUserId());
        $sql = "INSERT INTO Reviews (reviews_text,reviews_rating,Games_games_id_game,Users_users_id_user) VALUES (?,?,?,?)";
        $response = $this->dbConnect->execution($sql, $response);
        return $response->rowCount();
    }

    public function getReviews($Game) {
        $response = array($Game->getGameId());
        $sql = "SELECT Reviews.reviews_text,Users.users_username,date_format(Reviews.reviews_datetime,'%H:%i %d/%m') as 'review_datetime' FROM Games
                INNER JOIN Reviews ON Reviews.Games_games_id_game=Games.games_id_game
                INNER JOIN Users ON Users.users_id_user=Reviews.Users_users_id_user
                WHERE Games.games_id_game=?";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getShoppingCart($Game) {
        $response = array($Game->getGameId());
        $sql = "SELECT Games.games_id_game, Games.games_name, Games.games_price, Games.games_url_image FROM Games
                WHERE Games.games_id_game=?";
        $response = $this->dbConnect->selectQuery($sql, $response);
        return $response->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
