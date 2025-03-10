<?php

// Define the application root directory
define('APP_ROOT', dirname(__DIR__) . '/src');
define('PUBLIC_ROOT', __DIR__);

session_start();

include APP_ROOT . '/controllers/HomeController.php';
include APP_ROOT . '/routes.php';

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
$router->dispatch($uri_parts, $request_method)


?>