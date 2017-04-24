<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


// Get all forums names
$app->get('/forums', function(Request $request, Response $response){
    $sql = "SELECT Forums.forums_title FROM Forums INNER JOIN Topics ON Topics.Forums_forums_id_forum=Forums.forums_id_forum
            INNER JOIN Games ON Games.games_id_game=Forums.Games_games_id_game
            ORDER BY Games.games_name";
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

