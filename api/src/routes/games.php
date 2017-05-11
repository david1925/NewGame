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
                                WHERE Users.users_id_user=".$id." ORDER BY Games.games_name";
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

// Get games id, name, price, urlImage, rating and idGender (shop.js)
$app->get('/games/shop', function(Request $request, Response $response){
    $sql = "SELECT Games.games_id_game, Games.games_name, Games.games_price, Games.games_url_image, Games.games_rating, Games.Genders_genders_id_gender FROM Games ORDER BY Games.games_name";
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


// Get games id,name, price, rating and image
$app->get('/games', function(Request $request, Response $response){
    $sql = "SELECT Games.games_id_game,Games.games_url_image,Games.games_name,Games.games_price,Games.games_rating FROM Games ORDER BY Games.games_name";
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

// Get name, image and description
$app->get('/games/featured', function(Request $request, Response $response){
    $sql = "SELECT Games.games_url_image,Games.games_name,Games.games_description FROM Games ORDER BY Games.games_rating DESC LIMIT 4";
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

// Get name, image and description
$app->get('/games/publicationDate', function(Request $request, Response $response){
    $sql = "SELECT Games.games_url_image,Games.games_name,Games.games_description FROM Games ORDER BY Games.games_publication_date DESC LIMIT 4";
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

// Get name, image and description
$app->get('/games/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    $sql = "SELECT Games.games_id_game,Games.games_name,Games.games_description,Games.games_price,Games.games_publication_date,Games.games_url_image,
            Reviews.reviews_text,Reviews.reviews_rating,date_format(Reviews.reviews_datetime,'%H:%i %d/%m') as 'review_datetime', Users.users_id_user,
            Users.users_username,Game_Requirements.games_requirements_os_min,Game_Requirements.games_requirements_processor_min,
            Game_Requirements.games_requirements_memory_min,Game_Requirements.games_requirements_hd_min,
            Game_Requirements.games_requirements_video_card_min,Game_Requirements.games_requirements_directx_min,
            Game_Requirements.games_requirements_os_rec,Game_Requirements.games_requirements_processor_rec,
            Game_Requirements.games_requirements_memory_rec,Game_Requirements.games_requirements_hd_rec,
            Game_Requirements.games_requirements_video_card_rec,Game_Requirements.games_requirements_directx_rec
            FROM Games 
            LEFT JOIN Reviews ON Reviews.Games_games_id_game=Games.games_id_game
            LEFT JOIN Users ON Users.users_id_user=Reviews.Users_users_id_user
            INNER JOIN Genders ON Genders.genders_id_gender=Games.Genders_genders_id_gender
            INNER JOIN Game_Requirements ON Game_Requirements.Games_games_id_game=Games.games_id_game
            WHERE Games.games_id_game=:id";
    try{
         // Get DB Object
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $games = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($games);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app->post('/games/reviews/add', function(Request $request, Response $response){
    $text = $request->getParam("text");
    $rating = $request->getParam("rating");
    $gameId = $request->getParam("gameId");
    $userId = $request->getParam("userId");
    $sql = "INSERT INTO Reviews (reviews_text,reviews_rating,Games_games_id_game,Users_users_id_user) VALUES (:reviewText,:rating,:gameId,:userId)";
    try{
         // Get DB Object
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":reviewText", $text);
        $stmt->bindParam(":rating", $rating);
        $stmt->bindParam(":gameId", $gameId);
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        $db = null;
        echo json_encode(true);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app->get('/games/shoppingCart/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    $sql = "SELECT Games.games_id_game, Games.games_name, Games.games_price, Games.games_url_image FROM Games
            WHERE Games.games_id_game=:id";
    try{
         // Get DB Object
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $games = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($games);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});