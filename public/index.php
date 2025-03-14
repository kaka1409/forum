<?php

// Define the application root directory
define('APP_ROOT', dirname(__DIR__) . '\src');
define('PUBLIC_ROOT', __DIR__);

/*
APP_ROOT = C:\xampp\htdocs\forum\src
PUBLIC_ROOT = C:\xampp\htdocs\forum\public
*/

session_start();

require_once APP_ROOT . '/config/config.php';
require_once APP_ROOT . '/controllers/ViewController.php';
require_once APP_ROOT . '/controllers/HomeController.php';
require_once APP_ROOT . '/controllers/PostController.php';
require_once APP_ROOT . '/Router.php';



// Get the current URI
$request_uri = $_SERVER['REQUEST_URI']; 
// $request_uri = /forum/public/

// Remove query string if present
$request_uri = strtok($request_uri, '?'); 
// $request_uri = /forum/public (query string not present so $request_uri still the same)

// Remove base path if the app is in a subdirectory
$base_path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$request_uri = substr($request_uri, strlen($base_path));

/*
$_SERVER['SCRIPT_NAME'] = /forum/public/index.php
dirname($_SERVER['SCRIPT_NAME']) = /forum/public

$base_path = /forum/public
$request_uri = /
*/

// Get the request method
$request_method = $_SERVER['REQUEST_METHOD'];
// $request_method = GET

$uri_parts = explode('/', trim($request_uri, '/'));
// $uri_parts = [""]

$router = new Router();
$router->dispatch($uri_parts, $request_method);

?>