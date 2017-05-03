<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Get genre id, name
$app->get('/genres', function(Request $request, Response $response){
    $sql = "SELECT Genders.genders_id_gender, Genders.genders_name FROM Genders ORDER BY Genders.genders_name";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $games = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($games);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

?>