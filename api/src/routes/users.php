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
$app->get('/users/friends/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    $sql = "SELECT u.users_username FROM Friends
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
    $sql = "SELECT Users.users_name,Users.users_firstname,Users.users_lastname,Users.users_email,Users.users_phone            
            FROM Users
            WHERE Users.users_id_user=$id;";
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
$app->get('/contact/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    $sql = "SELECT users_username, users_email 
            FROM Users 
            WHERE users_id_user = $id";
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
       		Users.users_public_profile,Users.users_status,Users.users_summary,Users.users_username FROM Users WHERE Users.users_username = '".$username."' AND Users.users_password = md5('".$password."') AND Users.users_status=1";
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
            session_start();
        	$_SESSION['user']=$user;
        	echo json_encode($user);
        }
        
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}}';
    }
});

// Register a user login
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
    $sql = "UPDATE Users SET Users.users_status=1 WHERE Users.users_id_user= :id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        echo '{"notice": {"text": "User Updated"}';

        $db = null;
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