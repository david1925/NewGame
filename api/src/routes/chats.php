<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


// Get the conversation between two users
$app->post('/chat', function(Request $request, Response $response){
    $idUser = $request->getParam("idUser");
    $idFriend = $request->getParam("idFriend");
    $sql = "SELECT Users_users_id_user_send, chats_text 
            FROM Chats 
            WHERE Users_users_id_user_send = :idUser AND Users_users_id_user_receive = :idFriend 
               OR Users_users_id_user_send = :idFriend AND Users_users_id_user_receive = :idUser
            ORDER BY chats_id_chat ASC
            LIMIT 15";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":idUser", $idUser);
        $stmt->bindParam(":idFriend", $idFriend);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo json_encode($users);
        $db = null;
        
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});