<?php
global $db;

$URI_array = explode('/', $_SERVER['REQUEST_URI']); 

$post_id = end($URI_array);

$post_content = Post::getPostById($post_id, $db);

print_r($post_content);
?>

<h1>Post content: </h1>