<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once "../src/model/Game.class.php";
require_once "../src/model/Review.class.php";
require_once "../src/model/persist/GameDAO.class.php";

// Get games image
$app->get('/games/image/{id}', function(Request $request, Response $response){
    	$id = $request->getAttribute("id");
    try{
    	$game = new Game($id,"","","","","","","");
    	$result = "";
        $helper = new GameDAO();
        $result = $helper->getImage($game);    
       	echo json_encode($result);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get games id, name, price, urlImage, rating and idGender (shop.js)
$app->get('/games/shop', function(Request $request, Response $response){
    try{	
    	$result = "";
        $helper = new GameDAO();
        $result = $helper->getShop();    
       	echo json_encode($result);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Get games id,name, price, rating and image
$app->get('/games', function(Request $request, Response $response){
	try{
    	$result = "";
        $helper = new GameDAO();
        $result = $helper->getAll();    
       	echo json_encode($result);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get name, image and description (index.js)
$app->get('/games/featured', function(Request $request, Response $response){
	try{
     	$result = "";
        $helper = new GameDAO();
        $result = $helper->getFeatured();
       	echo json_encode($result);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get name, image and description (index.js)
$app->get('/games/publicationDate', function(Request $request, Response $response){
	try{
    	$result = "";
        $helper = new GameDAO();
        $result = $helper->getPublicationDate();    
       	echo json_encode($result);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get name, image and description (gameProfile.js)
$app->get('/games/{id}', function(Request $request, Response $response){
	$id = $request->getAttribute("id");
    try{
        $game = new Game($id,"","","","","","","");
    	$result = "";
        $helper = new GameDAO();
        $result = $helper->getGame($game);    
       	echo json_encode($result);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

//Insert a new Review for a Game (gameProfile.js)
$app->post('/games/reviews/add', function(Request $request, Response $response){
    $text = $request->getParam("text");
    $rating = $request->getParam("rating");
    $gameId = $request->getParam("gameId");
    $userId = $request->getParam("userId");
    try{
    	$review = new Review("",$text,$rating,$gameId,$userId,"");
    	$result = "";
    	$helper = new GameDAO();
    	$result = $helper->addReview($review);
    	echo json_encode($result);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app->get('/games/reviews/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    try{
        $game = new Game($id,"","","","","","","");
    	$result = "";
        $helper = new GameDAO();
        $result = $helper->getReviews($game);    
       	echo json_encode($result);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app->get('/games/shoppingCart/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    try{
        $game = new Game($id,"","","","","","","");
    	$result = "";
        $helper = new GameDAO();
        $result = $helper->getShoppingCart($game);    
       	echo json_encode($result);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app->post('/games/confirmPurchase', function(Request $request, Response $response){
    $gamesArray = [];
    $gamesArray = $request->getParam("gamesArray");
    $total = $request->getParam("total");
    echo "VALOR DEL TOTAL DESDE EL CLIENTE: " . $total;
    $userId = $request->getParam("userId");

    // Get DB Object
        $db = new db();
        $db = $db->connect();
    for($i=0; $i<count($gamesArray); $i++){
        $sql="SELECT Games.games_price FROM Games
              WHERE Games.games_id_game=".$gamesArray[$i];
        // Connect
        $stmt = $db->query($sql);
        $gamesPriceArray[$i]= $stmt->fetchAll(PDO::FETCH_OBJ);

    }

    $totalPriceServer =0;
    for ($j=0; $j < count($gamesPriceArray); $j++) { 
        $totalPriceServer = ($totalPriceServer + $gamesPriceArray[$j][0]->games_price);
    }
    $totalPriceServer = round($totalPriceServer);
            $sql = "INSERT INTO Bills (bills_price,bills_payment,Users_users_id_user) VALUES (:bills_price,'PayPal',:userId)";
                    echo "ESTE ES EL VALOR DEL CLIENTE: " . $total;
                    echo "<br/> ESTE ES EL VALOR DEL SERVIDOR: " . $totalPriceServer;
        try{
             // Get DB Object
            if($totalPriceServer==$total){
                $stmt = $db->prepare($sql);
                $stmt->bindParam(":bills_price", $totalPriceServer);
                $stmt->bindParam(":userId", $userId);
                $stmt->execute();
                $sql2 = "SELECT Bills.bills_id_bill FROM Bills ORDER BY Bills.bills_id_bill DESC LIMIT 1;";
                $stmt2 = $db->query($sql2);
                $idBillToInsert= $stmt2->fetchAll(PDO::FETCH_OBJ);
                $idBillToInsert = $idBillToInsert[0]->bills_id_bill;
                $sql3 = "INSERT INTO Bill_Details (Bills_bills_id_bill,Games_games_id_game) VALUES (:billId,:gameId)";
                echo "llego hasta aqui";
                $gamesArray = array_unique($gamesArray);
                for($k=0; $k<count($gamesArray); $k++){
                    $stmt = $db->prepare($sql3);
                    $stmt->bindParam(":billId", $idBillToInsert);
                    $stmt->bindParam(":gameId", $gamesArray[$k]);
                    $stmt->execute();
                }
                echo json_encode(true);

            }else{
                echo json_encode(false);
            }
        } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});