<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


// Get games image
$app->get('/games/image/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    $sql = "SELECT Games.games_url_image,Games.games_name FROM Users
                                INNER JOIN Libraries ON Libraries.Users_users_id_user=Users.users_id_user
                                INNER JOIN Games_libraries ON Games_libraries.Libraries_libraries_id_library=Libraries.libraries_id_library
                                INNER JOIN Games ON Games.games_id_game = Games_libraries.Games_games_id_game
                                WHERE Users.users_id_user=".$id."";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($users);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get games id,name and image
$app->get('/games', function(Request $request, Response $response){
    $sql = "SELECT Games.games_id_game,Games.games_url_image,Games.games_name,Games.games_price,Games.games_rating FROM Games";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($users);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});