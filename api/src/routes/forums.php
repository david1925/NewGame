<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


// Get all forums names
$app->get('/forums', function(Request $request, Response $response){
    $sql = "SELECT Games.games_id_game,Games.games_name FROM Games
            INNER JOIN Forums ON Forums.Games_games_id_game=Games.games_id_game";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $forums = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($forums);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get all topics per forum
$app->get('/forums/topics/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    $sql = "SELECT COUNT(*) AS Topics FROM Games
            INNER JOIN Forums ON Forums.Games_games_id_game = Games.games_id_game
            INNER JOIN Topics ON Topics.Forums_forums_id_forum = Forums.forums_id_forum
            WHERE Games.games_id_game=:id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $forums = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($forums);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});