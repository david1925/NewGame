<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once "../src/model/User.class.php";
require_once "../src/model/persist/UserDAO.class.php";


// Get all user
$app->get('/users', function(Request $request, Response $response){
    try{
        $result = "";
        $users = new UserDAO();
        $result = $users->getAll();
        echo json_encode($result);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get Single user
$app->get('/users/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    try {
        $result = "";
        $user = new User($id, "", "", "", "", "", "", "", "", "", "", "", "", "", "");
        $helper = new UserDAO();
        $result = $helper->getUser($user);  
        echo json_encode($result);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

//Select the username and email of one user
$app->get('/users/contact/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    try {
        $result = "";
        $user = new User($id, "", "", "", "", "", "", "", "", "", "", "", "", "", "");
        $helper = new UserDAO();
        $result = $helper->getUser($user);
        $reqUser = [
            "users_username" => $result[0][1],
            "users_email" => $result[0][7],
        ];
        echo json_encode($reqUser);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Contact
$app->post('/users/contact/', function(Request $request, Response $response){
    $username = $request->getParam("username");
    $email = $request->getParam("email");
    $subject = $request->getParam("subject");
    $description = $request->getParam("description");
    include_once "contact_mailing.php";
});

// Get username Single user
$app->get('/users/username/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    try {
        $result = "";
        $user = new User($id, "", "", "", "", "", "", "", "", "", "", "", "", "", "");
        $helper = new UserDAO();
        $result = $helper->getUser($user);
        $reqUser = [
            "users_username" => $result[0][1]
        ];
        echo json_encode($reqUser);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get friends username from user
$app->get('/users/friends/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    $sql = "SELECT u.users_username, u.users_id_user FROM Friends
            INNER JOIN Users ON Users.users_id_user = Friends.Users_users_id_user
            INNER JOIN Users u ON u.users_id_user=Friends.Users_users_id_user1
            WHERE Users.users_id_user=:id
            ORDER BY u.users_username";
    try{
         // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($user);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Edit user info
$app->get('/users/edituserinfo/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    try {
        $result = "";
        $user = new User($id, "", "", "", "", "", "", "", "", "", "", "", "", "", "");
        $helper = new UserDAO();
        $result = $helper->getUser($user);
        $reqUser = [
            "users_name<" => $result[0][3],
            "users_firstname" => $result[0][4],
            "users_lastname" => $result[0][5],
            "users_email" => $result[0][6],
            "users_phone" => $result[0][7],
        ];
        echo json_encode($reqUser);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get user language
$app->get('/users/language/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    try {
        $result = "";
        $user = new User($id, "", "", "", "", "", "", "", "", "", "", "", "", "", "");
        $helper = new UserDAO();
        $result = $helper->getUser($user);
        $reqUser = [
            "users_language" => $result[0][14]
        ];
        echo json_encode($reqUser);
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
    try {
        $result = "";
        $user = new User($id, "", "", "", "", "", "", "", "", "", "", "", "", "", "");
        $helper = new UserDAO();
        $result = $helper->getUser($user);
        $reqUser = [
            "users_image" => $result[0][8]
        ];
        echo json_encode($reqUser);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// CHeck if session started, if not start session
$app->post('/users/login/', function(Request $request, Response $response){
    $username = $request->getParam("username");
    $password = $request->getParam("password");
    try{
        $result = "";
        $user = new User("", $username, $password, "", "", "", "", "", "", "", "", "", "", "", "");
        $helper = new UserDAO();
        $result = $helper->checkLogin($user);
        if($result==null){
        	echo '{"error": {"text": "Username or password incorrect"}}';
        }else{
            session_start();
        	$_SESSION['user']=$result;
        	echo json_encode($result);
        }        
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

// Register a user and sends registration email
$app->post('/users/register/', function(Request $request, Response $response){
    $username = $request->getParam("username");
    $password = $request->getParam("password");
    $email = $request->getParam("email");
    $password = md5($password);
    $sql = "INSERT INTO Users (users_username,users_password,users_email,users_public_profile,users_status,users_language) VALUES (:username, :password, :email, '1','0', 'en')";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $stmt2 = $db->prepare("SELECT Users.users_id_user FROM Users ORDER BY Users.users_id_user DESC LIMIT 1");
        $stmt2->execute();
        $users = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        $db = null;
        $id = $users[0]["users_id_user"];
        include_once "register_mailing.php";
        //header("Location: register_mailing.php?id=".$users[0]["users_id_user"]."&username=".$username."&email=".$email."");          
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

// Activate a user account
$app->get('/users/update/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    try {
        $result = "";
        $user = new User($id, "", "", "", "", "", "", "", "", "", "", "", "", "", "");
        $helper = new UserDAO();
        $result = $helper->updateUserStatus($user);
        echo "User updated succsessfully";
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Activate a user account
$app->get('/users/games/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    try {
        $result = "";
        $user = new User($id, "", "", "", "", "", "", "", "", "", "", "", "", "", "");
        $helper = new UserDAO();
        $result = $helper->getUserGames($user);
        echo json_encode($result);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Destoys a user session
$app->get('/users/logout/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    $sql = "SELECT Users.users_username FROM Users WHERE Users.users_id_user=:id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $db = null;
        session_start();
        print_r($_SESSION['user']);
        session_unset();
        session_destroy();
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

// Check if user is logged
$app->get('/users/login/check', function(Request $request, Response $response){
    session_start();
    if(!isset($_SESSION['user'])){
        echo json_encode(false);
    }else{
        echo json_encode(true);
    }
});

//Get username and id from user (header.js)
$app->post('/users/friendShip', function(Request $request, Response $response){
    $username = $request->getParam("username");
    try{
        $result = "";
        $user = new User("", $username, "", "", "", "", "", "", "", "", "", "", "", "", "");
        $helper = new UserDAO();
        $result = $helper->sendFriendshipSolicitation($user);
        echo json_encode($result);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

//Insert friendship solicitation (header.js)
$app->post('/users/friendShip/insert', function(Request $request, Response $response){
    $user_send = $request->getParam("user_send");
    $user_received = $request->getParam("user_received");
    try{
        $result = "";
        $user = new User("", $user_send, "", "", "", "", "", "", "", "", "", "", "", "", "");
        $user2 = new User("", $user_received, "", "", "", "", "", "", "", "", "", "", "", "", "");
        $helper = new UserDAO();
        $result = $helper->insertFriendshipSolicitation($user, $user2);
        echo json_encode($result);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

//Select all pending friendShip solicitations (header.js)
$app->get('/users/friendShip/pending/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    try{
        $result = "";
        $user = new User($id,"", "", "", "", "", "", "", "", "", "", "", "", "", "");
        $helper = new UserDAO();
        $result = $helper->friendshipSolicitationPending($user);
        echo json_encode($result);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

//update friendship solicitation (header.js)
$app->post('/users/friendShip/update', function(Request $request, Response $response){
    $user_send = $request->getParam("user_send");
    $user_received = $request->getParam("user_received");
    try{
        $result = "";
        $user = new User($user_send, "", "", "", "", "", "", "", "", "", "", "", "", "", "");
        $user2 = new User($user_received, "", "", "", "", "", "", "", "", "", "", "", "", "", "");
        $helper = new UserDAO();
        $result = $helper->updateFriendshipSolicitation($user, $user2);
        echo "Actualizado";
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

//decline friendship solicitation (header.js)
$app->post('/users/friendShip/delete', function(Request $request, Response $response){
    $user_send = $request->getParam("user_send");
    $user_received = $request->getParam("user_received");
    try{
        $result = "";
        $user = new User($user_send, "", "", "", "", "", "", "", "", "", "", "", "", "", "");
        $user2 = new User($user_received, "", "", "", "", "", "", "", "", "", "", "", "", "", "");
        $helper = new UserDAO();
        $result = $helper->deleteFriendshipSolicitation($user, $user2);
        echo "Actualizado";
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

//Select all pending friendShip solicitations (header.js)
$app->get('/users/publicProfile/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    try{
        $result = "";
        $user = new User($id,"", "", "", "", "", "", "", "", "", "", "", "", "", "");
        $helper = new UserDAO();
        $result = $helper->getPublicProfile($user);
        echo json_encode($result);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

//Insert message in wall
$app->post('/users/wall/add', function(Request $request, Response $response){
    $userId = $request->getParam("userId");
    $wallId = $request->getParam("wallId");
    $message = $request->getParam("message");
    echo $userId;
    echo "<br/>";
    echo $wallId;
    try{
        $result = "";        
        $user = new User($wallId, "", "", "", "", "", "", "", "", "", "", "", "", "", "");
        $user2 = new User($userId, "", "", "", "", "", "", "", "", "", "", "", "", "", "");
        $helper = new UserDAO();
        $result = $helper->insertUserWallMessage($user, $user2, $message);
        echo json_encode($result);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});