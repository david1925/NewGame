<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


require_once "../src/model/Forum.class.php";
require_once "../src/model/User.class.php";
require_once "../src/model/Game.class.php";
require_once "../src/model/Topic.class.php";
require_once "../src/model/Replie.class.php";
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
    try{
        $forum = new Game($id,"","","","","","","");    
        $result = "";
        $helper = new ForumDAO();
        $result = $helper->getTopicsMessagesFromGame($forum);    
        echo json_encode($result);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app->post('/forums/topics/add/', function(Request $request, Response $response){
    $topicTitle = $request->getParam("title");
    $topicText = $request->getParam("text");
    $idForum = $request->getParam("idForum");
    $userId = $request->getParam("userId");
    try{
    	$topic = new Topic("",$topicTitle,$topicText,"",$idForum,$userId);
        $result = "";
        $helper = new ForumDAO();
        $result = $helper->addTopic($topic);
        echo json_encode($result);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app->post('/forums/topics/messages/add/', function(Request $request, Response $response){
    $answerText = $request->getParam("text");
    $idTopic = $request->getParam("idTopic");
    $idForum = $request->getParam("idForum");
    $userId = $request->getParam("userId");
    try{
    	$replie = new Replie("",$answerText,"",$idTopic,$idForum,$userId);
        $result = "";
        $helper = new ForumDAO();
        $result = $helper->addTopicMessage($replie);
        echo json_encode($result);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});