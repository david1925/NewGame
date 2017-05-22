<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


require_once "../src/model/Forum.class.php";
require_once "../src/model/User.class.php";
require_once "../src/model/Game.class.php";
require_once "../src/model/persist/ForumDAO.class.php";

// Get all forums names
$app->get('/forums', function(Request $request, Response $response){
     try{        
        $result = "";
        $helper = new ForumDAO();
        $result = $helper->getForums();    
        echo json_encode($result);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get all topics per forum
$app->get('/forums/topics/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    try{
        $forum = new Forum($id,"","","");    
        $result = "";
        $helper = new ForumDAO();
        $result = $helper->getTopicFromForum($forum);    
        echo json_encode($result);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get topics from forum
$app->get('/forums/topics/game/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
        try{
        $forum = new Game($id,"","","","","","","");    
        $result = "";
        $helper = new ForumDAO();
        $result = $helper->getTopicsFromGame($forum);    
        echo json_encode($result);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get topics messages from forum
$app->get('/forums/topics/messages/game/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    $sql = "SELECT Games.games_name,Topics.topics_title,Replies.replies_text,Users.users_username,date_format(Replies.replies_created_date,'%H:%i %d/%m') as 'replies_datetime',Topics.topics_id_topic FROM Games
            INNER JOIN Forums ON Forums.Games_games_id_game=Games.games_id_game
            INNER JOIN Topics ON Topics.Forums_forums_id_forum=Forums.forums_id_forum
            INNER JOIN Replies ON Replies.Topics_topics_id_topic=Topics.topics_id_topic
            INNER JOIN Users ON Users.users_id_user = Replies.Users_users_id_user
            WHERE Topics.topics_id_topic=:id";
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

$app->post('/forums/topics/add/', function(Request $request, Response $response){
    $topicTitle = $request->getParam("title");
    $topicText = $request->getParam("text");
    $idForum = $request->getParam("idForum");
    $userId = $request->getParam("userId");
    $sql = "INSERT INTO Topics (topics_title,topics_text,Forums_forums_id_forum,Users_users_id_user) VALUES (:topicTitle, :topicText, :idForum, :userId)";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":topicTitle", $topicTitle);
        $stmt->bindParam(":topicText", $topicText);
        $stmt->bindParam(":idForum", $idForum);
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        $db = null;
        echo json_encode(true);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app->post('/forums/topics/messages/add/', function(Request $request, Response $response){
    $answerText = $request->getParam("text");
    $idTopic = $request->getParam("idTopic");
    $idForum = $request->getParam("idForum");
    $idUser = $request->getParam("userId");
    $sql = "INSERT INTO Replies (replies_text,Topics_topics_id_topic,Topics_Forums_forums_id_forum,Users_users_id_user) VALUES (:message,:idTopic,:idForum,:idUser);";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":message", $answerText);
        $stmt->bindParam(":idTopic", $idTopic);
        $stmt->bindParam(":idForum", $idForum);
        $stmt->bindParam(":idUser", $idUser);
        $stmt->execute();
        $db = null;
        echo json_encode(true);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});