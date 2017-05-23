<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


require_once "../src/model/Chat.class.php";
require_once "../src/model/User.class.php";
require_once "../src/model/persist/ChatDAO.class.php";

// Get the conversation between two users
$app->post('/chat', function(Request $request, Response $response){
    $idUser = $request->getParam("idUser");
    $idFriend = $request->getParam("idFriend");
   try{
        $user = new User($idUser,"","","","","","","","","","","","","","");
        $friend = new User($idFriend,"","","","","","","","","","","","","","");
        $result = "";
        $helper = new ChatDAO();
        $result = $helper->getChat($user, $friend);
        echo json_encode($result);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Insert the message sent by a user and show all the messages
$app->post('/chat/message', function(Request $request, Response $response){
    $userId = $request->getParam("userId");
    $friendId = $request->getParam("friendId");
    $message = $request->getParam("message");

    $sql = "INSERT INTO Chats(chats_text, Users_users_id_user_send, Users_users_id_user_receive, chats_datetime) VALUES(:message, :userId, :friendId, '2005-02-02')";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":message", $message);
        $stmt->bindParam(":userId", $userId);
        $stmt->bindParam(":friendId", $friendId);
        $stmt->execute();    
        
        $sql = "SELECT Users_users_id_user_send, chats_text 
            FROM Chats 
            WHERE Users_users_id_user_send = :userId AND Users_users_id_user_receive = :friendId 
               OR Users_users_id_user_send = :friendId AND Users_users_id_user_receive = :userId
            ORDER BY chats_id_chat DESC
            LIMIT 15";
        try{
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":userId", $userId);
            $stmt->bindParam(":friendId", $friendId);
            $stmt->execute();
            $chat = $stmt->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($chat);
            $db = null;            
        } catch(PDOException $e){
            echo '{"error": {"text": '.$e->getMessage().'}}';
        }
        $db = null;
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

