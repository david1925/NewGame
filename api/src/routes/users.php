<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


// Get all user
$app->get('/users', function(Request $request, Response $response){
    $sql = "SELECT * FROM Users";
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

// Get Single user
$app->get('/users/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    $sql = "SELECT * FROM Users WHERE users_id_user = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($user);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

//Select the username and email of one user
$app->get('/api/contact/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    $sql = "SELECT users_username, users_email FROM users WHERE users_id_user = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($user);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get username Single user
$app->get('/users/username/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    $sql = "SELECT Users.users_username FROM Users WHERE users_id_user = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($user);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get friends from user
$app->get('/users/friends/{username}', function(Request $request, Response $response){
    $username = $request->getAttribute("username");
    $sql = "SELECT Users.users_username FROM Users INNER JOIN Friends ON Friends.Users_users_id_user = Users.users_id_user WHERE Users.users_username != '".$username."'";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($user);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get user language
$app->get('/users/language/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    $sql = "SELECT Users.users_language FROM Users WHERE Users.users_id_user=".$id."";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($user);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get wall messages from user
$app->get('/users/messages/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    $sql = "SELECT u.users_username,me.messages_text,us.users_username,date_format(me.messages_datetime,'%H:%i %d/%m') as 'messages_datetime' FROM Messages me
			INNER JOIN Walls wa ON wa.walls_id_wall=me.walls_walls_id_wall
			INNER JOIN Users u ON u.users_id_user=wa.Users_users_id_user
			INNER JOIN Users us ON us.users_id_user=me.Users_users_id_user
			WHERE u.users_id_user =".$id."";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($user);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get user image
$app->get('/users/image/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    $sql = "SELECT Users.users_image FROM Users WHERE Users.users_id_user=".$id."";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($user);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Check user login
$app->post('/users/login/', function(Request $request, Response $response){
    $username = $request->getParam("username");
    $password = $request->getParam("password");
    $sql = "SELECT Users.users_address,Users.users_email,Users.users_firstname,Users.users_id_user,
	   		Users.users_image,Users.users_language,Users.users_lastname,Users.users_name,Users.users_phone,
       		Users.users_public_profile,Users.users_status,Users.users_summary,Users.users_username FROM Users WHERE Users.users_username = '".$username."' AND Users.users_password = md5('".$password."')";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if($user==null){
        	echo '{"error": {"text": "Username or password incorrect"}}';
        }else{
        	$_SESSION['user']=$user;
        	echo json_encode($user);	
        }
        
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});