<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/model/persist/db.php';

$app = new \Slim\App;

//Customer routes
require '../src/routes/customers.php';
require '../src/routes/users.php';
require '../src/routes/games.php';
require '../src/routes/forums.php';
require '../src/routes/genres.php';
require '../src/routes/chats.php';


$app->run();