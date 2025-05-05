<?php

// root directory
define('APP_ROOT', dirname(__DIR__) . '\src');
define('PUBLIC_ROOT', __DIR__);

/*
APP_ROOT = C:\xampp\htdocs\forum\src
PUBLIC_ROOT = C:\xampp\htdocs\forum\public
*/

session_start();

// config
require_once APP_ROOT . '/config/config.php';
require_once APP_ROOT . '/config/database.php';

// helpers
require_once APP_ROOT . '/helpers/format.php';
require_once APP_ROOT . '/helpers/auth.php';
require_once APP_ROOT . '/helpers/getPostId.php';
require_once APP_ROOT . '/helpers/sendJson.php';

// models
require_once APP_ROOT . '/models/Database.php';
require_once APP_ROOT . '/models/Post.php';
require_once APP_ROOT . '/models/Vote.php';
require_once APP_ROOT . '/models/CommentVote.php';
require_once APP_ROOT . '/models/Module.php';
require_once APP_ROOT . '/models/Message.php';
require_once APP_ROOT . '/models/Account.php';
require_once APP_ROOT . '/models/Comment.php';
require_once APP_ROOT . '/models/Log.php';
require_once APP_ROOT . '/models/Session.php';

$db = new Database();

// controllers
require_once APP_ROOT . '/controllers/AccountController.php';
require_once APP_ROOT . '/controllers/ViewController.php';
require_once APP_ROOT . '/controllers/HomeController.php';
require_once APP_ROOT . '/controllers/PostController.php';
require_once APP_ROOT . '/controllers/CommentController.php';
require_once APP_ROOT . '/controllers/ModuleController.php';
require_once APP_ROOT . '/controllers/MessageController.php';
require_once APP_ROOT . '/controllers/FeedController.php';
require_once APP_ROOT . '/controllers/AdminController.php';
require_once APP_ROOT . '/controllers/SearchController.php';
require_once APP_ROOT . '/controllers/VoteController.php';
require_once APP_ROOT . '/controllers/CommentVoteController.php';

// router
require_once APP_ROOT . '/Router.php';


// Get the current URI
$request_uri = $_SERVER['REQUEST_URI']; 

// Remove query string if present
$request_uri = strtok($request_uri, '?'); 

// Remove base path if the app is in a subdirectory
$base_path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$request_uri = substr($request_uri, strlen($base_path));

// Get the request method
$request_method = $_SERVER['REQUEST_METHOD'];

$uri_parts = explode('/', trim($request_uri, '/'));

$router = new Router();
$router->dispatch($uri_parts, $request_method);

?>