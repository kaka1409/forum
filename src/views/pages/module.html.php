

<?php

global $db;

$uri_array = explode('/', $_SERVER['REQUEST_URI']);

$module_id = end($uri_array);

$posts_of_module = Module::getAllPostById($db, $module_id);

?>

<div class="posts_container">
    
</div>